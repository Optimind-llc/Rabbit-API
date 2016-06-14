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

$api = app('Dingo\Api\Routing\Router');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');


// Publicly accessible routes
$api->version('v1', [], function ($api) {
    $api->get('/front', 'App\Http\Controllers\PagesController@front');

    $api->post('/signup', 'App\Http\Controllers\User\Auth\AuthController@signup');
    $api->post('/signin', 'App\Http\Controllers\User\Auth\AuthController@signin');
    $api->post('/refresh', 'App\Http\Controllers\User\Auth\AuthController@refresh');
});

// JWT Protected routes
$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('/show', 'App\Http\Controllers\PagesController@show');
    $api->get('/decode', 'App\Http\Controllers\PagesController@decode');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

	Route::group(['namespace' => 'Auth'], function () {

	    Route::group(['middleware' => 'auth:admin'], function () {
	        Route::get('signout', 'AuthController@signout');
	        Route::post('password/change', 'PasswordController@changePassword');
	    });

	    Route::group(['middleware' => 'guest:admin'], function () {
	        // Authentication Routes
	        Route::get('signin', 'AuthController@showLoginForm');
	        Route::post('signin', 'AuthController@login');

	        // Registration Routes
	        Route::get('signup', 'AuthController@showRegistrationForm');
	        Route::post('register', 'AuthController@register');

	        // Password Reset Routes
	        Route::get('password/reset/{token?}', 'PasswordController@showResetForm');
	        Route::post('password/email', 'PasswordController@sendResetLinkEmail');
	        Route::post('password/reset', 'PasswordController@reset');
	    });
	});
});