<?php

namespace App\Http\Controllers;

use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('administrator')) {
            $view = view('home');

            $view->reservations = Reservation::all()->mapToGroups(function ($q) {
                return  [Carbon::parse($q->date)->month => $q->id];
            })->map(function ($month) {
                return count($month->toArray());
            })->sortKeys()->toArray();

            return $view;
        }
        return redirect()->to('/profile');
    }
}
