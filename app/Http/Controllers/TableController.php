<?php

namespace App\Http\Controllers;

use App\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $view = view('portal.tables.exclude');

        $view->groups = Table::all()->groupBy('seat_count');

        return $view;
    }

    public function excludes()
    {
        $tables = Table::whereHas('exclusions', function ($q) {
            $q->where('start', Carbon::parse(request()->header('start_date').' '.request()->header('start_time')));
            $q->where('end', Carbon::parse(request()->header('end_date').' '.request()->header('end_time')));
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

        $excluded_tables = $request->except([
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            '_token'
        ]);
        foreach ($excluded_tables as $id => $status) {
            $table = Table::find($id);
            $table->exclusions()->create([
                'start' => Carbon::parse(request()->get('start_date').' '.request()->get('start_time')),
                'end' => Carbon::parse(request()->get('end_date').' '.request()->get('end_time')),
            ]);
        }
        dd($request->all());
    }
}
