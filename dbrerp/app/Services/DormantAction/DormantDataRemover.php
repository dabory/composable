<?php

namespace App\Services\DormantAction;

use App\Services\CallApiService;

class DormantDataRemover
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function removeDormantData($gateToken): bool
    {
        $dormantMemberMove = $this->callApiService->callApi([
            'url' => 'dormant-member-finish',
            'data' => [
                'req' => ''
            ],
            'headers' => [
                'GateToken' => $gateToken
            ]
        ]);

        if ($this->callApiService->verifyApiError($dormantMemberMove)) {
            return false;
        }
        return true;
    }
}
