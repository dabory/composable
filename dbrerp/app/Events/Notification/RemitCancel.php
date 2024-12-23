<?php

namespace App\Events\Notification;

use Illuminate\Foundation\Events\Dispatchable;

class RemitCancel
{
    use Dispatchable;

    public $sorderId;

    public function __construct(int $sorderId)
    {
        $this->sorderId = $sorderId;
    }
}
