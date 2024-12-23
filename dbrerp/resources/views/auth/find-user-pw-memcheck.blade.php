@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <form action="{{ route('find-user-pw-verify.index') }}" class="user-signup-verify-form form-prevent-multiple-submits">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h1 class="mb-0">비밀번호 재설정</h1>
                        <span class="d-block text-muted">회원 가입 시 등록한 이메일 주소를 입력해 주세요</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-right mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required aria-label="이메일" >
                        <div class="form-control-feedback">
                            <i class="icon-mail5 text-muted"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn bg-blue btn-block text-white button-prevent-multiple-submits">
                        <i class="spinner fa fa-spinner fa-spin"></i>
                        확인
                    </button>
                </div>
            </div>
        </form>
        <!-- /password recovery form -->
    </div>
@endsection


@push('js')
    <script>

    </script>
@endpush
