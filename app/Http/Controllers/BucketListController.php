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

        // $coupons = $bucket->coupons;
    	$coupons = Coupon::whereIn('id', $this->getCookieArray('Coupon'))->get();
    	$events = Event::whereIn('id', $this->getCookieArray('Event'))->get();
    	$articles = Article::whereIn('id', $this->getCookieArray('Article'))->get();

        // display the each category's advertisers
        $activities = $this->getAdvertisersByCategory(1);
        $restaurants = $this->getAdvertisersByCategory(2);
        $shops = $this->getAdvertisersByCategory(3);
        $entertainers = $this->getAdvertisersByCategory(4);
        $accommodations = $this->getLodgingList();

        $shows = Show::where('active', true)
	        ->whereIn('id', $this->getCookieArray('Show'))
	        ->get()->sortBy('sortName'); 

        if (request()->wantsJson()) {
            return response()->json([
                'entertainers' => $entertainers,
                'activities' => $activities
            ]);
        }

    	return view('bucket-list.index', compact('market', 'coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'shows', 'accommodations', 'bucket'));
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

    public function store(Request $request)
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket'); 

        $validatedData = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        // convert from js date
        $start = Carbon::parse($validatedData['start_date']);
        $end = Carbon::parse($validatedData['end_date']);

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

    public function update(Request $request)
    {  
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        $validatedData = $request->validate([
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        $bucket->update(request([
            'name', 'start_date', 'end_date'
        ]));

        return response('ok');
    }

    public function addItem(Request $request)
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstOrCreate(['uuid' => $bucketId]);

        if ($request->class == 'Advertiser') {
            $bucket->advertisers()->attach($request->id);
        }

        if ($request->class == 'Distributor') {
            $bucket->distributors()->attach($request->id);
        }

        if ($request->class == 'Show') {
            $bucket->shows()->attach($request->id);
        }

        if ($request->class == 'Coupon') {
            $bucket->coupons()->attach($request->id);
        }

        if ($request->class == 'Event') {
            $bucket->events()->attach($request->id);
        }

         if ($request->class == 'Article') {
            $bucket->articles()->attach($request->id);
        }

        return response('ok');
    }

    public function removeItem(Request $request)
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        if ($request->class == 'Advertiser') {
            $bucket->advertisers()->detach($request->id);
        }

        if ($request->class == 'Distributor') {
            $bucket->distributors()->detach($request->id);
        }

        if ($request->class == 'Show') {
            $bucket->shows()->detach($request->id);
        }

        if ($request->class == 'Coupon') {
            $bucket->coupons()->detach($request->id);
        }

        if ($request->class == 'Event') {
            $bucket->events()->detach($request->id);
        }

         if ($request->class == 'Article') {
            $bucket->articles()->detach($request->id);
        }

        return response('ok');
    }
    
}
