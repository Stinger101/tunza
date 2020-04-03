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
//child
Route::middleware('auth:api')->post('/user/add_child','ChildController@store');
Route::middleware('auth:api')->get('/user/children', 'ChildController@index');
Route::middleware('auth:api')->get('/user/child/{child_id}','ChildController@show');
Route::middleware('auth:api')->post('/user/child/{child_id}/update', 'ChildController@update');
Route::middleware('auth:api')->post('/user/child/{child_id}/delete', 'ChildController@destroy');
//category
Route::middleware('auth:api')->post('/user/add_category', "CategoryController@store");
Route::middleware('auth:api')->get('/user/categories', 'CategoryController@index');
Route::middleware('auth:api')->get('/user/category/{category_id}','CategoryController@show');
Route::middleware('auth:api')->post('/user/category/{category_id}/update', 'CategoryController@update');
Route::middleware('auth:api')->post('/user/category/{category_id}/delete', 'CategoryController@destroy');

Route::middleware('auth:api')->post('/user/child/{child_id}/add_caregiver', "CaregiverController@store");
Route::middleware('auth:api')->get('/user/child/{child_id}/caregivers', "CaregiverController@index");
Route::middleware('auth:api')->get('/user/child/{child_id}/caregiver/{caregiver_id}', "CaregiverController@show");
Route::middleware('auth:api')->post('/user/child/{child_id}/caregiver/{caregiver_id}/update', "CaregiverController@update");
Route::middleware('auth:api')->post('/user/child/{child_id}/caregiver/{caregiver_id}/delete', "CaregiverController@destroy");