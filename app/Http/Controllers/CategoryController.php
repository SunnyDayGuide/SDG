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
        $lead = $this->getMarketCategory($market, $category);

        $subcategories = $category->children;

        $categoryIds = $category->children()->pluck('id');
        $categoryIds[] = $category->getKey();
        // dd($categoryIds);

        // display the related articles
        $articles = Article::categorized($category)
            ->marketed($market)
            ->take(3)->get();     

        // display the related advertisers
        $advertisers = Advertiser::categorized($category)
            ->with('tags')->marketed($market)->get();

        $premierAdvertisers = Advertiser::categorized($category)
            ->with('tags')->marketed($market)
            ->premier()->get();

        // TO-DO: display the related events
        $events = Event::categorized($category)
            ->with('tags')->marketed($market)
            ->get();  
        
        //show the lead page
        return view('categories.show', compact('market', 'articles', 'advertisers', 'events', 'lead', 'category', 'subcategories', 'premierAdvertisers'));
    }

     /**
     * Show the Market SubCategory Page.
     *
     * @param  Market $market
     * @param  Category $category
     * @param  Category $subcategory
     * @return \Illuminate\Http\Response
     */
    public function subcategories(Market $market, Category $category, $subcategory)
    {
        $subcategory = Category::where('slug', $subcategory)
            ->where('parent_id', $category->id)
            ->first();

        // get the market category lead page info
        $lead = $this->getMarketCategory($market, $category);

        // display the related articles
        $articles = $subcategory->articles()
            ->with('tags')
            ->where('market_id', $market->id)
            ->get();     

        // display the related advertisers
        $advertisers = $subcategory->advertisers()
            ->with('tags')
            ->where('market_id', $market->id)
            ->get();  

        // dd($advertisers);

        $premierAdvertisers = $subcategory->advertisers()
            ->where('market_id', $market->id)->premier()->get();

        // TO-DO: display the related events
        
        //show the lead page
        return view('categories.show', compact('market', 'articles', 'lead', 'category', 'subcategory', 'advertisers', 'premierAdvertisers'));
    }

    protected function getMarketCategory(Market $market, Category $category)
    {
        return $market->categories()->find($category->id);
    }

}
