<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;

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
        return view('markets.show', compact('market'));
    }

}
