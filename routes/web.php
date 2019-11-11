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


Route::get('/images/{file}', [ function ($file) {
  $path = storage_path('app/images/'.$file);
  if (file_exists($path)) {
    return response()->file($path, array('Content-Type' => 'image/jpeg'));
  }
  abort(404);
}]);

Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
