<?php

namespace App\Http\Controllers\Front\Dabory\Erp\MasterData;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $formA = new FormA(request('bpa'));
            $moealSetFile = (new Modal('/search/company-search/company'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.master-data.company',
            array_merge(
                compact('menuCode'),
                $formA->getData(),
                compact('moealSetFile'))
            )->with('codeTitle', [ "sort('company')"]);
    }
}
