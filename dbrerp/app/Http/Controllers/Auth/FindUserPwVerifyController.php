<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\CallApiService;

class FindUserPwVerifyController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index()
    {
        $userPick = $this->callApiService->callApi([
            'url' => 'users-pick',
            'data' => [
                'Page' => [ ['Email' => request('email')] ]
            ]
        ]);

        if ($this->callApiService->verifyApiError($userPick)) {
            notify()->error('이메일 계정이 존재하지 않습니다.', 'Error', 'bottomRight');
            return redirect()->back();
        }

        return view('auth.find-user-pw-verify', [
            'email' => request('email')
        ]);
    }

    public function store()
    {
        switch (request('auth')) {
            case 'mobile':
                return redirect()->route('find-user-pw-verifyinput');
            case 'email':
                return redirect()->route('find-user-pw-verifyinput', ['email' => request('email')]);
            default:
                return redirect()->back();
        }
    }
}
