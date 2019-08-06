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
        // $advertiser = Advertiser::with('categories.parent')->findOrFail($advertiser->id);

        // $logo = $advertiser->getFirstMedia('logo');
        if ($advertiser->logo) {
            $logo = $advertiser->logo->getFirstMedia('logo');
        } else $logo = null;
        
        $sliderImages = $advertiser->getMedia('slider');

        $locations = $advertiser->locations;
        $key = env('GOOGLE_MAP_API_KEY');

        $subcategories = $advertiser->subcategories;
        $supercategories = $advertiser->supercategories;

        // $subcategories = $advertiser->subcategories->groupBy(function($item) {
        //     return $item->parent->name;
        // });

        $subcategories = $advertiser->subcategories()->get()->groupBy('parent_id');

        $categories = $advertiser->categories->groupBy('parent_id');

        // for use in map icons
        $primaryCategory = $advertiser->supercategories()
            ->orderBy('categoriables.created_at')
            ->first();

        $singleLocation = $advertiser->locations()->first();

        $openingHours = $advertiser->fillHours();
        $hasHours = $this->hasHours($openingHours);

        $coupons = $advertiser->coupons;
        $ads = $advertiser->ads;
        $menus = $advertiser->menus;

        return view('advertisers.show', compact('market', 'advertiser', 'logo', 'sliderImages', 'locations', 'supercategories', 'subcategories', 'primaryCategory', 'openingHours', 'hasHours', 'key', 'singleLocation', 'coupons', 'ads', 'menus', 'categories'));
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
