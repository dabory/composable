<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Purchase;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class PorderController extends Controller
{
    public function index()
    {
//        dd(phpinfo());
//         dump(session('GateToken'));
//         dd(session('user'));
        try {
            $formB = new FormB(request('bpa'));
            $porderModal = (new Modal('/search/slip-search/purch/porder'))->getData();
            // dd(porderModal);
            $companyModal = (new Modal('/search/company-search/supplier'))->getData();
            $itemModal = (new Modal('/search/item-search/supplier'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // pick api para(cache) 얻는 함수
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $slipFormInitCacheData = Utils::getSlipFormInitCache(
            $formB->getData()['formB']['QueryVars']['QueryName']
        );

        // dd($slipFormInitCacheData);

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $porderModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.purchase.porder',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('porderModal',
                    'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData', 'slipFormInitCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('porder')" ]);
    }
}
