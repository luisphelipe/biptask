<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function() { return view('index'); });

    // API a partir daqui
    Route::get('/query', 'QueryController@query');

    Route::get('/tag', 'TagController@index');
    Route::post('/tag', 'TagController@store');
    Route::delete('/tag/{tag}', 'TagController@destroy');

    Route::get('/message', 'MessageController@index');
    Route::get('/message/{qnt}', 'MessageController@show');
    Route::delete('/message/{message}', 'MessageController@destroy');
});