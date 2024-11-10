<?php

namespace App\Services;

use App\Services\CallApiService;

class MessageVerifyService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function send($mobileNo, $appName = 'Dabory')
    {
        $smsCert = rand(100000, 999999);
        $reqInfo = [
            'number' => $smsCert,
            'date' => date('YmdHis'),
            'mobile_no' => $mobileNo
        ];

        $data = [
            'title' => '본인확인',
            'msg' => "[$appName] 본인확인 인증번호는 [{$smsCert}]입니다. 정확히 입력해주세요.",
            'receiver' => $mobileNo,
        ];

        session()->put('smsCert', $reqInfo);
//        return session('smsCert.number');
        $request = request()->create('/dabory-app/send/text', 'POST', $data);

        return app()->handle($request);
    }
}
