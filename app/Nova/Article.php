<?php

namespace App\Nova;

use App\Nova\Filters\ArticleMarket;
use App\Nova\Filters\ArticleStatus;
use App\Nova\Filters\Category;
use App\Nova\Filters\MarketFilter;
use App\Scopes\MarketScope;
use Carbon\Carbon;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
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
use Waynestate\Nova\CKEditor;

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
        'slug', 'title',
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
        $today = date('Y-m-d H:i:s');

        return [
            ID::make()->hideFromIndex(),
            BelongsTo::make('Market')->sortable(),
            Text::make('Title')
                ->sortable()
                ->rules('required'),
            Text::make('Slug')
                ->hideWhenCreating()
                ->hideFromIndex()
                ->rules('required'),
            Froala::make('Content')
                ->withFiles('trix')
                ->rules('required'),
            Textarea::make('Excerpt')->hideFromIndex(),
            Text::make('Author')->hideFromIndex(),

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

            BelongsTo::make('Article Type', 'articleType')->sortable(),
            Boolean::make('Featured')->sortable(),
            Number::make('Rating')->exceptOnForms()->sortable(),

            Tags::make('Tags')->hideFromIndex(),
            Select::make('Status', 'status')->options([
                '1' => 'Published',
                '0' => 'Draft',
            ])->displayUsingLabels()->rules('required')->sortable(),

            DateTime::make('Published On', 'published_at')
                ->format('M/D/YY, h:mma')
                ->help(
                    'Pick a date in the future to SCHEDULE an article. Default: NOW'
                )->hideFromIndex(),

            MorphToMany::make('Categories'),
            BelongsToMany::make('Advertisers'),
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
            new ArticleStatus,
            new MarketFilter,
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
