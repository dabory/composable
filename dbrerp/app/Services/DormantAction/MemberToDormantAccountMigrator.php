<?php

namespace App\Services\DormantAction;

use App\Services\CallApiService;

class MemberToDormantAccountMigrator
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function migrateMemberToDormantAccount($gateToken): bool
    {
        $dormantMemberMove = $this->callApiService->callApi([
            'url' => 'dormant-member-move',
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
