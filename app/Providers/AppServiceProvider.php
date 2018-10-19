<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Market;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
            $markets = \Cache::rememberForever('markets', function () {
                return Market::with('categories')->get();
            });
            // $categories = \Cache::rememberForever('categories', function () {
            //     return Category::all();
            // });

            $view->with(compact('markets'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
