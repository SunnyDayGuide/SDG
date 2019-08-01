<?php

namespace App\Traits;

use App\Market;
use Illuminate\Database\Eloquent\Builder;

trait Marketable {

    /**
     * A model belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    /**
     * A  scope to include all models that belong a market
     */
    public function scopeMarketed($query, Market $market=null) {
        if ( is_null($market) ) return $query->with('market');

        return $this->where('market_id', $market->id);
    }


}