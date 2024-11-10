<?php

namespace App\View\Components;

use App\Helpers\Utils;
use Illuminate\View\Component;
use App\Models\Parameter\Modal;
use Exception;

class RightSideBarComponent extends Component
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
        $sortType = session()->get('user.SortMenu.C2');
        $form = (new Modal('/etc/common/user-menu'))->getData();

        $currentBpa = Utils::bpaDecoding(request('bpa'));

        try {
            $menuPage = Utils::getMainMenu($sortType)['Page'] ?? [];
        } catch (Exception $e) {
            $menuPage = [];
        }
        $bpa = Utils::bpaEncoding($menuPage)->pluck('bpa')->toArray();
        $menuPage = collect($menuPage)->map(function ($menu, $index) use ($bpa) {
            return array_merge($menu, ['bpa' => $bpa[$index]]);
        });

        return view('components.right-side-bar-component', compact('form', 'currentBpa', 'menuPage'));
    }
}
