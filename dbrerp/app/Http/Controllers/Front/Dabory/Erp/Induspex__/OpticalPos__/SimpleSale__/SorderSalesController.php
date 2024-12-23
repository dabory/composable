<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Induspex\OpticalPos\SimpleSale__;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Models\Parameter\Type1;
use App\Services\CallApiService;
use function redirect;
use function request;
use function view;

class SorderSalesController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
            $salesFormB = new FormB(request('bpa'), '/induspex/optical-pos/simple-sale/form-b/sales');
            $sorderModal = (new Modal('/search/slip-search/sales/sorder'))->getData();
            $itemModal = (new Modal('/search/item-search/sales'))->getData();
            $shortcutInputModal = (new Modal('/search/item-shortcut-input'))->getData();

            $popupOptions = (new Type1(request('bpa'), '/list/induspex/optical-pos/simple-sale/list-type1/item-fngoods-input'))->getData()['type1']['SelectPopupOptions'];
//            dump($popupOptions);
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

//         dd($formB->getData());
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $sorderModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $itemInputShortcut = $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'item-input-shortcut',
                'BrandCode' => ''
            ]
        ]);
        $shortcutInputModal['ItemInputShortcutSetup'] = $itemInputShortcut;

        return view('front.dabory.erp.induspex.optical-pos.simple-sale.sorder-sales',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                $salesFormB->getData('salesFormB'),
                compact('sorderModal', 'itemModal', 'popupOptions'),
                compact('pickCacheData', 'slipCacheData'),
                compact('shortcutInputModal')
            )
        )->with('codeTitle', [ "status('sorder')", "deal_type('deal-type')" ]);
    }
}
