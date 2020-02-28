<?php

namespace App;

use App\Scopes\MarketScope;
use App\Traits\Bucketable;
use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Coupon extends Model implements HasMedia
{
	use HasMediaTrait;
    use Marketable;
    use Bucketable;

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketScope);

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', true);
        });
    }

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A coupon belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	return $this->belongsTo(Category::class)->where('parent_id', null);
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


    public function getBarcodeSVGAttribute()
    {
        $code = DNS1D::getBarcodeSVG($this->barcode, $this->barcode_type, 2,50, 'black', true);
        return $code;
    }

}
