<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('member.is_member')) {
            return redirect()->to('/');
        }
        return $next($request);
    }
}
