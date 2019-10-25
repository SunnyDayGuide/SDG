<?php

namespace App;

use App\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Normal extends Model
{
	use \Rinvex\Cacheable\CacheableEloquent;

	public $timestamps = false;

	protected $with = ['attribute'];
	
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

}
