<?php

namespace App\Helpers;

use App\Services\CallApiService;
use Illuminate\Support\Collection;
use App\Exceptions\ParameterException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;

class ProUtils
{
    public static function putDirectParamCache($cacheName, $data)
    {
        $memberId = session('member')['MemberPermId'] ?? null;
        $fullFileUrl = "dabory-footage/members/{$memberId}/{$cacheName}.json";

        Storage::put($fullFileUrl, $data);
    }

    public static function getDirectParamCache($cacheName)
    {
        $memberId = session('member')['MemberPermId'] ?? null;
        $fullFileUrl = "dabory-footage/members/{$memberId}/{$cacheName}.json";

        if (Storage::disk()->exists($fullFileUrl)) {
            return Storage::get($fullFileUrl);
        }

        return false;
    }

    public static function getParamCache($menuCode, $fileName, $queryName = null)
    {
        $memberId = session('member')['MemberId'] ?? null;
        $fullFileUrl = "dabory-footage/members/{$memberId}/{$menuCode}-{$fileName}.json";

        if (isset($queryName)) {
            $fullFileUrl = "dabory-footage/members/{$memberId}/{$menuCode}-{$fileName}-{$queryName}.json";
        }

        if (Storage::disk()->exists($fullFileUrl)) {
            return [
                'url' => $fileName,
                'query' => Storage::get($fullFileUrl)
            ];
        }

        return false;
    }

    public static function putParamCache($menuCode, $fileName, $data)
    {
        $memberId = session('member')['MemberId'] ?? null;
        $fullFileUrl = "dabory-footage/members/{$memberId}/{$menuCode}-{$fileName}.json";

        if (isset(json_decode($data, true)['QueryVars'])) {
            $queryName = json_decode($data, true)['QueryVars']['QueryName'];
            $fullFileUrl = "dabory-footage/members/{$memberId}/{$menuCode}-{$fileName}-{$queryName}.json";
        }

        Storage::put($fullFileUrl, $data);
    }

    public static function bpaDecoding($bpa)
    {
        $bpa = json_decode(base64_decode($bpa), true);

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

    public static function formatMenuList($menuPages)
    {
        $menuList = [];

        foreach ($menuPages as $key => $value) {
            if ($value['MenuCode'] % 10000 == 0) {
                $menuList[] = $value;
                unset($menuPages[$key]);
            }
        }

        $menuPages = collect($menuPages)->sortBy('MenuCode');

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                $valArr = str_split($value['MenuCode'], 2);
                $vArr = str_split($v['MenuCode'], 2);
                if ($valArr[0] == $vArr[0] && $valArr[1] != '00' && $valArr[2] == '00') {
                    $menuList[$k]['child'][$value['MenuCode']] = $value;
                    unset($menuPages[$key]);
                }
            }
        }

        foreach ($menuPages as $key => $value) {
            foreach ($menuList as $k => $v) {
                if (empty($v['child'])) { continue; }
                foreach ($v['child'] as $i => $j) {
                    $valArr = str_split($value['MenuCode'], 2);
                    $jArr = str_split($i, 2);
                    if ($valArr[0] == $jArr[0] && $valArr[1] == $jArr[1]) {
                        $menuList[$k]['child'][$i]['child'][$value['MenuCode']] = $value;
                    }
                }
            }
        }

//        dump($menuPages);
//        dd($menuList);

        return $menuList;
    }

    public static function getSortMenu()
    {
        $memberPermId = session('member')['MemberPermId'] ?? null;
        if (empty($memberPermId)) { return []; }
        $cacheName = "member-sort-menu";

        $menuCacheData = self::getDirectParamCache($cacheName);

        if ($menuCacheData) {
            return json_decode($menuCacheData, true);
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'menu-perm/sort',
                    'SimpleFilter' => "is_enabled = '1' and mgt_type = 'member'",
                    'IsntPagination' => true
                ],
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! isset($response['apiStatus'])) {
            self::putDirectParamCache($cacheName, json_encode($response));
        }

        return $response;
    }

    public static function getMainMenu($sortType)
    {
        $memberPermId = session('member')['MemberPermId'] ?? null;
        if (empty($memberPermId)) { return []; }
        $cacheName = "member-menu/$sortType";

        $menuCacheData = self::getDirectParamCache($cacheName);
        if ($menuCacheData) {
            return json_decode($menuCacheData, true);
        }

        $simpleFilter = "mb.member_perm_id = $memberPermId";

        if ($sortType !== 'all') {
            $simpleFilter .= " and sort_type = '$sortType'";
        }

        $response = app(CallApiService::class)->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'menu-perm/member',
                    'SimpleFilter' => $simpleFilter,
                    'IsntPagination' => true
                ],
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! isset($response['apiStatus'])) {
            $response['Page'] = self::parseApiResponse($response['Page']);
            self::putDirectParamCache($cacheName, json_encode($response));
        }

        return $response;
    }

    public static function parseApiResponse($data): array
    {
        return collect($data)->map(function ($menu) {
            return [
                'MemberMenuId' => $menu['Id'],
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

    public static function getParamFile(string $settingFileName = '', $extension = '.json', $popupOptions = false)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "para/pro/{$countryCode}{$settingFileName}{$extension}";
        if (file_exists(public_path($setPath))) {
            $paramsFilePath = file_get_contents(public_path($setPath));
        } else {
            $publicPath = public_path($setPath);
            if ($popupOptions) {
                switch ($popupOptions['OptionsType']) {
                    case 'SelectPopupOptions':
                        $msg = '(' . $popupOptions['OptionsType'] . ') ' . $publicPath . ' 경로를 확인하세요.';
                        break;
                    case 'HeadSelectOptions':
                    case 'BodySelectOptions':
                        $msg = "Parameter File Not Fount in {$popupOptions['Value']} ({$popupOptions['Caption']}) : {$publicPath}";
                        break;
                }
            } else {
                $msg = 'Parameter File Not Fount (Main) : ' . $publicPath;
            }

            throw new ParameterException($msg);
        }

        if ($extension == '.json') {
            return json_decode($paramsFilePath, true );
        }

        return $paramsFilePath;
    }
}
