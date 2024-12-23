<?php

namespace App\Listeners\Notification;

use App\Events\Notification\MemberPasswdChanging;
use App\Interfaces\NotificationServiceInterface;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Log;

class SendMemberPasswdChangingNotification
{
    protected $notificationService;

    public function __construct(CallApiService $callApiService, NotificationServiceInterface $notificationService)
    {
        $this->callApiService = $callApiService;
        $this->notificationService = $notificationService;
    }

    public function handle(MemberPasswdChanging $event)
    {
        $resetCode = $event->resetCode;

        $response = $this->callApiService->callApi([
            'url' => 'member-pick',
            'data' => [
                'Page' => [
                    [ 'ResetCode' => $resetCode ]
                ]
            ]
        ]);
        $member = $response['Page'][0];

        $response = $this->callApiService->callApi([
            'url' => 'member-ext-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => $member['Id'] ]
                ]
            ]
        ]);
        $memberExt = $response['Page'][0];

        // 회원비번변경요청중 알림톡 전송
        $this->notificationService->sendTemplate(
            'text-member-passwd-changing',
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

        Log::info("회원비번변경요청중 알림톡 전송: 주문번호 {$member['Email']}");
    }
}
