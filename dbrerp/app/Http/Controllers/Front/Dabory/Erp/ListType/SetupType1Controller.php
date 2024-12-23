<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\SetupType1;
use App\Exceptions\ParameterException;


class SetupType1Controller extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $setupType1 = new SetupType1(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        // dump($setupType1->getData());

        return view('front.dabory.erp.list-type.setup-type1',
            array_merge(
                compact('menuCode'),
                $setupType1->getData(),
                )
            );
    }
}
