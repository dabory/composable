<?php

namespace App\Services\DormantAction;

use App\Services\CallApiService;
use App\Services\Msg\MailTemplateService;
use Carbon\Carbon;

class DormantAccountEmailNotifier
{
    private $callApiService;
    private $mailTemplateService;

    public function __construct(CallApiService $callApiService, MailTemplateService $mailTemplateService)
    {
        $this->callApiService = $callApiService;
        $this->mailTemplateService = $mailTemplateService;
    }

    public function sendNotificationEmail($gateToken, $setup): bool
    {
        $formDt = Carbon::now()->startOfDay();
        $toDt = Carbon::now()->endOfDay();
        $toDt->subMonths($setup['ActiveMonth'])->addDays($setup['ActiveNoticeDays']);
        $formDt->subMonths($setup['ActiveMonth']);

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-page',
            'data' => [
                'PageVars' => [
                    'Query' => "((last_login_on between $formDt->timestamp and $toDt->timestamp) and dormant_mail_on = 0) or dormant_mail_on = -1",
                    'Asc' => 'last_login_on',
                    'Limit' => 999999
                ]
            ],
            'headers' => [
                'GateToken' => $gateToken
            ]
        ]);

        if ($this->callApiService->verifyApiError($memberPage)) {
            return false;
        }

        $dormantList = $memberPage['Page'] ?? [];
        $result = [];
        foreach ($dormantList as $member) {
            $result[] = $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.auth.dormant-inform-1', [ 'C11' => $member['Email'], 'C12' => Carbon::createFromTimestamp($member['LastLoginOn'])->addMonths($setup['ActiveMonth'])->format('Y-m-d'), 'C13' => route('member-login') ],
                $member['Email'], sprintf('[%s] 휴먼 계정 전환 안내입니다.', config('app.name')), $gateToken);
        }

        $mailSendPage = collect($dormantList)->map(function ($member, $i) use ($result) {
            $dormantMailOn = $result[$i] ? Carbon::now()->timestamp : -1;

            return ['Id' => $member['Id'], 'DormantMailOn' => $dormantMailOn];
        })->toArray();

        if (count($mailSendPage) <= 0) {
            return true;
        }

        $memberAct = $this->callApiService->callApi([
            'url' => 'member-act',
            'data' => [
                'Page' => $mailSendPage
            ],
            'headers' => [
                'GateToken' => $gateToken
            ]
        ]);

        if ($this->callApiService->verifyApiError($memberAct)) {
            return false;
        }

        return true;
    }
}
