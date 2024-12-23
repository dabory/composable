<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Unirest\Request as Unirest;

class TextSendController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'key' => env('SMS_APIKEY'),
            'user_id' => env('SMS_USER'),
            'sender' => env('SMS_SENDER'),
            'title' => request('title'),
            'msg_type' => request('msg_type', 'sms'),
            'msg' => request('msg'),
            'receiver' => request('receiver'),
        ];

        $response = Unirest::post(
            'https://apis.aligo.in/send/',
            ['Accept' => 'application/json'],
            $data,
        );

        return response()->json($response);
    }
}
