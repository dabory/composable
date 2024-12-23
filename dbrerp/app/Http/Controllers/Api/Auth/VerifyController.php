<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api23GateTokenService;
use App\Services\Msg\MailTemplateService;
use App\ThirdPartyApi\Interfaces\SmsInterface;
use Illuminate\Http\Request;
use Exception;

class VerifyController extends Controller
{
    private $mailTemplateService;
    private $api23GateTokenService;
    public function __construct(MailTemplateService $mailTemplateService,
                                Api23GateTokenService $api23GateTokenService,
                                SmsInterface $smsService)
    {
        $this->mailTemplateService = $mailTemplateService;
        $this->api23GateTokenService = $api23GateTokenService;
        $this->smsService = $smsService;
    }

    public function sendEmailConfirm(Request $request)
    {
        $emailCert = rand(100000, 999999);
        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
        if ($result['error']) {
            return response()->json($result['message'], 401);
        }

        $gateToken = $result['data'];
        $data = json_decode($request->getContent(), true);
        $email = $data['Email'];

        try {
            if (! $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.auth.signup-confirm-1',
                [
                    'C11' => $emailCert
                ],
                $email, sprintf('[%s] 회원가입을 확인해주세요.', config('app.name')), $gateToken)) {
                return response()->json([ 'error' => true, 'message' => 'Failed to send password reset email, please try again.']);
            }

        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => 'Unauthorized']);
        }

        return response()->json(['error' => false, 'message' => 'Success', 'data' => $emailCert]);
    }

    public function sendSmsConfirm(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $mobileNo = $data['MobileNo'];

        $smsCert = rand(100000, 999999);

        $title ='본인확인';
        $msg ="[Dabory] 본인확인 인증번호는 [{$smsCert}]입니다. 정확히 입력해주세요.";
        $receiver = $mobileNo;

        $response = $this->smsService->sendMessage($title, $msg, $receiver);
        if (! $response['Success']) {
            return response()->json(['error' => true, 'message' => $response['Message']]);
        }


        return response()->json(['error' => false, 'message' => 'Success', 'data' => $smsCert]);

    }

//    public function certEmailConfirm(Request $request)
//    {
//        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
//        if ($result['error']) {
//            return response()->json($result['message'], 401);
//        }
//
//        $data = json_decode($request->getContent(), true);
//        $code = $data['Code'];
//        $response = $this->api23GateTokenService->callApi23Js(
//            $result['data'],
//            'member-activate',
//            [
//                'ActivateCode' => $code,
//            ],
//            false
//        );
//
//        if (isset($response['data']['apiStatus'])) {
//            return response()->json(['error' => true, 'message' => $response['data']['body']]);
//        }
//
//        return response()->json(['error' => false, 'message' => 'Success']);
//    }
}
