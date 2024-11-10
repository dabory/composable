<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;
use App\Helpers\ParameterUtils;
use App\Exceptions\ParameterException;

class Modal
{
    protected $data;

    public function __construct($para_name, $themeDir = null, $mode = 'erp', $customVar = '')
    {
        try {
            if ($themeDir && $themeDir !== 'empty') {
                $this->data = Utils::getThemeParamFile($para_name, '.json', $themeDir);
            } else {
                $this->data = Utils::getParamFile($para_name, '.json', false, $mode);
            }
        } catch (ParameterException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }

        $this->data['General'] = array_merge($this->data['General'] ?? [], ['CustomVar' => $customVar]);
        $this->converterData();
    }

    public function getData($customName = null)
    {
        if (isset($customName)) {
            return [$customName => $this->data];
        }

        return $this->data;
    }

    protected function converterData()
    {
        foreach (['FormVars', 'ListVars', 'FooterVars'] as $varsName) {
            if (array_key_exists($varsName, $this->data)) {
                ParameterUtils::separateAlignAndFormat($this->data, $varsName);
                ParameterUtils::checkDisplayAndCount($this->data, $varsName);
                ParameterUtils::mappingKeys($this->data, $varsName);
            }
        }
    }
}
