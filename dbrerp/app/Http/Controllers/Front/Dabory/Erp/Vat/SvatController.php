<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Vat;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class SvatController extends Controller
{
    public function index()
    {
//        dd(session()->get('user'));
//        dd(md5(config("app.api.main.ClientId")));
        try {
            $formB = new FormB(request('bpa'));
            $svatModal = (new Modal('/search/slip-search/vat/svat'))->getData();
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
            $svatModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.vat.svat',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('svatModal',
                    'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('porder')" ]);
    }
}
