<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The advertsiers that belong to the location.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class);
    }

    /**
	 * Get the user's full name.
	 *
	 * @return string
	 */
	public function getFullAddressAttribute()
	{
		if ($this->address_line_2) {
			return "{$this->street_number} {$this->route}, {$this->address_line_2}, {$this->city}, {$this->state} {$this->postal_code}";
		}
	    return "{$this->street_number} {$this->route}, {$this->city}, {$this->state} {$this->postal_code}";
	}

	public function getDirectionsAttribute()
	{
		$url = 'https://www.google.com/maps/dir/?api=1&&destination='.urlencode($this->formatted_address);

		return $url;
	}

}
