@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <div class="user-signup-verify-form">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-envelope-open fa-2x text-success border-success border-3 rounded-circle p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">이메일 인증 완료</h5>
                        <span class="d-block text-muted mb-2">
                            이메일 인증 되었습니다.<br>
                            로그인 할 수 있습니다.
                        </span>
                    </div>
                    <a href="{{ route('user-login') }}" class="btn bg-blue btn-block text-white">
                        로그인 페이지로 이동
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
