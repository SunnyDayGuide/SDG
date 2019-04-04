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
        $coupons = Coupon::where('market_id', $market->id)->active()->inRandomOrder()->get();

        $activities = $coupons->where('category_id', 1);

        $dining = $coupons->where('category_id', 2);

        $shopping = $coupons->where('category_id', 3);

        $entertainment = $coupons->where('category_id', 4);

        return view('coupons.index', compact('market', 'activities', 'dining', 'shopping', 'entertainment'));
    }


}
