<?php

namespace App\Nova;

use App\Nova\Filters\MarketFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Map extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Map';

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
        'id','name',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Editorial';


    public static function availableForNavigation(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->can('manage maps')) {
            return true;
        }

        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $market = \App\Market::find($request->market);

        return [
            ID::make()->sortable(),
            BelongsTo::make('Market')->rules('required')->sortable(),
            Text::make('Name')->rules('required')->sortable(),
            Textarea::make('Description')->rules('required'),
            File::make('File')
            ->disk('public')
            ->path('pdfs/' . $market['slug'] . '/maps')
            ->storeAs(function (Request $request) {
                return $request->file->getClientOriginalName();
            }),
        ];
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
