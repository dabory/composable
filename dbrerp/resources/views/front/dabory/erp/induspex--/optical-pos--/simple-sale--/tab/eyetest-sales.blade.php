<div class="tab-pane fade" id="{{ $tabId }}">
    <!-- 입력부분 시작 -->
    <div class="d-flex flex-row align-items-end input_form" id="sales-frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <select class="rounded w-100" id="vat-type-select" hidden>
        </select>
        <div class="d-flex flex-column" style="width: 143px">
            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
            <div class="col-12 d-flex p-0">
                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                    onclick="EyetestSales.get_last_slip_no(this)">
                    <span class="icon-cogs"></span>
                </button>
                <input type="text" class="auto-slip-no-txt rounded w-100 radius-l0" autocomplete="off" disabled>
            </div>
        </div>
        <div class="d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['SalesDate'] }}</label>
            <input class="rounded w-100" type="date" value="" id="sales-date">
        </div>
        <div class="d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
            <select class="rounded w-100" id="status-select">
                <option value=""></option>
            </select>
        </div>
        <div class="d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['DeliUserId'] }}</label>
            <select class="rounded w-100" id="deli-user-id-select" onchange="EyetestSales.btn_act_save()" required>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mr-1" id="down-btn" onclick="EyetestSales.override_seq_no_up_down('down')"
                data-clicked="">▼
            </button>
            <button class="btn btn-primary mr-1" id="up-btn" onclick="EyetestSales.override_seq_no_up_down('up')"
                data-clicked="">▲
            </button>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary eyetest-sales-act" data-value="add">{{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                </button>
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['BodySelectOptions'],
                    'eventClassName' => 'eyetest-sales-act',
                ])
            </div>
        </div>

    </div>
    <!--// 입력부분 끝 -->

    <!-- 테이블 시작 -->
    <div class="table-responsive" style="height:383px;" id="scroll-area">
        <table class="table-row eyetest-table">
            <thead id="eyetest-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
            </thead>
            <tbody id="eyetest-table-body">
            </tbody>
        </table>
    </div>
    <!--// 테이블 끝 -->

    <!-- 입금 시작 -->
    <div class="table-footer d-flex justify-content-end flex-md-row border rounded" style="height: 123px">
    </div>
    <!--// 입금 끝 -->
</div>

