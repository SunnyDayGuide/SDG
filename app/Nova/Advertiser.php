<?php

namespace App\Nova;

use App\Nova\Filters\Category;
use App\Nova\Filters\MarketFilter;
use App\Scopes\NotLodgingScope;
use Bissolli\NovaPhoneField\PhoneNumber;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Froala\NovaFroalaField\Froala;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Michielfb\Time\Time;
use Spatie\TagsField\Tags;

class Advertiser extends Resource
{
    use TabsOnEdit;

    public static $with = ['level', 'tags', 'logo'];

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
    public static $group = 'Advertisers';

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

            Tags::make('Tags')->hideFromIndex(),

            new Tabs('Tabs', [
                'Images'    => [
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
                ],
                'URLs'    => [
                    Text::make('Website URL')->rules('nullable', 'url')->hideFromIndex(),
                    Text::make('Ticket URL')->rules('nullable', 'url')->hideFromIndex(),
                    Text::make('Booking URL')->rules('nullable', 'url')->hideFromIndex(),
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
                'About the Business' => $this->businessFields(),
                'About the Restaurant' => $this->restaurantFields(),
            ]),

            (new Tabs('Relations', [
                HasMany::make('Locations'),
                HasMany::make('Hours', 'openingHours'),
                MorphToMany::make('Categories'),
                BelongsToMany::make('Coupons'),
                BelongsToMany::make('Ads'),
                BelongsToMany::make('Menus'),
                BelongsToMany::make('Articles'),
                BelongsToMany::make('Events'),
            ]))->defaultSearch(true),
            
        ];
    }

    protected function businessFields()
    {
        return [
            Boolean::make('Fully Accessible', 'accessible')->hideFromIndex(),
            Boolean::make('Pet Friendly', 'pet_friendly')->hideFromIndex(),
            TextArea::make('Restrictions'),
            Heading::make('Discounts Offered'),
            Boolean::make('Early Bird Specials', 'early_bird_specials')->hideFromIndex(),
            Boolean::make('Military Discount', 'military_discount')->hideFromIndex(),
            Boolean::make('Senior Discount', 'senior_discount')->hideFromIndex(),
        ];
    }

    protected function restaurantFields()
    {
        return [
            Heading::make('Meals Served'),
            Boolean::make('Breakfast')->hideFromIndex(),
            Boolean::make('Lunch')->hideFromIndex(),
            Boolean::make('Dinner')->hideFromIndex(),
            Boolean::make('Brunch')->hideFromIndex(),

            Heading::make('Atmosphere'),
            Boolean::make('Kid/Family Friendly', 'kidfamily_friendly')->hideFromIndex(),
            Boolean::make('Good for Groups', 'good_for_groups')->hideFromIndex(),
            Boolean::make('Outdoor Seating', 'outdoor_seating')->hideFromIndex(),
            Boolean::make('Entertainment', 'entertainment')->hideFromIndex(),

            Boolean::make('Take-Out', 'takeout')->hideFromIndex(),
            Boolean::make('Delivery', 'delivery')->hideFromIndex(),

            Select::make('Alcohol Served', 'alcohol')
            ->options($this->getOptions(16))
            ->hideFromIndex()->displayUsingLabels(),

            Select::make('Entree Price', 'entree_price')
            ->options($this->getOptions(3))
            ->hideFromIndex()->displayUsingLabels(),

            Select::make('Attire', 'attire')
            ->options($this->getOptions(15))
            ->hideFromIndex()->displayUsingLabels(),

            Heading::make('Reservations'),
            Boolean::make('Not Required', 'not_required')->hideFromIndex(),
            Boolean::make('Recommended', 'recommended')->hideFromIndex(),
            Boolean::make('Required', 'required')->hideFromIndex(),
            Boolean::make('Call-ahead Available', 'call_ahead')->hideFromIndex(),
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
     * Build an "index" query that does NOT include Lodging.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->withGlobalScope(NotLodgingScope::class, new NotLodgingScope());
        $query->withoutGlobalScope('active');
    }

    /**
     * Make just market subcats available for the request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function relatableCategoriesFilter(NovaRequest $request, $query)
    {
        $resource = $request->findResourceOrFail();

        $market = \App\Market::find($resource->market_id);

        // none of what is below works; come back to this.
        // $categories = $market->navCategories()->pluck('id');

        // $categories = $market->categories()
        //     ->whereNull('parent_id')
        //     ->whereNotIn('category_id', [5])   // NOT lodging  
        //     ->with('navSubcategories');

        // $subcategoryIds = \App\Category::pluck('id');

        // $subcategoryIds = \App\Category::whereHas('parent')->pluck('id');

        // $categoryIds = \App\MarketCategory::whereIn('category_id', $subcategoryIds)
        //     ->where('market_id', $resource->market_id)
        //     ->pluck('id');

        // $categoryIds = $subcategoryIds->map(function ($item, $key) use ($market) {
        //     return \App\MarketCategory::where('category_id', $key)
        //         ->where('market_id', $market->id)
        //         ->first();
        // })->pluck('id');

        // return $query->whereIn('id', $categoryIds);
        
        // For now just grab subcats
        return $query->has('parent');
    }

    public function getOptions($attribute)
    {
        $attribute = \App\Attribute::find($attribute);
        $normals = $attribute->normals()->pluck('normalized', 'id');

        return $normals->toArray();
    }

}
