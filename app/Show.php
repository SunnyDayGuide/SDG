<?php

namespace App;

use App\Advertiser;
use App\Concerns\HasRemovableGlobalScopes;
use App\Gadget;
use App\Theater;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use Sluggable;
    use HasRemovableGlobalScopes;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', 1);
        });
    }

    /**
    * The relationships to always eager-load.
    *
    * @var array
    */
    protected $with = ['advertiser'];

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
    * Get a string path for the show.
    *
    * @return string
    */
    public function path()
    {
        // if the show has an advertiser, use its path; otherwise use the show path
        if ($this->advertiser_id != null) {
            $path = $this->advertiser->path();
        } else {
            $path = "shows/{$this->slug}";
        }
        return $path;
    }

    /**
    * A show has a theater.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    /**
    * Get the gadget record associated with the show.
    */
    public function gadget()
    {
      return $this->belongsTo(Gadget::class);
    }

    /**
    * The show's primary advertiser
    */
    public function advertiser()
    {
      return $this->belongsTo(Advertiser::class);
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
            'source' => 'name',
            'onUpdate' => true,
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
    * Remove the leading article for sorting.
    * @return string
    */
    public function getSortNameAttribute()
    {
        return trim(str_replace([' A ', ' An ', ' The '], '', ' ' . $this['name'] . ' '));
    }

}
