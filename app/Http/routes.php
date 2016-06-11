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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

$api = app('Dingo\Api\Routing\Router');

// Publicly accessible routes
$api->version('v1', [], function ($api) {
    $api->get('/front', 'App\Http\Controllers\PagesController@front');
    $api->get('/front2', 'App\Http\Controllers\PagesController@front2');
 
});

// JWT Protected routes
$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('/back', 'App\Http\Controllers\PagesController@back');
});