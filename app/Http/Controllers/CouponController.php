<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Coupon;
use App\Market;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $advertisers = Advertiser::where('market_id', $market->id)
            ->with('coupons')->get();

        $coupons = Coupon::where('market_id', $market->id)
            ->with('advertisers')->get();

        $activities = Coupon::where('market_id', $market->id)
            ->where('category_id', 1)
            ->with('advertisers')->get();

        $dining = Coupon::where('market_id', $market->id)
            ->where('category_id', 2)
            ->with('advertisers')->get();

        $shopping = Coupon::where('market_id', $market->id)
            ->where('category_id', 3)
            ->with('advertisers')->get();

        return view('coupons.index', compact('market', 'activities', 'dining', 'shopping', 'advertisers'));
    }


}
