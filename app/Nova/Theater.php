<?php

namespace App\Nova;

use EmilianoTisato\GoogleAutocomplete\AddressMetadata;
use EmilianoTisato\GoogleAutocomplete\GoogleAutocomplete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Theater extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Theater';

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
        'name',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Show Schedule';

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
            Text::make('Theater Name', 'name')->sortable(),
            $this->googleaddressFields(),
        ];
    }

     /**
     * Get the Google address fields for the resource.
     *
     * @return \Illuminate\Http\Resources\MergeValue
     */
    protected function googleaddressFields()
    {
        return $this->merge([
            GoogleAutocomplete::make('Address', 'formatted_address')
                ->withValues(['street_number', 'route', 'locality', 'administrative_area_level_1', 'postal_code', 'country', 'latitude', 'longitude'])
                ->countries(['US']),
            Text::make('Address Line 2')->hideFromIndex(),
            AddressMetadata::make('Street Number')->fromValue('street_number')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('Route')->fromValue('route')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('City')->fromValue('locality')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('State')->fromValue('administrative_area_level_1')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('Postal Code')->fromValue('postal_code')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('Country')->fromValue('country')->invisible()->hideFromIndex()->hideFromDetail(),
            AddressMetadata::make('latitude')->fromValue('latitude')->hideFromIndex(),
            AddressMetadata::make('longitude')->fromValue('longitude')->hideFromIndex(),
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

    /**
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }

}
