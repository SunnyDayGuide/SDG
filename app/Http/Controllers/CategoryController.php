<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Event;
use App\Market;
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
        $page = $this->getMarketCategory($market, $category);

        $subcategories = $category->children()->pluck('name', 'id');

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
        return view('categories.show', compact('market', 'articles', 'advertisers', 'events', 'page', 'category', 'subcategories', 'premierAdvertisers'));
    }

    protected function getMarketCategory(Market $market, Category $category)
    {
        return $market->categories()->find($category->id);
    }

}
