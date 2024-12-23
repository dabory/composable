<?php

namespace App\Events\Notification;

use Illuminate\Foundation\Events\Dispatchable;

class MemberPasswdChanging
{
    use Dispatchable;

    public $resetCode;

    public function __construct($resetCode)
    {
        $this->resetCode = $resetCode;
    }
}
