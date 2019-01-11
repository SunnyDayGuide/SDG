<?php

namespace App\Traits;

use App\Category;
use App\Subcategory;

trait Categoriable {
	/**
     * Categories can be assigned
     */
    public function assignCategories($categories)
    {
        return $this->categories()->sync($categories);
    }

    /**
     * Get all of the model's categories.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable')->withTimestamps();
    }

    /**
     * Get all of the model's subcategories.
     */
    public function subcategories()
    {
        return $this->morphToMany(Subcategory::class, 'subcategoriable')->withTimestamps();
    }    
}