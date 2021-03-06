<?php

namespace App\Nova;

use App\Scopes\MarketScope;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    public static $defaultSortField = 'sort_order';

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
     * Go to resource view after create instead of resource index page
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        // return '/resources/'.static::uriKey().'/'.$resource->getKey();
        // return '/resources/'.static::uriKey();

        if ($request->viaResource) {
            return "/resources/{$request->viaResource}/{$request->viaResourceId}";
        }

        return parent::redirectAfterCreate($request, $resource);
    }

    /**
     * Return the location to redirect the user after update.
     * Go to resource view after update instead of resource index page
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        // return '/resources/'.static::uriKey().'/'.$resource->getKey();
        // return '/resources/'.static::uriKey();

        if ($request->viaResource) {
            return "/resources/{$request->viaResource}/{$request->viaResourceId}";
        }

        return parent::redirectAfterUpdate($request, $resource);
    }


    // Mostly used with accommodations attributes, but get fields by their GROUP
    public function groupAttributeFields($group, $entityType, $heading = null)
    {
        $attributes = app('rinvex.attributes.attribute')::where('group', $group)
            ->whereHas('entities', function ($query) use ($entityType) {
                $query->where('entity_type', '=', $entityType);
            })->get();

        if (!$attributes) {
            return [];
        }
        $fields = [];

        // $fields[] = Heading::make($heading);
        foreach ($attributes as $attribute) {
            $type = $this->getType($attribute);

            $fields[] = $type::make(__($attribute->name), $attribute->slug)->hideFromIndex();
        }
        return $fields;
    }

    // Get which type of attribute an entity is
    public function getType($attribute)
    {
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

            return $type = $namespace . $type;
    }

    protected function propertyFields()
    {
        return [
            Boolean::make('Oceanfront')->hideFromIndex(),
            Boolean::make('Waterfront')->hideFromIndex(),
            Boolean::make('Mountain View')->hideFromIndex(),
            Boolean::make('Mobility Accessible Rooms')->hideFromIndex(),
            Boolean::make('Suites')->hideFromIndex(),
            Boolean::make('Kitchen/Kitchenettes', 'kitchenkitchenettes')->hideFromIndex(),
            Boolean::make('In-Room Whirlpool Tubs', 'in_room_whirlpool_tubs')->hideFromIndex(),
            Boolean::make('Pet Friendly', 'pet_friendly')->hideFromIndex(),
        ];
    }

    // Campground fields for Advertisers (HO) and Distributors
    public function campgroundFields()
    {
        return [
            Boolean::make('Full Hookups', 'full_hookups')->hideFromIndex(),
            Boolean::make('Lounge', 'lounge')->hideFromIndex(),
            Boolean::make('Pavilion', 'pavilion')->hideFromIndex(),
            Boolean::make('Store', 'store')->hideFromIndex(),
            Boolean::make('Cabins', 'cabins')->hideFromIndex(),
            Boolean::make('Bath House', 'bath_house')->hideFromIndex(),
            Select::make('Max Amp', 'max_amp')->options([
                '20' => '20',
                '30' => '30',
                '50' => '50',
                '50+' => '50+',
            ])->hideFromIndex()
        ];
    }


    // Not sure what this is anymore. Believe it's from original github.com question
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

}
