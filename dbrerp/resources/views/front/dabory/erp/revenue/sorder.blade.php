@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content revenue">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal window item-modal-btn"
                    data-target="item"
                    data-clicked="Btype.get_item_id"
                    data-variable="itemModal">
                </button>

                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="sorderModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary sorder-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'sorder-act',
                    ])
                </div>
            </div>

            <div class="card" id="sorder-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="Id" name="Id" value="0">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                        <div class="col-12 d-flex p-0">
                                        {{-- <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"--}}
                                        {{-- onclick="get_last_slip_no(this)">--}}
                                        {{--  <span class="icon-cogs"></span>--}}
                                        {{--    </button>--}}
                                            <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                                {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                        <input class="rounded w-100" type="date" value="" id="sorder-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                            {{ $formB['FormVars']['Required']['Date'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['Buyer'] }}</label>
                                        <div class="d-flex">
                                            <input type="hidden" id="seller-id-txt" value="1">
                                            <input type="text" id="buyer-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                            onkeydown="company_model_show_cell_enter_key(event, '')"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Buyer'] }}"
                                                {{ $formB['FormVars']['Required']['Buyer'] }}>
                                            <button type="button"
                                                class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window company-modal-btn"
                                                data-target="company"
                                                data-clicked="get_override_supplier_id"
                                                data-variable="companyModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['BuyerContact'] }}</label>
                                        <input class="rounded w-100" id="buyer-contact-txt" type="text"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['BuyerContact'] }}"
                                            {{ $formB['FormVars']['Required']['BuyerContact'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['DealType'] }}</label>
                                        <select class="rounded w-100" id="deal-type-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['DealType'] }}"
                                            {{ $formB['FormVars']['Required']['DealType'] }}>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['VatType'] }}</label>
                                        <select class="rounded w-100" id="vat-type-select" onchange="set_vat_type_rate(this)"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['VatType'] }}"
                                            {{ $formB['FormVars']['Required']['VatType'] }}>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['VatTypeRate'] }}</label>
                                        <input type="text" id="vat-type-rate-text" class="rounded w-100" autocomplete="off" value="" disabled
                                               maxlength="{{ $formB['FormVars']['MaxLength']['VatTypeRate'] }}"
                                            {{ $formB['FormVars']['Required']['VatTypeRate'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column ">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="status-select" onchange="Btype.set_is_closed_val(this)"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                            {{ $formB['FormVars']['Required']['Status'] }}>
                                            @foreach ($codeTitle['status']['sorder'] as $key => $status)
                                                <option value="{{ $status['Code'] }}">
                                                    {{ $status['Title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Delivery'] }}</label>
                                        <select class="rounded w-100" id="delivery-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Delivery'] }}"
                                            {{ $formB['FormVars']['Required']['Delivery'] }}></select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['PayTerms'] }}</label>
                                        <select class="rounded w-100" id="payTerms-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['PayTerms'] }}"
                                            {{ $formB['FormVars']['Required']['PayTerms'] }}></select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Destination'] }}</label>
                                        <select class="rounded w-100" id="destination-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Destination'] }}"
                                            {{ $formB['FormVars']['Required']['Destination'] }}></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">기타</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Remarks'] }}</label>
                                        <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                                        <div class="fr-view" id="remarks-preview" hidden></div>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['IsClosed'] }}</label>
                                        <input class="rounded" type="checkbox" id="is-closed-check" value="1"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['IsClosed'] }}"
                                            {{ $formB['FormVars']['Required']['IsClosed'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['SgroupName'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="sgroup-id-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['SgroupName'] }}"
                                            {{ $formB['FormVars']['Required']['SgroupName'] }}>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['UserName'] }}</label>
                                        <input class="rounded w-100" type="text" id="user-txt" disabled
                                               maxlength="{{ $formB['FormVars']['MaxLength']['UserName'] }}"
                                            {{ $formB['FormVars']['Required']['UserName'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 mt-2 mx-2">
                    <div id="">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary mr-1" id="down-btn" onclick="override_seq_no_up_down('down')"
                                data-clicked="">▼
                            </button>
                            <button class="btn btn-primary mr-1" id="up-btn" onclick="override_seq_no_up_down('up')"
                                data-clicked="">▲
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary sorder-bd-act disabled-if-saved" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'sorder-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row sorder-table">
                                <thead id="sorder-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="sorder-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['StorageName'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['StorageName'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded text-left" id="StorageName" disabled>
                                </div>
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['BranchName'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['BranchName'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded text-left" id="BranchName" disabled>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-md-row">
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['QtyTotal'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['QtyTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="QtyTotal" disabled>
                                </div>
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SupplyTotal'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['SupplyTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="SupplyTotal" disabled>
                                </div>
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['VatTotal'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['VatTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="VatTotal" disabled>
                                </div>
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SumTotal'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['SumTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="SumTotal" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@foreach ($formB['HeadSelectOptions'] as $selectOption)
    @if (! empty($selectOption['Parameter']))
        @push('modal')
            @include($selectOption['BladeRoute'], [
                'moealSetFile' => $selectOption['Parameter'],
                'modalClassName' => $selectOption['ModalClassName']
            ])
        @endpush
    @endif
@endforeach

@foreach ($formB['BodySelectOptions'] as $selectOption)
    @if (! empty($selectOption['Parameter']))
        @push('modal')
            @include($selectOption['BladeRoute'], [
                'moealSetFile' => $selectOption['Parameter'],
                'modalClassName' => $selectOption['ModalClassName']
            ])
        @endpush
    @endif
@endforeach

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $sorderModal])
    @include('front.outline.static.company', ['moealSetFile' => $companyModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.company-modal-btn').on('click', function() {
                if(!checkModalOpen(this)){
                    return false;
                }
            });
        });
        window.onload = async function () {
            ThumbArr = [];
            //await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
            make_dynamic_table_css('.sorder-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#sorder-date').val(date_to_sting(new Date()))

            Btype.get_storage_name_and_branch_name()
            // let data = await Btype.get_slip_form_init()
            slipInit = @json($slipFormInitCacheData);
            // console.log('slipInit : ', slipInit);
            formB['SlipCommonSetup'] = slipInit['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(slipInit.DealTypePage)
            await Btype.create_vat_type_select_box_options(slipInit.VatRatePage)
            await Btype.create_sgroup_select_box_options(slipInit.SgroupPage)
            await create_etc_select_box_options(slipInit)
            $('#user-txt').val(window.User['NickName'])

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                // slip-search cache 사용
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }
            }

            $('#sorder-table-body').on('click', 'tr', function() {
                // Find the input element with name="bd-cursor-state" within the clicked row
                const $bdCursorStateInput = $(this).find('input[name="bd-cursor-state"]');
                if ($bdCursorStateInput.length) {
                    $($bdCursorStateInput).prop('checked', true)
                    Btype.bd_cursor_click($bdCursorStateInput)
                }
            });

            $('.sorder-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#sorder-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#sorder-form #frm'); break;
                    case 'copy-to-another': btn_act_copy_to_another(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': Btype.btn_act_del('#sorder-form #frm'); break;
                }
            });

            $('.sorder-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
                    case 'body-copy': btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                    case 'multi-update': override_btn_bd_act_multi_update(); break;
                }
            });

            $('#remarks-txt-area').on('dblclick', function () {
                $('#modal-memo2').find('#memo-textarea').val('')
                $('#modal-memo2').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo2').find('#memo-textarea').val($('#remarks-txt-area').val())
                $('#modal-memo2').modal('show');
            });

            $(document).on('complete.memo2', '#modal-memo2', function (e, txtarea_id, id) {
                if (txtarea_id !== '#remarks-txt-area') {
                    Btype.call_bd_act_api([ { Id: Number(id), SorderMemo: $(txtarea_id).val() } ], function () {
                        const index = bd_page.findIndex(bd => bd['Id'] === id)
                        bd_page[index].SorderMemo = $(txtarea_id).val()

                        iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
                    })
                }
            });

            activate_button_group()
        }

        function set_company_data_to_textbox(company) {
            get_override_supplier_id(company.Id)
            return $('.save-button')
        }

        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.sorder-table')
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.sorder-table')
        }

        async function override_seq_no_up_down(move) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let bd = bd_page[index]

            if (isEmpty(bd) || parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT move UP or DOWN in the status')),
                });
                return;
            }

            let data = {
                BdTableName: 'dbr_sorder_bd',
                HdIdName: 'sorder_id',
                HdId: parseInt(bd.SorderId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#sorder-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        function save_data_when_entering_text() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            bd_page[index].ConfirmDate = $(tr).children('td:eq(12)').find('input').val()
            bd_page[index].DeliDate = $(tr).children('td:eq(13)').find('input').val()
            bd_page[index].Ref1 = $(tr).children('td:eq(14)').find('input').val()
            bd_page[index].Ref2 = $(tr).children('td:eq(15)').find('input').val()
        }

        function get_bd_parameter(bd) {
            let discount_rate = Btype.discount_rate_calc(parseInt(minusComma(bd.CurrSalesPrc)) * parseInt(minusComma(bd.SorderQty)), parseInt(bd.SorderSum));
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                SorderId: parseInt(bd.SorderId),
                SeqNo: bd.SeqNo,
                ItemId: parseInt(bd.ItemId),
                SorderQty: String(bd.SorderQty),
                salesBalQty : String(bd.SorderQty),
                SorderPrc: String(bd.SorderPrc),
                SorderSupply: String(bd.SorderSupply),
                SorderVat: String(bd.SorderVat),
                SorderSum: String(bd.SorderSum),
                DiscountRate: String(discount_rate),
                CurrPurchPrc: String(bd.CurrPurchPrc),
                CurrSalesPrc: String(bd.CurrSalesPrc),
                ConfirmDate: isEmpty(bd.ConfirmDate) ? '' : moment(bd.ConfirmDate).format('YYYYMMDD'),
                DeliDate: isEmpty(bd.DeliDate) ? '' : moment(bd.DeliDate).format('YYYYMMDD'),
                Ref1: bd.Ref1,
                Ref2: bd.Ref2,
                SorderMemo: bd.SorderMemo,
                IsEnd: bd.IsEnd,
                Ip: window.User['Ip']
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

        function amt_total_calc() {
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;

            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.SorderQty);
                supply_total += parseFloat(bd.SorderSupply);
                vat_amt_vat_total += parseFloat(bd.SorderVat);
                sum_total += parseFloat(bd.SorderSum);
            })

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].SorderQty));
            $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
            $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
        }

        async function add_td_last_tap_out($this, id) {
            // Btype.btn_act_save('#sorder-form #frm', async function () {
                let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
                if (bd_page[index].ItemId != 0 && ! dom_required_check($(tr).find(`input`))) {
                    if ($($this).data('last')) {
                        let seq_no = await Btype.get_last_seq_no('sorder', $('#auto-slip-no-txt').val())
                        bd_page[index].SeqNo = seq_no;
                    }

                    Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                        bd_page[index].Id = page[0].Id;
                        body_act_success_callback($this, tr);
                        Btype.check_the_checkbox_when_changing($this, false)
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('(*)Required item(s) omitted')),
                    });
                }
                scrollToTop();
            // });
        }

        function body_act_success_callback($this, tr) {
            // 합계 계산
            amt_total_calc();

            let qty = $(tr).children('td:eq(6)').find('input')
            let prc = $(tr).children('td:eq(7)').find('input')
            let supply_amt = $(tr).children('td:eq(8)').find('input')
            let vat_amt = $(tr).children('td:eq(9)').find('input')
            let sum_amt = $(tr).children('td:eq(10)').find('input')
            let std_purch_price = $(tr).children('td:eq(11)')

            $(qty).val( format_conver_for(minusComma($(qty).val()), formB.ListVars['Format'].SorderQty) )
            $(prc).val( format_conver_for(minusComma($(prc).val()), formB.ListVars['Format'].SorderPrc) )
            $(supply_amt).val( format_conver_for(minusComma($(supply_amt).val()), formB.ListVars['Format'].SupplyAmt) )
            $(vat_amt).val( format_conver_for(minusComma($(vat_amt).val()), formB.ListVars['Format'].VatAmt) )
            $(sum_amt).val( format_conver_for(minusComma($(sum_amt).val()), formB.ListVars['Format'].SumAmt) )
            $(std_purch_price).text( format_conver_for(minusComma($(std_purch_price).text()), formB.ListVars['Format'].SorderPrc) )

            if ($($this).data('last')) {
                add_tr();
                $($this).data('last', false)
            }
            iziToast.success({ title: 'Success', message: $('#action-completed').text() });
        }

        // start body act btn
        async function btn_bd_act_add() {
            // if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0 && formB['SlipCommonSetup']['IsAutoSaveHdByItemButton']) {
            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                if (! await Btype.btn_act_add_chain('#sorder-form #frm')) { return }
            }

            if (! Btype.last_item_added_check('#sorder-table-body')) {
                add_tr();
            }
        }

        function btn_bd_act_body_copy(parameter_name) {
            Btype.btn_act_save('#sorder-form #frm', async function () {
                if (parseInt($('#frm').find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT copy in the status')),
                });
                return;
            }

            if (parameter_name.split('-')[1] !== formB['QueryVars']['QueryName']) {
                $(`#modal-bodycopy.${parameter_name}`).find('.auto-create-slip-checked').prop('checked', true)
            }

            $(`#modal-bodycopy.${parameter_name}`).find('.slip_no-txt').val($('#auto-slip-no-txt').val())
            $(`#modal-bodycopy.${parameter_name}`).find('.company_name-txt').val($('#buyer-txt').val())

            let data = formB['BodySelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            $('.revenue').find('.modal-btn').data('target', 'bodycopy')
            $('.revenue').find('.modal-btn').data('variable', data['Parameter'])
            $('.revenue').find('.modal-btn').data('class', parameter_name)
            $('.revenue').find('.modal-btn').trigger('click')
            $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#auto-slip-no-txt').val() )
            });
        }
        //

        function btn_act_copy_to_another(parameter_name) {
            let data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            // $(`#modal-copy-to-another.${parameter_name}`).find('.target-slip-no-txt').data('slip-no', $('#auto-slip-no-txt').val())
            $(`#modal-copy-to-another.${parameter_name}`).find('.source-slip-no-txt').val($('#auto-slip-no-txt').val())

            $('.revenue').find('.modal-btn').data('target', 'copy-to-another')
            $('.revenue').find('.modal-btn').data('variable', data['Parameter'])
            $('.revenue').find('.modal-btn').data('class', parameter_name)
            $('.revenue').find('.modal-btn').trigger('click')
        }

        function data_init() {
            bd_page = [];
            $(`#frm`).find(`input[name="Id"]`).val(0)
            $('.save-button').prop('disabled', false)

            $('#auto-slip-no-txt').val('')
            Btype.set_slip_no_btn_abled()
            $('#sorder-date').val(date_to_sting(new Date()))
            $('#buyer-txt').val('')
            $('#buyer-txt').data('id', 0)
            $('#buyer-txt').data('contact', '')
            $('#buyer-contact-txt').val('')

            select_box_first_selected('#deal-type-select')
            select_box_first_selected('#vat-type-select')
            $('#vat-type-select').trigger('change');
            select_box_first_selected('#status-select')
            $('#status-select').data('closed', 0)

            select_box_first_selected('#sgroup-id-select')
            select_box_first_selected('#delivery-select')
            select_box_first_selected('#payTerms-select')
            select_box_first_selected('#destination-select')
            $('#ref-no-txt').val('')

            $('#remarks-txt-area').val('')
            $('#remarks-preview').html('')

            $('#buyer-txt').prop('readonly', false);

            $('#is-closed-check').prop('checked', false)
            // select_box_first_selected('#is-closed-select')
            $('.company-modal-btn').removeClass('disabled');

            select_box_first_selected('#our-contact-select')

            // table body 초기화
            table_head_check_box_reset('#sorder-table-head')
            $('#sorder-table-body').html('');

            // footer 합계 초기화
            $('#QtyTotal').val('')
            $('#SupplyTotal').val('')
            $('#VatTotal').val('')
            $('#SumTotal').val('')
        }

        function btn_act_new() {
            data_init()

            if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                get_last_slip_no()
            }
        }

        function get_parameter() {
            const deal_name = slipInit['DealTypePage'].filter(page => page['Id'] === Number($('#deal-type-select').val()))[0]['DealName']
            const vat_rate = $('#vat-type-select').find('option:selected').data('vatrate')
            const vat_name = slipInit['VatRatePage'].filter(page => page['Id'] === Number($('#vat-type-select').val()))[0]['VatName']
            let first_item = ''
            let first_thumb= ''
            if (bd_page.length > 0) {
                const first_sorder = bd_page[0]

                first_item = first_sorder['ItemCode'] + '_' + first_sorder['ItemName']
                if (first_sorder['SubName']) {
                    first_item += '_' + first_sorder['SubName']
                }
                // first_item += '(' + bd_page.length + ')'

                if(first_sorder['TurboThumb']){
                    first_thumb = first_sorder['TurboThumb']
                }
            }
            const itmtot_amt = bd_page.reduce((accumulator, bd) => {
                return accumulator + parseFloat(bd.SorderSupply) + parseFloat(bd.SorderVat) // 합계금액 (공급가액 + 세액)
            }, 0)

            const total_qty = bd_page.reduce((accumulator, bd) => {
                return accumulator + parseFloat(bd.SorderQty)
            }, 0)

            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                SorderNo: $('#auto-slip-no-txt').val(),
                IsPro: '0',
                SorderDate: moment(new Date($('#sorder-date').val())).format('YYYYMMDD'),
                DealTypeId: parseInt($('#deal-type-select').val()),
                UserId: window.User['UserId'],
                SgroupId: parseInt($('#sgroup-id-select').val()),
                BranchId: window.User['BranchId'],
                StorageId: window.User['StorageId'],
                BuyerId: parseInt($('#buyer-txt').data('id')),
                SellerId: parseInt($('#seller-id-txt').val()),
                VatRateId: parseInt($('#vat-type-select').val()),
                BuyerContact: $('#buyer-txt').data('contact'),
                PayTerms: $('#payTerms-select').val(),
                Destination: $('#destination-select').val(),
                Delivery: $('#delivery-select').val(),
                Status: $('#status-select').val(),
                IsClosed: $('#is-closed-check:checked').val() ?? '0',
                Remarks: $('#remarks-txt-area').val(),
                Ip: window.User['Ip'],

                FirstItem: first_item,
                ItmtotAmt: String(itmtot_amt),
                DiscountAmt: '0',
                TotalAmt: String(Number(itmtot_amt) - 0),
                DealName: deal_name,
                VatRate: vat_rate,
                VatName: vat_name,
                SgroupName: window.User['SgroupName'],
                TotalQty : String(Number(total_qty) - 0)
            }

            if (first_thumb && first_thumb !== "") {
                parameter.FirstThumb = first_thumb;
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

        async function get_last_slip_no() {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }


        async function get_override_supplier_id(company_id) {
            await get_local_supplier_id(company_id, '#buyer-txt');
        }

        async function get_local_supplier_id(supplier_id, dom_val = '#supplier-txt') {
            let response = await get_api_data('company-pick', {
                Page : [
                    {Id: Number(supplier_id) }
                ]
            })

            if (response.data.Page) {
                const company = response.data.Page[0];
                $(dom_val).data('id', company.Id);
                $(dom_val).val(company.CompanyName);
                $(dom_val).data('contact', company.MainContact);

                $('#buyer-contact-txt').val($('#buyer-txt').data('contact'))
                $('#seller-id-txt').val(company.SellerId)

                $('#modal-company.show').modal('hide');

                return company
            }



        }

        async function create_etc_select_box_options(data) {
            let delivery = create_options(data.EtcDeliveryPage)
            let payTerms = create_options(data.EtcPayTermPage)
            let destination = create_options(data.EtcDestinationPage)

            $('#delivery-select').html(delivery);
            $('#payTerms-select').html(payTerms);
            $('#destination-select').html(destination);
        }

        function bd_update_due_to_vat_rate_change() {
            let data = [];

            bd_page = bd_page.filter(function (bd) {
                return bd.Id != 0;
            });

            bd_page.forEach(bd => {
                let supply_amt, vat_amt, sum_amt;
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc({ pquote_prc: parseFloat(bd.SorderPrc), pquote_qty: parseFloat(bd.SorderQty) },
                    parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));
                bd.SorderSupply = supply_amt;
                bd.SorderVat = vat_amt;
                bd.SorderSum = sum_amt;

                data.push({
                    Id: parseInt(bd.Id),
                    SorderSupply: String(bd.SorderSupply),
                    SorderVat: String(bd.SorderVat),
                    SorderSum: String(bd.SorderSum),
                    Ip: window.User['Ip']
                })
            });
            return data;
        }

        function set_vat_type_rate($this, msg = true) {
            let vate_rate = $($this).find('option:selected').data('viewvatrate');
            $('#vat-type-rate-text').val(vate_rate + '%')

            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0 || ! msg) return;
            Btype.call_act_api(get_parameter(), function() { });

            if (isEmpty(bd_page)) return;

            let data = bd_update_due_to_vat_rate_change();
            Btype.call_bd_act_api(data, function() {
                create_bd_page();
            })
        }

        function override_amt_calc_txt_is_changed() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let supply_amt, vat_amt, sum_amt;

            Btype.amt_calc_txt_is_changed(tr, function (bd) {
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));

                if (isNaN(bd.pquote_prc)) return;

                $(tr).children('td:eq(6)').find('input').val(format_conver_for(bd.pquote_qty, formB.ListVars['Format'].SorderQty))
                $(tr).children('td:eq(7)').find('input').val(format_conver_for(bd.pquote_prc, formB.ListVars['Format'].SorderPrc))

                $(tr).children('td:eq(8)').find('input').val(format_conver_for(supply_amt, formB.ListVars['Format'].SupplyAmt))
                $(tr).children('td:eq(9)').find('input').val(format_conver_for(vat_amt, formB.ListVars['Format'].VatAmt))
                $(tr).children('td:eq(10)').find('input').val(format_conver_for(sum_amt, formB.ListVars['Format'].SumAmt))

                bd_page[index].SorderPrc = bd.pquote_prc
                bd_page[index].SorderQty = bd.pquote_qty
                bd_page[index].SorderSupply = supply_amt
                bd_page[index].SorderVat = vat_amt
                bd_page[index].SorderSum = sum_amt
            })
        }

        function override_custom_supply_amt_or_vat_amt() {
            Btype.custom_supply_amt_or_vat_amt(function (supply_amt, vat_amt, sum_amt, index) {
                bd_page[index].SorderSupply = supply_amt
                bd_page[index].SorderVat = vat_amt
                bd_page[index].SorderSum = sum_amt
            })
        }

        function override_custom_sum_amt() {
            Btype.custom_sum_amt(function (sum_amt, index) {
                bd_page[index].SorderSum = sum_amt
            })
        }

        function create_bd_page() {
            let html = []
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.SorderQty);
                supply_total += parseFloat(bd.SorderSupply);
                vat_amt_vat_total += parseFloat(bd.SorderVat);
                sum_total += parseFloat(bd.SorderSum);

                // 품목코드, 수량, 단가, 공급가액, 세액, 합계금액
                html.push (
                `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0" ${formB.ListVars['Hidden'].$Radio}>
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event)"
                        class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" value="${bd.ItemCode}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)" required>
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event, 2)"
                        class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" value="${bd.ItemName}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)" required>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>${bd.SubName}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>${bd.CountUnit}
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SorderQty}" ${formB.ListVars['Hidden'].SorderQty}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SorderQty} border-0 bg-white" value="${format_conver_for(bd.SorderQty, formB.ListVars['Format'].SorderQty)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SorderPrc}" ${formB.ListVars['Hidden'].SorderPrc}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SorderPrc} border-0 bg-white" value="${format_conver_for(bd.SorderPrc, formB.ListVars['Format'].SorderPrc)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" value="${format_conver_for(bd.SorderSupply, formB.ListVars['Format'].SupplyAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" value="${format_conver_for(bd.SorderVat, formB.ListVars['Format'].VatAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.SorderSum, formB.ListVars['Format'].SumAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_sum_amt()"
                        required>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].CurrSalesPrc}" ${formB.ListVars['Hidden'].CurrSalesPrc}>${format_conver_for(bd.CurrSalesPrc, formB.ListVars['Format'].CurrSalesPrc)}
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].ConfirmDate}" ${formB.ListVars['Hidden'].ConfirmDate}
                        >
                        <input type="date" class="text-${formB.ListVars['Align'].ConfirmDate} border-0 bg-white" value="${isEmpty(bd.ConfirmDate) ? '' : moment(bd.ConfirmDate).format('YYYY-MM-DD')}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()">
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].DeliDate}" ${formB.ListVars['Hidden'].DeliDate}
                        >
                        <input type="date" class="text-${formB.ListVars['Align'].DeliDate} border-0 bg-white" value="${isEmpty(bd.DeliDate) ? '' : moment(bd.DeliDate).format('YYYY-MM-DD')}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white" value="${bd.Ref1}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                        class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white" value="${bd.Ref2}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()">
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SorderMemo}" ${formB.ListVars['Hidden'].SorderMemo}>
                        <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea" id="memo-textarea-${bd.Id}"
                            ondblclick="Btype.dblclick_memo_textarea(this, ${bd.Id})" role="button" readonly>${bd.SorderMemo}</textarea>
                    </td>
                </tr>` )
            });

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].SorderQty));
            $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
            $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));

            document.getElementById('sorder-table-body').innerHTML = html.join('');
            // $('#sorder-table-body').html(html);
        }

        async function add_tr() {
            let last_bd_id_inc = 0;
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html =
            `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0"  ${formB.ListVars['Hidden'].$Radio}>
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Radio}"
                    id="bd-cursor-state-${last_bd_id_inc}"
                    onclick="Btype.bd_cursor_click(this)">
                </td>
                <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.enterPressedinCell(event)"
                    class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    id="item-code-${last_bd_id_inc}" required>
                </td>
                <td onkeydown="Btype.enterPressedinCell(event, 2)"
                    class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)" required>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SorderQty}" ${formB.ListVars['Hidden'].SorderQty}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SorderQty} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_amt_calc_txt_is_changed()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SorderPrc}" ${formB.ListVars['Hidden'].SorderPrc}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SorderPrc} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_amt_calc_txt_is_changed()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_supply_amt_or_vat_amt()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_supply_amt_or_vat_amt()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_sum_amt()"
                    required>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].CurrSalesPrc}" ${formB.ListVars['Hidden'].CurrSalesPrc}>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].ConfirmDate}" ${formB.ListVars['Hidden'].ConfirmDate}
                    >
                    <input type="date" class="text-${formB.ListVars['Align'].ConfirmDate} border-0 bg-white" readonly
                    value="${moment().format('YYYY-MM-DD')}"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>

                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].DeliDate}" ${formB.ListVars['Hidden'].DeliDate}
                    >
                    <input type="date" class="text-${formB.ListVars['Align'].DeliDate} border-0 bg-white" readonly
                    value="${moment().format('YYYY-MM-DD')}"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    data-last=true onfocusout="add_td_last_tap_out(this, ${last_bd_id_inc})"
                    class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white" readonly
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SorderMemo}" ${formB.ListVars['Hidden'].SorderMemo}>
                    <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                        ondblclick="Btype.dblclick_memo_textarea(this, ${last_bd_id_inc})" id="memo-textarea-${last_bd_id_inc}" role="button" readonly></textarea>
                </td>
            </tr>`;

            $('#sorder-table-body').append(html)

            await setTimeout( function() {
                $(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                $(`#item-code-${last_bd_id_inc}`).focus()
            }, 100);

            bd_page.push({
                cursorId: last_bd_id_inc,
                Id: 0,
                ItemId: 0,
                ItemCode: '',
                ItemName: '',
                SubName: '',
                CountUnit: '',
                SeqNo: 0,
                SorderId: parseInt($(`#frm`).find(`input[name="Id"]`).val()),
                SorderPrc: 0,
                SorderQty: 0,
                SorderSupply: 0,
                SorderVat: 0,
                SorderSum: 0,
                CurrPurchPrc: 0,
                CurrSalesPrc: 0,
                IsEnd: '0',
                DeliDate: '',
                ConfirmDate: '',
                Ref1: '',
                Ref2: '',
                SorderMemo: '',
            })
        }

        function set_item_data_to_textbox(item) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).children('td:eq(2)').find('input').val(item.ItemCode)
            $(tr).children('td:eq(3)').find('input').val(item.ItemName)
            $(tr).children('td:eq(4)').text(item.SubName)
            $(tr).children('td:eq(5)').text(item.CountUnit)
            $(tr).children('td:eq(6)').find('input').val()
            $(tr).children('td:eq(7)').find('input').val(parseFloat(item.SalesPrc).toFixed(window.User['SalesPrcPoint']))
            $(tr).children('td:eq(11)').text(parseFloat(item.SalesPrc).toFixed(window.User['SalesPrcPoint']))

            let index = $(tr).prevAll().length;
            bd_page[index].ItemId = item.Id
            bd_page[index].ItemCode = item.ItemCode
            bd_page[index].ItemName = item.ItemName
            bd_page[index].SubName = item.SubName
            bd_page[index].CountUnit = item.CountUnit
            bd_page[index].SorderPrc = item.SalesPrc
            bd_page[index].CurrPurchPrc = item.PurchPrc
            bd_page[index].CurrSalesPrc = item.SalesPrc// override_amt_calc_txt_is_changed();

            if (ThumbArr.length === 0) { // item 받아왔을 때만 bd_page에 TurboThumb 저장
                bd_page[index].TurboThumb = item.TurboThumb
            }

            if (bd_page[index].Id === 0) {
                $(tr).children('td:eq(16)').find('textarea').val(item.ItemMemo)
                bd_page[index].SorderMemo = item.ItemMemo
            }

            return $(tr).children('td:eq(6)').find('input')
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            if(response.data.HdPage[0]['FirstThumb'] !== ""){
                ThumbArr = response.data.HdPage[0]['FirstThumb']
            }

            $('#Id').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.SorderNo)
            $('#sorder-date').val(moment(to_date(hd_page.SorderDate)).format('YYYY-MM-DD'))
            $('#buyer-txt').val(hd_page.CompanyName)
            $('#buyer-txt').data('id', hd_page.BuyerId)
            $('#buyer-txt').data('contact', hd_page.BuyerContact)

            // 저장된 데이터 불러올 경우 고객업체 비활성화
            $('#buyer-contact-txt').val(hd_page.BuyerContact)
            $('#seller-id-txt').val(hd_page.SellerId)
            disabledmenu(hd_page);

            $('#deal-type-select').val(hd_page.DealTypeId)
            $('#vat-type-select').val(hd_page.VatRateId)
            // $('#vat-type-select').trigger('change')
            set_vat_type_rate('#vat-type-select', false);
            $('#status-select').val(hd_page.Status)

            $('#delivery-select').val(hd_page.Delivery)
            $('#payTerms-select').val(hd_page.PayTerms)
            $('#destination-select').val(hd_page.Destination)

            $('#remarks-txt-area').val(hd_page.Remarks)
            $('#remarks-preview').html(hd_page.Remarks)
            $('#is-closed-check').prop('checked', hd_page.IsClosed == '1')

            $('#sgroup-id-select').val(hd_page.SgroupId)

            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        function scrollToTop() {
            var scrollArea = document.getElementById("scroll-area");
            scrollArea.scrollTop = 0;
        }

        function disabledmenu(hd_page) {
            const isCompanySaved = hd_page.CompanyName !== "";
            $('#buyer-txt').prop('readonly',  isCompanySaved)
            $('.company-modal-btn').toggleClass('disabled', isCompanySaved);
        }

        function checkModalOpen(element) {
            const $this = $(element);
            const auto_slip_no = $('#auto-slip-no-txt').val();

            // 전표번호가 비어 있을 경우
            if (!auto_slip_no) {
                iziToast.warning({
                    title: "warning",
                    message: "저장>추가 버튼을 클릭하여 새 전표번호로 시작하세요."
                });
                return false;
            }
            // disabled인 경우
            if ($this.hasClass('disabled')) {
                let msg = "저장된 해당정보는 변경할 수 없으며 전표 삭제만 가능합니다.";
                if ($this.hasClass('disabled-if-saved')) { // 항목추가인 경우
                    msg = "연관 전표번호가 있을경우 연관복사로만 추가가 가능합니다.";
                }
                iziToast.warning({
                    title: "warning",
                    message: msg
                });
                return false;
            }
            return true;
        }

        const sorderModal = {!! json_encode($sorderModal) !!};
        const companyModal = {!! json_encode($companyModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
        let slipInit = null;
    </script>
@endsection
