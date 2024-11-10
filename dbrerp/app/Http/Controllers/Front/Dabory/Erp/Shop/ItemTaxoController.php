<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Shop;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;
use App\Models\Parameter\Modal;

class ItemTaxoController extends Controller
{
    public function index()
    {
        // dd(session('user'));
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            $itemTaxoModal = (new Modal('/search/slip-search/shop/item-taxo'))->getData();
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
            $itemTaxoModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.shop.item-taxo',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('itemTaxoModal',
                    'itemModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')" ]);
    }

}
