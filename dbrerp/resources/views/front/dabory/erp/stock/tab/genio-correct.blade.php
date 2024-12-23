<div class="tab-pane fade show active" id="correct-tab">
    <button type="button" hidden
        class="btn btn-success btn-open-modal GenioCorrect item-modal-btn"
        data-target="item"
        data-clicked="GenioCorrect.override_get_item_id"
        data-variable="itemModal">
    </button>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mr-1" id="down-btn" onclick="GenioCorrect.override_seq_no_up_down('down')"
            data-clicked="">▼
        </button>
        <button class="btn btn-primary mr-1" id="up-btn" onclick="GenioCorrect.override_seq_no_up_down('up')"
            data-clicked="">▲
        </button>
        <div class="btn-group">
            <button class="btn btn-sm btn-primary genio-correct-act disabled-if-saved" data-value="add">
                    {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => $formB['BodySelectOptions'],
                'eventClassName' => 'genio-correct-act'
            ])
        </div>
    </div>

    <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
        <table class="table-row genio-table">
            <thead id="genio-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
            </thead>
            <tbody id="genio-table-body">

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
        <div class="d-flex flex-column flex-md-row" id="total-frm">
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

@push('js')
    <script>
        $(document).ready(async function() {
            make_dynamic_table_css('#correct-tab .genio-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#correct-tab').find('.genio-correct-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': GenioCorrect.btn_bd_act_add(); break;
                    case 'body-copy': GenioCorrect.btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'multi-delete': GenioCorrect.override_btn_bd_act_multi_delete(); break;
                    case 'multi-update': GenioCorrect.override_btn_bd_act_multi_update(); break;
                }
            });

            $(document).on('complete.memo2', '#modal-memo2', function (e, txtarea_id, id) {
                if (txtarea_id !== '#remarks-txt-area') {
                    Btype.call_bd_act_api([ { Id: Number(id), GenioMemo: $(txtarea_id).val() } ], function () {
                        const index = GenioCorrect.bd_page.findIndex(bd => bd['Id'] === id)
                        GenioCorrect.bd_page[index].GenioMemo = $(txtarea_id).val()

                        iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
                    }, 'GenioCorrect')
                }
            });
        });

        $('#genio-table-body').on('click', 'tr', function() {
                // Find the input element with name="bd-cursor-state" within the clicked row
                const $bdCursorStateInput = $(this).find('input[name="bd-cursor-state"]');
                if ($bdCursorStateInput.length) {
                    $($bdCursorStateInput).prop('checked', true)
                    Btype.bd_cursor_click($bdCursorStateInput)
                }
            });

        (function( GenioCorrect, $, undefined ) {
            GenioCorrect.bd_page = []
            GenioCorrect.formB = {!! json_encode($formB) !!}

            GenioCorrect.override_seq_no_up_down = async function (move) {
                let tr = $('#correct-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let bd = GenioCorrect.bd_page[index]

                if (window.isEmpty(bd) || parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('Can NOT move UP or DOWN in the status')),
                    });
                    return;
                }

                let data = {
                    BdTableName: 'dbr_genio_bd',
                    HdIdName: 'genio_id',
                    HdId: parseInt(bd.GenioId),
                    CurrId: parseInt(bd.Id),
                    Move: move,
                }

                $('#down-btn').prop('disabled', true);
                $('#up-btn').prop('disabled', true);
                await Btype.seq_no_up_down(move, data, '#correct-tab #genio-table-body', index, 'GenioCorrect')
                $('#down-btn').prop('disabled', false);
                $('#up-btn').prop('disabled', false);
            };

            // start body act btn
            GenioCorrect.override_btn_bd_act_multi_update = function () {
                Btype.btn_bd_act_multi_update('#correct-tab .genio-table', 'GenioCorrect')
            };

            GenioCorrect.override_btn_bd_act_multi_delete = function () {
                Btype.btn_bd_act_multi_delete('#correct-tab .genio-table', 'GenioCorrect')
            };

            GenioCorrect.btn_bd_act_add = async function () {
                if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                    if (! await Btype.btn_act_add_chain('#genio-form #frm')) { return }
                }

                if (! Btype.last_item_added_check('#correct-tab #genio-table-body', 'GenioCorrect')) {
                    GenioCorrect.add_tr();
                }
            };

            GenioCorrect.btn_bd_act_body_copy = async function (parameter_name) {
                Btype.btn_act_save('#genio-form #frm', async function () {
                    if (parseInt($('#frm').find('#Id').val()) == 0) {
                        return iziToast.error({
                            title: 'Error',
                            message: @json(_e('Can NOT copy in the status')),
                        });
                    }

                    // $(`#modal-bodycopy.${parameter_name}`).find('.slip_no-txt').val($('#auto-slip-no-txt').val())
                    $(`#modal-bodycopy.${parameter_name}`).find('.company_name-txt').val($('#supplier-txt').val())
                    let data = formB['BodySelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
                    $('.stock').find('.modal-btn').data('target', 'bodycopy')
                    $('.stock').find('.modal-btn').data('variable', data['Parameter'])
                    $('.stock').find('.modal-btn').data('class', parameter_name)
                    $('.stock').find('.modal-btn').trigger('click')
                    $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#auto-slip-no-txt').val() )
                });

        }
            // end body act btn

            GenioCorrect.add_tr = async function () {
                let last_bd_id_inc = 0;
                if (GenioCorrect.bd_page.length > 0) {
                    last_bd_id_inc = GenioCorrect.bd_page[GenioCorrect.bd_page.length - 1].cursorId + 1 || 0
                }

                let html =
                `<tr>
                        <td class="text-${formB.ListVars['Align'].$Radio} px-import-0" ${formB.ListVars['Hidden'].$Radio}>
                            <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${formB.ListVars['Align'].$Radio}"
                            id="bd-cursor-state-${last_bd_id_inc}"
                            onclick="Btype.bd_cursor_click(this)">
                        </td>
                        <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                            <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${formB.ListVars['Align'].$Check}">
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 1, 'GenioCorrect')"
                            class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            id="item-code-${last_bd_id_inc}" required>
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 2, 'GenioCorrect')"
                            class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')" required>
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].GenioQty}" ${formB.ListVars['Hidden'].GenioQty}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].GenioQty} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].GenioPrc}" ${formB.ListVars['Hidden'].GenioPrc}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].GenioPrc} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_supply_amt_or_vat_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_supply_amt_or_vat_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_sum_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            data-last=true onfocusout="GenioCorrect.add_td_last_tap_out(this, ${last_bd_id_inc})"
                            class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.save_data_when_entering_text()">
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].GenioMemo}" ${formB.ListVars['Hidden'].GenioMemo}>
                            <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                                ondblclick="Btype.dblclick_memo_textarea(this, ${last_bd_id_inc}, 'GenioCorrect')" id="memo-textarea-${last_bd_id_inc}" role="button" readonly></textarea>
                        </td>
                    </tr>`;


                $('#correct-tab').find('#genio-table-body').append(html)

                await setTimeout( function() {
                    $('#correct-tab').find(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                    $('#correct-tab').find(`#item-code-${last_bd_id_inc}`).focus()
                }, 100);

                GenioCorrect.bd_page.push({
                    cursorId: last_bd_id_inc,
                    Id: 0,
                    ItemId: 0,
                    ItemCode: '',
                    ItemName: '',
                    SubName: '',
                    CountUnit: '',
                    SeqNo: 0,
                    GenioId: parseInt($(`#frm`).find(`input[name="Id"]`).val()),
                    GenioPrc: 0,
                    GenioQty: 0,
                    GenioSupply: 0,
                    GenioVat: 0,
                    GenioSum: 0,
                    Ref1: '',
                    Ref2: '',
                    GenioMemo: '',
                })
            };

            GenioCorrect.create_bd_page = function () {
                let html = []
                let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;
                GenioCorrect.bd_page.forEach(bd => {
                    qty_total += parseFloat(bd.GenioQty);
                    supply_total += parseFloat(bd.GenioSupply);
                    vat_amt_vat_total += parseFloat(bd.GenioVat);
                    sum_total += parseFloat(bd.GenioSum);

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
                        <td onkeydown="Btype.enterPressedinCell(event, 1, 'GenioCorrect')"
                            class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" value="${bd.ItemCode}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')" required>
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 2, 'GenioCorrect')"
                            class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" value="${bd.ItemName}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')" required>
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].SubName}" ${formB.ListVars['Hidden'].SubName}>${bd.SubName}
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].CountUnit}" ${formB.ListVars['Hidden'].CountUnit}>${bd.CountUnit}
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].GenioQty}" ${formB.ListVars['Hidden'].GenioQty}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].GenioQty} border-0 bg-white" value="${format_conver_for(bd.GenioQty, formB.ListVars['Format'].GenioQty)}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].GenioPrc}" ${formB.ListVars['Hidden'].GenioPrc}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].GenioPrc} border-0 bg-white" value="${format_conver_for(bd.GenioPrc, formB.ListVars['Format'].GenioPrc)}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SupplyAmt}" ${formB.ListVars['Hidden'].SupplyAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SupplyAmt} border-0 bg-white" value="${format_conver_for(bd.GenioSupply, formB.ListVars['Format'].SupplyAmt)}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_supply_amt_or_vat_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].VatAmt}" ${formB.ListVars['Hidden'].VatAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].VatAmt} border-0 bg-white" value="${format_conver_for(bd.GenioVat, formB.ListVars['Format'].VatAmt)}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_supply_amt_or_vat_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.GenioSum, formB.ListVars['Format'].SumAmt)}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.override_custom_sum_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt" value="${bd.Ref1}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            onfocusout="GenioCorrect.add_td_last_tap_out(this, ${bd.Id})"
                            class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt" value="${bd.Ref2}" readonly
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'GenioCorrect')"
                            onfocusout="GenioCorrect.save_data_when_entering_text()">
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].GenioMemo}" ${formB.ListVars['Hidden'].GenioMemo}>
                            <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea" id="memo-textarea-${bd.Id}"
                                ondblclick="Btype.dblclick_memo_textarea(this, ${bd.Id}, 'GenioCorrect')" role="button" readonly>${bd.GenioMemo}</textarea>
                        </td>
                    </tr>` )
                });

                $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].PorderQty));
                $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
                $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
                $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));

                document.getElementById('genio-table-body').innerHTML = html.join('');
                // $('#correct-tab').find('#genio-table-body').html(html);
            };

            GenioCorrect.override_amt_calc_txt_is_changed = function () {
                let tr = $('#correct-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let supply_amt, vat_amt, sum_amt;

                Btype.amt_calc_txt_is_changed(tr, function (bd) {
                    [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));

                    if (isNaN(bd.pquote_prc)) return;

                    $(tr).children('td:eq(6)').find('input').val(bd.pquote_qty.toFixed(window.User['StockQtyPoint']))
                    $(tr).children('td:eq(7)').find('input').val(bd.pquote_prc.toFixed(window.User['StockPrcPoint']))

                    $(tr).children('td:eq(8)').find('input').val(supply_amt.toFixed(window.User['StockAmtPoint']))
                    $(tr).children('td:eq(9)').find('input').val(vat_amt.toFixed(window.User['StockAmtPoint']))
                    $(tr).children('td:eq(10)').find('input').val(sum_amt.toFixed(window.User['StockAmtPoint']))

                    GenioCorrect.bd_page[index].GenioPrc = bd.pquote_prc
                    GenioCorrect.bd_page[index].GenioQty = bd.pquote_qty
                    GenioCorrect.bd_page[index].GenioSupply = supply_amt
                    GenioCorrect.bd_page[index].GenioVat = vat_amt
                    GenioCorrect.bd_page[index].GenioSum = sum_amt
                })
            }

            GenioCorrect.override_custom_supply_amt_or_vat_amt = function () {
                Btype.custom_supply_amt_or_vat_amt(function (supply_amt, vat_amt, sum_amt, index) {
                    GenioCorrect.bd_page[index].GenioSupply = supply_amt
                    GenioCorrect.bd_page[index].GenioVat = vat_amt
                    GenioCorrect.bd_page[index].GenioSum = sum_amt
                })
            }

            GenioCorrect.override_custom_sum_amt = function () {
                Btype.custom_sum_amt(function (sum_amt, index) {
                    GenioCorrect.bd_page[index].GenioSum = sum_amt
                })
            }

            GenioCorrect.save_data_when_entering_text = function () {
                let tr = $('#correct-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                GenioCorrect.bd_page[index].Ref1 = $(tr).find('.ref1-txt').val()
                GenioCorrect.bd_page[index].Ref2 = $(tr).find('.ref2-txt').val()
            }

            GenioCorrect.set_item_data_to_textbox = function (item) {
                let tr = $('#correct-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                $(tr).children('td:eq(2)').find('input').val(item.ItemCode)
                $(tr).children('td:eq(3)').find('input').val(item.ItemName)
                $(tr).children('td:eq(4)').text(item.SubName)
                $(tr).children('td:eq(5)').text(item.CountUnit)
                $(tr).children('td:eq(6)').find('input').val()
                // $(tr).children('td:eq(7)').find('input').val(parseFloat(item.PurchPrc).toFixed(window.User['PurchPrcPoint']))
                $(tr).children('td:eq(7)').find('input').val(parseFloat(item.SalesPrc).toFixed(window.User['SalesPrcPoint']))


                let index = $(tr).prevAll().length;
                GenioCorrect.bd_page[index].ItemId = item.Id
                GenioCorrect.bd_page[index].ItemCode = item.ItemCode
                GenioCorrect.bd_page[index].ItemName = item.ItemName
                GenioCorrect.bd_page[index].SubName = item.SubName
                GenioCorrect.bd_page[index].CountUnit = item.CountUnit
                GenioCorrect.bd_page[index].GenioPrc = item.SalesPrc
                // GenioCorrect.bd_page[index].GenioPrc = item.PurchPrc

                if (GenioCorrect.bd_page[index].Id === 0) {
                    $(tr).children('td:eq(13)').find('textarea').val(item.ItemMemo)
                    GenioCorrect.bd_page[index].GenioMemo = item.ItemMemo
                }

                return $(tr).children('td:eq(6)').find('input')
            }

            GenioCorrect.amt_total_calc = function () {
                let qty_total = 0, supply_total = 0, vat_amt_vat_total = 0, sum_total = 0;

                GenioCorrect.bd_page.forEach(bd => {
                    qty_total += parseFloat(bd.GenioQty);
                    supply_total += parseFloat(bd.GenioSupply);
                    vat_amt_vat_total += parseFloat(bd.GenioVat);
                    sum_total += parseFloat(bd.GenioSum);
                })

                $('#QtyTotal').val(format_conver_for(qty_total, formB.ListVars['Format'].GenioQty));
                $('#SupplyTotal').val(format_conver_for(supply_total, formB.ListVars['Format'].SupplyAmt));
                $('#VatTotal').val(format_conver_for(vat_amt_vat_total, formB.ListVars['Format'].VatAmt));
                $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
            }

            GenioCorrect.custom_body_act_success_callback = function ($this, tr) {
                // 합계 계산
                GenioCorrect.amt_total_calc();

                let qty = $(tr).children('td:eq(6)').find('input')
                let prc = $(tr).children('td:eq(7)').find('input')
                let supply_amt = $(tr).children('td:eq(8)').find('input')
                let vat_amt = $(tr).children('td:eq(9)').find('input')
                let sum_amt = $(tr).children('td:eq(10)').find('input')

                $(qty).val( format_conver_for(minusComma($(qty).val()), formB.ListVars['Format'].GenioQty) )
                $(prc).val( format_conver_for(minusComma($(prc).val()), formB.ListVars['Format'].GenioPrc) )
                $(supply_amt).val( format_conver_for(minusComma($(supply_amt).val()), formB.ListVars['Format'].SupplyAmt) )
                $(vat_amt).val( format_conver_for(minusComma($(vat_amt).val()), formB.ListVars['Format'].VatAmt) )
                $(sum_amt).val( format_conver_for(minusComma($(sum_amt).val()), formB.ListVars['Format'].SumAmt) )

                if ($($this).data('last')) {
                    GenioCorrect.add_tr();
                    $($this).data('last', false)
                }
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
            }

            GenioCorrect.add_td_last_tap_out = async function ($this, id) {
                // Btype.btn_act_save('#genio-form #frm', async function () {
                    let tr = $('#correct-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                    let index = $(tr).prevAll().length
                    // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
                    if (GenioCorrect.bd_page[index].ItemId != 0 && ! window.dom_required_check($(tr).find(`input`))) {
                        if ($($this).data('last')) {
                            let seq_no = await Btype.get_last_seq_no('genio', $('#genio-form').find('#auto-slip-no-txt').val())
                            GenioCorrect.bd_page[index].SeqNo = seq_no;
                        }

                        Btype.call_bd_act_api([ GenioCorrect.get_bd_parameter(GenioCorrect.bd_page[index]) ], function (page) {
                            GenioCorrect.bd_page[index].Id = page[0].Id;
                            GenioCorrect.custom_body_act_success_callback($this, tr);
                            Btype.check_the_checkbox_when_changing($this, false, 'GenioCorrect')
                        }, 'GenioCorrect');
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: @json(_e('(*)Required item(s) omitted')),
                        });
                    }
                // });
            }

            GenioCorrect.get_bd_parameter = function (bd) {
                let id = parseInt(bd.Id);
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    GenioId: parseInt(bd.GenioId),
                    SeqNo: bd.SeqNo,
                    ItemId: parseInt(bd.ItemId),
                    GenioQty: String(bd.GenioQty),
                    GenioPrc: String(bd.GenioPrc),
                    GenioSupply: String(bd.GenioSupply),
                    GenioVat: String(bd.GenioVat),
                    GenioSum: String(bd.GenioSum),
                    Ref1: bd.Ref1,
                    Ref2: bd.Ref2,
                    GenioMemo: bd.GenioMemo,
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

            GenioCorrect.override_get_item_id = function (item_id) {
                Btype.get_item_id(item_id, 'GenioCorrect')
            }

            GenioCorrect.update_bd_ui = function (bd_page) {
                GenioCorrect.bd_page = bd_page;
                // table body에 데이터 추가
                GenioCorrect.create_bd_page();

                if (GenioCorrect.bd_page.length > 0) {
                    let unique = GenioCorrect.bd_page[GenioCorrect.bd_page.length - 1].SeqNo * GenioCorrect.bd_page[GenioCorrect.bd_page.length - 1].Id + rand(1, 999);
                    GenioCorrect.bd_page[GenioCorrect.bd_page.length - 1].cursorId = unique
                }
            }

        }( window.GenioCorrect = window.GenioCorrect || {}, jQuery ));
    </script>
@endpush
