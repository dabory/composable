<?php

namespace App\Http\Controllers;

use App\Services\CallApiService;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index($listToken)
    {
        $response = $this->callApiService->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'ListType1Vars' => [
                    'ListToken' => $listToken,
                    'IsDownloadList' => true,
                ],
                'PageVars' => [
                    'Limit' => 1000000,
                    'Offset' => 0
                ]
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            notify()->error($response['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        return view('barcode', compact('response'));
    }
}
