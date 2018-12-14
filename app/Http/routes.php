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
Route::get('/status', 'StatusController@Index');
Route::any('/add', 'AddController@index');

Route::any('/Like', 'LikeController@index');
Route::get('/getLike', 'LikeController@get');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/all', 'AllController@index');

Route::get('/api', 'ApiController@index');

Route::get('/about', 'AboutController@index');

Route::get('/tickets', 'TicketController@index');
Route::get('tickets/show/{id?}', 'TicketController@show')->where('id', '[0-9]+');
Route::get('/tickets/create', 'TicketController@create');
Route::post('/tickets/store', 'TicketController@store');
Route::post('/tickets/delete/{id?}', 'TicketController@deleteTicket')->where('id', '[0-9]+');
Route::post('/tickets/close/{id?}', 'TicketController@closeTicket')->where('id', '[0-9]+');
Route::post('/tickets/addReply/{id?}', 'TicketController@addReply')->where('id', '[0-9]+');
Route::post('/upload', 'HitokotoController@upload');
Route::any('/uploadProgress', 'HitokotoController@uploadProgress');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@Index');
    Route::get('tickets', 'AdminTicketController@Index');
    Route::get('hitokoto', 'AdminHitokotoPendingController@Index');
    Route::get('/check', 'CheckController@index');
    Route::get('/review', 'ReviewController@index');
    Route::post('api/updateSentence', 'AdminApiController@updateSentence');
    Route::get('review/edit/{result}', 'ReviewController@edit');
});
