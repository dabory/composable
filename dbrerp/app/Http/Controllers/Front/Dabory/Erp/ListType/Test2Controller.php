<?php

namespace App\Http\Controllers\Front\Dabory\Erp\ListType;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;

class Test2Controller extends Controller
{
    public function index()
    {
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];
        return view(
            'front.dabory.erp.test-ui.mms-ui',
            array_merge(
                compact('menuCode'),
            )
    );
}
}
