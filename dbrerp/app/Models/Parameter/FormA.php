<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;

class FormA
{
    protected $data;
    protected $bpa;

    public function __construct($bpa, $customParaName = null, $themeDir = null, $popupOptions = false, $mode = 'erp')
    {
        if (empty($bpa)) {
            $this->initBpa();
        } else {
            $this->bpa = Utils::bpaDecoding($bpa);
        }

        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }

        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = Utils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir, $popupOptions);
        } else {
            $this->data = Utils::getParamFile($this->bpa['para_name'], '.json', $popupOptions, $mode);
        }

        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa, 'CustomVar' => $this->bpa['custom_var'] ?? '']);

        $this->converterData();
    }

    public function initBpa()
    {
        $this->bpa['theme_dir'] = 'empty';
        $this->bpa['page_uri'] = '/';
        $this->bpa['permission'] = session()->get('user.MenuPermission');
        if (empty($this->bpa['permission'])) {
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
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return ['formA' => $this->data];
    }

    protected function converterData()
    {
        $this->createPermission();
        $this->exceptionHandling();
        ParameterUtils::separateAlignAndFormat($this->data, 'FormVars');
        ParameterUtils::checkDisplayAndCount($this->data, 'FormVars');
        ParameterUtils::mappingKeys($this->data, 'FormVars');
    }

    protected function createPermission()
    {
        $this->data['SelectButtonOptions'] = collect($this->data['SelectButtonOptions'])->map(function ($selectBtnOption, $index) {
            switch ($selectBtnOption['Value']) {
                case 'new':
                    $permission = 'is_create';
                    break;
                case 'del':
                case 'multi-delete':
                    $permission = 'is_delete';
                    break;
                default:
                    $permission = 'dummy';
            }
            return array_merge($selectBtnOption, ['Permission' => $permission]);
        })->toArray();

    }

    protected function exceptionHandling()
    {
        if ($this->bpa['permission']['is_update'] === '0') {
            $this->data['FormVars'][0]['SaveButton'] = '';
        }


        $this->data['SelectButtonOptions'] = collect($this->data['SelectButtonOptions'])->filter(function ($selectBtnOption) {
            return $selectBtnOption['Value'] != NULL;
        })->filter(function ($selectBtnOption) {
            if ($selectBtnOption['Permission'] === 'dummy') {
                return true;
            }
            return $this->bpa['permission'][$selectBtnOption['Permission']] === '1';
        })->values()->toArray();
    }
}
