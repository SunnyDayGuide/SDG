<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the owning categoriable models.
     */
    public function bucketable()
    {
        return $this->morphTo();
    }

}
