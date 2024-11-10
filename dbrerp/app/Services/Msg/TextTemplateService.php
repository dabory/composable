<?php

namespace App\Services\Msg;

use App\Services\CallApiService;
use App\ThirdPartyApi\Interfaces\SmsInterface;
use Illuminate\Support\Facades\Log;

class TextTemplateService
{
    private $callApiService;
    private $smsService;

    public function __construct(CallApiService $callApiService, SmsInterface $smsService)
    {
        $this->callApiService = $callApiService;
        $this->smsService = $smsService;
    }

    public function send($title, $msg, $receiver, $data, $brandCode)
    {
        $setup = $this->getSetup($data, $brandCode);
        $title = !empty($setup['title']) ? $setup['title'] : $title;
        $msg = !empty($setup['msg']) ? $setup['msg'] : $msg;
        // Log::info("setup: " . json_encode($setup));
        $response = $this->smsService->sendMessage($title, $msg, $receiver);

        if (!$response['Success']) {
            return false;
        }

        return true;
    }

    private function getSetup($data, $brandCode): array{
        $response = $this->callApiService->callApi([
            'url' => 'list-type1-book',
            'data' => [
                'Book' => [
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro/setup',
                            'SimpleFilter' => "setup_code = 'text-template' and brand_code='$brandCode'",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 100000
                        ]
                    ],
                ]
            ],
        ]);

        if ($response && isset($response['Book'][0]['Page'][0]['C1'])) {
            $text_data = json_decode($response['Book'][0]['Page'][0]['C1'], true);

            if ($text_data) {
                switch( $brandCode ) {
                    case 'text-auth-code':
                        $text_data['MainText'] = str_replace('{인증번호}', $data['SmsCert'] ?? '', $text_data['MainText']);
                        $text_data['MainText'] = str_replace('{업체명}', $data['CompanyName'] ?? '', $text_data['MainText']);
                        break;
                    case 'seller-confirm-1':
                        $text_data['MainText'] = str_replace('{업체명}', $data['CompanyName'] ?? '', $text_data['MainText']);
                        // $msg = str_replace('{고객명}', $data['customer_name'] ?? '', $text_data['MainText']);
                        break;
                    case 'member-unlock-1':
                        // $msg = str_replace('{인증번호}', $data['smscert'], $text_data['MainText']);
                        break;
                    case 'signup-confirm-1':
                        // $msg = str_replace('{인증번호}', $data['smscert'], $text_data['MainText']);
                    break;
                }
                // Log::info("Sending SMS with brandCode: " . json_encode($text_data));
                // Log::info("Sending SMS with brandCode: " . $text_data['MainText']);
                return [
                    'title' => $text_data['TextTitle'] ?? null,
                    'msg' => $text_data['MainText'] ?? null,
                ];
            }
        }
        return [];
    }
}
