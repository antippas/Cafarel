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

/*
//Enable identification and relation model
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Index page
Route::get('/', "PagesControllerJson@index");

//list of users
Route::get('users', 'DashboardControllerJson@index');

//list of posts
Route::get('posts', 'PostsControllerJson@index');

//Single post
Route::get('post/{id}','PostsControllerJson@show');

//Create a new post
Route::post('post','PostsControllerJson@store');

//Update the post
Route::put('post/{id}','PostsControllerJson@update');

//Destroy a post
Route::delete('post/{id}','PostsControllerJson@destroy');