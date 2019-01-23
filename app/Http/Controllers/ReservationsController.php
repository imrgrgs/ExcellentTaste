<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Rules\HoursBetween;
use App\Table;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index($status = 'active')
    {
        $search = session()->get('portal.registrations');

        $view = view('portal.reservations.index');

        $view->search = $search;
        $view->reservations = Reservation::when(($status != 'active'), function ($q) {
//            $q->whereHas('nota');
        })->when($search['number'], function ($q, $number) {
            $q->where('number', 'like', '%' . $number . '%');
        })->when($search['last_name'], function ($q, $name) {
            $q->whereHas('user', function ($q) use ($name) {
                $q->where('last_name', 'like', '%' . $name . '%');
            });
        })->when($search['range'], function ($q, $range) {
            $q->whereBetween('date', explode(' - ', $range));
        })->orderBy('date')->paginate(25);

        return $view;
    }

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
        $rules = [
            'date' => 'required',
            'tables' => 'required|max:2',
            'start_time' => ['required', new HoursBetween]
        ];
        if (!auth()->user()->hasRole('administrator')) {
            $rules['seat'] = 'required|digits_between:0,8';
        }
        $request->validate($rules);

        $user = !is_null($request->get('customer_id')) ? User::find($request->get('customer_id')) : auth()->user();

        $date = str_replace('/', '-', $request->get('date'));

        $tables = collect($request->get('tables'))->keyBy(function ($item) {
            return $item;
        })->map(function () use ($date) {
            return [
                'start' => Carbon::parse($date.' '.request()->get('start_time')),
                'end' => request()->get('end_time') ? Carbon::parse($date.' '.request()->get('end_time')) : Carbon::parse($date . ' ' . request()->get('start_time'))->addHour(2)
            ];
        })->toArray();
        $follow_up = count(Reservation::where('date', Carbon::parse($date))->whereHas('tables', function ($q) use ($tables){
            return $q->whereIn('tables.id', $tables);
        })->get());
        $user->reservations()->create([
            'diet' => $request->get('diet'),
            'date' => Carbon::parse($date),
            'number' => Carbon::parse($date)->format('Ymd'). $request->get('tables')[0]. $follow_up,
        ])->tables()->sync($tables);

        return redirect()->to('/profile')->with('success', 'Uw reservering is opgeslagen');
    }

    public function search(Request $request)
    {
        session()->put('portal.registrations', $request->except('_token'));

        return redirect()->back();
    }
}
