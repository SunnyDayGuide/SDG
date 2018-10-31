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
     * Display a listing of all Articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $articles = Article::withArchived()
            ->where('market_id', $market->id)
            ->with('categories')
            ->paginate(10);
        
        return view('admin.articles.index', compact('market', 'articles'));
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Market $market)
    {
        $article = new Article;
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
        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'sometimes|image',
            'content' => 'required',
            'article_type_id' => 'required'
        ]);

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

        return redirect()->route('admin.articles.index', compact('market'))
            ->with('flash', 'Your article has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Market $market, $id)
    {
        $article = Article::withArchived()->with('categories')->findorFail($id);
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
        $article = Article::withArchived()->findorFail($id);

        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'sometimes|image',
            'content' => 'required',
            'article_type_id' => 'required',
            'archived' => 'required|boolean'
        ]);

        $title = request('title');

        if($request->hasFile('image')){
            $image = $request->file('image');
            
            $imagePath = 'images/'.$market->slug.'/articles';
            $filename = $market->code.'-'.$image->getClientOriginalName();

            $image = $image->storeAs($imagePath, $filename, 'public');

            // save old file name so we can delete the replaced image 
            $oldFileName = $article->image;

            // delete old image
            Storage::disk('public')->delete($oldFileName);
        } else {
            $image = $article->image;
        }

        $article->update([
            'title' => $title,
            'author' => request('author'),
            'image' => $image,
            'content' => request('content'),
            'excerpt' => request('excerpt'),
            'featured' => request('featured'),
            'archived' => request('archived'),
            'slug' => str_slug($title),
            'market_id' => $market->id,
            'article_type_id' => request('article_type_id')
        ]);

        // get categories and attach them
        $categories = request('categories');
        $article->assignCategories($categories);

        return redirect()->route('admin.articles.index', compact('market'))
            ->with('flash', 'Your article has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market, $id)
    {
        $article = Article::withArchived()->findorFail($id);

        Storage::disk('public')->delete($article->image);
        $article->categories()->detach();
        
        $article->delete();

        return redirect()->route('admin.articles.index', compact('market'))
            ->with('flash', 'Your article has been deleted!');
    }
}
