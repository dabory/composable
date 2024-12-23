<?php

namespace App\Http\Controllers\Front\Dabory\Erp\Etc;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Parameter\FormB;

class UnderConstructionController extends Controller
{
    public function index()
    {
        $underConstrunctionPath = env('UNDER_CONSTRUCTION_PATH');
        if($underConstrunctionPath === 'standard'){
            $viewPath = 'under-construction';
        }else{
            $pathSegments = explode('::', $underConstrunctionPath);
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


