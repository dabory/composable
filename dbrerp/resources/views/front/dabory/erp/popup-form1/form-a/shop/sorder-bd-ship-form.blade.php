{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary sorder-bd-ship-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'sorder-bd-ship-act',
        ])
    </div>
</div>

<div class="card mb-2" id="sorder-bd-ship-form">
    <div class="card-header" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ShipDate'] }}</label>
                            <input type="date" id="ship-date" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ShipDate'] }}"
                                {{ $formA['FormVars']['Required']['ShipDate'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CourierCode'] }}</label>
                            <input type="text" id="courier-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CourierCode'] }}"
                                {{ $formA['FormVars']['Required']['CourierCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['InvoiceNo'] }}</label>
                            <input type="text" id="invoice-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['InvoiceNo'] }}"
                                {{ $formA['FormVars']['Required']['InvoiceNo'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select id="sort-select" class="rounded w-100"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                                @forelse ($codeTitle['sort']['sorder_bd_ship'] ?? [] as $key => $sort)
                                    <option value="{{ $sort['Code'] }}">
                                        {{ $sort['Title'] }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select id="status-select" class="rounded w-100"
                                {{ $formA['FormVars']['Required']['Status'] }}>
                                @forelse ($codeTitle['status']['sorder_bd_ship'] ?? [] as $key => $status)
                                    <option value="{{ $status['Code'] }}">
                                        {{ $status['Title'] }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ShipDesc'] }}</label>
                            <textarea style="height: 85px" id="ship-desc-textarea" maxlength="{{ $formA['FormVars']['MaxLength']['ShipDesc'] }}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#modal-select-popup.popup-form1-form-a-shop-sorder-bd-ship-form').on('shown.bs.modal', function (e) {
                const id = Number($('#sorder-bd-ship-form').find('#Id').val())
                if (id === 0) {
                    $('#modal-select-popup.show').modal('hide')
                    return iziToast.error({
                        title: 'Error', message: '배송장 Batch Upload 처리를 먼저 해주세요',
                    })
                }
            })

            $('.sorder-bd-ship-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAShopSorderBdShipForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAShopSorderBdShipForm.btn_act_del(); break;
                }
            });
        });

        (function( PopupForm1FormAShopSorderBdShipForm, $, undefined ) {
            PopupForm1FormAShopSorderBdShipForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAShopSorderBdShipForm.btn_act_new = function () {
                $('#modal-select-popup.popup-form1-form-a-shop-sorder-bd-ship-form .modal-dialog').css('maxWidth', '600px')

                Atype.set_parameter_callback(PopupForm1FormAShopSorderBdShipForm.parameter)
                Atype.btn_act_new('#sorder-bd-ship-form #frm')

                $('#sorder-bd-ship-form').find('#ship-date').val(date_to_sting(new Date()))
            }

            PopupForm1FormAShopSorderBdShipForm.btn_act_new_callback = function () {
                PopupForm1FormAShopSorderBdShipForm.btn_act_new()
            }

            PopupForm1FormAShopSorderBdShipForm.parameter = function () {
                const sorder_bd_ship_form = $('#sorder-bd-ship-form')

                const id = Number($(sorder_bd_ship_form).find('#Id').val())
                let parameter = {
                    Id: id,
                    ShipDate: moment(new Date($(sorder_bd_ship_form).find('#ship-date').val())).format('YYYYMMDD'),
                    CourierCode: $(sorder_bd_ship_form).find('#courier-code-txt').val(),
                    InvoiceNo: $(sorder_bd_ship_form).find('#invoice-no-txt').val(),
                    Sort: $(sorder_bd_ship_form).find('#sort-select').val(),
                    Status: $(sorder_bd_ship_form).find('#status-select').val(),
                    ShipDesc: $(sorder_bd_ship_form).find('#ship-desc-textarea').val(),
                }
                if (id < 0) {
                    parameter = { Id: id }
                }

                // console.log(parameter)
                return parameter;
            }

            PopupForm1FormAShopSorderBdShipForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAShopSorderBdShipForm.parameter);
                Atype.btn_act_save('#sorder-bd-ship-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAShopSorderBdShipForm');
            }

            PopupForm1FormAShopSorderBdShipForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAShopSorderBdShipForm.parameter);
                Atype.btn_act_del('#sorder-bd-ship-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAShopSorderBdShipForm');
            }

            PopupForm1FormAShopSorderBdShipForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAShopSorderBdShipForm.btn_act_new()

                $('#sorder-bd-ship-form').find('#Id').val(id)
                const sorder_bd_ship_id = Number(id)
                if (sorder_bd_ship_id !== 0) {
                    await PopupForm1FormAShopSorderBdShipForm.fetch_sorder_bd_ship(Number(id));
                }
            }

            PopupForm1FormAShopSorderBdShipForm.fetch_sorder_bd_ship = async function (id) {
                const response = await get_api_data(PopupForm1FormAShopSorderBdShipForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })
                // console.log(response)

                PopupForm1FormAShopSorderBdShipForm.set_sorder_bd_ship(response)
            }

            PopupForm1FormAShopSorderBdShipForm.set_sorder_bd_ship = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const sorder_bd_ship = response.data.Page[0];
                const sorder_bd_ship_form = $('#sorder-bd-ship-form')
                // console.log(sorder_bd_ship)

                // $(sorder_bd_ship_form).find('#Id').val(sorder_bd_ship.Id)

                $(sorder_bd_ship_form).find('#ship-date').val(moment(to_date(sorder_bd_ship.ShipDate)).format('YYYY-MM-DD'))
                $(sorder_bd_ship_form).find('#courier-code-txt').val(sorder_bd_ship.CourierCode)
                $(sorder_bd_ship_form).find('#invoice-no-txt').val(sorder_bd_ship.InvoiceNo)
                $(sorder_bd_ship_form).find('#sort-select').val(sorder_bd_ship.Sort)
                $(sorder_bd_ship_form).find('#status-select').val(sorder_bd_ship.Status)
                $(sorder_bd_ship_form).find('#ship-desc-textarea').val(sorder_bd_ship.ShipDesc)
            }

        }( window.PopupForm1FormAShopSorderBdShipForm = window.PopupForm1FormAShopSorderBdShipForm || {}, jQuery ));
    </script>
@endpush
@endonce
