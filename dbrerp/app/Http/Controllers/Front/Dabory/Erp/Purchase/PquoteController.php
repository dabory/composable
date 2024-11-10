<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Purchase;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;
use App\Models\Parameter\Modal;

class PquoteController extends Controller
{
    public function index()
    {
//         dd(session('user'));
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            $pquoteModal = (new Modal('/search/slip-search/purch/pquote'))->getData();
            $companyModal = (new Modal('/search/company-search/supplier'))->getData();
            $itemModal = (new Modal('/search/item-search/supplier'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // pick api para(cache) 얻는 함수
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $pquoteModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.purchase.pquote',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('pquoteModal',
                    'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('pquote')" ]);
    }

}
