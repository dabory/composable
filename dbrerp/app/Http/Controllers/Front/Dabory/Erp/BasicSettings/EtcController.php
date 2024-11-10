<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class EtcController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // pick api para(cache) 얻는 함수
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.basic-settings.etc',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
            )
        );
    }
}
