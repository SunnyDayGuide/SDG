<?php

namespace App;

use App\Article;
use App\CustomTag;
use App\Event;
use App\Level;
use App\Location;
use App\Logo;
use App\Market;
use App\Traits\Categoriable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\OpeningHours\OpeningHours;
use Spatie\Tags\HasTags;

class Advertiser extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
    use Sluggable;
    use HasTags;
    use HasMediaTrait;

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
    protected $with = ['market', 'media', 'tags'];

	protected $dates = [
	    'created_at',
	    'updated_at',
	    'deleted_at'
	];

    /**
     * Attributes to cast.
     */
    protected $casts = [
        'hours' => 'array',
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
     * Get a string path for the advertiser.
     *
     * @return string
     */
    public function path()
    {
        return $this->market->path() . "/places/{$this->slug}";
    }

   /**
     * An advertiser belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
    }

      /**
     * An advertiser belongs to a display level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * The locations that belong to the advertiser.
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class)->withTimestamps();
    }

      /**
     * An advertiser has (belongs to) a logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logo()
    {
    	return $this->belongsTo(Logo::class);
    }

    /**
     * The articles that belong an advertiser.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * The events that belong an advertiser.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
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
                'source' => 'name'
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
                ->crop(Manipulations::CROP_CENTER, 730, 390)
                ->withResponsiveImages();

            $this
                ->addMediaConversion('card')
                ->crop(Manipulations::CROP_CENTER, 522, 278)
                ->withResponsiveImages();

            $this
                ->addMediaConversion('sm-card')
                ->crop(Manipulations::CROP_CENTER, 217, 116)
                ->withResponsiveImages();
        });

        $this
        ->addMediaCollection('logo')
        ->singleFile()
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('full')
            ->withResponsiveImages();
        });

    }

    /**
     * Scope a query to only include premier advertisers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePremier($query)
    {
        return $query->where('level_id', 3);
    }

    /**
     * Scope a query to only include featured advertisers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('level_id', 2);
    }

    /**
     * Scope a query to only include standard advertisers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStandard($query)
    {
        return $query->where('level_id', 1);
    }

    /**
     * Scope a query to only include advertisers of a given level.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $level
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $level)
    {
        return $query->where('level_id', $level);
    }

    /**
     * mutate advertiser hours to conform to '2:00-20:00' string that 
     * Spatie\OpeningHours\OpeningHours::fill() method requires
     */
    public function mutateHours()
    {
        $schedule = collect($this->hours);

        $changed = $schedule->map(function ($value, $key) {
            if ($value['hours']['start']) {
                $hours = [collect($value['hours'])->sort()->implode('-')];
            } else
                $hours = [];
            return $hours;
        });
         
        return $changed->all();
    }

    /**
     * fill advertiser hours into Spatie\OpeningHours\OpeningHours
     */
    public function fillHours()
    {
        $schedule = $this->mutateHours();

        $openingHours = (new OpeningHours)->fill($schedule);

        return $openingHours;
    }


}
