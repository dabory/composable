<?php

namespace App\Models\Parameter\Pro;

use App\Helpers\ProUtils;
use App\Helpers\ParameterUtils;

class FormA extends \App\Models\Parameter\FormA
{
    public function __construct($bpa, $customParaName = null, $themeDir = null, $popupOptions = false)
    {
        $this->bpa = ProUtils::bpaDecoding($bpa);

        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }

        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = ProUtils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir, $popupOptions);
        } else {
            $this->data = ProUtils::getParamFile($this->bpa['para_name'], '.json', $popupOptions);
        }

        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }
}
