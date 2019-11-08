<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Location extends Model
{	
    /**
     * Get all of the owning locationable models.
     */
    public function locationable()
    {
        return $this->morphTo();
    }

    /**
	 * Get the user's full name.
	 *
	 * @return string
	 */
	public function getFullAddressAttribute()
	{
		if ($this->alt_address) {
			return "{$this->alt_address}, {$this->city}, {$this->state} {$this->postal_code}";
		} else
		
	     return Str::replaceFirst(', USA', '', $this->formatted_address);
	}

	public function getDirectionsAttribute()
	{
		$url = 'https://www.google.com/maps/dir/?api=1&&destination='.urlencode($this->formatted_address);

		return $url;
	}

}
