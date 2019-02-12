<?php

namespace App\Nova;

use App\Nova\Filters\Category;
use App\Nova\Filters\Market;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Advertiser extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Advertiser';

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
        'id', 'name',
    ];

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
            BelongsTo::make('Market'),
            Text::make('Name')
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Display Level', 'level', 'App\Nova\Level'),
            Boolean::make('Active')->sortable(),

            Froala::make('Write Up', 'write_up')
                ->rules('required'),
            Text::make('Toll Free Phone Number', 'toll_free')->hideFromIndex(),
            Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Ticket URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Booking URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Reservation URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Facebook')->rules('nullable')->hideFromIndex(),
            Text::make('Twitter')->rules('nullable')->hideFromIndex(),
            Text::make('Instagram')->rules('nullable')->hideFromIndex(),
            Text::make('YouTube', 'youtube')->rules('nullable')->hideFromIndex(),
            Text::make('Pinterest')->rules('nullable')->hideFromIndex(),

            Images::make('Logo', 'logo')
                ->thumbnail('full')
                ->hideFromIndex(), 

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

            HasMany::make('Locations'),
            MorphToMany::make('Categories')->searchable(),
            Tags::make('Tags')->hideFromIndex(),

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
            new Market,
            new Category,
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
