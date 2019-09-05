<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Market extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Market';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Site Admin';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'code', 'slug'
    ];

    /**
     * Default ordering for index query. We may implement something similar across the board. TBD.
     *
     * @var array
     */
    public static $sort = [
        'id' => 'asc'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$sort), reset(static::$sort));
        }

        return $query;
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
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:markets,name')
                ->updateRules('unique:markets,name,{{resourceId}}'),

            Text::make('Code')
                ->sortable()
                ->rules('required', 'max:2')
                ->creationRules('unique:markets,code')
                ->updateRules('unique:markets,code,{{resourceId}}'),     

            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:markets,slug')
                ->updateRules('unique:markets,slug,{{resourceId}}'),    

            Text::make('Alternate Name', 'name_alt')
                ->hideFromIndex(),

            Text::make('Long Name', 'name_long')
                ->hideFromIndex(),

            BelongsTo::make('State')
                ->searchable()
                ->hideFromIndex(),

            Text::make('Cities')
                ->hideFromIndex(),

            Images::make('Guide Cover', 'cover')
                ->withResponsiveImages()
                ->conversion('full')
                ->thumbnail('small')
                ->fullSize(),

            Images::make('Home Slider', 'home')
                ->withResponsiveImages()
                ->fullSize()
                ->hideFromIndex(),

            BelongsTo::make('Brand')->hideFromIndex(),
            BelongsToMany::make('Categories'),
        ];
    }

    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static $perPageOptions = [50, 100, 150];

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
