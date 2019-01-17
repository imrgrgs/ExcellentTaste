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
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/profile/password', 'ProfileController@update');

    Route::get('reservations/create', 'ReservationsController@create');
    Route::post('reservations/create', 'ReservationsController@save');

    Route::get('tables/excluded', 'TablesController@excludes');
    // administrator routes
    Route::group(['middleware' => 'role:administrator'], function () {

        Route::group(['prefix' => 'tables'], function ($get) {
            $get->get('exclude', 'TablesController@index');
            $get->post('exclude', 'TablesController@save');
        });
    });
});
