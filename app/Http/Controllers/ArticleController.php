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
     * Display a listing of all trip ideas and advertorials/profiles
     *
     * @param  Market      $market
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
      $page = $market->pages()->where('slug', 'trip-ideas')->firstorFail();

      // pull 5 random featured articles
      // $featured = Article::with(['media', 'categories'])
      // ->featured()
      // ->latest('published_at')
      // ->get()
      // ->random(5);
      
      // pull 5 most popular articles
      $articles =  new Article();
      $featured = $articles->mostPopular(5); 

      $tripIdeas = Article::with(['media', 'categories'])
      ->tripIdeas()
      ->latest('published_at')
      ->paginate(20);

      $advSpotlights = Article::with(['media', 'categories'])
      ->where('article_type_id', 3)
      ->latest('published_at')
      ->get();

      $searchCategories = $market->categories()
            ->isParent()
            ->with('searchSubcategories')->get();

      return view('articles.index', compact('market', 'page', 'featured', 'tripIdeas', 'advSpotlights', 'searchCategories'));
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
     * Display the visitor info page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visitorInfo(Market $market)
    {
      $page = $market->pages()->where('slug', 'visitor-info')->firstorFail();

      $slides = $page->getMedia('slider');
      $image = $page->getFirstMedia('slider');

      $visitorInfos = Article::with('media')
      ->where('article_type_id', 2)
      ->latest('published_at')
      ->get(); 

      $advertisers = Advertiser::all();

      return view('articles.visitor-info', compact('market', 'page', 'visitorInfos', 'slides', 'image', 'advertisers'));
    }


    /**
     * Display the specified resource (tide charts if they got 'em).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tideCharts(Market $market)
    {
      $article = $market->articles()->where('slug', 'tide-charts')->first();

      if (!$article) {
        abort(404);
      }

      $slides = $article->getMedia('slider');
      $image = $article->getFirstMedia('slider');

      $premierAdvertisers = Advertiser::premier()->get()->random(3);

      $relatedArticles = $article->getRelatedArticles()
      ->sortByDesc('published_at'); 

      return view('articles.show', compact('article', 'market', 'image', 'slides', 'premierAdvertisers', 'relatedArticles'));
    }

    public function search(Request $request, Market $market)
    {
      $page = $market->pages()->where('slug', 'trip-ideas')->first();

      if (!$page) {
        abort(404);
      }

      $featured = Article::with('media')
        ->featured()
        ->latest('published_at')
        ->get();

      if ($request->has('q')) {
        $query = request('q');

        $tripIdeas = Article::search($query)
        ->paginate(30);

        if (request()->expectsJson()) {
          return $tripIdeas;
        }
      }  

      $searchCategories = $market->categories()
            ->isParent()
            ->with('searchSubcategories')->get();

      $advSpotlights = Article::with(['media', 'categories'])
        ->where('article_type_id', 3)
        ->latest('published_at')
        ->get();

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

      return view('articles.index', compact('market', 'page', 'tripIdeas', 'featured', 'searchCategories', 'advSpotlights'));

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

    public function mostPopular($number)
    {
      $articles = Article::orderBy('rating', 'desc')
        ->get()
        ->random($number);

        return $articles;
    }

  }
