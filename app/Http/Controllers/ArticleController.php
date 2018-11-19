<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use App\ArticleType;
use App\Article;
use Carbon\Carbon;


class ArticleController extends Controller
{
    /**
     * Create a new ArticlesController instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of all articles by article type
     *
     * @param  Market      $market
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $tripIdeas = $market->articles()
            ->orderBy('published_at', 'desc')
            ->where('article_type_id', 1)
            ->get();

        $visitorInfos = $market->articles()
            ->orderBy('published_at', 'desc')
            ->where('article_type_id', 2)
            ->get();

        $advSpotlights = $market->articles()
            ->orderBy('published_at', 'desc')
            ->where('article_type_id', 3)
            ->get();

        return view('articles.index', compact('market', 'tripIdeas', 'visitorInfos', 'advSpotlights'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Article $article)
    {
        return view('articles.show', compact('article', 'market'));
    }

}
