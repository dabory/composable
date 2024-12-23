<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api23GateTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    private $api23GateTokenService;
    public function __construct(Api23GateTokenService $api23GateTokenServic)
    {
        $this->api23GateTokenService = $api23GateTokenServic;
    }

    public function store(Request $request)
    {
        $result = $this->api23GateTokenService->getToken($request->header('Api23Key'));
        if ($result['error']) {
            return response()->json($result['message'], 401);
        }
        $gateToken = $result['data'];
        $passwdPolicy = $this->api23GateTokenService->callApi23Js(
            $gateToken,
            'setup-get',
            [
                'SetupCode' => 'passwd-policy',
                'BrandCode' => 'member',
            ],
            false
        );

        if (isset($passwdPolicy['data']['apiStatus'])) {
            response()->json(['error' => true, 'validator' => false, 'message' => $passwdPolicy['data']['body']]);
        }

        $passwdRules = makePasswdRules2($passwdPolicy['data']);
        $data = json_decode($request->getContent(), true);
        $validator = validator::make($data, [
            'Email' => ['required', 'email'],
            'MobileNo' => ['required'],
            'FirstName' => ['required'],
            'Password' => $passwdRules,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'validator' => true, 'message' => $validator->errors()->toArray()]);
        }

        $response = $this->api23GateTokenService->callApi23Js(
            $gateToken,
            'member-signup',
            [
                'Email' => $data['Email'],
                'Password' => $data['Password'],
                'MobileNo' => formatPhone($data['MobileNo']),
                'FirstName' => $data['FirstName'],
            ],
            false
        );

        if (isset($response['data']['apiStatus'])) {
            return response()->json(['error' => true, 'validator' => false, 'message' => $response['data']['body']]);
        }

        return response()->json(['error' => false, 'validator' => false, 'message' => 'Success']);
    }
}
