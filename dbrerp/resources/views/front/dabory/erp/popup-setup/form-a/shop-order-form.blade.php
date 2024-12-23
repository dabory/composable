{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-order-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-order-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="shop-order-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsCheckoutConf'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-checkout-conf-check"> <label class="mb-0" for="is-checkout-conf-check">{{ $formA['FormVars']['Title']['IsCheckoutConf'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ConfirmTitle'] }}</label>
                                <input type="text" id="confirm-title-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsAutoDeliConf'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-auto-deli-conf-check"> <label class="mb-0" for="is-auto-deli-conf-check">{{ $formA['FormVars']['Title']['IsAutoDeliConf'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AutoDeliDate'] }}</label>
                                <input type="text" id="auto-deli-date-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsAutoPurchConf'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-auto-purch-conf-check"> <label class="mb-0" for="is-auto-purch-conf-check">{{ $formA['FormVars']['Title']['IsAutoPurchConf'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AutoPurchDate'] }}</label>
                                <input type="text" id="auto-purch-date-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsRefundConf'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-refund-conf-check"> <label class="mb-0" for="is-refund-conf-check">{{ $formA['FormVars']['Title']['IsRefundConf'] }}</label>
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
            $('.shop-order-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopOrderForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShopOrderForm, $, undefined ) {
            PopupSetupFormAShopOrderForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopOrderForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-order-form #frm');
            }

            PopupSetupFormAShopOrderForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopOrderForm.parameter);

                Atype.btn_act_save('#shop-order-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopOrderForm');
            }

            PopupSetupFormAShopOrderForm.parameter = function () {
                const form = $('#shop-order-form')

                let setup = {
                    IsCheckoutConf: $(form).find('#is-checkout-conf-check').is(':checked'),
                    ConfirmTitle: $(form).find('#confirm-title-txt').val(),
                    IsAutoDeliConf: $(form).find('#is-auto-deli-conf-check').is(':checked'),
                    AutoDeliDate: Number($(form).find('#auto-deli-date-txt').val()),
                    IsAutoPurchConf: $(form).find('#is-auto-purch-conf-check').is(':checked'),
                    AutoPurchDate: Number($(form).find('#auto-purch-date-txt').val()),
                    IsRefundConf: $(form).find('#is-refund-conf-check').is(':checked')
                }
                let id = Number($(form).find('#Id').val());
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

            PopupSetupFormAShopOrderForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-shop-order-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#shop-order-form #frm');
                $('#shop-order-form').find('#Id').val(id)

                PopupSetupFormAShopOrderForm.set_ui(setup)
            }

            PopupSetupFormAShopOrderForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#shop-order-form')

                $(form).find('#is-checkout-conf-check').prop('checked', setup['IsCheckoutConf'])
                $(form).find('#confirm-title-txt').val(setup['ConfirmTitle'])
                $(form).find('#is-auto-deli-conf-check').prop('checked', setup['IsAutoDeliConf'])
                $(form).find('#auto-deli-date-txt').val(setup['AutoDeliDate'])

                $(form).find('#is-auto-purch-conf-check').prop('checked', setup['IsAutoPurchConf'])
                $(form).find('#auto-purch-date-txt').val(setup['AutoPurchDate'])
                $(form).find('#is-refund-conf-check').prop('checked', setup['IsRefundConf'])
            }

        }( window.PopupSetupFormAShopOrderForm = window.PopupSetupFormAShopOrderForm || {}, jQuery ));
    </script>
@endonce
