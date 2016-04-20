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

Route::get('/code', function () {
	QrCode::size(300);
	return QrCode::generate('Make me into a QrCode!');
    return 'ok';
});


Route::get('/', 'ApplicationController@index');
Route::post('/apply', 'ApplicationController@apply');
Route::get('/all', 'ApplicationController@prijave');
Route::get('/izvuci', 'ApplicationController@izvuci');

Route::get('/success', function () {
	return 'Uspješnos te se prijavili';
});

Route::get('/test1', function () {
    return 'test';
});

Route::auth();

Route::get('/home', 'HomeController@index');
