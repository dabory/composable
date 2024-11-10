<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Meta;

class SeoMetaComponent extends Component
{
    public $metas;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metas)
    {
        $this->metas = json_decode($metas, true)['Metas'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        foreach ($this->metas ?? [] as $meta) {
            Meta::set($meta['Name'], $meta['Content']);
        }

        return view('components.seo-meta-component');
    }
}
