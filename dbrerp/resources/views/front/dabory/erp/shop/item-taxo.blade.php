@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
<div class="content shop">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right d-flex justify-content-between align-items-center">
                <div class="text-danger cache-refl-text">
                    캐시삭제(반영)
                </div>

                <div>
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
                            data-variable="itemTaxoModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary item-taxo-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'item-taxo-act',
                        ])
                    </div>
                </div>
            </div>

            <div class="card" id="item-taxo-form">
                <div class="card-header" id="frm">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card card-primary mb-3 mb-md-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="Id" name="Id" value="0">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                            <select class="rounded w-100" id="auto-slip-no-select" onchange="Btype.change_auto_slip_no_select(this)"
                                                {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                                @foreach($formB['SlipNoOptions'] as $option)
                                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                                @endforeach
                                                <option value="input">직접입력</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['DirectInput'] }}</label>
                                            <input class="rounded w-100" type="text" id="direct-input-txt" onchange="Btype.change_direct_input_txt(this)">
                                        </div>
                                        <div class="d-none">
                                            <input class="rounded w-100" type="text" id="auto-slip-no-txt" required>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                            <input class="rounded w-100" type="date" value="" id="item-taxo-date"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                                {{ $formB['FormVars']['Required']['Date'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card card-info mb-3 mb-md-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['TaxoName'] }}</label>
                                            <input type="text" id="taxo-name-txt" class="rounded w-100" autocomplete="off" value=""
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['TaxoName'] }}"
                                                {{ $formB['FormVars']['Required']['TaxoName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaSize'] }}</label>
                                            <input type="text" id="media-size-txt" class="rounded w-100" autocomplete="off" value=""
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['MediaSize'] }}"
                                                {{ $formB['FormVars']['Required']['MediaSize'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Remarks'] }}</label>
                                            <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                                            <div class="fr-view" id="remarks-preview" hidden></div>
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
                                <button class="btn btn-sm btn-primary item-taxo-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'item-taxo-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row item-taxo-table">
                                <thead id="item-taxo-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="item-taxo-table-body">
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

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $itemTaxoModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.item-taxo-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#item-taxo-date').val(date_to_sting(new Date()))

            $('.item-taxo-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#item-taxo-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'delete': Btype.btn_act_del('#item-taxo-form #frm'); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#item-taxo-form #frm'); break;
                }
            });

            $('.item-taxo-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
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

            Btype.change_auto_slip_no_select($('#auto-slip-no-select'))
            activate_button_group()
        }

        async function override_seq_no_up_down(move) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let bd = bd_page[index]

            if (isEmpty(bd) || parseInt($(`#frm`).find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT move UP or DOWN in the status')),
                });
                return;
            }

            let data = {
                BdTableName: 'pro_item_taxo_bd',
                HdIdName: 'item_taxo_id',
                HdId: parseInt(bd.ItemTaxoId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#item-taxo-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        // start body act btn
        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.item-taxo-table')
        }

        async function btn_bd_act_add() {
            if (parseInt($(`#frm`).find('#Id').val()) == 0) {
                if (! await Btype.btn_act_add_chain('#item-taxo-form #frm')) { return }
            }

            if (! Btype.last_item_added_check('#item-taxo-table-body')) {
                add_tr();
            }
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.item-taxo-table')
        }

        function get_parameter() {
            let id = parseInt($(`#frm`).find('#Id').val())
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                ItemTaxoNo: $('#auto-slip-no-txt').val(),
                TaxoName: $('#taxo-name-txt').val(),
                MediaSize: $('#media-size-txt').val(),
                TaxoDate: moment(new Date($('#item-taxo-date').val())).format('YYYYMMDD'),
                UserId: window.User['UserId'],
                BranchId: window.User['BranchId'],
                Remarks: $('#remarks-txt-area').val(),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter
        }

        function data_init() {
            bd_page = [];
            $(`#frm`).find('#Id').val(0)
            $('.save-button').prop('disabled', false)

            input_box_reset_for('#frm')
            $('#item-taxo-date').val(date_to_sting(new Date()))

            $('#remarks-txt-area').val('')
            $('#remarks-preview').html('')

            // slip no 초기화
            Btype.exist_slip_no_type(formB['SlipNoOptions'][0]['Value'])

            // table body 초기화
            table_head_check_box_reset('#item-taxo-table-head')
            $('#item-taxo-table-body').html('')

            // footer 합계 초기화
            $('#SumTotal').val('')
        }

        function btn_act_new() {
            data_init()
        }

        function override_amt_calc_txt_is_changed() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let supply_amt, vat_amt, sum_amt;

            Btype.amt_calc_txt_is_changed(tr, function (bd) {
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));

                if (isNaN(bd.pquote_prc)) return;

                $(tr).children('td:eq(6)').find('input').val(bd.pquote_qty.toFixed(window.User['PurchQtyPoint']))
                $(tr).children('td:eq(7)').find('input').val(bd.pquote_prc.toFixed(window.User['PurchPrcPoint']))

                $(tr).children('td:eq(8)').find('input').val(supply_amt.toFixed(window.User['PurchAmtPoint']))
                $(tr).children('td:eq(9)').find('input').val(vat_amt.toFixed(window.User['PurchAmtPoint']))
                $(tr).children('td:eq(10)').find('input').val(sum_amt.toFixed(window.User['PurchAmtPoint']))

                bd_page[index].PquotePrc = bd.pquote_prc
                bd_page[index].PquoteQty = bd.pquote_qty
                bd_page[index].PquoteSupply = supply_amt
                bd_page[index].PquoteVat = vat_amt
                bd_page[index].PquoteSum = sum_amt
            })
        }

        function get_bd_parameter(bd) {
            // let discount_rate = Btype.discount_rate_calc(parseInt(minusComma(bd.SalesPrc)) * parseInt(minusComma(bd.PquoteQty)), parseInt(bd.PquoteSum));
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                ItemTaxoId: parseInt(bd.ItemTaxoId),
                SeqNo: bd.SeqNo,
                ItemId: parseInt(bd.ItemId),
                IsSkipped: bd.IsSkipped,
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

        function create_bd_page() {
            let html = []
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
            bd_page.forEach(bd => {
                // 품목코드, 수량, 단가, 공급가액, 세액, 합계금액
                html.push (
                `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
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
                        <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" value="${bd.ItemCode}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)" required>
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event, 2)"
                        class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" value="${bd.ItemName}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)" required>
                    </td>
                <td
                    class="text-${formB.ListVars['Align'].IsSkipped}" ${formB.ListVars['Hidden'].IsSkipped}>
                    <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)"  ${bd.IsSkipped === '1' ? 'checked' : ''}
                    class="text-${formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped" disabled>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SaveButton}" ${formB.ListVars['Hidden'].SaveButton}>
                    <button class="btn btn-primary save-btn" onclick="add_td_last_tap_out(this, ${bd.Id})">저장</button>
                </td>
                </tr>` )
            });

            $('#SumTotal').val(format_conver_for(bd_page.length, formB.ListVars['Format'].SumAmt));

            document.getElementById('item-taxo-table-body').innerHTML = html.join('');

            // $('#item-taxo-table-body').html(html);
        }

        async function add_td_last_tap_out($this) {
            let tr = $($this).closest('tr')
            let index = $(tr).prevAll().length

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (bd_page[index].ItemId != 0 && ! dom_required_check($(tr).find(`input`))) {
                $(tr).find('.save-btn').attr('disabled', true)

                if ($($this).data('last')) {
                    const seq_no = await Btype.get_last_seq_no('item-taxo', $('#auto-slip-no-txt').val())
                    bd_page[index].SeqNo = seq_no;
                }

                Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                    bd_page[index].Id = page[0].Id;

                    body_act_success_callback($this, tr);
                    Btype.check_the_checkbox_when_changing($this, false)

                    $('#SumTotal').val(format_conver_for(bd_page.length, formB.ListVars['Format'].SumAmt))

                    $(tr).find('.save-btn').attr('disabled', false)
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('(*)Required item(s) omitted')),
                })
            }
        }

        function body_act_success_callback($this, tr) {
            if ($($this).data('last')) {
                add_tr()
                $($this).data('last', false)
            }
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });
        }

        function set_item_data_to_textbox(item) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).children('td:eq(2)').find('input').val(item.ItemCode)
            $(tr).children('td:eq(3)').find('input').val(item.ItemName)

            let index = $(tr).prevAll().length
            bd_page[index].ItemId = item.Id
            bd_page[index].ItemCode = item.ItemCode
            bd_page[index].ItemName = item.ItemName

            // override_amt_calc_txt_is_changed();

            return $(tr).children('td:eq(4)').find('input')
        }

        function override_check_the_checkbox_when_changing($this) {
            let tr = $($this).closest('tr');
            let index = $(tr).prevAll().length

            bd_page[index]['IsSkipped'] = $(tr).find('.is-skipped').prop('checked')  ? '1' : '0'
            $(tr).find(`input[name='bd-cud-check']`).prop('checked', true)
        }

        async function add_tr() {
            let last_bd_id_inc = 0;
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html = `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
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
                    class="text-${formB.ListVars['Align'].IsSkipped}" ${formB.ListVars['Hidden'].IsSkipped}>
                    <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped">
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SaveButton}" ${formB.ListVars['Hidden'].SaveButton}>
                    <button class="btn btn-primary save-btn" data-last=true onclick="add_td_last_tap_out(this, ${last_bd_id_inc})">저장</button>
                </td>
            </tr>`;
            $('#item-taxo-table-body').append(html)

            await setTimeout( function() {
                $(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                $(`#item-code-${last_bd_id_inc}`).focus()
            }, 100)

            bd_page.push({
                cursorId: last_bd_id_inc,
                Id: 0,
                ItemId: 0,
                ItemCode: '',
                ItemName: '',
                SeqNo: 0,
                ItemTaxoId: parseInt($(`#frm`).find('#Id').val()),
                IsSkipped: '0',
            })
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()
            $('#direct-input-txt').val('')

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            $('#Id').val(hd_page.Id)
            Btype.input_auto_slip_no_txt(hd_page.ItemTaxoNo)

            $('#item-taxo-date').val(moment(to_date(hd_page.TaxoDate)).format('YYYY-MM-DD'))

            $('#taxo-name-txt').val(hd_page.TaxoName)
            $('#media-size-txt').val(hd_page.MediaSize)
            $('#remarks-preview').html(hd_page.Remarks)
            $('#remarks-txt-area').val(hd_page.Remarks)

            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        const itemTaxoModal = {!! json_encode($itemTaxoModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
