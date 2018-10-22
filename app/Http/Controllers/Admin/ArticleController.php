<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Market;
use App\Article;
use App\ArticleType;

class ArticleController extends Controller
{

    /**
     * Create a new ThreadsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $articles = $market->articles()
            ->orderBy('published_at', 'desc')
            ->get();
        
        return view('admin.articles.index', compact('market', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Market $market)
    {
        $article = new Article;
        $market = Market::findorFail($market->id);
        $articleTypes = ArticleType::all();

        return view('admin.articles.create', compact('market', 'articleTypes', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Market $market)
    {        
        $title = request('title');
        $published = date('Y-m-d H:i:s');

        if($request->hasFile('image')){
            $image = $request->file('image');
            
            $imagePath = 'images/'.$market->slug.'/articles';
            $filename = $market->code.'-'.$image->getClientOriginalName();

            $image = $image->storeAs($imagePath, $filename, 'public');

        } else {
            $image = null;
        }

        $article = Article::create([
            'title' => $title,
            'author' => request('author'),
            'image' => $image,
            'content' => request('content'),
            'excerpt' => request('excerpt'),
            'rating' => 0,
            'featured' => request('featured'),
            'slug' => str_slug($title),
            'published_at' => $published,
            'market_id' => $market->id,
            'article_type_id' => request('article_type_id')
        ]);

        $categories = request('categories');
        $article->assignCategories($categories);

        if (request()->wantsJson()) {
            return response($article, 201);
        }

        $articles = $market->articles()->get();

        return view('admin.articles.index', compact('market', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Market $market, $id)
    {
        $article = Article::findorFail($id);
        $articleTypes = ArticleType::all();
        return view('admin.articles.edit', compact('market', 'article', 'articleTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
