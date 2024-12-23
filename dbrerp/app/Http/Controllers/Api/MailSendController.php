<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api23GateTokenService;
use App\Services\Msg\MailTemplateService;
use Illuminate\Http\Request;
use App\Services\CallApiService;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    private $callApiService;
    private $mailTemplateService;
    private $api23GateTokenService;

    public function __construct(
        CallApiService $callApiService,
        MailTemplateService $mailTemplateService,
        Api23GateTokenService $api23GateTokenService
    )
    {
        $this->callApiService = $callApiService;
        $this->mailTemplateService = $mailTemplateService;
        $this->api23GateTokenService = $api23GateTokenService;
    }

    public function store(Request $request)
    {
        try {
            $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
            if ($result['error']) {
                return response()->json($result['message'], 401);
            }

            $request = json_decode($request->getContent(), true);
            if (! $this->mailTemplateService->send($request['Component'], $request['Data'],
                $request['ToMail'], $request['Subject'], $result['data'])) {
                return response()->json([ 'error' => true, 'message' => 'Failed to send password reset email, please try again.']);
            }

        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => 'Unauthorized']);
        }

        return response()->json(['error' => false, 'message' => 'Success']);
    }

    public function testSend(Request $request)
    {
        try {
            $request = json_decode($request->getContent(), true);
            if (! $this->mailTemplateService->testSend($request['Component'], $request['Data'],
                $request['ToMail'], $request['Subject'])) {
                return response()->json([ 'error' => true, 'message' => 'Failed to send password reset email, please try again.']);
            }

        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => 'Unauthorized']);
        }

        return response()->json(['error' => false, 'message' => 'Success']);
    }
}
