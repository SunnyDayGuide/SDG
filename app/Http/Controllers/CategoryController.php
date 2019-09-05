<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Event;
use App\Market;
use App\MarketCategory;
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

        $subcategories = $this->getSubcategories($market, $category);

        $categoryIds = $category->children()->pluck('id');
        $categoryIds[] = $category->getKey();

        // display the related articles
        $articles = Article::categorized($category, $market)
            ->take(3)->get();     

        // display the related advertisers
        $advertisers = Advertiser::categorized($category, $market)->get();

        $premierAdvertisers = Advertiser::categorized($category, $market)
            ->with('tags')->premier()->get();

        // display the related events
        $events = Event::categorized($category, $market)
            ->with('tags')->get();  
        
        //show the lead page
        return view('categories.show', compact('market', 'articles', 'advertisers', 'events', 'page', 'category', 'subcategories', 'premierAdvertisers', 'slides', 'image'));
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
            })
            ->withCount(['advertisers' => function ($query) use ($market) {
                 $query->where('market_id', $market->id);
            }])
            ->get();

        return $subcategories;
    }

}
