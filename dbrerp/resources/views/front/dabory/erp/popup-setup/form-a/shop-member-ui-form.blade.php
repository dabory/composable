{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-member-ui-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-member-ui-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'shop-member-ui-act',
                ])
            @endisset
        </div>
    </div>
    <div class="card mb-2" id="shop-member-ui-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['OkBlockCancelOnDelivery'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="ok-block-cancel-on-delivery-check"> <label class="mb-0" for="ok-block-cancel-on-delivery-check">{{ $formA['FormVars']['Title']['OkBlockCancelOnDelivery'] }}</label>
                            </div>
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['OkSkipMemberSignupVerifyPage'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="ok-skip-member-signup-verify-page-check"> <label class="mb-0" for="ok-skip-member-signup-verify-page-check">{{ $formA['FormVars']['Title']['OkSkipMemberSignupVerifyPage'] }}</label>
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
            $('.shop-member-ui-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopMemberUiForm.btn_act_save(); break;
                }
            });

            // $(document).on('hide.bs.modal','.popup-setup-form-a-shop-member-ui-form.show', function () {
            //     const editor = $('#shop-member-ui-form').find('#froala-editor')[0]['data-froala.editor']
            //
            //     if (editor.codeView.isActive()) {
            //         editor.codeView.toggle()
            //     }
            // });

            activate_button_group()
        });

        (function( PopupSetupFormAShopMemberUiForm, $, undefined ) {
            PopupSetupFormAShopMemberUiForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopMemberUiForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-member-ui-form #frm');
            }

            PopupSetupFormAShopMemberUiForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopMemberUiForm.parameter);

                Atype.btn_act_save('#shop-member-ui-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopMemberUiForm');
            }

            PopupSetupFormAShopMemberUiForm.setup_json_data = function () {
                const shop_member_ui_form = $('#shop-member-ui-form')

                return {
                    OkBlockCancelOnDelivery: $(shop_member_ui_form).find('#ok-block-cancel-on-delivery-check').is(':checked'),
                    OkSkipMemberSignupVerifyPage: $(shop_member_ui_form).find('#ok-skip-member-signup-verify-page-check').is(':checked'),
                }
            }

            PopupSetupFormAShopMemberUiForm.parameter = function () {
                let id = Number($('#shop-member-ui-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(PopupSetupFormAShopMemberUiForm.setup_json_data()),
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

            PopupSetupFormAShopMemberUiForm.btn_act_new = function () {
                $('#modal-select-popup.popup-setup-form-a-shop-member-ui-form .modal-dialog').css('maxWidth', '600px');

                Atype.btn_act_new('#shop-member-ui-form #frm');
            }

            PopupSetupFormAShopMemberUiForm.show_popup_callback = function (id, setup) {
                PopupSetupFormAShopMemberUiForm.btn_act_new()

                $('#shop-member-ui-form').find('#Id').val(id)

                PopupSetupFormAShopMemberUiForm.set_item_review_ui(setup)
            }

            PopupSetupFormAShopMemberUiForm.set_item_review_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const shop_member_ui_form = $('#shop-member-ui-form')

                $(shop_member_ui_form).find('#ok-block-cancel-on-delivery-check').prop('checked', setup['OkBlockCancelOnDelivery'])
                $(shop_member_ui_form).find('#ok-skip-member-signup-verify-page-check').prop('checked', setup['OkSkipMemberSignupVerifyPage'])
            }

        }( window.PopupSetupFormAShopMemberUiForm = window.PopupSetupFormAShopMemberUiForm || {}, jQuery ));
    </script>
@endonce
