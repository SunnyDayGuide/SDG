<?php

namespace App\Providers;

use App\Advertiser;
use App\Article;
use App\Distributor;
use App\Scopes\MarketScope;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function() {
            Event::listen('eloquent.booted: App\Advertiser', function($rating) {
                Log::info('advertiser booted ' . request()->url());
                Advertiser::withoutGlobalScope(MarketScope::class);
            });
            Event::listen('eloquent.booted: App\Distributor', function($rating) {
                Log::info('distributor booted ' . request()->url());
                Distributor::withoutGlobalScope(MarketScope::class);
            });
            Event::listen('eloquent.booted: App\Article', function($rating) {
                Log::info('article booted ' . request()->url());
                Article::withoutGlobalScopes([
                    MarketScope::class, 'published'
                ]);
            });
            Event::listen('eloquent.booted: App\Event', function($rating) {
                Log::info('event booted ' . request()->url());
                \App\Event::withoutGlobalScope(MarketScope::class);
            });
        });

        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'meredith@sunnydayguide.com',
                'icehouze@gmail.com',
            ]);
        });

        // use after installing permissions stuff
        // Gate::define('viewNova', function ($user) {
        //     return $user->hasRole('admin');
        // });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Eminiarts\NovaPermissions\NovaPermissions(),
        ];
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
