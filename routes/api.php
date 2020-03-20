<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\UserController@login')->name('login');
Route::post('register', 'Api\UserController@register');

Route::get('update-token', 'Api\UserController@updateToken');

// -- Category Requests -- //

Route::get('get-all-locations', 'Api\LocationController@index');
Route::get('get-location', 'Api\LocationController@show');
Route::get('create-location', 'Api\LocationController@create');
Route::get('delete-location', 'Api\LocationController@delete');

Route::group(['middleware' => 'auth:api'], function(){

// -- Scrap Requests -- // AUTH

Route::get('get-all-posts', 'Api\PostController@index');
Route::get('get-post', 'Api\PostController@show');
Route::post('create-post', 'Api\PostController@store');

// -- User Requests -- // AUTH

Route::get('get-registered', 'Api\UserController@getRegistered');

});