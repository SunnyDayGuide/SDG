<?php

namespace App\Http\Controllers;

use App\Bucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class BucketItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cookieValue = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstOrCreate(['uuid' => $cookieValue]);

        if ($request->class == 'App\Advertiser') {
            $bucket->advertisers()->attach($request->id);
        }

        if ($request->class == 'App\Distributor') {
            $bucket->distributors()->attach($request->id);
        }

        if ($request->class == 'App\Show') {
            $bucket->shows()->attach($request->id);
        }

        if ($request->class == 'App\Coupon') {
            $bucket->coupons()->attach($request->id);
        }

        if ($request->class == 'App\Event') {
            $bucket->events()->attach($request->id);
        }

         if ($request->class == 'App\Article') {
            $bucket->articles()->attach($request->id);
        }

        return response('ok');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cookieValue = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $cookieValue);

        // $bucketable_id = $request->id;
        // $item = $bucket->model()->where('id', $bucketable_id)->first();
        // dd($item->pivot->created_at);

        $attributes = [
        	'notes' => $request->notes,
        	'completed' => $request->completed
        ];

        if ($request->class == 'App\Advertiser') {
            $bucket->advertisers()->updateExistingPivot($request->id, $attributes);
        }

        if ($request->class == 'App\Distributor') {
            $bucket->distributors()->updateExistingPivot($request->id, $attributes);
        }

        if ($request->class == 'App\Show') {
            $bucket->shows()->updateExistingPivot($request->id, $attributes);
        }

        if ($request->class == 'App\Coupon') {
            $bucket->coupons()->updateExistingPivot($request->id, $attributes);
        }

        if ($request->class == 'App\Event') {
            $bucket->events()->updateExistingPivot($request->id, $attributes);
        }

         if ($request->class == 'App\Article') {
            $bucket->articles()->updateExistingPivot($request->id, $attributes);
        }     
        
        return response('ok');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cookieValue = Cookie::get('sunny_day_guide_bucket');
        $bucket = Bucket::firstWhere('uuid', $cookieValue);

        if ($request->class == 'App\Advertiser') {
            $bucket->advertisers()->detach($request->id);
        }

        if ($request->class == 'App\Distributor') {
            $bucket->distributors()->detach($request->id);
        }

        if ($request->class == 'App\Show') {
            $bucket->shows()->detach($request->id);
        }

        if ($request->class == 'App\Coupon') {
            $bucket->coupons()->detach($request->id);
        }

        if ($request->class == 'App\Event') {
            $bucket->events()->detach($request->id);
        }

         if ($request->class == 'App\Article') {
            $bucket->articles()->detach($request->id);
        }

        return response('ok');
    }

}
