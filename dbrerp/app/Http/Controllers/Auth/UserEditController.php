<?php

namespace App\Http\Controllers\Auth;

use App\Services\MessageVerifyService;
use Illuminate\Support\Facades\Log;
class UserEditController
{
    private $messageVerifyService;

    public function __construct(MessageVerifyService $messageVerifyService)
    {
        $this->messageVerifyService = $messageVerifyService;
    }

    public function index()
    {
        return view('auth.user-signup-verify');
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
        $response = $this->messageVerifyService->send(request('mobile_no'));

        return response()->json($response);
    }
}
