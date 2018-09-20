<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Category extends Model
{
	function markets() {
        return $this->belongsToMany(Market::class)
        ->withPivot('title', 'body', 'image', 'meta_title', 'meta_description')
        ->withTimestamps();
    }

        public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
