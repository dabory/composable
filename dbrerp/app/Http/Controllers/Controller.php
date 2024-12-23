<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function getMenu(array $page = [], string $menuTitle = '', array $menuPages = [])
    // {
    //     $menu = Utils::getMainMenu();

    //     // if (isset($menu['apiStatus']) && $menu['apiStatus'] == 505)
    //     //     echo '<script>alert("시스템 오류입니다. 로그아웃 됩니다."); window.location.href="/logout"</script>';
    //     if (isset($menu['Page']) && is_array($menu['Page'])) $menuPages = $menu['Page'];

    //     // 메뉴이름, 메뉴코드, 사용자 권한 및 PageUri, ParaName 인코딩
    //     $menuPages = Utils::bpaEncoding($menuPages)->toArray();

    //     $menu['menulist'] = Utils::formatArrayToTree($menuPages);
    //     $menu['menuTitle'] = $menuTitle;
    //     $menu['page'] = $page;

    //     // dd($menu);
    //     return $menu;
    // }

    // public function getMenuCode($menuCode = null)
    // {
    //     if ($menuCode == null) {
    //         $path = '/' . \request()->path();
    //         $menu = Utils::getMainMenu();
    //         // if (isset($menu['apiStatus']) && $menu['apiStatus'] == 505)
    //         //     echo '<script>alert("시스템 오류입니다. 로그아웃 됩니다."); window.location.href="/logout"</script>';
    //         if (isset($menu['Page']) && is_array($menu['Page'])) $menuPages = collect($menu['Page']);
    //         $menuCode = $menuPages->where('PageUri', $path)->first()['MenuCode'] ?? '';
    //     }
    //     // dd($menu);
    //     return ['menuCode' => $menuCode];
    // }
}
