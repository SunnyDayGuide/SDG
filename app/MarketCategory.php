<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class MarketCategory extends Pivot implements HasMedia
{
	use HasMediaTrait;

    /**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = true;

    public function market()
    {
        return $this->belongsTo('App\Market');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

	 /**
     * Register the media collections.
     *
     * @return array
     */
    public function registerMediaCollections()
    {
        $this
        ->addMediaCollection('slider')
        ->registerMediaConversions(function (Media $media) {
            
            $this->addMediaConversion('full')
                ->withResponsiveImages();

            $this
                ->addMediaConversion('card')
                ->crop(Manipulations::CROP_CENTER, 382, 203)
                ->withResponsiveImages();

            $this
                ->addMediaConversion('sm-card')
                ->crop(Manipulations::CROP_CENTER, 260, 334)
                ->withResponsiveImages();
        });
    }


}
