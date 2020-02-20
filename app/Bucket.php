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

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    /**
     * Get all of the owning categoriable models.
     */
    public function bucketable()
    {
        return $this->morphTo();
    }

}
