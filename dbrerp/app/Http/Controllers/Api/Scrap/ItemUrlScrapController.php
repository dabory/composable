<?php

namespace App\Http\Controllers\Api\Scrap;

use App\Http\Controllers\Controller;
use App\Services\Api23GateTokenService;
use App\Services\Scrap\ItemUrlScrapService;
use Exception;
use Illuminate\Http\Request;

class ItemUrlScrapController extends Controller
{
    private $api23GateTokenService;
    private $itemUrlScrapService;

    public function __construct(
        Api23GateTokenService $api23GateTokenService,
        ItemUrlScrapService $itemUrlScrapService
    )
    {
        $this->api23GateTokenService = $api23GateTokenService;
        $this->itemUrlScrapService = $itemUrlScrapService;
    }

    public function store(Request $request)
    {
        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
        if ($result['error']) {
            return response()->json($result['message'], 401);
        }

        $request = json_decode($request->getContent(), true);

        try {
            $response = $this->itemUrlScrapService->execute($result['data'], $request);

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json('Unauthorized', 401);
        }
    }
}
