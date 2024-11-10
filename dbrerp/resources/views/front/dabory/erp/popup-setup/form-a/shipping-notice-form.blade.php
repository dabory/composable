{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-popup-setup-form-a-shipping-notice-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary api23e-key-pair-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="popup-setup-form-a-shipping-notice-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ShipType'] }}</label>
                                <input type="text" id="ship-type-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AvgShipPeriod'] }}</label>
                                <input type="text" id="avg-ship-period-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReturnAddress'] }}</label>
                                <input type="text" id="return-address-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReturnPeriod'] }}</label>
                                <textarea id="return-period-textarea" cols="30" rows="10"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReturnNotice'] }}</label>
                                <textarea id="return-notice-textarea" cols="30" rows="10"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Filler1Period'] }}</label>
                                <input type="text" id="filler1-period-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Filler1Notice'] }}</label>
                                <input type="text" id="filler1-notice-txt" class="rounded w-100" autocomplete="off">
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
            new Clipboard('.copy-btn').on('success', function(e) {
                iziToast.success({ title: 'Success', message: $('#action-completed').text() })
            }).on('error', function(e) {
                iziToast.error({ title: 'Error', message: $('#action-failed').text() })
            });

            $('.api23e-key-pair-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShippingNoticeForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShippingNoticeForm, $, undefined ) {
            PopupSetupFormAShippingNoticeForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShippingNoticeForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#popup-setup-form-a-shipping-notice-form #frm')
            }

            PopupSetupFormAShippingNoticeForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShippingNoticeForm.parameter);

                Atype.btn_act_save('#popup-setup-form-a-shipping-notice-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShippingNoticeForm');
            }

            PopupSetupFormAShippingNoticeForm.parameter = function () {
                const form = $('#popup-setup-form-a-shipping-notice-form')

                let setup = {
                    ShipType: $(form).find('#ship-type-txt').val(),
                    AvgShipPeriod: $(form).find('#avg-ship-period-txt').val(),
                    ReturnAddress: $(form).find('#return-address-txt').val(),
                    ReturnPeriod: $(form).find('#return-period-textarea').val(),
                    ReturnNotice: $(form).find('#return-notice-textarea').val(),
                    Filler1Period: $(form).find('#filler1-period-txt').val(),
                    Filler1Notice: $(form).find('#filler1-notice-txt').val(),
                }
                let id = Number($(form).find('#Id').val())
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

            PopupSetupFormAShippingNoticeForm.btn_act_new = async function () {
                Atype.btn_act_new('#popup-setup-form-a-shipping-notice-form #frm')
                $('#api23e-key-pair-txt').prop('readonly', true)
            }

            PopupSetupFormAShippingNoticeForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-popup-setup-form-a-shipping-notice-form .modal-dialog').css('maxWidth', '600px');
                PopupSetupFormAShippingNoticeForm.btn_act_new()
                $('#popup-setup-form-a-shipping-notice-form').find('#Id').val(id)

                PopupSetupFormAShippingNoticeForm.set_ui(setup)
            }

            PopupSetupFormAShippingNoticeForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#popup-setup-form-a-shipping-notice-form')

                $(form).find('#ship-type-txt').val(setup['ShipType'])
                $(form).find('#avg-ship-period-txt').val(setup['AvgShipPeriod'])
                $(form).find('#return-address-txt').val(setup['ReturnAddress'])
                $(form).find('#return-period-textarea').val(setup['ReturnPeriod'])
                $(form).find('#return-notice-textarea').val(setup['ReturnNotice'])
                $(form).find('#filler1-period-txt').val(setup['Filler1Period'])
                $(form).find('#filler1-notice-txt').val(setup['Filler1Notice'])
            }

        }( window.PopupSetupFormAShippingNoticeForm = window.PopupSetupFormAShippingNoticeForm || {}, jQuery ));
    </script>
@endonce
