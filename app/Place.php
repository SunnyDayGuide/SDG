<?php

namespace App;

use App\Concerns\HasRemovableGlobalScopes;
use App\Level;
use App\Location;
use App\Scopes\MarketScope;
use App\Traits\Bucketable;
use App\Traits\Categoriable;
use App\Traits\Marketable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use Rinvex\Attributes\Traits\Attributable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

abstract class Place extends Model implements HasMedia
{
    use Sluggable;
    use HasMediaTrait;
    use SoftDeletes;
    use Categoriable;
    use Marketable;
    use Bucketable;
    use HasRemovableGlobalScopes;
    use Attributable;
    use PresentableTrait;
    use CascadesDeletes;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketScope);

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', 1);
        });
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
     * Get a string path for the Place.
     *
     * @return string
     */
    public function path()
    {
        return $this->market->path() . "/places/{$this->slug}";
    }

    /**
     * An Place belongs to a display level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }


    /**
     * Get ALL of the place's locations.
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'locationable');
    }


    /**
     * An place has (belongs to) a logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logo()
    {
         return $this->belongsTo(Logo::class);
    }

    /**
     * Scope a query to only include premier places.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePremier($query)
    {
        return $query->where('level_id', 3);
    }

    /**
     * Scope a query to only include featured places.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('level_id', 2);
    }

    /**
     * Scope a query to only include standard places.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStandard($query)
    {
        return $query->where('level_id', 1);
    }


    /**
     * Scope a query to only include non-premier places.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPremier($query)
    {
        return $query->where('level_id', '!=', 3);
    }

    /**
     * Scope a query to only include places of a given level.
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
    * Remove the leading article for sorting.
    * @return string
    */
    public function getSortNameAttribute()
    {
        return trim(str_replace([' A ', ' An ', ' The '], '', ' ' . $this['name'] . ' '));
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
     * The slug is generated for a place from it's name, but the slug is scoped to the market. 
     * So a BR can have a place with the same title as CG, but both will have the same slug.
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
     * Determine if an advertiser is an accommodation
     *
     * @return boolean
     */
    public function isCampground()
    {
        $campground = $this->categories->where('id', 53);

        if ($campground->isNotEmpty()) {
            return true;
        } else return false;
    }

}
