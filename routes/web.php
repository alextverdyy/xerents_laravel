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
use GuzzleHttp\Client;


Route::get('/', "EventsManagerController@index");
Route::get('/event/{id}', "EventsManagerController@event");
Route::get('/filtrar', function (){
    return view("filter");
});

Route::get('/event/favorite/{id}', "EventsManagerController@favorite");
Route::get('/event/user/favorite/{id}', "EventsManagerController@isfavorited");

Route::get('favoritos',"EventsManagerController@favoriteList");

Auth::routes();

Route::get('/home', 'HomeController@index');
