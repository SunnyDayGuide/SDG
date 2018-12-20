<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Market extends Model
{
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
    // protected $with = ['categories'];

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

    function categories() 
    {
        return $this->belongsToMany(Category::class, 'market_category')
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

    public function articles()
    {   
        return $this->hasMany(Article::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class, 'user_market');
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

}
