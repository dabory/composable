<?php

namespace App\Services;

use App\Interfaces\DormantInterface;
use App\Services\DormantAction\DormantAccountDeletionReminder;
use App\Services\DormantAction\DormantAccountEmailNotifier;
use App\Services\DormantAction\DormantDataRemover;
use App\Services\DormantAction\MemberToDormantAccountMigrator;

class DormantService implements DormantInterface
{
    private $callApiService;
    private $dormantAccountEmailNotifier;
    private $memberToDormantAccountMigrator;
    private $dormantAccountDeletionReminder;
    private $dormantDataRemover;

    public function __construct(
        CallApiService $callApiService,
        DormantAccountEmailNotifier $dormantAccountEmailNotifier,
        MemberToDormantAccountMigrator $memberToDormantAccountMigrator,
        DormantAccountDeletionReminder $dormantAccountDeletionReminder,
        DormantDataRemover $dormantDataRemover
    )
    {
        $this->callApiService = $callApiService;
        $this->dormantAccountEmailNotifier = $dormantAccountEmailNotifier;
        $this->memberToDormantAccountMigrator = $memberToDormantAccountMigrator;
        $this->dormantAccountDeletionReminder = $dormantAccountDeletionReminder;
        $this->dormantDataRemover = $dormantDataRemover;
    }

    public function execute($gateToken)
    {
        $setup = $this->getSetup($gateToken);

        $this->dormantAccountEmailNotifier->sendNotificationEmail($gateToken, $setup);
        $this->memberToDormantAccountMigrator->migrateMemberToDormantAccount($gateToken);
        $this->dormantAccountDeletionReminder->sendNotificationEmail($gateToken, $setup);
        $this->dormantDataRemover->removeDormantData($gateToken);
    }

    public function getSetup($gateToken)
    {
        return $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'dormant-default',
            ],
            'headers' => [
                'GateToken' => $gateToken
            ]
        ]);
    }
}
