<?php

namespace App\ThirdPartyApi\Barobill\Services;

use App\Services\CallApiService;
use App\ThirdPartyApi\Barobill\Barobill;

class BarobillAccountService extends Barobill
{
    public function __construct(CallApiService $callApiService)
    {
        parent::__construct($callApiService);
    }

    public function getDailyBankAccountLog
    (
        $bankAccountNum,
        $baseDate,
        $countPerPage,
        $currentPage,
        $orderDirection
    )
    {
        $result = $this->baroService->GetDailyBankAccountLog([
            'CERTKEY'			=> self::CERTKEY,
            'CorpNum'			=> self::CORP_NUM,
            'ID'				=> self::ID,
            'BankAccountNum'	=> $bankAccountNum, //계좌번호
            'BaseDate'			=> $baseDate, //기준날짜
            'CountPerPage'		=> $countPerPage, //한 페이지 당 조회 건 수
            'CurrentPage'		=> $currentPage, //현재페이지
            'OrderDirection'	=> $orderDirection //1:ASC 2:DESC
        ])->GetDailyBankAccountLogResult;

        if ($result->CurrentPage < 0) { //실패
            dd($result->CurrentPage);
        }else{ //성공
            return json_decode(json_encode($result), true);
        }
    }
}
