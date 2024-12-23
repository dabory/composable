@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <form action="{{ route('find-user-pw-verify.store') }}" class="user-signup-verify-form form-prevent-multiple-submits" method="POST">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-check-square fa-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">인증수단 선택</h5>
                        <span class="d-block text-muted">인증번호가 전송 될 인증 수단을 선택해 주세요</span>
                    </div>

                    <input name="auth" value="email" type="radio" checked> 등록된 이메일 주소로 인증
                    <div class="form-group form-group-feedback form-group-feedback-right mb-3 mt-1">
                        <input type="email" name="email" class="form-control" value="{{ $email }}" readonly>
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
