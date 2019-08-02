<?php

namespace App\Http\Controllers;

use App\Category;
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
        
        //show the subcategory page
        return view('categories.show', compact('market', 'articles', 'page', 'category', 'subcategory', 'advertisers', 'premierAdvertisers'));
    }

    protected function getMarketCategory(Market $market, Category $category)
    {
        return $market->categories()->find($category->id);
    }

}
