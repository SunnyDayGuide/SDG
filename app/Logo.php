<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Logo extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * Get the advertisers that have this logo.
     */
    public function advertisers()
    {
        return $this->hasMany(Advertiser::class);
    }

    /**
     * Get the coupons that have this logo.
     */
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(100);
    }

     /**
     * Register the media collections.
     *
     * @return array
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('logo')->singleFile();
    }


}
