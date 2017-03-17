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
    if(Auth::check())
        return redirect()->route('platform.index');
    else
        return redirect('auth/login');
});
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::group(['middleware' => 'auth' ], function () {
    // User routes...
    Route::group(['prefix' => 'usuarios', 'as' => 'user.'], function(){
            Route::get('/ajaxroles',['as'=>'ajax_roles', 'uses'=>'UserController@ajaxRoles']);
            Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::get('/criar', ['as' => 'create', 'uses' => 'UserController@create']);
            Route::post('/salvar', ['as' => 'store', 'uses' => 'UserController@store']);
            Route::get('/{id}/editar', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::post('/{id}/atualizar', ['as' => 'update', 'uses' => 'UserController@update']);
            Route::patch('/{id}/atualizarsenha', ['as'=>'update_password', 'uses'=>'UserController@updatePassword']);
            Route::post('/{id}/deletar', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
    });

    // Platform routes...
    Route::group(['prefix' => 'plataformas', 'as' => 'platform.'], function() {
        Route::get('/ajaxplataformas',['as'=>'ajax_platforms', 'uses'=>'PlatformController@ajaxPlatforms']);
        Route::get('', ['as' => 'index', 'uses' => 'PlatformController@index']);
        Route::get('criar', ['as' => 'create', 'uses' => 'PlatformController@create']);
        Route::post('salvar', ['as' => 'store', 'uses' => 'PlatformController@store']);
        Route::get('{platformId}/editar', ['as' => 'edit', 'uses' => 'PlatformController@edit']);
        Route::post('{platformId}/atualizar', ['as' => 'update', 'uses' => 'PlatformController@update']);
        Route::post('{platformId}/apagar', ['as' => 'destroy', 'uses' => 'PlatformController@destroy']);
    });

      /*
      * Images Route
      */
        Route::get('/images/{folder}/{image?}/{size?}', ['as' => 'images', 'uses' => function($folder, $image, $size) {
            $path = storage_path() . '/app/' . $folder . '/' . $image;
            $img = Image::make($path)->resize(null, $size, function ($constraint) {
                $constraint->aspectRatio();
            });
            return $img->response();
        }]);

});




