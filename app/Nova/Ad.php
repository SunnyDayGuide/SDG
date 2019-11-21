<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ad extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Ad';

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
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Advertisers';

    public static function availableForNavigation(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('manage logos')) {
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
        $market = \App\Market::find($request->market);

        return [
            ID::make()->sortable(),
            BelongsTo::make('Market')->rules('required')->sortable(),
            Text::make('File Name', 'file')->exceptOnForms()->hideFromDetail(),
            File::make('File')
            ->disk('public')
            ->path('pdfs/' . $market['slug'] . '/ads')
            ->storeAs(function (Request $request) {
                return $request->file->getClientOriginalName();
            }),
            BelongsToMany::make('Advertisers'),
        ];
    }

    /**
     * Make just the ad's market's advertisers available for the request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function relatableAdvertisersFilter(NovaRequest $request, $query)
    {
        $resource = $this->findorFail($request->resourceId);
        $market = $resource->market_id;

        return $query->where('market_id', $market);
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
