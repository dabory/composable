<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Models\Parameter\Type1;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class Type1Controller extends Controller
{
    public function index()
    {
//         dump(session('GateToken'));
//         dump(session('member'));
//         dump(session('user'));
//        dd(phpinfo());
        $mode = 'erp';
        $masterName = 'layouts.master';
        if (session('member')) {
            $mode = 'myapp';
            $masterName = 'front.dabory.myapp.layouts.master';
        }
        $dashboardRoute = "/dabory/$mode";

        try {
            $type1 = new Type1(request('bpa'), null, null, false, $mode);
        } catch (ParameterException $e) {
//            dd($e->getMessage());
            return redirect()->to($dashboardRoute)->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];
        // $aa = collect($type1->getData()['type1']['HeadSelectOptions'])->filter(function($option, $i) { return $i == 0; })->first()['Caption'];
        // dd($aa);
    //    dd($type1);

//        dd(session('member'));
        // dump(collect($type1->getData()['type1']['ListVars']['Format'])->values()->toArray());

        return view('front.dabory.erp.list-type.type1',
                array_merge(
                    compact('menuCode', 'masterName', 'mode'),
                    $type1->getData(),
                )
            );
    }
}
