<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CheckCookieConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Cookie::has('laravel_cookie_consent')) {
            if (!Cookie::has('sunny_day_guide_bucket')) {
                $uuid = Str::uuid();
                // $bucket = Bucket::create(['id' => $uuid]);
                Cookie::queue('sunny_day_guide_bucket', $uuid, 525600);
            }
        }
        return $next($request);
    }

}
