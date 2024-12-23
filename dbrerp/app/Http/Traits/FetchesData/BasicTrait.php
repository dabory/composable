<?php

namespace App\Http\Traits\FetchesData;

use Carbon\Carbon;

trait BasicTrait
{
    public function pick($url, $page, $isAjax = false)
    {
        $pick =  $this->callApiService->callApi([
            'url' => $url . '-pick',
            'data' => [
                'Page' => [ $page ]
            ],
        ], $isAjax);

        if ($this->callApiService->verifyApiError($pick)) {
            return $this->responseWithError($pick['body'], $pick['apiStatus']);
        }

        return $this->responseWithSuccess($pick['Page'][0]);
    }

    public function act($url, $page, $isAjax = false)
    {
        $act =  $this->callApiService->callApi([
            'url' => $url . '-act',
            'data' => [
                'Page' => [ $page ]
            ],
        ], $isAjax);

        if ($this->callApiService->verifyApiError($act)) {
            return $this->responseWithError($act['body'], $act['apiStatus']);
        }

        return $this->responseWithSuccess($act);
    }

    public function responseWithError($message, $code): array
    {
        return [
            'Success' => false,
//            'Message' => $message ??_e('API request failed. Please Check'),
//            'Error' => [
//                'Code' => $code,
//                'Time' => Carbon::now()->timestamp
//            ],
            'apiStatus' => $code,
            'body' =>  $message ??_e('API request failed. Please Check'),
        ];
    }

    public function responseWithSuccess($data, $message = 'Success')
    {
        return [
            'Success' => true,
            'Message' => $message,
            'Data' => $data,
        ];
    }
}
