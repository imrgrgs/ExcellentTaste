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
            foreach (range(1, 12) as $month) {
                $data[$month] = 0;
            }
            foreach (Reservation::all() as $reservation) {
                $data[Carbon::parse($reservation->date)->month]++;
            }

            $view->reservations = $data;

            return $view;
        }
        return redirect()->to('/profile');
    }
}
