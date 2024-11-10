<?php

use App\Exceptions\ApiException;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent as Agent;
use Unirest\Request;

function cacheView($view, $data = [], $mergeData = [], $codeTitle = '')
{
    if (env('PAGE_REDIS_CACHE')) {
        $key = request()->getHost() . ':' . md5(url()->current());
        $html = Cache::remember($key, env('PAGE_REDIS_TTL', 259200), function() use ($view, $data, $mergeData, $codeTitle) {
            if ($codeTitle) {
                return View::make($view, $data, $mergeData)
                    ->with('codeTitle',  $codeTitle)
                    ->render();
            } else {
                return View::make($view, $data, $mergeData)
                    ->render();
            }
        });
        return response($html);
    } else {
        if ($codeTitle) {
            return view($view, $data, $mergeData)->with('codeTitle',  $codeTitle);
        } else {
            return view($view, $data, $mergeData);
        }
    }
}

function getHashSorderNo($sorderNo)
{
    $sorderNoExplode = explode('-', $sorderNo);
    return $sorderNoExplode[0] . '-' . generate4DigitHash($sorderNo);
}

function generate4DigitHash($input)
{
    // Generate a SHA-256 hash
    $hash = hash('sha256', $input);

    // Convert hash to base 10 and get the first 4 digits
    $decimalHash = base_convert($hash, 16, 10);

    // Truncate or pad to ensure it's 4 digits long
    $fourDigitHash = substr($decimalHash, 0, 4);

    // Ensure it's always 4 digits
    return str_pad($fourDigitHash, 4, '0', STR_PAD_LEFT);
}

function detect($view)
{
    $agent = new Agent();
    if ($agent->isDesktop()) {
        $device = 'desktop';
    } else if ($agent->isTablet()) {
        $device = 'tablet';
    } else {
        $device = 'mobile';
    }

    return preg_replace('/(\.)(index)/', '$1' . $device . '.$2', $view);
}

function daboryPath($filename = null)
{
    if ($filename) {
        return base_path('dabory/' . $filename);
    }

    return  base_path('dabory');
}

function checkIgroupCode($code, $targetCode)
{
    $codeList = explode('|', $code);
    foreach ($codeList as $code) {
        if ($code === $targetCode) {
            return true;
        }
    }
    return false;
}

// MenuCode 뒤에 00붙은거 자르기
function formatDateString($inputString)
{
    // Split the input string into an array of substrings with two characters each
    $chunks = str_split($inputString, 2);

    // Initialize an empty result array
    $result = '';

    // Iterate through the chunks and process accordingly
    foreach ($chunks as $chunk) {
        // Check if the chunk is "00"
        if ($chunk == "00") {
            // If it is, break out of the loop
            break;
        }

        // Otherwise, add the chunk to the result array
        $result .= $chunk;
    }

    return $result;
}

function getFirstTwoDigits($input)
{
    // Ensure the string is at least 2 characters long
    if (strlen($input) >= 2) {
        return substr($input, 0, 2) . '000000';
    }

    // If the string is shorter than 2 characters, return the string itself
    return $input . '000000';
}


function saveJavaScriptCookie( $cookieName )
{
    if ( empty( $_COOKIE[$cookieName] ))
    {
        return null;
    }

    return $_COOKIE[$cookieName];
}

function getLocale()
{
    return app()->getLocale() ?? config('app.locale');
}

function convNum($num)
{
    return str_replace(',', '', $num);
}

function isHex($txt)
{
    if (strpos($txt, '0x') === 0) {
        return true;
    }
    return false;
}

function strimEmail(string $email)
{
    $div = explode('@', $email);
    $strim = substr($div[0], '0', -3) . "***";
    $strimEmail = $strim . '@' . $div[1];

    return $strimEmail;
}

function setupPasswdPolicy($brandCode)
{
    return app(CallApiService::class)->callApi([
        'url' => 'setup-get',
        'data' => [
            'SetupCode' => 'passwd-policy',
            'BrandCode' => $brandCode,
        ]
    ]);
}

function makePasswdRules($passwdPolicy)
{
    $passwdRules = [
        'required', 'confirmed', 'min:'.$passwdPolicy['MinLength'],
    ];

    if ($passwdPolicy['IsUpperMixed']) { $passwdRules[] = 'regex:/[A-Z]/'; }
    if ($passwdPolicy['IsSpecialMixed']) { $passwdRules[] = 'regex:/[@$!%*#?&]/'; }

    return $passwdRules;
}

function formatPhone($phone)
{
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);

    switch($length){
        case 11 :
            return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
            break;
        case 10:
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
            break;
        default :
            return $phone;
            break;
    }
}

function msset($mediaPath)
{
    return env('MEDIA_URL') . $mediaPath;
}

function csset($assetPath, $versionDate = null)
{
    if (env('BROWSER_CACHE')) {
        $assetUrl = env('CSSJS_URL');

        if (env('VERSION_DATE')) {
            if ($assetUrl === 'local') {
                $url = asset($assetPath);
            } else {
                $url = $assetUrl . $assetPath;
            }
            return $url . '?v' . env('VERSION_DATE');
        }

        if ($assetUrl === 'local') {
            return asset($assetPath);
        }

        $url = $assetUrl . $assetPath;
        if ($versionDate) {
            $url = $url . '?v' . $versionDate;
        }
        return $url;
    } else {
        return asset($assetPath . '?' . date('YmdHis'));
    }
}

