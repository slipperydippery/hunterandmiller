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

Route::get('/', ['as' => 'home', 'uses' => 'PageController@home']);
Route::get('portfolio', ['as' => 'portfolio', 'uses' => 'PageController@portfolio']);
Route::get('process', ['as' => 'process', 'uses' => 'PageController@process']);
Route::get('overons', ['as' => 'overons', 'uses' => 'PageController@overons']);
Route::get('contact', ['as' => 'contact', 'uses' => 'PageController@contact']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::resource('pages', 'PageController');