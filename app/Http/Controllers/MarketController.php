<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        // this eager loads ALL markets with their categories
        $markets = Market::with('categories')->get();
 
        // this eager loads only markets that HAVE categories
        // $markets = Market::has('categories')->get();
        return view('welcome', compact('markets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        $sliderImages = $market->getMedia('home');

        $premierAdvertisers = Advertiser::where('market_id', $market->id)
            ->premier()->inRandomOrder()->get();

        $popularArticles = $market->articles()->orderBy('rating', 'desc')->skip(1)->take(3)->get();
        $mostPopular = $market->articles()->orderBy('rating', 'desc')->first();

        $latestArticles = $market->articles()->tripIdeas()->latest()->skip(1)->take(3)->get();
        $latestArticle = $market->articles()->tripIdeas()->latest()->first();

        $events = $market->events()->current()->active()->get(); // could also do "events this week"

        // return view('markets.show', compact('market', 'sliderImages', 'articles'));
        return view('markets.'.$market->code, compact('market', 'sliderImages', 'premierAdvertisers', 'latestArticles', 'latestArticle', 'events'));
    }

}
