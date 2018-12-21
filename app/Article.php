<?php

namespace App;

use App\Category;
use App\CustomTag;
use App\Market;
use App\Scopes\MarketScope;
use App\Traits\Categoriable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Tags\HasTags;

class Article extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
    use Sluggable;
    use HasTags;
    use HasMediaTrait;
    
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('active', function ($builder) {
        //     $builder->where('archived', false);
        // });
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
        'featured' => 'boolean'
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
	    'publish_date',
        'deleted_at'
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
        $this->update(['status' => 'archived']);
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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The slug is generated for as article from it's title, but the slug is scoped to the market. 
     * So a BR can have an article with the same title as CG, but both will have the same slug.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        $market = $model->market;
        return $query->where('market_id', $market->getKey());
    }

    public static function getTagClassName(): string
    {
        return CustomTag::class;
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }
}
