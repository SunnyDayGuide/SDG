<?php

namespace App;

use App\Scopes\MarketScope;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new MarketScope);
    }
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
    protected $with = ['articleType', 'market'];

	protected $dates = [
	    'created_at',
	    'updated_at',
	    'published_at'
	];

    // public function scopeMarkets($query, $market)
    // {
    //     return $query->where('slug', $market);
    // }

	/**
     * Get a string path for the article.
     *
     * @return string
     */
    public function path()
    {
        return $this->market->path() . "/articles/{$this->slug}";
    }

    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * An article belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
    }

    /**
     * An article type is assigned to an article
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articleType()
    {
    	return $this->belongsTo(ArticleType::class)->orderBy('order');
    }

}
