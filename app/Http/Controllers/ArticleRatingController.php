<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleRatingController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
    	
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
