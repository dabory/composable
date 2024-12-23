<?php

namespace App\Listeners\Notification;

use App\Events\Notification\RemitCancel;
use App\Interfaces\NotificationServiceInterface;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Log;

class SendRemitCancelNotification
{
    protected $notificationService;
    protected $callApiService;

    /**
     * Create the event listener.
     *
     * @param \App\Services\CallApiService $callApiService
     * @param \App\Services\NotificationService $notificationService
     */
    public function __construct(CallApiService $callApiService, NotificationServiceInterface $notificationService)
    {
        $this->callApiService = $callApiService;
        $this->notificationService = $notificationService;
    }

    public function handle(RemitCancel $event)
    {
        // 주문 데이터를 가져옵니다.
        $sorderPick = $this->callApiService->callApi([
            'url' => 'sorder-pick',
            'data' => [
                'Page' => [
                    ['Id' => $event->sorderId]
                ]
            ]
        ]);

        if (!isset($sorderPick['Page'][0])) {
            Log::error('주문 데이터 조회 실패: ' . $event->sorderId);
            return;
        }

        $sorder = $sorderPick['Page'][0];

        // 알림톡 전송
        $this->notificationService->sendTemplate(
            'text-remit-cancel',
            $sorder['ReceiverMobile'],
            [
                env('APP_NAME'),
                $sorder['ReceiverContact'],
                $sorder['SorderNo'],
                $sorder['FirstItem'],
                'blanker.daboryhost.com',
                'blanker.daboryhost.com'
            ],
            [
                '쇼핑몰이름',
                'NAME',
                'ORDERID',
                'PRODUCT',
                'DOMAIN_MOBILE',
                'DOMAIN_PC'
            ]
        );

        Log::info("임금 전 취소 알림톡 발송 완료: 주문번호 {$sorder['SorderNo']}");
    }
}
