@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <form class="user-signup-verify-form form-prevent-multiple-submits" method="POST" action="{{ route('user-password-change.store') }}">
            @csrf
            <input type="hidden" name="code" value="{{ request('code') }}">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-key fa-2x text-success border-success border-3 rounded-circle p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">새로운 비밀번호 설정</h5>
                        <span class="d-block text-muted">
                            인증이 완료되었습니다.<br>
                            새로운 비밀번호를 입력해 주세요</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                        @error('password')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-center text-danger">
                        <em>{{ $policyDesc }}</em>
                    </div>

                    <button type="submit" class="btn bg-blue btn-block text-white button-prevent-multiple-submits">
                        <i class="spinner fa fa-spinner fa-spin"></i>
                        비밀번호 변경
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
