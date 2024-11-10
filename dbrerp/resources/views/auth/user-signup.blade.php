@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Registration form -->
        <form action="{{ route('user-signup.store') }}" method="POST" class="login-form full_width form-prevent-multiple-submits">
            @csrf
            <input type="hidden" name="mobile_no" value="{{ session('smsCert.mobile_no') }}">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Create account</h5>
                        <span class="d-block text-muted">All fields are required</span>
                    </div>

                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">Your credentials</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        <div class="form-control-feedback">
                            <i class="icon-user-check text-muted"></i>
                        </div>
                        @error('email')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
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

                    <button type="submit" class="btn bg-teal-400 btn-block text-white button-prevent-multiple-submits">
                        <i class="spinner fa fa-spinner fa-spin"></i>
                        Register
                        <i class="icon-circle-right2 ml-2"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /registration form -->
    </div>
@endsection

@push('js')
    <script>

    </script>
@endpush
