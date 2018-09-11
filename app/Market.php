<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function articles()
    {
    	return $this->hasMany('App\Article');
    }
}
