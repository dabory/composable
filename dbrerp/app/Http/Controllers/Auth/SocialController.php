<?php

namespace App\Http\Controllers\Auth;

use App\Services\DbUpdateService;
use Exception;
use App\Services\CallApiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\FacebookProvider;
use Laravel\Socialite\Two\GoogleProvider;
use SocialiteProviders\Apple\Provider;
use SocialiteProviders\Kakao\KakaoProvider;
use App\Providers\Socialite\OAuth2\DaboryProvider;
use SocialiteProviders\Naver\Provider as NaverProvider;
use App\Services\AppleTokenService;

class SocialController extends Controller
{
    private $callApiService;
    private $dbUpdateService;
    private $appleTokenService;
    private $oauth2Info;
    private $target;

    public function __construct(CallApiService $callApiService, DbUpdateService $dbUpdateService, AppleTokenService $appleTokenService)
    {
        $this->callApiService = $callApiService;
        $this->dbUpdateService = $dbUpdateService;
        $this->appleTokenService = $appleTokenService;
    }

    public function redirectToProvider($provider)
    {
        $this->oauth2Info = request('oauth2Info');
        return $this->setConfig($provider, request('target'))->redirect();
    }

    public function login($provider)
    {
        [$this->target, $ssoBrand] = explode('-', $provider);
        $response = $this->callApiService->callApi([
            'url' => 'setup-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(setup_code = 'sso-client' and brand_code = '{$provider}') and is_on_use = '1'",
                    'Limit' => 100
                ]
            ],
        ]);
        $this->oauth2Info = json_decode($response['Page'][0]['SetupJson'], true);
        $loginRoute = $this->target == 'member' ? 'member-login' : 'user-login';

        try {
            $userSocial = $this->setConfig($ssoBrand, $this->target)->user();
        } catch (Exception $e) {
            return redirect()->route($loginRoute)->with(['mgs' => $e->getMessage()]);
        }

        if ($this->target == 'member') {
            $response = $this->memberLogin($userSocial, $ssoBrand);
            if ($response['success']) {
                if (Route::has('member-social-broker')) {
                    return redirect()->route('member-social-broker');
                }

                session()->put('member.is_member', true);

                $member = session()->get('member');
                if ($ssoBrand === 'dabory') {
                    $redirectUrl = $this->oauth2Info['AfterMemberLoginUri'];
                } else {
                    $redirectUrl = getLoginRedirectUrl($this->oauth2Info['AfterMemberLoginUri'], $member['MemberId']);
                    if ($redirectUrl === '/my-page/member-edit') {
                        notify()->info('닉네임, 셩별, 관심국가를 입력하셔야 정상활동 가능합니다.', 'Info', 'bottomRight');
                    }
                }
                return redirect()->to($redirectUrl);
            } else {
                return redirect()->route('member-login')->with(['mgs' => $response['mgs']]);
            }
        } else {
            $response = $this->usersLogin($userSocial, $ssoBrand);
            if ($response['success']) {
                // IS_SKIP_DBUPDATE 체크
                return $this->dbUpdateService->checkIsSkipDbUpdate();
            } else {
                return redirect()->route('user-login')->with(['mgs' => $response['mgs']]);
            }
        }
    }

    public function memberLogin($userSocial, $provider)
    {
        $response = $this->callApiService->callApi([
            'url' => 'member-sso-login',
            'data' => [
                'Email' => $userSocial->getEmail(),
                'SsoBrand' => $provider,
                'SsoSub' => (String) $userSocial->getId(),
            ]
        ]);

        if (isset($response['apiStatus'])) {
            return ['success' => false, 'mgs' => $response['body']];
        }

        session()->put('member', array_merge($response, ['Ip' => request()->ip()]));
        return ['success' => true];
    }

    public function usersLogin($userSocial, $provider)
    {
        $response = $this->callApiService->callApi([
            'url' => 'user-sso-login',
            'data' => [
                'Email' => $userSocial->getEmail(),
                'SsoBrand' => $provider,
                'SsoSub' => (String) $userSocial->getId(),
            ]
        ]);

        if (isset($response['apiStatus'])) {
            return ['success' => false, 'mgs' => $response['body']];
        }

        session()->put('user', array_merge($response, ['Ip' => request()->ip()]));
        return ['success' => true];
    }

    public function setConfig($provider, $target)
    {
        $config = [
            'client_id' => $this->oauth2Info['ClientId'],
            'client_secret' => $this->oauth2Info['ClientSecret'],
            'redirect' => "/social/$target-$provider/callback"
        ];

//        dd($config);
        switch ($provider) {
            case 'dabory':
                $driver = Socialite::buildProvider(DaboryProvider::class, [
                    'client_id' => config('app.api.main.ClientId'),
                    'client_secret' => config('app.api.main.ClientSecret'),
                    'redirect' => $config['redirect']
                ]);
                break;
            case 'facebook':
                $driver = Socialite::buildProvider(FacebookProvider::class, $config);
                break;
            case 'kakao':
                $driver = Socialite::buildProvider(KakaoProvider::class, $config);
                break;
            case 'google':
                $driver = Socialite::buildProvider(GoogleProvider::class, $config);
                break;
            case 'naver':
                $driver = Socialite::buildProvider(NaverProvider::class, $config);
                break;
            case 'apple':
//                dd($this->oauth2Info);
                $config['client_secret'] = $this->appleTokenService->generate(
                    $this->oauth2Info['PrivateKey'],
                    $this->oauth2Info['ClientId'],
                    $this->oauth2Info['TeamId'],
                    $this->oauth2Info['KeyId'],
                );
                $driver = Socialite::buildProvider(Provider::class, $config);
                break;
        }

        return $driver;
    }
}
