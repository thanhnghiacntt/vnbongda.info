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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', null, 'middleware' => ['jwt.auth']], function () {
    Route::post('change-password', 'UserController@changPassword');
    Route::post('create-category', 'CategoryController@create');
});

Route::group(['namespace' => 'Api', null], function () {
    Route::post('login','UserController@login');
    Route::post('create-user','UserController@create');
});