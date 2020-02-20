<?php

namespace App\Traits;

use App\Bucket;
use Illuminate\Database\Eloquent\Builder;

trait Bucketable {
	protected $queuedBucketItems = [];

	public static function bootHasBucketItems()
    {
        static::deleted(function (Model $deletedModel) {
            $bucketItems = $deletedModel->bucketItems()->get();

            $deletedModel->detachBucketItems($bucketItems);
        });
    }

    /**
     * Get ALL of the model's bucket items.
     */
    public function bucketable()
    {
        return $this->morphToMany(Bucket::class, 'bucketable')
            ->withTimestamps();
    }

    /**
     * @param array|\ArrayAccess|App/Bucket $bucketItems
     *
     * @return $this
     */
    public function attachBucketItems($bucketItems)
    {
        $bucketItems = collect(Bucket::findOrCreate($bucketItems));

        $this->bucketItems()->syncWithoutDetaching($bucketItems->pluck('id')->toArray());

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function attachBucketItem($bucketItems)
    {
        return $this->attachTags([$tag]);
    }



}