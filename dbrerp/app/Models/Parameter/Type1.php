<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use Illuminate\Support\Str;

class Type1
{
    protected $data;
    protected $ecodingBpa;
    protected $bpa;

    public function __construct($bpa, $customParaName = null, $themeDir = null, $popupOptions = false, $mode = 'erp')
    {
        $this->ecodingBpa = $bpa;

        if (empty($bpa)) {
            $this->initBpa();
        } else {
            $this->bpa = Utils::bpaDecoding($bpa);
        }

        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }

//        dd($this->bpa['para_name']);
        $splitParaName = explode('::', $this->bpa['para_name']);
        if (count($splitParaName) > 1) {
            $this->bpa['para_name'] = $splitParaName[1];
            $this->bpa['theme_dir'] = $splitParaName[0] . '/erp';
        }
        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = Utils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir);
        } else {
            $this->data = Utils::getParamFile($this->bpa['para_name'], '.json', false, $mode);
        }

        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa, 'CustomVar' => $this->bpa['custom_var'] ?? '']);

        $this->converterData($mode);
//        if ($this->data['HeadSelectOptions']) {
//            dd( $this->data);
//        }
    }

    public function initBpa()
    {
        $this->bpa['theme_dir'] = 'empty';
        $this->bpa['para_name'] = '/empty';
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

        return ['type1' => $this->data];
    }

    public function getCopyPara($SelectOptionsName, $value)
    {
        return collect($this->data[$SelectOptionsName])->where('Value', $value)->pluck('Parameter');
    }

    protected function resetDisplayVarsToDefaultValues()
    {
        // 사이즈 디폴트 생성
        if (! isset($this->data['DisplayVars'])) {
            $this->data['DisplayVars']['InitLines'] = 10;
            $this->data['DisplayVars']['HeadHeight'] = '250';
            $this->data['DisplayVars']['BodyHeight'] = '400';

            foreach (['IsSimpleSelectPage', 'IsListFirst', 'IsAddTotalLine', 'IsExcelColumn', 'IsDownloadList', 'IsShowOnlyClosed', 'IsCache', 'IsKibana', 'IsHideBody'] as $displayVar) {
                $this->data['DisplayVars'][$displayVar] = false;
            }
        } else {
            if (empty($this->data['DisplayVars']['InitLines']))
                $this->data['DisplayVars']['InitLines'] = 10;
            if (empty($this->data['DisplayVars']['HeadHeight']))
                $this->data['DisplayVars']['HeadHeight'] = 'd-none';
            if (empty($this->data['DisplayVars']['BodyHeight']))
                $this->data['DisplayVars']['BodyHeight'] = 'd-none';

            foreach (['IsSimpleSelectPage', 'IsListFirst', 'IsAddTotalLine', 'IsExcelColumn', 'IsDownloadList', 'IsShowOnlyClosed', 'IsCache', 'IsKibana', 'IsHideBody'] as $displayVar) {
                if (empty($this->data['DisplayVars'][$displayVar]))
                    $this->data['DisplayVars'][$displayVar] = false;
            }
        }
    }

    protected function resetFormVarsToDefaultValues()
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

        if (! isset($this->data['DisplayVars']['IsSimpleSelectOptionPara'])) {
            $this->data['DisplayVars']['IsSimpleSelectOptionPara'] = false;
        }
    }

    protected function getListType1RangeVarsModalParameter()
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

    protected function applyFormVarsSettings()
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

    protected function converterData($mode)
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

        $this->resetDisplayVarsToDefaultValues();
        $this->getListType1RangeVarsModalParameter();

        $this->data['HeadSelectPopupOptions'] = collect($this->data['HeadSelectOptions'])->filter(function ($popupOption) {
            return isset($popupOption['Component']);
        })->values()->toArray();

        if (empty($this->data['SelectPopupOptions'])) {
            $this->data['SelectPopupOptions'] = [];
        }

        $this->data['SelectPopupOptions'] = $this->getThemeOrDefault($this->data['SelectPopupOptions']);
