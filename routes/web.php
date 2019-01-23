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
    Route::get('/profile/delete', 'ProfileController@delete');
    Route::get('/profile/{reservation}/delete', 'ProfileController@reservationdelete');
    Route::get('tables/excluded', 'TablesController@excludesJson');

    Route::get('/menu', 'MenuController@index')->name('menu');
    Route::post('/menu', 'MenuController@store');

    Route::get('/contact', 'ContactController@index')->name('contact');

    Route::group(['prefix' => 'reservations'], function ($get) {
        $get->get('create', 'ReservationsController@create');
        $get->post('create', 'ReservationsController@save');
        $get->post('search', 'ReservationsController@search')->middleware('role:administrator');
        $get->get('{status?}', 'ReservationsController@index')->middleware('role:administrator');
    });

    Route::group(['middleware' => ['auth', 'role:employee|administrator']], function () {
        
        Route::group(['prefix' => 'orders', 'as' => 'orders'], function () {
            Route::get('/', 'OrderController@index');
            Route::get('/create', 'OrderController@create');
            Route::post('/create', 'OrderController@store');

            Route::group(['middleware' => ['auth', 'role:administrator']], function () {
                Route::post('/delete', 'OrderController@destroy');
                Route::get('/{id}/edit', 'OrderController@edit');
                Route::post('/{id}/update', 'OrderController@update');
            });
        });
    });

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

    // employee routes
    Route::group(['middleware' => ['auth', 'role:employee']], function () {
    });

});
