<?php

namespace App\Http\Controllers;

use App\Article;
use App\Market;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function home()
    {
        // this eager loads ALL markets with their categories
        $markets = Market::with('categories')->get();

        $relatedArticles = Article::featured()->latest()->take(6)->get();
 
        return view('home', compact('markets', 'relatedArticles'));
    }
}
