<?php

namespace App\Services;

use App\Helpers\ProUtils;
use App\Helpers\Utils;
use App\Services\CallApiService;
use Exception;
use Illuminate\Support\Facades\Storage;

class CacheService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function putTabbedMenuHash()
    {
        $this->actMenu('User');
        $this->actMenu('Main');
        $this->actMenu('Member');
    }

    public function actMenu($type)
    {
        switch ($type) {
            case 'User':
                $menuList = Utils::getMainMenu('all');
                $apiUrl = 'user-menu-act';
                break;
            case 'Main':
                $menuList = Utils::getProMainMenu();
                $apiUrl = 'main-menu-act';
                break;
            case 'Member':
                $menuList = ProUtils::getMainMenu('all');
                $apiUrl = 'member-menu-act';
                break;
        }
        if (! $menuList) {
            return;
        }
        $menuReq = collect($menuList['Page'])->map(function ($menu) use ($type) {
            $resut['Id'] = $menu[$type . 'MenuId'];
            $resut['TabbedMenuHash'] = '';


            if ($type  === 'User' || $type === 'Member') {
                $resut['TabbedMenuHash'] = md5($menu['PageUri'] . $menu['ParaName']);
            } else if ($type === 'Main') {
                $resut['TabbedMenuHash'] = md5($menu['PageUri'] . $menu['MenuCode']);
            }
            return $resut;
        })->toArray();

        $response =  $this->callApiService->callApi([
            'url' => $apiUrl,
            'data' => [
                'Page' => $menuReq
            ],
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            notify()->error($response['body'], 'Error', 'bottomRight');
            return redirect()->to('/user-logout');
        }
    }

    public function putMainMenu()
    {
        $data = $this->callApiService->callApi([
            'url' => 'igroup-page',
            'data' => [
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);
        if (! $this->callApiService->verifyApiError($data) && $data['Page']) {
            $mainMenuList = Utils::formatIgroupMenuList($data['Page'], 'IgroupCode');
            $fullFileUrl = "dabory-footage/basic/igroup.json";

            Storage::put($fullFileUrl, json_encode($mainMenuList));
        }
    }

    public function putEtcBrand()
    {
        $data = $this->callApiService->callApi([
            'url' => 'etc-page',
            'data' => [
                'Query' => "status = '0' and select_name = 'brand'",
                'PageVars' => [
                    'Limit' => 100000,
                ]
            ]
        ]);

        if (! $this->callApiService->verifyApiError($data) && $data['Page']) {
            $fullFileUrl = "dabory-footage/basic/etc/brand.json";

            Storage::put($fullFileUrl, json_encode($data));
        }
    }

    public function putSetup()
    {
        $data = $this->callApiService->callApi([
            'url' => 'setup-page',
            'data' => [
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! $this->callApiService->verifyApiError($data) && $data['Page']) {
            foreach ($data['Page'] as $setup) {
                $setupCode = $setup['SetupCode'];
                $brandCode = $setup['BrandCode'] ? '-'.$setup['BrandCode'] : $setup['BrandCode'];
                $fullFileUrl = "dabory-footage/basic/setup/$setupCode$brandCode.json";
                Storage::put($fullFileUrl, json_encode($setup));
            }
        }
    }

    public function putThemeSetup()
    {
        $data = $this->callApiService->callApi([
            'url' => 'theme-setup-page',
            'data' => [
                'PageVars' => [
                    'Limit' => 9999999,
                    'Offset' => 0
                ]
            ],
        ]);

        if (! $this->callApiService->verifyApiError($data) && $data['Page']) {
            foreach ($data['Page'] as $themeSetup) {
                $themeSetupCode = $themeSetup['SetupCode'];
                $brandCode = $themeSetup['BrandCode'] ? '-'.$themeSetup['BrandCode'] : $themeSetup['BrandCode'];
                $fullFileUrl = "dabory-footage/basic/theme-setup/$themeSetupCode$brandCode.json";
                Storage::put($fullFileUrl, json_encode($themeSetup));
            }
        }
    }

    public function get($fullFileUrl)
    {
        if (Storage::disk()->exists($fullFileUrl)) {
            return json_decode(Storage::get($fullFileUrl), true);
        }

        return null;
    }

    public function getSetup($setupCode, $brandCode = null)
    {
        $brandCode = $brandCode ? '-'.$brandCode : $brandCode;
        $fullFileUrl = "dabory-footage/basic/setup/$setupCode$brandCode.json";
        if (Storage::disk()->exists($fullFileUrl)) {
            $setup = json_decode(Storage::get($fullFileUrl), true);
            return json_decode($setup['SetupJson'], true);
        }

        return null;
    }

    public function getThemeSetup($setupCode, $brandCode = null)
    {
        $brandCode = $brandCode ? '-'.$brandCode : $brandCode;
        $fullFileUrl = "dabory-footage/basic/theme-setup/$setupCode$brandCode.json";
        if (Storage::disk()->exists($fullFileUrl)) {
            $setup = json_decode(Storage::get($fullFileUrl), true);
            return json_decode($setup['SetupJson'], true);
        }

        return null;
    }
}
