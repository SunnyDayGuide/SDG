<?php

namespace App;

use App\Advertiser;
use App\Gadget;
use App\Theater;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
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
    	return $this->market->path() . "/shows/{$this->slug}";
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
     * The advertsiers that belong to the show.
     */
       public function advertisers()
       {
       	return $this->belongsToMany(Advertiser::class);
       }
   }
