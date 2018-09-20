<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
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
 * Determine if the market has the given category.
 *
 * @param mixed $category
 * @return boolean
 */
 public function hasCategory($category)
 {
    // Assuming your category model has a 'name' field on it
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
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/{$this->slug}";
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

    function categories() {
        return $this->belongsToMany(Category::class)
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
