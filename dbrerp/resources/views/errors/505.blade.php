<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error 505</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="The most powerful Errors template">
    <meta name="keywords" content="Enter, your, keywords">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/error.css') }}">
</head>
<body>

<div class="main error_505">
    <div class="error">Security</div>
    <img src="{{ asset('/images/error/505.png') }}" />
    <h1>GateToken Updated</h1>
    <h6>
    	<dl>
        	<dt>GateToken 이란?</dt>
            <dd>
            	Dabory에서 개발한 토큰 기반 인증 시스템에 사용되는 웹토큰(JWT)입니다.<br>
        		GateToken은 원본 웹페이지와 연결 웹페이지의 보안 점검에 중요한 장치로서<br>
                API 재시작등 시스템의 중요한 변화나 토큰 만료 시간이 되면 갱신을 요청합니다.<br>
                GateToken은 원본 DB 뿐만 아니라 연관 시스템을 광역 네트워크로 연결하기 위한
                장치로 확장이 되어 있습니다.<br>
        		따라서, 웹토큰의 갱신은 에러가 아니라 좀 더 강화된 보안 시스템의 결과로 표시되는 것이니 안심하시기 바랍니다.<br><br>
            </dd>

            <dd>
                <span style="color: #eb6946;">본인 인증시</span>의 GateToken 업데이트는 잃어버린 게이트 토큰을 복원하는 과정이므로 다보리로그인 탭으로 돌아가서 "본인 인증" 버튼을 다시 한번 클릭해주시기 바랍니다.
            </dd>
        </dl>
    </h6>
    <div class="btn_wrap">
        <a href="/" class="button">Home Page</a>
        <a href="/member-login" class="button">Member Login</a>
        <a href="/user-login" class="button">User Login</a>
    </div>
</div>
</body>
</html>
