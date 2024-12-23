<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Sales;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;
use App\Models\Parameter\Modal;

class SquoteController extends Controller
{
    public function index()
    {
        // dd(session('user'));
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            // dd($formB);
            $squoteModal = (new Modal('/search/slip-search/sales/squote'))->getData();
            $companyModal = (new Modal('/search/company-search/all'))->getData();
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
            $squoteModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.sales.squote',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('squoteModal',
                    'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData', 'slipFormInitCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('squote')" ]);
    }

}
