<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Market;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;
use Storage;

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
        $articles = Article::where('market_id', $market->id)
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
        
        $tags = Tag::pluck('name');
        $tags2 = json_encode($article->tags());

        return view('admin.articles.create', compact('market', 'articleTypes', 'article', 'tags', 'tags2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, Market $market)
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
            'status' => request('status'),
            'publish_date' => $published,
            'market_id' => $market->id,
            'article_type_id' => request('article_type_id')
        ]);

        $article->assignCategories(request('categories'));

        if (isset($request->tags)) {
            $tags = explode(',', $request->tags);
            $article->syncTags($tags);
        }

        session()->flash('message', 'The article has been created.');

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
        $article = Article::with('categories')
            ->findorFail($id);

        $articleTypes = ArticleType::all();

        $tags = Tag::pluck('name');

        $tags2 = json_decode($article->tags->pluck('name'));
        $tags2 = implode(",",$tags2);

        return view('admin.articles.edit', compact('market', 'article', 'articleTypes', 'tags', 'tags2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Market $market, $id)
    {
        $article = Article::findorFail($id);

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
            'title' => request('title'),
            'author' => request('author'),
            'image' => $image,
            'content' => request('content'),
            'excerpt' => request('excerpt'),
            'featured' => request('featured'),
            'status' => request('status'),
            'market_id' => $market->id,
            'article_type_id' => request('article_type_id')
        ]);

        // get categories and attach them
        $article->assignCategories(request('categories'));

        if (isset($request->tags)) {
            $tags = explode(',', $request->tags);
            $article->syncTags($tags);
        } else $article->tags()->detach();

        return redirect()->route('admin.articles.index', compact('market'))
            ->with('flash', 'Your article has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     * THIS IS NOW A SOFT DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($market, $id)
    {
        $article = Article::findorFail($id);

        Storage::disk('public')->delete($article->image);
        $article->categories()->detach();
        
        $article->delete();

        return redirect()->route('admin.articles.index', compact('market'))
            ->with('flash', 'Your article has been deleted!');
    }
}