@once
@push('js')
    <script>
        (function( EyetestSales, $, undefined ) {
            EyetestSales.bd_pages = {}
            EyetestSales.bd_page = []
            EyetestSales.tab_count = 100
            EyetestSales.formB = {!! json_encode($formB) !!}


            EyetestSales.create = async function(tab_id) {
                {{--let tab_id = '#' + {!! json_encode($tabId) !!};--}}
                window.make_dynamic_table_css(`${tab_id} .eyetest-table`, window.make_dynamic_table_px(EyetestSales.formB['ListVars']['Size']))

                $(tab_id).find('#sales-date').val(window.date_to_sting(new Date()))

                let eyetest_init_data = await Btype.get_slip_form_init()
                EyetestSales.formB['SlipCommonSetup'] = eyetest_init_data['SlipCommonSetup']

                Btype.create_vat_type_select_box_options(eyetest_init_data.VatRatePage, `${tab_id} #vat-type-select`)
                EyetestSales.create_etc_select_box_options(eyetest_init_data, tab_id)

                $(tab_id).find('.eyetest-sales-act').on('click', function () {
                    switch( $(this).data('value') ) {
                        case 'add': EyetestSales.btn_bd_act_add(); break;
                        case 'body-copy': EyetestSales.btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                        case 'multi-delete': EyetestSales.override_btn_bd_act_multi_delete(); break;
                        case 'multi-update': EyetestSales.override_btn_bd_act_multi_update(); break;
                    }
                });
            };

            EyetestSales.override_seq_no_up_down = async function (move) {
                let tab_id = window.tabId;
                let tr = $(`input[name='${tab_id}bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let bd = EyetestSales.bd_page[index]

                if (window.isEmpty(bd) || parseInt($(tab_id).find(`#sales-frm`).find(`input[name="Id"]`).val()) == 0) {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('Can NOT move UP or DOWN in the status')),
                    });
                    return;
                }

                let data = {
                    BdTableName: 'dbr_sales_bd',
                    HdIdName: 'sales_id',
                    HdId: parseInt(bd.SalesId),
                    CurrId: parseInt(bd.Id),
                    Move: move,
                }

                $(tab_id).find('#down-btn').prop('disabled', true);
                $(tab_id).find('#up-btn').prop('disabled', true);
                await Btype.seq_no_up_down(move, data, `${tab_id} #eyetest-table-body`, index, 'EyetestSales')
                $(tab_id).find('#down-btn').prop('disabled', false);
                $(tab_id).find('#up-btn').prop('disabled', false);
            };

            EyetestSales.call_act_api = function (data, act_api, callback = undefined) {
                $.when(get_api_data(act_api, {
                    Page: [
                        data
                    ]
                })).done(function(response) {
                    let d = response.data
                    if (d.Page) {
                        callback(response);
                        iziToast.success({
                            title: 'Success',
                            message: $('#action-completed').text(),
                        });
                    } else {
                        let message = response.data.body ?? $('#api-request-failed-please-check').text();
                        iziToast.error({
                            title: 'Error',
                            message: message,
                        });
                    }
                });
            };

            EyetestSales.btn_act_save = function () {
                EyetestSales.call_act_api(EyetestSales.get_parameter(), EyetestSales.formB['General']['ActApi'], function (response) {
                });
            }

            EyetestSales.get_parameter = function () {
                let tab_id = window.tabId;
                let id = Number($(tab_id).find(`#sales-frm`).find(`input[name="Id"]`).val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    DeliUserId: Number($(tab_id).find('#deli-user-id-select').val()),
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

            EyetestSales.get_last_slip_no = async function ($this) {
                let tab_id = window.tabId;
                Btype.set_slip_no_btn_disabled(`${tab_id} #auto-slip-no-btn`)
                let response = await Btype.get_last_slip_no(EyetestSales.formB['QueryVars']['QueryName']);
                $(tab_id).find('.auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            };

            EyetestSales.create_etc_select_box_options = function (data, tab_val) {
                let status = window.create_options(data.EtcSalesStatusPage)
                let sgroup2 = window.custom_create_options('Id', 'SgroupName', data.Sgroup2Page)

                $(tab_val).find('#status-select').html(status);
                $(tab_val).find('#deli-user-id-select').html(sgroup2);
            };

            EyetestSales.btn_bd_act_add = function () {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Action failed')),
                });
            };

            EyetestSales.override_btn_bd_act_multi_update = function () {
                Btype.btn_bd_act_multi_update(`${window.tabId} .eyetest-table`, 'EyetestSales')
            };

            EyetestSales.override_btn_bd_act_multi_delete = function () {
                Btype.btn_bd_act_multi_delete(`${window.tabId} .eyetest-table`, 'EyetestSales')
            };

            EyetestSales.add_tr = async function () {
                let tab_id = window.tabId
                let last_bd_id_inc = 0;
                if (EyetestSales.bd_page.length > 0) {
                    last_bd_id_inc = EyetestSales.bd_page[EyetestSales.bd_page.length - 1].cursorId + 1 || 0
                }

                let html =
                `<tr>
                    <td class="text-${EyetestSales.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="${tab_id}bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${EyetestSales.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${EyetestSales.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${EyetestSales.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event, 1, 'EyetestSales')"
                        class="text-${EyetestSales.formB.ListVars['Align'].ItemCode}" ${EyetestSales.formB.ListVars['Hidden'].ItemCode}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].ItemCode} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')">
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event, 2, 'EyetestSales')"
                        class="text-${EyetestSales.formB.ListVars['Align'].ItemName}" ${EyetestSales.formB.ListVars['Hidden'].ItemName}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].ItemName} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')">
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].SubName}" ${EyetestSales.formB.ListVars['Hidden'].SubName}>
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].CountUnit}" ${EyetestSales.formB.ListVars['Hidden'].CountUnit}>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${EyetestSales.formB.ListVars['Align'].SorderQty}" ${EyetestSales.formB.ListVars['Hidden'].SorderQty}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SorderQty} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        >
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        data-last=true onfocusout="EyetestSales.add_td_last_tap_out(this, ${last_bd_id_inc})"
                        class="text-${EyetestSales.formB.ListVars['Align'].SalesQty}" ${EyetestSales.formB.ListVars['Hidden'].SalesQty}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SalesQty} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        onfocusout="EyetestSales.override_amt_calc_txt_is_changed()"
                        required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${EyetestSales.formB.ListVars['Align'].SorderPrc}" ${EyetestSales.formB.ListVars['Hidden'].SorderPrc}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SorderPrc} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        >
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${EyetestSales.formB.ListVars['Align'].SumAmt}" ${EyetestSales.formB.ListVars['Hidden'].SumAmt}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SumAmt} border-0 bg-white"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        >
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].StdSalesPrc}" ${EyetestSales.formB.ListVars['Hidden'].StdSalesPrc}>
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].DiscountRate}" ${EyetestSales.formB.ListVars['Hidden'].DiscountRate}>
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].IsEnd}" ${EyetestSales.formB.ListVars['Hidden'].IsEnd}>
                        <input type="checkbox" value="1" class="text-center" id="is-end-check">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${EyetestSales.formB.ListVars['Align'].Ref1}" ${EyetestSales.formB.ListVars['Hidden'].Ref1}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        onfocusout="EyetestSales.save_data_when_entering_text()">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${EyetestSales.formB.ListVars['Align'].Ref2}" ${EyetestSales.formB.ListVars['Hidden'].Ref2}
                        >
                        <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt"
                        onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                        onfocusout="EyetestSales.save_data_when_entering_text()">
                    </td>
                    <td
                        class="text-${EyetestSales.formB.ListVars['Align'].Descript} memo-td" ${EyetestSales.formB.ListVars['Hidden'].Descript}>
                    </td>
                </tr>`;

                $(tab_id).find('#eyetest-table-body').append(html)

                await setTimeout( function() {
                    $(tab_id).find(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                    $(tab_id).find(`#item-code-${last_bd_id_inc}`).focus()
                }, 100);

                EyetestSales.bd_page.push({
                    cursorId: last_bd_id_inc,
                    Id: 0,
                    SeqNo: 0,
                    SalesId: parseInt($(tab_id).find(`#sales-frm`).find(`input[name="Id"]`).val()),
                    SalesQty: 0,
                    SalesSupply: 0,
                    SalesVat: 0,
                    SalesSum: 0,
                })
            };

            EyetestSales.create_bd_page = function (tab_id = window.tabId) {
                let html = []
                let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
                EyetestSales.bd_pages[tab_id] = EyetestSales.bd_page;
                EyetestSales.bd_page.forEach(bd => {
                    qty_total += parseFloat(bd.SalesQty);
                    supply_total += parseFloat(bd.SalesSupply);
                    vat_amt_vat_total += parseFloat(bd.SalesVat);
                    sum_total += parseFloat(bd.SalesSum);

                    // 품목코드, 수량, 단가, 공급가액, 세액, 합계금액
                    html.push (
                    `<tr>
                        <td class="text-${EyetestSales.formB.ListVars['Align'].$Radio} px-import-0">
                            <input name="${tab_id}bd-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${EyetestSales.formB.ListVars['Align'].$Radio}"
                            onclick="Btype.bd_cursor_click(this)">
                        </td>
                        <td class="text-${EyetestSales.formB.ListVars['Align'].$Check} px-import-0">
                            <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${EyetestSales.formB.ListVars['Align'].$Check}">
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 1, 'EyetestSales')"
                            class="text-${EyetestSales.formB.ListVars['Align'].ItemCode}" ${EyetestSales.formB.ListVars['Hidden'].ItemCode}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].ItemCode} border-0 bg-white" value="${bd.ItemCode}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')">
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 2, 'EyetestSales')"
                            class="text-${EyetestSales.formB.ListVars['Align'].ItemName}" ${EyetestSales.formB.ListVars['Hidden'].ItemName}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].ItemName} border-0 bg-white" value="${bd.ItemName}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')">
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].SubName}" ${EyetestSales.formB.ListVars['Hidden'].SubName}>${bd.SubName}
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].CountUnit}" ${EyetestSales.formB.ListVars['Hidden'].CountUnit}>${bd.CountUnit}
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${EyetestSales.formB.ListVars['Align'].SorderQty}" ${EyetestSales.formB.ListVars['Hidden'].SorderQty}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SorderQty} border-0 bg-white" value="${format_conver_for(bd.SorderQty, EyetestSales.formB.ListVars['Format'].SorderQty)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            >
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            onfocusout="EyetestSales.add_td_last_tap_out(this, ${bd.Id})"
                            class="text-${EyetestSales.formB.ListVars['Align'].SalesQty}" ${EyetestSales.formB.ListVars['Hidden'].SalesQty}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SalesQty} border-0 bg-white" value="${format_conver_for(bd.SalesQty, EyetestSales.formB.ListVars['Format'].SalesQty)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            onfocusout="EyetestSales.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${EyetestSales.formB.ListVars['Align'].SorderPrc}" ${EyetestSales.formB.ListVars['Hidden'].SorderPrc}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SorderPrc} border-0 bg-white" value="${format_conver_for(bd.SorderPrc, EyetestSales.formB.ListVars['Format'].SorderPrc)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            >
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${EyetestSales.formB.ListVars['Align'].SumAmt}" ${EyetestSales.formB.ListVars['Hidden'].SumAmt}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.SalesSum, EyetestSales.formB.ListVars['Format'].SumAmt)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            >
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].StdSalesPrc}" ${EyetestSales.formB.ListVars['Hidden'].StdSalesPrc}>${format_conver_for(bd.StdSalesPrc, EyetestSales.formB.ListVars['Format'].StdSalesPrc)}
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].DiscountRate}" ${EyetestSales.formB.ListVars['Hidden'].DiscountRate}>
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].IsEnd}" ${EyetestSales.formB.ListVars['Hidden'].IsEnd}>
                            <input type="checkbox" value="1" class="text-center" id="is-end-check" disabled>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${EyetestSales.formB.ListVars['Align'].Ref1}" ${EyetestSales.formB.ListVars['Hidden'].Ref1}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt" value="${bd.Ref1}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            onfocusout="EyetestSales.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${EyetestSales.formB.ListVars['Align'].Ref2}" ${EyetestSales.formB.ListVars['Hidden'].Ref2}
                            >
                            <input type="text" class="text-${EyetestSales.formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt" value="${bd.Ref2}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSales')"
                            onfocusout="EyetestSales.save_data_when_entering_text()">
                        </td>
                        <td
                            class="text-${EyetestSales.formB.ListVars['Align'].Descript} memo-td" ${EyetestSales.formB.ListVars['Hidden'].Descript}>${bd.Descript}
                        </td>
                    </tr>` )
                    $('#is-end-check').prop('checked', bd.IsEnd == '1')
                });

                if ($('.nav-tabs-solid').find('a.active').closest('li').hasClass('sales-tab')) {
                    $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
                }

                document.querySelector(tab_id).querySelector('#eyetest-table-body').innerHTML = html.join('');
                // $(tab_id).find('#eyetest-table-body').html(html);
            };

            EyetestSales.override_amt_calc_txt_is_changed = function () {
                let tab_id = window.tabId
                let tr = $(`input[name='${tab_id}bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let supply_amt, vat_amt, sum_amt;
                let bd = { pquote_prc: 0, pquote_qty: 0 };

                bd.pquote_qty = parseFloat(minusComma($(tr).children('td:eq(7)').find('input').val()));
                if (isNaN(bd.pquote_qty) || bd.pquote_qty == '0') {
                    $(tr).children('td:eq(7)').find('input').val(1)
                    bd.pquote_qty = 1
                }

                bd.pquote_prc = parseFloat(minusComma($(tr).children('td:eq(8)').find('input').val()));
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($(tab_id).find('#vat-type-select').find('option:selected').data('vatrate')));

                if (isNaN(bd.pquote_prc)) return;

                $(tr).children('td:eq(7)').find('input').val(bd.pquote_qty.toFixed(window.User['PurchQtyPoint']))
                $(tr).children('td:eq(8)').find('input').val(bd.pquote_prc.toFixed(window.User['PurchPrcPoint']))
                $(tr).children('td:eq(9)').find('input').val(sum_amt.toFixed(window.User['PurchAmtPoint']))

                EyetestSales.bd_pages[tab_id][index].SorderPrc = bd.pquote_prc
                EyetestSales.bd_pages[tab_id][index].SalesQty = bd.pquote_qty
                EyetestSales.bd_pages[tab_id][index].SalesSupply = supply_amt
                EyetestSales.bd_pages[tab_id][index].SalesVat = vat_amt
                EyetestSales.bd_pages[tab_id][index].SalesSum = sum_amt
            }

            EyetestSales.get_bd_parameter = function (bd) {
                let id = parseInt(bd.Id);

                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SalesId: parseInt(bd.SalesId),
                    SeqNo: bd.SeqNo,
                    SalesQty: String(bd.SalesQty),
                    SalesSupply: String(bd.SalesSupply),
                    SalesVat: String(bd.SalesVat),
                    SalesSum: String(bd.SalesSum),
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

            EyetestSales.custom_body_act_success_callback = function ($this, tr) {
                // 합계 계산
                EyetestSales.amt_total_calc();

                let qty = $(tr).children('td:eq(7)').find('input')
                let prc = $(tr).children('td:eq(8)').find('input')
                let sum_amt = $(tr).children('td:eq(9)').find('input')

                $(qty).val( format_conver_for(minusComma($(qty).val()), "decimal('purch_qty')") )
                $(prc).val( format_conver_for(minusComma($(prc).val()), "decimal('purch_prc')") )
                $(sum_amt).val( format_conver_for(minusComma($(sum_amt).val()), "decimal('purch_amt')") )

                if ($($this).data('last')) {
                    EyetestSales.add_tr();
                    $($this).data('last', false)
                }
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
            }

            EyetestSales.add_td_last_tap_out = async function ($this, id) {
                let tab_id = window.tabId
                let tr = $(`input[name='${tab_id}bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
                if (EyetestSales.bd_page[index].ItemId != 0 && ! window.dom_required_check($(tr).find(`input`))) {
                    if ($($this).data('last')) {
                        let seq_no = await Btype.get_last_seq_no('sales', $(tab_id).find('.auto-slip-no-txt').val())
                        EyetestSales.bd_page[index].SeqNo = seq_no;
                    }

                    Btype.call_bd_act_api([ EyetestSales.get_bd_parameter(EyetestSales.bd_page[index]) ], function (page) {
                        EyetestSales.bd_page[index].Id = page[0].Id;

                        EyetestSales.custom_body_act_success_callback($this, tr);
                        Btype.check_the_checkbox_when_changing($this, false, 'EyetestSales')
                    }, 'EyetestSales');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('(*)Required item(s) omitted')),
                    });
                }
            }

            EyetestSales.amt_total_calc = function () {
                let tab_id = window.tabId;
                let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;

                if (isEmpty(EyetestSales.bd_pages[tab_id])) return;

                EyetestSales.bd_pages[tab_id].forEach(bd => {
                    qty_total += parseFloat(bd.SalesQty);
                    supply_total += parseFloat(bd.SalesSupply);
                    vat_amt_vat_total += parseFloat(bd.SalesVat);
                    sum_total += parseFloat(bd.SalesSum);
                })

                $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
            }

            EyetestSales.update_bd_ui = function (bd_page, tab_id) {
                EyetestSales.bd_page = bd_page;
                // table body에 데이터 추가
                EyetestSales.create_bd_page(tab_id);
            }

            EyetestSales.update_hd_ui = function (response, tab_id = window.tabId) {
                Btype.set_slip_no_btn_disabled(`${tab_id} #auto-slip-no-btn`)

                let hd_page = response.data.HdPage[0]
                let bd_page = response.data.BdPage ?? []

                $(tab_id).data('id', hd_page.Id)
                $(tab_id).find(`#sales-frm`).find(`input[name="Id"]`).val(hd_page.Id)
                $(tab_id).find('.auto-slip-no-txt').val(hd_page.SalesNo)
                $(tab_id).find('#sales-date').val(moment(to_date(hd_page.SalesDate)).format('YYYY-MM-DD'))
                $(tab_id).find('#status-select').val(hd_page.Status)
                $(tab_id).find('#deli-user-id-select').val(hd_page.DeliUserId)

                EyetestSales.update_bd_ui(bd_page, tab_id)
            }

        }( window.EyetestSales = window.EyetestSales || {}, jQuery ));

    </script>
@endpush
@endonce
