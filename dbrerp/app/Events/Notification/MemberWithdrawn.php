<?php

namespace App\Events\Notification;

use Illuminate\Foundation\Events\Dispatchable;

class MemberWithdrawn
{
    use Dispatchable;

    public $memberId;

    public function __construct(int $memberId)
    {
        $this->memberId = $memberId;
    }
}
