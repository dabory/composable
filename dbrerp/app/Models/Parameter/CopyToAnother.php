<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;

class CopyToAnother
{
    private $data;

    public function __construct($para_name, $themeDir = null, $popupOptions = false)
    {
        if ($themeDir && $themeDir !== 'empty') {
            $this->data = Utils::getThemeParamFile($para_name, '.json', $themeDir, $popupOptions);
        } else {
            $this->data = Utils::getParamFile($para_name, '.json', $popupOptions);
        }

        $this->converterData();
    }

    public function getData()
    {
        return $this->data;
    }

    private function getCopyToAnotherPopupVarsModalParameter()
    {
        // dd($this->data['CopyToAnotherPopupVars']);
        if (! isset($this->data['CopyToAnotherPopupVars'])) return;
        // CopyToAnotherPopupVars 모달 파라메터 얻기
        foreach ($this->data['CopyToAnotherPopupVars']['ParameterName'] as $key => $parameterName) {
            if ($this->data['FormVars']['Display'][$key.'Button'] == 'd-none') {
                $this->data['CopyToAnotherPopupVars']['Parameter'][$key] = '';
                continue;
            }

            $this->data['CopyToAnotherPopupVars']['Parameter'][$key] = (new Modal($parameterName))->getData();
            $this->data['CopyToAnotherPopupVars']['BladeRoute'][$key] = 'front.outline.static.'.$this->data['CopyToAnotherPopupVars']['Component'][$key];
        }
    }

    private function converterData()
    {
        foreach (['FormVars', 'ListVars', 'FooterVars', 'CopyToAnotherPopupVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }

        $this->getCopyToAnotherPopupVarsModalParameter();
    }
}
