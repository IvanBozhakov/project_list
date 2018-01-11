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


Route::auth();

Route::get('/', 'HomeController@index');
Route::post('add', 'ItemController@add');
Route::get('edit/{id}','ItemController@edit');
Route::post('store','ItemController@store');
Route::post('delete', 'ItemController@delete');
Route::get('paginate','HomeController@paginate');