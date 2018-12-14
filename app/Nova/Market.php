<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
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
    public static $title = 'name';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Admin';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'code'
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

            Text::make('Long/Alternate Name', 'name_alt')
                ->hideFromIndex(),

            BelongsTo::make('State')
                ->searchable()
                ->hideFromIndex(),

            Text::make('Cities')
                ->hideFromIndex(),

            BelongsTo::make('Brand')->hideFromIndex(),

            BelongsToMany::make('Categories')
                ->fields(function ($model) {
                    $market = $model->slug;
                    $imagePath = 'images/' . $market . '/leads';

                    return [
                        Text::make('Title')
                            ->rules('required', 'max:255'),

                        Trix::make('Body'),

                        Image::make('Image')
                            ->disk('public')
                            ->path($imagePath)
                            ->storeAs(function (Request $request) {
                                return $request->image->getClientOriginalName();
                            }),

                        Textarea::make('Meta Title')
                            ->withMeta(['extraAttributes' => [
                                'placeholder' => 'Make it less than 60 characters']
                            ]),

                        Textarea::make('Meta Description')
                            ->rules('max:200')
                            ->withMeta(['extraAttributes' => [
                                'placeholder' => 'Make it less than 200 characters']
                            ]),
                    ];
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