<?php

namespace App\Traits;

use App\Bucket;
use Illuminate\Database\Eloquent\Builder;

trait Bucketable {
    /**
     * Get ALL of the model's buckets.
     */
    public function buckets()
    {
        return $this->morphToMany(Bucket::class, 'bucketable')
            ->withTimestamps();
    }

}