<?php


namespace App\Http\Controllers\Front\Dabory\Erp\Balance;


use App\Helpers\Utils;
use App\Models\Parameter\FormB;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class ListFormBalanceController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
//         dd($formB->getData());

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.balance.list-form-balance',
            array_merge(
                $formB->getData(),
                compact('menuCode'),
            )
        );
    }
}
