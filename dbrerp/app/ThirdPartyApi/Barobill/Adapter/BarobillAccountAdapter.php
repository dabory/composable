<?php

namespace App\ThirdPartyApi\Barobill\Adapter;

use App\ThirdPartyApi\Barobill\Services\BarobillAccountService;
use App\ThirdPartyApi\Interfaces\AccountInterface;

class BarobillAccountAdapter implements AccountInterface
{
    private $barobillAccountService;

    public function __construct(BarobillAccountService $barobillAccountService)
    {
        $this->barobillAccountService = $barobillAccountService;
    }

    public function getDailyBankAccountLog
    (
        $bankAccountNum,
        $baseDate,
        $countPerPage = 10,
        $currentPage = 1,
        $orderDirection = 1
    )
    {
        $accountInfo = $this->barobillAccountService->getDailyBankAccountLog
        (
            $bankAccountNum,
            $baseDate,
            $countPerPage,
            $currentPage,
            $orderDirection
        );

        $bankAccountLog = $accountInfo['BankAccountLogList']['BankAccountLog'];
        return collect($bankAccountLog)->map(function ($log) {
            return [
                'BankAccountNum' => $log['BankAccountNum'],
                'Withdraw' => $log['Withdraw'],
                'Deposit' => $log['Deposit'],
                'Balance' => $log['Balance'],
                'TransDT' => $log['TransDT'],
                'TransType' => $log['TransType'],
                'TransOffice' => $log['TransOffice'],
                'TransRemark' => $log['TransRemark'],
            ];
        })->toArray();
    }
}
