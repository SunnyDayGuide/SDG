<?php

namespace App;

use App\Normal;
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

    public function normals()
    {
        return $this->hasMany(Normal::class);
    }
}
