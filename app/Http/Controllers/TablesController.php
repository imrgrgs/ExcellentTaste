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

        $view->groups = Table::with('excluded')->get()->groupBy('seat_count');

        return $view;
    }

    public function excluded()
    {
        $view = view('portal.tables.excluded');

        $view->start = Carbon::parse(request()->get('start'))->startOfDay();
        $view->end = Carbon::parse(request()->get('end'))->endOfDay();
        $view->tables = Table::whereHas('excluded', function ($q) use ($view) {
            $q->whereBetween('start', [$view->start, $view->end])->orWhereBetween('end', [$view->start, $view->end]);
        })->get();

        return $view;
    }

    public function excludesJson()
    {
        $start = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'));
        $end = Carbon::parse(request()->get('start_date') . ' ' . request()->get('start_time'))->addHours(2);

        if (\request()->has('end_date')) {
            $end = Carbon::parse(request()->get('end_date') . ' ' . request()->get('end_time'));
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
            })->pluck('id'))->flatten();
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

            $table->excluded()->where('end', $end)->where('start', $start)->delete();

            // shift all the blockades of the table that end within the new period to the start of the new period
            $shifted_back = $table->excluded()->whereBetween('end', [$start, $end])->update([
                'end' => $end
            ]);

            // shift all the blockades of the table that start within the new period to the end of the new period
            $shifted_forth = $table->excluded()->whereBetween('start', [$start, $end])->update([
                'start' => $start
            ]);

            // if a item is shifted then dont execute this command
            if ($shifted_back === 0 && $shifted_forth === 0 && $status === 'on') {
                $table->excluded()->where(function ($q) use ($start, $end){
                    $q->where('start', '<', $start)->where('end', '>', $end);
                })->delete();

                $table->excluded()->create([
                    'start' => $start,
                    'end' => $end,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tafels zijn uitgesloten');
    }
}
