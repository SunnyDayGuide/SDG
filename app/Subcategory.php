<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
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
     * A Subcategory belongs to a Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

     /**
     * Get all of the owning subcategoriable models.
     */
    public function subcategoriable()
    {
        return $this->morphTo();
    }

}
