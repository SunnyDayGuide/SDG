<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'BUCKET_Coupon',
        'BUCKET_Advertiser',
        'BUCKET_Article',
        'BUCKET_Event',
        'BUCKET_Distributor',
        'BUCKET_Show'
    ];
}
