{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-devel-login-info-form">
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
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberEmail'] }}</label>
                                <input type="text" id="member-email-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberPasswd'] }}</label>
                                <input type="text" id="member-passwd-txt" class="rounded w-100" autocomplete="off">
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
                    case 'save': PopupSetupFormADevelLoginInfoForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormADevelLoginInfoForm, $, undefined ) {
            PopupSetupFormADevelLoginInfoForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormADevelLoginInfoForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#devel-login-info-form #frm');
            }

            PopupSetupFormADevelLoginInfoForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormADevelLoginInfoForm.parameter);

                Atype.btn_act_save('#devel-login-info-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormADevelLoginInfoForm');
            }

            PopupSetupFormADevelLoginInfoForm.parameter = function () {
                let setup = {
                    MemberEmail: $('#devel-login-info-form').find('#member-email-txt').val(),
                    MemberPasswd: $('#devel-login-info-form').find('#member-passwd-txt').val(),
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

            PopupSetupFormADevelLoginInfoForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-devel-login-info-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#devel-login-info-form #frm');
                $('#devel-login-info-form').find('#Id').val(id)

                PopupSetupFormADevelLoginInfoForm.set_ui(setup)
            }

            PopupSetupFormADevelLoginInfoForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#devel-login-info-form').find('#member-email-txt').val(setup['MemberEmail'])
                $('#devel-login-info-form').find('#member-passwd-txt').val(setup['MemberPasswd'])
                $('#devel-login-info-form').find('#user-email-txt').val(setup['UserEmail'])
                $('#devel-login-info-form').find('#user-passwd-txt').val(setup['UserPasswd'])
            }

        }( window.PopupSetupFormADevelLoginInfoForm = window.PopupSetupFormADevelLoginInfoForm || {}, jQuery ));
    </script>
@endonce
