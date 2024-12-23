@extends('auth.master')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Password recovery form -->
        <form class="form-prevent-multiple-submits user-signup-verify-form" action="{{ route('user-signup-verify.store') }}" method="POST">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-certificate fa-2x text-warning border-warning border-3 rounded-circle p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">본인 인증</h5>
{{--                        <span class="d-block text-muted">We'll send you instructions in email</span>--}}
                    </div>

                    <div class="user-signup-verify mb-4">
                        <dl class="agree_check tw-border-t tw-bg-gray-500">
                            <dt>
                                <input type="checkbox" id="phone-identity-verifiy-ck" aria-label="선택"> 휴대폰 본인 확인
                            </dt>
                        </dl>
                    </div>

                    <div class="form-group mb-2 d-flex">
                        <input type="text" class="form-control certi-txt rounded-right-0" id="mobile-no-txt" maxlength="11" placeholder="휴대폰번호" aria-label="휴대폰번호">
                        <span class="btn_wrap js_btn_wrapper mt-0">
                            <button type="button" class="btn bg-blue btn-block text-white certi-btn" onclick="send_verify_code(this)">인증번호 발송</button>
                        </span>
                    </div>
                    <div class="form-group mb-0 d-flex">
                        <input type="text" class="form-control certi-txt rounded-right-0" name="cert_number" placeholder="인증번호" required aria-label="인증번호">
                        <span class="btn_wrap js_btn_wrapper mt-0">
                            <button type="submit" class="btn bg-blue btn-block text-white certi-btn button-prevent-multiple-submits">
                                <i class="spinner fa fa-spinner fa-spin"></i>
                                확인
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
        <!-- /password recovery form -->
    </div>
@endsection

@push('js')
    <script>
        async function send_verify_code($this) {
            let all_check = true

            $('#required-div input').each(function () {
                if (! $(this).is(':checked')) {
                    all_check = false
                }
            })

            if (all_check && $('#phone-identity-verifiy-ck').is(':checked')) {
                const response = await call_local_api('{{ route("user-signup-verify.send") }}', {mobile_no: $('#mobile-no-txt').val()})
                const error_msg = response.data.original.body

                if (error_msg['message'] === 'success') {
                    $($this).prop('disabled', true)
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                } else {
                    iziToast.error({ title: 'Error', message: error_msg['message'] })
                }
                return
            }

            iziToast.info({ title: 'Info', message: '이용약관에 동의하셔야 합니다' });
        }

        $('#mobile-no-txt').on('keyup', function () {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        $('#all-ck').click(function(){
            const checked = $(this).is(':checked');

            if (checked) {
                $('#required-div input:checkbox').prop('checked', true);
            }
        });
    </script>
@endpush
