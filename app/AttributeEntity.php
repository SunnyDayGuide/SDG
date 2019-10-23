<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeEntity extends \Rinvex\Attributes\Models\AttributeEntity
{
    public $timestamps = true;
    /**
     * Get the attribute attached to this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(config('rinvex.attributes.models.attribute'));
    }
}
