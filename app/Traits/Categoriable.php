<?php

namespace App\Traits;

use App\Category;

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
    // public function subcategories()
    // {
    //     return $this->morphToMany(Category::class, 'categoriable')
    //         ->where('parent_id', !null)
    //         ->withTimestamps();
    // }

     /**
     * Get just the model's SUPER categories (Act, Dining, Shop).
     */
    public function supercategories()
    {
        return $this->morphToMany(Category::class, 'categoriable')
            ->where('parent_id', null)
            ->withTimestamps();
    }


}