<?php

namespace App\Services;

use App\Interfaces\WithdrawInterface;
use App\Services\Msg\MailTemplateService;
use Carbon\Carbon;

class WithdrawService implements WithdrawInterface
{
    private $callApiService;
    private $mailTemplateService;
    private $gateToken;

    public function __construct(CallApiService $callApiService, MailTemplateService $mailTemplateService)
    {
        $this->callApiService = $callApiService;
        $this->mailTemplateService = $mailTemplateService;
    }

    public function execute($gateToken)
    {
        $this->gateToken['main'] = $gateToken;

        $this->sendEmail();
        $this->memberFinish();
    }

    private function memberFinish()
    {
        $withdrawMemberFinish = $this->callApiService->callApi([
            'url' => 'withdraw-member-finish',
            'data' => [
                'req' => ''
            ],
            'headers' => [
                'GateToken' => $this->getGateToken('main')
            ]
        ]);

        if ($this->callApiService->verifyApiError($withdrawMemberFinish)) {
            return false;
        }

        return true;
    }

    private function sendEmail()
    {
        $setup = $this->getSetup();
        if ($this->callApiService->verifyApiError($setup)) {
            return false;
        }

        $dt = Carbon::now();
//         예를 들어 withdraw_on에 탈톼일: 3월30일 들어가있고 3일전에 메일을 보내려고하면,
//        오늘날짜가 만약 3월27일이라면 메일을 보내야하니 오늘날짜 + 3해서 시작시간부터 끝시간까지 가져옴
        $dt->addDays($setup['ActiveNoticeDays']);
        $formTimestamp = $dt->startOfDay()->timestamp;
        $toTimestamp = $dt->endOfDay()->timestamp;

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-page',
            'data' => [
                'PageVars' => [
                    'Query' => "withdraw_on between $formTimestamp and $toTimestamp",
                    'Asc' => 'withdraw_on',
                    'Limit' => 999999
                ]
            ],
            'headers' => [
                'GateToken' => $this->getGateToken('main')
            ]
        ]);

        if ($this->callApiService->verifyApiError($memberPage)) {
            return false;
        }

        foreach ($memberPage['Page'] ?? [] as $member) {
            $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.auth.withdraw-inform-1', [ 'C11' => $member['Email'], 'C12' => Carbon::createFromTimestamp($member['WithdrawOn'])->format('Y-m-d'), 'C13' => route('member-login') ],
                $member['Email'], sprintf('[%s] 탈퇴 계정 전환 안내입니다.', config('app.name')), $this->getGateToken('main'));
        }

        return true;
    }

    private function getGateToken($type)
    {
        if ($type === 'all') {
            return $this->gateToken;
        }

        return $this->gateToken[$type ?: 'main'];
    }

    private function getSetup()
    {
        return $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'withdraw-default',
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);
    }
}
