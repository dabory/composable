<?php

namespace App\Http\Controllers\Front\Dabory\Erp\MasterData;

use App\Helpers\Utils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\FormPost;
use App\Models\Parameter\Modal;
use App\Http\Controllers\Controller;
use App\Exceptions\ParameterException;

class PostTabbedController extends Controller
{
    public function index()
    {

        $mode = 'erp';
        $masterName = 'layouts.master';
        $isItemRegist = true;
        if (session('member')) {
            $mode = 'myapp';
            $masterName = 'front.dabory.myapp.layouts.master';
        }
        $dashboardRoute = "/dabory/$mode";
        try {
            $moealSetFile = (new Modal('/search/prompt-search/prompt'))->getData();
            // dd($moealSetFile);
            $formPost = new formPost(request('bpa'), null, null, false, $mode);
            // dd($formPost);

        } catch (ParameterException $e) {
            return redirect()->to($dashboardRoute)->with('error', $e->getMessage());
        }
        // dd($formPost->getData()['formA']['FormPostVars']);

        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];
        // dd($menuCode);

        return view('front.dabory.erp.master-data.post-tabbed',
            array_merge(
                compact('menuCode', 'masterName', 'mode', 'isItemRegist', 'moealSetFile'),
                $formPost->getData())
            )->with('codeTitle', [
            "ship_type('item')", "cargo_type('item')", "condition_type('item')"
        ]);
    }
}
