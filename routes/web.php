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

Auth::routes();

Route::get('/', 'PageController@home')->name('home');

Route::get('/articles', 'ArticleController@index');

// Admin Dashboard Routes
Route::get('dashboard', 'HomeController@index')->name('dashboard');

Route::name('dashboard.')->group(function () {
	Route::resource('dashboard/markets', 'Admin\MarketController');
	Route::resource('dashboard/categories', 'Admin\CategoryController')->except(['show']);
});

Route::get('dashboard/markets/{marketId}/category/{categoryId}/edit', 'Admin\MarketController@editMarketCategory');
Route::patch('dashboard/markets/{marketId}/category/{categoryId}', 'Admin\MarketController@updateMarketCategory');

// Site Routes
Route::prefix('{market}')->group(function () {
	Route::get('/', 'MarketController@show');

    Route::get('articles', 'ArticleController@index');
	Route::get('articles/{article}', 'ArticleController@show');

});

