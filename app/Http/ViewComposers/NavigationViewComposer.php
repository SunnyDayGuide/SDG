<?php

namespace App\Http\ViewComposers;

use App\Bucket;
use App\Category;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class NavigationViewComposer
{
	private $market;

    public function __construct(Market $market)
    {
         $this->market = Market::find($this->getMarket());
    }

    public function compose(View $view) 
    {
        $market = $this->market;
    	$navCategories =  $this->market->navCategories;

        $navArticles =  $this->market->articles()
            ->where('featured', 1)
            ->orderBy('updated_at', 'desc')->take(4)->get();

        $featuredArticle = $navArticles->first();

        $navEvents =  $this->market->events()->current()->active()
            ->orderBy('start_date', 'asc')
            ->take(4)->get();

        // Get initial bucket list item total count
        $bucketId = Cookie::get('sunny_day_guide_bucket');

        $buckets = Bucket::withCount('advertisers', 'coupons', 'shows', 'events', 'articles', 'distributors')->get();
        $bucket = $buckets->where('uuid', $bucketId)->first();

        if ($bucket) {
            $item_count = collect([
                $bucket->advertisers_count, 
                $bucket->coupons_count, 
                $bucket->shows_count,
                $bucket->events_count,
                $bucket->articles_count,
                $bucket->distributors_count
            ])->sum();
        } else $item_count = 0;

        $view->with(compact('navCategories', 'navArticles', 'featuredArticle', 'navEvents', 'market', 'item_count'));
    }

    // find the current market
    public function getMarket()
    {
        $currentRoute = Route::current();
        $params = $currentRoute->parameters;

        $market = $params['market']['id'];

        return $market;
    }
}