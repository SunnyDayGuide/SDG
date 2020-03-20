<?php

namespace App;

use App\Market;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * A map belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
    }

}
