<?php

namespace App\Providers;

use App\Advertiser;
use App\Category;
use App\Distributor;
use App\Market;
use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;

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
                return Market::all();
            });            

            $view->with(compact('markets'));
        });

        Attribute::typeMap([
            'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
            'boolean' => \Rinvex\Attributes\Models\Type\Boolean::class,
            'text' => \Rinvex\Attributes\Models\Type\Text::class,
        ]);

        app('rinvex.attributes.entities')->push(\App\Advertiser::class);
        app('rinvex.attributes.entities')->push(\App\Distributor::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
