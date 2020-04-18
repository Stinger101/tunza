<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth:api')->get('/avatar/users/{path_to_file}', function (Request $request,$path_to_file) {
  if(\Auth::user()->id==$path_to_file){
    return response()->file(storage_path('app/avatar/users/').$path_to_file);
  }else{
    abort(403, 'Unauthorized action.');
  }

});
