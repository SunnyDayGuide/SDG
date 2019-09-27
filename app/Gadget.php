<?php

namespace App;

use App\Show;
use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
	public $timestamps = false;
	
    /**
     * Get the show that owns the gadget.
     */
    public function show()
    {
        return $this->hasOne(Show::class);
    }
}
