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
        $events = $market->events()->current()->active()->get();

        return view('events.index', compact('market', 'events'));
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
