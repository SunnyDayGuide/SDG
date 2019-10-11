<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Article;
use App\CustomTag;
use App\Event;
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
            ->get();

        $advertisers = Advertiser::withAnyTags($tag->name)
            ->get();

        $events = Event::withAnyTags($tag->name)
            ->current()->active()
            ->get();

        return view('tags.show', compact('tag', 'market', 'articles', 'advertisers', 'events'));
    }

}
