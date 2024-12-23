<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;

class FormPost
{
    private $data;
    private $bpa;
    private $permissionNameList = ['is_create', 'is_update', 'is_delete', 'is_read', 'is_create'];

    public function __construct($bpa, $customParaName = null, $themeDir = null, $popupOptions = false)
    {
        if (empty($bpa)) {
            $this->initBpa();
        } else {
            $this->bpa = Utils::bpaDecoding($bpa);
        }

        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }

        if ($themeDir && $themeDir !== 'empty') {
            $this->data = Utils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir);
        } else {
            $this->data = Utils::getParamFile($this->bpa['para_name']);
        }

        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }

    public function initBpa()
    {
//        Todo: permission 전체 가능하게 변경하기
        $this->bpa['theme_dir'] = 'empty';
        $this->bpa['page_uri'] = '/';
        $this->bpa['permission'] = [
            'is_mymenu' => '0',
            'is_list' => '1',
            'is_read' => '1',
            'is_create' => '1',
            'is_update' => '1',
            'is_delete' => '1',
            'is_newtab' => '0',
        ];
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return ['formA' => $this->data];
    }

    protected function resetDisplayVarsToDefaultValues()
    {
        if (empty($this->data['DisplayVars']['Chunk']))
            $this->data['DisplayVars']['Chunk'] = 999;
    }

    private function converterData()
    {
        $this->createPermission();
        $this->exceptionHandling();
        ParameterUtils::separateAlignAndFormat($this->data, 'FormPostVars');
        ParameterUtils::checkDisplayAndCount($this->data, 'FormPostVars');
        ParameterUtils::mappingKeys($this->data, 'FormPostVars');

        $this->checkSaveBtnPermission();
        $this->resetDisplayVarsToDefaultValues();
    }

    private function createPermission()
    {
        $this->data['SelectButtonOptions'] = collect($this->data['SelectButtonOptions'])->map(function ($selectBtnOption, $index) {
            return array_merge($selectBtnOption, ['Permission' => $this->permissionNameList[$index] ?? 'is_create']);
        })->toArray();
    }

    private function exceptionHandling()
    {
        $this->data['SelectButtonOptions'] = collect($this->data['SelectButtonOptions'])->filter(function ($selectBtnOption) {
            return $selectBtnOption['Value'] != NULL;
        })->filter(function ($selectBtnOption) {
            return $this->bpa['permission'][$selectBtnOption['Permission']] == 1;
        })->values()->toArray();
    }

    private function checkSaveBtnPermission()
    {
        if (isset($this->data['FormPostVars']['Title']['SaveButton']) && !$this->bpa['permission']['is_update']) {
            $this->data['FormPostVars']['Hidden']['SaveButton'] = 'hidden';
        }
    }
}
