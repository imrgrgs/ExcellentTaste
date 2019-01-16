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

        $post = new Post();

        $post->address = $request->get('address');
        $post->email = $request->get('email');

        $post->save();

        return redirect()->route('profile');

    }

}
