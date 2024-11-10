<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class Test3Controller extends Controller
{
    public function index()
    {
        // dump(session('GateToken'));
        try {
            $formB = new FormB(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // dd($formB->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];
        return view(
            'front.dabory.erp.popup-setup.form-b.item-input-shortcut-form',
            array_merge(
                compact('menuCode'),
                $formB->getData()
            )
    );
}
}
