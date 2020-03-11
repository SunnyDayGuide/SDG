<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Bucket;
use App\Category;
use App\Coupon;
use App\Distributor;
use App\Event;
use App\Market;
use App\Scopes\MarketScope;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class BucketListController extends Controller
{
    /**
     * Display a listing of the bucket items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        // See if a bucket cookie value is coming from email
        if (request('cookie')) {
            $cookieValue = request('cookie');

            // set cookie with bucket value from email
             Cookie::queue('sunny_day_guide_bucket', $cookieValue, 525600);
        } 
        // Otherwise grab the existing cookie value
        else $cookieValue = Cookie::get('sunny_day_guide_bucket');

        $bucket = Bucket::firstWhere('uuid', $cookieValue);

        if (!$bucket) {
            return view('bucket-list.start', compact('market'));
        }

        $coupons = $bucket->coupons; 
        $events = $bucket->events;
        $articles = $bucket->articles;
        $shows = $bucket->shows;

        // display the each category's advertisers
        $advertiserIds = $bucket->advertisers()->pluck('id');
        
        $activities = $bucket->getAdvertisersByCategory(1, $advertiserIds);
        $restaurants = $bucket->getAdvertisersByCategory(2, $advertiserIds);
        $shops = $bucket->getAdvertisersByCategory(3, $advertiserIds);
        $entertainers = $bucket->getAdvertisersByCategory(4, $advertiserIds);
        $accommodations = $bucket->getLodgingList(); 

    	return view('bucket-list.index', compact('market', 'coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'shows', 'accommodations', 'bucket'));
    }

     /**
     * Display a printable page of the bucket items.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $cookieValue = Cookie::get('sunny_day_guide_bucket'); 
        $bucket = Bucket::firstWhere('uuid', $cookieValue);

        $coupons = $bucket->coupons; 
        $events = $bucket->events;
        $articles = $bucket->articles;
        $shows = $bucket->shows;

        // display the each category's advertisers
        $advertiserIds = $bucket->advertisers()->pluck('id');

        $activities = $bucket->getAdvertisersByCategory(1, $advertiserIds);
        $restaurants = $bucket->getAdvertisersByCategory(2, $advertiserIds);
        $shops = $bucket->getAdvertisersByCategory(3, $advertiserIds);
        $entertainers = $bucket->getAdvertisersByCategory(4, $advertiserIds);
        $accommodations = $bucket->getLodgingList(); 

        return view('bucket-list.print', compact('coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'accommodations', 'shows', 'bucket'));        
    }

    /**
     * Create or update the bucket list in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cookieValue = Cookie::get('sunny_day_guide_bucket'); 

        $validatedData = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        // convert from js date
        if ($validatedData['start_date']) {
            $start = Carbon::parse($validatedData['start_date']);
        } else $start = NULL;

        if ($validatedData['end_date']) {
            $end = Carbon::parse($validatedData['end_date']);
        } else $end = NULL;

        // update the bucket if it exists or make a new one
        $bucket = Bucket::updateOrCreate(
            ['uuid' => $cookieValue],
            [
                'uuid' => $cookieValue,
                'name' => $request['name'],
                'start_date' => $start,
                'end_date' => $end,
            ]
        );

        return response()->json([
            'bucket' => $bucket,
        ]);
    }

}
