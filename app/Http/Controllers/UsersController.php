<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        Session::flash('success', 'Email was sent');
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
