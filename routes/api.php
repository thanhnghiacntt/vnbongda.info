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
    Route::post('user/change-password', 'UserController@changPassword');
    Route::post('user/update','UserController@update');
    Route::get('user/list', 'UserController@listRecord');
    Route::get('user/detail/{id}','UserController@getById');
    
    Route::post('category/create', 'CategoryController@create');
    Route::post('category/update', 'CategoryController@update');
    Route::delete('category/delete', 'CategoryController@delete');

    Route::post('gallery/upload-image', 'GalleryController@uploadFile');
    Route::post('gallery/create', 'GalleryController@create');
    Route::post('gallery/update', 'GalleryController@update');
    Route::delete('gallery/delete', 'GalleryController@delete');

    Route::post('post/create', 'PostController@create');
    Route::post('post/update', 'PostController@update');
    Route::delete('post/delete', 'PostController@delete');
});

Route::group(['namespace' => 'Api', 'middleware' => 'cors'], function () {
    Route::post('user/login','UserController@login');
    Route::post('user/create','UserController@create');
    
    Route::get('category/list', 'CategoryController@listRecord');
    Route::get('post/list', 'PostController@listRecord');
    Route::get('gallery/list', 'GalleryController@listRecord');


    Route::get('category/children','CategoryController@children');
    Route::get('category/all', 'CategoryController@all');

    Route::get('category/detail/{id}','CategoryController@getById');
    Route::get('gallery/detail/{id}','GalleryController@getById');
    Route::get('post/detail/{id}','PostController@getById');

});