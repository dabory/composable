<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class ItemOptproController extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        $mode = 'erp';
        $masterName = 'layouts.master';
        if (session('member')) {
            $mode = 'myapp';
            $masterName = 'front.dabory.myapp.layouts.master';
        }
        $dashboardRoute = "/dabory/$mode";

        try {
            $formB = new FormB(request('bpa'));
            $createdItemFormB = new FormB(request('bpa'), '/form/form-b/master/created-item');
            $itemOptproModal = (new Modal('/search/slip-search/master/item-optpro'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

//        dd(session('user'));
//        dd($formB->getData());

        return view('front.dabory.erp.basic-settings.master.item-optpro',
            array_merge(
                compact('menuCode', 'masterName', 'mode'),
                $formB->getData(),
                $createdItemFormB->getData('createdItemFormB'),
                compact('itemOptproModal'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')" ]);
    }
}
