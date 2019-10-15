<?php

namespace App\Http\Controllers;

use App\Article;
use App\Market;
use App\Scopes\MarketScope;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function home()
    {
        // this eager loads markets with their states
        $markets = Market::with('state:name')->get();

        $relatedArticles = Article::featured()
        ->withoutGlobalScope(MarketScope::class)
        ->with('market')
        ->latest()->take(6)
        ->get();
 
        return view('home', compact('markets', 'relatedArticles'));
    }

    public function weather(Market $market)
    {
    	$page = $market->pages()->where('slug', 'weather')->first();
    	$mainImage = $page->getFirstMedia('slider');

    	$forecast = $market->getForecast();

    	return view('pages.weather', compact('market', 'page', 'mainImage', 'forecast'));
    }

}

