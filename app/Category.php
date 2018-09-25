<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Category extends Model
{
	/**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

	function markets() {
        return $this->belongsToMany(Market::class, 'market_category')
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

        public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
