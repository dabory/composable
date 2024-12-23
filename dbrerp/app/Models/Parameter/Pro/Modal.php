<?php

namespace App\Models\Parameter\Pro;

use App\Helpers\ProUtils;
use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use App\Exceptions\ParameterException;

class Modal extends \App\Models\Parameter\Modal
{
    protected $data;

    public function __construct($para_name, $themeDir = null)
    {
        try {
            if ($themeDir && $themeDir !== 'empty') {
                $this->data = ProUtils::getThemeParamFile($para_name, '.json', $themeDir);
            } else {
                $this->data = ProUtils::getParamFile($para_name);
            }
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $this->converterData();
    }
}
