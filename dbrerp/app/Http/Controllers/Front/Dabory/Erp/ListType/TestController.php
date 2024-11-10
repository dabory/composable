<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class TestController extends Controller
{
    // public function converterSetupData($popupOption) {
    //     $popupOption['BladeRoute'] = "front.dabory.erp.{$popupOption['Component']}";
    //     $popupOption['ModalClassName'] = Utils::kebabCase($popupOption['Component']);
    //     return $popupOption;
    // }

    public function index()
    {
        // dump(session('GateToken'));
        dd('sasa');
        try {
            $formA = new FormA(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        // $setup = $this->converterSetupData([
        //     'Caption' => '미디어 라이브러리',
        //     'Component' => 'list-type.list-media1',
        //     'ParameterDir' => '/list-media1/media-input',
        //     'ParameterType' => 'listMedia1',
        // ]);
        // $setup['Parameter'] = (new ListMedia1(request('bpa'), '/list-media1/media-input'))->getData('data')['data'];

        // dd($setup);

        // dd($formA->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.test-ui.eyetest-more-ui',
            array_merge(
                compact('menuCode'),
                $formA->getData()
                )
            );
    }
}
