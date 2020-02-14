<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;

class Location extends Model
{	
	use PresentableTrait;

    /**
     * Get all of the owning locationable models.
     */
    public function locationable()
    {
        return $this->morphTo();
    }

    /**
     * Class for View Presenter.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\LocationPresenter';

    /**
	 * Get the locations's full address.
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
