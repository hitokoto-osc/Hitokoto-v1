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
Route::any('/add', 'AddController@index')->middleware(['auth']);

Route::any('/Like', 'LikeController@index');
Route::get('/getLike', 'LikeController@get');

Route::auth();

Route::get('/home', 'HomeController@index')->middleware(['auth']);

Route::get('/all', 'AllController@index')->middleware(['auth']);

Route::get('/api', 'ApiController@index');
Route::get('/api/v1/user/getToken', 'ApiController@getToken')->middleware(['auth']);
Route::get('/api/v1/user/refreshToken', 'ApiController@refreshToken')->middleware(['auth']);
Route::any('/api/v1/hitokoto/append', 'v1Controller@append');



Route::get('/about', 'AboutController@index');

Route::any('/oauth/login', 'AppController@login');
Route::any('/oauth/get_information', 'AppController@get_my_information');
Route::any('/oauth/get_all_hitokoto', 'AppController@get_my_hitokoto');
Route::any('/oauth/add', 'AppController@add_new_sentence');
Route::any('/oauth/app_announcement', 'AppController@app_announcement');
Route::any('/oauth/oauth_status', 'AppController@oauth_status');

Route::get('/tickets', 'TicketController@index')->middleware(['auth']);
Route::get('tickets/show/{id?}', 'TicketController@show')->where('id', '[0-9]+')->middleware(['auth']);
Route::get('/tickets/create', 'TicketController@create')->middleware(['auth']);
Route::post('/tickets/store', 'TicketController@store')->middleware(['auth']);
Route::post('/tickets/delete/{id?}', 'TicketController@deleteTicket')->where('id', '[0-9]+')->middleware(['auth']);
Route::post('/tickets/close/{id?}', 'TicketController@closeTicket')->where('id', '[0-9]+')->middleware(['auth']);
Route::post('/tickets/addReply/{id?}', 'TicketController@addReply')->where('id', '[0-9]+')->middleware(['auth']);
Route::post('/upload', 'HitokotoController@upload')->middleware(['auth']);
Route::any('/uploadProgress', 'HitokotoController@uploadProgress')->middleware(['auth']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@Index');
    Route::get('tickets', 'AdminTicketController@Index');
    Route::get('hitokoto', 'AdminHitokotoPendingController@Index');
    Route::get('/check', 'CheckController@index');
    Route::get('/review', 'ReviewController@index');
    Route::post('api/updateSentence', 'AdminApiController@updateSentence');
    Route::get('api/getReviewSentence', 'AdminApiController@getReviewSentence');
    Route::get('review/edit/{result}', 'ReviewController@edit');
});
 
