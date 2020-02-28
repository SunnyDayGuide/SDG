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
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        if (!$bucket) {
            return view('bucket-list.start', compact('market'));
        }

        $coupons = $bucket->coupons; 
        $events = $bucket->events;
        $articles = $bucket->articles;
        $shows = $bucket->shows;

        // display the each category's advertisers
        $activities = $this->getAdvertisersByCategory(1, $bucket);
        $restaurants = $this->getAdvertisersByCategory(2, $bucket);
        $shops = $this->getAdvertisersByCategory(3, $bucket);
        $entertainers = $this->getAdvertisersByCategory(4, $bucket);
        $accommodations = $this->getLodgingList($bucket); 

    	return view('bucket-list.index', compact('market', 'coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'shows', 'accommodations', 'bucket'));
    }

     /**
     * Display a printable page of the bucket items.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId); 

        $coupons = $bucket->coupons; 
        $events = $bucket->events;
        $articles = $bucket->articles;
        $shows = $bucket->shows;

        // display the each category's advertisers
        $activities = $this->getAdvertisersByCategory(1, $bucket);
        $restaurants = $this->getAdvertisersByCategory(2, $bucket);
        $shops = $this->getAdvertisersByCategory(3, $bucket);
        $entertainers = $this->getAdvertisersByCategory(4, $bucket);
        $accommodations = $this->getLodgingList($bucket); 

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
        $bucketId = Cookie::get('sunny_day_guide_bucket'); 

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
            ['uuid' => $bucketId],
            [
                'uuid' => $bucketId,
                'name' => $request['name'],
                'start_date' => $start,
                'end_date' => $end,
            ]
        );

        return response()->json([
            'bucket' => $bucket,
        ]);
    }

    public function getAdvertisersByCategory($categoryId, $bucket)
    {
        $category = Category::find($categoryId);

        $advertiserIds = $bucket->advertisers()->pluck('id');

        $advertisers = Advertiser::categorized($category)
            ->withoutGlobalScope(MarketScope::class)
            ->whereIn('id', $advertiserIds)
            ->with('locations')
            ->get();

        return $advertisers;
    }

    public function getLodgingList($bucket)
    {
        $category = Category::find(5);

        $advertiserIds = $bucket->advertisers()->pluck('id');

        $advertisers = Advertiser::categorized($category)
            ->withoutGlobalScope(MarketScope::class)
            ->whereIn('id', $advertiserIds)
            ->with('locations')
            ->get();

        $distributors = $bucket->distributors()
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
