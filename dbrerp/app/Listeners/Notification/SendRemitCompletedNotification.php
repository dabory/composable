<?php

namespace App\Listeners\Notification;

use App\Events\Notification\RemitCompleted;
use App\Interfaces\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;

class SendRemitCompletedNotification
{
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(RemitCompleted $event)
    {
        $sorder = $event->sorder;

        $this->notificationService->sendTemplate(
            'text-remit-completed',
            $sorder['ReceiverMobile'],
            [
                env('APP_NAME'),
                number_format($sorder['TotalAmt']),
                $sorder['ReceiverContact'],
                $sorder['SorderDate'],
                $sorder['SorderNo'],
                $sorder['FirstItem'],
                'blanker.daboryhost.com',
                'blanker.daboryhost.com',
            ],
            [
                '쇼핑몰이름',
                'PRICE',
                'NAME',
                'DATE',
                'ORDERID',
                'PRODUCT',
                'DOMAIN_MOBILE',
                'DOMAIN_PC'
            ],
        );

        Log::info("입금완료확인 알림톡 전송: 주문번호 {$sorder['C1']}");
    }
}
