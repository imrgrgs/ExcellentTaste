<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'tables'], function ($get) {
        $get->get('exclude', 'TableController@index');
        $get->post('exclude', 'TableController@save');
    });
    Route::get('reservations/create', 'ReservationController@create');
    Route::post('reservations/create', 'ReservationController@save');
});
