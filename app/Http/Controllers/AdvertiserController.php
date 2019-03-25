<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DateTime;

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
        // $logo = $advertiser->getFirstMedia('logo');
        $logo = $advertiser->logo->getFirstMedia('logo');
        $sliderImages = $advertiser->getMedia('slider');

        $locations = $advertiser->locations;
        $key = env('GOOGLE_MAP_API_KEY');

        $supercategories = $advertiser->supercategories;
        $subcategories = $advertiser->categories->where('parent_id', !null);

        // for use in map icons
        $primaryCategory = $advertiser->supercategories()
            ->orderBy('categoriables.created_at')
            ->first();

        $singleLocation = $advertiser->locations()->first();

        $openingHours = $advertiser->fillHours();
        $hasHours = $this->hasHours($openingHours);

        $coupons = $advertiser->coupons;

        return view('advertisers.show', compact('market', 'advertiser', 'logo', 'sliderImages', 'locations', 'supercategories', 'subcategories', 'primaryCategory', 'openingHours', 'hasHours', 'key', 'singleLocation', 'coupons'));
    }

    public function hasHours($openingHours)
    {
        if ($openingHours->isOpenOn('sunday')) {
            return true;
        }
        if ($openingHours->isOpenOn('monday')) {
            return true;
        }
        if ($openingHours->isOpenOn('tuesday')) {
            return true;
        }
        if ($openingHours->isOpenOn('wednesday')) {
            return true;
        }
        if ($openingHours->isOpenOn('thursday')) {
            return true;
        }
        if ($openingHours->isOpenOn('friday')) {
            return true;
        }
        if ($openingHours->isOpenOn('saturday')) {
            return true;
        } else return false;
    }


}
