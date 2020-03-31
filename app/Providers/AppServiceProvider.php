<?php

namespace App\Providers;

use App\Advertiser;
use App\Bucket;
use App\Category;
use App\Distributor;
use App\Market;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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

            if (Cookie::has('sunny_day_guide_bucket')) {
                $bucketId = Cookie::get('sunny_day_guide_bucket');
            } else $bucketId = null;

            $view->with(compact('markets', 'bucketId'));
        });

        Attribute::typeMap([
            'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
            'boolean' => \Rinvex\Attributes\Models\Type\Boolean::class,
            'text' => \Rinvex\Attributes\Models\Type\Text::class,
            'integer' => \Rinvex\Attributes\Models\Type\Integer::class,
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
        // app('config')->set('rinvex.attributes.autoload_migrations',false);
        
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
