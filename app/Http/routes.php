<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HitokotoController@index');

Route::any('/add', 'AddController@index');

Route::any('/Like', 'LikeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/check', 'CheckController@index');

Route::get('/review', 'ReviewController@index');

Route::get('/all', 'AllController@index');

Route::get('/api', 'ApiController@index');

Route::get('/about', 'AboutController@index');