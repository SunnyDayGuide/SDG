<?php

namespace App;

use App\BucketItem;
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
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class)
            ->withoutGlobalScope(MarketScope::class);
    }

    public function coupons()
    {
        return $this->morphedByMany('App\Coupon', 'bucketable')
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
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class)
            ->withoutGlobalScope(MarketScope::class);
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
            ->withTimestamps()
            ->withPivot([
                'notes',
                'completed',
            ])
            ->using(BucketItem::class)
            ->withoutGlobalScope(MarketScope::class);
    }

}
