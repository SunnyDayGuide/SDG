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

      $featured = Article::with('media')
      ->featured()
      ->latest('published_at')
      ->get();

      $tripIdeas = Article::with('media')
      ->tripIdeas()
      ->latest('published_at')
      ->paginate(30);

      $visitorInfos = Article::with('media')
      ->where('article_type_id', 2)
      ->latest('published_at')
      ->get();

      $advSpotlights = Article::with('media')
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
      
      $slides = $article->getMedia('slider');
      $image = $article->getFirstMedia('slider');

      $ad1 = $this->getBannerZone('1');
      $ad2 = $this->getBannerZone('3');

      $content = $article->insertAdCode($article->content, $ad1, $ad2);

      $premierAdvertisers = Advertiser::premier()
      ->get()
      ->random(3);

      $relatedArticles = $article->getRelatedArticles()
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

      $premierAdvertisers = Advertiser::premier()->get()->random(3);

      $relatedArticles = $article->getRelatedArticles()
      ->sortByDesc('published_at'); 

      return view('articles.show', compact('article', 'market', 'image', 'slides', 'premierAdvertisers', 'relatedArticles'));
    }

    public function search(Request $request, Market $market)
    {
      $page = $market->pages()->where('slug', 'articles')->first();

      $featured = Article::with('media')
      ->featured()
      ->latest('published_at')
      ->get();

      if ($request->has('q')) {
        $query = request('q');

        $articles = Article::search($query)
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
