{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-withdraw-default-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary withdraw-default-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="withdraw-default-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ActiveWeeks'] }}</label>
                                <input type="text" id="active-weeks-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ActiveNoticeDays'] }}</label>
                                <input type="text" id="active-notice-days-txt" class="rounded w-100" autocomplete="off">
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
            $('.withdraw-default-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAWithdrawDefaultForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAWithdrawDefaultForm, $, undefined ) {
            PopupSetupFormAWithdrawDefaultForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAWithdrawDefaultForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#withdraw-default-form #frm');
            }

            PopupSetupFormAWithdrawDefaultForm.btn_act_save = function () {
                if ( check_dom_input_number(['#active-weeks-txt', '#active-notice-days-txt']) ) return;

                Atype.set_parameter_callback(PopupSetupFormAWithdrawDefaultForm.parameter);

                Atype.btn_act_save('#withdraw-default-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAWithdrawDefaultForm');
            }

            PopupSetupFormAWithdrawDefaultForm.parameter = function () {
                const withdraw_default_form = $('#withdraw-default-form')
                let setup = {
                    ActiveWeeks: Number($(withdraw_default_form).find('#active-weeks-txt').val()),
                    ActiveNoticeDays: Number($(withdraw_default_form).find('#active-notice-days-txt').val()),
                }
                let id = Number($('#withdraw-default-form').find('#Id').val());
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

            PopupSetupFormAWithdrawDefaultForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#withdraw-default-form #frm');
                $('#withdraw-default-form').find('#Id').val(id)

                PopupSetupFormAWithdrawDefaultForm.set_withdraw_default_ui(setup)
            }

            PopupSetupFormAWithdrawDefaultForm.set_withdraw_default_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const withdraw_default_form = $('#withdraw-default-form')

                $(withdraw_default_form).find('#active-weeks-txt').val(setup['ActiveWeeks'])
                $(withdraw_default_form).find('#active-notice-days-txt').val(setup['ActiveNoticeDays'])
            }

        }( window.PopupSetupFormAWithdrawDefaultForm = window.PopupSetupFormAWithdrawDefaultForm || {}, jQuery ));
    </script>
@endonce
