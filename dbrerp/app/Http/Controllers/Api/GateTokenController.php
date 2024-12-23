<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CallApiService;
use Exception;
use Illuminate\Support\Str;

class GateTokenController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function store()
    {
        if (empty(request('AppBase64'))) {
            return $this->unauthorizedResponse();
        }
        $apiType = Str::snake(request('ApiType', 'main'));

        try {
            $query = [
                'ClientId' => config("app.api.{$apiType}.ClientId"),
                'BeforeBase64' => config("app.api.{$apiType}.BeforeBase64"),
                'AppBase64' => request('AppBase64')
            ];

            $response = $this->callApiService->getGateToken($query, $apiType);
        } catch (Exception $e) {
            return $this->tokenNotFoundResponse();
        }

        if (isset($response['GateToken']) && $gateToken = $response['GateToken']) {
            return [ 'ApiUrl' => env(Str::upper($apiType) . '_API_URL'), 'GateToken' => $gateToken ];
        }

        return $this->unauthorizedResponse();
    }

    public function test()
    {
        $apiType = Str::snake(request('ApiType', 'main'));

        try {
            $query = [
                'ClientId' => config("app.api.{$apiType}.ClientId"),
                'BeforeBase64' => config("app.api.{$apiType}.BeforeBase64"),
            ];

            $response = $this->callApiService->getGateToken($query, 'main');
        } catch (Exception $e) {
            return $this->tokenNotFoundResponse();
        }

        if (isset($response['GateToken']) && $gateToken = $response['GateToken']) {
            return [ 'GateToken' => $gateToken ];
        }

        return $this->unauthorizedResponse();
    }

    public function unauthorizedResponse()
    {
        return response()->json('Unauthorized', 401);
    }

    public function tokenNotFoundResponse()
    {
        return response()->json('GateToken Not Found', 505);
    }
}
