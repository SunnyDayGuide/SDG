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
        $articleCount = count(Article::categorized($subcategory, $market)->get());

        $subcatArticles = Article::categorized($subcategory, $market)->get();
        $catArticles = Article::categorized($category, $market)->get()->random(3);

        // merge subcat/cat articles into one collection
        $mergedArticles = $subcatArticles->merge($catArticles);

        if ($articleCount < 3) {
            // if less than 3 related articles, return 3 merged articles (this will get subcat articles first if there are any)
           $relatedArticles = $mergedArticles->take(3); 
        } else {
            // otherwise, return 3 random articles for this subcategory
            $relatedArticles = $subcatArticles->random(3); 
        }

        // display the related advertisers
        $advertisers = Advertiser::categorized($subcategory)
            ->with('tags', 'categories', 'coupons:id')
            ->get()
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
