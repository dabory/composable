<?php

namespace App\View\Components;

use App\Helpers\ProUtils;
use Illuminate\View\Component;

class MyAppRightSidebarComponent extends Component
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
        $currentBpa = ProUtils::bpaDecoding(request('bpa'));
        $menuPage = ProUtils::getMainMenu()['Page'] ?? [];
        $bpa = ProUtils::bpaEncoding($menuPage)->pluck('bpa')->toArray();
        $menuPage = collect($menuPage)->map(function ($menu, $index) use ($bpa) {
            return array_merge($menu, ['bpa' => $bpa[$index]]);
        });

        // dd($menuPage);
        return view('front.dabory.pro.my-app.components.right-sidebar-component', compact('currentBpa', 'menuPage'));
    }
}
