<?php

namespace App;

use App\Article;
use App\Category;
use App\CustomTag;
use App\Event;
use App\Level;
use App\Location;
use App\Logo;
use App\Market;
use App\Menu;
use App\Scopes\MarketScope;
use App\Show;
use App\Traits\Categoriable;
use App\Traits\Marketable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
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
    use Marketable;
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
    protected $with = ['market', 'media'];

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
        return $this->hasMany(Location::class);
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
     * The coupons that belong to the advertiser.
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    /**
     * The ads in which this advertiser appears.
     */
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'advertiser_pdf', 'advertiser_id', 'pdf_id')
        ->where('type', 'ad')->withTimestamps();
    }

    /**
     * The menus in which this advertiser appears.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'advertiser_pdf', 'advertiser_id', 'pdf_id')
        ->where('type', 'menu')->withTimestamps();
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
     * The shows that belong an advertiser.
     */
    public function shows()
    {
        return $this->belongsToMany(Show::class);
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
            ->crop(Manipulations::CROP_CENTER, 730, 390)
            ->withResponsiveImages();

            $this
            ->addMediaConversion('card')
            ->crop(Manipulations::CROP_CENTER, 558, 297)
            ->withResponsiveImages();

            $this
            ->addMediaConversion('sm-card')
            ->crop(Manipulations::CROP_CENTER, 217, 116)
            ->withResponsiveImages();
        });

        // may not need this anymore. Keep for now.
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

    public function hasHours($openingHours)
    {
        if ($openingHours->isOpenOn('sunday')) {
            return true;
        }
        if ($openingHours->isOpenOn('monday')) {
            return true;
        }
        if ($openingHours->isOpenOn('tuesday')) {
            return true;
        }
        if ($openingHours->isOpenOn('wednesday')) {
            return true;
        }
        if ($openingHours->isOpenOn('thursday')) {
            return true;
        }
        if ($openingHours->isOpenOn('friday')) {
            return true;
        }
        if ($openingHours->isOpenOn('saturday')) {
            return true;
        } else return false;
    }

    public function getBlurbAttribute()
    {
        $blurb = Str::replaceFirst('<p>', '', $this->write_up);
        return Str::words($blurb, 10, '...');
    }

    public function getBlurbLongAttribute()
    {
        $blurb = Str::replaceFirst('<p>', '', $this->write_up);
        // return Str::limit($blurb, 125, '...');
        return Str::words($blurb, 20, '...');
    }


}
