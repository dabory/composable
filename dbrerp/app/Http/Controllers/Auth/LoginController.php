<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Utils;
use App\Models\Parameter\Modal;
use App\Services\CallApiService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\DbUpdateService;

class LoginController
{
    /**
     * @var CallApiService
     */
    private $callApiService;
    private $dbUpdateService;

    public function __construct(CallApiService $callApiService, DbUpdateService $dbUpdateService)
    {
        $this->callApiService = $callApiService;
        $this->dbUpdateService = $dbUpdateService;
    }

    public function index()
    {
//         dump(session('GateToken'));
        $login = (new Modal('/etc/common/login'))->getData();

        [$oauth2InfoList, $develLoginInfo] = setupSsoClientOrLoginInfo('user');

        return view('auth.login', compact('login', 'oauth2InfoList', 'develLoginInfo'));
    }

    public function login(LoginRequest $request)
    {
        $data = $request->data();
        if (session('IsBypassDbUpdate')) {
            $data = array_merge($request->data(), ['IsBypassDbUpdate' => true]);
        }

        session()->put('IsBypassDbUpdate', false);
        $response = $this->callApiService->callApi([
            'url' => 'user-login',
            'data' => $data,
        ]);

        // 로그인 이후 게이트토큰 생성 시 type1 리스트안댐 -> 다시 로그인 필요
        // dd(session('GateToken'));

        if (isset($response['apiStatus'])) {
            if ($response['apiStatus'] === 605) {
                notify()->info($response['body'], 'Warning', 'bottomRight');
                session()->put('IsBypassDbUpdate', true);
                return redirect()->route('user-login');
            }
            return redirect()->route('user-login')->with(['mgs' => $response['body']]);
        }

        foreach ($response as $key => $val)
            if ($key != 'pw') $memberData['user'][$key] = $val;

        $memberData['user']['Ip'] = request()->ip();
        session($memberData);

        // sortTpye 첫번 째 세션에 저장
        $sortMenuPage = Utils::getSortMenu()['Page'];
        if (empty($sortMenuPage)) {
            $sortMenu = '';
        } else {
            $sortMenu = $sortMenuPage[0];
        }
        session()->put('user.SortMenu', $sortMenu);

//        dd(session('user'));
        session()->forget('member');
        // IS_SKIP_DBUPDATE 체크
        return $this->dbUpdateService->checkIsSkipDbUpdate();
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        session()->forget('user');
        session()->forget('GateToken');

        return redirect()->route('user-login');
    }
}
