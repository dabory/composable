{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-text-send-form">
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
    <div class="card mb-2" id="text-send-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['RequestUrl'] }}</label>
                                <input type="text" id="request-url-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Key'] }}</label>
                                <input type="text" id="key-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserId'] }}</label>
                                <input type="text" id="user-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Sender'] }}</label>
                                <input type="text" id="sender-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TestReceiver'] }}</label>
                                <input type="text" id="test-receiver-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TestModeYn'] }}</label>
                                <input type="text" id="test-mode-yn-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReserveMinuteLimit'] }}</label>
                                <input type="text" id="reserve-minute-limit-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SmsPrice'] }}</label>
                                <input type="text" id="sms-price-txt" class="rounded w-100 decimal" autocomplete="off"
                                data-point="{{ $formA['FormVars']['Format']['SmsPrice'] }}">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['LmsPrice'] }}</label>
                                <input type="text" id="lms-price-txt" class="rounded w-100 decimal" autocomplete="off"
                                data-point="{{ $formA['FormVars']['Format']['LmsPrice'] }}">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MmsPrice'] }}</label>
                                <input type="text" id="mms-price-txt" class="rounded w-100 decimal" autocomplete="off"
                                data-point="{{ $formA['FormVars']['Format']['MmsPrice'] }}">
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
                    case 'save': PopupSetupFormATextSendForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormATextSendForm, $, undefined ) {
            PopupSetupFormATextSendForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormATextSendForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#text-send-form #frm');
            }

            PopupSetupFormATextSendForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormATextSendForm.parameter);

                Atype.btn_act_save('#text-send-form #frm', async function () {
                    const response = await call_local_api('/set-aligo-text-send', PopupSetupFormATextSendForm.setup_json_parameter())
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormATextSendForm');
            }

            PopupSetupFormATextSendForm.setup_json_parameter = function () {
                const text_send_form = $('#text-send-form')

                return {
                    RequestUrl: $(text_send_form).find('#request-url-txt').val(),
                    Key: $(text_send_form).find('#key-txt').val(),
                    UserId: $(text_send_form).find('#user-id-txt').val(),
                    Sender: $(text_send_form).find('#sender-txt').val(),
                    TestReceiver: $(text_send_form).find('#test-receiver-txt').val(),
                    TestModeYn: $(text_send_form).find('#test-mode-yn-txt').val(),
                    SmsPrice: minusComma($(text_send_form).find('#sms-price-txt').val()),
                    LmsPrice: minusComma($(text_send_form).find('#lms-price-txt').val()),
                    MmsPrice: minusComma($(text_send_form).find('#mms-price-txt').val()),
                    ReserveMinuteLimit: Number($(text_send_form).find('#reserve-minute-limit-txt').val()),
                }
            }

            PopupSetupFormATextSendForm.parameter = function () {
                let setup = PopupSetupFormATextSendForm.setup_json_parameter()
                let id = Number($('#text-send-form').find('#Id').val());
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

                // console.log(parameter)
                return parameter;
            }

            PopupSetupFormATextSendForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#text-send-form #frm');
                $('#text-send-form').find('#Id').val(id)
                PopupSetupFormATextSendForm.set_coupon_ui(setup)
            }

            PopupSetupFormATextSendForm.set_coupon_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#text-send-form').find('#request-url-txt').val(setup['RequestUrl'])
                $('#text-send-form').find('#reserve-minute-limit-txt').val(setup['ReserveMinuteLimit'])
                $('#text-send-form').find('#key-txt').val(setup['Key'])

                $('#text-send-form').find('#user-id-txt').val(setup['UserId'])
                $('#text-send-form').find('#sender-txt').val(setup['Sender'])
                $('#text-send-form').find('#test-receiver-txt').val(setup['TestReceiver'])
                $('#text-send-form').find('#test-mode-yn-txt').val(setup['TestModeYn'])

                $('#text-send-form').find('#sms-price-txt').val(format_conver_for(setup['SmsPrice'], PopupSetupFormATextSendForm.formA['FormVars']['Format']['SmsPrice']))
                $('#text-send-form').find('#lms-price-txt').val(format_conver_for(setup['LmsPrice'], PopupSetupFormATextSendForm.formA['FormVars']['Format']['LmsPrice']))
                $('#text-send-form').find('#mms-price-txt').val(format_conver_for(setup['MmsPrice'], PopupSetupFormATextSendForm.formA['FormVars']['Format']['MmsPrice']))
            }

        }( window.PopupSetupFormATextSendForm = window.PopupSetupFormATextSendForm || {}, jQuery ));
    </script>
@endonce
