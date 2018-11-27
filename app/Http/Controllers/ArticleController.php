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
        $tripIdeas = $this->getArticles($market)->where('article_type_id', 1)->paginate(6);
        $visitorInfos = $this->getArticles($market)->where('article_type_id', 2)->get();
        $advSpotlights = $this->getArticles($market)->where('article_type_id', 3)->get();

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

    /**
     * get all the articles in a market.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getArticles(Market $market)
    {
        return $market->articles()->with('tags')->orderBy('published_at', 'desc');
    }

    public function rate(Market $market, Article $article)
    {
        $article->gainRating();

        return back();
    }

    public function rateno(Market $market, Article $article)
    {
        $article->loseRating();
        
        return back();
    }

}
