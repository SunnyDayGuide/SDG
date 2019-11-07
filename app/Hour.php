<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\OpeningHours\OpeningHours;

class Hour extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['range'];

    public function advertiser()
    {
        return $this->belongsTo('App\Advertiser');
    }

    public function getRangeAttribute()
    {
        return "{$this->open}-{$this->close}";
    }


}
