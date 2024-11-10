<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class MonthlySettleController extends Controller
{
    public function index()
    {
        try {
            $monthArr = [
                "1월", "2월", "3월", "4월", "5월", "6월",
                "7월", "8월", "9월", "10월", "11월", "12월"
            ];
            $formA = new FormA(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

//         dump($formA->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.basic-settings.monthly-settle',
            array_merge(
                compact('menuCode'),
                $formA->getData(),
                compact('monthArr'))
            );
    }
}
