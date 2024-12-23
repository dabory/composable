@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <div class="user-signup-verify-form">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-envelope fa-2x text-warning border-warning border-3 rounded-circle p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">이메일 인증</h5>
                        <span class="d-block text-muted mb-2">
                            회원가입시 입력하였던메일 주소로메일을 발송하였습니다.<br>
                            이메일 주소를 확인하십시오.
                        </span>
                        <p class="font-weight-bold text-warning">
                            (중요)스팸메일 박스도 반드시 확인하여 주시기 바랍니다.
                        </p>
                    </div>
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
