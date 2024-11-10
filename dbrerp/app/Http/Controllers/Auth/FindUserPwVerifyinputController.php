<?php

namespace App\Http\Controllers\Auth;

use App\Events\PasswordRemindCreated;
use App\Http\Controllers\Controller;
use App\Services\CallApiService;

class FindUserPwVerifyinputController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function emailVerifyinput()
    {
        $userPasswdEmail = $this->callApiService->callApi([
            'url' => 'user-passwd-email',
            'data' => [
                'Email' => request('email')
            ]
        ]);

        if ($this->callApiService->verifyApiError($userPasswdEmail)) {
            return redirect()->back();
        }

        event(new PasswordRemindCreated([
            'email' => request('email'),
            'reset_code' => $userPasswdEmail['ResetCode'],
            'route' => 'emails.auth.passwords-reset',
            'redirectUrl' => 'user-password-change.index'
        ]));

        return redirect()->route('user-go-email');
    }
}
