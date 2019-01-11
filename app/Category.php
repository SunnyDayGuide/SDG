<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * Get all of the owning categoriable models.
     */
    public function categoriable()
    {
        return $this->morphTo();
    }

   public function markets() 
   {
        return $this->belongsToMany(Market::class, 'market_category')
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

    public function articles()
    {
    	return $this->morphedByMany(Article::class, 'categoriable');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    
}
