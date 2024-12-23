<?php

namespace App\Listeners\Notification;

use App\Events\Notification\OrderCompleted;
use App\Interfaces\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;

class SendOrderCompletedNotification
{
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(OrderCompleted $event)
    {
        $sorder = $event->sorder;

        // 주문완료안내 알림톡 전송
        $this->notificationService->sendTemplate(
            'text-order-completed',
            $sorder['C17'],
            [
                env('APP_NAME'),
                $sorder['C16'],
                $sorder['C2'],
                $sorder['C1'],
                $sorder['D9'],
                number_format($sorder['D10']),
                'blanker.daboryhost.com',
                'blanker.daboryhost.com'
            ],
            [
                '쇼핑몰이름',
                'NAME',
                'DATE',
                'ORDERID',
                'PRODUCT',
                'PRICE',
                'DOMAIN_MOBILE',
                'DOMAIN_PC'
            ],
        );

        Log::info("주문 완료 알림톡 전송: 주문번호 {$sorder['C1']}");
    }
}
