<?php

namespace App;

use App\Advertiser;
use App\BucketItem;
use App\Category;
use App\Scopes\MarketScope;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    /**
     * Get all of the owning bucketable models.
     */
    public function advertisers()
    {
        return $this->morphedByMany('App\Advertiser', 'bucketable')
            ->withoutGlobalScope(MarketScope::class)
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function coupons()
    {
        return $this->morphedByMany('App\Coupon', 'bucketable')
            ->withoutGlobalScope(MarketScope::class)
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function distributors()
    {
        return $this->morphedByMany('App\Distributor', 'bucketable')
            ->withoutGlobalScope(MarketScope::class)
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function shows()
    {
        return $this->morphedByMany('App\Show', 'bucketable')
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function events()
    {
        return $this->morphedByMany('App\Event', 'bucketable')
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function articles()
    {
        return $this->morphedByMany('App\Article', 'bucketable')
            ->withoutGlobalScope(MarketScope::class)
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class);
    }

    public function items()
    {
        $items = collect([$this->advertisers, $this->coupons, $this->events, $this->articles, $this->shows])->collapse(); 

        return $items;
    }

    public function getAdvertisersByCategory($categoryId, $advertiserIds = [])
    {
        $category = Category::find($categoryId);

        $advertisers = Advertiser::categorized($category)
            ->withoutGlobalScope(MarketScope::class)
            ->whereIn('id', $advertiserIds)
            ->with('locations', 'market')
            ->get();

        return $advertisers;
    }
    
    public function getLodgingList()
    {
        $category = Category::find(5);

        $advertiserIds = $this->advertisers()->pluck('id');

        $advertisers = Advertiser::categorized($category)
            ->withoutGlobalScope(MarketScope::class)
            ->whereIn('id', $advertiserIds)
            ->with('locations')
            ->get();

        $distributors = $this->distributors()
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
