<?php

namespace App\Traits;

use App\Category;

trait Categoriable {
	/**
     * Categories can be assigned
     */
    public function assignCategory($category)
    {
        return $this->categories()->attach($category);
    }

    /**
     * Get all of the model's categories.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable')->withTimestamps();
    }
}