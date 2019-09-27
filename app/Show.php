<?php

namespace App;

use App\Advertiser;
use App\Gadget;
use App\Theater;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use Sluggable;

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
        // if the show has advertisers, get the first one and use it's path
        // otherwise use the show path
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
    * Get the phone record associated with the user.
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


    public function getSortNameAttribute()
    {
        return trim(str_replace([' A ', ' An ', ' The '], '', ' ' . $this['name'] . ' '));
    }

}
