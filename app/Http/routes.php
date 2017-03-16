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

 Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
        Route::get('/redirect', ['as' => 'redirect', 'uses' => 'UserController@redirect']);
        Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'UserController@store']);
        Route::get('/{id}/show', ['as' => 'show', 'uses' => 'UserController@show']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('/{id}/update', ['as' => 'update', 'uses' => 'UserController@update']);
        Route::post('/{id}/delete', ['as' => 'delete', 'uses' => 'UserController@destroy']);
    });

Route::group(['middleware' => 'auth' ], function () {
    // Registration routes...


});


