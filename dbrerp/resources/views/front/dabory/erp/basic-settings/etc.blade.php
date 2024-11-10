@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
<div class="content sales">
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
                    data-variable="squoteModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary squote-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'squote-act',
                    ])
                </div>
            </div>

            <div class="card" id="squote-form">
                <div class="card-header" id="frm">
                    <input type="hidden" id="Id" name="Id" value="0">

                    <div class="row">
                            <div class="col-md-6">
                                <div class="card card card-success mb-3 mb-md-0 border-light" style="height: 250px"><!--260-->
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <div class="d-flex align-items-center">
                                            @foreach($formB['SimpleSelectOptions'] as $key => $option)
                                                @empty($option['Caption'])
                                                @else
                                                    <input name="select-name" type="radio" id="" value="{{'select-name-'.$key+1}}" autocomplete="off">
                                                    <label for="{{'select-name-'.$key}}" class="m-0 mr-2">{{$option['Caption']}}</label>
                                                @endempty
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['SelectName'] }}</label>
                                            <select class="rounded w-100" id="delivery-select"
                                                    maxlength="{{ $formB['FormVars']['MaxLength']['SelectName'] }}"
                                                {{ $formB['FormVars']['Required']['SelectName'] }}></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="card-body p-0 mt-2 mx-2">
                    <div id="p-quote-eBody">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary mr-1" id="down-btn" onclick="override_seq_no_up_down('down')"
                                data-clicked="">▼
                            </button>
                            <button class="btn btn-primary mr-1" id="up-btn" onclick="override_seq_no_up_down('up')"
                                data-clicked="">▲
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary squote-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'squote-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row squote-table">
                                <thead id="squote-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="squote-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            @foreach ($formB['FooterVars']['Title'] as $key => $title)
                                <div class="d-flex align-items-stretch  flex-column  mb-2 mb-md-0 px-2">
                                    <label class="overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden'][$key] }}
                                        rowspan="1" colspan="1">
                                        {{ $title }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="{{ $key }}" disabled>
                                </div>
                            @endforeach
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

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.squote-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#squote-date').val(date_to_sting(new Date()))

            let sgroup_pick = await get_api_data('sgroup-pick', { Page: [ { Id:  parseInt(window.User['SgroupId']) } ] });
            window.User['SgroupName'] = sgroup_pick['data']['Page'][0]['SgroupName']

            slipInit = await Btype.get_slip_form_init()
            formB['SlipCommonSetup'] = slipInit['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(slipInit.DealTypePage)
            await Btype.create_vat_type_select_box_options(slipInit.VatRatePage)
            await create_etc_select_box_options(slipInit)

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                // slip-search cache 사용
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }
            }

            $('.squote-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#squote-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'copy-to-another': btn_act_copy_to_another(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': Btype.btn_act_del('#squote-form #frm'); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#squote-form #frm'); break;
                    case 'rpt-print': Btype.rpt_print(); break;
                    case 'rpt-custom': Btype.rpt_custom(); break;
                    case 'linked': btn_act_linked($(this).data('index')); break;
                }
            });

            $('.squote-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
                    case 'body-copy': btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                    case 'linked': btn_bd_act_linked($(this).data('index')); break;
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
                    Btype.call_bd_act_api([ { Id: Number(id), SquoteMemo: $(txtarea_id).val() } ], function () {
                        const index = bd_page.findIndex(bd => bd['Id'] === id)
                        bd_page[index].SquoteMemo = $(txtarea_id).val()

                        iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
                    })
                }
            });

            $('#squote-table-body').on('click', 'tr', function() {
                // Find the input element with name="bd-cursor-state" within the clicked row
                const $bdCursorStateInput = $(this).find('input[name="bd-cursor-state"]');
                if ($bdCursorStateInput.length) {
                    $($bdCursorStateInput).prop('checked', true)
                    Btype.bd_cursor_click($bdCursorStateInput)
                }
            });


            activate_button_group()
        }

        function btn_act_linked(index) {
            window.open(formB['HeadSelectOptions'][index]['Linked'], "_blank");
        }

        function btn_bd_act_linked(index) {
            window.open(formB['BodySelectOptions'][index]['Linked'], "_blank");
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
                BdTableName: 'dbr_squote_bd',
                HdIdName: 'squote_id',
                HdId: parseInt(bd.SquoteId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#squote-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        // start body act btn
        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.squote-table')
        }

        async function btn_bd_act_add() {
            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0 && formB['SlipCommonSetup']['IsAutoSaveHdByItemButton']) {
                if (! await Btype.btn_act_add_chain('#squote-form #frm')) { return }
            }

            if (! Btype.last_item_added_check('#squote-table-body')) {
                add_tr();
            }
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.squote-table')
        }

        function btn_bd_act_body_copy(parameter_name) {
            if (parseInt($('#frm').find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT copy in the status')),
                });
                return;
            }

            $(`#modal-bodycopy.${parameter_name}`).find('.slip_no-txt').val($('#auto-slip-no-txt').val())
            $(`#modal-bodycopy.${parameter_name}`).find('.company_name-txt').val($('#supplier-txt').val())

            let data = formB['BodySelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            $('.sales').find('.modal-btn').data('target', 'bodycopy')
            $('.sales').find('.modal-btn').data('variable', data['Parameter'])
            $('.sales').find('.modal-btn').data('class', parameter_name)
            $('.sales').find('.modal-btn').trigger('click')
            $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#auto-slip-no-txt').val() )
        }
        // end body act btn

        // start head act btn
        function btn_act_copy_to_another(parameter_name) {
            let data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            // $(`#modal-copy-to-another.${parameter_name}`).find('.target-slip-no-txt').data('slip-no', $('#auto-slip-no-txt').val())
            $(`#modal-copy-to-another.${parameter_name}`).find('.source-slip-no-txt').val($('#auto-slip-no-txt').val())
            $('.sales').find('.modal-btn').data('target', 'copy-to-another')
            $('.sales').find('.modal-btn').data('variable', data['Parameter'])
            $('.sales').find('.modal-btn').data('class', parameter_name)
            $('.sales').find('.modal-btn').trigger('click')
        }

        function bd_update_due_to_vat_rate_change() {
            let data = [];

            bd_page = bd_page.filter(function (bd) {
                return bd.Id != 0;
            });

            bd_page.forEach(bd => {
                let supply_amt, vat_amt, sum_amt;
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc({ pquote_prc: parseFloat(bd.SquotePrc), pquote_qty: parseFloat(bd.SquoteQty) },
                    parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));
                bd.SquoteSupply = supply_amt;
                bd.SquoteVat = vat_amt;
                bd.SquoteSum = sum_amt;

                data.push({
                    Id: parseInt(bd.Id),
                    SquoteSupply: String(bd.SquoteSupply),
                    SquoteVat: String(bd.SquoteVat),
                    SquoteSum: String(bd.SquoteSum),
                    Ip: window.User['Ip']
                })
            });
            return data;
        }

        function set_company_data_to_textbox(company) {
            get_supplier_id(company.Id)
            return $('.save-button')
        }

        function get_parameter() {
            const deal_name = slipInit['DealTypePage'].filter(page => page['Id'] === Number($('#deal-type-select').val()))[0]['DealName']
            const vat_rate = $('#vat-type-select').find('option:selected').data('vatrate')
            const vat_name = slipInit['VatRatePage'].filter(page => page['Id'] === Number($('#vat-type-select').val()))[0]['VatName']

            let first_item = ''
            if (bd_page.length > 0) {
                const first_squote = bd_page[0]
                first_item = first_squote['ItemCode'] + '_' + first_squote['ItemName']
                if (first_squote['SubName']) {
                    first_item += '_' + first_squote['SubName']
                }
                first_item += '(' + bd_page.length + ')'
            }
            const itmtot_amt = bd_page.reduce((accumulator, bd) => {
                return accumulator + parseFloat(bd.SquoteSupply)
            }, 0)
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                SquoteNo: $('#auto-slip-no-txt').val(),
                SquoteDate: moment(new Date($('#squote-date').val())).format('YYYYMMDD'),
                DealTypeId: parseInt($('#deal-type-select').val()),
                UserId: window.User['UserId'],
                SgroupId: window.User['SgroupId'],
                BranchId: window.User['BranchId'],
                BuyerId: parseInt($('#supplier-txt').data('id')),
                Input1: $('#input1-txt').val(),
                VatRateId: parseInt($('#vat-type-select').val()),
                CompanyContact: $('#supplier-txt').data('contact'),
                PayTerms: $('#payTerms-select').val(),
                PayPeriod: '',
                Destination: '',
                Delivery: $('#delivery-select').val(),
                VaildPeriod: $('#vaild-period-select').val(),
                Status: $('#status-select').val(),
                // IsClosed: String($('#status-select').data('closed')),
                IsClosed: '0',
                Column1: $('#column1-select').val(),
                Column2: $('#column2-select').val(),
                Remarks: $('#remarks-txt-area').val(),

                FirstItem: first_item,
                ItmtotAmt: String(itmtot_amt),
                DiscountAmt: '0',
                TotalAmt: String(Number(itmtot_amt) - 0),

                DealName: deal_name,
                VatRate: vat_rate,
                VatName: vat_name,
                SgroupName: window.User['SgroupName'],

                Ip: window.User['Ip']
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter;
        }

        function data_init() {
            bd_page = [];
            $(`#frm`).find(`input[name="Id"]`).val(0)
            $('.save-button').prop('disabled', false)

            $('#auto-slip-no-txt').val('')
            $('#input1-txt').val('')
            Btype.set_slip_no_btn_abled()
            $('#squote-date').val(date_to_sting(new Date()))
            $('#supplier-txt').val('')
            $('#supplier-txt').data('id', 0)
            $('#supplier-txt').data('contact', '')

            select_box_first_selected('#deal-type-select')
            select_box_first_selected('#vat-type-select')
            $('#vat-type-select').trigger('change');

            select_box_first_selected('#delivery-select')
            select_box_first_selected('#payTerms-select')
            select_box_first_selected('#column1-select')
            select_box_first_selected('#column2-select')

            $('#remarks-txt-area').val('')
            $('#remarks-preview').html('')
            select_box_first_selected('#status-select')
            $('#status-select').data('closed', 0)

            // table body 초기화
            table_head_check_box_reset('#squote-table-head')
            $('#squote-table-body').html('')

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

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no('squote');
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function override_amt_calc_txt_is_changed() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let supply_amt, vat_amt, sum_amt;

            Btype.amt_calc_txt_is_changed(tr, function (bd) {
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));

                if (isNaN(bd.pquote_prc)) return;

                $(tr).children('td:eq(6)').find('input').val(format_conver_for(bd.pquote_qty, formB.ListVars['Format'].SquoteQty))
                $(tr).children('td:eq(7)').find('input').val(format_conver_for(bd.pquote_prc, formB.ListVars['Format'].SquotePrc))

                $(tr).children('td:eq(8)').find('input').val(format_conver_for(supply_amt, formB.ListVars['Format'].SupplyAmt))
                $(tr).children('td:eq(9)').find('input').val(format_conver_for(vat_amt, formB.ListVars['Format'].VatAmt))
                $(tr).children('td:eq(10)').find('input').val(format_conver_for(sum_amt, formB.ListVars['Format'].SumAmt))

                bd_page[index].SquotePrc = bd.pquote_prc
                bd_page[index].SquoteQty = bd.pquote_qty
                bd_page[index].SquoteSupply = supply_amt
                bd_page[index].SquoteVat = vat_amt
                bd_page[index].SquoteSum = sum_amt
            })
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

        async function create_etc_select_box_options(data) {
            // let delivery = create_options(await get_select_box_options_data('etc-page', 'select_name="납품기한"'))
            // let payTerms = create_options(await get_select_box_options_data('etc-page', 'select_name="지불조건"'))
            // let column1 = create_options(await get_select_box_options_data('etc-page', 'select_name="공란1"'))
            // let column2 = create_options(await get_select_box_options_data('etc-page', 'select_name="공란2"'))

            let delivery = create_options(data.EtcDeliveryPage)
            let payTerms = create_options(data.EtcPayTermPage)
            let column1 = create_options(data.EtcColumn1Page)
            let column2 = create_options(data.EtcColumn2Page)
            let valid_period = create_options(data.EtcValidPeriodPage)

            $('#delivery-select').html(delivery);
            $('#payTerms-select').html(payTerms);
            $('#column1-select').html(column1);
            $('#column2-select').html(column2);
            $('#vaild-period-select').html(valid_period);
        }

        function amt_total_calc() {
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;

            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.SquoteQty);
                supply_total += parseFloat(bd.SquoteSupply);
                vat_amt_vat_total += parseFloat(bd.SquoteVat);
                sum_total += parseFloat(bd.SquoteSum);
            })

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].SquoteQty));
            $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
            $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
        }

        function get_bd_parameter(bd) {
            // let discount_rate = Btype.discount_rate_calc(parseInt(minusComma(bd.SalesPrc)) * parseInt(minusComma(bd.PquoteQty)), parseInt(bd.PquoteSum));
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                SquoteId: parseInt(bd.SquoteId),
                SeqNo: bd.SeqNo,
                CrtUserId: window.User['UserId'],
                UpdUserId: window.User['UserId'],
                ItemId: parseInt(bd.ItemId),
                SquoteQty: String(bd.SquoteQty),
                SquotePrc: String(bd.SquotePrc),
                SquoteSupply: String(bd.SquoteSupply),
                SquoteVat: String(bd.SquoteVat),
                SquoteSum: String(bd.SquoteSum),
                // DiscountRate: String(discount_rate),
                SquoteMemo: bd.SquoteMemo,
                Ip: window.User['Ip']
            }

            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
                delete parameter.CrtUserId;
            } else {
                delete parameter.UpdatedOn;
                delete parameter.UpdUserId;
            }
            return parameter;
        }

        function override_custom_supply_amt_or_vat_amt() {
            Btype.custom_supply_amt_or_vat_amt(function (supply_amt, vat_amt, sum_amt, index) {
                bd_page[index].SquoteSupply = supply_amt
                bd_page[index].SquoteVat = vat_amt
                bd_page[index].SquoteSum = sum_amt
            })
        }

        function override_custom_sum_amt() {
            Btype.custom_sum_amt(function (sum_amt, index) {
                bd_page[index].SquoteSum = sum_amt
            })
        }

        function create_bd_page() {
            let html = []
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.SquoteQty);
                supply_total += parseFloat(bd.SquoteSupply);
                vat_amt_vat_total += parseFloat(bd.SquoteVat);
                sum_total += parseFloat(bd.SquoteSum);

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
                        class="text-${formB.ListVars['Align'].SquoteQty}" ${formB.ListVars['Hidden'].SquoteQty}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SquoteQty} border-0 bg-white" value="${format_conver_for(bd.SquoteQty, formB.ListVars['Format'].SquoteQty)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SquotePrc}" ${formB.ListVars['Hidden'].SquotePrc}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SquotePrc} border-0 bg-white" value="${format_conver_for(bd.SquotePrc, formB.ListVars['Format'].SquotePrc)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" value="${format_conver_for(bd.SquoteSupply, formB.ListVars['Format'].SupplyAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" value="${format_conver_for(bd.SquoteVat, formB.ListVars['Format'].VatAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                        class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.SquoteSum, formB.ListVars['Format'].SumAmt)}" readonly
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_sum_amt()"
                        required>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SalesPrc}" ${formB.ListVars['Hidden'].SalesPrc}>${format_conver_for(bd.SalesPrc, formB.ListVars['Format'].SalesPrc)}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SquoteMemo}" ${formB.ListVars['Hidden'].SquoteMemo}>
                        <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea" id="memo-textarea-${bd.Id}"
                            ondblclick="Btype.dblclick_memo_textarea(this, ${bd.Id})" role="button" readonly>${bd.SquoteMemo}</textarea>
                    </td>
                </tr>` )
            });

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].SquoteQty));
            $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
            $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));

            document.getElementById('squote-table-body').innerHTML = html.join('');

            // $('#squote-table-body').html(html);
        }

        async function add_td_last_tap_out($this, id) {
            Btype.btn_act_save('#squote-form #frm', async function () {
                let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
                if (bd_page[index].ItemId != 0 && ! dom_required_check($(tr).find(`input`))) {
                    if ($($this).data('last')) {
                        let seq_no = await Btype.get_last_seq_no('squote', $('#auto-slip-no-txt').val())
                        bd_page[index].SeqNo = seq_no;
                    }

                    bd_page[index].SquoteId = $(`#frm`).find(`input[name="Id"]`).val();
                    Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                        bd_page[index].Id = page[0].Id;

                        Btype.body_act_success_callback($this, tr);
                        Btype.check_the_checkbox_when_changing($this, false)
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('(*)Required item(s) omitted')),
                    });
                }
            });

        }

        function set_item_data_to_textbox(item) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).children('td:eq(2)').find('input').val(item.ItemCode)
            $(tr).children('td:eq(3)').find('input').val(item.ItemName)
            $(tr).children('td:eq(4)').text(item.SubName)
            $(tr).children('td:eq(5)').text(item.CountUnit)
            $(tr).children('td:eq(6)').find('input').val(1)
            $(tr).children('td:eq(7)').find('input').val(parseFloat(item.PurchPrc).toFixed(window.User['PurchPrcPoint']))
            $(tr).children('td:eq(11)').text(parseFloat(item.SalesPrc).toFixed(window.User['PurchPrcPoint']))

            let index = $(tr).prevAll().length
            bd_page[index].ItemId = item.Id
            bd_page[index].ItemCode = item.ItemCode
            bd_page[index].ItemName = item.ItemName
            bd_page[index].SubName = item.SubName
            bd_page[index].CountUnit = item.CountUnit
            bd_page[index].SquotePrc = item.PurchPrc
            bd_page[index].SalesPrc = item.SalesPrc

            if (bd_page[index].Id === 0) {
                $(tr).children('td:eq(12)').find('textarea').val(item.ItemMemo)
                bd_page[index].SquoteMemo = item.ItemMemo
            }
            // override_amt_calc_txt_is_changed();

            return $(tr).children('td:eq(6)').find('input')
        }

        async function add_tr() {
            let last_bd_id_inc = 0;
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html = `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0" ${formB.ListVars['Hidden'].$Radio}>
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Radio}"
                    id="bd-cursor-state-${last_bd_id_inc}"
                    onclick="Btype.bd_cursor_click(this)">
                </td>
                <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check"
                    class="text-${formB.ListVars['Align'].$Check}"
                    type="checkbox" value="1" tabindex="-1">
                </td>
                <td onkeydown="Btype.enterPressedinCell(event)" class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].ItemCode}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    id="item-code-${last_bd_id_inc}" required>
                </td>
                <td onkeydown="Btype.enterPressedinCell(event, 2)" class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].ItemName}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    required>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SquoteQty}" ${formB.ListVars['Hidden'].SquoteQty}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SquoteQty}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_amt_calc_txt_is_changed()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SquotePrc}" ${formB.ListVars['Hidden'].SquotePrc}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SquotePrc}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_amt_calc_txt_is_changed()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_supply_amt_or_vat_amt()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].VatAmt}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_supply_amt_or_vat_amt()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)" data-last=true onfocusout="add_td_last_tap_out(this, ${last_bd_id_inc})"
                    class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].SumAmt}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_custom_sum_amt()"
                    required>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SalesPrc}" ${formB.ListVars['Hidden'].SalesPrc}>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SquoteMemo}" ${formB.ListVars['Hidden'].SquoteMemo}>
                    <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                        ondblclick="Btype.dblclick_memo_textarea(this, ${last_bd_id_inc})" id="memo-textarea-${last_bd_id_inc}" role="button" readonly></textarea>
                </td>
            </tr>`;
            $('#squote-table-body').append(html)

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
                SquoteId: parseInt($(`#frm`).find(`input[name="Id"]`).val()),
                SquotePrc: 0,
                SquoteQty: 0,
                SquoteSupply: 0,
                SquoteVat: 0,
                SquoteSum: 0,
                SalesPrc: 0,
                SquoteMemo: '',
            })
        }

        function update_hd_ui(response) {
            // console.log(response)
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            $("#Id").val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.SquoteNo)
            $('#squote-date').val(moment(to_date(hd_page.SquoteDate)).format('YYYY-MM-DD'))
            $('#supplier-txt').val(hd_page.CompanyName)
            $('#supplier-txt').data('id', hd_page.BuyerId)
            $('#supplier-txt').data('contact', hd_page.CompanyContact)
            $('#input1-txt').val(hd_page.Input1)

            $('#deal-type-select').val(hd_page.DealTypeId)
            $('#vat-type-select').val(hd_page.VatRateId)
            $('#vaild-period-select').val(hd_page.VaildPeriod)
            // $('#vat-type-select').trigger('change')
            set_vat_type_rate('#vat-type-select', false);

            $('#delivery-select').val(hd_page.Delivery)
            $('#payTerms-select').val(hd_page.PayTerms)
            $('#column1-select').val(hd_page.Column1)
            $('#column2-select').val(hd_page.Column2)

            $('#remarks-preview').html(hd_page.Remarks)
            $('#remarks-txt-area').val(hd_page.Remarks)
            $('#status-select').val(hd_page.Status)

            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
        let slipInit = null;
    </script>
@endsection
