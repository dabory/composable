<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Validator;

class PasswordChangeController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index()
    {
        $response = $this->callApiService->callApi([
            'url' => 'user-passwd-reset',
            'data' => [
                'ResetCode' => request('code')
            ]
        ]);

        if (empty(request('code')) || $this->callApiService->verifyApiError($response)) {
            return redirect()->route('password-reset-code-failed');
        }

        $passwdPolicy = setupPasswdPolicy('users');

        return view('auth.user-password-change', [
            'policyDesc' => $passwdPolicy['PolicyDesc']
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
            'password' => $passwdRules
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = $this->callApiService->callApi([
            'url' => 'user-passwd-reset',
            'data' => [
                'ResetCode' => request('code'),
                'Passwd' => request('password')
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            notify()->error($response['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return redirect()->route('user-login');
    }
}
