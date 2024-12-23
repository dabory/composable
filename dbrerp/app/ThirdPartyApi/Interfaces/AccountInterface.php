<?php

namespace App\ThirdPartyApi\Interfaces;

interface AccountInterface
{
    function getDailyBankAccountLog(
        $bankAccountNum,
        $baseDate
    );
}
