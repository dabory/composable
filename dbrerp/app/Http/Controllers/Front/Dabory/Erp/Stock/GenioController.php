<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Stock;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class GenioController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            // dd($formB);
            $genioModal = (new Modal('/search/slip-search/stock/genio'))->getData();
            // dd($genioModal);
            $companyModal = (new Modal('/search/company-search/all'))->getData();
            // dd($companyModal);
            $itemModal = (new Modal('/search/item-search/supplier'))->getData();
            // dd($itemModal);
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $slipFormInitCacheData = Utils::getSlipFormInitCache(
            $formB->getData()['formB']['QueryVars']['QueryName']
        );

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $genioModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

//        dd(session('user'));

        return view('front.dabory.erp.stock.genio',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('genioModal', 'companyModal', 'itemModal'),
                compact('pickCacheData', 'slipCacheData', 'slipFormInitCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('genio')" ]);
    }
}
