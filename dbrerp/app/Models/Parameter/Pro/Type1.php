<?php

namespace App\Models\Parameter\Pro;

use App\Helpers\Utils;
use App\Helpers\ProUtils;
use App\Helpers\ParameterUtils;
use App\Models\Parameter\FormB;
use App\Models\Parameter\FormF;
use App\Models\Parameter\Modal;

class Type1 extends \App\Models\Parameter\Type1
{
    public function __construct($bpa, $customParaName = null,  $themeDir = null, $popupOptions = false)
    {
        $this->ecodingBpa = $bpa;
        $this->bpa = ProUtils::bpaDecoding($bpa);
        if (isset($customParaName)) {
            $this->bpa['para_name'] = $customParaName;
        }

        $themeDir = $themeDir ?? $this->bpa['theme_dir'];
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = ProUtils::getThemeParamFile($this->bpa['para_name'], '.json', $themeDir);
        } else {
            $this->data = ProUtils::getParamFile($this->bpa['para_name']);
        }

        $this->data['General'] = array_merge($this->data['General'], ['returnUrl' => $this->bpa['page_uri'].'?bpa='.$bpa]);

        $this->converterData();

    }

    protected  function getpopupOptionsParameter($popupOptions)
    {
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) use($popupOptions) {
            $parameterName = $popupOption['ParameterName'];
            $themeDir = $popupOption['ThemeDir'] ?? 'empty';
            $popupOption['OptionsType'] = $popupOptions;

            if (\Str::contains($parameterName, 'form-a')) {
                $popupOption['ParameterType'] = 'formA';
                return array_merge($popupOption, (new FormA($this->ecodingBpa, $parameterName, $themeDir, $popupOption))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-insert')) {
                $popupOption['ParameterType'] = 'formInsert';
                return array_merge($popupOption, (new FormA($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-b')) {
                $popupOption['ParameterType'] = 'formB';
                return array_merge($popupOption, (new FormB($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'list1')) {
                $popupOption['ParameterType'] = 'list1';
                return array_merge($popupOption, (new type1($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-process')) {
                $popupOption['ParameterType'] = 'formProcess';
                return array_merge($popupOption, (new FormProcess($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'chart')) {
                $popupOption['ParameterType'] = 'moealSetFile';
                $popupOption['Parameter'] = (new Modal($parameterName))->getData();
                return $popupOption;
            } else if (\Str::contains($parameterName, 'search-type1')) {
                $popupOption['ParameterType'] = 'searchType1';
                return array_merge($popupOption, (new type1($this->ecodingBpa, $parameterName, $themeDir, $popupOption))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-select')) {
                $popupOption['ParameterType'] = 'formSelect';
                return array_merge($popupOption, (new FormSelect($this->ecodingBpa, $parameterName))->getData('Parameter'));
            } else if (\Str::contains($parameterName, 'form-post')) {
                $popupOption['ParameterType'] = 'formPost';
                return array_merge($popupOption, (new FormPost($this->ecodingBpa, $parameterName, $themeDir, $popupOption))->getData('Parameter'));
            } else {
                (new Modal('/'))->getData();
            }
        })->toArray();
    }

    protected function createBladeRouter($popupOptions)
    {
//        front.dabory.erp.
        $this->data[$popupOptions] = collect($this->data[$popupOptions])->map(function ($popupOption) {
            $componentArr = explode('.', $popupOption['Component']);
            if (array_shift($componentArr) === 'theme') {
                $popupOption['Component'] = implode('.', $componentArr);
                $url = ParameterUtils::BladeRouteFor($popupOption['ThemeDir']) . '.resources.views.';
            } else {
                $url = 'front.dabory.pro.my-app.';
            }
//            dd($url.$popupOption['Component']);
            return array_merge($popupOption, ['BladeRoute' => $url.$popupOption['Component']]);
        })->toArray();
    }
}
