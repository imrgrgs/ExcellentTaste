<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('portal.users.index');
        $view->users = User::all();

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('portal.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->inputFirstName;
        $user->middle_name = $request->inputMiddleName;
        $user->last_name = $request->inputLastName;
        $user->email = $request->inputEmail;
        $user->address = $request->inputAddress;
        $user->postal = $request->inputPostal;
        $user->city = $request->inputCity;
        $user->phone = $request->inputPhone;

        $user->save();
        // Session::flash('success', 'Gebruiker geupdate');
        return redirect('/users/' . $id . '/edit')->with('success','Gebruiker geupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softdelete()
    {

        $user = User::findOrFail(request()->id);

        $user->first_name = NULL;
        $user->middle_name = NULL;
        $user->last_name = NULL;
        $user->email = NULL;
        $user->address = NULL;
        $user->postal = NULL;
        $user->city = NULL;
        $user->phone = NULL;

        $user->save();
        $user->delete();
        // Session::flash('success', 'Gebruiker verwijderd');
        return redirect('/users');

    }

    public function block($id)
    {
        $user = User::find($id);
        $user->active = false;
        $user->save();

        return redirect('/users/' . $id . '/edit');
    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->active = true;
        $user->save();

        return redirect('/users/' . $id . '/edit');
    }
}
