<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api23GateTokenService;
use App\Services\CallApiService;
use App\Interfaces\WithdrawInterface;
use App\Interfaces\DormantInterface;
use Exception;
use Illuminate\Http\Request;

class Api23GateTokenController extends Controller
{
    private $callApiService;
    private $withdrawService;
    private $dormantService;
    private $api23GateTokenService;

    public function __construct(
        CallApiService $callApiService, WithdrawInterface $withdrawService,
        Api23GateTokenService $api23GateTokenService, DormantInterface $dormantService
    )
    {
        $this->callApiService = $callApiService;
        $this->withdrawService = $withdrawService;
        $this->dormantService = $dormantService;
        $this->api23GateTokenService = $api23GateTokenService;
    }

    public function api23Cronjobs(Request $request)
    {
        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
        if ($result['error']) {
            return response()->json($result['message'], 401);
        }

        return $this->dormantService->execute($result['data']);
//        $this->withdrawService->execute($result['data']);
    }

    public function api23Js(Request $request)
    {
        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
        if ($result['error']) {
            return response()->json($result['message'], 401);
        }

        $request = new \Illuminate\Http\Request([
            'data' => $request->getContent(),
            'encode_status' => true,
            'headers' => $this->buildHeader($result['data']),
        ]);

        return $this->callApiService->getData($request);
    }

    public function api23App(Request $request)
    {
        try {
            return $this->api23GateTokenService->callGateTokenApi($request->header('Api23Key'));
        } catch (Exception $e) {
            return response()->json('Unauthorized', 401);
        }
    }

    private function buildHeader($gateToken = false): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'FrontendHost' => url('/'),
            'RemoteIp' => request()->ip(),
            'Referer' => request()->headers->get('referer'),
        ];
        if ($gateToken) {
            $headers['GateToken'] = $gateToken;
        }

        return $headers;
    }

    public function tokenNotFoundResponse()
    {
        return response()->json('GateToken Not Found', 505);
    }
}
