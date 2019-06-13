<?php

namespace App;

use App\Advertiser;
use App\Category;
use App\CustomTag;
use App\Market;
use App\Scopes\MarketScope;
use App\Traits\Categoriable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Tags\HasTags;

class Article extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
    use Sluggable;
    use HasTags;
    use HasMediaTrait;
    use Searchable;
    
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new MarketScope);

        // static::addGlobalScope('published', function ($builder) {
        //     $builder->where('publish_date', '>=', Carbon::now());
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
    protected $with = ['articleType', 'market', 'tags', 'categories:id,name'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['categories'];

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

    public function toSearchableArray()
{
    $array = $this->toArray();

    $array = $this->transform($array);

    $array['categories'] = $this->categories->map(function ($data) {
        return $data['name'];
    })->toArray();

    $array['tags'] = $this->tags->map(function ($data) {
        return $data['name'];
    })->toArray();

    return $array;
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
     * The articles that belong an advertiser.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class);
    }

    /**
     * Archive the article.
     */
    public function archive()
    {
        $this->update(['status' => 'archived']);
    }

    /**
     * Get a new query builder that includes drafts.
     */
    public static function withDrafts()
    {
        return (new static)->newQueryWithoutScope('published');
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('publish_date', '<=', Carbon::now());
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



    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions(Media $media = null)
    {
        // $this->addMediaConversion('full')
        //     ->withResponsiveImages();

        // $this->addMediaConversion('cropped')
        //     ->crop(Manipulations::CROP_CENTER, 900, 480)
        //     ->withResponsiveImages();

        // $this->addMediaConversion('card')
        //     ->crop(Manipulations::CROP_CENTER, 426, 227)
        //     ->withResponsiveImages();

    }

    /**
     * Register the collections.
     *
     * @return array
     */
    public function registerMediaCollections()
    {
        $this
        ->addMediaCollection('slider')
        ->registerMediaConversions(function (Media $media) {
            
            $this->addMediaConversion('full')
                ->withResponsiveImages();

            $this
                ->addMediaConversion('card')
                ->crop(Manipulations::CROP_CENTER, 382, 203)
                ->withResponsiveImages();

            $this
                ->addMediaConversion('sm-card')
                ->crop(Manipulations::CROP_CENTER, 317, 169)
                ->withResponsiveImages();
        });

        $this->addMediaCollection('inset');

    }



}
