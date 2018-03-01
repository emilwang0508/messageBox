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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/message', 'HomeController@message')->name('message');
Route::post('/reply', 'HomeController@reply')->name('reply');
Route::post('/replies', 'HomeController@replies')->name('replies');
Route::post('/like', 'HomeController@like')->name('like');
Route::post('/oppose', 'HomeController@oppose')->name('oppose');
Route::post('/msgSort', 'HomeController@msgSort');