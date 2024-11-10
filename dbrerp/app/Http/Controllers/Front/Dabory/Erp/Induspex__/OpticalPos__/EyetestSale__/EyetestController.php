<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Induspex\OpticalPos\EyetestSale__;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Models\Parameter\Type1;
use function redirect;
use function request;
use function view;

class EyetestController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $formA = new FormA(request('bpa'), '/induspex/optical-pos/eyetest-sale/form-a/customer-eyetest');
            $formB = new FormB(request('bpa'));
            $salesFormB = new FormB(request('bpa'), '/induspex/optical-pos/eyetest-sale/form-b/sales');
            $eyetestModal = (new Modal('/induspex/optical-pos/eyetest-sale/search/slip-search/eyetest'))->getData();
            $customerTieModal = (new Modal('/search/slip-search/point/customer-tie'))->getData();
            $customerModal = (new Modal('/search/company-search/customer'))->getData();
            $itemModal = (new Modal('/search/item-search/sales'))->getData();

            $popupOptions = (new Type1(request('bpa'), '/list/induspex/optical-pos/eyetest-sale/list-type1/item-fngoods-input'))->getData()['type1']['SelectPopupOptions'];
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
            $eyetestModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.induspex.optical-pos.eyetest-sale.eyetest',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                $salesFormB->getData('salesFormB'),
                $formA->getData(),
                compact('eyetestModal', 'customerModal', 'customerTieModal', 'itemModal', 'popupOptions'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "status('sorder')", "deal_type('deal-type')" ]);
    }
}
