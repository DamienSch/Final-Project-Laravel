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

Route::get('/crypto_moneys', 'HomeController@crypto_moneys')->name('crypto_moneys');
Route::get('/currency_history/{currency}', 'HomeController@currency_history')->name('currency_history');
Route::get('/account_management', 'UsersController@editPersonalData')->name('account_management');
Route::get('/update_account', 'UsersController@showPersonalData')->name('update_account');
Route::post('/updated_account', array('uses' => 'UsersController@updateAccount'))->name('updated_account');
Route::post('/sellTransaction', array('uses' => 'TransactionController@sellTransaction'))->name('sellTransaction');

Route::group(['middleware' => ['auth' => 'CheckAdmin']], function () {
    Route::get('/users_gestion', 'UsersController@index')->name('users_gestion');
    Route::get('/users_gestion/create', 'UsersController@create')->name('users_gestion/create');
});
Route::group(['middleware' => ['auth' => 'CheckClient']], function () {
    Route::get('/home', 'TransactionController@index')->name('home');
    Route::get('/transaction/buy/{currency}', 'TransactionController@create')->name('transaction.create');
    Route::post('/transaction/buy', array('uses' => 'TransactionController@store'));
});

