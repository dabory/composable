<?php

namespace App\View\Components\Myapp;

use App\Helpers\ProUtils;
use App\Models\Parameter\Modal;
use Illuminate\View\Component;
use Exception;

class RightSidebarComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sortType = session()->get('member.SortMenu.C2');
        $form = (new Modal('/etc/common/user-menu', null, 'pro'))->getData();

        $currentBpa = ProUtils::bpaDecoding(request('bpa'));

        try {
        $menuPage = ProUtils::getMainMenu($sortType)['Page'] ?? [];
        } catch (Exception $e) {
            $menuPage = [];
        }
        $bpa = ProUtils::bpaEncoding($menuPage)->pluck('bpa')->toArray();
        $menuPage = collect($menuPage)->map(function ($menu, $index) use ($bpa) {
            return array_merge($menu, ['bpa' => $bpa[$index]]);
        });

//         dd($menuPage);
        return view('front.dabory.myapp.components.right-sidebar-component', compact('form','currentBpa', 'menuPage'));
    }
}
