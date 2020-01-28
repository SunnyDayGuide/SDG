<?php

namespace App\Nova;

use App\Nova\Filters\MarketFilter;
use App\Scopes\LodgingScope;
use Bissolli\NovaPhoneField\PhoneNumber;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Distributor extends Resource
{
    use TabsOnEdit;

    public static $with = ['level', 'logo'];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Distributor';

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
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Distributors');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Distributor');
    }

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

            BelongsTo::make('Market')->sortable(),
            BelongsTo::make('Display Level', 'level', 'App\Nova\Level'),
            Boolean::make('Active')->sortable(),

            Heading::make('Basic Info')->hideFromDetail(),
            Froala::make('Write Up', 'write_up')
                ->rules('required')->stacked(),

            PhoneNumber::make('Toll Free Phone Number', 'toll_free')
                ->onlyCountries('US')
                ->withCustomFormats('###-###-####')->onlyCustomFormats()
                ->hideFromIndex(),

            new Tabs('Tabs', [
                'Images'    => [
                    BelongsTo::make('Logo')->searchable()->nullable()->hideFromIndex(), 
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
                ],
                'URLs'    => [
                    Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
                    Text::make('Reservation URL')->rules('nullable', 'url')->hideFromIndex(),
                ],
                'Social Media'    => [
                    Text::make('Facebook')->rules('nullable')->hideFromIndex(),
                    Text::make('Twitter')->rules('nullable')->hideFromIndex(),
                    Text::make('Instagram')->rules('nullable')->hideFromIndex(),
                    Text::make('YouTube', 'youtube')->rules('nullable')->hideFromIndex(),
                    Text::make('Pinterest')->rules('nullable')->hideFromIndex(),
                    Text::make('Yelp')->rules('nullable')->hideFromIndex(),
                    Text::make('TripAdvisor')->rules('nullable')->hideFromIndex(),
                ],
                'About the Property'    => $this->groupAttributeFields('lodging-property', 'App\Distributor'),
                'Services and Amenities'    => $this->groupAttributeFields('lodging-amenities', 'App\Distributor'),
                'Campgrounds'    => $this->campgroundFields(),
                'Distribution'    => $this->groupAttributeFields('lodging-inhouse', 'App\Distributor'),
            ]),
            (new Tabs('Relations', [
                MorphMany::make('Locations'),
                MorphToMany::make('Categories'),
            ]))->defaultSearch(true),
            
        ];
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
        // $query->withGlobalScope(LodgingScope::class, new LodgingScope());
        $query->withoutGlobalScope('active');
    }

     /**
     * Make just lodging subcats available for the request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function relatableCategoriesFilter(NovaRequest $request, $query)
    {
        $categoryIds = \App\Category::where('parent_id', 5)->pluck('id');

        return $query->whereIn('id', $categoryIds);
    }

    /**
     * Return the location to redirect the user after create.
     * In this case, to the detail page to add category & location
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        // return '/resources/'.static::uriKey().'/'.$resource->getKey();
        return '/resources/'.static::uriKey().'/'.$resource->getKey().'/attach/categories?viaRelationship=categories&polymorphic=1';
        // return '/resources/'.static::uriKey();
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

}
