<?php

namespace App\Models\Parameter\Pro;

use App\Helpers\ProUtils;

class FormB extends \App\Models\Parameter\FormB
{
    protected $data;
    protected $bpa;
    protected $permissionNameList = ['is_create', 'is_update', 'is_create', 'is_read', 'is_delete', 'is_create', 'is_create'];

    public function __construct($bpa, $customParaName = null, $themeDir = null)
    {
        $this->bpa = ProUtils::bpaDecoding($bpa);
        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }
        // dd($this->bpa);
        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = ProUtils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir);
        } else {
            $this->data = ProUtils::getParamFile($this->bpa['para_name']);
        }
        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }
}
