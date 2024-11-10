<?php

namespace App\View\Components;

use App\Helpers\Utils;
use App\Models\Parameter\Modal;
use Illuminate\View\Component;
use Exception;

class NavSideBarComponent extends Component
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
//        dd(session('GateToken'));
        $sortType = session()->get('user.SortMenu.C2');
        try {
            if (empty(session('user'))) {
                $menu = Utils::getMainMenu($sortType);
            } else if (session('user') && isset(session('user')['UserId'])) {
                $menu = Utils::getMainMenu($sortType);
            } else {
                $menu = [ 'Page' => [] ];
            }
        } catch (Exception $e) {
            $menu = [ 'Page' => [] ];
        }

        if (empty($menu['Page'])) {
            notify()->info('사용권한은 시스템 관리자에게 문의하시기 바랍니다.', 'Info', 'bottomRight');
        }

        $menuPages = [];
        if (isset($menu['Page']) && is_array($menu['Page'])) $menuPages = $menu['Page'];

        $menuPages = Utils::bpaEncoding($menuPages)->toArray();
        $menuList = Utils::formatMenuList($menuPages);

        $bpa = request('bpa');
        $disableLMenu = [];
        $enableRMenu = [];
        if (isset($bpa)) {
            $disableLMenu = Utils::bpaDecoding($bpa)['disable_l_menu'];
            $enableRMenu = Utils::bpaDecoding($bpa)['enable_r_menu'];
        }

        $form = (new Modal('/etc/common/user-menu'))->getData();
//         dd($menuList);
//        dd($menuPages);

        return view('components.nav-side-bar-component', compact('form','menuList', 'menuPages', 'disableLMenu', 'enableRMenu'));
    }
}
