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

// Contact Page routes
Route::get('contact', 'ContactController@create')->name('contacts.create');
Route::post('contact', 'ContactController@store')->name('contacts.store');

// Temporary routes for generating category advertiser lists
Route::get('categories', 'CategoryController@all');
Route::get('categories/{market}', 'CategoryController@index')->name('category-list');

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

	/*
	|--------------------------------------------------------------------------
	| Article Routes
	|--------------------------------------------------------------------------
	| Explicit here with article type slugs. If we add a new article type, we will need to add a new route
	| If we change the article type's name, we should also update the route 
	*/
    Route::get('trip-ideas', 'ArticleController@index')->name('articles');
	Route::get('trip-ideas/search', 'ArticleController@search')->name('articles.search');
	Route::get('trip-ideas/{article}', 'ArticleController@show')->name('articles.show');
	Route::get('visitor-info', 'ArticleController@visitorInfo')->name('visitor-info');
	Route::get('visitor-info/{article}', 'ArticleController@show')->name('articles.show');
	Route::get('advertiser-spotlights/{article}', 'ArticleController@show')->name('articles.show');
	Route::get('tide-charts', 'ArticleController@tideCharts')->name('tide-charts');

	Route::patch('articles/{article}/rate', 'ArticleController@rate')->name('articles.rate');
	Route::patch('articles/{article}/rateno', 'ArticleController@rateno')->name('articles.rateno');
	// Route::patch('articles/{article}/rateno', 'ArticleRatingController@store')->name('articles.rate');
	
	// Other Page Routes
	Route::get('events', 'EventController@index')->name('events');
	Route::get('events/submit', 'EventController@create')->name('events.create');
	Route::post('events/submit', 'EventController@store')->name('events.store');
	Route::get('coupons', 'CouponController@index')->name('coupons');
	Route::get('weather', 'PageController@weather')->name('weather');

	// Lead Generating Routes
	Route::get('vacation-guide', 'LeadController@create')->name('vacation-guide.create');
	Route::get('vacation-guide/view', 'VacationGuideController@show')->name('vacation-guide.show');
	Route::get('request-information', 'LeadController@create')->name('request-information.create');
	Route::get('request-information/thanks', 'LeadController@show')->name('request-information.show');
	Route::post('leads', 'LeadController@store')->name('leads.store');

	// Tag Routes
	Route::get('tags/{tag}', 'TagController@show')->name('tags.show');

	// Advertiser/Distributor Routes
	Route::get('places/{place}', 'PlaceController@show')->name('places.show');
 	Route::get('places/{advertiser}/print', 'PrintController@allCoupons')->name('print.all');
	Route::get('places/{advertiser}/print/{coupon}', 'PrintController@singleCoupon')->name('print.single');

	// Show Schedule Routes
	Route::get('shows/{show}', 'ShowController@show')->name('shows.show');

	// Category Routes - leave last for double parameters
	Route::get('{category}', 'CategoryController@show')->name('categories.show');
	Route::get('{category}/search', 'CategoryController@search')->name('categories.search');
	Route::get('{category}/{subcategory}', 'SubcategoryController@show')->name('subcategories.show');

});

