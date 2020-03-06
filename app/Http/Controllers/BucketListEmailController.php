<?php

namespace App\Http\Controllers;

use App\Bucket;
use App\Mail\BucketListMail;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BucketListEmailController extends Controller
{
    public function send(Request $request)
    {
        $bucket = Bucket::find($request->bucket);

        $email = $request->validate([
            'email' => 'required|email',
        ]);

        $marketId = $bucket->items()->first()->market_id;

        $market = Market::find($marketId);

    	Mail::to($email)
            ->send(new BucketListMail($market, $bucket));

        return response('ok');
    }

}
