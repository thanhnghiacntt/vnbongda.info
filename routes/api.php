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
    Route::post('update-user','UserController@update');
    Route::get('list-user', 'UserController@listRecord');
    
    
    Route::post('create-category', 'CategoryController@create');
    Route::post('update-category', 'CategoryController@update');
    Route::delete('delete-category', 'CategoryController@delete');

    Route::post('upload-image', 'GalleryController@uploadFile');
    Route::post('create-gallery', 'GalleryController@create');
    Route::post('update-gallery', 'GalleryController@update');
    Route::delete('delete-gallery', 'GalleryController@delete');

    Route::post('create-post', 'PostController@create');
    Route::post('update-post', 'PostController@update');
    Route::delete('delete-post', 'PostController@delete');
});

Route::group(['namespace' => 'Api', null], function () {
    Route::post('login','UserController@login');
    Route::post('create-user','UserController@create');
    
    Route::get('list-category', 'CategoryController@listRecord');
    Route::get('list-post', 'PostController@listRecord');
    Route::get('list-gallery', 'GalleryController@listRecord');
    Route::get('list-category', 'CategoryController@listRecord');
});