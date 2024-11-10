{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-pay-method-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-pay-method-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="shop-pay-method-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsRemit'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-remit-check"> <label class="mb-0" for="is-remit-check">{{ $formA['FormVars']['Title']['IsRemit'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsCrCard'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-cr-card-check"> <label class="mb-0" for="is-cr-card-check">{{ $formA['FormVars']['Title']['IsCrCard'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsPgTransfer'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-pg-transfer-check"> <label class="mb-0" for="is-pg-transfer-check">{{ $formA['FormVars']['Title']['IsPgTransfer'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsVirtAccount'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-virt-account-check"> <label class="mb-0" for="is-virt-account-check">{{ $formA['FormVars']['Title']['IsVirtAccount'] }}</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsMobilePay'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-mobile-pay-check"> <label class="mb-0" for="is-mobile-pay-check">{{ $formA['FormVars']['Title']['IsMobilePay'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsEscCrcard'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-esc-crcard-check"> <label class="mb-0" for="is-esc-crcard-check">{{ $formA['FormVars']['Title']['IsEscCrcard'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsEscTransfer'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-esc-transfer-check"> <label class="mb-0" for="is-esc-transfer-check">{{ $formA['FormVars']['Title']['IsEscTransfer'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsEscVirtual'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-esc-virtual-check"> <label class="mb-0" for="is-esc-virtual-check">{{ $formA['FormVars']['Title']['IsEscVirtual'] }}</label>
                                </div>
                            </div>

                            <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsCrypto1'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-crypto1-check"> <label class="mb-0" for="is-crypto1-check">{{ $formA['FormVars']['Title']['IsCrypto1'] }}</label>
                            </div>
                            <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsCrypto2'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-crypto2-check"> <label class="mb-0" for="is-crypto2-check">{{ $formA['FormVars']['Title']['IsCrypto2'] }}</label>
                            </div>
                            <div>
                                <i class="fas fa-exclamation-triangle"></i>
                                <span class="setup-notice-info">
                                    {{ $formA['FormVars']['Title']['ShopPayMethod'] }}
                                </span>
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
            $('.shop-pay-method-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopPayMethodForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShopPayMethodForm, $, undefined ) {
            PopupSetupFormAShopPayMethodForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopPayMethodForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-pay-method-form #frm');
            }

            PopupSetupFormAShopPayMethodForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopPayMethodForm.parameter);

                Atype.btn_act_save('#shop-pay-method-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopPayMethodForm');
            }

            PopupSetupFormAShopPayMethodForm.parameter = function () {
                const form = $('#shop-pay-method-form')

                let setup = {
                    IsRemit: $(form).find('#is-remit-check').is(':checked'),
                    IsCrCard: $(form).find('#is-cr-card-check').is(':checked'),
                    IsPgTransfer: $(form).find('#is-pg-transfer-check').is(':checked'),
                    IsVirtAccount: $(form).find('#is-virt-account-check').is(':checked'),
                    IsMobilePay: $(form).find('#is-mobile-pay-check').is(':checked'),
                    IsEscCrcard: $(form).find('#is-esc-crcard-check').is(':checked'),
                    IsEscTransfer: $(form).find('#is-esc-transfer-check').is(':checked'),
                    IsEscVirtual: $(form).find('#is-esc-virtual-check').is(':checked'),
                    IsCrypto1: $(form).find('#is-crypto1-check').is(':checked'),
                    Crypto1Symbol: $(form).find('#crypto1-symbol-txt').val(),
                    IsCrypto2: $(form).find('#is-crypto2-check').is(':checked'),
                    Crypto2Symbol: $(form).find('#crypto2-symbol-txt').val(),
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

            PopupSetupFormAShopPayMethodForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-shop-pay-method-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#shop-pay-method-form #frm');
                $('#shop-pay-method-form').find('#Id').val(id)

                PopupSetupFormAShopPayMethodForm.set_ui(setup)
            }

            PopupSetupFormAShopPayMethodForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#shop-pay-method-form')

                $(form).find('#is-remit-check').prop('checked', setup['IsRemit'])
                $(form).find('#is-cr-card-check').prop('checked', setup['IsCrCard'])
                $(form).find('#is-pg-transfer-check').prop('checked', setup['IsPgTransfer'])
                $(form).find('#is-virt-account-check').prop('checked', setup['IsVirtAccount'])
                $(form).find('#is-mobile-pay-check').prop('checked', setup['IsMobilePay'])
                $(form).find('#is-esc-crcard-check').prop('checked', setup['IsEscCrcard'])
                $(form).find('#is-esc-transfer-check').prop('checked', setup['IsEscTransfer'])
                $(form).find('#is-esc-virtual-check').prop('checked', setup['IsEscVirtual'])

                $(form).find('#is-crypto1-check').prop('checked', setup['IsCrypto1'])
                $(form).find('#crypto1-symbol-txt').val(setup['Crypto1Symbol'])
                $(form).find('#is-crypto2-check').prop('checked', setup['IsCrypto2'])
                $(form).find('#crypto2-symbol-txt').val(setup['Crypto2Symbol'])
            }

        }( window.PopupSetupFormAShopPayMethodForm = window.PopupSetupFormAShopPayMethodForm || {}, jQuery ));
    </script>
@endonce
