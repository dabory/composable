<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ParameterUtils
{
    public static function BladeRouteFor($themeDir)
    {
        $url = Str::replace('/', '.', $themeDir);
        return ltrim($url, '.');

    }

    public static function checkDisplayAndCount(&$vars, $type)
    {
        $basicData = $vars[$type][0];
        $vars[$type][] = ParameterUtils::checkCount($basicData);
        $vars[$type][] = ParameterUtils::checkDisplay($basicData);
        $vars[$type][] = ParameterUtils::checkDisplay($basicData, 1);
    }

    public static function checkDisplay($data, $type = 0)
    {
        if (empty($data)) { return $type == 0 ? 'hidden' : 'd-none'; }
        if (! is_array($data)) { return $type == 0 ? '' : 'd-flex'; }

        $hiddenList = [];
        foreach ($data as $key => $formVar) {
            $hiddenList[$key] = self::checkDisplay($formVar, $type);
        }

        return $hiddenList;
    }

    public static function checkCount($data)
    {
        $count = 0;
        if (empty($data)) { return 0; }
        if (! is_array($data)) { return 1; }

        foreach ($data as $key => $formVar) {
            $count += self::checkCount($formVar);
        }

        return $count;
    }

    // Todo: len 이용해서 수동으로 Format, Align 나누는데 파라에서 읽어서 가져오게 리팩토링 필요
    public static function separateAlignAndFormat(&$vars, $type)
    {
        if (Str::contains($type, 'ListVars')) {
            $len = 2;
        } else if ($type === 'FormVars' || $type === 'FormPostVars') {
            $len = 1;
        } else {
            return;
        }

        if (! array_key_exists($len, $vars[$type])) return;

        foreach ($vars[$type][$len] as $key => $listVar) {
            if (in_array(strtolower($listVar), ['center', 'left', 'right'])) {
                $formatList[$key] = '';
            } else if (preg_match("/decimal\s*\(\s*'(.*?)\'\s*\)\s*/", $listVar)) {
                $vars[$type][$len][$key] = 'right';
                $formatList[$key] = $listVar;
                // $formatList[$key] = self::formatChange($listVar);
            } else {
                $vars[$type][$len][$key] = 'center';
                $formatList[$key] = $listVar;
            }
        }
        $vars[$type][] = $formatList;
    }

    // Todo: 수동으로 배열 key 할당해주는 함수인데 전부 리팩토링 + 테스트코드 작성하기
    public static function mappingKeys(&$vars, $type)
    {
        if (Str::contains($type, 'ListVars')) {
            $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                if (count($vars[$type]) == 7) {
                    switch ($key) {
                        case 0:
                            return 'Title';
                        case 1:
                            return 'Size';
                        case 2:
                            return 'Align';
                        case count($vars[$type]) - 4:
                            return 'Format';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                } else if (count($vars[$type]) == 8) {
                    switch ($key) {
                        case 0:
                            return 'Title';
                        case 1:
                            return 'Size';
                        case 2:
                            return 'Align';
                        case count($vars[$type]) - 5:
                            return 'Target';
                        case count($vars[$type]) - 4:
                            return 'Format';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                }
            })->toArray();
        } elseif ($type == 'FooterVars') {
            $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                switch ($key) {
                    case 0:
                        return 'Title';
                    case count($vars[$type]) - 3:
                        return 'Count';
                    case count($vars[$type]) - 2:
                        return 'Hidden';
                    case count($vars[$type]) - 1:
                        return 'Display';
                    default:
                        return;
                }
            })->toArray();
        } else if ($type == 'ListType1RangeVars' || $type == 'CopyToAnotherPopupVars' || $type == 'BodyCopyPopupVars') {
            if (count($vars[$type]) == 6) {
                $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                    switch ($key) {
                        case 0:
                            return 'Filter';
                        case 1:
                            return 'Component';
                        case 2:
                            return 'ParameterName';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                })->toArray();
            } else if (count($vars[$type]) == 7) {
                $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                    switch ($key) {
                        case 0:
                            return 'Filter';
                        case 1:
                            return 'Component';
                        case 2:
                            return 'ParameterName';
                        case 3:
                            return 'ThemeDir';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                })->toArray();
            }
        } else if ($type == 'FormPostVars') {
            $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                switch ($key) {
                    case 0:
                        return 'Title';
                    case 1:
                        return 'Align';
                    case 2:
                        return 'MaxLength';
                    case 3:
                        return 'Required';
                    case 4:
                        return 'Ui';
                    case 5:
                        return 'Type';
                    case count($vars[$type]) - 4:
                        return 'Format';
                    case count($vars[$type]) - 3:
                        return 'Count';
                    case count($vars[$type]) - 2:
                        return 'Hidden';
                    case count($vars[$type]) - 1:
                        return 'Display';
                    default:
                        return;
                }
            })->toArray();
        } else {
            $vars[$type] = collect($vars[$type])->keyBy(function ($value, $key) use ($vars, $type) {
                if (count($vars[$type]) == 6) {
                    switch ($key) {
                        case 0:
                            return 'Title';
                        case 1:
                            return 'Align';
                        case count($vars[$type]) - 4:
                            return 'Format';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                } else if (count($vars[$type]) == 8) {
                    switch ($key) {
                        case 0:
                            return 'Title';
                        case 1:
                            return 'Align';
                        case 2:
                            return 'MaxLength';
                        case 3:
                            return 'Required';
                        case count($vars[$type]) - 4:
                            return 'Format';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                } else {
                    switch ($key) {
                        case 0:
                            return 'Title';
                        case count($vars[$type]) - 3:
                            return 'Count';
                        case count($vars[$type]) - 2:
                            return 'Hidden';
                        case count($vars[$type]) - 1:
                            return 'Display';
                        default:
                            return;
                    }
                }
            })->toArray();
        }
    }
}
