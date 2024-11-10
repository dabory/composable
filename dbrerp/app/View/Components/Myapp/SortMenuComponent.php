<?php

namespace App\View\Components\Myapp;

use App\Helpers\ProUtils;
use App\Models\Parameter\Modal;
use Illuminate\View\Component;

class SortMenuComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sortMenuPage = ProUtils::getSortMenu()['Page'] ?? [];

        return view('front.dabory.myapp.components.sort-menu-component', compact('sortMenuPage'))
            ->with('codeTitle', [ "sort_type('sort-type')" ]);
    }
}
