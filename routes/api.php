<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', 'UserController@check');

/*Route::get('/userTrack', function(){
	return 11;
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
});*/