<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Market' => 'App\Policies\MarketPolicy',
        'App\Brand' => 'App\Policies\MarketPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\Page' => 'App\Policies\PagePolicy',
        'App\MarketCategory' => 'App\Policies\PagePolicy',
        'App\Advertiser' => 'App\Policies\AdvertiserPolicy',
        'App\Logo' => 'App\Policies\LogoPolicy',
        'App\Level' => 'App\Policies\DisplayLevelPolicy',
        'App\Location' => 'App\Policies\LocationPolicy',
        'App\Hour' => 'App\Policies\LocationPolicy',
        'App\Article' => 'App\Policies\ArticlePolicy',
        'App\ArticleType' => 'App\Policies\ArticleTypePolicy',
        'App\Distributor' => 'App\Policies\DistributorPolicy',
        'App\CustomTag' => 'App\Policies\TagPolicy',
        'App\Show' => 'App\Policies\ShowSchedulePolicy',
        'App\Theater' => 'App\Policies\ShowSchedulePolicy',
        'App\Gadget' => 'App\Policies\ShowSchedulePolicy',
        'App\Freemail' => 'App\Policies\FreemailPolicy',
        'App\FreemailType' => 'App\Policies\FreemailPolicy',
        'App\Lead' => 'App\Policies\LeadPolicy',
        'App\Attribute' => 'App\Policies\AttributePolicy',
        'App\AttributeEntity' => 'App\Policies\AttributePolicy',
        'App\Normal' => 'App\Policies\AttributePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
