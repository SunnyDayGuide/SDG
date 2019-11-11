<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Distributor;
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

        // if accommodations suncategry page, get the related distributors and then merge advertisers & distributors
        if ($category->slug == 'accommodations') {
            $advertisers = $this->getLodgingList($advertisers, $subcategory);
            $premierAdvertisers = $this->getPremierLodgingList($premierAdvertisers, $subcategory);
        } 

        // display the related events
        $events = Event::categorized($subcategory)
            ->with('tags', 'categories')->get();
        
        //show the subcategory page
        return view('categories.subcategory-show', compact('market', 'relatedArticles', 'advertisers', 'events', 'page', 'subcategory', 'category', 'premierAdvertisers', 'slides', 'image'));
    }

    public function getLodgingList($advertisers, $subcategory)
    {
        $distributors = Distributor::categorized($subcategory)
            ->notPremier()->get();
            
            $reg_collection = collect();

            foreach ($advertisers as $advertiser)
                $reg_collection->push($advertiser);
            foreach ($distributors as $distributor)
                $reg_collection->push($distributor);

            return $reg_collection->sortBy('sortName');
    }

    public function getPremierLodgingList($premierAdvertisers, $subcategory)
    {
        $premierdistributors = Distributor::categorized($subcategory)
                ->premier()->get();

        $premier_collection = collect();

        foreach ($premierAdvertisers as $premierAdvertiser)
            $premier_collection->push($premierAdvertiser);
        foreach ($premierdistributors as $premierdistributor)
            $premier_collection->push($premierdistributor);

        return $premier_collection->sortBy('sortName');
    }

}
