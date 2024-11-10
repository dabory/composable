<?php

namespace App\Http\Middleware;

use App\Helpers\Utils;
use App\Services\CallApiService;
use Closure;
use Illuminate\Http\Request;

class AppTokenManager
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
        if (request()->has('bpa')) {
            $bpa = Utils::bpaDecoding($request->get('bpa'));
            $mainAppId = $bpa['main_app_id'];
            $guestAppId = $bpa['guest_app_id'];

            view()->share('mainAppName', $this->appNameFor($mainAppId));
            view()->share('guestAppName', $this->appNameFor($guestAppId));

            $appGuestPage = $this->getAppGuestPage($mainAppId, $guestAppId);
//            dd($appGuestPage);

            foreach ($appGuestPage['Page'] ?? [] as $appGuest) {
                $appName = $appGuest['AppName'];
                if (session()->has("GateToken.$appName")) { continue; }

                if ($response = $this->getAppGateToken($appGuest['ApiUri'], $appGuest['AppBase64'])) {
                    session()->put("GateToken.$appName", $response);
                }
            }
        }

        return $next($request);
    }

    public function appNameFor($appId)
    {
        if (empty($appId)) { return null; }

        return app(CallApiService::class)->callApi([
            'url' => 'app-guest-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(id = $appId) and is_on_use = 1",
                    'Limit' => 2,
                ]
            ]
        ])['Page'][0]['AppName'];
    }

    public function getAppGateToken($apiUri, $appBase64)
    {
        $response = \Unirest\Request::post(
            $apiUri . '/gate-token-get',
            [ 'Accept' => 'application/json' ],
            [ 'AppBase64' => $appBase64 ]
        );

        if ($response->code == 200) {
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            return false;
        }
    }

    public function getAppGuestPage($mainAppId, $guestAppId)
    {
        return app(CallApiService::class)->callApi([
            'url' => 'app-guest-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(id = $mainAppId or id = $guestAppId) and is_on_use = 1",
                    'Limit' => 2,
                ]
            ]
        ]);
    }
}
