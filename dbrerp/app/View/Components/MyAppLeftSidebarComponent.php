<?php

namespace App\View\Components;

use App\Helpers\ProUtils;
use Illuminate\View\Component;
use Exception;

class MyAppLeftSidebarComponent extends Component
{
    public $menuCode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menuCode = '')
    {
        $this->menuCode = $menuCode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function render()
    {
        try {
            if (empty(session('member'))) {
                $menu = ProUtils::getMainMenu();
            } else if (session('member') && isset(session('member')['MemberId'])) {
                $menu = ProUtils::getMainMenu();
            } else {
                $menu = ['Page' => []];
            }
        } catch (Exception $e) {
            $menu = [ 'Page' => [] ];
        }
//        dd($menu);

        if (empty($menu['Page'])) {
            notify()->info('사용권한은 시스템 관리자에게 문의하시기 바랍니다.', 'Info', 'bottomRight');
        }

        $menuPages = [];
        if (isset($menu['Page']) && is_array($menu['Page'])) $menuPages = $menu['Page'];

        $menuPages = ProUtils::bpaEncoding($menuPages)->toArray();
        $menuList = ProUtils::formatMenuList($menuPages);

        $bpa = request('bpa');
        $disableLMenu = [];
        $enableRMenu = [];
        if (isset($bpa)) {
            $disableLMenu = ProUtils::bpaDecoding($bpa)['disable_l_menu'];
            $enableRMenu = ProUtils::bpaDecoding($bpa)['enable_r_menu'];
        }

        // dump($disableLMenu);
        // dump($enableRMenu);
//         dd($menuList);

        return view('front.dabory.pro.my-app.components.left-sidebar-component', compact('menuList', 'disableLMenu', 'enableRMenu'));
    }
}
