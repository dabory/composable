<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Models\Parameter\Type1;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class GenesisType1Controller extends Controller
{
    public function index()
    {
        try {
            $type1 = new Type1(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        // dd($type1->getData());

        return view('front.dabory.erp.list-type.genesis-type1',
            array_merge(
                compact('menuCode'),
                $type1->getData(),
                )
            );
    }
}
