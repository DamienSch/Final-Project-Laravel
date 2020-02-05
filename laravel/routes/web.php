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

Route::get('/', 'PageController@homePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/crypto_moneys', 'HomeController@crypto_moneys')->name('crypto_moneys');
Route::get('/bitcoin_history/{currency}', 'HomeController@bitcoin_history')->name('bitcoin_history');
Route::get('/users_gestion', 'HomeController@users_gestion')->name('users_gestion');

