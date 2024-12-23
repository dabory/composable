<?php

namespace App\Models\Cache;

use App\Services\CallApiService;
use Illuminate\Support\Facades\Storage;

class ProApiCache
{
    public function getCachedResponse($url, $filePath)
    {
        $responseFilePath = $this->getFullFilePath($filePath, 'response');
//        echo "getCachedResponse() : ".$responseFilePath;
        // 1. $filePath reponse를 먼저 읽어온다.
        if (Storage::disk('dabory')->exists($responseFilePath)) {
            return json_decode(Storage::disk('dabory')->get($responseFilePath), true);
        }

        // 2. 없으면 request를 json을 읽어오고
        $requestFilePath = $this->getFullFilePath($filePath, 'request');
        if (! Storage::disk('dabory')->exists($requestFilePath)) {
            return false;
        }
        $request = json_decode(Storage::disk('dabory')->get($requestFilePath), true);

        // 3. api 호출
        $response = app(CallApiService::class)->callApi([
            'url' => $url,
            'data' => $request
        ]);

        // 4. reponse에 json 저장
        Storage::disk('dabory')->put($responseFilePath, json_encode($response));
        return $response;
    }

    private function getFullFilePath($filePath, $type): string
    {
        // TODO: 나중에 세션에서 읽어와서 언어별로 가능하게 수정
        $theme = env('DBR_THEME');
        return "themes/$theme/pro/para/ko_KR/{$type}/{$filePath}.json";
    }

    public function deleteCachedDirectory()
    {
        $theme = env('DBR_THEME');
        foreach (preg_replace('/\s+/', '', explode(',', env('LOCALE_SEQUENCE')) ?? []) as $locale) {
            Storage::disk('dabory')->deleteDirectory("themes/$theme/pro/para/$locale/response");
        }
    }

    public function filterWidgetTaxo($data, $taxoCode, $DeviceType = '')
    {
        return collect($data)->filter(function ($widget) use ($taxoCode, $DeviceType) {
            if (empty($DeviceType)) {
                return $widget['C1'] === $taxoCode;
            }
            return $widget['C1'] === $taxoCode && $widget['C2'] === $DeviceType;
        })->values()->toArray();
    }

    public function filterItemTaxo($data, $itemTaxoNo)
    {
        return collect($data)->filter(function ($widget) use ($itemTaxoNo) {
            return $widget['C1'] === $itemTaxoNo;
        })->values()->toArray();
    }
}
