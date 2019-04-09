<?php

namespace App;

use App\Advertiser;
use App\Article;
use App\Coupon;
use App\Event;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

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
    protected $with = ['children'];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // /**
    //  * Get a string path for the category.
    //  *
    //  * @return string
    //  */
    // public function path()
    // {
    //     if ($this->parent()->exists()) {
    //         return $this->market->path() . "/{$this->parent->slug}" . "/{$this->slug}";
    //     } else
    //     return $this->market->path() . "/{$this->slug}";
    // }


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

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function articles()
    {
    	return $this->morphedByMany(Article::class, 'categoriable');
    }

    public function advertisers()
    {
        return $this->morphedByMany(Advertiser::class, 'categoriable');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function events()
    {
        return $this->morphedByMany(Event::class, 'categoriable');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The slug is generated for a subcategory from it's name, but the slug is scoped to the parent category. 
     * So Shopping can have a subcategory with the same name as Activities, but both subcats will have the same slug.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        $category = $model->parent;
        return $query->where('parent_id', $category->getKey());
    }
    
}
