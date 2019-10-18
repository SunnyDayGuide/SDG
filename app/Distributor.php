<?php

namespace App;

use App\Advertiser;
use App\Scopes\LodgingScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Advertiser
{
	/**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Distributors are just advertisers that are in the Lodging category
        static::addGlobalScope(new LodgingScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisers';

}
