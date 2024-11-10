<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use App\Models\Parameter\CopyToAnother;
use Illuminate\Support\Str;

class FormB
{
    protected $data;
    protected $bpa;
    protected $permissionNameList = ['is_create', 'is_update', 'is_create', 'is_read', 'is_delete', 'is_create', 'is_create'];

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
        // dd($this->bpa);
        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = Utils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir, $popupOptions);
        } else {
            $this->data = Utils::getParamFile($this->bpa['para_name'], '.json', $popupOptions, $mode);
        }
        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }

    public function initBpa()
    {
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

        return ['formB' => $this->data];
    }

    public function getCopyPara($SelectOptionsName, $value)
    {
        return collect($this->data[$SelectOptionsName])->where('Value', $value)->pluck('ParameterName');
    }

    protected function converterData()
    {
        foreach (['HeadSelectOptions', 'BodySelectOptions'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                $this->createPermission($varsName);
                $this->exceptionHandling($varsName);

                $this->renamingWithParameterName($varsName);
                $this->getCopyParameter($varsName);
            }
        }
        foreach (['FormVars', 'ListVars', 'FooterVars', 'EyeTestVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }

        $this->checkSaveBtnPermission();
    }

    protected function getCopyParameter($selectOptions)
    {
        // SelectOptions 모달 파라메터 얻기
        for ($i = 0; $i < count($this->data[$selectOptions]); $i++) {
            if (empty($this->data[$selectOptions][$i]['ParameterName'])) continue;

            $themeDir = $this->data[$selectOptions][$i]['ThemeDir'] ?? 'empty';
            $this->data[$selectOptions][$i]['OptionsType'] = $selectOptions;
            $popupOption = $this->data[$selectOptions][$i];
            $parameterUrl = "/copy/{$this->data[$selectOptions][$i]['Value']}/{$this->data[$selectOptions][$i]['ParameterName']}";
            if ($this->data[$selectOptions][$i]['Value'] == 'copy-to-another') {
                $this->data[$selectOptions][$i]['Parameter'] = (new CopyToAnother($parameterUrl, $themeDir, $popupOption))->getData();
            } elseif ($this->data[$selectOptions][$i]['Value'] == 'body-copy') {
                $this->data[$selectOptions][$i]['Parameter'] = (new BodyCopy($parameterUrl, $themeDir, $popupOption))->getData();
            }
            $this->data[$selectOptions][$i]['BladeRoute'] = 'front.outline.static.'.$this->data[$selectOptions][$i]['Value'];
        }
    }

    protected function renamingWithParameterName($selectOptions)
    {
        $this->data[$selectOptions] = collect($this->data[$selectOptions])->map(function ($selectOption) {
            $parameterName = $selectOption['Parameter'] ?? '';
            return array_merge($selectOption, ['ParameterName' => $parameterName, 'ModalClassName' => Str::replace('/', '-', $parameterName)]);
        })->toArray();
    }

    protected function createPermission($SelectOptionsName)
    {
        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->map(function ($selectBtnOption, $index) {
            return array_merge($selectBtnOption, ['Permission' => $this->permissionNameList[$index] ?? 'is_create']);
        })->toArray();
    }

    protected function exceptionHandling($SelectOptionsName)
    {
        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->filter(function ($selectBtnOption) {
            return $selectBtnOption['Value'] != NULL;
        })->filter(function ($selectBtnOption) {
            return $this->bpa['permission'][$selectBtnOption['Permission']] == 1;
        })->values()->toArray();
    }

    protected function checkSaveBtnPermission()
    {
        if (isset($this->data['FormVars']['Title']['SaveButton']) && !$this->bpa['permission']['is_update']) {
            $this->data['FormVars']['Hidden']['SaveButton'] = 'hidden';
        }
    }
}
