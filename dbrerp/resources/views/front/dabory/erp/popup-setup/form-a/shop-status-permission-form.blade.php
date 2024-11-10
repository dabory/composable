{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-status-permission-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-status-permission-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="shop-status-permission-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">

                            <div class="d-flex align-items-center">
                                <div class="{{ $formA['FormVars']['Display']['ShipPreShip'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="ship-pre-ship">
                                    <label class="mb-0" for="ship-pre-ship">
                                        {{ $formA['FormVars']['Title']['ShipPreShip'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ShipInTrans'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="ship-in-trans">
                                    <label class="mb-0" for="ship-in-trans">
                                        {{ $formA['FormVars']['Title']['ShipInTrans'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ShipFinish'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="ship-finish">
                                    <label class="mb-0" for="ship-finish">
                                        {{ $formA['FormVars']['Title']['ShipFinish'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['OrderComplete'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="order-complete">
                                    <label class="mb-0" for="order-complete">
                                        {{ $formA['FormVars']['Title']['OrderComplete'] }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="{{ $formA['FormVars']['Display']['CancelSoldOut'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="cancel-sold-out">
                                    <label class="mb-0" for="cancel-sold-out">
                                        {{ $formA['FormVars']['Title']['CancelSoldOut'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['CancelAdmin'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="cancel-admin">
                                    <label class="mb-0" for="cancel-admin">
                                        {{ $formA['FormVars']['Title']['CancelAdmin'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['CancelMemberReq'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="cancel-member-req">
                                    <label class="mb-0" for="cancel-member-req">
                                        {{ $formA['FormVars']['Title']['CancelMemberReq'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['CancelConfirm'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="cancel-confirm">
                                    <label class="mb-0" for="cancel-confirm">
                                        {{ $formA['FormVars']['Title']['CancelConfirm'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['CancelComplete'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="cancel-complete">
                                    <label class="mb-0" for="cancel-complete">
                                        {{ $formA['FormVars']['Title']['CancelComplete'] }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="{{ $formA['FormVars']['Display']['ReturnRequest'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="return-request">
                                    <label class="mb-0" for="return-request">
                                        {{ $formA['FormVars']['Title']['ReturnRequest'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ReturnReceive'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="return-receive">
                                    <label class="mb-0" for="return-receive">
                                        {{ $formA['FormVars']['Title']['ReturnReceive'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ReturnPickup'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="return-pickup">
                                    <label class="mb-0" for="return-pickup">
                                        {{ $formA['FormVars']['Title']['ReturnPickup'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ReturnComfirm'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="return-comfirm">
                                    <label class="mb-0" for="return-comfirm">
                                        {{ $formA['FormVars']['Title']['ReturnComfirm'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ReturnComplete'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="return-complete">
                                    <label class="mb-0" for="return-complete">
                                        {{ $formA['FormVars']['Title']['ReturnComplete'] }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="{{ $formA['FormVars']['Display']['ExchangeRequest'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="exchange-request">
                                    <label class="mb-0" for="exchange-request">
                                        {{ $formA['FormVars']['Title']['ExchangeRequest'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ExchangeReceive'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="exchange-receive">
                                    <label class="mb-0" for="exchange-receive">
                                        {{ $formA['FormVars']['Title']['ExchangeReceive'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ExchangePickup'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="exchange-pickup">
                                    <label class="mb-0" for="exchange-pickup">
                                        {{ $formA['FormVars']['Title']['ExchangePickup'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ExchangeShip'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="exchange-ship">
                                    <label class="mb-0" for="exchange-ship">
                                        {{ $formA['FormVars']['Title']['ExchangeShip'] }}
                                    </label>
                                </div>
                                <div class="{{ $formA['FormVars']['Display']['ExchangeComplete'] }} align-items-center mb-2 mr-2">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="exchange-complete">
                                    <label class="mb-0" for="exchange-complete">
                                        {{ $formA['FormVars']['Title']['ExchangeComplete'] }}
                                    </label>
                                </div>
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
            $('.shop-status-permission-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopStatusPermissionForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShopStatusPermissionForm, $, undefined ) {
            PopupSetupFormAShopStatusPermissionForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopStatusPermissionForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-status-permission-form #frm');
            }

            PopupSetupFormAShopStatusPermissionForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopStatusPermissionForm.parameter);

                Atype.btn_act_save('#shop-status-permission-form #frm', async function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopStatusPermissionForm');
            }

            PopupSetupFormAShopStatusPermissionForm.request_data = function () {
                const shop_status_permission_form = $('#shop-status-permission-form')

                return {
                    ShipPreShip: $(shop_status_permission_form).find('#ship-pre-ship').is(':checked'),
                    ShipInTrans: $(shop_status_permission_form).find('#ship-in-trans').is(':checked'),
                    ShipFinish: $(shop_status_permission_form).find('#ship-finish').is(':checked'),
                    OrderComplete: $(shop_status_permission_form).find('#order-complete').is(':checked'),

                    CancelSoldOut: $(shop_status_permission_form).find('#cancel-sold-out').is(':checked'),
                    CancelAdmin: $(shop_status_permission_form).find('#cancel-admin').is(':checked'),
                    CancelMemberReq: $(shop_status_permission_form).find('#cancel-member-req').is(':checked'),
                    CancelConfirm: $(shop_status_permission_form).find('#cancel-confirm').is(':checked'),
                    CancelComplete: $(shop_status_permission_form).find('#cancel-complete').is(':checked'),

                    ReturnRequest: $(shop_status_permission_form).find('#return-request').is(':checked'),
                    ReturnReceive: $(shop_status_permission_form).find('#return-receive').is(':checked'),
                    ReturnPickup: $(shop_status_permission_form).find('#return-pickup').is(':checked'),
                    ReturnComfirm: $(shop_status_permission_form).find('#return-comfirm').is(':checked'),
                    ReturnComplete: $(shop_status_permission_form).find('#return-complete').is(':checked'),

                    ExchangeRequest: $(shop_status_permission_form).find('#exchange-request').is(':checked'),
                    ExchangeReceive: $(shop_status_permission_form).find('#exchange-receive').is(':checked'),
                    ExchangePickup: $(shop_status_permission_form).find('#exchange-pickup').is(':checked'),
                    ExchangeShip: $(shop_status_permission_form).find('#exchange-ship').is(':checked'),
                    ExchangeComplete: $(shop_status_permission_form).find('#exchange-complete').is(':checked'),
                }
            }

            PopupSetupFormAShopStatusPermissionForm.parameter = function () {
                const shop_status_permission_form = $('#shop-status-permission-form')
                let setup = PopupSetupFormAShopStatusPermissionForm.request_data()
                let id = Number($(shop_status_permission_form).find('#Id').val());
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

            PopupSetupFormAShopStatusPermissionForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-shop-status-permission-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#shop-status-permission-form #frm');
                $('#shop-status-permission-form').find('#Id').val(id)
                PopupSetupFormAShopStatusPermissionForm.set_ui(setup)
            }

            PopupSetupFormAShopStatusPermissionForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const shop_status_permission_form = $('#shop-status-permission-form')

                $(shop_status_permission_form).find('#ship-pre-ship').prop('checked', setup['ShipPreShip'])
                $(shop_status_permission_form).find('#ship-in-trans').prop('checked', setup['ShipInTrans'])
                $(shop_status_permission_form).find('#ship-finish').prop('checked', setup['ShipFinish'])
                $(shop_status_permission_form).find('#order-complete').prop('checked', setup['OrderComplete'])

                $(shop_status_permission_form).find('#cancel-sold-out').prop('checked', setup['CancelSoldOut'])
                $(shop_status_permission_form).find('#cancel-admin').prop('checked', setup['CancelAdmin'])
                $(shop_status_permission_form).find('#cancel-member-req').prop('checked', setup['CancelMemberReq'])
                $(shop_status_permission_form).find('#cancel-confirm').prop('checked', setup['CancelConfirm'])
                $(shop_status_permission_form).find('#cancel-complete').prop('checked', setup['CancelComplete'])

                $(shop_status_permission_form).find('#return-request').prop('checked', setup['ReturnRequest'])
                $(shop_status_permission_form).find('#return-receive').prop('checked', setup['ReturnReceive'])
                $(shop_status_permission_form).find('#return-pickup').prop('checked', setup['ReturnPickup'])
                $(shop_status_permission_form).find('#return-comfirm').prop('checked', setup['ReturnComfirm'])
                $(shop_status_permission_form).find('#return-complete').prop('checked', setup['ReturnComplete'])

                $(shop_status_permission_form).find('#exchange-request').prop('checked', setup['ExchangeRequest'])
                $(shop_status_permission_form).find('#exchange-receive').prop('checked', setup['ExchangeReceive'])
                $(shop_status_permission_form).find('#exchange-pickup').prop('checked', setup['ExchangePickup'])
                $(shop_status_permission_form).find('#exchange-ship').prop('checked', setup['ExchangeShip'])
                $(shop_status_permission_form).find('#exchange-complete').prop('checked', setup['ExchangeComplete'])
            }

        }( window.PopupSetupFormAShopStatusPermissionForm = window.PopupSetupFormAShopStatusPermissionForm || {}, jQuery ));
    </script>
@endonce
