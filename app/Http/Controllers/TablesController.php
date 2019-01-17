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
        $end = Carbon::parse(request()->get('end_date') . ' ' . request()->get('end_time'));

        if (!request()->has('end_date')) {
            $end = $start->addHours(2);
        }

        $tables = Table::whereHas('excluded', function ($q) use ($start, $end) {
            $q->whereBetween('start', [$start, $end])->orWhereBetween('end',[$start, $end]);
        })->orWhereHas('excluded', function ($q) use ($start, $end) {
            $q->where('start', '<', $start)->where('end', '>', $end);
        })->when(request()->has('withReservations'), function ($q) use ($start, $end) {
            $q->whereHas('reservations', function ($q) use ($start, $end) {
                $q->whereBetween('start', [$start, $end])->orWhereBetween('end',[$start, $end]);
            })->orWhereHas('reservations', function ($q) use ($start, $end) {
                $q->where('start', '<', $start)->where('end', '>', $end);
            });
        })->get();

        return $tables->pluck('id');
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
        $start = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'));
        $end = Carbon::parse(request()->get('end_date') . ' ' . request()->get('end_time'));

        foreach ($excluded_tables as $id => $status) {
            $table = Table::find($id);

            Exclusion::where('excluded_type', 'App\Table')->where('excluded_id', $id)->where(function ($q) use ($start, $end){
                $q->whereBetween('start', [$start, $end])->orWhereBetween('end', [$start, $end]);
            })->get();

            if ($status === 'on') {
                $table->excluded()->create([
                    'start' => $start,
                    'end' => $end,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tafels zijn uitgesloten');
    }
}
