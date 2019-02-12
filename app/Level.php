<?php

namespace App;

use App\Advertiser;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

	protected $dates = [
	    'created_at',
	    'updated_at',
	];

     /**
     * Get the advertisers for the display level.
     */
    public function advertisers()
    {
        return $this->hasMany(Advertiser::class);
    }


}
