<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use R64\NovaFields\BelongsTo;
use R64\NovaFields\Number;
use R64\NovaFields\Select;

class Recurrence extends Resource
{
    use HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Recurrence';

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

            BelongsTo::make('Event')->hideWhenUpdating(),

            Select::make('Repeats', 'freq')->options([
                'DAILY' => 'Daily',
                'WEEKLY' => 'Weekly',
                'MONTHLY' => 'Monthly',
                'YEARLY' => 'Yearly',
            ])->rules('required')->displayUsingLabels(),

            NovaDependencyContainer::make([
                Select::make('Frequency', 'interval')->options([
                    '1' => 'Every Day',
                    '2' => 'Every other day',
                    '3' => 'Every three days',
                    '4' => 'Every four days',
                    '5' => 'Every five days',
                    '6' => 'Every six days',
                ])->rules('required_if:freq,DAILY')->displayUsingLabels(),
            ])->dependsOn('freq', 'DAILY'),

            NovaDependencyContainer::make([
                Select::make('Frequency', 'interval')->options([
                    '1' => 'Every Week',
                    '2' => 'Every other week',
                    '3' => 'Every three weeks',
                ])->rules('required_if:freq,WEEKLY')->displayUsingLabels(),

                Checkboxes::make('Day of the Week', 'byweekday')
                ->options([
                    'MO' => 'Monday',
                    'TU' => 'Tuesday',
                    'WE' => 'Wednesday',
                    'TH' => 'Thursday',
                    'FR' => 'Friday',
                    'SA' => 'Saturday',
                    'SU' => 'Sunday',
                ])->saveAsString(),
            ])->dependsOn('freq', 'WEEKLY'),

            NovaDependencyContainer::make([
                Select::make('Frequency', 'interval')->options([
                    '1' => 'Every month',
                    '2' => 'Every other month',
                    '3' => 'Every three months',
                    '4' => 'Every four months',
                    '5' => 'Every five months',
                    '6' => 'Every six months',
                    '7' => 'Every seven months',
                    '8' => 'Every eight months',
                    '9' => 'Every nine months',
                    '10' => 'Every ten months',
                    '11' => 'Every eleven months',
                ])->rules('required_if:freq,MONTHLY')->displayUsingLabels(),

                Number::make('Day of the Month', 'bymonthday')
                    ->help('The day of the month an event recurs (ie: the 17th of every month)'),

                Checkboxes::make('On the', 'bysetpos')
                ->options([
                    '1' => '1st',
                    '2' => '2nd',
                    '3' => '3rd',
                    '4' => '4th',
                    '5' => '5th',
                    '-1' => 'Last',
                ])->saveAsString(),

                Checkboxes::make('Day of the Week', 'byweekday')
                ->options([
                    'MO' => 'Monday',
                    'TU' => 'Tuesday',
                    'WE' => 'Wednesday',
                    'TH' => 'Thursday',
                    'FR' => 'Friday',
                    'SA' => 'Saturday',
                    'SU' => 'Sunday',
                ])->saveAsString(),
            ])->dependsOn('freq', 'MONTHLY'),

            NovaDependencyContainer::make([
                Number::make('Frequency', 'interval')
                    ->withMeta(['value' => '1'])
                    ->hideFromIndex()
                    ->hideFromDetail()
                    ->hideWhenCreating()
                    ->hideWhenUpdating()
                    ->rules('required_if:freq,YEARLY'),

                Number::make('Day of the Month', 'bymonthday')
                    ->help('The date of the month an event recurs (ie: 25 = the 25th of the month)'),

                Checkboxes::make('Day of the Week', 'byweekday')
                ->options([
                    'MO' => 'Monday',
                    'TU' => 'Tuesday',
                    'WE' => 'Wednesday',
                    'TH' => 'Thursday',
                    'FR' => 'Friday',
                    'SA' => 'Saturday',
                    'SU' => 'Sunday',
                ])->saveAsString(),
            ])->dependsOn('freq', 'YEARLY'),

            Number::make('Number of Recurrences', 'count')
                ->help('Optional. Cannot be used in conjunction with an End Date.')
                ->hideFromIndex(),

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
