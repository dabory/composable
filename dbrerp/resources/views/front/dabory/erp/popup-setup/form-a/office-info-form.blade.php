{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-office-info-form">
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
    <div class="card mb-2" id="office-info-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcCode'] }}</label>
                                <input type="text" id="ofc-code-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcName'] }}</label>
                                <input type="text" id="ofc-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcTaxNo'] }}</label>
                                <input type="text" id="ofc-tax-no-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcEmail'] }}</label>
                                <input type="text" id="ofc-email-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcTelNo'] }}</label>
                                <input type="text" id="ofc-tel-no-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcFaxNo'] }}</label>
                                <input type="text" id="ofc-fax-no-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcDomainUrl'] }}</label>
                                <input type="text" id="ofc-domain-url-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcMobile'] }}</label>
                                <input type="text" id="ofc-mobile-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcPresident'] }}</label>
                                <input type="text" id="ofc-president-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcAddr1'] }}</label>
                                <div class="d-flex">
                                    <input type="text" id="ofc-address1-txt" class="rounded w-100" autocomplete="off">
                                    <button type="button" onclick="PopupSetupFormAOfficeInfoForm.get_zip_code(this)" tabindex="-1"
                                            class="btn-dark rounded border-0 radius-l0 col-4">
                                        <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcAddr2'] }}</label>
                                <input type="text" id="ofc-address2-txt" class="rounded w-100" autocomplete="off"
                                onfocusout="PopupSetupFormAOfficeInfoForm.ofc_address2_focusout(event)">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcPlace'] }}</label>
                                <input type="text" id="ofc-place-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcZipCode'] }}</label>
                                <input type="text" id="ofc-zip-code-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcXCoordinate'] }}</label>
                                <input type="text" id="ofc-x-coordinate-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcYCoordinate'] }}</label>
                                <input type="text" id="ofc-y-coordinate-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcBizType'] }}</label>
                                <input type="text" id="ofc-biz-type-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OfcDealItem'] }}</label>
                                <input type="text" id="ofc-deal-item-txt" class="rounded w-100" autocomplete="off">
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
                    case 'save': PopupSetupFormAOfficeInfoForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAOfficeInfoForm, $, undefined ) {
            PopupSetupFormAOfficeInfoForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAOfficeInfoForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#office-info-form #frm');
            }

            PopupSetupFormAOfficeInfoForm.ofc_address2_focusout = function (event) {
                $('#office-info-form').find('#ofc-place-txt').val( $(event.target).val() )
            }

            PopupSetupFormAOfficeInfoForm.get_zip_code = function () {
                new daum.Postcode({
                    oncomplete: function(data) {
                        $('#office-info-form').find('#ofc-address1-txt').val(data.roadAddress)
                        $('#office-info-form').find('#ofc-zip-code-txt').val(data.zonecode)

                        var geocoder = new kakao.maps.services.Geocoder();

                        const { address } = data;
                        geocoder.addressSearch(address, (result, status) => {
                            const { x, y } = result[0];

                            $('#office-info-form').find('#ofc-x-coordinate-txt').val(x)
                            $('#office-info-form').find('#ofc-y-coordinate-txt').val(y)
                        });
                    }
                }).open();
            }

            PopupSetupFormAOfficeInfoForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAOfficeInfoForm.parameter);

                Atype.btn_act_save('#office-info-form #frm', async function () {
                    const response = await get_api_data('update-office-host', {
                        Page: [
                            { ...PopupSetupFormAOfficeInfoForm.request_data(), Id: 0 }
                        ]
                    })

                    console.log(response)
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAOfficeInfoForm');
            }

            PopupSetupFormAOfficeInfoForm.request_data = function () {
                const office_info_form = $('#office-info-form')

                return {
                    OfcCode: $(office_info_form).find('#ofc-code-txt').val(),
                    OfcPlace: $(office_info_form).find('#ofc-place-txt').val(),
                    OfcName: $(office_info_form).find('#ofc-name-txt').val(),
                    OfcTaxNo: $(office_info_form).find('#ofc-tax-no-txt').val(),
                    OfcEmail: $(office_info_form).find('#ofc-email-txt').val(),
                    OfcTelNo: $(office_info_form).find('#ofc-tel-no-txt').val(),
                    OfcFaxNo: $(office_info_form).find('#ofc-fax-no-txt').val(),

                    OfcDomainUrl: $(office_info_form).find('#ofc-domain-url-txt').val(),
                    OfcMobile: $(office_info_form).find('#ofc-mobile-txt').val(),
                    OfcZipCode: $(office_info_form).find('#ofc-zip-code-txt').val(),
                    OfcPresident: $(office_info_form).find('#ofc-president-txt').val(),
                    OfcAddr1: $(office_info_form).find('#ofc-address1-txt').val(),
                    OfcAddr2: $(office_info_form).find('#ofc-address2-txt').val(),
                    OfcXCoordinate: $(office_info_form).find('#ofc-x-coordinate-txt').val(),
                    OfcYCoordinate: $(office_info_form).find('#ofc-y-coordinate-txt').val(),
                    OfcBizType: $(office_info_form).find('#ofc-biz-type-txt').val(),
                    OfcDealType: $(office_info_form).find('#ofc-deal-item-txt').val(),
                }
            }

            PopupSetupFormAOfficeInfoForm.parameter = function () {
                const office_info_form = $('#office-info-form')
                let setup = PopupSetupFormAOfficeInfoForm.request_data()
                let id = Number($(office_info_form).find('#Id').val());
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

            PopupSetupFormAOfficeInfoForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#office-info-form #frm');
                $('#office-info-form').find('#Id').val(id)
                PopupSetupFormAOfficeInfoForm.set_ui(setup)
            }

            PopupSetupFormAOfficeInfoForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const office_info_form = $('#office-info-form')

                $(office_info_form).find('#ofc-code-txt').val(setup['OfcCode'])
                $(office_info_form).find('#ofc-place-txt').val(setup['OfcPlace'])
                $(office_info_form).find('#ofc-name-txt').val(setup['OfcName'])
                $(office_info_form).find('#ofc-tax-no-txt').val(setup['OfcTaxNo'])
                $(office_info_form).find('#ofc-email-txt').val(setup['OfcEmail'])
                $(office_info_form).find('#ofc-tel-no-txt').val(setup['OfcTelNo'])
                $(office_info_form).find('#ofc-fax-no-txt').val(setup['OfcFaxNo'])

                $(office_info_form).find('#ofc-domain-url-txt').val(setup['OfcDomainUrl'])
                $(office_info_form).find('#ofc-mobile-txt').val(setup['OfcMobile'])
                $(office_info_form).find('#ofc-zip-code-txt').val(setup['OfcZipCode'])
                $(office_info_form).find('#ofc-president-txt').val(setup['OfcPresident'])
                $(office_info_form).find('#ofc-address1-txt').val(setup['OfcAddr1'])
                $(office_info_form).find('#ofc-address2-txt').val(setup['OfcAddr2'])
                $(office_info_form).find('#ofc-x-coordinate-txt').val(setup['OfcXCoordinate'])
                $(office_info_form).find('#ofc-y-coordinate-txt').val(setup['OfcYCoordinate'])
                $(office_info_form).find('#ofc-biz-type-txt').val(setup['OfcBizType'])
                $(office_info_form).find('#ofc-deal-item-txt').val(setup['OfcDealItem'])
            }

        }( window.PopupSetupFormAOfficeInfoForm = window.PopupSetupFormAOfficeInfoForm || {}, jQuery ));
    </script>
@endonce
