<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Exceptions\ParameterException;
use App\Helpers\ProUtils;
use App\Helpers\ParameterUtils;

class DataConverter
{
    public static $codeTitle = [];
    public static $para = [];

    public static function createFromTimestamp($timestamp, $format = 'Y-m-d H:i')
    {
        return Carbon::createFromTimestamp($timestamp)->timezone('Asia/Seoul')->format($format);
    }

    public static function tranxnValue($val)
    {
        if (empty($val) || isHex($val)) { return 0; }
        return $val / 10000000000 / 1000000;
    }

    public static function tokenValueRev($balance, $unitPoint)
    {
        $value = $balance * (10 ** $unitPoint);
        return sprintf("%.0f", $value);
    }

    public static function tokenValue($balance, $unitPoint, $decimalPoint, $number_format = true)
    {
        if ($unitPoint === '' || $decimalPoint === '') {
            return 'API Error';
        }
        if (! is_numeric($balance)) { return 0; }

        if ($decimalPoint === -1) {
            $result = bcdiv($balance, pow(10, $unitPoint), 50);
            $result = rtrim($result, '0');
            $index = strlen($result) - strpos($result, '.') - 1;
            if ($index === 0) {
                $result = rtrim($result, '.');
            }

            $value = number_format($result, $index);
            if (! $number_format) {
                $value = convNum($value);
            }

            return $value;
        }
        else {
            $format = '%.f';
            $result = sprintf($format, $balance / pow(10, $unitPoint));
            $result = rtrim($result, '0');

           if ($unitPoint < 0) {
               return number_format($result * 0.001,  $decimalPoint);
           }
            return number_format($result,  $decimalPoint);
        }
    }

    public static function readParameter($path)
    {
        $parameter = ProUtils::getParamFile($path);
        $parameter['IncludeList'] = [];
        foreach (['FormVars', 'ListVars', 'FooterVars', 'ListType1RangeVars'] as $varsName) {
            if (array_key_exists($varsName, $parameter)) {
                ParameterUtils::separateAlignAndFormat($parameter, $varsName);
                ParameterUtils::checkDisplayAndCount($parameter, $varsName);
                ParameterUtils::mappingKeys($parameter, $varsName);
                if (array_key_exists('Target', $parameter[$varsName])) {
                    foreach ($parameter[$varsName]['Target'] as $key => $target) {
                        if ($target) {
                            $parameter['IncludeList'][] = self::execute('', $target);
                        }
                    }
//                    dd($parameter[$varsName]['Target']);
                }
            }
        }

        return $parameter;
    }

    public static function execute($data, $format)
    {
        switch ($format) {
            case 'YY-MM-DD': case 'YY.MM.DD': case 'YYMMDD':
            case 'yy-mm-dd': case 'yy.mm.dd': case 'yymmdd':
                $result = self::createFromTimestamp($data, $format);
                break;
            case 'diffForHumans':
                $result = Carbon::parse((int)$data)->diffForHumans();
                break;
            case 'check':
                if ($data == 1 || $data == true) {
                    $result = '✓';
                } else {
                    $result = '';
                }
                break;
            default:
                if (preg_match("/[A-Za-z]+\s*\(\s*'(.*?)\'\s*\)\s*/", $format)) {
                    if (! isset($data)) {
                        $funcName = $format;
                    } else {
                        $funcName = str_replace(')', ", '${data}')", $format);
                    }
                    eval('$result = ' . "self::format_func_{$funcName};");
                } else {
                    $result = $data;
                }
                break;
        }

        return $result;
    }

    public static function format_func_target_modal($paraPath, $component)
    {
        return [
            'Parameter' => self::readParameter($paraPath),
            'Component' => $component,
        ];
    }

    public static function format_func_decimal($value, $data)
    {
        return number_format($value, $data);
    }


