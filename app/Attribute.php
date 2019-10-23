<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends \Rinvex\Attributes\Models\Attribute
{
    public $timestamps = true;
    /**
     * Get the entities attached to this attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeEntities(): HasMany
    {
        return parent::entities();
    }
}
