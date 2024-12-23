<?php

namespace App\Http\Controllers;

use App\Services\CallApiService;
use Illuminate\Http\Request;

class CaptchaServiceController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function capthcaFormValidate(Request $request)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            notify()->error('문자열 입력이 틀렸습니다', 'Error', 'bottomRight');
            return redirect()->to('506');
        } else {
            $response = $this->callApiService->callApi([
                'url' => 'gate-token-cleaning',
                'data' => [
                    '' => ''
                ],
            ]);

            if ($this->callApiService->verifyApiError($response)) {
                notify()->error('API 에러', 'Error', 'bottomRight');
                return redirect()->to('506');
            }
            notify()->success('휴먼 증명 되었습니다', 'Success', 'bottomRight');
            return redirect()->to(session()->get('previous_url'));
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
