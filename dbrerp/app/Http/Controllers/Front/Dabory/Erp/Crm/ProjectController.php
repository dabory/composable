<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Crm;

use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
            $projectModal = (new Modal('/search/slip-search/crm/project'))->getData();
            $companyModal = (new Modal('/search/company-search/customer'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // pick api para(cache) 얻는 함수
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        $pickCacheData = Utils::getParamCache($menuCode,
            $formB->getData()['formB']['General']['PickApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        $slipCacheData = Utils::getParamCache($menuCode,
            $projectModal['General']['PageApi'],
            $formB->getData()['formB']['QueryVars']['QueryName']);

        return view('front.dabory.erp.crm.project',
            array_merge(
                compact('menuCode'),
                $formB->getData(),
                compact('projectModal',
                    'companyModal'),
                compact('pickCacheData', 'slipCacheData'),
            )
        )->with('codeTitle', [ "deal_type('deal-type')", "status('project')" ]);
    }
}
