<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProMember
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
        if (session()->missing('member.is_member')) {
            if (isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] === 'iframe') {
                echo "<script>window.top.location.href = '/member-login'; </script>";
            } else {
                return redirect()->route('member-login')->with(['url.intended' => url()->current()]);
            }
        }
        return $next($request);
    }
}
