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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('orders', 'OrderController', ['except' => [
    'show', 'destroy', 'create', 'store'
]]);
Route::prefix('orders')->as('orders.')->group(function () {
    Route::get('all', 'OrderController@getAll')->name('all');
    Route::get('past-due', 'OrderController@getPastDue')->name('past.due');
    Route::get('current', 'OrderController@getCurrent')->name('current');
    Route::get('new', 'OrderController@getNew')->name('new');
    Route::get('completed', 'OrderController@getCompleted')->name('completed');
});

Route::get('weather', 'WeatherController@index')->name('weather.index');

Route::prefix('products')->as('products.')->group(function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::post('{product}/update', 'ProductController@update')->name('update');
});
