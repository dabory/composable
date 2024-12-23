<?php

namespace App\Http\Controllers\Front\Dabory\Erp\MasterData;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class ItemController extends Controller
{
    public function index()
    {
//        dd(session('user')['CountryCode']);
        $mode = 'erp';
        $masterName = 'layouts.master';
        $isItemRegist = true;
        if (session('member')) {
            $mode = 'myapp';
            $masterName = 'front.dabory.myapp.layouts.master';
        }

        $dashboardRoute = "/dabory/$mode";
        try {
            $formA = new FormA(request('bpa'), null, null, false, $mode);
//            $companyModal = (new Modal('/search/company-search/supplier'))->getData();
//            $itemModal = (new Modal('/search/item-search/item'))->getData();
        } catch (ParameterException $e) {
            return redirect()->to($dashboardRoute)->with('error', $e->getMessage());
        }
//         dd($formA->getData()['formA']['FormVars']);

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.master-data.item',
            array_merge(
                compact('menuCode', 'masterName', 'mode', 'isItemRegist'),
                $formA->getData())
            )->with('codeTitle', [
            "ship_type('item')", "cargo_type('item')", "condition_type('item')"
        ]);
    }
}