function isSecure()
{
    $isSecure = false;
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $isSecure = true;
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
        $isSecure = true;
    }

    return $isSecure;
}

function loadEnvFor($envName)
{
    $environmentPath = __DIR__ . '/../' . $envName;

    if (file_exists($environmentPath))
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../', $envName);
        $dotenv->load(); //this is important
    }
}

function getDisk(): string
{
    switch (env('CDN_TYPE')) {
        case 'aws-s3':
            $disk = 's3';
            break;
        default:
            $disk = 'erp';
            break;
    }

    return $disk;
}

function setupMemberPagemove()
{
    return app(CallApiService::class)->callApi([
        'url' => 'setup-get',
        'data' => [
            'SetupCode' => 'member-pagemove',
            'BrandCode' => ''
        ]
    ]);
}

function getLoginRedirectUrl($previousUrl, $memberId = null)
{
    if ($memberId) {
        $response = app(CallApiService::class)->callApi([
            'url' => 'member-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => $memberId ]
                ]
            ]
        ]);

        $member = $response['Page'][0];
        if ($member['SsoBrand'] !== '' && $member['FirstName'] === '') {
            return '/my-page/member-edit';
        }
    } else {
        $memberPagemove = setupMemberPagemove();
        if (app(CallApiService::class)->verifyApiError($memberPagemove)) {
            return '/';
        }

        $afterLoginApplyPage = preg_replace('/\s+/', '', explode(',', $memberPagemove['AfterLoginApplyPage']));
        $slice = Str::after($previousUrl, url('/'));

        if (empty($previousUrl) || Str::contains($slice, $afterLoginApplyPage)) {
            return $memberPagemove['AfterLoginUri'];
        }
    }

    return $previousUrl;
}

function setupSsoClientOrLoginInfo($brandCode = 'member')
{
    $setup = app(CallApiService::class)->callApi([
        'url' => 'setup-page',
        'data' => [
            'PageVars' => [
                'Query' => "((setup_code = 'sso-client' and brand_code like '{$brandCode}%') or setup_code = 'login-info') and is_on_use = '1'",
                'Limit' => 100
            ]
        ],
    ]);

//    dd($setup);

    $oauth2InfoList = collect($setup['Page'])->filter(function ($setup) {
        return $setup['SetupCode'] !== 'login-info';
    })->flatMap(function ($setup) use ($brandCode) {
        $key = Str::replace($brandCode . '-', '', $setup['BrandCode']);
        return [$key => json_decode($setup['SetupJson'], true)];
    })->toArray();

    $develLoginInfo = collect($setup['Page'])->filter(function ($setup) {
        return $setup['SetupCode'] === 'login-info';
    })->map(function ($setup) {
        return json_decode($setup['SetupJson'], true);
    })->first();

//    dd($develLoginInfo);
    return [$oauth2InfoList, $develLoginInfo];
}

function breadcrumb($igroupCode, $sort = 'primary'): array
{
    $mainMenuPerm = \App\Helpers\Utils::getProMainMenu();
    $mainMenuPermPage = collect($mainMenuPerm['Page'])->filter(function ($menu) use ($sort) {
        return $menu['Sort'] === $sort;
    })->toArray();
    $mainMenuList = \App\Helpers\Utils::formatMenuList($mainMenuPermPage, 'MenuCode');

    $menuCodeSplit = str_split($igroupCode, 2);

    $firstMenu = collect($mainMenuList)->filter(function ($q) use ($menuCodeSplit) {
        return Str::startsWith($q['MenuCode'], $menuCodeSplit[0]);
    })->first();

    if (empty($firstMenu['child']) || ! isset($menuCodeSplit[1])) { return [ $firstMenu ]; }

    $secondMenu = collect($firstMenu['child'])->filter(function ($q) use ($menuCodeSplit) {
        return Str::startsWith($q['MenuCode'], $menuCodeSplit[0] . $menuCodeSplit[1]);
    })->first();

    if (empty($secondMenu['child']) || ! isset($menuCodeSplit[2])) { return [ $firstMenu, $secondMenu ]; }

    $thirdMenu = collect($secondMenu['child'])->filter(function ($q) use ($menuCodeSplit) {
        return Str::startsWith($q['MenuCode'], $menuCodeSplit[0] . $menuCodeSplit[1] . $menuCodeSplit[2]);
    })->first();

    return [ $firstMenu, $secondMenu, $thirdMenu ];
}

function recaptchaSiteverify($secret, $response)
{
    $data = [
        'secret' => $secret,
        'response' => $response,
        'remoteip' => request()->ip()
    ];

    $response = Request::get('https://www.google.com/recaptcha/api/siteverify',
        [ 'Accept' => 'application/json' ],

        $data
    );

    return json_decode(json_encode($response->body ?? []), true)['success'];
}
