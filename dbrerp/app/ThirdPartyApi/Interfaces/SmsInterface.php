<?php

namespace App\ThirdPartyApi\Interfaces;

interface SmsInterface
{
    function sendMessage($title, $msg, $receiver);
}
