<?php

namespace App\Listeners\Notification;

use App\Events\Notification\MemberWithdrawn;
use App\Interfaces\NotificationServiceInterface;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Log;

class SendMemberWithdrawnNotification
{
    protected $notificationService;
    protected $callApiService;

    public function __construct(CallApiService $callApiService, NotificationServiceInterface $notificationService)
    {
        $this->callApiService = $callApiService;
        $this->notificationService = $notificationService;
    }

    public function handle(MemberWithdrawn $event)
    {
        $memberId = $event->memberId;

        $response = $this->callApiService->callApi([
                'url' => 'member-pick',
                'data' => [
                    'Page' => [
                        [ 'Id' => $memberId ]
                    ]
                ]
            ]);
        $member = $response['Page'][0];

        $response = $this->callApiService->callApi([
            'url' => 'member-ext-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => $memberId ]
                ]
            ]
        ]);
        $memberExt = $response['Page'][0];

        // 회원탈퇴 알림톡 전송
        $this->notificationService->sendTemplate(
            'text-member-withdrawn',
            $memberExt['MobileNo'],
            [
                env('APP_NAME'),
                $member['FirstName'],
                $member['Email'],
                'blanker.daboryhost.com',
                'blanker.daboryhost.com'
            ],
            [
                '쇼핑몰이름',
                'NAME',
                'USERID',
                'DOMAIN_MOBILE',
                'DOMAIN_PC'
            ],
        );

        Log::info("회원탈퇴 알림톡 전송: 주문번호 {$member['Email']}");
    }
}
