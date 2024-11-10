<?php

namespace App\Http\Controllers\Front\Dabory\Myapp\Member;

use App\Http\Controllers\Controller;
use App\Services\Msg\TextTemplateService;

class MemberEditController extends Controller
{
    private $textTemplateService;

    public function __construct(TextTemplateService $textTemplateService)
    {
        $this->textTemplateService = $textTemplateService;
    }

    public function store()
    {
        if (request('cert_number') != session('smsCert.number')) {
            notify()->error(_e('Action failed'), 'Error', 'bottomRight');
            return response()->json(['success' => false, 'message' => '인증번호가 올바르지 않습니다.'], 400);
        }

        session()->forget('smsCert.number');
        session()->put('smsCert.code', 200);

        return response()->json(['success' => true, 'message' => '인증이 완료되었습니다.']);
    }

    public function sendCert()
    {
        $smsCert = rand(100000, 999999);
        $reqInfo = [
            'number' => $smsCert,
            'date' => date('YmdHis'),
            'mobile_no' => request('mobile_no')
        ];

        $title = '본인확인';
        $msg = "[Dabory] 본인확인 인증번호는 [{$smsCert}]입니다. 정확히 입력해주세요.";
        $receiver = request('mobile_no');
        $data = [
            "Title" => $title,
            "Msg" => $msg,
            'SmsCert' => $smsCert,
            'CompanyName' => env('APP_NAME')
        ];
        session()->put('smsCert', $reqInfo);
        // $response = $this->smsService->sendMessage($title, $msg, $receiver, 'text-auth-code', $smsCert);
        $response = $this->textTemplateService->send($title, $msg, $receiver, $data, 'text-auth-code',);
//        $response = $this->messageVerifyService->send(request('mobile_no'));

        return response()->json($response);
    }
}

