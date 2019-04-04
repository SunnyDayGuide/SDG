<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Coupon;
use App\Market;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function allCoupons(Market $market, Advertiser $advertiser)
    {
        $logo = $advertiser->logo->getFirstMedia('logo');
        $coupons = $advertiser->coupons;

        return view('advertisers.printAllCoupons', compact('market', 'advertiser', 'coupons'));
    }

    public function singleCoupon(Market $market, Advertiser $advertiser, Coupon $coupon)
    {
        $logo = $advertiser->logo->getFirstMedia('logo');

        return view('advertisers.printSingleCoupon', compact('market', 'advertiser', 'coupon'));
    }
}
