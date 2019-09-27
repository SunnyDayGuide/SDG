<?php

namespace App\Http\Controllers;

use App\Market;
use App\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of all articles by article type
     *
     * @param  Market      $market
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
    	echo 'this is a show listing';
    }

    /**
     * Display the specified resource.
     *
     * @param  Market      $market
     * @param  Show      $show
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Show $show)
    {
        return view('show-schedule.show', compact('market', 'show'));
    }
}
