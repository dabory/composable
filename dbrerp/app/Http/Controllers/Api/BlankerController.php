<?php


namespace App\Http\Controllers\Api;


use App\Helpers\Utils;
use Illuminate\Http\Request;
use App\Services\CallApiService;
use Themes\blanker\pro\app\Services\BlankerService;

class BlankerController
{
    /**
     * @var CallApiService
     */
    private $callApiService;
    private $blankerService;

    public function __construct(CallApiService $callApiService, BlankerService $blankerService)
    {
        $this->callApiService = $callApiService;
        $this->blankerService = $blankerService;
    }

    public function currPrice()
    {
        $printingJson = json_decode(base64_decode(request('PrintingJson')), true);
        $result = response()->json($this->blankerService->colrow(
            $printingJson['p'],
            $printingJson['p3'],
            $printingJson['e_size_type'],
            $printingJson['abcd_value'],
            $printingJson['pri_r'],
            $printingJson['opsens5'],
            $printingJson['ii2'],
            $printingJson['ii3'],
            request('OuterWidth'),
            request('OuterHeight'),
            request('OuterWidth'),
            request('OuterHeight'),
        ))->getData(true);

        $this->callApiService->setGateToken();
        $gateToken = session()->get('GateToken');
        $response = $this->callApiService->callApi([
            'url' => 'item-pick',
            'data' => [
                'Page' => [
                    [
                        'Id' => (int)request('ItemId'),
                    ]
                ]
            ],
            'headers' => ['GateToken' => $gateToken['main']]
        ]);


        if ($this->callApiService->verifyApiError($response)) {
            return response()->json($response['body'], 401);
        }

        $item = $response['Page'][0];
        return response()->json([
            'ItemName' => $item['ItemName'],
            'CurrPrice' => (float)$result['total_op'],
        ]);
    }
}
