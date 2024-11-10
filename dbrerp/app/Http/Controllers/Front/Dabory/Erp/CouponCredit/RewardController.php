<?php

namespace App\Http\Controllers\Front\Dabory\Erp\CouponCredit;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class RewardController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
            $rewardModal = (new Modal('/search/slip-search/point/reward'))->getData();
            $customerModal = (new Modal('/search/company-search/customer'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $rewardModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

//        dd($formB->getData());

        return view('front.dabory.erp.coupon-credit.reward',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('rewardModal', 'customerModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')" ]);
    }
}
