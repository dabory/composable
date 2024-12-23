<?php

namespace App\Listeners\Notification;

use App\Events\Notification\ShippedAll;
use App\Interfaces\NotificationServiceInterface;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Log;

class SendShippedAllNotification
{
    protected $notificationService;
    protected $callApiService;

    public function __construct(CallApiService $callApiService, NotificationServiceInterface $notificationService)
    {
        $this->callApiService = $callApiService;
        $this->notificationService = $notificationService;
    }

    public function handle(ShippedAll $event)
    {
        $sorder = $event->sorder;

        // 택배사 데이터를 가져옵니다.
        $etcPage = $this->callApiService->callApi([
            'url' => 'etc-page',
            'data' => [
                'PageVars' => [
                    'Query' => "etc_type = 'smart-courier' and select_name = 'korean'"
                ],
                'Asc' => 'sort_no',
                'Limit' => 9999
            ]
        ]);

        if (!isset($etcPage['Page'])) {
            Log::error('택배사코드 데이터 조회 실패');
            return;
        }

        $courierCodes = $etcPage['Page'];

        // $sorder['CourierCode'] 값
        $courierCode = $sorder['CourierCode'];

        // $courierCodes 배열에서 Value 값을 기준으로 Caption 값을 찾기
        $courierCaption = null;

        foreach ($courierCodes as $code) {
            if (isset($code['Value']) && $code['Value'] == $courierCode) {
                $courierCaption = $code['Caption'];
                break;
            }
        }

        // 결과 확인
        if (! $courierCaption) {
            // Caption 값이 있을 경우
            return Log::warning('일치하는 택배사 정보를 찾을 수 없습니다.');
        }


        $this->notificationService->sendTemplate(
            'text-shipped-all',
            $sorder['ReceiverMobile'],
            [
                env('APP_NAME'),
                $sorder['ReceiverContact'],
                $sorder['SorderNo'],
                $courierCaption,
                $sorder['InvoiceNo'],
            ],
            [
                '쇼핑몰이름',
                'NAME',
                'ORDERID',
                'DELICOM',
                'DELINUM',
            ],
        );

        Log::info("전체배송확인 알림톡 전송: 주문번호 {$sorder['C1']}");
    }
}
