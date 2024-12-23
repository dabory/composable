{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-decimal-point-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary decimal-point-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="decimal-point-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SalesQtyPoint'] }}</label>
                                <input type="text" id="sales-qty-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SalesPrcPoint'] }}</label>
                                <input type="text" id="sales-prc-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SalesAmtPoint'] }}</label>
                                <input type="text" id="sales-amt-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PurchQtyPoint'] }}</label>
                                <input type="text" id="purch-qty-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PurchPrcPoint'] }}</label>
                                <input type="text" id="purch-prc-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PurchAmtPoint'] }}</label>
                                <input type="text" id="purch-amt-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px"><!--260-->
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['StockQtyPoint'] }}</label>
                                <input type="text" id="stock-qty-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['StockPrcPoint'] }}</label>
                                <input type="text" id="stock-prc-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['StockAmtPoint'] }}</label>
                                <input type="text" id="stock-amt-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px"><!--260-->
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AccAmtPoint'] }}</label>
                                <input type="text" id="acc-amt-point-txt" class="rounded w-100" autocomplete="off">
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
            $('.decimal-point-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormADecimalPointForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormADecimalPointForm, $, undefined ) {
            PopupSetupFormADecimalPointForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormADecimalPointForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#decimal-point-form #frm');
            }

            PopupSetupFormADecimalPointForm.btn_act_save = function () {
                if ( check_dom_input_number(['#sales-qty-point-txt', '#sales-prc-point-txt', '#sales-amt-point-txt',
                    '#purch-qty-point-txt', '#purch-prc-point-txt', '#purch-amt-point-txt',
                    '#stock-qty-point-txt', '#stock-prc-point-txt', '#stock-amt-point-txt',
                    '#acc-amt-point-txt']) ) return;

                Atype.set_parameter_callback(PopupSetupFormADecimalPointForm.parameter);

                Atype.btn_act_save('#decimal-point-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormADecimalPointForm');
            }

            PopupSetupFormADecimalPointForm.parameter = function () {
                let setup = {
                    SalesQtyPoint: Number($('#sales-qty-point-txt').val()),
                    SalesPrcPoint: Number($('#sales-prc-point-txt').val()),
                    SalesAmtPoint: Number($('#sales-amt-point-txt').val()),

                    PurchQtyPoint: Number($('#purch-qty-point-txt').val()),
                    PurchPrcPoint: Number($('#purch-prc-point-txt').val()),
                    PurchAmtPoint: Number($('#purch-amt-point-txt').val()),

                    StockQtyPoint: Number($('#stock-qty-point-txt').val()),
                    StockPrcPoint: Number($('#stock-prc-point-txt').val()),
                    StockAmtPoint: Number($('#stock-amt-point-txt').val()),

                    AccAmtPoint: Number($('#acc-amt-point-txt').val()),
                }
                let id = Number($('#decimal-point-form').find('#Id').val());
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

            PopupSetupFormADecimalPointForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#decimal-point-form #frm');
                $('#decimal-point-form').find('#Id').val(id)
                PopupSetupFormADecimalPointForm.set_coupon_ui(setup)
            }

            PopupSetupFormADecimalPointForm.set_coupon_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#sales-qty-point-txt').val(setup['SalesQtyPoint'])
                $('#sales-prc-point-txt').val(setup['SalesPrcPoint'])
                $('#sales-amt-point-txt').val(setup['SalesAmtPoint'])

                $('#purch-qty-point-txt').val(setup['PurchQtyPoint'])
                $('#purch-prc-point-txt').val(setup['PurchPrcPoint'])
                $('#purch-amt-point-txt').val(setup['PurchAmtPoint'])

                $('#stock-qty-point-txt').val(setup['StockQtyPoint'])
                $('#stock-prc-point-txt').val(setup['StockPrcPoint'])
                $('#stock-amt-point-txt').val(setup['StockAmtPoint'])

                $('#acc-amt-point-txt').val(setup['AccAmtPoint'])
            }

        }( window.PopupSetupFormADecimalPointForm = window.PopupSetupFormADecimalPointForm || {}, jQuery ));
    </script>
@endonce
