<?php

namespace App\Http\Controllers;

use App\Exclusion;
use App\Reservation;
use App\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function index()
    {
        $view = view('portal.tables.exclude');

        $view->groups = Table::all()->groupBy('seat_count');
        $view->excludes = Exclusion::where('excluded_type', 'App\Table')->get();

        return $view;
    }

    public function excludes()
    {
        $start = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'));
        if (\request()->has('end_date')) {
            $end = Carbon::parse(request()->get('end_date') . ' ' . request()->get('end_time'));
        } else {
            $end = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'))->addHours(2);
        }

        $tables = Table::whereHas('excluded', function ($q) use ($start, $end) {
            $q->whereBetween('start', [$start, $end])->orWhereBetween('end',[$start, $end]);
        })->orWhereHas('excluded', function ($q) use ($start, $end) {
            $q->where('start', '<', $start)->where('end', '>', $end);
        })->pluck('id');

        if (request()->has('withReservations')) {
            $tables->push(Table::whereHas('reservations', function ($q) use ($start, $end) {
                $q->whereBetween('start', [$start, $end])->orWhereBetween('end',[$start, $end]);
            })->orWhereHas('reservations', function ($q) use ($start, $end) {
                $q->where('start', '<', $start)->where('end', '>', $end);
            })->pluck('id'));
            $tables = $tables->flatten();
        }

        return $tables;
    }

    public function save(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'end_time' => 'required',
            'start_time' => 'required'
        ]);

        $excluded_tables = Table::all()->pluck('id')->keyBy(function ($item) {
            return $item;
        })->mapWithKeys(function ($item, $key) use ($request) {
            if ($request->has($item)) {
                return [$item => $request->get($item)];
            }
            return [$item => 'off'];
        });
        $start = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'))->toDateTimeString();
        $end = Carbon::parse(request()->get('end_date') . ' ' . request()->get('end_time'))->toDateTimeString();

        foreach ($excluded_tables as $id => $status) {
            $table = Table::find($id);

            // shift all the blockades of the table that end within the new period to the start of the new period
            $table->excluded()->where(function ($q) use ($start, $end){
                $q->whereBetween('end', [$start, $end]);
            })->get()->each(function ($q) use ($start) {
                $q->start = $q->start;
                $q->end = $start;
                $q->save();
            });

            // shift all the blockades of the table that start within the new period to the end of the new period
            $table->excluded()->where(function ($q) use ($start, $end){
                $q->whereBetween('start', [$start, $end]);
            })->update([
                'start' => $end
            ]);

            if ($status === 'on') {

                $table->excluded()->where(function ($q) use ($start, $end){
                    $q->where('start', '<', $start)->where('end', '>', $end);
                })->delete();

                // delete all the blockades of the table that start and end within the new period
                $table->excluded()->create([
                    'start' => $start,
                    'end' => $end,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tafels zijn uitgesloten');
    }
}
