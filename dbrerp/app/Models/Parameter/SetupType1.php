<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use Illuminate\Support\Str;

class SetupType1
{
    private $data;
    private $ecodingBpa;
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
        $mode = 'erp';
        $this->converterData($mode);
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return ['setupType1' => $this->data];
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

            foreach (['IsListFirst'] as $displayVar) {
                $this->data['DisplayVars'][$displayVar] = false;
            }
        } else {
            if (empty($this->data['DisplayVars']['InitLines']))
                $this->data['DisplayVars']['InitLines'] = 10;
            if (empty($this->data['DisplayVars']['HeadHeight']))
                $this->data['DisplayVars']['HeadHeight'] = '250';
            if (empty($this->data['DisplayVars']['BodyHeight']))
                $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsListFirst'] as $displayVar) {
                if (empty($this->data['DisplayVars'][$displayVar]))
                    $this->data['DisplayVars'][$displayVar] = false;
            }
        }
    }

    private function resetFormVarsToDefaultValues()
    {
        if (! isset($this->data['DisplayVars']['IsC1Popup'])) {
            $this->data['DisplayVars']['IsC1Popup'] = '0';
        }
    }

    private function applyFormVarsSettings()
    {

        if (isset($this->data['DisplayVars']['IsSelectPopupHidden']) && $this->data['DisplayVars']['IsSelectPopupHidden']) {
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


    private function converterData($mode)
    {
        foreach (['HeadSelectOptions', 'BodySelectOptions'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                $this->createPermission($varsName);
                $this->exceptionHandling($varsName);
            }
        }

        $this->resetFormVarsToDefaultValues();

        foreach (['FormVars', 'ListVars', 'FooterVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }

        $this->checkSaveBtnPermission();
        $this->resetDisplayVarsToDefaultValues();


        $this->popupOptionsConverterData('SelectPopupOptions', $mode);
        $this->getPopupOptionsParameter('SelectPopupOptions', $mode);
        $this->applyFormVarsSettings();
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

    protected function popupOptionsConverterData($popupOptions, $mode)
    {
        if (! isset($this->data[$popupOptions])) {
            $this->data[$popupOptions] = [];
        }

        // SelectPopupOptions 빈거 예외처리
        $this->emptyExceptionHandling($popupOptions);
        // 파라메터이름으로 네이밍 변경
        $this->renamingWithParameterName($popupOptions);
        // 블레이드라우터 생성
        $this->createBladeRouter($popupOptions, $mode);
        // 모달에서 사용 클래스이름 생성
        $this->createClassNameToUseInModal($popupOptions);

    }

    protected function emptyExceptionHandling($popupOptions)
    {
        // SelectPopupOptions 빈거 예외처리
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->filter(function ($popupOption) {
            return (! empty($popupOption['Caption']) &&  ! empty($popupOption['Component'])) || ! empty($popupOption['TabbedMenuHash']);
        })->toArray();
    }

    protected function renamingWithParameterName($popupOptions)
    {
        // dd($this->data['SelectPopupOptions']);
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            $parameterName = $popupOption['Parameter'] ?? '';
            // dd($parameterName);
            $unique = Str::replace('/', '-', $parameterName);
            // dd($unique);
            return array_merge($popupOption, ['ParameterName' => $parameterName, 'Unique' => $unique]);
        })->toArray();
    }

    protected function createBladeRouter($popupOptions, $mode)
    {

        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) use ($mode) {
            $componentArr = explode('.', $popupOption['Component']);
            if (array_shift($componentArr) === 'theme') {
                $popupOption['Component'] = implode('.', $componentArr);
                $url = ParameterUtils::BladeRouteFor($popupOption['ThemeDir']) . '.resources.views.';
            } else if (isset($popupOption['ComponentDir']) && $popupOption['ComponentDir'] === 'erp') {
                $url = "front.dabory.erp.";
            } else {
                $url = "front.dabory.$mode.";
            }

            return array_merge($popupOption, ['BladeRoute' => $url.$popupOption['Component']]);
        })->toArray();
    }

    protected function createClassNameToUseInModal($popupOptions)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            if (isset($popupOption['ParameterClassName']) && $popupOption['ParameterClassName']) {
                $className = \Str::replace('/', '-', \Str::replaceFirst('/', '', $popupOption['Parameter']));
            } else {
                $className = Utils::kebabCase($popupOption['Component']);
            }
            return array_merge($popupOption, ['ModalClassName' => $className]);
        })->toArray();
    }

    protected function getPopupOptionsParameter($popupOptions, $mode)
    {
        // dd($this->data[$popupOptions]);
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) use($popupOptions, $mode) {
            $parameterName = $popupOption['ParameterName'];
            // dd($parameterName);
            if (empty($parameterName)) {
                $popupOption['ParameterType'] = 'dummy';
                return $popupOption;
            }
            $themeDir = $popupOption['ThemeDir'] ?? 'empty';
            $popupOption['OptionsType'] = $popupOptions;
            if (\Str::contains($parameterName, 'form-a')) {
                $popupOption['ParameterType'] = 'formA';
                return array_merge($popupOption, (new FormA(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-insert')) {
                $popupOption['ParameterType'] = 'formInsert';
                return array_merge($popupOption, (new FormA(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'upload-batch')) {
                $popupOption['ParameterType'] = 'uploadBatch';
                return array_merge($popupOption, (new FormA(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-b')) {
                $popupOption['ParameterType'] = 'formB';
                return array_merge($popupOption, (new FormB(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'download') || \Str::contains($parameterName, 'list1') || \Str::contains($parameterName, 'kibana-type1')) {
                $popupOption['ParameterType'] = 'list1';
                return array_merge($popupOption, (new type1(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-process')) {
                $popupOption['ParameterType'] = 'formProcess';
                return array_merge($popupOption, (new FormProcess($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'chart')) {
                $popupOption['ParameterType'] = 'moealSetFile';
                $popupOption['Parameter'] = (new Modal($parameterName))->getData();
                return $popupOption;
            } else if (\Str::contains($parameterName, 'search-type1')) {
                $popupOption['ParameterType'] = 'searchType1';
                return array_merge($popupOption, (new type1($this->ecodingBpa, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-select')) {
                $popupOption['ParameterType'] = 'formSelect';
                return array_merge($popupOption, (new FormSelect($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-post')) {
                $popupOption['ParameterType'] = 'formPost';
                return array_merge($popupOption, (new FormPost(null, $parameterName, $themeDir, $popupOption, $mode))->getData('Parameter'));
            } else {
                $popupOption['ParameterType'] = 'default';
                return array_merge($popupOption, (new Modal($parameterName, null, 'erp', $this->bpa['custom_var']))->getData('Parameter'));
            }
        })->toArray();
    }
}
