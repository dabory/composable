<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Services\CallApiService;
use Illuminate\Support\Collection;
use App\Exceptions\ParameterException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;

class Utils
{
    public static function getSeoHtml($brandCode = 'common')
    {
        $response = app(CallApiService::class)->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'seo-html',
                'BrandCode' => $brandCode
            ],
        ]);

        if (isset($response['PageHtml'])) {
            return  $response['PageHtml'];
        }
    }

    public static function getSetupParamCache($setupCode)
    {
        $fullFileUrl = "dabory-footage/setup-page";

        if (Storage::disk()->exists($fullFileUrl)) {
            $setup = json_decode(Storage::get($fullFileUrl), true);
            $findSetup = collect($setup['Page'])->filter(function ($setup) use ($setupCode) {
                return $setup['SetupCode'] === $setupCode;
            })->first();
            return json_decode($findSetup['SetupJson'], true);
        }
    }
    public static function putDirectParamCache($cacheName, $data)
    {
        $userId = session('user')['UserPermId'] ?? null;
        $fullFileUrl = "dabory-footage/users/{$userId}/{$cacheName}.json";

        Storage::put($fullFileUrl, $data);
    }

    public static function getDirectParamCache($cacheName)
    {
        $userId = session('user')['UserPermId'] ?? null;
        $fullFileUrl = "dabory-footage/users/{$userId}/{$cacheName}.json";

        if (Storage::disk()->exists($fullFileUrl)) {
            return Storage::get($fullFileUrl);
        }

        return false;
    }

    public static function getParamCache($menuCode, $fileName, $queryName = null)
    {
        $userId = session('user')['UserId'] ?? null;
        $fullFileUrl = "dabory-footage/users/{$userId}/{$menuCode}-{$fileName}.json";

        if (isset($queryName)) {
            $fullFileUrl = "dabory-footage/users/{$userId}/{$menuCode}-{$fileName}-{$queryName}.json";
        }

        if (Storage::disk()->exists($fullFileUrl)) {
            return [
                'url' => $fileName,
                'query' => Storage::get($fullFileUrl)
            ];
        }
        return false;
    }

    public static function getSlipFormInitCache($queryName, $strongType=false)
    {
        // dd($strongType);
        $fullFileUrl = "dabory-footage/basic/slip-form-init/{$queryName}.json";

        if (Storage::disk()->exists($fullFileUrl)) {
            return json_decode(Storage::get($fullFileUrl), true);
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'slip-form-init',
            'data' => [
                'QueryVars' => [
                    'QueryName' => $queryName,
                ]
            ],
            'strong_type' => $strongType
        ]);


        Storage::put($fullFileUrl, json_encode($response));

        return $response;
    }

    public static function kebabCase($value) {
        if (ctype_lower($value)) return $value;
        $value = preg_replace('/[\s]+/u', '', ucwords(str_replace('_','-',$value)));
        $value = preg_replace('/[\s]+/u', '', ucwords(str_replace('.','-',$value)));
        return mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1-', $value), 'UTF-8');
    }

    public static function snakeCase($value) {
        if (ctype_lower($value)) return $value;
        $value = preg_replace('/[\s]+/u', '', ucwords(str_replace('-','_',$value)));
        $value = preg_replace('/[\s]+/u', '', ucwords(str_replace('.','_',$value)));
        return mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1_', $value), 'UTF-8');
    }

    public static function putParamCache($menuCode, $fileName, $data)
    {
        $userId = session('user')['UserId'] ?? null;
        $fullFileUrl = "dabory-footage/users/{$userId}/{$menuCode}-{$fileName}.json";

        if (isset(json_decode($data, true)['QueryVars'])) {
            $queryName = json_decode($data, true)['QueryVars']['QueryName'];
            $fullFileUrl = "dabory-footage/users/{$userId}/{$menuCode}-{$fileName}-{$queryName}.json";
        }

        Storage::put($fullFileUrl, $data);
    }

    public static function getParamUrl(string $settingFileName = '', $extension = '.json')
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath =  "para-local/dabory/erp/{$countryCode}{$settingFileName}{$extension}";

        if (file_exists(public_path($setPath))) {
            return $setPath;
        } else {
            $setPath = "para/dabory/erp/{$countryCode}{$settingFileName}{$extension}";
            if (file_exists(public_path($setPath))) {
                return $setPath;
            }
        }

        return -1;
    }

    public static function getThemeParamUrl(string $settingFileName = '', $extension = '.json', $themeDir = '')
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
//        이제 안씀
        $customTheme = env('ERP_PARA_CUSTOM_THEME');
        $localPath =  "themes/erp/{$customTheme}/para_custom/{$countryCode}{$settingFileName}{$extension}";

        if (file_exists(public_path($localPath))) {
            return $localPath;
        } else {
            $setPath = "themes/{$themeDir}/para/{$countryCode}{$settingFileName}{$extension}";
            if (file_exists(public_path($setPath))) {
                return $setPath;
            }
        }

        return -1;
    }

    public static function getParamFile(string $settingFileName = '', $extension = '.json', $popupOptions = false, $mode = 'erp')
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        if ($mode !== 'erp') {
            $countryCode = session('member')['CountryCode'] ?? config('constants.countries')[0];
        }
        $setPath = "para/{$mode}/{$countryCode}{$settingFileName}{$extension}";
        if (file_exists(daboryPath($setPath))) {
            $paramsFilePath = file_get_contents(daboryPath($setPath));
        } else {
            $daboryPath = daboryPath($setPath);
            if ($popupOptions) {
                switch ($popupOptions['OptionsType']) {
                    case 'SelectPopupOptions':
                        $msg = '(' . $popupOptions['OptionsType'] . ') ' . $daboryPath . ' 경로를 확인하세요.';
                        break;
                    case 'HeadSelectOptions':
                    case 'HeadSelectPopupOptions':
                    case 'BodySelectOptions':
                        $msg = "Parameter File Not Fount in {$popupOptions['Value']} ({$popupOptions['Caption']}) : {$daboryPath}";
                        break;
                }
            } else {
                $msg = 'Parameter File Not Fount (Main) : ' . $daboryPath;
            }

            throw new ParameterException($msg);
        }

        if ($extension == '.json') {
            return json_decode($paramsFilePath, true );
        }

        return $paramsFilePath;
    }

    public static function getThemeParamFile(string $settingFileName = '', $extension = '.json', $themeDir = '', $popupOptions = false)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "themes/{$themeDir}/para/{$countryCode}{$settingFileName}{$extension}";
        if (file_exists(daboryPath($setPath))) {
            $paramsFilePath = file_get_contents(daboryPath($setPath));
        } else {
//                dd($popupOptions);
            if ($popupOptions) {
                $msg = '(' . $popupOptions['OptionsType'] . ') ' . daboryPath($setPath) . ' 경로를 확인하세요.';
            } else {
                $msg = daboryPath($setPath) . ' 경로에 Parameter 형식에 맞춰서 넣어주세요.';
            }

//                dump($popupOptions);
//                dd($msg);
            throw new ParameterException($msg);
        }

        if ($extension == '.json') {
            return json_decode($paramsFilePath, true );
        }

        return $paramsFilePath;
    }

    public static function bpaDecoding($bpa)
    {
        $bpa = json_decode(base64_decode($bpa), true);

        if ($bpa) {
            session()->put('user.MenuPermission', $bpa['permission']);
        }
        return $bpa;
    }

    public static function bpaEncoding(array $menuPages): Collection
    {
        return collect($menuPages)->map(function ($menuPage) {
            $bpa = [
                'menu_name' => $menuPage['MenuName'],
                'menu_code' => $menuPage['MenuCode'],
                'disable_l_menu' => $menuPage['DisableLMenu'] ?? '',
                'enable_r_menu' => $menuPage['EnableRMenu'] ?? '',
                'permission' => [
                    'is_mymenu' => $menuPage['IsMymenu'],
                    'is_list' => $menuPage['IsList'],
                    'is_read' => $menuPage['IsRead'],
                    'is_create' => $menuPage['IsCreate'],
                    'is_update' => $menuPage['IsUpdate'],
                    'is_delete' => $menuPage['IsDelete'],
                    'is_newtab' => $menuPage['IsNewtab'] ?? '',
                ],
                'page_uri' => $menuPage['PageUri'],
                'para_name' => $menuPage['ParaName'],
                'theme_dir' => $menuPage['ThemeDir'] ?? '',
                'main_app_id' => $menuPage['MainAppId'],
                'guest_app_id' => $menuPage['GuestAppId'],
                'custom_var' => $menuPage['CustomVar'],
                'tabbed_menu_hash' => $menuPage['TabbedMenuHash'],
            ];
            self::bpaDelete($menuPage);

            return array_merge($menuPage, ['bpa' => base64_encode(json_encode($bpa))]);
        });
    }

    public static function bpaDelete(array &$array): void
    {
        foreach (['IsMymenu', 'IsList',
            'IsRead', 'IsCreate', 'IsUpdate', 'IsDelete',
            'ParaName'] as $item) {
            unset($array[$item]);
        }
    }

    public static function formatArrayToTree(array &$data, int $parentId = 0, string $key_ = 'UserMenuId'): array
    {
        $branch = [];
        foreach ($data as $key => $element) {
            if ($element['ParentId'] == $parentId) {
                $children = self::formatArrayToTree($data, $element[$key_], $key_);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
                unset($data[$key]);
            }
        }
        return $branch;
    }

    public static function makeFrontRoute(string $name = '', string $themeDir = ''): string
    {
        $result = '';
        if ($name) $name = explode('/', $name);
        if (is_array($name) && count($name) > 1) {
            $controller = self::makeRouteController(array_pop($name));
            if (count($name))
                foreach ($name as $row)
                    if ($row) $urls[] = self::makeRouteFolder($row);

            if (empty($themeDir)) {
                $basePath = '\\App\\Http\\Controllers\\Front\\';
                $result = $basePath . implode('\\', $urls) . '\\' . $controller . '@index';

            } else {
                $pathArray = explode('/', $themeDir);
                $count = count($pathArray) - 1;
                $themePath = ucfirst($pathArray[$count - 1]) . '\\' . $pathArray[$count];
                $basePath = '\\Themes\\' . $themePath . '\\app\\Http\\Controllers';
                $result = $basePath . '\\' . last($urls) . '\\' . $controller . '@index';
            }
        }
        return $result;
    }

    public static function makeRouteFolder(string $fname): string
    {
        return ucfirst(Str::camel($fname));
    }

    public static function makeRouteController(string $fname): string
    {
        return ucfirst(Str::camel($fname)) . 'Controller';
    }

    public static function getParamsFromUrl(array $paramKeys = []): array
    {
        $params = [];
        foreach ($paramKeys as $paramKey) {
            if (isset($_GET[$paramKey]) && $_GET[$paramKey]) {
                $params[$paramKey] = $_GET[$paramKey];
            }
        }
        return $params;
    }

    public static function makeLists($data, array $list = []): array
    {
        if (is_array($data)) {
            foreach ($data as $key => $row) {
                $list[$key] = $row;
                $list[$key]['View'] = '';
            }
        }

        return $list;
    }

    public static function putProMainParamCache($menuCode, $fileName, $data)
    {
        $fullFileUrl = "dabory-footage/pro/{$menuCode}-{$fileName}.json";

        Storage::put($fullFileUrl, $data);
    }

    public static function getProMainMenu()
    {
        $cacheName = "main-menu";
        $menuCacheData = Utils::getProMainParamCache('000000', $cacheName);

        if ($menuCacheData) {
            return json_decode($menuCacheData['query'], true);
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'menu-perm/main',
                    'IsntPagination' => true
                ],
                'PageVars' => [
                    'Limit' => 10000,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! isset($response['apiStatus'])) {
            $response['Page'] = Utils::parseMainApiResponse($response['Page']);
            Utils::putProMainParamCache('000000', $cacheName, json_encode($response));
        }

        return $response;
    }

    public static function parseMainApiResponse($data): array
    {
        return collect($data)->map(function ($menu) {
            return [
                'MainMenuId' => $menu['Id'],
                'Sort' => $menu['C1'],
                'MenuCode' => $menu['C2'],
                'LangType' => $menu['C3'],
                'DeviceType' => $menu['C4'],
                'MenuName' => $menu['C5'],
                'PageUri' => $menu['C6'],
                'IsLoginOnly' => $menu['C7'],
                'IsLogoutOnly' => $menu['C8'],
                'IsTgtBlank' => $menu['C9'],
                'Icon' => $menu['C10'],
                'MenuImg' => $menu['C11'],
                'Status' => $menu['C12'],
                'IsOffPc' => $menu['C13'],
                'IsOffMobile' => $menu['C14'],
                'IsOffTablet' => $menu['C15'],
                'CustomVar' => $menu['C16'],
                'TabbedMenuHash' => $menu['C17']
            ];
        })->toArray();
    }

    public static function getProMainParamCache($menuCode, $fileName, $queryName = null)
    {
        $fullFileUrl = "dabory-footage/pro/{$menuCode}-{$fileName}.json";

        if (isset($queryName)) {
            $fullFileUrl = "dabory-footage/pro/{$menuCode}-{$fileName}-{$queryName}.json";
        }

        if (Storage::disk()->exists($fullFileUrl)) {
            return [
                'url' => $fileName,
                'query' => Storage::get($fullFileUrl)
            ];
        }

        return false;
    }

    public static function getSortMenu()
    {
        $userPermId = session('user')['UserPermId'] ?? null;
        if (empty($userPermId)) { return []; }
        $cacheName = "user-sort-menu";

        $menuCacheData = Utils::getDirectParamCache($cacheName);

        if ($menuCacheData) {
            return json_decode($menuCacheData, true);
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'menu-perm/sort',
                    'SimpleFilter' => "is_enabled = '1' and mgt_type = 'user'",
                    'IsntPagination' => true
                ],
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! isset($response['apiStatus'])) {
            Utils::putDirectParamCache($cacheName, json_encode($response));
        }

        return $response;
    }

    public static function getMainMenu($sortType)
    {
        $userPermId = session('user')['UserPermId'] ?? null;
        if (empty($userPermId)) { return []; }
        $cacheName = "user-menu/$sortType";

        $menuCacheData = Utils::getDirectParamCache($cacheName);

        if ($menuCacheData) {
            return json_decode($menuCacheData, true);
        }

        $simpleFilter = "mb.user_perm_id = $userPermId";

        if ($sortType !== 'all') {
            $simpleFilter .= " and sort_type = '$sortType'";
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'menu-perm/user',
                    'SimpleFilter' => $simpleFilter,
                    'IsntPagination' => true
                ],
                'PageVars' => [
                    'Limit' => 10000,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! isset($response['apiStatus'])) {
            $response['Page'] = Utils::parseApiResponse($response['Page']);
            Utils::putDirectParamCache($cacheName, json_encode($response));
        }

        return $response;
    }

    public static function parseApiResponse($data): array
    {
        return collect($data)->map(function ($menu) {
            return [
                'UserMenuId' => $menu['Id'],
                'SortType' => $menu['C1'],
                'IsMymenu' => $menu['C2'],
                'IsList' => $menu['C3'],
                'IsRead' => $menu['C4'],
                'IsCreate' => $menu['C5'],
                'IsUpdate' => $menu['C6'],
                'IsDelete' => $menu['C7'],
                'IsNewtab' => $menu['C8'],
                'MenuCode' => $menu['C9'],
                'MenuName' => $menu['C10'],
                'PageUri' => $menu['C11'],
                'ParaName' => $menu['C12'],
                'ThemeDir' => $menu['C13'],
                'Icon' => $menu['C14'],
                'DisableLMenu' => $menu['C15'],
                'EnableRMenu' => $menu['C16'],
                'MainAppId' => (int)$menu['C17'],
                'GuestAppId' => (int)$menu['C18'],
                'CustomVar' => $menu['C19'],
                'TabbedMenuHash' => $menu['C20'],
            ];
        })->toArray();
    }

    public static function get_params_from_url(array $paramKeys = []): array
    {
        $params = [];
        foreach ($paramKeys as $paramKey) {
            if (isset($_GET[$paramKey]) && $_GET[$paramKey]) {
                $params[$paramKey] = $_GET[$paramKey];
            }
        }
        return $params;
    }

    public static function get_client_ip()
    {
        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public static function formatIgroupMenuList($menuPages, $codeName = 'MenuCode')
    {
        $menuList = [];

        foreach ($menuPages as $key => $value) {
            $value[$codeName] = (int)$value[$codeName];
            if ($value[$codeName] % 1000000 == 0) {
                $menuList[] = $value;
                unset($menuPages[$key]);
            }
        }

        $menuPages = collect($menuPages)->sortBy($codeName);

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                $valArr = str_split($value[$codeName], 2);
                $vArr = str_split($v[$codeName], 2);
                if ($valArr[0] == $vArr[0] && $valArr[1] != '00' && $valArr[2] == '00' && $valArr[3] == '00') {
                    $menuList[$k]['child'][$value[$codeName]] = $value;
                    unset($menuPages[$key]);
                }
            }
        }

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                $valArr = str_split($value[$codeName], 2);
                $vArr = str_split($v[$codeName], 2);
                if ($valArr[0] == $vArr[0] && $valArr[1] != '00' && $valArr[2] == '00' && $valArr[3] == '00') {
                    $menuList[$k]['child'][$value[$codeName]] = $value;
                    unset($menuPages[$key]);
                }

                if (empty($v['child'])) { continue; }
                foreach ($v['child'] as $o => $l) {
                    $lArr = str_split($l[$codeName], 2);
                    if ($valArr[0] == $lArr[0] && $valArr[1] == $lArr[1] && $valArr[1] != '00' && $valArr[2] != '00' && $valArr[3] == '00') {
                        $menuList[$k]['child'][$o]['child'][$value[$codeName]] = $value;
                        unset($menuPages[$key]);
                    }
                }
            }
        }

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                if (empty($v['child'])) { continue; }
                foreach ($v['child'] as $i => $j) {
                    $valArr = str_split($value[$codeName], 2);

                    if (empty($j['child'])) { continue; }
                    foreach ($j['child'] as $o => $l) {
                        $lArr = str_split($o, 2);
                        if ($valArr[0] == $lArr[0] && $valArr[1] == $lArr[1] && $valArr[2] == $lArr[2]) {
                            $menuList[$k]['child'][$i]['child'][$o]['child'][$value[$codeName]] = $value;
                        }
                    }
                }
            }
        }

//        dump($menuPages);
//        dd($menuList);

        return $menuList;
    }

    public static function formatMenuList($menuPages, $codeName = 'MenuCode')
    {
        $menuList = [];

        foreach ($menuPages as $key => $value) {
            if ($value[$codeName] % 10000 == 0) {
                $menuList[] = $value;
                unset($menuPages[$key]);
            }
        }

        $menuPages = collect($menuPages)->sortBy($codeName);

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                $valArr = str_split($value[$codeName], 2);
                $vArr = str_split($v[$codeName], 2);
                if ($valArr[0] == $vArr[0] && $valArr[1] != '00' && $valArr[2] == '00') {
                    $menuList[$k]['child'][$value[$codeName]] = $value;
                    unset($menuPages[$key]);
                }
            }
        }

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                if (empty($v['child'])) { continue; }
                foreach ($v['child'] as $i => $j) {
                    $valArr = str_split($value[$codeName], 2);
                    $jArr = str_split($i, 2);
                    if ($valArr[0] == $jArr[0] && $valArr[1] == $jArr[1]) {
                        $menuList[$k]['child'][$i]['child'][$value[$codeName]] = $value;
                    }
                }
            }
        }

//        dump($menuPages);
//        dd($menuList);

        return $menuList;
    }
}
