<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Category;
use App\Distributor;
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

        $subcatImages = $this->getSubcatImages($market, $category);

        // display the related articles
        $relatedArticles = $category->getRelatedArticles($category, null, 3);

        // display the related advertisers
        $advertisers = Advertiser::categorized($category)
            ->with('tags:slug,name', 'coupons:id')
            ->notPremier()->get();

        $premierAdvertisers = Advertiser::categorized($category)
            ->with('tags:slug,name', 'coupons:id')
            ->premier()->get()
            ->sortBy('sortName');

        // if accommodations page, get the related distributors and then merge advertisers & distributors
        if ($category->slug == 'accommodations') {
            $advertisers = $this->getLodgingList($advertisers, $category);
            $premierAdvertisers = $this->getPremierLodgingList($premierAdvertisers, $category);
        } 

        // display the related events
        $events = Event::categorized($category)
            ->with('tags:slug,name', 'categories')->get();

        $shows = Show::where('active', true)->has('gadget')->get()->sortBy('sortName');
        
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
    public function getSubcatImages($market, $category)
    {
        $subcatIds = collect($category->children()
            ->whereHas('advertisers', function (Builder $query) use ($market) {
                $query->where('market_id', $market->id);
            })
            ->orWhereHas('distributors', function (Builder $query) use ($market) {
                $query->where('market_id', $market->id);
            })
            ->pluck('id', 'name'));

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

    public function getLodgingList($advertisers, $category)
    {
        $distributors = Distributor::categorized($category)
            ->notPremier()->get();
            
            $reg_collection = collect();

            foreach ($advertisers as $advertiser)
                $reg_collection->push($advertiser);
            foreach ($distributors as $distributor)
                $reg_collection->push($distributor);

            return $reg_collection->sortBy('sortName');
    }

    public function getPremierLodgingList($premierAdvertisers, $category)
    {
        $premierdistributors = Distributor::categorized($category)
                ->premier()->get();

        $premier_collection = collect();

        foreach ($premierAdvertisers as $premierAdvertiser)
            $premier_collection->push($premierAdvertiser);
        foreach ($premierdistributors as $premierdistributor)
            $premier_collection->push($premierdistributor);

        return $premier_collection->sortBy('sortName');
    }

}
