<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> 휴면 계정 전환 안내입니다. </div>

    <p style="font-size: 18px;">
        안녕하세요. 다보리 입니다.<br>
        항상 다보리를 이용해 주셔서 감사드립니다.<br>
        개인정보 보호 관련 법령에 따라 최근 1년 동안<br>
        다보리 서비스에 로그인하지 않은 회원님의 계정을<br>
        휴면계정으로 전환할 예정입니다.<br><br><br>


        휴면 전환 예정 계정 : {{ $account['email'] }}<br>
        휴면 전환 예정일 : {{ $account['due_date'] }}<br>
        분리 보관 항목 : 회원 가입 시 또는 회원 정보 수정으로 수집/관리되는 모든 정보<br>
        관련 법령 : 개인정보 보호법 39조의 6(개인정보의 파기에 대한 특례) 및
        개인정보 보호법 시행령 제48조의 5 (개인정보의 파기 등에 관한 특례)
        (단 다른 법률에 의거하여 별도의 기간을 정하는 경우 관련 법령에 따릅니다.)<br><br><br>


        휴면상태로 전환된 계정의 개인정보는 안전하게 분리되어 보관하며,<br>
        다른 용도로 사용되지 않습니다.<br>
        휴면 전환 후 서비스 사용을 원하시는 경우,<br>
        로그인을 하시면 휴면 상태를 해제하실 수 있습니다.<br>
    </p>

    <div style="width: 100%; text-align: center;">
        <a href="{{ $loginUrl }}" target="_blank" style="margin: 20px; font-size: 20px; font-family: Helvetica, Arial, sans-serif; background-color: #3b5998; text-decoration: none; color: #ffffff; padding: 15px 25px; border-radius: 2px; border: 1px solid #3b5998; display: inline-block;">
            다보리 로그인하기
        </a>
    </div>

</body>

</html>
