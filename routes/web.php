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
		Route::get('{market}', 'DashboardController@show')->name('market');

		// Superadmin Routes (Me!)
		Route::resource('super/categories', 'CategoryController')->except(['show']);
		Route::resource('super/markets', 'MarketController');
		Route::get('master/markets/{market}/category/create', 'MarketCategoryController@create')->name('marketCategory.create');
		Route::post('master/markets/{market}/category', 'MarketCategoryController@store')->name('marketCategory.store');
		Route::get('master/markets/{market}/category/{category}/edit', 'MarketCategoryController@edit')->name('marketCategory.edit');
		Route::patch('master/markets/{market}/category/{category}', 'MarketCategoryController@update')->name('marketCategory.update');
		Route::delete('master/markets/{market}/category/{category}', 'MarketCategoryController@destroy')->name('marketCategory.destroy');

		// regular admin user routes (Jackie, etc)
		Route::get('{market}/articles', 'ArticleController@index')->name('articles.index');
		Route::get('{market}/articles/create', 'ArticleController@create')->name('articles.create');
		Route::post('{market}/articles', 'ArticleController@store')->name('articles.store');
		Route::get('{market}/articles/{article}/edit', 'ArticleController@edit')->name('articles.edit');
		Route::patch('{market}/articles/{article}', 'ArticleController@update')->name('articles.update');
});

// Site Routes
Route::prefix('{market}')->group(function () {
	Route::get('/', 'MarketController@show')->name('market.home');
    Route::get('articles', 'ArticleController@index')->name('articles');
	Route::get('articles/{article}', 'ArticleController@show');
	Route::get('{category}', 'CategoryController@show');

});

