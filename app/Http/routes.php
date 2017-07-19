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
Route::get('panel', 'TestController@panel')->name('panel');
Route::get('connect', 'TestController@connect')->name('connect');
Route::get('compains/{login}', 'TestController@getCompains')->name('compains');
Route::get('subclients', 'TestController@getSubClients')->name('subclients');