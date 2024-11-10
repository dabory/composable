<?php

namespace App\Services;

use App\Services\CallApiService;
use Exception;

class Api23GateTokenService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function getToken($api23Key)
    {
        try {
            $response = $this->callApiService->callApi([
                'url' => 'gate-token-api23hash-get',
                'data' => [
                    'Api23Key' => $api23Key
                ],
                'headers' => $this->buildHeader()
            ], 'true');

            if ($this->callApiService->verifyApiError($response)) {
                if ($response['apiStatus'] === 505) {
                    $response = $this->callGateTokenApi($api23Key);

                    if ($this->callApiService->verifyApiError($response)) {
                        return ['error' => true, 'message' => $response];
                    }
                } else {
                    return ['error' => true, 'message' => 'Unauthorized'];
                }
            }
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Unauthorized'];
        }

        return ['error' => false, 'data' => $response['GateToken']];
    }

    public function callGateTokenApi($api23Key)
    {
        return $this->callApiService->getGateToken([
            'ClientId' => config('app.api.main.ClientId'),
            'BeforeBase64' => config('app.api.main.BeforeBase64'),
            'Api23eKeyPair' => env('API23E_KEY_PAIR'),
            'Api23Key' => $api23Key,
        ], 'main');
    }

    private function buildHeader($gateToken = null): array
    {
        $headers = $this->callApiService->basicHeader();

        if ($gateToken) {
            $headers['GateToken'] = $gateToken;
        }

        return $headers;
    }
}
