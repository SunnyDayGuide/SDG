<?php

namespace App\Http\Controllers;

use App\Article;
use App\CustomTag;
use App\Market;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Show the archive page for a specific tag.
     *
     * @param  Market $market
     * @param  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, CustomTag $tag)
    {
        $articles = Article::withAnyTags($tag->name)
            ->where('market_id', $market->id)
            ->get();

        return view('tags.show', compact('tag', 'market', 'articles'));
    }

}
