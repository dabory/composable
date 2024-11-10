<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Kibana\Sales;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class SalesAggregateController extends Controller
{
    public function index()
    {
        try {
            $formA = new FormA(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.kibana.sales.sales-aggregate',
            array_merge(
                compact('menuCode'),
                $formA->getData())
            );
    }
}
