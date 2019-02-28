<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Michielfb\Time\Time;

class Hour extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Hour';

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
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Time::make('Monday Open', 'monday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Monday Close', 'monday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Tuesday Open', 'tuesday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Tuesday Close', 'tuesday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Wednesday Open', 'wednesday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Wednesday Close', 'wednesday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Thursday Open', 'thursday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Thursday Close', 'thursday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Friday Open', 'friday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Friday Close', 'friday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Saturday Open', 'saturday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Saturday Close', 'saturday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Sunday Open', 'sunday->start')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
            Time::make('Sunday Close', 'sunday->end')
            ->format('h:mm a')->hideFromIndex()
            ->resolveUsing(function ($value) {
                return $value;
            }),
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
