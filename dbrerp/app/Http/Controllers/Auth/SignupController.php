<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Validator;
use App\Events\UserCreated;

class SignupController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index()
    {
        $passwdPolicy = setupPasswdPolicy('users');

        $smsCert = session('smsCert');

        if (empty($smsCert) || empty($smsCert['code'])) {
            notify()->error('잘못된 접근입니다', 'Error', 'bottomRight');
            return redirect()->route('user-signup-verify.index');
        }

        if ($smsCert['code'] !== 200) {
            notify()->error('인증실패', 'Error', 'bottomRight');
            return redirect()->route('user-signup-verify.index');
        }

        if (date('YmdHis') - $smsCert['date'] > 500) {
            session()->forget('smsCert');
            notify()->error('인증 시간이 만료되었습니다', 'Error', 'bottomRight');
            return redirect()->route('user-signup-verify.index');
        }

        return view('auth.user-signup', [
            'policyDesc' => $passwdPolicy['PolicyDesc'],
        ]);
    }

    public function store()
    {
        $passwdPolicy = setupPasswdPolicy('users');

        if ($this->callApiService->verifyApiError($passwdPolicy)) {
            notify()->error($passwdPolicy['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        $passwdRules = makePasswdRules($passwdPolicy);

        $validator = validator::make(request()->all(), [
            'email' => ['required', 'email'],
            'password' => $passwdRules,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $response = $this->callApiService->callApi([
            'url' => 'user-signup',
            'data' => [
                'Email' => request('email'),
                'Password' => request('password'),
                'SgroupCode' => request('sgroup_code'),
                'MobileNo' => formatPhone(request('mobile_no')),
            ]
        ]);

        if (isset($response['apiStatus'])) {
            notify()->error($response['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        // 가입확인 메일 보내는 이벤트
        event(new UserCreated([
            'email' => request('email'),
            'activate_code' => $response['ActivateCode'],
            'route' => 'emails.auth.confirm',
            'redirectUrl' => 'user-confirm'
        ]));

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return redirect()->route('user-go-email');
    }

    public function activateCodeResend()
    {
        $response = $this->callApiService->callApi([
            'url' => 'user-pick',
            'data' => [
                'Page' => [
                    [ 'Email' => request('email') ]
                ]
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            notify()->error('이메일 계정이 존재하지 않습니다.', 'Error', 'bottomRight');
            return redirect()->back();
        }

        event(new UserCreated([
            'email' => request('email'),
            'activate_code' => $response['Page'][0]['ActivateCode']
        ]));

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return redirect()->route('user-go-email');
    }

    public function confirm()
    {
        $response = $this->callApiService->callApi([
            'url' => 'user-activate',
            'data' => [
                'ActivateCode' => request('code'),
            ],
        ]);

        if (isset($response['apiStatus'])) {
            return redirect()->route('user-activate-failed');
        } else {
            return redirect()->route('user-verify-ok');
        }
    }
}
