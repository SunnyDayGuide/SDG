<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function markets()
    {
    	return $this->hasMany('App\Market');
    }
}
