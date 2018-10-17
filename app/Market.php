<?php

namespace App;

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
 * Determine if the market has the given category.
 *
 * @param mixed $category
 * @return boolean
 */
 public function hasCategory($category)
 {
    // If you pass a category 'name' in, check by 'name'
    if (is_string($category)) {
        return $this->categories->contains('name', $category);
    }
    
    // If you pass a category id in, check by id
    if (is_numeric($category)) {
        return $this->categories->contains('id', $category);
    }
    
    // If you pass a Category object in, compare each of your category's id to this one's
    foreach ($this->category as $market_category) {
        if ($market_category->id == $category->id) {
            return true;
        }
    }
    
    // If nothing matched, return false
    return false;
 }


    /**
     * Get a string path for the market.
     *
     * @return string
     */
    public function path()
    {
        return "/{$this->slug}";
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

    public function getFeaturedArticles()
    {
        return $this->articles()
            ->where('featured', 1)
            ->get();
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
