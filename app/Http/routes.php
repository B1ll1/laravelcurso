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

// Platform routes...
Route::group(['prefix' => 'plataformas', 'as' => 'platform.'], function() {
    Route::get('', ['as' => 'index', 'uses' => 'PlatformController@index']);
    Route::get('criar', ['as' => 'create', 'uses' => 'PlatformController@create']);
    Route::post('salvar', ['as' => 'store', 'uses' => 'PlatformController@store']);
    Route::get('{platformId}/editar', ['as' => 'edit', 'uses' => 'PlatformController@edit']);
    Route::post('{platformId}/atualizar', ['as' => 'update', 'uses' => 'PlatformController@update']);
    Route::post('{platformId}/apagar', ['as' => 'destroy', 'uses' => 'PlatformController@destroy']);
});

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


