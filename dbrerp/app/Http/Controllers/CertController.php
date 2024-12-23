<?php

namespace App\Http\Controllers;

use App\Services\CallApiService;
use App\Services\Msg\MailTemplateService;
use App\Services\Msg\TextTemplateService;
use Exception;
use Illuminate\Http\Request;

class CertController extends Controller
{
    private $mailTemplateService;
    private $textTemplateService;

    public function __construct(MailTemplateService $mailTemplateService, TextTemplateService $textTemplateService)
    {
        $this->mailTemplateService = $mailTemplateService;
        $this->textTemplateService = $textTemplateService;
    }

    public function mail(Request $request)
    {
        $certNumber = rand(100000, 999999);
        $reqInfo = [
            'number' => $certNumber,
            'date' => date('YmdHis'),
            'time' => time(),
            'email' => $request['ToMail']
        ];
        session()->put('mailCert', $reqInfo);

        try {
            if (! $this->mailTemplateService->send($request['Component'], [ 'C11' => $certNumber ],
                $request['ToMail'], $request['Subject'])) {
                return response()->json([ 'error' => true, 'message' => 'Failed to send password reset email, please try again.']);
            }

        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => 'Unauthorized']);
        }

        return response()->json(['error' => false, 'message' => 'Success']);
    }

    public function mobile(Request $request)
    {
        $receiver = $request['MobileNo'];
        $brandCode = $request['BrandCode'];
        $smsCert = rand(100000, 999999);
        $reqInfo = [
            'number' => $smsCert,
            'date' => date('YmdHis'),
            'time' => time(),
            'mobile_no' => $receiver
        ];

        if (isset($request['Title']) && isset($request['Msg'])) {
            $title = $request['Title'];
            $msg = $request['Msg'];
        } else {
            $title ='본인확인';
            $msg ="[Dabory] 본인확인 인증번호는 [{$smsCert}]입니다. 정확히 입력해주세요.";
            session()->put('smsCert.'.$request['Name'], $reqInfo);
        }

        $data = [
            "Title" => $title,
            "Msg" => $msg,
            'SmsCert' => $smsCert,
            'CompanyName' => env('APP_NAME')
        ];
        $response = $this->textTemplateService->send($title, $msg, $receiver, $data, 'seller-confirm-1',);
        // $response = $this->smsService->sendMessage($title, $msg, $receiver, $brandCode);

        return response()->json(['error' => false, 'message' => $response]);
    }
}
