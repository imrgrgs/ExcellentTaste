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

    public function update(Request $request)
    {
        $this->validate($request,[
            'g-recaptcha-response'=>'required|recaptcha',
            'password' => 'required|string|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/',

        ]);
        $user = auth()->user();
        if(!empty($request->get('password')))
        {
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();


        return redirect()->route('profile')->with('success','Uw wachtwoord is opgeslagen');;
    }

    public function delete()
    {

        $user = auth()->user();

        $user->first_name = NULL;
        $user->middle_name = NULL;
        $user->last_name = NULL;
        $user->email = NULL;
        $user->address = NULL;
        $user->postal = NULL;
        $user->city = NULL;
        $user->phone = NULL;
        $user->password = NULL;

        $user->save();
        $user->delete();
        // Session::flash('success', 'Gebruiker verwijderd');
        return redirect()->route('home')->with('success','Gebruiker verwijderd');;

    }
}
