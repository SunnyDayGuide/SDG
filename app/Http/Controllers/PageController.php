<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;


class PageController extends Controller
{
        public function home(Market $market)
    {
        // this eager loads ALL markets with their categories
        // $markets = Market::with('categories')->get();
 
        // this eager loads only markets that HAVE categories
        $markets = Market::has('categories')->get();
        return view('welcome', compact('markets'));
    }
}
