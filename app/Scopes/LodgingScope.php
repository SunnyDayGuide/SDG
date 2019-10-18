<?php

namespace App\Scopes;

use App\Category;
use App\Market;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LodgingScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // get lodging subcat ids
        $categoryIds = Category::where('parent_id', 5)->pluck('id');

        // add lodging cat id to the array
        $categoryIds[] = 5;

        // return all models within the lodging category/subcategories
        return $builder->whereHas('categories', function (Builder $builder) use ($categoryIds) {
                $builder->whereIn('category_id', $categoryIds);
            });
    }

}