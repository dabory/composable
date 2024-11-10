<?php

namespace App\ThirdPartyApi\Barobill\Services;

use App\Services\CallApiService;
use App\ThirdPartyApi\Barobill\Barobill;

class BarobillSmsService extends Barobill
{
    public function __construct(CallApiService $callApiService)
    {
        parent::__construct($callApiService);
    }
}
