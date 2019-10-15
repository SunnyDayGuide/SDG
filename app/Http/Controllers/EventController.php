<?php

namespace App\Http\Controllers;

use App\Event;
use App\Market;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $page = $market->pages()->where('slug', 'events')->first();

        if (!$page) {
            abort(404);
        }

        $slides = $page->getMedia('slider');
        $image = $page->getFirstMedia('slider');

        $events = $market->events()->current()->active()->get();

        return view('events.index', compact('market', 'page', 'events', 'slides', 'image'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Event $event)
    {
        //
    }

}
