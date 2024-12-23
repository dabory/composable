<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Shop;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;
use App\Models\Parameter\Modal;
use App\Models\Parameter\Type1;

class WidgetTaxoController extends Controller
{
    public function index()
    {
        // dd(session('user'));
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            $itemTaxoModal = (new Modal('/search/slip-search/shop/widget-taxo'))->getData();

            $popupOptions = (new Type1(request('bpa'), '/list/list-type1/shop/widget-taxo'))->getData()['type1']['SelectPopupOptions'];

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

        return view('front.dabory.erp.shop.widget-taxo',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('itemTaxoModal'),
                compact('pickCacheData', 'slipCacheData'),
                compact('popupOptions')
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "device_type('device-type')", "lang_type('lang-type')" ]);
    }

}
