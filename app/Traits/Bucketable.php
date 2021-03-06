<?php

namespace App\Traits;

use App\Bucket;
use App\BucketItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

trait Bucketable {

	public static function bootHasBucketItems()
    {
        static::deleted(function (Model $deletedModel) {
            $bucketItems = $deletedModel->bucketable()->get();

            $deletedModel->detachBucketItems($bucketItems);
        });
    }

    public function bucketable()
    {
        return $this->morphToMany(Bucket::class, 'bucketable')
            ->withTimestamps()
            ->using(BucketItem::class);
    }

    public function isInBucket()
    {
        $bucketId = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $bucketId);

        if (!$bucket) {
            return false;
        }

        return $this->bucketable->where('id', $bucket->id)->isNotEmpty();
    }

}