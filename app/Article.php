<?php

namespace App;

use App\Category;
use App\Market;
use App\Scopes\MarketScope;
use App\Traits\Categoriable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Article extends Model
{
    use Categoriable;
    use HasTags;
    
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function ($builder) {
            $builder->where('archived', false);
        });
    }

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

        /**
     * Attributes to cast.
     */
    protected $casts = [
        'archived' => 'boolean'
    ];

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
     * Get a string path for the article.
     *
     * @return string
     */
    public function path()
    {
        return $this->market->path() . "/articles/{$this->slug}";
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

    /**
     * Archive the article.
     */
    public function archive()
    {
        $this->update(['archived' => true]);
    }

    /**
     * Get a new query builder that includes archives.
     */
    public static function withArchived()
    {
        return (new static)->newQueryWithoutScope('active');
    }

    /**
     * Scope a query to only include articles of a given market.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByMarket($query, $market)
    {
        return $query->where('market_id', $market->id);
    }

    /**
     * Award rating points to the model.
     */
    public function gainRating()
    {
        $this->increment('rating', 1);
    }

    /**
     * Award rating points to the model.
     */
    public function loseRating()
    {
        if ($this->rating > 0) {
            $this->decrement('rating', 1);
        }
        
    }
}
