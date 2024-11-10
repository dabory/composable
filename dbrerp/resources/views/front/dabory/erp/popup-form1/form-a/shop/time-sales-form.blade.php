{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary time-sales-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'time-sales-act',
        ])
    </div>
</div>

<div class="card mb-2" id="time-sales-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TimeSalesNo'] }}</label>
                            <input type="text" id="time-sales-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TimeSalesNo'] }}"
                                {{ $formA['FormVars']['Required']['TimeSalesNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SalesDate'] }}</label>
                            <input class="rounded w-100" type="date" value="" id="sales-date"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SalesDate'] }}"
                                {{ $formA['FormVars']['Required']['SalesDate'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['ItemId'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ItemId'] }}</label>
                            <input type="text" id="item-name-txt" class="w-100 rounded mb-1" disabled>
                            <input type="hidden" id="item-id-txt">
                            <button type="button" id="item-modal-btn"
                                    class="btn btn-success btn-open-modal"
                                    data-target="item"
                                    data-class="basic"
                                    data-clicked="PopupForm1FormAShopTimeSalesForm.fetch_item"
                                    data-variable="PopupForm1FormAShopTimeSalesForm.itemModal">
                                아이템 찾기
                            </button>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TimePrice'] }}</label>
                            <input type="text" id="time-price-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TimePrice'] }}"
                                {{ $formA['FormVars']['Required']['TimePrice'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['StartOn'] }}</label>
                            <div class="d-flex">
                                <input class="rounded w-100 mr-1" type="date" id="start-date"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['StartOn'] }}"
                                    {{ $formA['FormVars']['Required']['StartOn'] }}>
                                <input class="rounded w-100" type="time" id="start-time"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['StartOn'] }}"
                                    {{ $formA['FormVars']['Required']['StartOn'] }}>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['EndOn'] }}</label>
                            <div class="d-flex">
                                <input class="rounded w-100 mr-1" type="date" id="end-date"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['EndOn'] }}"
                                    {{ $formA['FormVars']['Required']['EndOn'] }}>
                                <input class="rounded w-100" type="time" id="end-time"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['EndOn'] }}"
                                    {{ $formA['FormVars']['Required']['EndOn'] }}>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-status-check"> <label class="mb-0" for="is-status-check">{{ $formA['FormVars']['Title']['Status'] }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-main-page-on-check"> <label class="mb-0" for="is-main-page-on-check">{{ $formA['FormVars']['Title']['MainPageOn'] }}</label>
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
                $('.time-sales-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAShopTimeSalesForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAShopTimeSalesForm.btn_act_del(); break;
                    }
                });

                PopupForm1FormAShopTimeSalesForm.include_blades()
                activate_button_group()
            });

            (function( PopupForm1FormAShopTimeSalesForm, $, undefined ) {
                PopupForm1FormAShopTimeSalesForm.formA = {!! json_encode($formA) !!};
                PopupForm1FormAShopTimeSalesForm.itemModal

                PopupForm1FormAShopTimeSalesForm.include_blades = async function() {
                    const item = await get_para_data('modal', '/search/item-search/item')
                    PopupForm1FormAShopTimeSalesForm.itemModal = item['data']

                    get_blades_html('front.outline.static.item', PopupForm1FormAShopTimeSalesForm.itemModal, function (html) {
                        if ($('#element_in_which_to_insert').find('#modal-item').length) {
                            html = html.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
                        }
                        $('#element_in_which_to_insert').append(html);
                    }, 'moealSetFile', { modalClassName: 'basic' });
                }

                PopupForm1FormAShopTimeSalesForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-shop-time-sales-form .modal-header').removeClass('bg-grey-700 px-0')
                    $('#modal-select-popup.popup-form1-form-a-shop-time-sales-form .modal-header').addClass('bg-original-purple')
                    $('#modal-select-popup.popup-form1-form-a-shop-time-sales-form .modal-dialog').css('maxWidth', '600px');

                    Atype.set_parameter_callback(PopupForm1FormAShopTimeSalesForm.parameter);
                    Atype.btn_act_new('#time-sales-form #frm');

                    const $item_sales_form = $('#time-sales-form')
                    $($item_sales_form).find('#start-date').val(moment(new Date()).format('YYYY-MM-DD'))
                    $($item_sales_form).find('#start-time').val('00:00:00')
                    $($item_sales_form).find('#end-date').val(moment(new Date()).format('YYYY-MM-DD'))
                    $($item_sales_form).find('#end-time').val('00:00:00')
                }

                PopupForm1FormAShopTimeSalesForm.btn_act_new_callback = function () {
                    PopupForm1FormAShopTimeSalesForm.btn_act_new()
                }

                PopupForm1FormAShopTimeSalesForm.call_item_pick = async function(page) {
                    return await get_api_data('item-pick', {
                        ImageType: 'thumb',
                        Page: page
                    })
                }

                PopupForm1FormAShopTimeSalesForm.fetch_item = async function (id) {
                    const response = await PopupForm1FormAShopTimeSalesForm.call_item_pick([ { Id: id } ])
                    const item = response.data.Page[0]
                    $('#time-sales-form').find('#item-name-txt').val(item.ItemName)
                    $('#time-sales-form').find('#item-id-txt').val(item.Id)
                    $('#modal-item.basic').modal('hide')
                }

                PopupForm1FormAShopTimeSalesForm.parameter = function () {
                    const $item_sales_form = $('#time-sales-form')
                    let id = Number($($item_sales_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        TimeSalesNo: $($item_sales_form).find('#time-sales-no-txt').val(),
                        SalesDate: moment(new Date($('#sales-date').val())).format('YYYYMMDD'),
                        ItemId: Number($($item_sales_form).find('#item-id-txt').val()),
                        TimePrice: $($item_sales_form).find('#time-price-txt').val(),
                        StartOn: get_time_stamp_for(new Date($('#start-date').val() + ' ' + $('#start-time').val())),
                        EndOn: get_time_stamp_for(new Date($('#end-date').val() + ' ' + $('#end-time').val())),
                        Status: $($item_sales_form).find('#is-status-check:checked').val() ?? '0',
                        MainPageOn: $($item_sales_form).find('#is-main-page-on-check:checked').val() ?? '0',
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

                PopupForm1FormAShopTimeSalesForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopTimeSalesForm.parameter);
                    Atype.btn_act_save('#time-sales-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopTimeSalesForm');
                }

                PopupForm1FormAShopTimeSalesForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopTimeSalesForm.parameter);
                    Atype.btn_act_del('#time-sales-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopTimeSalesForm');
                }

                PopupForm1FormAShopTimeSalesForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAShopTimeSalesForm.btn_act_new()
                    await PopupForm1FormAShopTimeSalesForm.fetch_menu(Number(id));
                }

                PopupForm1FormAShopTimeSalesForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormAShopTimeSalesForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAShopTimeSalesForm.set_ui(response)
                }

                PopupForm1FormAShopTimeSalesForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let item_sales = response.data.Page[0];

                    const $item_sales_form = $('#time-sales-form')

                    $($item_sales_form).find('#Id').val(item_sales.Id)

                    $($item_sales_form).find('#time-sales-no-txt').val(item_sales.TimeSalesNo)
                    $($item_sales_form).find('#sales-date').val(moment(to_date(item_sales.SalesDate)).format('YYYY-MM-DD'))
                    PopupForm1FormAShopTimeSalesForm.fetch_item(item_sales.ItemId)
                    $($item_sales_form).find('#time-price-txt').val(item_sales.TimePrice)
                    $($item_sales_form).find('#start-date').val(moment(new Date(item_sales.StartOn * 1000)).format('YYYY-MM-DD'))
                    $($item_sales_form).find('#start-time').val(moment(new Date(item_sales.StartOn * 1000)).format('HH:mm:ss'))
                    $($item_sales_form).find('#end-date').val(moment(new Date(item_sales.EndOn * 1000)).format('YYYY-MM-DD'))
                    $($item_sales_form).find('#end-time').val(moment(new Date(item_sales.EndOn * 1000)).format('HH:mm:ss'))

                    $($item_sales_form).find('#is-status-check').prop('checked', item_sales.Status == '1')
                    $($item_sales_form).find('#is-main-page-on-check').prop('checked', item_sales.MainPageOn == '1')
                }

            }( window.PopupForm1FormAShopTimeSalesForm = window.PopupForm1FormAShopTimeSalesForm || {}, jQuery ));
        </script>
    @endpush
@endonce
