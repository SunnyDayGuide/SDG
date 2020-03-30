<?php

namespace App\Nova;

use App\Nova\Filters\MarketFilter;
use Bissolli\NovaPhoneField\PhoneNumber;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Michielfb\Time\Time;
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
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Editorial';

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
            Boolean::make('Active')->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required'),

            Date::make('Start Date')
                ->sortable()
                ->format('M-DD-YYYY')
                ->rules('required'),
            Date::make('End Date')
                ->sortable()
                ->format('M-DD-YYYY')
                ->rules('nullable', 'after_or_equal:start_date'),

            Boolean::make('Is Recurring'),

            Time::make('Start Time')->format('h:mm a')->hideFromIndex(),
            Time::make('End Time')->format('h:mm a')->hideFromIndex(),

            Froala::make('Description')->hideFromIndex(),
            Textarea::make('Location')->hideFromIndex(),
            PhoneNumber::make('Phone Number', 'phone')
            ->onlyCountries('US')
            ->withCustomFormats('###-###-####')->onlyCustomFormats()
            ->hideFromIndex(),
            Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Ticket URL')->rules('nullable', 'url')->hideFromIndex(),
            Text::make('Facebook URL')->rules('nullable', 'url')->hideFromIndex(),
            Boolean::make('Featured'),

            Images::make('Inset', 'inset')
                ->thumbnail('card')
                ->hideFromIndex(),                

            HasMany::make('Recurrences'),
            MorphToMany::make('Categories')->searchable(),
            BelongsToMany::make('Advertisers')->searchable(),
            Tags::make('Tags')->hideFromIndex(),

        ];
    }

    /**
     * Make just the ad's market's advertisers available for the request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function relatableAdvertisersFilter(NovaRequest $request, $query)
    {
        $resource = $this->findorFail($request->resourceId);
        $market = $resource->market_id;

        return $query->where('market_id', $market);
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
