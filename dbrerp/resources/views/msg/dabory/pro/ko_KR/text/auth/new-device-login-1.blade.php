<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="table-layout:fixed; max-width:700px; background-color:#fff; font-size:16px; font-family:'Roboto', 'Noto Sans KR', sans-serif;">
    <tbody>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding:20px 10px 10px 10px; border-bottom:2px solid #212222;">
                <tbody>
                <tr>
                    <td>
                        <a href="{{$data['C2']}}"><img src="{{msset($data['C1'])}}"></a>
                    </td>
                    <td align="right">
                        <a href="{{$data['C2']}}" style="color:#191919; font-size:14px; text-decoration:none;">{{$data['C3']}}사이트 바로가기</a>
                    </td>
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
                        <h1 style="margin:0; margin-left:-10px; padding:0; color:#212121; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:74px; font-weight:300; letter-spacing:-1px; line-height:1; word-break: break-word;">{{$data['C11']}}에서 새로 로그인함</h1>
                        <h2 style="padding:0; color:#212121; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:50px; font-weight:300; letter-spacing:-1px; line-height:1; word-break: break-word;">IP: {{$data['C12']}}</h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:56px; color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <p style="margin:0; padding:0;">
                            {{$data['C3']}} 계정에 새로 로그인했습니다. 직접 로그인한 것이<br>
                            맞다면 아무런 조치를 취하지 않아도 됩니다.<br>
                            본인이 아니라면 바로차단 버튼을 클릭하세요.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{$data['C13']}}" style="display:inline-block; width:220px; margin-top:40px; margin-bottom:60px; padding:15px; background-color:#0f0f3c; border-radius:50px; border:none; font-size:18px; font-family:'Roboto', 'Noto Sans KR', sans-serif; color: #ffffff; text-decoration: none; font-weight:700; text-align:center;" target="_blank">바로차단</a>
                    </td>
                </tr>
                <tr>
                    <td style="color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <p style="margin:0; padding:0;">
                            궁금한 사항이 있으시면 이메일에 답장을 보내주세요.<br>
                            빠르게 도와 드리겠습니다.
                        </p>
                    </td>
                <tr>
                    <td style="padding-top:40px; color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <p style="margin:0; padding:0;">-{{$data['C3']}} 관리자-</p>
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
                    <td style="font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:13px; font-weight:300; color:#939393; word-break:break-all; ">
                        {!!$data['C4']!!}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>