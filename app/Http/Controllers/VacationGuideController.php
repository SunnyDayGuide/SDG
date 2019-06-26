<?php

namespace App\Http\Controllers;

use App\Market;
use App\VacationGuide;
use Illuminate\Http\Request;

class VacationGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VacationGuide  $vacationGuide
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, VacationGuide $vacationGuide)
    {
        return view('vacation-guide.show', compact('market'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VacationGuide  $vacationGuide
     * @return \Illuminate\Http\Response
     */
    public function edit(VacationGuide $vacationGuide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VacationGuide  $vacationGuide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacationGuide $vacationGuide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VacationGuide  $vacationGuide
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacationGuide $vacationGuide)
    {
        //
    }
}
