<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTag extends \Spatie\Tags\Tag
{
	protected $table = 'tags';

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug->en';
    }
}
