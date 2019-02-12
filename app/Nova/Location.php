<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Location extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Location';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Places';
    /**

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
            $this->addressFields(),
            Text::make('Phone Number', 'telephone'),
        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return \Illuminate\Http\Resources\MergeValue
     */
    protected function addressFields()
    {
        return $this->merge([
            Place::make('Address', 'address_line_1')
                ->countries(['US']),
            Text::make('Address Line 2')->hideFromIndex(),
            Text::make('City'),
            Text::make('State')->hideFromIndex(),
            Text::make('Postal Code')->hideFromIndex(),
            Country::make('Country')->hideFromIndex(),
            Text::make('Latitude')->hideFromIndex(),
            Text::make('Longitude')->hideFromIndex(),
        ]);
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
