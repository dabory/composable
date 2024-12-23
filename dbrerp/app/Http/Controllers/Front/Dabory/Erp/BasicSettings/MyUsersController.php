<?php

namespace App\Http\Controllers\Front\Dabory\Erp\BasicSettings;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class MyUsersController extends Controller
{
    public function index()
    {
        try {
            $formA = new FormA(request('bpa'));
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.basic-settings.my-users',
            array_merge(
                compact('menuCode'),
                $formA->getData() )
            );
    }
}
