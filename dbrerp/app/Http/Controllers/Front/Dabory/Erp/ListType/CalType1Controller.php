<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Models\Parameter\Type1;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class CalType1Controller extends Controller
{
    public function index()
    {
//         dump(session('GateToken'));
        // dump(session('user'));
//        dd(phpinfo());

        try {
            $calType1 = new Type1(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];
        // $aa = collect($type1->getData()['type1']['HeadSelectOptions'])->filter(function($option, $i) { return $i == 0; })->first()['Caption'];
        // dd($aa);
    //    dd($type1);

        // dump(collect($type1->getData()['type1']['ListVars']['Format'])->values()->toArray());

        return view('front.dabory.erp.list-type.cal-type1',
                array_merge(
                    compact('menuCode'),
                    $calType1->getData('calType1')
                )
            );
    }
}
