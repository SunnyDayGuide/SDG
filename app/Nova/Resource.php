<?php

namespace App\Nova;

use App\Scopes\MarketScope;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    public static $defaultSortField = 'sort_order';
    
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     $query->withoutGlobalScope(MarketScope::class);
    //     return $query;
    // }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query)
            ->withoutGlobalScope(MarketScope::class);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        // Create the filter method name
        $method = 'relatable' . Str::plural(class_basename(get_called_class())) . 'Filter';

        // Get the called resource instance
        $resource = $request->newResource();

        // Check if the filter method exists
        if (method_exists($resource, $method)) {
            $query = $resource->{$method}($request, $query);
        }

        return parent::relatableQuery($request, $query);
    }

    /**
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    // public static function redirectAfterCreate(NovaRequest $request, $resource)
    // {
    //     return '/resources/'.static::uriKey().'/'.$resource->getKey();
    //     return '/resources/'.static::uriKey();
    // }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    // public static function redirectAfterUpdate(NovaRequest $request, $resource)
    // {
    //     return '/resources/'.static::uriKey().'/'.$resource->getKey();
    //     return '/resources/'.static::uriKey();
    // }
    
     
    public function attributeFields()
    {
        $attributes = app('rinvex.attributes.attribute')::whereHas('entities', function ($query) {
            $query->where('entity_type', '=', 'App\Advertiser');
        })->get();
        if (!$attributes) {
            return [];
        }
        $fields = [];

        $fields[] = Heading::make('Attributes');
        foreach ($attributes as $attribute) {
            $namespace = 'Laravel\Nova\Fields\\';

            switch ($attribute->type) {
                case 'varchar':
                    $type = 'Text';
                    break;
                case 'text':
                    $type = 'Textarea';
                    break;
                case 'boolean':
                    $type = 'Boolean';
                    break;
                default:
                    $type = 'Text';
                    break;
            }

            $type = $namespace . $type;

            $fields[] = $type::make(__($attribute->name), $attribute->slug)->hideFromIndex();
        }
        return $fields;
    }

    public function diningAttributeFields()
    {
        $attributes = app('rinvex.attributes.attribute')::where('group', 'dining-meals')->whereHas('entities', function ($query) {
            $query->where('entity_type', '=', 'App\Advertiser');
        })->get();
        if (!$attributes) {
            return [];
        }
        $fields = [];

        $fields[] = Heading::make('Meals Served');
        foreach ($attributes as $attribute) {
            $namespace = 'Laravel\Nova\Fields\\';

            switch ($attribute->type) {
                case 'varchar':
                    $type = 'Text';
                    break;
                case 'text':
                    $type = 'Textarea';
                    break;
                case 'boolean':
                    $type = 'Boolean';
                    break;
                default:
                    $type = 'Text';
                    break;
            }

            $type = $namespace . $type;

            $fields[] = $type::make(__($attribute->name), $attribute->slug)->hideFromIndex();
        }
        return $fields;
    }

}
