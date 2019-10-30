<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Event;
use App\Market;
use App\MarketCategory;
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
    public function show(Market $market, Category $category, Category $subcategory)
    {
        $page = MarketCategory::where('category_id', $subcategory->id)->where('market_id', $market->id)->first();

        $slides = $page->getMedia('slider');
        $image = $page->getFirstMedia('slider');

        // display the related articles
        $relatedArticles = $subcategory->getRelatedArticles($category, $subcategory, 3);

        // display the related advertisers
        $advertisers = Advertiser::categorized($subcategory)
            ->with('tags', 'categories', 'coupons:id')
            ->notPremier()->get()
            ->sortBy('sortName');

        $premierAdvertisers = Advertiser::categorized($subcategory)
            ->with('tags', 'categories', 'coupons:id')
            ->premier()->get()
            ->sortBy('sortName');

        // display the related events
        $events = Event::categorized($subcategory)
            ->with('tags', 'categories')->get();
        
        //show the subcategory page
        return view('categories.subcategory-show', compact('market', 'relatedArticles', 'advertisers', 'events', 'page', 'subcategory', 'category', 'premierAdvertisers', 'slides', 'image'));
    }

}
