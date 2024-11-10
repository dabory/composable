<?php

namespace App\Interfaces;

interface WithdrawInterface
{
    function execute($gateToken);
}
