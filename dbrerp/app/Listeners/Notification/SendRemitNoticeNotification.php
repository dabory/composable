<?php

namespace App\Listeners\Notification;

use App\Events\Notification\RemitNotice;
use App\Interfaces\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;

class SendRemitNoticeNotification
{
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(RemitNotice $event)
    {
        $sorder = $event->sorder;

        // 무통장 입금 주문 일 때
        if ($sorder['C8'] === 'Remit') {
            // 입력된 데이터
            $data = $sorder['C15']; // 예: "기업은행 389-129699-04-018 주식회사 픽액스"

            // 데이터를 공백 기준으로 나눕니다
            $parts = explode(' ', $data, 3); // 3개의 부분으로 나누기

            if (count($parts) === 3) {
                // 각 부분을 변수로 매핑
                $bank = $parts[0];        // 은행명: "기업은행"
                $account = $parts[1];     // 계좌번호: "389-129699-04-018"
                $depositor = $parts[2];   // 예금주: "주식회사 픽액스"

                // 입금요청 알림톡 전송
                $this->notificationService->sendTemplate(
                    'text-remit-notice',
                    $sorder['C17'],
                    [
                        env('APP_NAME'),
                        $sorder['C16'],
                        $sorder['C1'],
                        $sorder['D9'],
                        $bank,
                        $account,
                        $depositor,
                        number_format($sorder['D10']),
                        'blanker.daboryhost.com',
                        'blanker.daboryhost.com',
                        ''
                    ],
                    [
                        '쇼핑몰이름',
                        'NAME',
                        'ORDERID',
                        'PRODUCT',
                        'BANK',
                        'ACCOUNT',
                        'DEPOSITOR',
                        'PRICE',
                        'DOMAIN_MOBILE',
                        'DOMAIN_PC',
                        'AUTOCANCELDATE'
                    ],
                );
            }
        }

        Log::info("입금안내 알림톡 전송: 주문번호 {$sorder['C1']}");
    }
}
