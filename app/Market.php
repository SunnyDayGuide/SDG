<?php

namespace App;

use App\Advertiser;
use App\Event;
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
     * The relationships to always eager-load.
     * Categories should load because of navigation
     * @var array
     */
    // protected $with = ['articles'];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // not using but hang on to in case I need
    public function deleteCategoryImage($marketId, $categoryId) 
    {
        // foreach ($this->categories as $category) {
            // return $image = $category->pivot->image;
            Storage::disk('public')->delete($image);
        // }
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




    /**
     * Get a string path for the market.
     *
     * @return string
     */
    public function path()
    {
        return "/destinations/{$this->slug}";
    }


    // relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function pages()
    {   
        return $this->hasMany(Page::class);
    }

    function categories() 
    {
        return $this->belongsToMany(Category::class, 'market_category')
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

    // determines what MAIN categories show up in the top navigation
    public function navCategories()
    {
        return $this->categories()
            ->whereNull('parent_id')
            ->whereNotIn('category_id', [5])
            ->whereHas('advertisers', function (Builder $query) {
                $query->where('market_id', $this->id);
            })
            ->with('navSubcategories');
    }

    public function articles()
    {   
        return $this->hasMany(Article::class);
    }

    public function events()
    {   
        return $this->hasMany(Event::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class, 'user_market');
    }

    public function advertisers()
    {   
        return $this->hasMany(Advertiser::class);
    }

    public function coupons()
    {   
        return $this->hasMany(Coupon::class);
    }


    /**
     * Get a market's featured articles.
     *
     * @return a collection of Articles
     */
    public function getFeaturedArticles()
    {
        return $this->articles()
            ->where('featured', 1)
            ->with('tags');
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

    }




}
