<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;

class BodyCopy
{
    protected $data;

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

    protected function getBodyCopyPopupVarsModalParameter()
    {
        if (! isset($this->data['BodyCopyPopupVars'])) return;
        // BodyCopyPopupVars 모달 파라메터 얻기
        foreach ($this->data['BodyCopyPopupVars']['ParameterName'] as $key => $parameterName) {
            if ($this->data['FormVars']['Display'][$key.'Button'] == 'd-none') {
                $this->data['BodyCopyPopupVars']['Parameter'][$key] = '';
                continue;
            }

            $componentArr = explode('.', $this->data['BodyCopyPopupVars']['Component'][$key]);
            $themeDir = $this->data['BodyCopyPopupVars']['ThemeDir'][$key] ?? null;

            if (array_shift($componentArr) === 'theme') {
                $this->data['BodyCopyPopupVars']['Component'][$key] = implode('.', $componentArr);
                $url = ParameterUtils::BladeRouteFor($themeDir) . '.resources.views.modal.';
            } else {
                $url = 'front.outline.static.';
            }
            $this->data['BodyCopyPopupVars']['BladeRoute'][$key] = $url . $this->data['BodyCopyPopupVars']['Component'][$key];
            $this->data['BodyCopyPopupVars']['Parameter'][$key] = (new Modal($parameterName, $themeDir))->getData();
//            dump($this->data['BodyCopyPopupVars']);
        }
    }

    protected function converterData()
    {
        foreach (['FormVars', 'ListVars', 'FooterVars', 'BodyCopyPopupVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }

        $this->getBodyCopyPopupVarsModalParameter();
    }
}