    public static function format_func_status($value, $data)
    {
        return self::$codeTitle['status'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_sort($value, $data)
    {
        return self::$codeTitle['sort'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_deal_type($value, $data)
    {
        return self::$codeTitle['deal-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_paymethod($value, $data)
    {
        return self::$codeTitle['paymethod'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_situation($value, $data)
    {
        return self::$codeTitle['situation'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_bill_type($value, $data)
    {
        return self::$codeTitle['bill-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_device_type($value, $data)
    {
        return self::$codeTitle['device-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_lang_type($value, $data)
    {
        return self::$codeTitle['lang-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_sort_type($value, $data)
    {
        return self::$codeTitle['sort-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_setup_code($value, $data)
    {
        return self::$codeTitle['setup-code'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_ship_type($value, $data)
    {
        return self::$codeTitle['ship-type'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function format_func_body_situation($value, $data)
    {
        return self::$codeTitle['body-situation'][$value][$data]['Title'] ?? 'Invalid';
    }

    public static function get_status($value)
    {
        if (isset(self::$codeTitle['status'][$value])) {
            return;
        }

        try {
            self::$codeTitle['status'][$value] = collect(Utils::getParamFile("/etc/code-title/status/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['status'][$value] = null;
        }
    }

    public static function get_shop_status($value)
    {
        if (isset(self::$codeTitle['shop-status'][$value])) {
            return;
        }

        try {
            self::$codeTitle['shop-status'][$value] = collect(Utils::getParamFile("/etc/code-title/shop-status/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['shop-status'][$value] = null;
        }
    }

    public static function get_sort($value)
    {
        if (isset(self::$codeTitle['sort'][$value])) {
            return;
        }

        try {
            self::$codeTitle['sort'][$value] = collect(Utils::getParamFile("/etc/code-title/sort/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['sort'][$value] = null;
        }
    }

    public static function get_deal_type($value)
    {
        if (isset(self::$codeTitle['deal-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['deal-type'][$value] = collect(Utils::getParamFile("/etc/code-title/deal-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['deal-type'][$value] = null;
        }
    }

    public static function get_paymethod($value)
    {
        if (isset(self::$codeTitle['paymethod'][$value])) {
            return;
        }

        try {
            self::$codeTitle['paymethod'][$value] = collect(Utils::getParamFile("/etc/code-title/paymethod/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['paymethod'][$value] = null;
        }
    }

    public static function get_situation($value)
    {
        if (isset(self::$codeTitle['situation'][$value])) {
            return;
        }

        try {
            self::$codeTitle['situation'][$value] = collect(Utils::getParamFile("/etc/code-title/situation/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['situation'][$value] = null;
        }
    }

    public static function get_bill_type($value)
    {
        if (isset(self::$codeTitle['bill-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['bill-type'][$value] = collect(Utils::getParamFile("/etc/code-title/bill-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['bill-type'][$value] = null;
        }
    }

    public static function get_device_type($value)
    {
        if (isset(self::$codeTitle['device-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['device-type'][$value] = collect(Utils::getParamFile("/etc/code-title/device-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['device-type'][$value] = null;
        }
    }

    public static function get_lang_type($value)
    {
        if (isset(self::$codeTitle['lang-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['lang-type'][$value] = collect(Utils::getParamFile("/etc/code-title/lang-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['lang-type'][$value] = null;
        }
    }

    public static function get_sort_type($value)
    {
        if (isset(self::$codeTitle['sort-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['sort-type'][$value] = collect(Utils::getParamFile("/etc/code-title/sort-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['sort-type'][$value] = null;
        }
    }

    public static function get_setup_code($value)
    {
        if (isset(self::$codeTitle['setup-code'][$value])) {
            return;
        }

        try {
            self::$codeTitle['setup-code'][$value] = collect(Utils::getParamFile("/etc/code-title/setup-code/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['setup-code'][$value] = null;
        }
    }

    public static function get_expose_type($value)
    {
        if (isset(self::$codeTitle['expose-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['expose-type'][$value] = collect(Utils::getParamFile("/etc/code-title/expose-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['expose-type'][$value] = null;
        }
    }

    public static function get_ship_type($value)
    {
        if (isset(self::$codeTitle['ship-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['ship-type'][$value] = collect(Utils::getParamFile("/etc/code-title/ship-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['ship-type'][$value] = null;
        }
    }

    public static function get_delay_type($value)
    {
        if (isset(self::$codeTitle['delay-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['delay-type'][$value] = collect(Utils::getParamFile("/etc/code-title/delay-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['delay-type'][$value] = null;
        }
    }

    public static function get_cargo_type($value)
    {
        if (isset(self::$codeTitle['cargo-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['cargo-type'][$value] = collect(Utils::getParamFile("/etc/code-title/cargo-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['cargo-type'][$value] = null;
        }
    }

    public static function get_condition_type($value)
    {
        if (isset(self::$codeTitle['condition-type'][$value])) {
            return;
        }

        try {
            self::$codeTitle['condition-type'][$value] = collect(Utils::getParamFile("/etc/code-title/condition-type/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['condition-type'][$value] = null;
        }
    }

    public static function get_body_situation($value)
    {
        if (isset(self::$codeTitle['body-situation'][$value])) {
            return;
        }

        try {
            self::$codeTitle['body-situation'][$value] = collect(Utils::getParamFile("/etc/code-title/body-situation/{$value}"))->keyBy('Code')->toArray();
        } catch (ParameterException $e) {
            self::$codeTitle['body-situation'][$value] = null;
        }
    }
}
