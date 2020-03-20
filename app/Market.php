<?php

namespace App;

use App\Advertiser;
use App\Event;
use App\Map;
use App\MarketCategory;
use App\Page;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Storage;

class Market extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get a string path for the market.
     *
     * @return string
     */
    public function path()
    {
        return "/destinations/{$this->slug}";
    }

    /**
     * Get the brand that owns the market.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * The pages that belong to the market.
     */
    public function pages()
    {   
        return $this->hasMany(Page::class);
    }

    /**
     * The categories that belong to the market.
     */
    function categories() 
    {
        return $this->belongsToMany(Category::class, 'market_category')
        ->using(MarketCategory::class)
        ->withTimestamps();
    }

    // determines what MAIN categories show up in the top navigation
    public function navCategories()
    {
        // return $this->categories()
        //     ->whereNull('parent_id')
        //     ->whereNotIn('category_id', [5])   // NOT lodging 
        //     ->whereHas('advertisers', function (Builder $query) {
        //         $query->where('market_id', $this->id);
        //     })
        //     ->with('navSubcategories');

        // to get the categories regardless of if they have advertisers or not     
        return $this->categories()
            ->isParent()
            ->whereNotIn('category_id', [5])   // NOT lodging  
            ->with('navSubcategories');
    }

    /**
     * Get the articles for the market.
     */
    public function articles()
    {   
        return $this->hasMany(Article::class);
    }

    /**
     * Get the events for the market.
     */
    public function events()
    {   
        return $this->hasMany(Event::class);
    }

    /**
     * Get the state that the market is in.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * The users (sales reps, traffic, or distribution) that belong to the market.
     */
    public function users()
    {
        $this->belongsToMany(User::class, 'user_market');
    }

     /**
     * Get the advertisers for the market.
     */
    public function advertisers()
    {   
        return $this->hasMany(Advertiser::class);
    }

     /**
     * Get the coupons for the market.
     */
    public function coupons()
    {   
        return $this->hasMany(Coupon::class);
    }

    /**
     * Get the maps for the market.
     */
    public function maps()
    {   
        return $this->hasMany(Map::class);
    }

    /**
     * Register the media collections.
     *
     * @return array
     */
    public function registerMediaCollections()
    {
        $this
        ->addMediaCollection('cover')
        ->singleFile()
        ->registerMediaConversions(function (Media $media) {
            
            $this->addMediaConversion('full')
                ->width(600)
                ->height(934)
                ->withResponsiveImages();

            $this
                ->addMediaConversion('small')
                ->width(300)
                ->height(467)
                ->withResponsiveImages();
        });

        $this
        ->addMediaCollection('home')
        ->registerMediaConversions(function (Media $media) {
            
            $this->addMediaConversion('full')
                ->width(1440)
                ->height(900)
                ->withResponsiveImages();
        });

        $this->addMediaCollection('navImage')->singleFile();

    }

     /**
     * Get the ID for the weather widget in the nav
     *
     * @return string
     */
    public function getWeatherIdAttribute()
    {
        if ($this->code === 'BR') {
            $weatherId = '4378219';
        } elseif ($this->code === 'CG') {
            $weatherId = '4793846';
        } elseif ($this->code === 'GS') {
            $weatherId = '4588718';
        } elseif ($this->code === 'HO') {
            $weatherId = '4458391';
        } elseif ($this->code === 'OB') {
            $weatherId = '4474505';
        } elseif ($this->code === 'OC') {
            $weatherId = '4364312';
        } elseif ($this->code === 'RH') {
            $weatherId = '4144284';
        } elseif ($this->code === 'SA') {
            $weatherId = '4172131';
        } elseif ($this->code === 'SC') {
            $weatherId = '4172052';
        } elseif ($this->code === 'SM') {
            $weatherId = '4649251';
        } else $weatherId = '4791259';   // VB

        return $weatherId;
    }

    /**
     * Get the code for the weather widget on the weather page
     *
     * @return string
     */
    public function getForecast()
    {
        if ($this->code === 'BR') {
            $uid = "36d64n93d22";
            $slug = "branson";
            $data1 = "BRANSON";
        } elseif ($this->code === 'CG') {
            $uid = "37d27n76d71";
            $slug = "williamsburg";
            $data1 = "WILLIAMSBURG";
        } elseif ($this->code === 'GS') {
            $uid = "33d69n78d89";
            $slug = "myrtle-beach";
            $data1 = "MYRTLE BEACH";
        } elseif ($this->code === 'HO') {
            $uid = "35d22n75d69";
            $slug = "hatteras";
            $data1 = "HATTERAS";
        } elseif ($this->code === 'OB') {
            $uid = "35d96n75d62";
            $slug = "nags-head";
            $data1 = "NAGS HEAD";
        } elseif ($this->code === 'OC') {
            $uid = "38d34n75d08";
            $slug = "ocean-city";
            $data1 = "OCEAN CITY";
        } elseif ($this->code === 'SA') {
            $uid = "27d34n82d53";
            $slug = "sarasota";
            $data1 = "SARASOTA";
        } elseif ($this->code === 'SC') {
            $uid = "26d45n82d02";
            $slug = "sanibel";
            $data1 = "SANIBEL";
        } elseif ($this->code === 'SM') {
            $uid = "35d71n83d51";
            $slug = "gatlinburg";
            $data1 = "GATLINBURG";
        } else { $uid = "36d85n75d98";
            $slug = "virginia-beach";
            $data1 = "VIRGINIA BEACH"; 
            }

        $forecast = "<a class='weatherwidget-io' href='https://forecast7.com/en/".$uid."/".$slug."/?unit=us' data-label_1='".$data1."' data-label_2='7-DAY FORECAST' data-font='Roboto' data-theme='pure' >CURRENT WEATHER AND FORECAST</a>";

        return $forecast;
    }

    // not using but hang on to in case I need
    public function deleteCategoryImage($marketId, $categoryId) 
    {
        foreach ($this->categories as $category) {
            return $image = $category->pivot->image;
            Storage::disk('public')->delete($image);
        }
    }

    // delete attached category image files before detaching from market and market delete
    public function deleteCategoryImages($id) 
    {
        $images = [];

        foreach ($this->categories as $category) {
            $images[] = $category->pivot->image;
        }

        Storage::disk('public')->delete($images);
    }


}
