<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Pro;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class PostLangController extends Controller
{
    public function index()
    {
        try {
            $formB = new FormB(request('bpa'));
            $slipSearchPara = \Str::replace('form-b', 'slip-search', \Str::replace('/form/form-b', '/search/slip-search', Utils::bpaDecoding(request('bpa'))['para_name']));
            $postModal = (new Modal($slipSearchPara))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

//        dd($formB->getData());
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.erp.pro.post-lang.head',
            array_merge(
                compact('postModal'),
                compact('menuCode'),
                $formB->getData(),
            )
        )->with('codeTitle', [ "lang_type('lang-type')", "sort('post-type')",
            "status('post-banner')", "status('post-event')", "status('post-miner')",
            "status('post-notice')", "status('post-policy')", "status('post-qna')",
            "status('post-standard')", "status('post-token-swap1')",
        ]);
    }
}
