<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        $sliderImages = $market->getMedia('home');

        $premierAdvertisers = Advertiser::premier()->inRandomOrder()->get();

        $popularArticles = $market->articles()->orderBy('rating', 'desc')->skip(1)->take(3)->get();
        $mostPopular = $market->articles()->orderBy('rating', 'desc')->first();

        $latestArticles = Article::tripIdeas()->latest()->skip(1)->take(3)->get();
        $latestArticle = Article::tripIdeas()->latest()->first();

        $events = $market->events()->current()->active()->get(); // could also do "events this week"

        return view('markets.show', compact('market', 'sliderImages', 'premierAdvertisers', 'latestArticles', 'latestArticle', 'events'));
        // return view('markets.'.$market->code, compact('market', 'sliderImages', 'premierAdvertisers', 'latestArticles', 'latestArticle', 'events'));
    }

}
