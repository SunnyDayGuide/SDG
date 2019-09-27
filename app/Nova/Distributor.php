<?php

namespace App\Nova;

use App\Category;
use App\Nova\Filters\MarketFilter;
use App\Scopes\LodgingScope;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Distributor extends Resource
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
    public static $group = 'Distribution';

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
                ->rules('required'),
            Text::make('Slug')
                ->hideWhenCreating()
                ->hideFromIndex()
                ->rules('required'),

            BelongsTo::make('Market'),
            BelongsTo::make('Display Level', 'level', 'App\Nova\Level'),
            Boolean::make('Active')->sortable(),

            Heading::make('Basic Info')->hideFromDetail(),
            Froala::make('Write Up', 'write_up')
                ->rules('required'),

            Text::make('Toll Free Phone Number', 'toll_free')->hideFromIndex(),

            Tags::make('Tags')->hideFromIndex(),

            Heading::make('URLs'),
            Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Reservation URL')->rules('nullable', 'url')->hideFromIndex(),

            Heading::make('Social Media'),
            Text::make('Facebook')->rules('nullable')->hideFromIndex(),
            Text::make('Twitter')->rules('nullable')->hideFromIndex(),
            Text::make('Instagram')->rules('nullable')->hideFromIndex(),
            Text::make('YouTube', 'youtube')->rules('nullable')->hideFromIndex(),
            Text::make('Pinterest')->rules('nullable')->hideFromIndex(),
            Text::make('Yelp')->rules('nullable')->hideFromIndex(),
            Text::make('TripAdvisor')->rules('nullable')->hideFromIndex(),

            Heading::make('Images'),
            BelongsTo::make('Logo')->searchable()->nullable(), 

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

            MorphToMany::make('Categories'),
            BelongsToMany::make('Coupons'),
            BelongsToMany::make('Ads'),
            BelongsToMany::make('Articles'),
            BelongsToMany::make('Events'),
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

    /**
     * Build an "index" query that ONLY includes Lodging advertisers/distributors.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->withGlobalScope(LodgingScope::class, new LodgingScope());
    }

     /**
     * Make just lodging subcats available for the request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function relatableCategoriesFilter(NovaRequest $request, $query)
    {
        $categoryIds = Category::where('parent_id', 5)->pluck('id');

        return $query->whereIn('id', $categoryIds);
    }

    /**
     * Return the location to redirect the user after update.
     * In this case, to the detail page to add category & location
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey().'/'.$resource->getKey();
        // return '/resources/'.static::uriKey();
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        // return '/resources/'.static::uriKey().'/'.$resource->getKey();
        // return '/resources/'.static::uriKey();
    }

}
