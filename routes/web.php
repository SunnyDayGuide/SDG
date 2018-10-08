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
Route::prefix('admin')
	->name('admin.')
	->namespace('Admin')
	->group(function () {
		Route::get('/', 'DashboardController@index')->name('home');
		Route::resource('markets', 'MarketController');
		Route::resource('categories', 'CategoryController')->except(['show']);
		Route::get('markets/{market}/category/create', 'MarketCategoryController@create')->name('marketCategory.create');
		Route::post('markets/{market}/category', 'MarketCategoryController@store')->name('marketCategory.store');
		Route::get('markets/{market}/category/{category}/edit', 'MarketCategoryController@edit')->name('marketCategory.edit');
		Route::patch('markets/{market}/category/{category}', 'MarketCategoryController@update')->name('marketCategory.update');
		Route::delete('markets/{market}/category/{category}', 'MarketCategoryController@destroy')->name('marketCategory.destroy');
});

// Site Routes
Route::prefix('{market}')->group(function () {
	Route::get('/', 'MarketController@show')->name('market.home');
    Route::get('articles', 'ArticleController@index')->name('articles');
	Route::get('articles/{article}', 'ArticleController@show');

});

