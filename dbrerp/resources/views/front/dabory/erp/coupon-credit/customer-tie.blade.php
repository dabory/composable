@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content coupon-credit">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal window company-modal-btn"
                    data-target="company"
                    data-clicked="Btype.get_company_id"
                    data-variable="customerModal">
                </button>

                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="customerTieModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary customer-tie-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'customer-tie-act',
                    ])
                </div>
            </div>

            <div class="card" id="customer-tie-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
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
                                        <label class="m-0">{{ $formB['FormVars']['Title']['TieDate'] }}</label>
                                        <input class="rounded w-100" type="date" id="tie-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['TieDate'] }}"
                                            {{ $formB['FormVars']['Required']['TieDate'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['TieName'] }}</label>
                                        <input class="rounded w-100" type="text" id="tie-name-txt"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['TieName'] }}"
                                            {{ $formB['FormVars']['Required']['TieName'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="status-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                            {{ $formB['FormVars']['Required']['Status'] }}>
                                            <option value=""></option>
                                            <option value="{{ $formB['StatusOptions'][0]['Value'] }}">{{ $formB['StatusOptions'][0]['Caption'] }}</option>
                                            <option value="{{ $formB['StatusOptions'][1]['Value'] }}">{{ $formB['StatusOptions'][1]['Caption'] }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Remarks'] }}</label>
                                        <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                                        <div class="fr-view" id="remarks-preview" hidden></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-closed-check"> <label class="mb-0" for="is-closed-check">종결</label>
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
                                <button class="btn btn-sm btn-primary customer-tie-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'customer-tie-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row customer-tie-table">
                                <thead id="customer-tie-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="customer-tie-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['UserName'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['UserName'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded text-left" id="UserName" disabled>
                                </div>
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['BranchName'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['BranchName'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded text-left" id="BranchName" disabled>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-md-row" id="total-frm">
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['CurrRewardTotal'] }}
                                    rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['CurrRewardTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="CurrRewardTotal" disabled>
                                </div>

                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['CurrCreditTotal'] }}
                                        rowspan="1" colspan="1">
                                        {{ $formB['FooterVars']['Title']['CurrCreditTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="CurrCreditTotal" disabled>
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

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $customerTieModal])
    @include('front.outline.static.company', ['moealSetFile' => $customerModal])
    @include('front.outline.static.memo')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.customer-tie-table', make_dynamic_table_px(formB['ListVars']['Size']))
            // Btype.set_slip_cache_data();

            $('#tie-date').val(date_to_sting(new Date()))

            await Btype.get_storage_name_and_branch_name()
            $('#UserName').val(window.User['NickName'])

            // if (! isEmpty(pickCacheData['query'])) {
            //     let query = JSON.parse(pickCacheData['query'])
            //     await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
            // }

            $('.customer-tie-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#customer-tie-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#customer-tie-form #frm'); break;
                    case 'delete': Btype.btn_act_del('#customer-tie-form #frm'); break;
                }
            });

            $('.customer-tie-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
                    case 'body-copy': btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                }
            });

            $('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo').find('.fr-view').html($('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            activate_button_group()
        }

        async function override_seq_no_up_down(move) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let bd = bd_page[index]

            if (isEmpty(bd) || parseInt($('#frm').find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT move UP or DOWN in the status')),
                });
                return;
            }

            let data = {
                BdTableName: 'dbr_customer_tie_bd',
                HdIdName: 'customer_tie_id',
                HdId: parseInt(bd.CustomerTieId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#customer-tie-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        function btn_act_new() {
            bd_page = [];

            input_box_reset_for('#frm')
            input_box_reset_for('#total-frm')

            $('.customer-tie-act.save-button').prop('disabled', false)

            Btype.set_slip_no_btn_abled()
            $('#tie-date').val(date_to_sting(new Date()))

            // table body 초기화
            table_head_check_box_reset('#customer-tie-table-head')
            $('#customer-tie-table-body').html('');
        }

        // start body act btn
        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.customer-tie-table')
        }

        async function btn_bd_act_add() {
            if (parseInt($('#frm').find('#Id').val()) == 0) {
                return iziToast.error({
                    title: 'Error', message: @json(_e('Action failed')),
                })
            }

            if (! Btype.last_item_added_check('#customer-tie-table-body')) {
                add_tr();
            }
        }

        function save_data_when_entering_text() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr');
            let index = $(tr).prevAll().length;

            bd_page[index].Ref1 = $(tr).find('.ref1-txt').val() || '';
            bd_page[index].Ref2 = $(tr).find('.ref2-txt').val() || '';
            bd_page[index].IsLeader = $(tr).find('.is-leader-check:checked').val() ?? '0';
        }

        function custom_body_act_success_callback($this, tr) {
            amt_total_calc();

            if ($($this).data('last')) {
                add_tr();
                $($this).data('last', false)
            }
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });
        }

        async function add_td_last_tap_out($this, id) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (bd_page[index].ItemId != 0 && ! dom_required_check($(tr).find(`input`))) {
                if ($($this).data('last')) {
                    let seq_no = await Btype.get_last_seq_no(formB['QueryVars']['QueryName'], $('#auto-slip-no-txt').val())
                    bd_page[index].SeqNo = seq_no;
                }

                Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                    bd_page[index].Id = page[0].Id;

                    custom_body_act_success_callback($this, tr);
                    Btype.check_the_checkbox_when_changing($this, false)
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('(*)Required item(s) omitted')),
                });
            }
        }

        function get_bd_parameter(bd) {
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                CustomerTieId: parseInt(bd.CustomerTieId),
                SeqNo: bd.SeqNo,
                BranchId: Number(bd.BranchId),
                UserId: Number(bd.UserId),
                BuyerId: Number(bd.BuyerId),
                Ref1: bd.Ref1,
                Ref2: bd.Ref2,
                IsLeader: bd.IsLeader,
                Ip: window.User['Ip']
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

        function amt_total_calc() {
            let curr_reward_total = 0;
            let curr_credit_total = 0;

            bd_page.forEach(bd => {
                curr_reward_total += parseFloat(bd.CurrReward);
                curr_credit_total += parseFloat(bd.CurrCredit);
            })

            $('#CurrRewardTotal').val(format_conver_for(curr_reward_total, formB.ListVars['Format'].CurrReward) || 0);
            $('#CurrCreditTotal').val(format_conver_for(curr_credit_total, formB.ListVars['Format'].CurrCredit) || 0);
        }

        function create_bd_page() {
            let html = []
            let curr_reward_total = 0;
            let curr_credit_total = 0;
            bd_page.forEach(bd => {
                curr_reward_total += parseFloat(bd.CurrReward);
                curr_credit_total += parseFloat(bd.CurrCredit);

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
                    <td onkeydown="company_model_show_cell_enter_key(event, 'AA')"
                        class="text-${formB.ListVars['Align'].CompanyName}" ${formB.ListVars['Hidden'].CompanyName}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].CompanyName} border-0 bg-white" value="${bd.CompanyName}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)" required>
                    </td>
                    <td class="text-${formB.ListVars['Align'].CurrReward}" ${formB.ListVars['Hidden'].CurrReward}>
                        ${format_conver_for(bd.CurrReward, formB.ListVars['Format'].CurrReward)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].AvailReward}" ${formB.ListVars['Hidden'].AvailReward}>
                        ${format_conver_for(bd.AvailReward, formB.ListVars['Format'].AvailReward)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].CurrCredit}" ${formB.ListVars['Hidden'].CurrCredit}>
                        ${format_conver_for(bd.CurrCredit, formB.ListVars['Format'].CurrCredit)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].AvailCredit}" ${formB.ListVars['Hidden'].AvailCredit}>
                        ${format_conver_for(bd.AvailCredit, formB.ListVars['Format'].AvailCredit)}
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt" value="${bd.Ref1}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                        class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt" value="${bd.Ref2}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)"
                        onfocusout="save_data_when_entering_text()">
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsLeader}" ${formB.ListVars['Hidden'].IsLeader}>
                        <input type="checkbox" value="1" class="text-center is-leader-check" ${bd.IsLeader == '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].BranchName}" ${formB.ListVars['Hidden'].BranchName}>
                        ${bd.BranchName}
                    </td>
                    <td class="text-${formB.ListVars['Align'].UserName}" ${formB.ListVars['Hidden'].UserName}>
                        ${bd.NickName}
                    </td>
                </tr>` )
            });

            $('#CurrRewardTotal').val(format_conver_for(curr_reward_total, formB.ListVars['Format'].CurrReward) || 0);
            $('#CurrCreditTotal').val(format_conver_for(curr_credit_total, formB.ListVars['Format'].CurrCredit) || 0);

            document.getElementById('customer-tie-table-body').innerHTML = html.join('');
            // $('#customer-tie-table-body').html(html);
        }

        async function add_tr() {
            let last_bd_id_inc = 0;
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html =
            `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Radio}"
                    id="bd-cursor-state-${last_bd_id_inc}"
                    onclick="Btype.bd_cursor_click(this)">
                </td>
                <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="company_model_show_cell_enter_key(event, 'AA')"
                    class="text-${formB.ListVars['Align'].CompanyName}" ${formB.ListVars['Hidden'].CompanyName}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].CompanyName} border-0 bg-white"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    id="customer-name-${last_bd_id_inc}" required>
                </td>
                <td class="text-${formB.ListVars['Align'].CurrReward}" ${formB.ListVars['Hidden'].CurrReward}>
                </td>
                <td class="text-${formB.ListVars['Align'].AvailReward}" ${formB.ListVars['Hidden'].AvailReward}>
                </td>
                <td class="text-${formB.ListVars['Align'].CurrCredit}" ${formB.ListVars['Hidden'].CurrCredit}>
                </td>
                <td class="text-${formB.ListVars['Align'].AvailCredit}" ${formB.ListVars['Hidden'].AvailCredit}>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    data-last=true onfocusout="add_td_last_tap_out(this, ${last_bd_id_inc})"
                    class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>
                <td class="text-${formB.ListVars['Align'].IsLeader}" ${formB.ListVars['Hidden'].IsLeader}>
                    <input type="checkbox" value="1" class="text-center is-leader-check">
                </td>
                <td class="text-${formB.ListVars['Align'].BranchName}" ${formB.ListVars['Hidden'].BranchName}>
                    ${$('#BranchName').val()}
                </td>
                <td class="text-${formB.ListVars['Align'].UserName}" ${formB.ListVars['Hidden'].UserName}>
                    ${$('#UserName').val()}
                </td>
            </tr>`;

            $('#customer-tie-table-body').append(html)

            await setTimeout( function() {
                $(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                $(`#customer-name-${last_bd_id_inc}`).focus()
            }, 100);

            bd_page.push({
                cursorId: last_bd_id_inc,
                Id: 0,
                CompanyName: '',
                BuyerId: 0,
                CurrCreditBal: 0,
                SeqNo: 0,
                BranchId: window.User['BranchId'],
                UserId: window.User['UserId'],
                BranchName: $('#BranchName').val(),
                UserName: $('#UserName').val(),
                CustomerTieId: parseInt($('#frm').find('#Id').val()),
                Ref1: '',
                Ref2: '',
                IsLeader: '0'
            })

        }

        function get_parameter() {
            let id = Number($('#frm').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                CustomerTieNo: $('#auto-slip-no-txt').val(),
                TieDate: moment(new Date($('#tie-date').val())).format('YYYYMMDD'),
                UserId: window.User['UserId'],
                BranchId: window.User['BranchId'],
                TieName: $('#tie-name-txt').val(),
                Status: $('#status-select').val(),
                IsClosed: $('#is-closed-check:checked').val() ?? '0',
                Remarks: $('#remarks-preview').html(),
                Ip: window.User['Ip']
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

        function set_company_data_to_textbox(company) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).children('td:eq(2)').find('input').val(company.CompanyName)
            // $(tr).children('td:eq(3)').text(format_conver_for(company.CurrCreditBal, formB.ListVars['Format'].CurrCreditBal))

            let index = $(tr).prevAll().length;
            bd_page[index].BuyerId = company.Id
            bd_page[index].CompanyName = company.CompanyName
            // bd_page[index].CurrCreditBal = company.CurrCreditBal

            return $(tr).find('.ref1-txt')
        }

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            $('#Id').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.CustomerTieNo)
            $('#tie-date').val(moment(to_date(hd_page.TieDate)).format('YYYY-MM-DD'))
            $('#tie-name-txt').val(hd_page.TieName)

            $('#status-select').val(hd_page.Status)
            $('#remarks-txt-area').val(remove_tag(hd_page.Remarks))
            $('#remarks-preview').html(hd_page.Remarks)
            $('#is-closed-check').prop('checked', hd_page.IsClosed == '1')

            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        const customerTieModal = {!! json_encode($customerTieModal) !!};
        const customerModal = {!! json_encode($customerModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
