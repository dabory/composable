<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanySort
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
        $member = session('member');
        if ($member && $member['CompanySort'] === 'AA') {
            return redirect()->route('member-login')->with(['url.intended' => url()->current()]);
        }
        return $next($request);
    }
}
