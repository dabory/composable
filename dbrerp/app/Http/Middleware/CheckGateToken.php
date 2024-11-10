<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\CallApiService;
use App\Http\Controllers\Api\ApiController;

class CheckGateToken
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//         session()->put('GateToken.erp', 'duoICbFSNRRoxXoIaC0G');

        if (empty(session('GateToken'))) {
            $this->callApiService->setGateToken();
        }
//        dump(session('GateToken'));

        return $next($request);
    }
}
