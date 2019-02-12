<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The advertsiers that belong to the location.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class);
    }
}
