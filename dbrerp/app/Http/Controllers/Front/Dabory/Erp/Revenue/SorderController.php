<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Revenue;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class SorderController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            $sorderModal = (new Modal('/search/slip-search/sales/sorder'))->getData();
            $companyModal = (new Modal('/search/company-search/company'))->getData();
            $itemModal = (new Modal('/search/item-search/sales'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // pick api para(cache) 얻는 함수
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $slipFormInitCacheData = Utils::getSlipFormInitCache(
            $formB->getData()['formB']['QueryVars']['QueryName']
        );

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $sorderModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.revenue.sorder',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('sorderModal',
                    'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData', 'slipFormInitCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('sorder')" ]);
    }
}
