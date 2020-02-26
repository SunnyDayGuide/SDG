<?php

namespace App\Http\ViewComposers;

use App\Bucket;
use App\BucketItem;
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
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        $items = BucketItem::where('bucket_id', $bucket->id)->get();

        if ($bucket) {
            $item_count = count($items);
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