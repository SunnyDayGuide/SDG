<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Category;
use App\Distributor;
use App\Market;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PlaceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, $slug)
    { 
        if (Advertiser::where('slug', $slug)->first()) {
            $model = Advertiser::where('slug', $slug)->firstOrFail();
        } else $model = Distributor::where('slug', $slug)->firstOrFail();

        if ($model->logo) {
            $logo = $model->logo->getFirstMedia('logo');
        } else $logo = null;
        
        $slides = $model->getMedia('slider');
        $image = $model->getFirstMedia('slider');

        $locations = $model->locations;

        $categories = $model->subcategories()->get()->groupBy('parent_id');

        if (get_class($model) == 'App\Advertiser') {
            $openingHours = $model->fillHours();
        } else $openingHours = null;
        
        $coupons = $model->coupons;
        $ads = $model->ads;
        $menus = $model->menus; 

        if (get_class($model) == 'App\Distributor') {
            $distributor = $model;
            
            return view('distributors.show', compact('market', 'distributor', 'logo', 'slides', 'image', 'locations', 'categories'));
        } else

        $advertiser = $model;

        return view('advertisers.show', compact('market', 'advertiser', 'logo', 'slides', 'image', 'locations', 'categories', 'openingHours', 'coupons', 'ads', 'menus'));
    }

}
