{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-shop-address-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary shop-address-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="shop-address-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" zip-code="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ZipCode'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        <input class="rounded w-100 radius-r0" type="text" id="zip-code-txt" disabled>
                                        <button type="button" onclick="PopupSetupFormAShopAddressForm.get_zip_code()" tabindex="-1"
                                                class="btn-dark rounded border-0 radius-l0 col-4">
                                            <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Addr1'] }}</label>
                                <input type="text" id="addr1-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Addr2'] }}</label>
                                <input type="text" id="addr2-txt" class="rounded w-100" autocomplete="off">
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
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        $(document).ready(async function() {
            $('.shop-address-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAShopAddressForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAShopAddressForm, $, undefined ) {
            PopupSetupFormAShopAddressForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAShopAddressForm.get_zip_code = function() {
                new daum.Postcode({
                    oncomplete: function(data) {
                        $('#shop-address-form').find('#zip-code-txt').val(data.zonecode)
                        $('#shop-address-form').find('#addr1-txt').val(data.roadAddress)
                    }
                }).open();
            }

            PopupSetupFormAShopAddressForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#shop-address-form #frm');
            }

            PopupSetupFormAShopAddressForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAShopAddressForm.parameter);

                Atype.btn_act_save('#shop-address-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAShopAddressForm');
            }

            PopupSetupFormAShopAddressForm.parameter = function () {
                const form = $('#shop-address-form')

                let setup = {
                    ZipCode: $(form).find('#zip-code-txt').val(),
                    Addr1: $(form).find('#addr1-txt').val(),
                    Addr2: $(form).find('#addr2-txt').val(),
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

            PopupSetupFormAShopAddressForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-shop-address-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#shop-address-form #frm');
                $('#shop-address-form').find('#Id').val(id)

                PopupSetupFormAShopAddressForm.set_ui(setup)
            }

            PopupSetupFormAShopAddressForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#shop-address-form')

                $(form).find('#zip-code-txt').val(setup['ZipCode'])
                $(form).find('#addr1-txt').val(setup['Addr1'])
                $(form).find('#addr2-txt').val(setup['Addr2'])
            }

        }( window.PopupSetupFormAShopAddressForm = window.PopupSetupFormAShopAddressForm || {}, jQuery ));
    </script>
@endonce
