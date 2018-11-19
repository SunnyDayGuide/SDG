<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Market;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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

        // display the related articles
        $articles = $category->articles()
            ->with('tags')
            ->where('market_id', $market->id)
            ->get();        

        // TO-DO: display the related advertisers
        // TO-DO: display the related events
        
        //show the lead page
        return view('categories.show', compact('market', 'articles', 'lead'));
    }

    protected function getMarketCategory(Market $market, Category $category)
    {
        return $market->categories()->find($category->id);
    }

}
