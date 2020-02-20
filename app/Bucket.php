<?php

namespace App;

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
        return $this->morphedByMany('App\Advertiser', 'bucketable');
    }

    public function coupons()
    {
        return $this->morphedByMany('App\Coupon', 'bucketable');
    }

    public function distributors()
    {
        return $this->morphedByMany('App\Distributor', 'bucketable');
    }

    public function shows()
    {
        return $this->morphedByMany('App\Show', 'bucketable');
    }

    public function events()
    {
        return $this->morphedByMany('App\Event', 'bucketable');
    }

    public function articles()
    {
        return $this->morphedByMany('App\Article', 'bucketable');
    }

}
