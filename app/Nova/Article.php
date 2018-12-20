<?php

namespace App\Nova;

use App\Nova\Filters\ArticleMarket;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Article';

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
            Text::make('Title')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('Market'),
            BelongsTo::make('Article Type', 'articleType'),
            Boolean::make('Featured')->sortable(),
            Number::make('Rating')->exceptOnForms(),
            Text::make('Author')->hideFromIndex(),
            Trix::make('Content'),
            Text::make('Excerpt')->hideFromIndex(),
            Image::make('Featured Image', 'image')
                            ->hideFromIndex()
                            ->disk('public')
                            ->path('images/' . $market['slug'] . '/articles')
                            ->storeAs(function (Request $request) {
                                return $request->image->getClientOriginalName();
                            }),
            MorphToMany::make('Categories'),
            Tags::make('Tags'),
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
            new ArticleMarket,
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
