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
Route::resource('users_gestion', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/crypto_moneys', 'HomeController@crypto_moneys')->name('crypto_moneys');
Route::get('/currency_history/{currency}', 'HomeController@currency_history')->name('currency_history');
Route::get('/users_gestion', 'UsersController@index')->name('users_gestion');
Route::get('/users_gestion/create', 'UsersController@create')->name('users_gestion/create');

