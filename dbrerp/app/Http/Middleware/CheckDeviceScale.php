<?php

namespace App\Http\Middleware;

use Closure;
use http\Cookie;
use Illuminate\Http\Request;

class CheckDeviceScale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $deviceScale = env('DEVICE_SCALE');
        session()->put('ConnectionDevice', 'desktop');

        if (isset($deviceScale)) {
            $screenWidth = saveJavaScriptCookie( 'screenWidth' );
            $screenHeight = saveJavaScriptCookie( 'screenHeight' );
            $connectionDevice = 'desktop';

            if (empty($screenWidth) || empty($screenHeight)) {
                return $next($request);
            }

            $deviceScaleList = explode(';', $deviceScale);
            foreach ($deviceScaleList as $deviceScale) {
                [$device, $scale] = explode('>', $deviceScale);

                if ($screenWidth > $scale) {
                    $connectionDevice = $device;
                }
            }
            session()->put('ConnectionDevice', $connectionDevice);
        }

        return $next($request);
    }
}
