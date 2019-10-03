<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\ArticleType;
use App\Category;
use App\Market;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
      $articles = $this->getArticles($market);

      $featured = $articles
        ->where('featured', true)
        ->latest('publish_date')
        ->get();

      $tripIdeas = $articles
        ->where('article_type_id', 1)
        ->latest('publish_date')
        ->paginate(30);

      $visitorInfos = $articles
        ->where('article_type_id', 2)
        ->latest('publish_date')
        ->get();

      $advSpotlights = $articles
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
      $type = Str::slug($article->articleType->name, '-');
      // $type = $article->convert_to_slug($article->articleType->name);
      $slides = $article->getMedia('slider');
      $image = $article->getFirstMedia('slider');

      $ad1 = $this->getBannerZone('1');
      $ad2 = $this->getBannerZone('3');

      $content = $article->insertAdCode($article->content, $ad1, $ad2);

      $premierAdvertisers = Advertiser::where('market_id', $market->id)
      ->premier()->get()->random(3);

      $relatedArticles = $article->getRelatedArticles($market)
        ->sortByDesc('publish_date'); 

      return view('articles.show', compact('article', 'content', 'market', 'image', 'slides', 'premierAdvertisers', 'relatedArticles'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tideCharts(Market $market)
    {
      $article = $market->articles()->where('slug', 'tide-charts')->first();

      $slides = $article->getMedia('slider');
      $image = $article->getFirstMedia('slider');

      $premierAdvertisers = Advertiser::where('market_id', $market->id)
      ->premier()->get()->random(3);

      $relatedArticles = $article->getRelatedArticles($market)
        ->sortByDesc('publish_date'); 

      return view('articles.show', compact('article', 'market', 'image', 'slides', 'premierAdvertisers', 'relatedArticles'));
    }

    /**
     * get all the articles in a market.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getArticles(Market $market)
    {
      return Article::marketed($market)
        ->with('tags') 
        ->published();

      // return $market->articles()->with('tags') 
      // ->published();
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

    public function getBannerZone($zone)
    {
      return view('banners._zone'.$zone);
    }

    public function getPremierAds($premierAdvertisers)
    {
      return view('panels._advertisers', compact('premierAdvertisers'));
    }

  }
