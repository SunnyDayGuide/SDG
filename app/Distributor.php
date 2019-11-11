<?php

namespace App;

use App\Article;
use App\Category;
use App\Concerns\HasRemovableGlobalScopes;
use App\Level;
use App\Location;
use App\Logo;
use App\Market;
use App\Scopes\MarketScope;
use App\Traits\Categoriable;
use App\Traits\Marketable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;
use Rinvex\Attributes\Traits\Attributable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Distributor extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
    use Marketable;
    use Sluggable;
    use HasMediaTrait;
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

 protected $cascadeDeletes = ['locations'];


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
     * Get a string path for the distributor.
     *
     * @return string
     */
    public function path()
    {
        return $this->market->path() . "/places/{$this->slug}";
    }

    /**
     * Class for View Presenter.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\AdvertiserPresenter';

      /**
     * An distributor belongs to a display level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
      public function level()
      {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get ALL of the model's locations.
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'locationable');
    }

      /**
     * An distributor has (belongs to) a logo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
      public function logo()
      {
         return $this->belongsTo(Logo::class);
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
     * The slug is generated for an distributor from it's title, but the slug is scoped to the market. 
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
     * Scope a query to only include premier distributors.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePremier($query)
    {
        return $query->where('level_id', 3);
    }

    /**
     * Scope a query to only include featured distributors.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('level_id', 2);
    }

    /**
     * Scope a query to only include standard distributors.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStandard($query)
    {
        return $query->where('level_id', 1);
    }

    /**
     * Scope a query to only include non-premier distributors.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPremier($query)
    {
        return $query->where('level_id', '!=', 3);
    }

    /**
     * Scope a query to only include distributors of a given level.
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


}
