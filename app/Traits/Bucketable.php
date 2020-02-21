<?php

namespace App\Traits;

use App\Bucket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

trait Bucketable {

	public static function bootHasBucketItems()
    {
        static::deleted(function (Model $deletedModel) {
            $bucketItems = $deletedModel->bucketItems()->get();

            $deletedModel->detachBucketItems($bucketItems);
        });
    }

    public function bucketItems()
    {
        return $this->morphToMany(Bucket::class, 'bucketable')
            ->withTimestamps();
    }

    public function isInBucket()
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        return $this->bucketItems->where('id', $bucket->id)->isNotEmpty();
    }

}