<?php

namespace App\Models\Parameter;

use App\Helpers\Utils;

class Manual
{
    private $data;
    private $para_name;
    protected $bpa;
    private $themeDir;
    private $isTheme;

    public function __construct($para_name, $bpa)
    {
        $this->bpa = Utils::bpaDecoding($bpa);

        $this->para_name = $para_name;

        $this->themeDir = $themeDir ?? $this->bpa['theme_dir'];
        $this->isTheme = $this->themeDir && $this->themeDir !== 'empty';
        if ($this->isTheme) {
            $this->data = Utils::getThemeParamFile($para_name, '.json', $this->themeDir);
        } else {
            $this->data = Utils::getParamFile($para_name);
        }

        $this->converterData();
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMdFile(&$vars, $type) {
        foreach ($vars[$type] as $key => $value) {
            if ($this->isTheme) {
                $data = Utils::getThemeParamFile($this->para_name.'/'.$vars[$type][$key]['Path'], '', $this->themeDir);
            } else {
                $data = Utils::getParamFile($this->para_name.'/'.$vars[$type][$key]['Path'], '');
            }
            $vars[$type][$key]['Parameter'] = $data;
        }
    }

    public function getImagePath(&$vars, $type) {
        foreach ($vars[$type] as $key => $value) {
            if ($this->isTheme) {
                $data = Utils::getThemeParamUrl($this->para_name.'/'.$this->data[$type][$key]['Path'], '', $this->themeDir);
            } else {
                $data = Utils::getParamUrl($this->para_name.'/'.$this->data[$type][$key]['Path'], '');
            }
            $vars[$type][$key]['Path'] = $data;
        }
    }

    private function converterData()
    {
        $this->getMdFile($this->data, 'Text');
        $this->getImagePath($this->data, 'Images');

        // dump($this->para_name);
        // dd($this->data);
    }
}
