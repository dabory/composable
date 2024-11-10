<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Etc;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class UnderConstructionController extends Controller
{
    public function index()
    {
        $underConstrunctionPath = env('UNDER_CONSTRUCTION_PATH');
        $pathSegments = explode('::', $underConstrunctionPath);

        if(empty($underConstrunctionPath) || count($pathSegments) < 2 ){
            $viewPath = 'under-construction';
            // $msg = "UNDER_CONSTRUCTION_PATH 변수의 경로를 확인하세요.";
        }else{
            $theme = $pathSegments[0];
            $path = $pathSegments[1];
            $viewPath = str_replace('/', '.', $path);
            $viewDirectory = daboryPath('themes/' . $theme . '/pro/resources/views');

            // 뷰 경로 설정
            View::addNamespace($theme, $viewDirectory);
            $viewPath = "{$theme}::{$viewPath}";
        }

        return view($viewPath);
    }
}


