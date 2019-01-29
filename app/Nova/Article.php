<?php

namespace App\Nova;

use App\Nova\Filters\ArticleMarket;
use App\Nova\Filters\ArticleStatus;
use App\Nova\Filters\Category;
use App\Nova\Filters\Market;
use App\Scopes\MarketScope;
use Carbon\Carbon;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Froala\NovaFroalaField\Froala;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Article extends Resource
{

    /**
     * ->withoutGlobalScope(App\Scopes\MarketScope::class)
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Article';

    /**
     * Get the model with the Market scope removed
     * @return mixed
     */
    public static function newModel()
    {
        return static::$model::withoutGlobalScope(MarketScope::class);
    }

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
        $today = date('Y-m-d H:i:s');

        return [
            ID::make()->hideFromIndex(),
            BelongsTo::make('Market'),
            Text::make('Title')
                ->sortable()
                ->rules('required'),
            Froala::make('Content')
                ->withFiles('trix')
                ->rules('required'),
            // CKEditor::make('Content')
            //     ->rules('required')
            //     ->hideFromIndex(),
            Text::make('Author')->hideFromIndex(),
            Textarea::make('Excerpt')->hideFromIndex(),

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

            BelongsTo::make('Article Type', 'articleType'),
            Boolean::make('Featured')->sortable(),
            Number::make('Rating')->exceptOnForms(),
            MorphToMany::make('Categories')->searchable(),

            Tags::make('Tags')->hideFromIndex(),
            Select::make('Status', 'status')->options([
                '1' => 'Published',
                '0' => 'Draft',
            ])->displayUsingLabels(),

            DateTime::make('Publish Date')
                ->format('MMMM D YYYY, h:mm a')
                ->help(
                    'Pick a date in the future to schedule an article.'
                )
                ->rules('required')
                // ->withMeta(["value" => date('Y-m-d H:i:s')])
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
            new ArticleStatus,
            new Market,
            new Category,
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
