{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-member-pagemove-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary member-pagemove-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="member-pagemove-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterLoginUri'] }}</label>
                                <input type="text" id="after-login-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterLoginApplyPage'] }}</label>
                                <input type="text" id="after-login-apply-page-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterAddCartUri'] }}</label>
                                <input type="text" id="after-add-cart-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterCheckoutSuccessUri'] }}</label>
                                <input type="text" id="after-checkout-success-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterCheckoutFailUri'] }}</label>
                                <input type="text" id="after-checkout-fail-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterSupplierLoginUri'] }}</label>
                                <input type="text" id="after-supplier-login-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterBuySupLoginUri'] }}</label>
                                <input type="text" id="after-buy-sup-login-uri-txt" class="rounded w-100" autocomplete="off">
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
            $('.member-pagemove-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAMemberPagemoveForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAMemberPagemoveForm, $, undefined ) {
            PopupSetupFormAMemberPagemoveForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAMemberPagemoveForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#member-pagemove-form #frm');
            }

            PopupSetupFormAMemberPagemoveForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAMemberPagemoveForm.parameter);

                Atype.btn_act_save('#member-pagemove-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAMemberPagemoveForm');
            }

            PopupSetupFormAMemberPagemoveForm.parameter = function () {
                let setup = {
                    AfterLoginUri: $('#after-login-uri-txt').val(),
                    AfterLoginApplyPage: $('#after-login-apply-page-txt').val(),
                    AfterAddCartUri: $('#after-add-cart-uri-txt').val(),
                    AfterCheckoutSuccessUri: $('#after-checkout-success-uri-txt').val(),
                    AfterCheckoutFailUri: $('#after-checkout-fail-uri-txt').val(),
                    AfterSupplierLoginUri: $('#after-supplier-login-uri-txt').val(),
                    AfterBuySupLoginUri: $('#after-buy-sup-login-uri-txt').val(),
                }
                let id = Number($('#member-pagemove-form').find('#Id').val());
                let parameter = {
                    Id: id,
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

            PopupSetupFormAMemberPagemoveForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#member-pagemove-form #frm');
                $('#member-pagemove-form').find('#Id').val(id)
                PopupSetupFormAMemberPagemoveForm.set_coupon_ui(setup)
            }

            PopupSetupFormAMemberPagemoveForm.set_coupon_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#after-login-uri-txt').val(setup['AfterLoginUri'])
                $('#after-login-apply-page-txt').val(setup['AfterLoginApplyPage'])
                $('#after-add-cart-uri-txt').val(setup['AfterAddCartUri'])
                $('#after-checkout-success-uri-txt').val(setup['AfterCheckoutSuccessUri'])
                $('#after-checkout-fail-uri-txt').val(setup['AfterCheckoutFailUri'])
                $('#after-supplier-login-uri-txt').val(setup['AfterSupplierLoginUri'])
                $('#after-buy-sup-login-uri-txt').val(setup['AfterBuySupLoginUri'])
            }

        }( window.PopupSetupFormAMemberPagemoveForm = window.PopupSetupFormAMemberPagemoveForm || {}, jQuery ));
    </script>
@endonce
