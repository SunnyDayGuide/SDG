<?php

namespace App\Nova;

use App\Nova\Filters\FreemailType;
use App\Nova\Filters\Market;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Freemail extends Resource
{
    use HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Freemail';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'client';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'client', 'contact_email', 'freemail_email'
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
            Text::make('Client')
                ->rules('required'),
            Text::make('Freemail Recipient Name', 'recipient_name')
                ->hideFromIndex(),
            Text::make('Freemail Email')
                ->rules('required', 'email', 'max:255'),

            Boolean::make('Active')->sortable(),
            BelongsTo::make('Freemail Type'),
            BelongsTo::make('Market'),
            BelongsTo::make('SDG Rep', 'employee', 'App\Nova\User')
                ->hideFromIndex(),

            Boolean::make('Consent Received', 'consent')
                ->hideFromIndex(),
            NovaDependencyContainer::make([
                DateTime::make('Consent Received Date', 'consent_date')
                    ->format('MMMM D YYYY, h:mm a')
                    ->hideFromIndex()
                ])->dependsOn('consent', true),

            Textarea::make('Notes')->rows(3)->alwaysShow(),

            new Panel('Contact Information', $this->contactFields()),
        ];
    }

    /**
 * Get the address fields for the resource.
 *
 * @return array
 */
protected function contactFields()
{
    return [
        Text::make('Contact Name')
                ->rules('required')
                ->hideFromIndex(),
        Text::make('Contact Email')
            ->rules('email', 'max:255')
            ->hideFromIndex(),
        Text::make('Contact Phone')->hideFromIndex(),
        Text::make('Ext')->hideFromIndex(),
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
            new FreemailType,
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
