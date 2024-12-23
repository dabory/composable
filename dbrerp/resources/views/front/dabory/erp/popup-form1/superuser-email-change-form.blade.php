{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary superuser-email-change-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'superuser-email-change-act',
        ])
    </div>
</div>

<div class="card mb-2" id="superuser-email-change-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="is-superuser" value="0">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                            <input type="email" id="email-txt" class="rounded w-100" disabled autocomplete="off">
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['NewEmail'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="email" id="new-email-txt" class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0" onclick="PopupForm1SuperuserEmailChangeForm.sendCertEmail()">
                                    {{ $formA['FormVars']['Title']['CertPhrase1'] }}
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['EmailVerifyNumber'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="text" id="email-verify-number-txt" class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0 cert-check-btn email-cert-check-btn"
                                        onclick="PopupForm1SuperuserEmailChangeForm.checkCert('email')">
                                </button>
                            </div>

                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Password'] }}</label>
                            <input type="password" id="password-txt" class="rounded w-100" autocomplete="off">
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['NewPassword'] }}</label>
                            <input type="password" id="new-password-txt" class="rounded w-100" onchange="PopupForm1SuperuserEmailChangeForm.check_pw(this)" autocomplete="off">
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['NewPasswordConfirmation'] }}</label>
                            <input type="password" id="new-password-confirmation-txt" class="rounded w-100" onchange="PopupForm1SuperuserEmailChangeForm.check_pw(this)"  autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <em class="text-danger" id="policy-desc-em"></em>
                        </div>


                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="text" id="mobile-no-txt" disabled class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0" onclick="PopupForm1SuperuserEmailChangeForm.sendCertMobile('current', $('#superuser-email-change-form').find('#mobile-no-txt').val())">
                                    {{ $formA['FormVars']['Title']['CertPhrase2'] }}
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MobileVerifyNumber'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="text" id="mobile-verify-number-txt" class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0 cert-check-btn mobile-cert-check-btn"
                                        onclick="PopupForm1SuperuserEmailChangeForm.checkCert('mobile')">
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['NewMobileNo'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="text" id="new-mobile-no-txt" class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0" onclick="PopupForm1SuperuserEmailChangeForm.sendCertMobile('new', $('#superuser-email-change-form').find('#new-mobile-no-txt').val())">
                                    {{ $formA['FormVars']['Title']['CertPhrase2'] }}
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['NewMobileVerifyNumber'] }}</label>
                            <div class="d-flex input-btn-group">
                                <input type="text" id="new-mobile-verify-number-txt" class="rounded w-100 col-8 radius-r0" autocomplete="off">
                                <button class="w-100 col radius-l0 cert-check-btn new-mobile-cert-check-btn"
                                        onclick="PopupForm1SuperuserEmailChangeForm.checkCert('new-mobile')">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#modal-select-popup.popup-form1-superuser-email-change-form').on('show.bs.modal', function (event) {
                if ($('#superuser-email-change-form').find('#is-superuser').val() !== '1') {
                    event.preventDefault();

                    return iziToast.error({
                        title: 'Error', message: 'SuperUser	계정만 이메일/모바일 변경 가능합니다',
                    })
                }
            })

            $('.superuser-email-change-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1SuperuserEmailChangeForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1SuperuserEmailChangeForm, $, undefined ) {
            PopupForm1SuperuserEmailChangeForm.formA = {!! json_encode($formA) !!};

            PopupForm1SuperuserEmailChangeForm.check_pw = function ($this) {
                const users_form = $('#superuser-email-change-form')

                if (isEmpty($($this).val())) {
                    return false;
                }

                if ( $(users_form).find('#new-password-txt').val() === $(users_form).find('#new-password-confirmation-txt').val() ) {
                    $('#policy-desc-em').text('변경 비밀번호가 정상적으로 입력되었습니다.')
                    return true;
                }

                $('#policy-desc-em').text('변경 비밀번호를 확인하세요.')
                return false;
            }

            PopupForm1SuperuserEmailChangeForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-superuser-email-change-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#superuser-email-change-form #frm');

                const users_form = $('#superuser-email-change-form')
                $(users_form).find('#password-txt').val('')
                $(users_form).find('#new-password-txt').val('')
                $(users_form).find('#new-password-confirmation-txt').val('')
                $(users_form).find('#policy-desc-em').text('')
                $(users_form).find('.cert-check-btn').text('인증 확인')
                $(users_form).find('.cert-check-btn').removeClass('text-danger')
                $(users_form).find('#email-verify-number-txt').prop('disabled', false)
                $(users_form).find('#mobile-verify-number-txt').prop('disabled', false)
                $(users_form).find('#new-mobile-verify-number-txt').prop('disabled', false)
            }

            PopupForm1SuperuserEmailChangeForm.btn_act_new_callback = function () {
                PopupForm1SuperuserEmailChangeForm.btn_act_new()
            }

            PopupForm1SuperuserEmailChangeForm.parameter = function () {
                const users_form = $('#superuser-email-change-form')

                return {
                    Email: $(users_form).find('#email-txt').val(),
                    NewEmail: $(users_form).find('#new-email-txt').val(),
                    Password: $(users_form).find('#password-txt').val(),
                    NewPassword: $(users_form).find('#new-password-txt').val(),
                    MobileNo: $(users_form).find('#mobile-no-txt').val(),
                    NewMobileNo: $(users_form).find('#new-mobile-no-txt').val().replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`),
                }
            }

            PopupForm1SuperuserEmailChangeForm.sendCertMobile = async function (name, mobile_no) {
                const response = await call_local_api('/cert/mobile',  {
                    "MobileNo": mobile_no,
                    "Name": name
                })

                if (response.data.error) {
                    iziToast.error({
                        title: 'Error', message: response.data.message,
                    });
                } else {
                    iziToast.success({
                        title: 'Success', message: $('#action-completed').text(),
                    });
                }
            }

            PopupForm1SuperuserEmailChangeForm.sendCertEmail = async function () {
                const users_form = $('#superuser-email-change-form')

                const response = await call_local_api('/cert/mail',  {
                    "Component": 'msg.dabory.pro.ko_KR.email.auth.superuser-email-change-1',
                    "ToMail": $(users_form).find('#new-email-txt').val(),
                    "Subject": '수퍼유저 이메일/모바일폰 변경 메일 인증번호'
                })

                if (response.data.error) {
                    iziToast.error({
                        title: 'Error', message: response.data.message,
                    });
                } else {
                    iziToast.success({
                        title: 'Success', message: '수신메일을 확인하여 인증번호 입력하세요 ! 스팸메일 확인도 필수',
                    });
                }
            }

            PopupForm1SuperuserEmailChangeForm.checkCert = async function (type) {
                const users_form = $('#superuser-email-change-form')
                let request = {}
                let msg = ''
                let successCallback = () => {};
                switch (type) {
                    case 'email':
                        request = {
                            "EmailVerifyNumber": $(users_form).find('#email-verify-number-txt').val(),
                            "Type": 0,
                        }
                        successCallback = () => {
                            $(users_form).find('#email-verify-number-txt').prop('disabled', true)
                            $(users_form).find('.email-cert-check-btn').text('인증 성공')
                            $(users_form).find('.email-cert-check-btn').addClass('text-danger')
                        }
                        msg = '메일 인증 성공'
                        break;

                    case 'mobile':
                        request = {
                            "MobileVerifyNumber": $(users_form).find('#mobile-verify-number-txt').val(),
                            "Type": 1,
                        }
                        successCallback = () => {
                            $(users_form).find('#mobile-verify-number-txt').prop('disabled', true)
                            $(users_form).find('.mobile-cert-check-btn').text('인증 성공')
                            $(users_form).find('.mobile-cert-check-btn').addClass('text-danger')
                        }
                        msg = '현재 모바일폰에서 인증성공'
                        break;
                    case 'new-mobile':
                        request = {
                            "NewMobileVerifyNumber": $(users_form).find('#new-mobile-verify-number-txt').val(),
                            "Type": 2,
                        }
                        successCallback = () => {
                            $(users_form).find('#new-mobile-verify-number-txt').prop('disabled', true)
                            $(users_form).find('.new-mobile-cert-check-btn').text('인증 성공')
                            $(users_form).find('.new-mobile-cert-check-btn').addClass('text-danger')
                        }
                        msg = '변경 관리자 모바일폰에서 인증성공'
                        break;
                }

                const response = await call_local_api('/superuser-email-change',  request)

                if (response.data.error) {
                    iziToast.error({
                        title: 'Error', message: response.data.message,
                    });
                } else {
                    successCallback()
                    iziToast.success({ title: 'Success',  message: msg })
                }
            }



            PopupForm1SuperuserEmailChangeForm.btn_act_save = async function () {
                Atype.set_parameter_callback(PopupForm1SuperuserEmailChangeForm.parameter);

                const users_form = $('#superuser-email-change-form')
                if (! $(users_form).find('#email-verify-number-txt').prop('disabled') ||
                    ! $(users_form).find('#mobile-verify-number-txt').prop('disabled') ||
                    ! $(users_form).find('#new-mobile-verify-number-txt').prop('disabled')) {
                    return iziToast.error({
                        title: 'Error', message: '모든 인증을 완료해주세요',
                    })
                }

                const response = await get_api_data(PopupForm1SuperuserEmailChangeForm.formA['General']['ActApi'],
                    PopupForm1SuperuserEmailChangeForm.parameter()
                )

                if (response.data.apiStatus) {
                    return iziToast.error({
                        title: 'Error', message: response.data.body ?? $('#api-request-failed-please-check').text(),
                    })
                }

                iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
                $('#modal-select-popup.show').trigger('list.requery')
                $('#modal-select-popup.show').modal('hide')

            }


            PopupForm1SuperuserEmailChangeForm.show_popup_callback = async function (id, c1) {
                PopupForm1SuperuserEmailChangeForm.btn_act_new()
                await PopupForm1SuperuserEmailChangeForm.fetch_users(Number(id));
            }

            PopupForm1SuperuserEmailChangeForm.fetch_users = async function (id) {
                const user_pick = await get_api_data(PopupForm1SuperuserEmailChangeForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                const user_ext_pick = await get_api_data('user-ext-pick', {
                    Page: [ { Id: id } ]
                })

                PopupForm1SuperuserEmailChangeForm.set_users_ui(user_pick, user_ext_pick)
            }

            PopupForm1SuperuserEmailChangeForm.set_users_ui = function (user_pick, user_ext_pick) {
                if (isEmpty(user_pick.data) || user_pick.data.apiStatus) return;
                const users = user_pick.data.Page[0];
                const user_ext = user_ext_pick.data.Page[0];

                const users_form = $('#superuser-email-change-form')

                $(users_form).find('#Id').val(users.Id)
                $(users_form).find('#email-txt').val(users.Email)
                $(users_form).find('#is-superuser').val(users.IsSuperuser)
                $(users_form).find('#mobile-no-txt').val(user_ext.MobileNo)
            }

        }( window.PopupForm1SuperuserEmailChangeForm = window.PopupForm1SuperuserEmailChangeForm || {}, jQuery ));
    </script>
@endpush
@endonce
