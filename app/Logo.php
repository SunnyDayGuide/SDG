<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

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


}
