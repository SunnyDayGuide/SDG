<?php

namespace App;

use Algolia\ScoutExtended\Splitters\HtmlSplitter;
use App\Advertiser;
use App\Category;
use App\CustomTag;
use App\Helpers\WordPressContentFormatter;
use App\Market;
use App\Scopes\MarketScope;
use App\Traits\Categoriable;
use App\Traits\Marketable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
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
    use Marketable;
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
    protected $with = ['categories:id,name', 'media', 'articleType'];

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
        $type = Str::slug($this->articleType->name, '-');
        return $this->market->path() . "/{$type}/{$this->slug}";
    }

    /**
     * Get array to send to Algolia that includes just the cat/tag name and nothing else on those models.
     *
     * @return array
     */
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
     * Splits the given value. TURN THIS OFF TO UPDATE CATEGORIES FOR NOW
     *
     * @param  string $value
     * @return array
     */
    public function splitContent($value)
    {
        return HtmlSplitter::class;
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
     * @param $market
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('publish_date', '<=', Carbon::now());
    }


     /**
     * Scope a query to only include featured articles.
     *
     * @param $market
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include Trip Idea articles.
     *
     * @param $market
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTripIdeas($query)
    {
        return $query->where('article_type_id', 1);
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


    public function getBlurbAttribute()
    {
        return Str::limit($this->excerpt, 125, '...');
    }

     /**
     * Include articles related to current article.
     *
     * @param  App\Market $market
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRelatedArticles(Market $market)
    {
      $tag_ids = $this->tags()->pluck('id');
      $category_ids = $this->subcategories()->pluck('id');

      $articles = $this->whereHas('tags', function($q) use ($tag_ids) {
        $q->whereIn('id', $tag_ids);
      })
      ->orwhereHas('subcategories', function($q) use ($category_ids) {
        $q->whereIn('id', $category_ids);
      })
      ->get();

      $relatedArticles = $articles
        ->except($this->id)
        ->where('market_id', $market->id);

      if ($relatedArticles->count() >= 3) {
        return $relatedArticles;
      } else {
        return $relatedArticles;
      }

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
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(\Cocur\Slugify\Slugify $engine, $attribute) {
        $engine->addRule('\'', '');
        $engine->addRule('’', '');
        return $engine;
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
     * Register the media collections.
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

    public function getFormattedContentAttribute()
    {
        $formatter = new WordPressContentFormatter;
        if ($this->content) {
            $content = $formatter->wptexturize($this->content);
            $content = $formatter->wpautop($content);
            return $content;
        }
    }
}
