<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class BucketItem extends MorphPivot
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bucketables';

    /**
     * Attributes to cast.
     */
    protected $casts = [
        'completed' => 'boolean'
    ];
}
