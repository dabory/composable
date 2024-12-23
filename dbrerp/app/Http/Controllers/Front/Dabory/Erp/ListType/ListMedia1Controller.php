<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\ListMedia1;
use App\Exceptions\ParameterException;

class ListMedia1Controller extends Controller
{
    public function index()
    {
//        dd(phpinfo());
        // dump(session('GateToken'));
        $mode = 'erp';
        $masterName = 'layouts.master';
        if (session('member')) {
            $mode = 'myapp';
            $masterName = 'front.dabory.myapp.layouts.master';
        }
        $dashboardRoute = "/dabory/$mode";


        try {
            $listMedia1 = new ListMedia1(request('bpa'), null, $mode);
        } catch (ParameterException $e) {
            return redirect()->to($dashboardRoute)->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        // dd($listMedia1->getData());

        return view('front.dabory.erp.list-type.list-media1',
            array_merge(
                compact('menuCode', 'masterName'),
                $listMedia1->getData(),
                )
            );
    }
}
