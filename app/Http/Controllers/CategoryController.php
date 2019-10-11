<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Event;
use App\Market;
use App\MarketCategory;
use App\Show;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $markets = Market::pluck('name', 'slug');
        
        $categories =  $market->navCategories;

        return view('categories.index', compact('market', 'markets', 'categories'));
    }

    public function all()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.all', compact('categories'));
    }

    /**
     * Show the Market Category Lead Page.
     *
     * @param  Market $market
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Category $category)
    {
        // get the market category lead page info
        $page = MarketCategory::where('category_id', $category->id)->where('market_id', $market->id)->first();

        $slides = $page->getMedia('slider');
        $image = $page->getFirstMedia('slider');

        // $subcategories = $this->getSubcategories($market, $category);
        $subcatImages = $this->getSubcatImages($market, $category);

        // display the related articles
        $articleCount = count(Article::categorized($category, $market)->get());

        if ($articleCount < 3) {
           $relatedArticles = Article::with('tags')
            ->get()->random();
        } else {
            $relatedArticles = Article::categorized($category, $market)
            ->with('tags', 'categories')
            ->get()->random(3); 
        }

        // display the related advertisers
        $advertisers = Advertiser::categorized($category, $market)
            ->with('tags', 'categories', 'coupons:id')
            ->get()
            ->sortBy('sortName');

        $premierAdvertisers = Advertiser::categorized($category, $market)
            ->with('tags', 'categories', 'coupons:id')
            ->premier()->get()
            ->sortBy('sortName');

        // display the related events
        $events = Event::categorized($category, $market)
            ->with('tags', 'categories')->get();

        $shows = Show::where('active', true)->get()->sortBy('sortName');
        
        //show the lead page
        return view('categories.show', compact('market', 'relatedArticles', 'advertisers', 'events', 'page', 'category', 'premierAdvertisers', 'slides', 'image', 'subcatImages', 'shows'));
    }

    /**
     * Get the category's subcats.
     *
     * @param  $market
     * @param  $category
     * @return \Illuminate\Http\Response
     */
    public function getSubcategories($market, $category)
    {
        $subcategories = $category->children()->whereHas('advertisers', function (Builder $query) use ($market) {
                $query->where('market_id', $market->id);
            });

        return $subcategories;
    }

    public function getSubcatImages($market, $category)
    {
        $subcatIds = collect($category->children()->whereHas('advertisers', function (Builder $query) use ($market) {
                $query->where('market_id', $market->id);
            })->pluck('id', 'name'));

        // find the matching market category page or create one
        // this is a prevent for breaking page if you assign an advertiser to a category where a page has not yet been created. 
        // Come back to this. there has to be a better solution.
        $mapped = $subcatIds->map(function ($item, $key) use ($market) {
            return MarketCategory::where('category_id', $item)
                ->where('market_id', $market->id)
                ->with('media')
                ->firstOrCreate(
                    ['market_id' => $market->id],
                    ['category_id' => $item]
                );
        });

       return $mapped;
    }

}
