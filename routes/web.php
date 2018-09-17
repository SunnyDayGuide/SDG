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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/', 'MarketController@index')->name('home');
Route::get('{market}', 'MarketController@show');

Route::get('articles', 'ArticleController@index')->name('articles');
Route::get('articles/{id}', 'ArticleController@show');
