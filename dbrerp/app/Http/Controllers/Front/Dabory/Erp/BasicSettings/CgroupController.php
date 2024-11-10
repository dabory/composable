<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class CgroupController extends Controller
{
    public function index()
    {
        try {
            $formA = new FormA(request('bpa'));
            $moealSetFile = (new Modal('/search/setting-search/cgroup'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // dd($formA->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.basic-settings.cgroup',
            array_merge(
                compact('menuCode'),
                $formA->getData(),
                compact('moealSetFile'))
            );
    }

    public function demoWebEditor() {
        return view('demo-webeditor');
    }
}
