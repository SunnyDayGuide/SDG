<?php

namespace App\Nova;

use App\Nova\Filters\MarketFilter;
use App\Nova\Filters\SingleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Coupon extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Coupon';

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
        'id','offer','suboffer',
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
            BelongsTo::make('Market')->rules('required')->sortable(),
            Select::make('Category', 'category_id')->options([
                '1' => 'Activities',
                '2' => 'Dining',
                '3' => 'Shopping',
                '4' => 'Entertainment',
                '5' => 'Accommodations',
            ])->displayUsingLabels()->rules('required')->sortable(),
            Boolean::make('Active')->sortable(),
            BelongsTo::make('Logo')->searchable(),
            Text::make('Offer')->rules('required'),
            Text::make('Suboffer')->hideFromIndex(),
            Textarea::make('Disclaimer'),
            Text::make('Promo Code')->hideFromIndex(),
            Text::make('Barcode')->hideFromIndex(),
            Select::make('Barcode Type')->options(Config::get('coupons.barcode_types'))
                ->displayUsingLabels()->hideFromIndex(),

            BelongsToMany::make('Advertisers'),
        ];
    }


     /**
     * Make just the coupon's market's advertisers available for the request.
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
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey().'/'.$resource->getKey().'/attach/advertisers?viaRelationship=advertisers&polymorphic=0';
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
            new SingleCategory,
        ];
    }

}
