<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;

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
Route::post("/register",'Auth\RegisterController@apiCreate');

Route::post("/login",'Auth\LoginController@apiAuthenticate');

Route::middleware('auth:api')->post('/broadcast/auth',function (Request $request){
  if(!\Auth::check()){
    return new Response("Forbidden",403);
  }
  $pusher = new Pusher\Pusher(env('PUSHER_APP_KEY'),env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'),['cluster'=>'eu','useTLS'=>true]);
  $pb=new PusherBroadcaster($pusher);
  return $pb->auth($request);
});

Route::middleware('auth:api')->get('/user','UserController@show');
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

Route::middleware('auth:api')->post('/user/child/{child_id}/add_basicinfo', "BasicInfoController@store");
Route::middleware('auth:api')->get('/user/child/{child_id}/basicinfos', "BasicInfoController@index");
Route::middleware('auth:api')->get('/user/child/{child_id}/basicinfo/{basicinfo_id}', "BasicInfoController@show");
Route::middleware('auth:api')->post('/user/child/{child_id}/basicinfo/{basicinfo_id}/update', "BasicInfoController@update");
Route::middleware('auth:api')->post('/user/child/{child_id}/basicinfo/{basicinfo_id}/delete', "BasicInfoController@destroy");


Route::middleware('auth:api')->post('/user/child/{child_id}/add_topic', "TopicController@store");
Route::middleware('auth:api')->get('/user/child/{child_id}/topics', "TopicController@index");
Route::middleware('auth:api')->get('/user/child/{child_id}/topic/{topic_id}', "TopicController@show");
Route::middleware('auth:api')->post('/user/child/{child_id}/topic/{topic_id}/update', "TopicController@update");
Route::middleware('auth:api')->post('/user/child/{child_id}/topic/{topic_id}/delete', "TopicController@destroy");

Route::middleware('auth:api')->post('/user/child/{child_id}/topic/{topic_id}/add_comment', "CommentController@store");
Route::middleware('auth:api')->get('/user/child/{child_id}/topic/{topic_id}/comments', "CommentController@index");
Route::middleware('auth:api')->get('/user/child/{child_id}/topic/{topic_id}/comment/{comment_id}', "CommentController@show");
Route::middleware('auth:api')->post('/user/child/{child_id}/topic/{topic_id}/comment/{comment_id}/update', "CommentController@update");
Route::middleware('auth:api')->post('/user/child/{child_id}/topic/{topic_id}/comment/{comment_id}/delete', "CommentController@destroy");

Route::middleware('auth:api')->get('/caregiver/invites','InviteController@index');
Route::middleware('auth:api')->get('/caregiver/invite/{invite_id}','InviteController@show');
Route::middleware('auth:api')->post('/caregiver/invite/{invite_id}/update','InviteController@update');

Route::middleware('auth:api')->get('/caregiver/children', 'ChildController@index');
Route::middleware('auth:api')->get('/caregiver/child/{child_id}','ChildController@show');

Route::middleware('auth:api')->post('/user/call','CallController@store');
