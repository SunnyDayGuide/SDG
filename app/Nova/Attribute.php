<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Naxon\NovaFieldSortable\Concerns\SortsIndexEntries;
use Naxon\NovaFieldSortable\Sortable;

class Attribute extends Resource
{
    use SortsIndexEntries;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Attribute';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'slug', 'name',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Attributes';

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Attributes');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Attribute');
    }

    public static function availableForNavigation(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->can('manage attributes')) {
            return true;
        }

        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Sortable::make(__('Sort Order'), 'id')->onlyOnIndex(),
            Text::make(__('Name'), 'name')->sortable(),
            Select::make(__('Type'), 'type')
                ->options(
                    array_combine(
                        array_keys(\Rinvex\Attributes\Models\Attribute::typeMap()),
                        array_keys(array_change_key_case(\Rinvex\Attributes\Models\Attribute::typeMap(), CASE_UPPER))
                    )
                )
                ->rules('required'),

            Text::make(__('Group'), 'group')->sortable(),

            Boolean::make(__('Is Required'), 'is_required')
                ->rules('required'),

            Boolean::make(__('Is Collection'), 'is_collection')
                ->rules('required')->hideFromIndex(),

            Text::make(__('Default'), 'default')->hideFromIndex(),

            HasMany::make(('Attribute Entities'), 'attributeEntities')
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
