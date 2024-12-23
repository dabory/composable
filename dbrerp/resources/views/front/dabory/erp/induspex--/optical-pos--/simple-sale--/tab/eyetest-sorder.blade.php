<div class="tab-pane fade show active" id="sorder-tab">
    <button type="button" hidden
        class="btn btn-success btn-open-modal EyetestSorder item-modal-btn"
        data-target="item"
        data-clicked="EyetestSorder.override_get_item_id"
        data-variable="itemModal">
    </button>

    <button type="button" hidden
        class="btn btn-success btn-open-modal modal-btn">
    </button>

    <!-- 입력부분 시작 -->
    <div class="d-flex flex-row align-items-end input_form" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <select class="rounded w-100" id="vat-type-select" hidden>
        </select>
        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
            <div class="col-12 d-flex p-0">
                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                    onclick="EyetestSorder.get_last_slip_no(this)">
                    <span class="icon-cogs"></span>
                </button>
                <input type="text" class="auto-slip-no-txt rounded w-100 radius-l0" autocomplete="off" disabled
                       maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                    {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
            </div>
        </div>

        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['SorderDate'] }}</label>
            <input class="rounded w-100" type="date" value="" id="sorder-date"
                   maxlength="{{ $formB['FormVars']['MaxLength']['SorderDate'] }}"
                {{ $formB['FormVars']['Required']['SorderDate'] }}>
        </div>

        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0 ">{{ $formB['FormVars']['Title']['DealType'] }}</label>
            <select class="rounded w-100" id="deal-type-select"
                    maxlength="{{ $formB['FormVars']['MaxLength']['DealType'] }}"
                {{ $formB['FormVars']['Required']['DealType'] }}>
            </select>
        </div>

        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
            <select class="rounded w-100" id="status-select"
                    maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                {{ $formB['FormVars']['Required']['Status'] }}>
                @foreach($formB['StatusOptions'] as $option)
                <option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['SgroupId'] }}</label>
            <select class="rounded w-100" id="sales-user1-id-select"
                    maxlength="{{ $formB['FormVars']['MaxLength']['SgroupId'] }}"
                {{ $formB['FormVars']['Required']['SgroupId'] }}>
            </select>
        </div>

        <div class="form-group d-flex flex-column" style="width: 143px">
            <label class="m-0">{{ $formB['FormVars']['Title']['Sgroup2Id'] }}</label>
            <select class="rounded w-100" id="sales-user2-id-select"
                    maxlength="{{ $formB['FormVars']['MaxLength']['Sgroup2Id'] }}"
                {{ $formB['FormVars']['Required']['Sgroup2Id'] }}>
            </select>
        </div>

        <div class="d-flex align-items-end mr-2">
            <input type="checkbox" value="1" class="text-center" id="is-closed-check"> <label class="overflow-hidden text-nowrap" for="is-closed-check">{{ $formB['FormVars']['Title']['IsClosed'] }}</label>
        </div>
        <div class="d-flex align-items-end">
            <input type="checkbox" value="1" class="text-center" id="is-sales-completed-check" onClick="return false;"> <label class="overflow-hidden text-nowrap" for="is-sales-completed-check">{{ $formB['FormVars']['Title']['IsSalesCompleted'] }}</label>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mr-1" id="down-btn" onclick="EyetestSorder.override_seq_no_up_down('down')"
                data-clicked="">▼
            </button>
            <button class="btn btn-primary mr-1" id="up-btn" onclick="EyetestSorder.override_seq_no_up_down('up')"
                data-clicked="">▲
            </button>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary overflow-hidden text-nowrap eyetest-sorder-act" data-value="add">{{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                </button>
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['BodySelectOptions'],
                    'eventClassName' => 'eyetest-sorder-act',
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
    <div class="table-footer d-flex justify-content-end border rounded position-relative" id="payment-frm" style="height: 123px">
        <div class="m-0 ml-2 position-absolute left-0">
            <strong>메모</strong>
            <textarea style="height: 80px; width: 330%;" id="remarks-textarea"></textarea>
        </div>
        <strong>{{ $formB['FooterVars']['Title']['Payment'] }}</strong>

        <div class="form-group d-flex flex-column">
            <button type="button" id="bill-type-cc-caption" class="btn-black text-nowrap overflow-hidden"
                    onclick="EyetestSorder.bring_recievable('#bill-type-cc-txt', 'cc')">
                {{ $formB['FooterVars']['Title']['CreditCard'] }}
            </button>
            <div class="d-flex">
                <input class="w-100 decimal" data-id="0" type="text" id="bill-type-cc-txt" data-point="decimal('purch_amt')">
                <button type="button"
                        class="btn-dark border-0 col-4" onclick="return startTransaction()">
                    <i class="fas fa-credit-card fa-lg" style="line-height: 24px;"></i>
                </button>
            </div>
            <label class="m-0 mt-1">{{ $formB['FooterVars']['Title']['CardCompany'] }}</label>
            <select class="rounded w-100" id="card-company-select" required>
            </select>
        </div>

        <div class="form-group d-flex flex-column">
            <button type="button" id="bill-type-cs-caption" class="btn-black text-nowrap overflow-hidden"
                    onclick="EyetestSorder.bring_recievable('#bill-type-cs-txt', 'cs')">
                {{ $formB['FooterVars']['Title']['Cash'] }}
            </button>
            <input class="w-100 decimal" data-id="0" type="text" id="bill-type-cs-txt" data-point="decimal('purch_amt')">
            <label class="m-0 mt-1">{{ $formB['FooterVars']['Title']['CashReceipt'] }}</label>
            <select class="rounded w-100" id="cash-receipt-select" required>
            </select>
        </div>

        <div class="form-group d-flex flex-column">
            <button type="button" id="bill-type-gc-caption" class="btn-black text-nowrap overflow-hidden"
                    onclick="EyetestSorder.bring_recievable('#bill-type-gc-txt', 'gc')">
                {{ $formB['FooterVars']['Title']['Coupon'] }}
            </button>
            <div class="d-flex">
                <input class="w-100 decimal" data-id="0" type="text" id="bill-type-gc-txt" data-point="decimal('purch_amt')">
                <button type="button"
                        class="btn-dark border-0 col-4">
                    <i class="fas fa-gift fa-lg" style="line-height: 24px;"></i>
                </button>
            </div>

            <label class="m-0 mt-1">{{ $formB['FooterVars']['Title']['GiftCard'] }}</label>
            <select class="rounded w-100" id="gift-card-select" required>
            </select>
        </div>

        <div class="form-group d-flex flex-column">
            <button type="button" id="bill-type-uc-caption" class="btn-black text-nowrap overflow-hidden"
                    onclick="EyetestSorder.bring_recievable('#bill-type-uc-txt', 'uc')">
                {{ $formB['FooterVars']['Title']['UserCredit'] }}
            </button>
            <input class="w-100 decimal" data-id="0" type="text" id="bill-type-uc-txt" data-point="decimal('purch_amt')">
            <label class="m-0 mt-1">{{ $formB['FooterVars']['Title']['UserCreditType'] }}</label>
            <select class="rounded w-100" id="user-credit-select" required>
                <option value=""></option>
            </select>
        </div>
    </div>
    <!--// 입금 끝 -->

