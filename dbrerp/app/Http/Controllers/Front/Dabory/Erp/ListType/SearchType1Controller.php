<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;
use App\Models\Parameter\FormSelect;

class SearchType1Controller extends Controller
{
    public function index()
    {
        try {
            $formSelect = new FormSelect(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        // dd($formSelect->getData()['formSelect']['FormVars']['Title']['Chk']);

        return view('front.dabory.erp.list-type.form-select',
            array_merge(compact('menuCode'), $formSelect->getData())
            );
    }
}
