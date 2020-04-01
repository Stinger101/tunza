<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post("/register",function(Request $request){
  return \App\Http\Controllers\Auth\RegisterController::apiCreate($request);
});
Route::post("/login",function(Request $request){
  return \App\Http\Controllers\Auth\LoginController::apiAuthenticate($request);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
