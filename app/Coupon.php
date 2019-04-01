<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;
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
    protected $with = ['market', 'media', 'category', 'advertisers'];

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
     * A coupon belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    /**
     * The advertisers that belong to the coupon.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class);
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

    /**
     * Scope a query to only include active coupons.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

        /**
     * Register the media collections.
     *
     * @return array
     */
    public function registerMediaCollections()
    {
        // may not need this anymore. Keep for now.
        $this
        ->addMediaCollection('logo')
        ->singleFile()
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('full')
            ->withResponsiveImages();
        });
    }

    public function getBarcodeSVGAttribute()
    {
        $code = DNS1D::getBarcodeSVG($this->barcode, $this->barcode_type, 2,50, 'black', true);
        return $code;
    }

}
