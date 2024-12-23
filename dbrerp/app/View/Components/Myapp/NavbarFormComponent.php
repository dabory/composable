<?php

namespace App\View\Components\Myapp;

use App\Helpers\Utils;
use Illuminate\View\Component;
use App\Models\Parameter\Modal;

class NavbarFormComponent extends Component
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
        $form = (new Modal('/etc/common/user-menu', null, 'pro'))->getData();

        return view('front.dabory.myapp.components.navbar-form-component', compact('form'));
    }
}
