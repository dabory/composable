<?php

namespace App\Services;

class DormantService
{
    private $callApiService;
    private $gateToken;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function setGateToken($gateToken)
    {
        return $this->gateToken = $gateToken;
    }

    public function getGateToken($type)
    {
        if ($type === 'all') {
            return $this->gateToken;
        }

        return $this->gateToken[$type ?: 'main'];
    }

    public function setMainToken($appBase64 = '')
    {
        $query = [
            'ClientId' => config('app.api.main.ClientId'),
            'BeforeBase64' => config('app.api.main.BeforeBase64'),
            'AppBase64' => $appBase64
        ];

        $this->gateToken['main'] = $this->callApiService->getGateToken($query, 'main')['GateToken'];
    }

    public function getSetup()
    {
        $dormantDefault = $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'dormant-default',
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($dormantDefault['GuestApp']) {
            $appGuest = $this->getAppGuestPage($dormantDefault['GuestApp']);
            $this->setAppGateToken($appGuest['AppName'], $appGuest['ApiUri'], $appGuest['AppBase64']);
        }

        return $dormantDefault;
    }

    public function getAppGuestPage($appName)
    {
        return $this->callApiService->callApi([
            'url' => 'app-guest-page',
            'data' => [
                'PageVars' => [
                    'Query' => "app_name = '$appName' and is_on_use = 1",
                    'Limit' => 1,
                ]
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ])['Page'][0];
    }

    public function setAppGateToken($appName, $apiUri, $appBase64)
    {
        $response = \Unirest\Request::post(
            $apiUri . '/gate-token-get',
            [ 'Accept' => 'application/json' ],
            [ 'AppBase64' => $appBase64 ]
        );

        if ($response->code == 200) {
            $data = json_encode($response->body ?? []);
            $this->gateToken[$appName] = json_decode($data, true);
        } else {
            return false;
        }
    }
}
