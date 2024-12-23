<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Etc;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class MediaController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
            $slipModal = (new Modal('/search/slip-search/media'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];


        return view('front.dabory.erp.etc.media',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('slipModal'),
            ));
    }
}
