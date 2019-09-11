<?php

namespace App\Nova;

use App\Nova\Filters\Category;
use App\Nova\Filters\MarketFilter;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Michielfb\Time\Time;
use R64\NovaFields\JSON;
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
            Text::make('Ticket URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Booking URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Reservation URL')->rules('nullable', 'url')->hideFromIndex(),

            Heading::make('Social Media'),
            Text::make('Facebook')->rules('nullable')->hideFromIndex(),
            Text::make('Twitter')->rules('nullable')->hideFromIndex(),
            Text::make('Instagram')->rules('nullable')->hideFromIndex(),
            Text::make('YouTube', 'youtube')->rules('nullable')->hideFromIndex(),
            Text::make('Pinterest')->rules('nullable')->hideFromIndex(),

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

            new Panel('Business Hours', $this->hoursFields()),

            HasMany::make('Locations'),
            MorphToMany::make('Categories'),
            HasMany::make('Coupons'),
            HasMany::make('Ads'),
            HasMany::make('Menus'),
            HasMany::make('Articles'),
            HasMany::make('Events'),
        ];
    }

 /**
 * Get the hours fields for the resource.
 * Come back to the styling of this!!!
 *
 * @return array
 */
protected function hoursFields()
{
    return [
        Heading::make('Business Hours')->onlyOnForms(),

        JSON::make('Hours', [
            Time::make('Mon. Open', 'monday->hours->start')->format('h:mm a'),
            Time::make('Mon. Close', 'monday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'monday->data'),

            Time::make('Tue. Open', 'tuesday->hours->start')->format('h:mm a'),
            Time::make('Tue. Close', 'tuesday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'tuesday->data'),

            Time::make('Wed. Open', 'wednesday->hours->start')->format('h:mm a'),
            Time::make('Wed. Close', 'wednesday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'wednesday->data'),

            Time::make('Thu. Open', 'thursday->hours->start')->format('h:mm a'),
            Time::make('Thu. Close', 'thursday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'thursday->data'),

            Time::make('Fri. Open', 'friday->hours->start')->format('h:mm a'),
            Time::make('Fri. Close', 'friday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'friday->data'),

            Time::make('Sat. Open', 'saturday->hours->start')->format('h:mm a'),
            Time::make('Sat. Close', 'saturday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'saturday->data'),
            
            Time::make('Sun. Open', 'sunday->hours->start')->format('h:mm a'),
            Time::make('Sun. Close', 'sunday->hours->end')->format('h:mm a'),
            Text::make('Notes', 'sunday->data'),
        ])->fieldClasses('flex flex-wrap items-start w-full')
          ->childConfig([
            'labelClasses' => 'flex w-1/6 items-start px-6 py-6',
            'fieldClasses' => 'flex w-auto items-start px-6 py-6'
          ])->onlyOnForms(),
    ];
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
        return '/resources/'.static::uriKey().'/'.$resource->getKey().'/attach/categories?viaRelationship=categories&polymorphic=1';
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
