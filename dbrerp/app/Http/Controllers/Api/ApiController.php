<?php


namespace App\Http\Controllers\Api;


use App\Helpers\Utils;
use Illuminate\Http\Request;
use App\Services\CallApiService;

class ApiController
{
    /**
     * @var CallApiService
     */
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function send(Request $request)
    {
        return $this->getData($request);
    }

    public function callApi($url, $data, $headers = null, $type = 'erp')
    {
        $response = $this->callApiService->callApi([
            'url' => $url,
            'data' => $data,
            'headers' => $headers,
            'type' => $type,
        ]);

        return $response;
    }

    public function getData(Request $request)
    {
        return $this->callApiService->getData($request);
//        if ($request['is_user_page'] && empty(session('user'))) {
//            return ['apiStatus' => 555, 'body' => 'User session not found'];
//        }
//
//        if ($request['encode_status']) {
//            $request['data'] = json_decode($request['data']);
//        }
//
//        $response = $this->callApiService->callApi([
//            'url' => $request['url'],
//            'data' => $request['data'],
//            'headers' => $request['headers'],
//            'type' => $request['type'],
//        ], true);
//
//        if ($request['para_cache'] && ! isset($response['apiStatus'])) {
//            Utils::putParamCache($request['para_cache'], $request['url'], json_encode($request['data']));
//        }
//
//        return $response;
    }
}
