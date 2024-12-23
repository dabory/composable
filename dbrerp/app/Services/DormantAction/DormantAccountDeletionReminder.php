<?php

namespace App\Services\DormantAction;

use App\Services\CallApiService;
use App\Services\Msg\MailTemplateService;
use Carbon\Carbon;

class DormantAccountDeletionReminder
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
        $dt = Carbon::now();
        $dt->subMonths($setup['FinishMonth'])->addDays($setup['FinishNoticeDays']);
        $formTimestamp = $dt->startOfDay()->timestamp;
        $toTimestamp = $dt->endOfDay()->timestamp;

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-dormant-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(created_on between $formTimestamp and $toTimestamp)",
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

        foreach ($memberPage['Page'] ?? [] as $member) {
            $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.auth.dormant-finish-1', [ 'C11' => $member['Email'], 'C12' => Carbon::createFromTimestamp($member['CreatedOn'])->addMonths($setup['FinishMonth'])->format('Y-m-d') ],
                $member['Email'], sprintf('[%s] 휴먼 계정 삭제 안내입니다.', config('app.name')), $gateToken);
        }

        return true;
    }

    public function getAppGuestPage($appName)
    {
        return $this->callApiService->callApi([
            'url' => 'app-guest-page',
            'data' => [
                'PageVars' => [
                    'Query' => "app_name = '$appName' and is_on_use = 1",
                    'Limit' => 1,
                ]
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ])['Page'][0];
    }

    public function setAppGateToken($appName, $apiUri, $appBase64)
    {
        $response = \Unirest\Request::post(
            $apiUri . '/gate-token-get',
            [ 'Accept' => 'application/json' ],
            [ 'AppBase64' => $appBase64 ]
        );

        if ($response->code == 200) {
            $data = json_encode($response->body ?? []);
            $this->gateToken[$appName] = json_decode($data, true);
        } else {
            return false;
        }
    }
}
