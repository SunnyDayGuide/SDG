<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
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

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
