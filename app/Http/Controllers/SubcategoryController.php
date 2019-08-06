<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Event;
use App\Market;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
         /**
     * Show the Market Subcategory Page.
     *
     * @param  Market $market
     * @param  Category $category
     * @param  Category $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Category $category, $subcategory)
    {
        $subcategory = Category::where('slug', $subcategory)
            ->where('parent_id', $category->id)
            ->first();

        // get the market category lead page info
        $page = $this->getMarketCategory($market, $category);

        // display the related articles
        $articles = Article::categorized($subcategory, $market)
            ->take(3)->get();      

        // display the related advertisers
        $advertisers = Advertiser::categorized($subcategory, $market)->get();  

        $premierAdvertisers = Advertiser::categorized($subcategory, $market)
            ->with('tags')->premier()->get();

        // TO-DO: display the related events
        $events = Event::categorized($subcategory, $market)
            ->with('tags')->get();
        
        //show the subcategory page
        return view('categories.show', compact('market', 'articles', 'page', 'category', 'subcategory', 'advertisers', 'premierAdvertisers', 'events'));
    }

    protected function getMarketCategory(Market $market, Category $category)
    {
        return $market->categories()->find($category->id);
    }

}
