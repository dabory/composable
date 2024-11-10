<?php

namespace App\View\Components\Myapp;

use App\Helpers\ProUtils;
use App\Models\Parameter\Modal;
use App\Services\CallApiService;
use Illuminate\View\Component;
use Exception;

class LeftSidebarComponent extends Component
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
        $sortType = session()->get('member.SortMenu.C2');
        try {
            if (empty(session('member'))) {
                $menu = ProUtils::getMainMenu($sortType);
            } else if (session('member') && isset(session('member')['MemberId'])) {
                $menu = ProUtils::getMainMenu($sortType);
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

        $form = (new Modal('/etc/common/user-menu', null, 'pro'))->getData();

        // dump($disableLMenu);
//         dump(session('member'));
        $response = app(CallApiService::class)->callApi([
            'url' => 'company-pick',
            'data' => [
                'Page' => [
                    [ 'Email' => session('member.Email') ]
                ]
            ]
        ]);
        $company = $response['Page'][0];

        return view('front.dabory.myapp.components.left-sidebar-component', compact('form','menuList', 'menuPages', 'disableLMenu', 'enableRMenu', 'company'));
    }
}
