<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class ListMedia1
{
    private $data;
    private $ecodingBpa;
    private $bpa;
    private $permissionNameList = ['is_create', 'is_update', 'is_create', 'is_read', 'is_delete', 'is_create', 'is_create'];

    public function __construct($bpa, $customParaName = null, $mode = 'erp')
    {
        $this->ecodingBpa = $bpa;
        $this->bpa = Utils::bpaDecoding($bpa);
        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }
        // dd($this->bpa);
        $this->data = Utils::getParamFile($this->bpa['para_name'], '.json', false, $mode);
        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return ['listMedia1' => $this->data];
    }

    public function getCopyPara($SelectOptionsName, $value)
    {
        return collect($this->data[$SelectOptionsName])->where('Value', $value)->pluck('Parameter');
    }

    private function resetDisplayVarsToDefaultValues()
    {
        // 사이즈 디폴트 생성
        if (! isset($this->data['DisplayVars'])) {
            $this->data['DisplayVars']['InitLines'] = 10;
            $this->data['DisplayVars']['HeadHeight'] = '250';
            $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsListFirst', 'IsAddTotalLine', 'IsExcelColumn', 'IsDownloadList', 'IsShowOnlyClosed'] as $displayVar) {
                $this->data['DisplayVars'][$displayVar] = false;
            }
        } else {
            if (empty($this->data['DisplayVars']['InitLines']))
                $this->data['DisplayVars']['InitLines'] = 10;
            if (empty($this->data['DisplayVars']['HeadHeight']))
                $this->data['DisplayVars']['HeadHeight'] = '250';
            if (empty($this->data['DisplayVars']['BodyHeight']))
                $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsListFirst', 'IsAddTotalLine', 'IsExcelColumn', 'IsDownloadList', 'IsShowOnlyClosed'] as $displayVar) {
                if (empty($this->data['DisplayVars'][$displayVar]))
                    $this->data['DisplayVars'][$displayVar] = false;
            }
        }
    }

    private function resetFormVarsToDefaultValues()
    {
        if (! isset($this->data['DisplayVars']['IsSelectPopupHidden']) || ! $this->data['DisplayVars']['IsSelectPopupHidden']) {
            $this->data['DisplayVars']['IsSelectPopupHidden'] = false;
        }

        if (! isset($this->data['FormVars'][0]['FilterOption'])) {
            $this->data['FormVars'][0]['FilterOption'] = '';
            $this->data['FilterSelectOptions'] = [];
        }

        if (! isset($this->data['FormVars'][0]['SimpleOption'])) {
            $this->data['FormVars'][0]['SimpleSelectOptions'] = '';
            $this->data['SimpleSelectOptions'] = [];
        }

        if (! isset($this->data['DisplayVars']['IsC1Popup'])) {
            $this->data['DisplayVars']['IsC1Popup'] = '0';
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

    private function applyFormVarsSettings()
    {
        if ($this->data['DisplayVars']['IsSelectPopupHidden']) {
            $this->data['FormVars']['Hidden']['SelectPopup'] = 'hidden';
            $this->data['FormVars']['Display']['SelectPopup'] = 'd-none';
        }

        switch ($this->data['DisplayVars']['IsC1Popup']) {
            case '0':
                break;
            case '1':
                $this->data['ListVars']['Hidden']['$Radio'] = 'hidden';
                $this->data['ListVars']['Display']['$Radio'] = 'd-none';
                $this->data['ListVars']['Count']--;
                break;
            default:
                # code...
                break;
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

        $this->resetFormVarsToDefaultValues();

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

        $this->popupOptionsConverterData('SelectPopupOptions');

        $this->applyFormVarsSettings();

        // 파라메터 읽어옴.
        for ($i = 0; $i < count($this->data['SelectPopupOptions']); $i++) {
            $parameterName = $this->data['SelectPopupOptions'][$i]['ParameterName'];
            if (strpos($parameterName, 'form-a') !== false) {
                array_merge($this->data['SelectPopupOptions'][$i] = array_merge($this->data['SelectPopupOptions'][$i], (new FormA($this->ecodingBpa, $parameterName))->getData('Parameter')));
                $this->data['SelectPopupOptions'][$i]['ParameterType'] = 'formA';
            } else if (strpos($parameterName, 'form-b') !== false) {
                array_merge($this->data['SelectPopupOptions'][$i] = array_merge($this->data['SelectPopupOptions'][$i], (new FormB($this->ecodingBpa, $parameterName))->getData('Parameter')));
                $this->data['SelectPopupOptions'][$i]['ParameterType'] = 'formB';
            } else if (strpos($parameterName, 'list1') !== false) {
                array_merge($this->data['SelectPopupOptions'][$i] = array_merge($this->data['SelectPopupOptions'][$i], (new type1($this->ecodingBpa, $parameterName))->getData('Parameter')));
                $this->data['SelectPopupOptions'][$i]['ParameterType'] = 'list1';
            } else {
                (new Modal('/'))->getData();
            }
        }
    }

    private function popupOptionsConverterData($popupOptions)
    {
        if (! isset($this->data[$popupOptions])) {
            $this->data[$popupOptions] = [];
        };
        // SelectPopupOptions 빈거 예외처리
        $this->emptyExceptionHandling($popupOptions);
        // 파라메터이름으로 네이밍 변경
        $this->renamingWithParameterName($popupOptions);
        // 블레이드라우터 생성
        $this->createBladeRouter($popupOptions, 'front.dabory.erp.');
        // 모달에서 사용 클래스이름 생성
        $this->createClassNameToUseInModal($popupOptions);
    }

    private function createClassNameToUseInModal($popupOptions)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            return array_merge($popupOption, ['ModalClassName' => Utils::kebabCase($popupOption['Component'])]);
        })->toArray();
    }

    private function createBladeRouter($popupOptions, $url = '')
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) use ($url) {
            return array_merge($popupOption, ['BladeRoute' => $url.$popupOption['Component']]);
        })->toArray();
    }

    private function renamingWithParameterName($popupOptions)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            $parameterName = $popupOption['Parameter'];
            return array_merge($popupOption, ['ParameterName' => $parameterName]);
        })->toArray();
    }

    private function emptyExceptionHandling($popupOptions)
    {
        // SelectPopupOptions 빈거 예외처리
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->filter(function ($popupOption) {
            return ! empty($popupOption['Caption']) &&  ! empty($popupOption['Component']);
        })->toArray();
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
