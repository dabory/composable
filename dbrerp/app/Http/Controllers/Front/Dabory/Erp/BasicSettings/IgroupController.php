<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class IgroupController extends Controller
{
    public function index()
    {
        try {
            $formA = new FormA(request('bpa'));
            $moealSetFile = (new Modal('/search/setting-search/igroup'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

//         dump($formA->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.basic-settings.igroup',
            array_merge(
                compact('menuCode'),
                $formA->getData(),
                compact('moealSetFile'))
            );
    }
}