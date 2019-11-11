<?php

use Illuminate\Http\Request;
//Auth::routes();



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register');

Route::apiResource('users', 'UserController');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout');

Route::get('albums', 'AlbumController@index');

Route::post('albums', 'AlbumController@store');



Route::put('albums/{album}', 'AlbumController@update');

Route::group(['middleware' => 'auth:api'], function() {
	
	Route::get('albums/{album}', 'AlbumController@show')->name('albums.show');

});

Route::delete('albums/{album}', 'AlbumController@delete');


Route::get('photos', 'PhotoController@index');

Route::get('photos/{photo}', 'PhotoController@show');

Route::put('photos/{photo}', 'PhotoController@update');

Route::delete('photos/{photo}', 'PhotoController@delete');

Route::post('albums/{album}/photos', 'PhotoController@store');