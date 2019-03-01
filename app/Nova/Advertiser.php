<?php

namespace App\Nova;

use App\Nova\Filters\Category;
use App\Nova\Filters\Market;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Michielfb\Time\Time;
use R64\NovaFields\JSON;
use R64\NovaFields\Row;
use R64\NovaFields\Text;
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
            Text::make('Name')
                ->sortable()
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

            new Panel('Business Hours', $this->hoursFields()),

            HasMany::make('Locations'),
            MorphToMany::make('Categories'),
            HasMany::make('Events'),
            HasMany::make('Articles'),
        ];
    }

    /**
 * Get the address fields for the resource.
 * Come back to the styling of this!!!
 *
 * @return array
 */
protected function hoursFields()
{
    return [
        Heading::make('Business Hours')->hideFromDetail(),

        JSON::make('Hours', [
            Time::make('Mon. Open', 'monday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Mon. Close', 'monday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'monday->data'),
            Time::make('Tue. Open', 'tuesday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Tue. Close', 'tuesday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'tuesday->data'),
            Time::make('Wed. Open', 'wednesday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Wed. Close', 'wednesday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'wednesday->data'),
            Time::make('Thu. Open', 'thursday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Thu. Close', 'thursday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'thursday->data'),
            Time::make('Fri. Open', 'friday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Fri. Close', 'friday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'friday->data'),
            Time::make('Sat. Open', 'saturday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Sat. Close', 'saturday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'saturday->data'),
            Time::make('Sun. Open', 'sunday->hours->start')
                ->format('h:mm a')->hideFromIndex(),
            Time::make('Sun. Close', 'sunday->hours->end')
                ->format('h:mm a')->hideFromIndex(),
            Text::make('Notes', 'sunday->data'),
        ])->fieldClasses('flex flex-wrap items-start w-full')
          ->childConfig([
            'labelClasses' => 'flex w-1/6 items-start px-6 py-6',
            'fieldClasses' => 'flex w-auto items-start px-6 py-6'
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
