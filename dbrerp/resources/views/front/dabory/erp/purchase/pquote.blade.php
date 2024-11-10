@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
<div class="content purchase">
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
                    data-variable="pquoteModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary pquote-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'pquote-act',
                    ])
                </div>
            </div>

            <div class="card" id="pquote-form">
                <div class="card-header" id="frm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card card-primary mb-3 mb-md-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="Id" name="Id" value="0">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                            <div class="col-12 d-flex p-0">
                                                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                                    onclick="get_last_slip_no(this)">
                                                    <span class="icon-cogs"></span>
                                                </button>
                                                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                                       maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                                    {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                            <input class="rounded w-100" type="date" value="" id="pquote-date"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                                {{ $formB['FormVars']['Required']['Date'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label class="m-0 ">{{ $formB['FormVars']['Title']['Supplier'] }}</label>
                                            <div class="d-flex">
                                                <input type="text" id="supplier-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                                onkeydown="company_model_show_cell_enter_key(event, 'BB')"
                                                       maxlength="{{ $formB['FormVars']['MaxLength']['Supplier'] }}"
                                                    {{ $formB['FormVars']['Required']['Supplier'] }}>
                                                <button type="button"
                                                    class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window company-modal-btn"
                                                    data-target="company"
                                                    data-clicked="get_supplier_id"
                                                    data-variable="companyModal">
                                                    <i class="icon-folder-open"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card card-info mb-3 mb-md-0 border-light" style="height: 250px">
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
                                        <div class="form-group d-flex flex-column ">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['VatTypeRate'] }}</label>
                                            <input type="text" id="vat-type-rate-text" class="rounded w-100" autocomplete="off" value="" disabled
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['VatTypeRate'] }}"
                                                {{ $formB['FormVars']['Required']['VatTypeRate'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card card-success mb-3 mb-md-0 border-light" style="height: 250px"><!--260-->
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
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Column1'] }}</label>
                                            <select class="rounded w-100" id="column1-select"
                                                    maxlength="{{ $formB['FormVars']['MaxLength']['Column1'] }}"
                                                {{ $formB['FormVars']['Required']['Column1'] }}></select>
                                        </div>
                                        <div class="form-group d-flex flex-column ">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Column2'] }}</label>
                                            <select class="rounded w-100" id="column2-select"
                                                    maxlength="{{ $formB['FormVars']['MaxLength']['Column2'] }}"
                                                {{ $formB['FormVars']['Required']['Column2'] }}></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card card-danger mb-0 border-light" style="height: 250px">
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
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                            <select class="rounded w-100" data-closed="0" id="status-select" onchange="Btype.set_is_closed_val(this)"
                                                    maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                                {{ $formB['FormVars']['Required']['Status'] }}>
                                                @foreach ($codeTitle['status']['pquote'] as $key => $status)
                                                    <option value="{{ $status['Code'] }}">
                                                        {{ $status['Title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                <button class="btn btn-sm btn-primary pquote-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'pquote-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row pquote-table">
                                <thead id="pquote-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="pquote-table-body">
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
    @include('front.outline.static.slip', ['moealSetFile' => $pquoteModal])
    @include('front.outline.static.company', ['moealSetFile' => $companyModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.pquote-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#pquote-date').val(date_to_sting(new Date()))

            let data = await Btype.get_slip_form_init()
            formB['SlipCommonSetup'] = data['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(data.DealTypePage)
            await Btype.create_vat_type_select_box_options(data.VatRatePage)
            await create_etc_select_box_options(data)

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                // slip-search cache 사용
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }
            }

            $('.pquote-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#pquote-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'copy-to-another': btn_act_copy_to_another(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': Btype.btn_act_del('#pquote-form #frm'); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#pquote-form #frm'); break;
                }
            });

            $('.pquote-bd-act').on('click', function () {
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
                    Btype.call_bd_act_api([ { Id: Number(id), PquoteMemo: $(txtarea_id).val() } ], function () {
                        const index = bd_page.findIndex(bd => bd['Id'] === id)
                        bd_page[index].PquoteMemo = $(txtarea_id).val()

                        iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
                    })
                }
            });

            activate_button_group()
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
                BdTableName: 'dbr_pquote_bd',
                HdIdName: 'pquote_id',
                HdId: parseInt(bd.PquoteId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#pquote-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        // start body act btn
        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.pquote-table')
        }

        async function btn_bd_act_add() {
            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0 && formB['SlipCommonSetup']['IsAutoSaveHdByItemButton']) {
                if (! await Btype.btn_act_add_chain('#pquote-form #frm')) { return }
            }

            if (! Btype.last_item_added_check('#pquote-table-body')) {
                add_tr();
            }
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.pquote-table')
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
            $('.purchase').find('.modal-btn').data('target', 'bodycopy')
            $('.purchase').find('.modal-btn').data('variable', data['Parameter'])
            $('.purchase').find('.modal-btn').data('class', parameter_name)
            $('.purchase').find('.modal-btn').trigger('click')
            $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#auto-slip-no-txt').val() )
        }
        // end body act btn

        // start head act btn
        function btn_act_copy_to_another(parameter_name) {
            const data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0]

            // $(`#modal-copy-to-another.${parameter_name}`).find('.target-slip-no-txt').data('slip-no', $('#auto-slip-no-txt').val())
            $(`#modal-copy-to-another.${parameter_name}`).find('.source-slip-no-txt').val($('#auto-slip-no-txt').val())

            $('.purchase').find('.modal-btn').data('target', 'copy-to-another')
            $('.purchase').find('.modal-btn').data('variable', data['Parameter'])
            $('.purchase').find('.modal-btn').data('class', parameter_name)
            $('.purchase').find('.modal-btn').trigger('click')
        }

        function bd_update_due_to_vat_rate_change() {
            let data = [];

            bd_page = bd_page.filter(function (bd) {
                return bd.Id != 0;
            });

            bd_page.forEach(bd => {
                let supply_amt, vat_amt, sum_amt;
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc({ pquote_prc: parseFloat(bd.PquotePrc), pquote_qty: parseFloat(bd.PquoteQty) },
                    parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));
                bd.PquoteSupply = supply_amt;
                bd.PquoteVat = vat_amt;
                bd.PquoteSum = sum_amt;

                data.push({
                    Id: parseInt(bd.Id),
                    PquoteSupply: String(bd.PquoteSupply),
                    PquoteVat: String(bd.PquoteVat),
                    PquoteSum: String(bd.PquoteSum),
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
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                PquoteNo: $('#auto-slip-no-txt').val(),
                PquoteDate: moment(new Date($('#pquote-date').val())).format('YYYYMMDD'),
                DealTypeId: parseInt($('#deal-type-select').val()),
                UserId: window.User['UserId'],
                SgroupId: window.User['SgroupId'],
                BranchId: window.User['BranchId'],
                SupplierId: parseInt($('#supplier-txt').data('id')),
                VatRateId: parseInt($('#vat-type-select').val()),
                CompanyContact: $('#supplier-txt').data('contact'),
                PayTerms: $('#payTerms-select').val(),
                PayPeriod: '',
                Destination: '',
                Delivery: $('#delivery-select').val(),
                Status: $('#status-select').val(),
                // IsClosed: String($('#status-select').data('closed')),
                IsClosed: '0',
                Column1: $('#column1-select').val(),
                Column2: $('#column2-select').val(),
                Remarks: $('#remarks-txt-area').val(),
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

        function data_init() {
            bd_page = [];
            $(`#frm`).find(`input[name="Id"]`).val(0)
            $('.save-button').prop('disabled', false)

            $('#auto-slip-no-txt').val('')
            Btype.set_slip_no_btn_abled()
            $('#pquote-date').val(date_to_sting(new Date()))
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
            table_head_check_box_reset('#pquote-table-head')
            $('#pquote-table-body').html('')

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
            let response = await Btype.get_last_slip_no('pquote');
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function override_amt_calc_txt_is_changed() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let supply_amt, vat_amt, sum_amt;

            Btype.amt_calc_txt_is_changed(tr, function (bd) {
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));

                if (isNaN(bd.pquote_prc)) return;

                $(tr).children('td:eq(6)').find('input').val(format_conver_for(bd.pquote_qty, formB.ListVars['Format'].PquoteQty))
                $(tr).children('td:eq(7)').find('input').val(format_conver_for(bd.pquote_prc, formB.ListVars['Format'].PquotePrc))

                $(tr).children('td:eq(8)').find('input').val(format_conver_for(supply_amt, formB.ListVars['Format'].SupplyAmt))
                $(tr).children('td:eq(9)').find('input').val(format_conver_for(vat_amt, formB.ListVars['Format'].VatAmt))
                $(tr).children('td:eq(10)').find('input').val(format_conver_for(sum_amt, formB.ListVars['Format'].SumAmt))

                bd_page[index].PquotePrc = bd.pquote_prc
                bd_page[index].PquoteQty = bd.pquote_qty
                bd_page[index].PquoteSupply = supply_amt
                bd_page[index].PquoteVat = vat_amt
                bd_page[index].PquoteSum = sum_amt
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

            $('#delivery-select').html(delivery);
            $('#payTerms-select').html(payTerms);
            $('#column1-select').html(column1);
            $('#column2-select').html(column2);
        }

        function amt_total_calc() {
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;

            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.PquoteQty);
                supply_total += parseFloat(bd.PquoteSupply);
                vat_amt_vat_total += parseFloat(bd.PquoteVat);
                sum_total += parseFloat(bd.PquoteSum);
            })

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].PquoteQty));
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
                PquoteId: parseInt(bd.PquoteId),
                SeqNo: bd.SeqNo,
                CrtUserId: window.User['UserId'],
                UpdUserId: window.User['UserId'],
                ItemId: parseInt(bd.ItemId),
                PquoteQty: String(bd.PquoteQty),
                PquotePrc: String(bd.PquotePrc),
                PquoteSupply: String(bd.PquoteSupply),
                PquoteVat: String(bd.PquoteVat),
                PquoteSum: String(bd.PquoteSum),
                // DiscountRate: String(discount_rate),
                PquoteMemo: bd.PquoteMemo,
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
                bd_page[index].PquoteSupply = supply_amt
                bd_page[index].PquoteVat = vat_amt
                bd_page[index].PquoteSum = sum_amt
            })
        }

        function override_custom_sum_amt() {
            Btype.custom_sum_amt(function (sum_amt, index) {
                bd_page[index].PquoteSum = sum_amt
            })
        }

        function create_bd_page() {
            let html = []
            let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
            bd_page.forEach(bd => {
                qty_total += parseFloat(bd.PquoteQty);
                supply_total += parseFloat(bd.PquoteSupply);
                vat_amt_vat_total += parseFloat(bd.PquoteVat);
                sum_total += parseFloat(bd.PquoteSum);

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
                        class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>${bd.SubName}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>${bd.CountUnit}
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].PquoteQty}" ${formB.ListVars['Hidden'].PquoteQty}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].PquoteQty} border-0 bg-white" value="${format_conver_for(bd.PquoteQty, formB.ListVars['Format'].PquoteQty)}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].PquotePrc}" ${formB.ListVars['Hidden'].PquotePrc}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].PquotePrc} border-0 bg-white" value="${format_conver_for(bd.PquotePrc, formB.ListVars['Format'].PquotePrc)}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" value="${format_conver_for(bd.PquoteSupply, formB.ListVars['Format'].SupplyAmt)}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" value="${format_conver_for(bd.PquoteVat, formB.ListVars['Format'].VatAmt)}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_supply_amt_or_vat_amt()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                        class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.PquoteSum, formB.ListVars['Format'].SumAmt)}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="override_custom_sum_amt()"
                        required>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SalesPrc}" ${formB.ListVars['Hidden'].SalesPrc}>${format_conver_for(bd.SalesPrc, formB.ListVars['Format'].SalesPrc)}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].PquoteMemo}" ${formB.ListVars['Hidden'].PquoteMemo}>
                        <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea" id="memo-textarea-${bd.Id}"
                            ondblclick="Btype.dblclick_memo_textarea(this, ${bd.Id})" role="button" readonly>${bd.PquoteMemo}</textarea>
                    </td>
                </tr>` )
            });

            $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].PquoteQty));
            $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
            $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));

            document.getElementById('pquote-table-body').innerHTML = html.join('');

            // $('#pquote-table-body').html(html);
        }

        async function add_td_last_tap_out($this, id) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (bd_page[index].ItemId != 0 && ! dom_required_check($(tr).find(`input`))) {
                if ($($this).data('last')) {
                    let seq_no = await Btype.get_last_seq_no('pquote', $('#auto-slip-no-txt').val())
                    bd_page[index].SeqNo = seq_no;
                }

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
            bd_page[index].PquotePrc = item.PurchPrc
            bd_page[index].SalesPrc = item.SalesPrc

            if (bd_page[index].Id === 0) {
                $(tr).children('td:eq(12)').find('textarea').val(item.ItemMemo)
                bd_page[index].PquoteMemo = item.ItemMemo
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
                    class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].PquoteQty}" ${formB.ListVars['Hidden'].PquoteQty}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].PquoteQty}" value=""
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="override_amt_calc_txt_is_changed()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].PquotePrc}" ${formB.ListVars['Hidden'].PquotePrc}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].PquotePrc}" value=""
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
                    class="text-${formB.ListVars['Align'].PquoteMemo}" ${formB.ListVars['Hidden'].PquoteMemo}>
                    <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                        ondblclick="Btype.dblclick_memo_textarea(this, ${last_bd_id_inc})" id="memo-textarea-${last_bd_id_inc}" role="button" readonly></textarea>
                </td>
            </tr>`;
            $('#pquote-table-body').append(html)

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
                PquoteId: parseInt($(`#frm`).find(`input[name="Id"]`).val()),
                PquotePrc: 0,
                PquoteQty: 0,
                PquoteSupply: 0,
                PquoteVat: 0,
                PquoteSum: 0,
                SalesPrc: 0,
                PquoteMemo: '',
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
            $('#auto-slip-no-txt').val(hd_page.PquoteNo)
            $('#pquote-date').val(moment(to_date(hd_page.PquoteDate)).format('YYYY-MM-DD'))
            $('#supplier-txt').val(hd_page.CompanyName)
            $('#supplier-txt').data('id', hd_page.SupplierId)
            $('#supplier-txt').data('contact', hd_page.CompanyContact)

            $('#deal-type-select').val(hd_page.DealTypeId)
            $('#vat-type-select').val(hd_page.VatRateId)
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

        const pquoteModal = {!! json_encode($pquoteModal) !!};
        const companyModal = {!! json_encode($companyModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