//        $this->data['SelectLinkedPopupOptions'] = collect($this->data['SelectPopupOptions'])->filter(function ($popupOption) {
//            return ! empty($popupOption['TabbedMenuHash']);
//        })->values()->toArray();
//        dd($this->data['SelectLinkedPopupOptions']);
        $this->data['HeadSelectPopupOptions'] = $this->getThemeOrDefault($this->data['HeadSelectPopupOptions']);

        $this->popupOptionsConverterData('SelectPopupOptions', $mode);
        $this->getPopupOptionsParameter('SelectPopupOptions', $mode);
        $this->popupOptionsConverterData('MultiPopupOptions', $mode);
        $this->getPopupOptionsParameter('MultiPopupOptions', $mode);
        $this->popupOptionsConverterData('ChartPopupOptions', $mode);
        $this->getPopupOptionsParameter('ChartPopupOptions', $mode);

        $this->popupOptionsConverterData('HeadSelectPopupOptions', $mode);
        $this->getPopupOptionsParameter('HeadSelectPopupOptions', $mode);

        $this->renamingWithParameterName('HeadSelectOptions');

        $this->applyFormVarsSettings();
        $this->simpleSelectOptionPara($mode);
    }

    protected function simpleSelectOptionPara($mode)
    {
        if ($this->data['DisplayVars']['IsSimpleSelectOptionPara']) {
            $paraName = '/func/select-option' . $this->bpa['para_name'];
            $this->data['DisplayVars']['SimpleSelectOptionPara'] = Utils::getParamFile($paraName, '.json', false, $mode);
        }
    }

    protected function getPopupOptionsParameter($popupOptions, $mode)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) use($popupOptions, $mode) {
            $parameterName = $popupOption['ParameterName'];
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

    protected function getThemeOrDefault($popupOptions)
    {
        return collect($popupOptions)->map(function ($option) {
            $splitComponent = explode('::', $option['Component']);
            if (count($splitComponent) > 1) {
                if ($splitComponent[0] === 'erp') {
                    $option['Component'] = $splitComponent[1];
                    $option['ComponentDir'] = 'erp';
                } else {
                    $option['Component'] = 'theme.' . $splitComponent[1];
                    $option['ThemeDir'] = $splitComponent[0] . '/erp';
                }
            }
            $splitParameter = explode('::', $option['Parameter']);
            if (count($splitParameter) > 1) {
                $option['Parameter'] = $splitParameter[1];
            }
            return $option;
        })->toArray();
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

    protected function createBladeRouter($popupOptions, $mode)
    {
//        front.dabory.erp.
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

    protected function renamingWithParameterName($popupOptions)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            $parameterName = $popupOption['Parameter'] ?? '';
            $unique = Str::replace('/', '-', $parameterName);
            return array_merge($popupOption, ['ParameterName' => $parameterName, 'Unique' => $unique]);
        })->toArray();
    }

    protected function emptyExceptionHandling($popupOptions)
    {
        // SelectPopupOptions 빈거 예외처리
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->filter(function ($popupOption) {
            return (! empty($popupOption['Caption']) &&  ! empty($popupOption['Component'])) || ! empty($popupOption['TabbedMenuHash']);
        })->toArray();
    }

    protected function createPermission($SelectOptionsName)
    {
        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->map(function ($selectBtnOption, $index) {
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

    protected function exceptionHandling($SelectOptionsName)
    {
        if ($this->bpa['permission']['is_list'] === '0') {
            $this->data['FormVars'][0]['ListButton'] = '';
            $this->data['DisplayVars']['IsListFirst'] = false;
        }

        if ($this->bpa['permission']['is_read'] === '0') {
            $this->data['SelectPopupOptions'] = [];
            $this->data['MultiPopupOptions'] = [];
        }

        $this->data[$SelectOptionsName] = collect($this->data[$SelectOptionsName])->filter(function ($selectBtnOption) {
            return $selectBtnOption['Value'] != NULL;
        })->filter(function ($selectBtnOption) {
            if ($selectBtnOption['Permission'] === 'dummy') {
                return true;
            }
            return $this->bpa['permission'][$selectBtnOption['Permission']] === '1';
        })->values()->toArray();
    }
}