</div>

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

@push('modal')
    @include('front.outline.static.item-shortcut-input', ['moealSetFile' => $shortcutInputModal])
@endpush

@push('js')
<script src="/js/payment/nicews.js?{{date('YmdHis')}}"></script>
    <script>
        $(document).ready(async function() {
            make_dynamic_table_css('#sorder-tab .eyetest-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#sorder-tab').find('#sorder-date').val(date_to_sting(new Date()))

            $('#sorder-tab').find('.eyetest-sorder-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'item-shortcut-input': EyetestSorder.btn_bd_act_item_shortcut_input(); break;
                    case 'add': EyetestSorder.btn_bd_act_add(); break;
                    case 'body-copy': EyetestSorder.btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'multi-delete': EyetestSorder.override_btn_bd_act_multi_delete(); break;
                    case 'multi-update': EyetestSorder.override_btn_bd_act_multi_update(); break;
                }
            });

            // 입금내역 onchange event
            $(document).on('focusout','#payment-frm input.decimal', function () {
                EyetestSorder.bring_recievable(this, '')
            });

            $(document).on('item.create','#modal-select-popup', async function (event, item_id, quantity) {
                const response = await get_api_data('item-pick', {
                    Page : [ { Id: Number(item_id) } ]
                })

                EyetestSorder.set_item_data_to_textbox(response.data.Page[0], quantity).focus()
                EyetestSorder.override_amt_calc_txt_is_changed()
            });

            $(document).on('add.discount','#modal-item-shortcut-input', async function (event, discount_price, discount_item) {
                await EyetestSorder.add_discount(discount_price, discount_item['ItemCode'])
            });

            $(document).on('add.frequent-item','#modal-item-shortcut-input', async function (event, item_code, sales_qty) {
                await EyetestSorder.add_frequent_item(item_code, sales_qty)
            });

            shortcut.add('F4',function() {
                if ($('#sorder-tab').find('#eyetest-table-body .item-code').is(":focus") ||
                    $('#sorder-tab').find('#eyetest-table-body .item-name').is(":focus")) {
                    show_popup('item', 350)
                }
            });
        });

        (function( EyetestSorder, $, undefined ) {
            EyetestSorder.bd_page = [];
            EyetestSorder.formB = {
                General: {
                    ActApi: 'sorder-act'
                }
            };

            // Public Method
            EyetestSorder.add_discount = async function (discount_price, discount_item_code) {
                if (parseInt($(`#frm`).find('#Id').val()) == 0) {
                    iziToast.error({ title: 'Error', message: @json(_e('Action failed')) });
                    return;
                }

                if (Btype.last_item_added_check('#sorder-tab #eyetest-table-body', 'EyetestSorder')) {
                    return
                }

                const sorder_prc = '-' + minusComma(discount_price)

                const item_pick = await get_api_data('item-pick', {
                    Page: [ { ItemCode: discount_item_code } ]
                })
                const item = item_pick.data.Page[0]

                const sorder_bd = await EyetestSorder.bd_page_append(item, {
                        sorder_qty: 1,
                        sorder_prc: sorder_prc,
                        sorder_supply: 0,
                        sorder_vat: 0,
                        sorder_sum: sorder_prc,
                    },
                    '0',
                    moment().format('YYYYMMDD'),
                    moment().format('YYYYMMDD')
                )

                await EyetestSorder.sorder_bd_act_item_shortcut_input(sorder_bd)
            }

            EyetestSorder.add_frequent_item = async function (item_code, sales_qty) {
                if (parseInt($(`#frm`).find('#Id').val()) == 0) {
                    iziToast.error({ title: 'Error', message: @json(_e('Action failed')) });
                    return;
                }

                if (Btype.last_item_added_check('#sorder-tab #eyetest-table-body', 'EyetestSorder')) {
                    return
                }

                const item_pick = await get_api_data('item-pick', {
                    Page: [ { ItemCode: item_code } ]
                })
                const item = item_pick.data.Page[0]

                const vatrate = parseFloat($('#vat-type-select').find('option:selected').data('vatrate'));
                const is_included = parseFloat($('#vat-type-select').find('option:selected').data('included'));

                const sorder_qty = Number(minusComma(format_conver_for(sales_qty, formB.ListVars['Format'].SorderQty)))
                const sorder_prc = Number(minusComma(format_conver_for(item.SalesPrc, formB.ListVars['Format'].SorderPrc)))

                const [supply_amt, vat_amt, sum_amt] = Btype.amt_calc({
                    pquote_qty: sorder_qty,
                    pquote_prc: sorder_prc
                }, vatrate);

                let sorder_supply, sorder_vat, sorder_sum
                if (is_included) {
                    [sorder_supply, sorder_vat] = Btype.calc_vat_included(supply_amt, vatrate)
                    sorder_sum = supply_amt
                } else {
                    sorder_supply = supply_amt;
                    sorder_vat = vat_amt
                    sorder_sum = sum_amt
                }


                const sorder_bd = await EyetestSorder.bd_page_append(item, {
                        sorder_qty: sorder_qty,
                        sorder_prc: sorder_prc,
                        sorder_supply: sorder_supply,
                        sorder_vat: sorder_vat,
                        sorder_sum: sorder_sum,
                    },
                    Btype.discount_rate_calc(parseInt(minusComma(item.SalesPrc) * parseInt(minusComma(sorder_qty)), parseInt(sorder_sum))),
                    moment().format('YYYYMMDD'),
                    moment().format('YYYYMMDD')
                )

                await EyetestSorder.sorder_bd_act_item_shortcut_input(sorder_bd)
            }

            EyetestSorder.sorder_bd_act_item_shortcut_input = async function (sorder_bd) {
                const response = await get_api_data('sorder-bd-act', {
                    Page: [sorder_bd]
                })

                show_iziToast_msg(response, async function () {
                    await Btype.fetch_slip_form_book($('#sorder-tab').find('.auto-slip-no-txt').val());
                })
            }

            EyetestSorder.bd_page_append = async function (item, sorder, discount_rate = '0', deli_date = '', confirm_date = '') {
                let last_bd_id_inc = 0;
                if (EyetestSorder.bd_page.length > 0) {
                    last_bd_id_inc = EyetestSorder.bd_page[EyetestSorder.bd_page.length - 1].cursorId + 1 || 0
                }

                const seq_no = await Btype.get_last_seq_no('sorder', $('#sorder-tab').find('.auto-slip-no-txt').val())

                const sorder_bd = {
                    cursorId: last_bd_id_inc,
                    Id: 0,
                    ItemId: item['Id'],
                    ItemCode: item['ItemCode'],
                    ItemName: item['ItemName'],
                    SubName: item['SubName'],
                    CountUnit: item['CountUnit'],
                    SeqNo: seq_no,
                    SorderId: parseInt($('#sorder-tab').find(`#frm`).find('#Id').val()),
                    SorderQty: String(sorder['sorder_qty']),
                    SorderPrc: String(sorder['sorder_prc']),
                    SorderSupply: String(sorder['sorder_supply']),
                    SorderVat: String(sorder['sorder_vat']),
                    SorderSum: String(sorder['sorder_sum']),
                    CurrPurchPrc: item.PurchPrc,
                    CurrSalesPrc: item.SalesPrc,
                    DiscountRate: String(discount_rate),
                    IsEnd: '0',
                    DeliDate: deli_date,
                    ConfirmDate: confirm_date,
                    Ref1: '',
                    Ref2: '',
                    Memo: '',
                }

                EyetestSorder.bd_page.push(sorder_bd)

                return sorder_bd
            }

            EyetestSorder.btn_bd_act_item_shortcut_input = async function () {

                $('#modal-item-shortcut-input').modal('show')
            }

            EyetestSorder.bring_recievable = function (txt_id, type) {
                const payment_total = ['cc', 'cs', 'gc', 'uc']
                    .filter(bill_type => type !== bill_type)
                    .reduce((accumulator, bill_type) => accumulator + Number( minusComma($(`#bill-type-${bill_type}-txt`).val() ) ), 0)

                const recievable = remove_comma_and_arithmetic($('#SumTotal').val(), payment_total, 'minus')
                if (recievable < 0) {
                    $(txt_id).val(0)
                    iziToast.error({ title: 'Error',  message: $('#action-failed').text() });
                    return;
                }

                if (isEmpty(type)) {
                    $('#recievable').val(format_conver_for(recievable, formB.ListVars['Format'].SorderPrc))
                } else {
                    $(txt_id).val(format_conver_for(recievable, formB.ListVars['Format'].SorderPrc))
                    $('#recievable').val(0)
                }

                $('#card-total').val($('#bill-type-cc-txt').val() || 0)
                $('#cash-total').val($('#bill-type-cs-txt').val() || 0)
                $('#gift-total').val($('#bill-type-gc-txt').val() || 0)
                $('#user-credit-total').val($('#bill-type-uc-txt').val() || 0)
                // $('#pay-total').val(format_conver_for( remove_comma_and_arithmetic($('#bill-type-cc-txt').val(), $('#bill-type-cs-txt').val(), 'plus'),  formB.ListVars['Format'].SorderPrc ))
                // $('#used-credit-total').val(format_conver_for( remove_comma_and_arithmetic($('#bill-type-gc-txt').val(), $('#bill-type-uc-txt').val(), 'plus'),  formB.ListVars['Format'].SorderPrc ))
            }

            EyetestSorder.override_seq_no_up_down = async function (move) {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let bd = EyetestSorder.bd_page[index]

                if (window.isEmpty(bd) || parseInt($(`#frm`).find('#Id').val()) == 0) {
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
                await Btype.seq_no_up_down(move, data, '#sorder-tab #eyetest-table-body', index, 'EyetestSorder')
                $('#down-btn').prop('disabled', false);
                $('#up-btn').prop('disabled', false);
            };

            // start body act btn
            EyetestSorder.override_btn_bd_act_multi_update = function () {
                Btype.btn_bd_act_multi_update('#sorder-tab .eyetest-table', 'EyetestSorder')
            };

            EyetestSorder.override_btn_bd_act_multi_delete = function () {
                Btype.btn_bd_act_multi_delete('#sorder-tab .eyetest-table', 'EyetestSorder')
            };

            EyetestSorder.btn_bd_act_add = async function () {
                if (parseInt($('#customer-eyetest .frm').find('input[name="Id"]').val()) == 0) {
                    iziToast.warning({
                        title: 'Warning',
                        message: @json(_e('Please select a customer first')),
                    });
                    return;
                }

                if (parseInt($(`#frm`).find('#Id').val()) == 0 && formB['SlipCommonSetup']['IsAutoSaveHdByItemButton']) {
                    if (! await btn_act_save('#sorder-tab #frm')) { return }
                }

                if (! Btype.last_item_added_check('#sorder-tab #eyetest-table-body', 'EyetestSorder')) {
                    EyetestSorder.add_tr();
                }
            };
            // end body act btn

            EyetestSorder.btn_bd_act_body_copy = function (parameter_name) {
                if (parseInt($(`#frm`).find('#Id').val()) == 0) {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('Can NOT copy in the status')),
                    });
                    return;
                }

                if (parameter_name.split('-')[1] !== formB['QueryVars']['QueryName']) {
                    $(`#modal-bodycopy.${parameter_name}`).find('.auto-create-slip-checked').prop('checked', true)
                }

                $(`#modal-bodycopy.${parameter_name}`).find('.slip_no-txt').val($('#sorder-tab').find('.auto-slip-no-txt').val())
                $(`#modal-bodycopy.${parameter_name}`).find('.company_name-txt').val($('#customer-eyetest').find('.auto-slip-no-txt').val())

                let data = formB['BodySelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
                $('#sorder-tab').find('.modal-btn').data('target', 'bodycopy')
                $('#sorder-tab').find('.modal-btn').data('variable', data['Parameter'])
                $('#sorder-tab').find('.modal-btn').data('class', parameter_name)
                $('#sorder-tab').find('.modal-btn').trigger('click')
                $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#sorder-tab').find('.auto-slip-no-txt').val() )
            }

            EyetestSorder.add_tr = async function () {
                let last_bd_id_inc = 0;
                if (EyetestSorder.bd_page.length > 0) {
                    last_bd_id_inc = EyetestSorder.bd_page[EyetestSorder.bd_page.length - 1].cursorId + 1 || 0
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
                        <td onkeydown="Btype.enterPressedinCell(event, 1, 'EyetestSorder')"
                            class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white item-code"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            id="item-code-${last_bd_id_inc}" required>
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 2, 'EyetestSorder')"
                            class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white item-name"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')" required>
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
                            <input type="text" class="text-${formB.ListVars['Align'].SorderQty} border-0 bg-white"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SorderPrc}" ${formB.ListVars['Hidden'].SorderPrc}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SorderPrc} border-0 bg-white"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_custom_sum_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].ConfirmDate}" ${formB.ListVars['Hidden'].ConfirmDate}
                            >
                            <input type="date" class="text-${formB.ListVars['Align'].ConfirmDate} border-0 bg-white confirm-date"
                            value="${moment().format('YYYY-MM-DD')}"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].DeliDate}" ${formB.ListVars['Hidden'].DeliDate}
                            >
                            <input type="date" class="text-${formB.ListVars['Align'].DeliDate} border-0 bg-white deli-date"
                            value="${moment().format('YYYY-MM-DD')}"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            data-last=true onfocusout="EyetestSorder.add_td_last_tap_out(this, ${last_bd_id_inc})"
                            class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt"
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].Memo} memo-td" ${formB.ListVars['Hidden'].Memo}>
                        </td>
                    </tr>`;


                $('#sorder-tab').find('#eyetest-table-body').append(html)

                await setTimeout( function() {
                    $('#sorder-tab').find(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                    $('#sorder-tab').find(`#item-code-${last_bd_id_inc}`).focus()
                }, 100);

                EyetestSorder.bd_page.push({
                    cursorId: last_bd_id_inc,
                    Id: 0,
                    ItemId: 0,
                    ItemCode: '',
                    ItemName: '',
                    SubName: '',
                    CountUnit: '',
                    SeqNo: 0,
                    SorderId: parseInt($('#sorder-tab').find(`#frm`).find('#Id').val()),
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
                    Memo: '',
                })
            };

            EyetestSorder.create_bd_page = function () {
                let html = []
                let sum_total = 0;
                EyetestSorder.bd_page.forEach(bd => {
                    sum_total += parseFloat( minusComma( format_conver_for(bd.SorderSum, formB.ListVars['Format'].SumAmt) ) );

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
                        <td onkeydown="Btype.enterPressedinCell(event, 1, 'EyetestSorder')"
                            class="text-${formB.ListVars['Align'].ItemCode}" ${formB.ListVars['Hidden'].ItemCode}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemCode} border-0 bg-white" value="${bd.ItemCode}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')" required>
                        </td>
                        <td onkeydown="Btype.enterPressedinCell(event, 2, 'EyetestSorder')"
                            class="text-${formB.ListVars['Align'].ItemName}" ${formB.ListVars['Hidden'].ItemName}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].ItemName} border-0 bg-white" value="${bd.ItemName}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')" required>
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
                            <input type="text" class="text-${formB.ListVars['Align'].SorderQty} border-0 bg-white" value="${format_conver_for(bd.SorderQty, formB.ListVars['Format'].SorderQty)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SorderPrc}" ${formB.ListVars['Hidden'].SorderPrc}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SorderPrc} border-0 bg-white" value="${format_conver_for(bd.SorderPrc, formB.ListVars['Format'].SorderPrc)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_amt_calc_txt_is_changed()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].SumAmt}" ${formB.ListVars['Hidden'].SumAmt}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].SumAmt} border-0 bg-white" value="${format_conver_for(bd.SorderSum, formB.ListVars['Format'].SumAmt)}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.override_custom_sum_amt()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].ConfirmDate}" ${formB.ListVars['Hidden'].ConfirmDate}
                            >
                            <input type="date" class="text-${formB.ListVars['Align'].ConfirmDate} border-0 bg-white confirm-date" value="${isEmpty(bd.ConfirmDate) ? '' : moment(bd.ConfirmDate).format('YYYY-MM-DD')}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].DeliDate}" ${formB.ListVars['Hidden'].DeliDate}
                            >
                            <input type="date" class="text-${formB.ListVars['Align'].DeliDate} border-0 bg-white deli-date" value="${isEmpty(bd.DeliDate) ? '' : moment(bd.DeliDate).format('YYYY-MM-DD')}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()"
                            required>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].Ref1}" ${formB.ListVars['Hidden'].Ref1}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref1} border-0 bg-white ref1-txt" value="${bd.Ref1}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            onfocusout="EyetestSorder.add_td_last_tap_out(this, ${bd.Id})"
                            class="text-${formB.ListVars['Align'].Ref2}" ${formB.ListVars['Hidden'].Ref2}
                            >
                            <input type="text" class="text-${formB.ListVars['Align'].Ref2} border-0 bg-white ref2-txt" value="${bd.Ref2}" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this, true, 'EyetestSorder')"
                            onfocusout="EyetestSorder.save_data_when_entering_text()">
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].Memo} memo-td" ${formB.ListVars['Hidden'].Memo}>${bd.Memo}
                        </td>
                    </tr>` )
                });

                $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
                window.update_recievable_calc();

                document.getElementById('sorder-tab').querySelector('#eyetest-table-body').innerHTML = html.join('');
                // $('#sorder-tab').find('#eyetest-table-body').html(html);
            };

            EyetestSorder.create_etc_select_box_options = function (data) {
                let card_company = window.create_options(data.EtcCardCompanyPage)
                let cash_receipt = window.create_options(data.EtcCashReceiptPage)
                let sales_coupon = window.create_options(data.EtcGiftCardPage)
                let user_credit = window.create_options(data.EtcUserCreditPage)
                // let status = window.create_options(data.EtcSalesStatusPage)
                let sgroup1 = window.custom_create_options('Id', 'SgroupName', data.Sgroup1Page)
                let sgroup2 = window.custom_create_options('Id', 'SgroupName', data.Sgroup2Page)

                $('#sorder-tab').find('#card-company-select').append(card_company);
                $('#sorder-tab').find('#cash-receipt-select').append(cash_receipt);
                $('#sorder-tab').find('#gift-card-select').append(sales_coupon);
                $('#sorder-tab').find('#user-credit-select').append(user_credit);
                // $('#sorder-tab').find('#status-select').append(status);

                $('#sorder-tab').find('#sales-user1-id-select').append(sgroup1);
                $('#sorder-tab').find('#sales-user2-id-select').append(sgroup2);
            }

            EyetestSorder.get_last_slip_no = async function ($this) {
                Btype.set_slip_no_btn_disabled('#sorder-tab #auto-slip-no-btn')
                let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
                $('#sorder-tab').find('.auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            }

            EyetestSorder.override_custom_sum_amt = function () {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let sum_amt = parseFloat(minusComma($(tr).children('td:eq(8)').find('input').val()));

                if (isNaN(sum_amt)) return;

                $(tr).children('td:eq(8)').find('input').val(sum_amt.toFixed(window.User['SalesAmtPoint']))

                EyetestSorder.bd_page[index].SorderSum = sum_amt
            }

            EyetestSorder.override_amt_calc_txt_is_changed = function () {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length
                let supply_amt, vat_amt, sum_amt
                let sorder_supply, sorder_vat, sorder_sum
                const vatrate = parseFloat($('#vat-type-select').find('option:selected').data('vatrate'));
                const is_included = parseFloat($('#vat-type-select').find('option:selected').data('included'));


                Btype.amt_calc_txt_is_changed(tr, function (bd) {
                    [supply_amt, vat_amt, sum_amt] = Btype.amt_calc(bd, vatrate);

                    if (isNaN(bd.pquote_prc)) return;

                    if (is_included) {
                        [sorder_supply, sorder_vat] = Btype.calc_vat_included(supply_amt, vatrate)
                        sorder_sum = supply_amt
                    } else {
                        sorder_supply = supply_amt;
                        sorder_vat = vat_amt
                        sorder_sum = sum_amt
                    }

                    $(tr).children('td:eq(6)').find('input').val(format_conver_for(bd.pquote_qty, formB.ListVars['Format'].SorderQty))
                    $(tr).children('td:eq(7)').find('input').val(format_conver_for(bd.pquote_prc, formB.ListVars['Format'].SorderPrc))
                    $(tr).children('td:eq(8)').find('input').val(format_conver_for(sorder_sum, formB.ListVars['Format'].SumAmt))

                    EyetestSorder.bd_page[index].SorderPrc = bd.pquote_prc
                    EyetestSorder.bd_page[index].SorderQty = bd.pquote_qty
                    EyetestSorder.bd_page[index].SorderSupply = sorder_supply
                    EyetestSorder.bd_page[index].SorderVat = sorder_vat
                    EyetestSorder.bd_page[index].SorderSum = sorder_sum
                })
            }

            EyetestSorder.save_data_when_entering_text = function () {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                EyetestSorder.bd_page[index].ConfirmDate = $(tr).find('.confirm-date').val()
                EyetestSorder.bd_page[index].DeliDate = $(tr).find('.deli-date').val()
                EyetestSorder.bd_page[index].Ref1 = $(tr).find('.ref1-txt').val()
                EyetestSorder.bd_page[index].Ref2 = $(tr).find('.ref2-txt').val()
                EyetestSorder.bd_page[index].Descript = $(tr).find('.memo-td').text()
            }

            EyetestSorder.get_bd_parameter = function (bd) {
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
                    Memo: bd.Memo,
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

                // console.log(parameter)
                return parameter;
            }

            EyetestSorder.set_item_data_to_textbox = function (item, quantity = 0) {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                $(tr).children('td:eq(2)').find('input').val(item.ItemCode)
                $(tr).children('td:eq(3)').find('input').val(item.ItemName)
                $(tr).children('td:eq(4)').text(item.SubName)
                $(tr).children('td:eq(5)').text(item.CountUnit)
                $(tr).children('td:eq(6)').find('input').val(quantity || 1)
                $(tr).children('td:eq(7)').find('input').val(format_conver_for(item.SalesPrc, formB.ListVars['Format'].SorderPrc))

                let index = $(tr).prevAll().length;
                EyetestSorder.bd_page[index].ItemId = item.Id
                EyetestSorder.bd_page[index].ItemCode = item.ItemCode
                EyetestSorder.bd_page[index].ItemName = item.ItemName
                EyetestSorder.bd_page[index].SubName = item.SubName
                EyetestSorder.bd_page[index].CountUnit = item.CountUnit
                EyetestSorder.bd_page[index].SorderPrc = item.SalesPrc
                EyetestSorder.bd_page[index].CurrPurchPrc = item.PurchPrc
                EyetestSorder.bd_page[index].CurrSalesPrc = item.SalesPrc

                if (quantity >= 1) {
                    return $(tr).children('td').find('.confirm-date')
                }
                return $(tr).children('td:eq(6)').find('input')
            }

            EyetestSorder.override_get_item_id = function (item_id) {
                Btype.get_item_id(item_id, 'EyetestSorder')
            }

            EyetestSorder.amt_total_calc = function () {
                if (isEmpty(EyetestSorder.bd_page)) return;

                let sum_total = 0;

                EyetestSorder.bd_page.forEach(bd => {
                    sum_total += parseFloat( minusComma( format_conver_for(bd.SorderSum, formB.ListVars['Format'].SumAmt) ) );
                })

                $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].SumAmt));
                window.update_recievable_calc();
            }

            EyetestSorder.custom_body_act_success_callback = function ($this, tr) {
                // 합계 계산
                EyetestSorder.amt_total_calc();

                let qty = $(tr).children('td:eq(6)').find('input')
                let prc = $(tr).children('td:eq(7)').find('input')
                let supply_amt = $(tr).children('td:eq(8)').find('input')

                $(qty).val( format_conver_for(minusComma($(qty).val()), "decimal('sales_qty')") )
                $(prc).val( format_conver_for(minusComma($(prc).val()), "decimal('sales_prc')") )
                $(supply_amt).val( format_conver_for(minusComma($(supply_amt).val()), "decimal('sales_amt')") )

                if ($($this).data('last')) {
                    EyetestSorder.add_tr();
                    $($this).data('last', false)
                }
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
            }

            EyetestSorder.add_td_last_tap_out = async function ($this, id) {
                let tr = $('#sorder-tab').find(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
                if (EyetestSorder.bd_page[index].ItemId != 0 && ! window.dom_required_check($(tr).find(`input`))) {
                    if ($($this).data('last')) {
                        let seq_no = await Btype.get_last_seq_no('sorder', $('#sorder-tab').find('.auto-slip-no-txt').val())
                        EyetestSorder.bd_page[index].SeqNo = seq_no;
                    }

                    Btype.call_bd_act_api([ EyetestSorder.get_bd_parameter(EyetestSorder.bd_page[index]) ], function (page) {
                        EyetestSorder.bd_page[index].Id = page[0].Id;

                        EyetestSorder.custom_body_act_success_callback($this, tr);
                        Btype.check_the_checkbox_when_changing($this, false, 'EyetestSorder')
                    }, 'EyetestSorder');
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('(*)Required item(s) omitted')),
                    });
                }
            }

            EyetestSorder.update_bd_ui = function (bd_page) {
                EyetestSorder.bd_page = bd_page;
                // table body에 데이터 추가
                EyetestSorder.create_bd_page();

                if (EyetestSorder.bd_page.length > 0) {
                    let unique = EyetestSorder.bd_page[EyetestSorder.bd_page.length - 1].SeqNo * EyetestSorder.bd_page[EyetestSorder.bd_page.length - 1].Id + rand(1, 999);
                    EyetestSorder.bd_page[EyetestSorder.bd_page.length - 1].cursorId = unique
                }
            }

        }( window.EyetestSorder = window.EyetestSorder || {}, jQuery ));

        function startTransaction()
        {
            var FS = '\x1C';
            var sendbuf = 'D1' + FS + FS + FS + '00' + FS + FS + FS + $('#bill-type-cc-txt').val().replace(',', '') + FS + FS + FS + FS + FS;
            POSSEND("8088","PCAT", sendbuf, RecvData);
        }

        function RecvData(rtn, recvBuf)
        {
            if(rtn == 1)
            {
                console.log(recvBuf)
            }else
            {

            }
        }
    </script>
@endpush
