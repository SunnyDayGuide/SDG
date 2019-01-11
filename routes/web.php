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
		Route::get('markets/{market}', 'DashboardController@show')->name('market');

		// Superadmin Routes (Me!)
		Route::resource('master/users', 'UserController');
		Route::resource('master/departments', 'DepartmentController');
		Route::resource('master/categories', 'CategoryController')->except(['show']);
		Route::resource('master/markets', 'MarketController');
		Route::get('master/{market}/category/create', 'MarketCategoryController@create')->name('marketCategory.create');
		Route::post('master/{market}/category', 'MarketCategoryController@store')->name('marketCategory.store');
		Route::get('master/{market}/category/{category}/edit', 'MarketCategoryController@edit')->name('marketCategory.edit');
		Route::patch('master/{market}/category/{category}', 'MarketCategoryController@update')->name('marketCategory.update');
		Route::delete('master/{market}/category/{category}', 'MarketCategoryController@destroy')->name('marketCategory.destroy');
		Route::resource('master/tags', 'TagController')->except(['show']);
		Route::resource('master/freemail-types', 'FreemailTypeController')->except(['show']);
		Route::resource('master/freemails', 'FreemailController');

		// regular admin user routes (Jackie, etc)
		Route::get('markets/{market}/articles', 'ArticleController@index')->name('articles.index');
		Route::get('markets/{market}/articles/create', 'ArticleController@create')->name('articles.create');
		Route::post('markets/{market}/articles', 'ArticleController@store')->name('articles.store');
		Route::get('markets/{market}/articles/{article}/edit', 'ArticleController@edit')->name('articles.edit');
		Route::patch('markets/{market}/articles/{article}', 'ArticleController@update')->name('articles.update');
		Route::delete('markets/{market}/articles/{article}', 'ArticleController@destroy')->name('articles.destroy');
});

// Site Routes
Route::prefix('destinations/{market}')->group(function () {
	Route::get('/', 'MarketController@show')->name('market.home');
    Route::get('articles', 'ArticleController@index')->name('articles');
	Route::get('articles/{article}', 'ArticleController@show')->name('articles.show');
	Route::get('tags/{tag}', 'TagController@show')->name('tags.show');
	Route::get('{category}', 'CategoryController@show')->name('categories.show');
	Route::get('{category}/cat/{subCategory}', 'SubCategoryController@show')->name('subcategories.show');

	Route::patch('articles/{article}/rate', 'ArticleController@rate')->name('articles.rate');
	Route::patch('articles/{article}/rateno', 'ArticleController@rateno')->name('articles.rateno');

});

