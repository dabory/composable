@extends('auth.master')
@section('content')

    <!-- Login card -->
<div class="d-flex justify-content-center align-items-center h-100">
    <form class="login-form form-prevent-multiple-submits" action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="login_logo">
							<img src="/public/images/login_logo.png">
						</div>
                    </div>

                @if (! $develLoginInfo['IsUserSsoOnly'])
                    @if (session('mgs'))
                        <div class="text-center">
                            <label class="text-danger">{{ session('mgs') }}</label>
                        </div>
                    @endif

                    <div class="form-group mb-3 form-group-feedback form-group-feedback-left">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $develLoginInfo['UserEmail'] ?? '' }}" aria-label="이메일">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                        @error('email')
                        <label class="validation-invalid-label" for="basic">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group mb-3 form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $develLoginInfo['UserPasswd'] ?? '' }}" aria-label="비밀번호">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                        @error('password')
                        <label class="validation-invalid-label" for="basic">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block button-prevent-multiple-submits">
                            <i class="spinner fa fa-spinner fa-spin"></i>
                            {{ $login['FormVars']['Title']['Login'] }}
                        </button>
                    </div>
                    <div class="d-flex justify-content-center pdl-3 pr-1 link_wrap">
                        <div class="form-group mb-3 d-flex align-items-center">
                            <a href="{{ route('user-signup-verify.index') }}" class="ml-auto mr-auto">{{ $login['FormVars']['Title']['Signup'] }}</a>
                        </div>

                        <div class="form-group mb-3 d-flex align-items-center">
                            <a href="{{ route('find-user-pw-memcheck.index') }}" class="ml-auto mr-auto">{{ $login['FormVars']['Title']['ForgetPassword'] }}</a>
                        </div>
                    </div>


                    <div class="form-group mb-3 d-flex align-items-center justify-content-center">OR</div>
                @endif

                <div class="form-group mb-3">
                    @foreach ($oauth2InfoList as $key => $oauth2Info)
                        @if (! isset($oauth2Info['apiStatus']))
                            <button type="button" onclick="window.location.href = '{{ route('social.redirectToProvider', [ 'oauth2Info' => $oauth2Info, 'provider' => $key, 'target' => 'user' ]) }}'" class="btn btn-primary btn-block">{{ $oauth2Info['LoginButtonString'] }}</button>
                        @endif
                    @endforeach
                </div>

                <div class="d-flex justify-content-center pdl-3 pr-1 link_wrap">
                    <div class="form-group mb-3 d-flex align-items-center">
                        <a href="{{ route('user.clear.cache') }}" class="ml-auto mr-auto">{{ $login['FormVars']['Title']['ClearCache'] }}</a>
                    </div>
                    <div class="form-group mb-3 d-flex align-items-center">
                        <a href="/" class="ml-auto mr-auto">{{ $login['FormVars']['Title']['GoHome'] }}</a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<!-- /login card -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<script>
    window.onload = function() {
        history.pushState(null, null, location.href);
        window.onpopstate = function(event) {
            history.go(1);
        };

        // let passData = { returnValue : 200 };
        // window.parent.postMessage(passData, 'http://localhost:8000');
    }

    // window.addEventListener('message', function(e) {
    //     //e.data ==> 수신 받은 데이터
    //     //e.origin ==> 허용된 도메인
    //     const req = JSON.parse(decoding(e.data))
    //     console.log(req)
    //     console.log(JSON.parse(decoding(req['PrintingJson'])))
    // });

    // function decoding(encoded){
    //     //base64 decrypt
    //     var parsedWordArray = CryptoJS.enc.Base64.parse(encoded);
    //     var decoded = parsedWordArray.toString(CryptoJS.enc.Utf8);
    //     return decoded;
    // }
</script>
