<?php

namespace App\Nova;

use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use R64\NovaFields\BelongsTo;
use R64\NovaFields\Boolean;
use R64\NovaFields\JSON;

class Lead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Lead';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'full_name',
        'last_name',
        'email',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Freemail';


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

            Text::make('Full Name')
            ->exceptOnForms()
            ->sortable(),
            Text::make('First Name')
            ->onlyOnForms()
            ->rules('required', 'string'),
            Text::make('Last Name')
            ->onlyOnForms()
            ->rules('required', 'string'),
            Text::make('Email')
            ->sortable()
            ->rules('required', 'email'),
            Text::make('Postal Code')->onlyOnDetail(),
            Select::make('Request Type')
            ->options(\App\Lead::getTypes())
            ->sortable()
            ->rules('required', 'string'),
            BelongsTo::make('Market'),

            new Panel('Consent Information', $this->consentFields()),
            new Panel('Trip Information', $this->tripFields()),
        ];
    }

    /**
     * Get the trip information fields for the resource.
     *
     * @return array
     */
    protected function tripFields()
    {
        return [
            Date::make('Visit Date')->format('DD MMM YYYY')->onlyOnDetail(),
            Select::make('Visit Length')->options([
                '1-3 days' => '1-3 days',
                '4-7 days' => '4-7 days',
                '8-14 days' => '8-14 days',
                'More than 14 days' => 'More than 14 days'
            ])->onlyOnDetail(),
            Select::make('Num Adults')->options([
                '1-4' => '1-4',
                '5-10' => '5-10',
                '11-14' => '11-14',
                '15+' => '15+'
            ])->onlyOnDetail(),
            Select::make('Num Children')->options([
                'None' => 'None',
                '1-4' => '1-4',
                '5-10' => '5-10',
                '11-14' => '11-14',
                '15+' => '15+'
            ])->onlyOnDetail(),
            Code::make('Interests')->json()->onlyOnDetail(),
        ];
    }

    /**
     * Get the trip information fields for the resource.
     *
     * @return array
     */
    protected function consentFields()
    {
        return [
            Boolean::make('Cookie Consent')->hideFromIndex(),
            Boolean::make('Freemail Consent'),
            Boolean::make('SDG Consent'),
            DateTime::make('Created At')->format('DD MMM YYYY')->exceptOnForms()->sortable(),
            DateTime::make('Updated At')->format('DD MMM YYYY')->onlyOnDetail(),
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
