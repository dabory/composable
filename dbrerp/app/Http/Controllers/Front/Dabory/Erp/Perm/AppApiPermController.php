<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Perm;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class AppApiPermController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
            $appApiPermModal = (new Modal('/search/slip-search/app-api-perm'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

//        dd($formB->getData());
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.perm.app-api-perm',
            array_merge(
                compact('appApiPermModal'),
                compact('menuCode'),
                $formB->getData(),
            )
        );
    }
}
