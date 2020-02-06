<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Coupon;
use App\Distributor;
use App\Event;
use App\Market;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BucketListController extends Controller
{
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
    	$coupons = Coupon::whereIn('id', $this->getCookieArray('Coupon'))->get();
    	$events = Event::whereIn('id', $this->getCookieArray('Event'))->get();
    	$articles = Article::whereIn('id', $this->getCookieArray('Article'))->get();

    	// $articles = $category->getRelatedArticles($category, null, 3);

        // display the each category's advertisers
        $activities = $this->getAdvertisersByCategory(1);
        $restaurants = $this->getAdvertisersByCategory(2);
        $shops = $this->getAdvertisersByCategory(3);
        $entertainers = $this->getAdvertisersByCategory(4);
        $accommodations = $this->getLodgingList();

        $shows = Show::where('active', true)
	        ->whereIn('id', $this->getCookieArray('Show'))
	        ->get()->sortBy('sortName'); 

        // dd($restaurants);

    	return view('bucket-list.index', compact('market', 'coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'shows', 'accommodations'));
    }

    public function getCookieArray($model)
    {
    	$cookie = Cookie::get('BUCKET_'. $model);
    	return explode("+", $cookie);
    }

    public function getAdvertisersByCategory($categoryId)
    {
    	$category = Category::find($categoryId);

        $advertisers = Advertiser::categorized($category)
        	->withoutGlobalScopes()
            ->whereIn('id', $this->getCookieArray('Advertiser'))
            ->with('locations')
            ->get();

        return $advertisers;
    }

    public function getLodgingList()
    {
    	$category = Category::find(5);

    	$advertisers = Advertiser::categorized($category)
    		->withoutGlobalScopes()
            ->whereIn('id', $this->getCookieArray('Advertiser'))
            ->with('locations')
            ->get();

        $distributors = Distributor::categorized($category)
        	->withoutGlobalScopes()
        	->whereIn('id', $this->getCookieArray('Distributor'))
            ->with('locations')
            ->get();
            
        $reg_collection = collect();

        foreach ($advertisers as $advertiser)
            $reg_collection->push($advertiser);
        foreach ($distributors as $distributor)
            $reg_collection->push($distributor);

        return $reg_collection->sortBy('sortName');
    }
}
