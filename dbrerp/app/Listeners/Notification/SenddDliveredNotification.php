<?php

namespace App\Listeners\Notification;

use App\Events\Notification\Delivered;
use App\Interfaces\NotificationServiceInterface;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Log;

class SenddDliveredNotification
{
    protected $notificationService;
    protected $callApiService;

    public function __construct(CallApiService $callApiService, NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(Delivered $event)
    {
        $this->notificationService->sendTemplate(
            'text-delivered',
            $sorder['ReceiverMobile'],
            [
                env('APP_NAME'),
                $sorder['ReceiverContact'],
                $sorder['FirstItem'],
               'blanker.daboryhost.com',
               'blanker.daboryhost.com'
            ],
            [
                '쇼핑몰이름',
                'NAME',
                'PRODUCT',
                'DOMAIN_MOBILE',
                'DOMAIN_PC',
            ],
        );

        Log::info("배송완료 알림톡 전송: 주문번호 {$sorder['C1']}");
    }
}
