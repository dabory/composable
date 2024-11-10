<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Standard Route Pages</title>
    <style>
        body {
            font-family: 'Jeju Gothic', serif !important;
        }

        h1, h2, h3 {
            font-family: 'Jeju Gothic', serif !important;
        }

        body {
            padding-top: 50px;
        }
        .panel-heading {
            height: 50px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/jejugothic.css">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/pro-route-std">표준 라우트</a></li>
                <li class="active"><a href="/pro-route-custom">커스텀 라우트</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>회원 라우트 :  <?php echo 'PHP ' . phpversion();?></h4></div>
                <div class="panel-body">
                    <ul>
                        <li>[기본]</li>
                        <li><a href="/" target="_self">홈</a></li>
                        <li><a href="/user-login" target="_self">/user-login</a> : 관리자 로그인 </li>
                        <li><a href="/member-login" target="_self">/member-login</a> : 회원 로그인 </li>
                        <li><a href="/user-clear-cache" target="_self">/user-clear-cache</a> : 캐시 삭제 </li>
                        <br>
                        <li>[회원-로그인]</li>
                        <li><a href="/member-login" target="_blank">/member-login</a> : 로그인 </li>
                        <li><a href="/member-login-non-social" target="_blank">/member-login-non-social</a> : Non-Social 로그인 </li>
                        <li><a href="/find-member-id" target="_blank">/find-member-id</a> : 아이디 찾기 </li>
                        <li><a href="/member-activate-failed" target="_blank">/member-activate-failed</a> : 이메일 재전송 </li>
                        <li><a href="/find-member-id-verify" target="_blank">find-member-id-verify</a> : 아이디 찾기- 휴대폰 인증 </li>
                        <br>
                        <li>[회원등록-탈퇴]</li>
                        <li><a href="/member-signup-verify" target="_blank">/member-signup-verify</a> : 본인인증 </li>
                        <li><a href="/member-signup" target="_blank">/member-signup</a> : 가입 </li>
                        <li><a href="/member-signup-branch" target="_blank">/member-signup-branch</a> : 일반/판매(기업) 구분 </li>
                        <li><a href="/member-company-signup" target="_blank">/member-company-signup</a> : 판매(기업)회원 가입 </li>
                        <li><a href="/member-withdrawal" target="_blank">/member-withdrawal</a> : 탈퇴 </li>
                        <li><a href="/member-withdraw-cancel" target="_blank">/member-withdraw-cancel</a> : 탈퇴취소 </li>
                        <br>
                        <li>[회원인증과 재설정]</li>
                        <li><a href="/password-change" target="_blank">/password-change</a> : 비번 재설정 </li>
                        <li><a href="/password-reset" target="_blank">/password-reset</a> : 임시비번 발급  </li>
                        <li><a href="/find-member-pw-verify" target="_blank">/find-member-pw-verify</a> : 비번 재설정- 휴대폰인증 </li>
                        <li><a href="/password-reset-code-failed" target="_blank">/password-reset-code-failed</a> : 비번 재설정 실패 </li>
                        <li><a href="/member-go-email" target="_blank">/member-go-email</a> : 이메일을 인증 </li>
                        <li><a href="/member-verify-ok" target="_blank">/member-verify-ok</a> : 이메일 인증 완료 </li>
                        <li><a href="/member-verify-resend" target="_blank">/member-verify-resend</a> : 인증메일 재발송 </li>
                        <li><a href="/member-unlock" target="_blank">/member-unlock</a> : 계정잠금 해제 </li>
                        <li><a href="/member-device-block-failed" target="_blank">/member-device-block-failed</a> : 디바이스 차단 실패 </li>
                        <li><a href="/member-device-block-success" target="_blank">/member-device-block-success</a> : 디바이스 차단 성공 </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>쇼핑몰 라우트</h4></div>
                <div class="panel-body">
                    <ul>
                        <li>[유형상품(Item)]</li>
                        <li><a target="_blank" href="/item-gallery/all">/item-gallery/all</a> : 상품리스트 </li>
                        <li><a target="_blank" href="/item-details/0">/item-details/0</a> : 상품 상세 </li>
                        <li><a target="_blank" href="/checkout">/checkout</a> : 결제 </li>
                        <br>
                        <li>[포인트상품(credit)]</li>
                        <li><a target="_blank" href="/credit-item-list">/credit-item-list</a> : 포인트상품 리스트</li>
                        <li><a target="_blank" href="/credit-item-details">/credit-item-details</a> : 포인트상품상세 </li>
                        <li><a target="_blank" href="/credit-checkout">/credit-checkout</a> : 포인트상품 결제 </li>
                         <br>
                        <li>[유형상품-크레딧상품-공통]</li>
                        <li><a target="_blank" href="/cart">/cart</a> : 사용자 장바구니 </li>
                        <li><a target="_blank" href="/wish-list">/wish-list</a> : 사용자 관심상품 </li>
                        <li><a target="_blank" href="/checkout-ok">/checkout-ok</a> : 결제성공 </li>
                        <li><a target="_blank" href="/checkout-failed">/checkout-failed</a> : 결제실패 </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>마이페이지 라우트</h4></div>
                <div class="panel-body">
                    <ul>
                        <li>[회원정보와 주문내역]</li>
                        <li><a target="_blank" href="/my-page/member-edit">/my-page/member-edit</a> : 정보수정 </li>
                        <li><a target="_blank" href="/my-page/order-list">/my-page/order-list</a> : 주문내역 </li>
                        <li><a target="_blank" href="/my-page/credit-io-list">/my-page/credit-io-list</a> : 적립금 내역 </li>
                        <br>
                        <li>[회원정보 게시판]</li>
                        <li><a target="_blank" href="/my-page/notice-list">/my-page/notice-list</a> : 공지사항 </li>
                        <li><a target="_blank" href="/my-page/event-list">/my-page/event-list</a> : 이벤트 게시판</li>
                        <li><a target="_blank" href="/my-page/qna-list">/my-page/qna-list</a> : 질문게시판</li>
                        <li><a target="_blank" href="/policy-list">/policy-list</a> : 이용약관 </li>
                        <li><a target="_blank" href="/paq">/paq</a> : 자주하는 질문 </li>
                        <li><a target="_blank" href="/1to1-list">/1to1-list</a> : 1대1 문의 </li>
                        <li><a target="_blank" href="/1to1-details/0">/1to1-details/0</a> : 1대1 문의 상세 </li>
                        <li><a target="_blank" href="/1to1-form'">/1to1-form</a> : 1대1 문의 등록 </li>
                        <li><a target="_blank" href="/seller-enrollment'">/seller-enrollment</a> : 판매회원 신청 </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>게시판 라우트</h4></div>
                <div class="panel-body">
                    <ul>
                        <li>[게시판 리스트]</li>
                        <li><a target="_blank" href="/thumb-event-list">/thumb-event-list</a> : 썸네일 이벤트 리스트 </li>
                        <li><a target="_blank" href="/thumb-blog-list">/thumb-blog-list</a> : 썸네일 블로그 리스트 </li>
                        <li><a target="_blank" href="/blog-list">/blog-list</a> : 블로그 리스트</li>
                        <li><a target="_blank" href="/blog-write">/blog-write</a> : 블로그 작성</li>
                        <li><a target="_blank" href="/youtube-list">/youtube-list</a> : 유튜브 리스트 </li>
                        <br>
                        <li>[게시판 상세]</li>
                        <li><a target="_blank" href="/thumb-event-detail/1">/thumb-event-detail</a> : 썸네일 이벤트 상세 </li>
                        <li><a target="_blank" href="/thumb-blog-detail/1">/thumb-blog-detail</a> : 썸네일 블로그 상세 </li>
                        <li><a target="_blank" href="/blog-detail/1">/blog-detail</a> : 블로그 상세 </li>
                        <li><a target="_blank" href="/youtube-detail/1">/youtube-detail</a> : 유튜브 상세 </li>
                        <li></li>
                        <li>[정리할 것]</li>
                        <li><a target="_blank" href="/youtube-list">/youtube-list</a> : 유투브 게시판 </li>
                        <li><a target="_blank" href="/blog-list">/blog-list</a> : 블로그 리스트 </li>
                        <li><a target="_blank" href="/thumb-blog-list'">/thumb-blog-list</a> : 섬네일 블로그 리스트 </li>
                        <li><a target="_blank" href="/thumb-event-list">/thumb-event-list</a> : 섬네일 이벤트 리스트 </li>

                        <br>
                        <li>[게시판 작성]</li>
                        <li><a target="_blank" href="/blog-write">/blog-write</a> : 블로그 작성 </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</div><!-- container -->
<webchatgpt-custom-element-27a60e88-f41b-4558-b097-21c8ae725393 id="webchatgpt-snackbar" style="color: rgb(255, 255, 255);"></webchatgpt-custom-element-27a60e88-f41b-4558-b097-21c8ae725393><script src="chrome-extension://hhojmcideegachlhfgfdhailpfhgknjm/web_accessible_resources/index.js"></script></body></html>
