<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Market;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Advertiser $advertiser)
    {
        $logo = $advertiser->getFirstMedia('logo');
        $sliderImages = $advertiser->getMedia('slider');
        $locations = $advertiser->locations;
        $supercategories = $advertiser->supercategories;
        $subcategories = $advertiser->categories->where('parent_id', !null);

        $openingHours = $advertiser->fillHours();
        $thisWeek = $openingHours->forWeek();

        // dd($openingHours);

        return view('advertisers.show', compact('market', 'advertiser', 'logo', 'sliderImages', 'locations', 'supercategories', 'subcategories', 'openingHours', 'thisWeek'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertiser $advertiser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertiser $advertiser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertiser $advertiser)
    {
        //
    }
}
