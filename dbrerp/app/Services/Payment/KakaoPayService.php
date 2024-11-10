<?php

namespace App\Services\Payment;

use App\Services\CallApiService;
use Exception;

class KakaoPayService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function ready($agent, $form)
    {
        $properties = config('kakaopay.properties');

        $form_params = [];
        $form_params["cid"] = $properties['cid'];                       // 가맹점 코드

        $form_params["approval_url"] = env('APP_URL')."/kakaopay-approve/$agent/redirect";  // 결제성공 redirect url
//        $form_params["cancel_url"] = env('APP_URL')."/kakaopay-approve/$agent/redirect";  // 결제성공 redirect url
        $form_params["cancel_url"] = env('APP_URL')."/checkout-cancel";     // 결제취소 redirect url
        $form_params["fail_url"] = env('APP_URL')."/checkout-failed";         // 결제실패 redirect url

        $form_params = array_merge($form_params, $form);
        $body = \Unirest\Request\Body::form($form_params);
        $response = \Unirest\Request::post(
            'https://kapi.kakao.com/v1/payment/ready',
            [
                'Authorization' => 'KakaoAK '.$properties['kakao_api_admin_key'],
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            $body
        );

        $data = json_encode($response->body ?? []);
        $data = json_decode($data, true);

        return $data;
    }

    public function approve($pg_token, $tid)
    {
        $properties = config('kakaopay.properties');

        $form_params = [];
        $form_params["cid"] = $properties['cid'];                       // 가맹점 코드
        $form_params["tid"] = $tid;                                     // 결제 고유번호
        $form_params["partner_order_id"] = "test12345";                 // 주문번호(ready할 때 사용했던 값)
        $form_params["partner_user_id"] = "1";                          // 회원 ID(ready할 때 사용했던 값)
        $form_params["pg_token"] = $pg_token;                           // pg token

        try {
            $body = \Unirest\Request\Body::form($form_params);
            $response = \Unirest\Request::post(
                'https://kapi.kakao.com/v1/payment/approve',
                [
                    'Authorization' => 'KakaoAK '.$properties['kakao_api_admin_key'],
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                $body
            );

            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } catch (Exception $e) {
            return $e;
        }
    }
}
