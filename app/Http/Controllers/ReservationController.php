<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Rules\HoursBetween;
use App\Table;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $view = view('portal.reservations.create');;

        $view->table_groups = Table::all()->groupBy('seat_count');
        $view->reservations = Reservation::all();
        $view->customers = User::all();

        return $view;
    }

    public function save(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'tables' => 'required|max:2',
            'start_time' => new HoursBetween,
            'seat' => 'required|digits_between:0,8'
        ]);

        $user = $request->exists('customer_id') ? User::find($request->get('customer_id')) : auth()->user();

        $date = str_replace('/', '-', $request->get('date'));

        $tables = collect($request->get('tables'))->keyBy(function ($item) {
            return $item;
        })->map(function () use ($date) {
            return [
                'start' => Carbon::parse($date.' '.request()->get('start_time')),
                'end' => Carbon::parse($date.' '.request()->get('end_time'))
            ];
        })->toArray();

        $user->reservations()->create([
            'date' => Carbon::parse($date),
            'number' => Carbon::parse($date)->format('Ymd'). implode($request->get('tables')),
        ])->tables()->sync($tables);

        return redirect()->to('/');
    }
}