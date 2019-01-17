<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function index(Request $request)
    {
        $view = view('profile');
        $view->user = auth()->user();

        return $view;
    }

    public function store(Request $request)
    {

        $user = auth()->user();

        $user->first_name = $request->get('first_name');
        $user->middle_name = $request->get('middle_name');
        $user->last_name = $request->get('last_name');
        $user->address = $request->get('address');
        $user->postal = $request->get('postal');
        $user->city = $request->get('city');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        $user->save();

        return redirect()->route('profile')->with('success','Profiel opgeslagen');
    }

//    public function update(Request $request)
//    {
//        $user = auth()->user();
//
//        $user->password = bcrypt($request->get('password'));
//
//        $user->save();
//
//        return redirect()->route('profile');
//    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        if(!empty($request->get('password')))
        {
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

//        $user->roles()->attach(Role::where('name', 'employee')->first());

        return redirect()->route('profile');
    }
}
