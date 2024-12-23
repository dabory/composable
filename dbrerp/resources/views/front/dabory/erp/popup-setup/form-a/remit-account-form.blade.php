{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-remit-account-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary deposit-account-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="remit-account-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['BankName'] }}</label>
                                <input type="text" id="bank-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AccountNo'] }}</label>
                                <input type="text" id="account-no-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['HolderName'] }}</label>
                                <input type="text" id="holder-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ConvCode'] }}</label>
                                <input type="text" id="conv-code-txt" class="rounded w-100" autocomplete="off">
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
            $('.deposit-account-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormARemitAccountForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormARemitAccountForm, $, undefined ) {
            PopupSetupFormARemitAccountForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormARemitAccountForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#remit-account-form #frm');
            }

            PopupSetupFormARemitAccountForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormARemitAccountForm.parameter);

                Atype.btn_act_save('#remit-account-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormARemitAccountForm');
            }

            PopupSetupFormARemitAccountForm.parameter = function () {
                const deposit_account_form = $('#remit-account-form')

                let setup = {
                    BankName: $(deposit_account_form).find('#bank-name-txt').val(),
                    AccountNo: $(deposit_account_form).find('#account-no-txt').val(),
                    HolderName: $(deposit_account_form).find('#holder-name-txt').val(),
                    ConvCode: $(deposit_account_form).find('#conv-code-txt').val(),
                }
                let id = Number($(deposit_account_form).find('#Id').val())
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

            PopupSetupFormARemitAccountForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-remit-account-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#remit-account-form #frm');
                $('#remit-account-form').find('#Id').val(id)

                PopupSetupFormARemitAccountForm.set_ui(setup)
            }

            PopupSetupFormARemitAccountForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const deposit_account_form = $('#remit-account-form')

                $(deposit_account_form).find('#bank-name-txt').val(setup['BankName'])
                $(deposit_account_form).find('#account-no-txt').val(setup['AccountNo'])
                $(deposit_account_form).find('#holder-name-txt').val(setup['HolderName'])
                $(deposit_account_form).find('#conv-code-txt').val(setup['ConvCode'])
            }

        }( window.PopupSetupFormARemitAccountForm = window.PopupSetupFormARemitAccountForm || {}, jQuery ));
    </script>
@endonce
