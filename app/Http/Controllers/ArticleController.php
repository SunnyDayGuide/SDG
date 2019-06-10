<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleType;
use App\Category;
use App\Market;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of all articles by article type
     *
     * @param  Market      $market
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $page = $market->pages()->where('slug', 'articles')->first();

        $featured = $this->getArticles($market)
            ->where('featured', true)
            ->latest('publish_date')
            ->get();

        $tripIdeas = $this->getArticles($market)
            ->where('article_type_id', 1)
            ->latest('publish_date')
            ->paginate(6);

        $visitorInfos = $this->getArticles($market)
            ->where('article_type_id', 2)
            ->latest('publish_date')
            ->get();

        $advSpotlights = $this->getArticles($market)
            ->where('article_type_id', 3)
            ->orderBy('title', 'asc')
            ->get();

        return view('articles.index', compact('market', 'page', 'featured', 'tripIdeas', 'visitorInfos', 'advSpotlights'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Article $article)
    {
        $slides = $article->getMedia('slider');
        $image = $article->getFirstMedia('slider');

        return view('articles.show', compact('article', 'market', 'image', 'slides'));
    }

    /**
     * get all the articles in a market.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getArticles(Market $market)
    {
        return $market->articles()
            ->published();
    }

    public function search(Request $request, Market $market)
    {
        $page = $market->pages()->where('slug', 'articles')->first();

        $featured = $this->getArticles($market)
            ->where('featured', true)
            ->latest('publish_date')
            ->get();

         if ($request->has('q')) {
                $search = request('q');

                $articles = Article::search($search)
                    ->get();

                if (request()->expectsJson()) {
                    return $articles;
                }
            }  
          
          // if ($request->has('category')) {
          //       $category = request('category');
                     
          //       $articles = Article::whereHas('categories', function ($query) use ($category) {
          //           $query->where([
          //               'category_id' => $category
          //           ]);
          //       })->get();

          //       if (request()->expectsJson()) {
          //           return $articles;
          //       }
          //   }     

        $articles = $articles->where('market_id', $market->id);

        return view('articles.search-results', compact('market', 'page', 'articles', 'featured'));

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
