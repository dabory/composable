<?php

namespace App\Providers;

use App\Events\Notification\OrderCompleted;
use App\Events\Notification\RemitCancel;
use App\Events\Notification\RemitCompleted;
use App\Events\Notification\RemitNotice;
use App\Events\Notification\ShippedAll;
use App\Events\Notification\MemberPasswdChanging;
use App\Events\Notification\MemberWithdrawn;
use App\Listeners\Notification\SendOrderCompletedNotification;
use App\Listeners\Notification\SendRemitCancelNotification;
use App\Listeners\Notification\SendRemitCompletedNotification;
use App\Listeners\Notification\SendRemitNoticeNotification;
use App\Listeners\Notification\SendShippedAllNotification;
use App\Listeners\Notification\SendMemberPasswdChangingNotification;
use App\Listeners\Notification\SendMemberWithdrawnNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class NotificationEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderCompleted::class => [
            SendOrderCompletedNotification::class,
        ],
        RemitNotice::class => [
            SendRemitNoticeNotification::class,
        ],
        RemitCancel::class => [
            SendRemitCancelNotification::class,
        ],
        RemitCompleted::class => [
            SendRemitCompletedNotification::class,
        ],
        ShippedAll::class => [
            SendShippedAllNotification::class,
        ],
        MemberPasswdChanging::class => [
            SendMemberPasswdChangingNotification::class,
        ],
        MemberWithdrawn::class => [
            SendMemberWithdrawnNotification::class,
        ],
    ];
}
