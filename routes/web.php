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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/profile/password', 'ProfileController@update');
    Route::get('/profile/delete', 'ProfileController@delete')->name('profile');

    Route::get('reservations/create', 'ReservationsController@create');
    Route::post('reservations/create', 'ReservationsController@save');
    Route::get('tables/excluded', 'TablesController@excludesJson');


    // administrator routes
    Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    	Route::group(['prefix' => 'users', 'as' => 'users'], function () {
            Route::get('/', 'UsersController@index');
            Route::post('/delete/', 'UsersController@softdelete');
            Route::get('/{user}/edit', 'UsersController@edit');
            Route::post('/{user}/update', 'UsersController@update');
            Route::post('/{user}/block', 'UsersController@block');
            Route::post('/{user}/activate', 'UsersController@activate');
        });

        Route::group(['prefix' => 'products', 'as' => 'products'], function () {
            Route::get('/', 'ProductsController@index');
            Route::get('/create', 'ProductsController@create');
            Route::post('/create', 'ProductsController@store');
            Route::post('/delete', 'ProductsController@destroy');
            Route::get('/{id}/edit', 'ProductsController@edit');
            Route::post('/{id}/update', 'ProductsController@update');
        });

        Route::group(['prefix' => 'tables'], function ($get) {
            $get->get('exclude', 'TablesController@index');
            $get->post('exclude', 'TablesController@save');
            $get->get('excluded-tables', 'TablesController@excluded');
        });
    });
});
