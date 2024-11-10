<?php

namespace App\ThirdPartyApi\Barobill;

use App\Services\CallApiService;
use SoapClient;

class Barobill
{
    protected $callApiService;
    protected $baroService;

    //    const SERVICE_URL = 'https://ws.baroservice.com/BANKACCOUNT.asmx?WSDL'; // 운영서버
    const SERVICE_URL = 'https://testws.baroservice.com/BANKACCOUNT.asmx?WSDL'; // 테스트서버
    const CERTKEY = '877AA5A4-E023-4BC8-8BD0-0255C9F0EA62';
    const CORP_NUM = '1198182402';
    const ID = 'wngur6076';

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;

        $this->setup();
    }

    private function setup()
    {
        $this->baroService = new SoapClient(self::SERVICE_URL, array(
            'trace' => 'true',
            'encoding' => 'UTF-8' //소스를 ANSI로 사용할 경우 euc-kr로 수정
        ));
    }
}
