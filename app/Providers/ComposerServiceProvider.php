<?php

namespace App\Providers;

use App\Http\ViewComposers\FooterViewComposer;
use App\Http\ViewComposers\NavigationViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', NavigationViewComposer::class);
        view()->composer('partials._prefooter', FooterViewComposer::class);
    }
}
