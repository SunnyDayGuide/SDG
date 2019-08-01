<?php

namespace App\Traits;

use App\Category;
use Illuminate\Database\Eloquent\Builder;

trait Categoriable {
	/**
     * Categories can be assigned
     */
    public function assignCategories($categories)
    {
        return $this->categories()->sync($categories);
    }

    /**
     * Get ALL of the model's supercategories and subcategories.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable')
            ->withTimestamps();
    }


    /**
     * Get just the model's subcategories (Waterports, Food & Drink).
     */
    public function subcategories()
    {
        return $this->morphToMany(Category::class, 'categoriable')
            ->whereNotNull('parent_id')
            ->withTimestamps();
    }

     /**
     * Get just the model's SUPER categories (Act, Dining, Shop).
     */
    public function supercategories()
    {
        return $this->morphToMany(Category::class, 'categoriable')
            ->whereNull('parent_id')
            ->withTimestamps();
    }

    /**
     * A recursive scope to include all models that are related to a parent category via its children
     * ie: Activities list includes all Act subcats without having to attach the Act category to the model
     */
    public function scopeCategorized($query, Category $category=null) {
        if ( is_null($category) ) return $query->with('categories');

        // get subcat ids
        $categoryIds = $category->children()->pluck('id');

        // add current cat id to the array
        $categoryIds[] = $category->getKey();

        return $this->whereHas('categories', function (Builder $query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            });
    }


}