<?php

namespace App\Nova;

use App\Nova\Filters\MarketFilter;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class MarketCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\MarketCategory';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
        'id',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Category Pages');
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

            BelongsTo::make('Market')->exceptOnForms(),
            BelongsTo::make('Category')->exceptOnForms(),

            Text::make('Title')
                ->rules('required', 'max:255'),

            Trix::make('Body'),

            Images::make('Slider Images', 'slider')
                ->customPropertiesFields([
                        Text::make('Credit'),
                        Textarea::make('Caption'),
                    ])
                ->conversion('full')
                ->conversionOnView('card')
                ->thumbnail('sm-card')
                ->multiple()
                ->fullSize()    
                ->hideFromIndex(),

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
        return [
            new MarketFilter,
        ];
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
