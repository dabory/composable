<?php

namespace App\Services;

use App\Services\CallApiService;

class SeoMetaService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function itemDetailsSeo($slug): array
    {
        $itemPick = $this->callApiService->callApi([
            'url' => 'item-pick',
            'data' => [
                'Page' => [ [ 'ItemSlug' =>  $slug ] ]
            ]
        ]);

        if ($this->callApiService->verifyApiError($itemPick)) {
            return [ 'error' => true, 'message' => $itemPick['body'] ];
        } else {
            $item_id = $itemPick['Page'][0]['Id'];
        }

        return [ 'error' => false, 'data' => $item_id ];
    }
}
