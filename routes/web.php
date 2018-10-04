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

// Home Page route
Route::get('/', 'PageController@home')->name('home');

// Admin Dashboard Routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
	Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
	Route::resource('markets', 'Admin\MarketController');
	Route::resource('categories', 'Admin\CategoryController')->except(['show']);
	Route::get('markets/{market}/category/{category}/edit', 'Admin\MarketController@editMarketCategory')->name('marketCategories.edit');
	Route::patch('markets/{market}/category/{category}', 'Admin\MarketController@updateMarketCategory')->name('marketCategories.update');
});

// Site Routes
Route::prefix('{market}')->group(function () {
	Route::get('/', 'MarketController@show')->name('market.home');
    Route::get('articles', 'ArticleController@index')->name('articles');
	Route::get('articles/{article}', 'ArticleController@show');

});

