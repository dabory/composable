<?php
namespace App\ThirdPartyApi\Aligo\Services;

use App\ThirdPartyApi\Interfaces\SmsInterface;
use Carbon\Carbon;
use Unirest\Request as Unirest;

class AligoSmsService implements SmsInterface
{
    public function sendMessage($title, $msg, $receiver): array
    {
        $data = [
            'key' => env('SMS_APIKEY'),
            'user_id' => env('SMS_USER'),
            'sender' => env('SMS_SENDER'),
            'title' => $title,
            'msg_type' => 'sms',
            'msg' => $msg,
            'receiver' => $receiver,
        ];

        $response = Unirest::post(
            'https://apis.aligo.in/send/',
            ['Accept' => 'application/json'],
            $data,
        );

        $body = json_decode($response->raw_body, true);
        if ($body['result_code'] !== '1') {
            return [
                'Success' => false,
                'Message' => $body['message'],
                'Error' => [
                    'Code' => $body['result_code'],
                    'Time' => Carbon::now()->timestamp
                ],
            ];
        }

        return [
            'Success' => true,
            'Message' => $body['message'],
            'Response' => [
                'MessageId' => $body['msg_id'],
                'MsgType' => $body['msg_type'],
            ],
        ];
    }
}
