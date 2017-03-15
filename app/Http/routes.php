<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('layouts.master');
});
// Authentication routes...
Route::get('/login', ['as' => 'login-form', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');


Route::group(['middleware' => 'auth' ], function () {
    // Registration routes...
    Route::group(['prefix' => 'users'], function(){
        Route::get('/create', 'UserController@create');
        Route::post('/store', 'UserController@store');
        Route::get('/{id}/show', 'UserController@show');
        Route::get('/{id}/edit', 'UserController@edit');
        Route::post('/{id}/update', 'UserController@update');
        Route::post('/{id}/delete', 'UserController@destroy');
    });

});


