<?php

namespace App\Http\Middleware;

use Closure;
use http\Cookie;
use Illuminate\Http\Request;

class CheckUnderConstruction
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
        $underConstruction = env('UNDER_CONSTRUCTION_PATH');

        if (!empty($underConstruction)) {
            return redirect()->route('under-construction');
        }

        return $next($request);
    }
}
