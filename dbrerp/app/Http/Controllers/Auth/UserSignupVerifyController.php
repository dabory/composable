<?php

namespace App\Http\Controllers\Auth;

use App\Services\MessageVerifyService;

class UserSignupVerifyController
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
            return redirect()->back();
        }

        session()->forget('smsCert.number');
        session()->put('smsCert.code', 200);
        return redirect()->route('user-signup.index');
    }

    public function sendCert()
    {
        $response = $this->messageVerifyService->send(request('mobile_no'));

        return response()->json($response);
    }
}
