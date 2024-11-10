<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use App\Models\Parameter\Modal;

class FormProcess
{
    private $data;
    private $bpa;
    private $permissionNameList = ['is_create', 'is_update', 'is_create', 'is_read', 'is_delete', 'is_create', 'is_create'];

    public function __construct($bpa, $customParaName = null)
    {
        $this->ecodingBpa = $bpa;
        $this->bpa = Utils::bpaDecoding($bpa);
        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }
        // dd($this->bpa);
        $this->data = Utils::getParamFile($this->bpa['para_name']);
        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return ['formF' => $this->data];
    }

    public function getCopyPara($SelectOptionsName, $value)
    {
        return collect($this->data[$SelectOptionsName])->where('Value', $value)->pluck('Parameter');
    }

    private function resetDisplayVarsToDefaultValues()
    {
        // 사이즈 디폴트 생성
        if (! isset($this->data['DisplayVars'])) {
            $this->data['DisplayVars']['HeadHeight'] = '250';
            $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsFirstCheck', 'IsSecondCheck', 'IsThirdCheck', 'IsFourthCheck'] as $displayVar) {
                $this->data['DisplayVars'][$displayVar] = false;
            }
        } else {
            if (empty($this->data['DisplayVars']['HeadHeight']))
                $this->data['DisplayVars']['HeadHeight'] = '250';
            if (empty($this->data['DisplayVars']['BodyHeight']))
                $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsFirstCheck', 'IsSecondCheck', 'IsThirdCheck', 'IsFourthCheck'] as $displayVar) {
                if (empty($this->data['DisplayVars'][$displayVar]))
                    $this->data['DisplayVars'][$displayVar] = false;
            }
        }
    }

    private function getListType1RangeVarsModalParameter()
    {
        if (! isset($this->data['ListType1RangeVars'])) return;
        // ListType1RangeVars 모달 파라메터 얻기
        foreach ($this->data['ListType1RangeVars']['ParameterName'] as $key => $parameterName) {
            if ($this->data['FormVars']['Display'][$key] == 'd-none') {
                $this->data['ListType1RangeVars']['Parameter'][$key] = '';
                continue;
            }

            $this->data['ListType1RangeVars']['Parameter'][$key] = (new Modal($parameterName))->getData();
            $this->data['ListType1RangeVars']['BladeRoute'][$key] = 'front.outline.static.'.$this->data['ListType1RangeVars']['Component'][$key];
        }
    }

    private function converterData()
    {
        foreach (['HeadSelectOptions', 'BodySelectOptions'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                $this->createPermission($varsName);
                $this->exceptionHandling($varsName);
            }
        }
        foreach (['FormVars', 'ListVars', 'FooterVars', 'ListType1RangeVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }

        $this->checkSaveBtnPermission();
        $this->resetDisplayVarsToDefaultValues();
        $this->getListType1RangeVarsModalParameter();
    }

    private function createPermission($SelectOptionsName)
    {
        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->map(function ($selectBtnOption, $index) {
            return array_merge($selectBtnOption, ['Permission' => $this->permissionNameList[$index] ?? 'is_create']);
        })->toArray();
    }

    private function exceptionHandling($SelectOptionsName)
    {
        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->filter(function ($selectBtnOption) {
            return $selectBtnOption['Value'] != NULL;
        })->filter(function ($selectBtnOption) {
            return $this->bpa['permission'][$selectBtnOption['Permission']] == 1;
        })->values()->toArray();
    }

    private function checkSaveBtnPermission()
    {
        if (isset($this->data['FormVars']['Title']['SaveButton']) && !$this->bpa['permission']['is_update']) {
            $this->data['FormVars']['Hidden']['SaveButton'] = 'hidden';
        }
    }
}
