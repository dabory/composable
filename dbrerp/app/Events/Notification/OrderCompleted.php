<?php

namespace App\Events\Notification;

use Illuminate\Foundation\Events\Dispatchable;

class OrderCompleted
{
    use Dispatchable;

    public $sorder;

    public function __construct(array $sorder)
    {
        $this->sorder = $sorder;
    }
}
