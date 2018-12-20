<?php

namespace App\Nova;

use App\Nova\Filters\ArticleMarket;
use App\Nova\Filters\ArticleStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
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
        $market = \App\Market::find($request->market);

        return [
            ID::make()->sortable(),
            BelongsTo::make('Market'),
            BelongsTo::make('Article Type', 'articleType'),
            Boolean::make('Featured')->sortable(),
            Number::make('Rating')->exceptOnForms(),
            Text::make('Title')
                ->sortable()
                ->rules('required'),
            Trix::make('Content'),
            Text::make('Author')->hideFromIndex(),
            Textarea::make('Excerpt')->hideFromIndex(),
            Image::make('Featured Image', 'image')
                            ->hideFromIndex()
                            ->disk('public')
                            ->path('images/' . $market['slug'] . '/articles')
                            ->storeAs(function (Request $request) {
                                return $request->image->getClientOriginalName();
                            }),
            MorphToMany::make('Categories'),
            Tags::make('Tags')->hideFromIndex(),
            Select::make('status')->options([
                '0' => 'Draft',
                '1' => 'Scheduled',
                '2' => 'Published',
            ])->displayUsingLabels(),
            DateTime::make('Publish Date')
                ->format('M-DD-YYYY')
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
        return [
            new ArticleMarket,
            new ArticleStatus
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
