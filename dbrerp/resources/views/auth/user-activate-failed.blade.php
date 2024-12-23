@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <div class="user-signup-verify-form">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger border-danger border-3 rounded-circle p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">회원 인증 실패</h5>
                        <span class="d-block text-muted mb-2">
                            회원인증이 실패하었습니다.<br>
                            아래의 이메일로 회원 등록 정보를 보내주시기 바랍니다.
                        </span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-right mb-3">
                        <input type="email" class="form-control" placeholder="Your email" value="admin@gmail.com" readonly>
                        <div class="form-control-feedback">
                            <i class="icon-mail5 text-muted"></i>
                        </div>
                    </div>

                    <a href="{{ route('user-login') }}" class="btn bg-blue btn-block text-white">
                        메일 재전송
                    </a>
                </div>
            </div>

        </div>
        <!-- /password recovery form -->
    </div>
@endsection

@push('js')
    <script>

    </script>
@endpush
