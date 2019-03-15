<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Coupon extends Model implements HasMedia
{
	use HasMediaTrait;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['market', 'media', 'category'];

    /**
     * A coupon belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
    }

    /**
     * A coupon belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	return $this->belongsTo(Category::class)->where('parent_id', !null);
    }

     /**
     * A coupon has (belongs to) a logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logo()
    {
    	return $this->belongsTo(Logo::class);
    }

}
