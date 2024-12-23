<table align="center" border="0" cellpadding="0" cellspacing="0"
       style="table-layout:fixed; max-width:700px; background-color:#fff; font-size:16px; font-family:'Roboto', 'Noto Sans KR', sans-serif;"
       width="100%">
    <tbody>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0"
                   style="padding:20px 10px 10px 10px; border-bottom:2px solid #212222;" width="100%">
                <tbody>
                <tr>
                    <td><a href="{{$data['C2']}}"><img src="{{msset($data['C1'])}}" class="fr-fic fr-dii"></a></td>
                    <td align="right"><a href="{{$data['C2']}}"
                                         style="color:#191919; font-size:14px; text-decoration:none;">{{$data['C3']}}사이트
                            바로가기</a></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:60px 80px 140px 20px; border-bottom:1px solid #e3e3e3; background-image:url(images/bg.png); background-position:right bottom; background-repeat:no-repeat;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td style="word-break:break-word;">
                        <h1
                            style="margin:0; margin-left:-10px; padding:0; color:#212121; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:40px; font-weight:300; letter-spacing:-1px; line-height:1; word-break: break-word;">
                            킹콩스크랩 실패 메일
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:56px; color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <p style="margin:0; padding:0;">쿠폰을 받을 이메일주소: <span style="font-weight: bold;">{{$data['C11']}}</span></p>
                        <p style="margin:0; padding:0;">상품상세페이지 인터넷 주소: <span style="font-weight: bold;"><a href="{{$data['C12']}}">{{$data['C12']}}</a></span></p>
                        <p style="margin:0; padding:0;">할인 요청 %: <span style="font-weight: bold;">{{$data['C13']}}</span></p>
                        <p style="margin:0; padding:0;">할인 조건(이유): <span style="font-weight: bold;">{{DataConverter::execute($data['C14'], "sort('kkcoupon')")}}</span></p>
                        <p style="margin:0; padding:0;">할인 조건 직접입력: <span style="font-weight: bold;">{{$data['C15']}}</span></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" style="padding:30px 10px;">
                <tbody>
                <tr>
                    <td style="font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:13px; font-weight:300; color:#939393; word-break:break-all;">{!!$data['C4']!!}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>