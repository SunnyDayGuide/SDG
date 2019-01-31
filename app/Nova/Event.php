<?php

namespace App\Nova;

use App\Nova\Filters\Market;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use R64\NovaFields\JSON;
use Spatie\TagsField\Tags;

class Event extends Resource
{
    use HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Event';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title',
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['market'];

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

            Text::make('Title')
                ->sortable()
                ->rules('required'),
            Textarea::make('Description')->hideFromIndex(),
            Textarea::make('Location')->hideFromIndex(),
            Text::make('Phone Number', 'phone')->hideFromIndex(),
            Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Ticket URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Facebook URL')->rules('nullable', 'url')->hideFromIndex(),
            Boolean::make('Featured'),

            Date::make('Start Date')
                ->sortable()
                ->format('MM-DD-YYYY')
                ->rules('required', 'before_or_equal:end_date'),
            Date::make('End Date')
                ->sortable()
                ->format('MM-DD-YYYY')
                ->rules('required', 'after_or_equal:start_date'),

            Boolean::make('Is Recurring'),
            NovaDependencyContainer::make([
                Date::make('Recurrence Ends', 'end_of_recurring'),
                Number::make('Recurring Frequency', 'frequency_number_of_recurring')
                    ->min(1)->max(7)
                    ->rules('required_if:is_recurring,true'),

                Select::make('Type of Recurrence', 'frequency_type_of_recurring')->options([
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                    ])->rules('required_if:is_recurring,true')
                    ->displayUsingLabels(),

                NovaDependencyContainer::make([
                    JSON::make('Monthly Frequency Options', [
                        Select::make('Monthly Week')->options([
                            '1' => '1st',
                            '2' => '2nd',
                            '3' => '3rd',
                            '4' => '4th',
                            '5' => 'Last',
                        ]),
                        Select::make('Day')->options([
                            '1' => 'Sunday',
                            '2' => 'Monday',
                            '3' => 'Tuesday',
                            '4' => 'Wednesday',
                            '5' => 'Thursday',
                            '6' => 'Friday',
                            '7' => 'Day',
                            '8' => 'Weekday',
                        ]),
                    ], 'frequency_options'),
                ])->dependsOn('frequency_type_of_recurring', 'monthly'),

            ])->dependsOn('is_recurring', true),

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
