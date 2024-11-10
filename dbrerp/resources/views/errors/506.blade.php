<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error 506</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="The most powerful Errors template">
    <meta name="keywords" content="Enter, your, keywords">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/error.css') }}">

    <script src="{{ csset('/js/main/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ csset('/css/bootstrap.min.css') }}">
    <script src="{{ csset('/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ csset('/js/app.js') }}"></script>
</head>
<body>

@include('vendor.lara-izitoast.toast')

<div class="main">
    <div class="error">506</div>
    <img src="{{ asset('/images/error/506.png') }}" />
    <h2>의심스러운 활동이 발견되었습니다. 사람 사용자이신가요 ?</h2>
    <!--<h6>Something want wrong,<br />Please try again</h6>-->
    <div class="btn_wrap">
    	<button type="button" class="button" data-toggle="modal" data-target="#captchaModal">네 맞습니다</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="captchaModal" tabindex="-1" role="dialog" aria-labelledby="captchaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 350px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="captchaModalLabel">캡챠(휴먼 증명)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="{{ url('captcha-validation') }}">
                <div class="modal-body px-0 m-auto py-3" style="max-width: 300px;">
                    <p style="font-size: 17px;">
                        로봇이 아니라는 것을 증명하기 위해 아래의 문자열을 정확하게 입력한 후 확인을 클릭해 주십시요.<br>
                        문자열 해독이 힘들면 <span class="text-danger">"새로고침"</span>을 클릭하여 다른 문자열로 바꿀 수 있습니다.<br>
                    </p>
                    <div class="form-group mb-1">
                        <div class="captcha text-center">
                            <span>{!! captcha_img() !!}</span>
                        </div>
                    </div>
                    <div class="form-group d-flex mb-0">
                        <input id="captcha" type="text" class="form-control col-8 radius-r0" placeholder="문자열 입력" name="captcha">
                        <button type="button" class="btn btn-danger reload col radius-l0" id="reload">
                            새로고침
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">확인</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{ url('reload-captcha') }}',
            success: function (data) {
                $('#captcha').val('')
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
