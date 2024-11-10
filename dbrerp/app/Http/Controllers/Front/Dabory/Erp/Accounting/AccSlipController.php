<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Accounting;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class AccSlipController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        // dump(session('user'));
        try {
            $formB = request('popup') ? new FormB(request('bpa'), '/form/form-b/acc-slip-popup-paid') : new FormB(request('bpa'));
            $accSlipModal = (new Modal('/search/slip-search/acc-slip'))->getData();
            $sorderModal = (new Modal('/search/slip-search/sales/sorder'))->getData();
            $porderModal = (new Modal('/search/slip-search/purch/porder'))->getData();
            $companyModal = (new Modal('/search/company-search/supplier'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
        // dd($formB->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $accSlipModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.accounting.acc-slip',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('accSlipModal', 'companyModal', 'sorderModal', 'porderModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "bill_type('bill-type')" ]);
    }
}
