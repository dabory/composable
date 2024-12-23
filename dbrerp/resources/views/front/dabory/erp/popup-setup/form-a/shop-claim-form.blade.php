{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-claim-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-claim-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="shop-claim-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsCancelStockRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-cancel-stock-rec-check"> <label class="mb-0" for="is-cancel-stock-rec-check">{{ $formA['FormVars']['Title']['IsCancelStockRec'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsCancelCouponRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-cancel-coupon-rec-check"> <label class="mb-0" for="is-cancel-coupon-rec-check">{{ $formA['FormVars']['Title']['IsCancelCouponRec'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsExchCouponRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-exch-coupon-rec-check"> <label class="mb-0" for="is-exch-coupon-rec-check">{{ $formA['FormVars']['Title']['IsExchCouponRec'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsExchGiftRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-exch-gift-rec-check"> <label class="mb-0" for="is-exch-gift-rec-check">{{ $formA['FormVars']['Title']['IsExchGiftRec'] }}</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsExchRewardRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-exch-reward-rec-check"> <label class="mb-0" for="is-exch-reward-rec-check">{{ $formA['FormVars']['Title']['IsExchRewardRec'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsRefundStockRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-refund-stock-rec-check"> <label class="mb-0" for="is-refund-stock-rec-check">{{ $formA['FormVars']['Title']['IsRefundStockRec'] }}</label>
                                </div>
                                <div class="align-items-center mb-2 mr-2 {{ $formA['FormVars']['Display']['IsRefundCouponRec'] }}">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-refund-coupon-rec-check"> <label class="mb-0" for="is-refund-coupon-rec-check">{{ $formA['FormVars']['Title']['IsRefundCouponRec'] }}</label>
                                </div>
                            </div>

                            <div>
                                <i class="fas fa-exclamation-triangle"></i>
                                <span class="setup-notice-info">
                                    {{ $formA['FormVars']['Title']['ShopClaimCom'] }}
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
            $('.shop-claim-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopClaimForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShopClaimForm, $, undefined ) {
            PopupSetupFormAShopClaimForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopClaimForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-claim-form #frm');
            }

            PopupSetupFormAShopClaimForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopClaimForm.parameter);

                Atype.btn_act_save('#shop-claim-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopClaimForm');
            }

            PopupSetupFormAShopClaimForm.parameter = function () {
                const form = $('#shop-claim-form')

                let setup = {
                    IsCancelStockRec: $(form).find('#is-cancel-stock-rec-check').is(':checked'),
                    IsCancelCouponRec: $(form).find('#is-cancel-coupon-rec-check').is(':checked'),
                    IsExchCouponRec: $(form).find('#is-exch-coupon-rec-check').is(':checked'),
                    IsExchGiftRec: $(form).find('#is-exch-gift-rec-check').is(':checked'),

                    IsExchRewardRec: $(form).find('#is-exch-reward-rec-check').is(':checked'),
                    IsRefundStockRec: $(form).find('#is-refund-stock-rec-check').is(':checked'),
                    IsRefundCouponRec: $(form).find('#is-refund-coupon-rec-check').is(':checked'),
                }
                let id = Number( $(form).find('#Id').val() )
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

                // console.log(setup)
                return parameter;
            }

            PopupSetupFormAShopClaimForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-shop-claim-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#shop-claim-form #frm');
                $('#shop-claim-form').find('#Id').val(id)

                PopupSetupFormAShopClaimForm.set_ui(setup)
            }

            PopupSetupFormAShopClaimForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#shop-claim-form')

                $(form).find('#is-cancel-stock-rec-check').prop('checked', setup['IsCancelStockRec'])
                $(form).find('#is-cancel-coupon-rec-check').prop('checked', setup['IsCancelCouponRec'])
                $(form).find('#is-exch-coupon-rec-check').prop('checked', setup['IsExchCouponRec'])
                $(form).find('#is-exch-gift-rec-check').prop('checked', setup['IsExchGiftRec'])

                $(form).find('#is-exch-reward-rec-check').prop('checked', setup['IsExchRewardRec'])
                $(form).find('#is-refund-stock-rec-check').prop('checked', setup['IsRefundStockRec'])
                $(form).find('#is-refund-coupon-rec-check').prop('checked', setup['IsRefundCouponRec'])
            }

        }( window.PopupSetupFormAShopClaimForm = window.PopupSetupFormAShopClaimForm || {}, jQuery ));
    </script>
@endonce
