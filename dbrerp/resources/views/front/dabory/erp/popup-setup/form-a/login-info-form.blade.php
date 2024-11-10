{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-login-info-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary user-credit-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="devel-login-info-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsMemberSignupBlocked'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-member-signup-blocked-check"> <label class="mb-0" for="is-member-signup-blocked-check">{{ $formA['FormVars']['Title']['IsMemberSignupBlocked'] }}</label>
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsMemberSsoOnly'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-member-sso-only-check"> <label class="mb-0" for="is-member-sso-only-check">{{ $formA['FormVars']['Title']['IsMemberSsoOnly'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberEmail'] }}</label>
                                <input type="text" id="member-email-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberPasswd'] }}</label>
                                <input type="text" id="member-passwd-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsUserSignupBlocked'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-user-signup-blocked-check"> <label class="mb-0" for="is-user-signup-blocked-check">{{ $formA['FormVars']['Title']['IsUserSignupBlocked'] }}</label>
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsUserSsoOnly'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-user-sso-only-check"> <label class="mb-0" for="is-user-sso-only-check">{{ $formA['FormVars']['Title']['IsUserSsoOnly'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserEmail'] }}</label>
                                <input type="text" id="user-email-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserPasswd'] }}</label>
                                <input type="text" id="user-passwd-txt" class="rounded w-100" autocomplete="off">
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
    <script>
        $(document).ready(async function() {
            $('.user-credit-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormALoginInfoForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormALoginInfoForm, $, undefined ) {
            PopupSetupFormALoginInfoForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormALoginInfoForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#devel-login-info-form #frm');
            }

            PopupSetupFormALoginInfoForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormALoginInfoForm.parameter);

                Atype.btn_act_save('#devel-login-info-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormALoginInfoForm');
            }

            PopupSetupFormALoginInfoForm.parameter = function () {
                let setup = {
                    IsMemberSignupBlocked: $('#is-member-signup-blocked-check').is(':checked'),
                    IsMemberSsoOnly: $('#is-member-sso-only-check').is(':checked'),
                    MemberEmail: $('#devel-login-info-form').find('#member-email-txt').val(),
                    MemberPasswd: $('#devel-login-info-form').find('#member-passwd-txt').val(),
                    IsUserSignupBlocked: $('#is-user-signup-blocked-check').is(':checked'),
                    IsUserSsoOnly: $('#is-user-sso-only-check').is(':checked'),
                    UserEmail: $('#devel-login-info-form').find('#user-email-txt').val(),
                    UserPasswd: $('#devel-login-info-form').find('#user-passwd-txt').val(),
                }
                let id = Number($('#devel-login-info-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(setup),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                return parameter;
            }

            PopupSetupFormALoginInfoForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-devel-login-info-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#devel-login-info-form #frm');
                $('#devel-login-info-form').find('#Id').val(id)

                PopupSetupFormALoginInfoForm.set_ui(setup)
            }

            PopupSetupFormALoginInfoForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const devel_login_info_form = $('#devel-login-info-form')

                $(devel_login_info_form).find('#is-member-signup-blocked-check').prop('checked', setup['IsMemberSignupBlocked'])
                $(devel_login_info_form).find('#is-member-sso-only-check').prop('checked', setup['IsMemberSsoOnly'])
                $(devel_login_info_form).find('#member-email-txt').val(setup['MemberEmail'])
                $(devel_login_info_form).find('#member-passwd-txt').val(setup['MemberPasswd'])

                $(devel_login_info_form).find('#is-user-signup-blocked-check').prop('checked', setup['IsUserSignupBlocked'])
                $(devel_login_info_form).find('#is-user-sso-only-check').prop('checked', setup['IsUserSsoOnly'])
                $(devel_login_info_form).find('#user-email-txt').val(setup['UserEmail'])
                $(devel_login_info_form).find('#user-passwd-txt').val(setup['UserPasswd'])
            }

        }( window.PopupSetupFormALoginInfoForm = window.PopupSetupFormALoginInfoForm || {}, jQuery ));
    </script>
@endonce
