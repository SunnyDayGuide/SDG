<?php

namespace App;

use App\Show;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Theater extends Model
{
     /**
     * A theater can have many shows.
     */
    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    /**
	 * Get the user's full name.
	 *
	 * @return string
	 */
	public function getFullAddressAttribute()
	{
		if ($this->address_line_2) {
			return "{$this->address_line_2}, {$this->city}, {$this->state} {$this->postal_code}";
		} else
		
	     return Str::replaceFirst(', USA', '', $this->formatted_address);
	}

	public function getDirectionsAttribute()
	{
		$url = 'https://www.google.com/maps/dir/?api=1&&destination='.urlencode($this->formatted_address);

		return $url;
	}
}
