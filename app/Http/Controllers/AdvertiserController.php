<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Category;
use App\Market;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdvertiserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Advertiser $advertiser)
    {
        if ($advertiser->logo) {
            $logo = $advertiser->logo->getFirstMedia('logo');
        } else $logo = null;
        
        $sliderImages = $advertiser->getMedia('slider');

        $locations = $advertiser->locations;

        $categories = $advertiser->subcategories()->get()->groupBy('parent_id');

        $openingHours = $advertiser->fillHours();
        $hasHours = $advertiser->hasHours($openingHours);

        $coupons = $advertiser->coupons;
        $ads = $advertiser->ads;
        $menus = $advertiser->menus;

        return view('advertisers.show', compact('market', 'advertiser', 'logo', 'sliderImages', 'locations', 'categories', 'openingHours', 'hasHours', 'coupons', 'ads', 'menus'));
    }

}
