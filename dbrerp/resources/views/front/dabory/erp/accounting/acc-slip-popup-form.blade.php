<div class="mb-1 pt-2 text-right btn-groups">
    <div class="btn-group" id="acc-slip-btn-group">
        <button type="button" class="btn btn-sm btn-primary acc-slip-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formB['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formB['HeadSelectOptions'],
            'eventClassName' => 'acc-slip-act',
        ])
    </div>
</div>

<div class="card" id="acc-slip-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="auto-slip-amt" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                            <div class="col-12 d-flex p-0">
                                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                    onclick="AccountingAccSlipPopupForm.get_last_slip_no(this)">
                                    <span class="icon-cogs"></span>
                                </button>
                                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                       maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                    {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['AccDate'] }}</label>
                            <input class="rounded w-100" type="date" value="" id="acc-date"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['AccDate'] }}"
                                {{ $formB['FormVars']['Required']['AccDate'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['SlipAmt'] }}</label>
                            <input type="text" id="slip-amt-txt" class="rounded w-100 decimal" autocomplete="off"
                                   data-point="{{ $formB['FormVars']['Format']['SlipAmt'] }}"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['SlipAmt'] }}"
                                {{ $formB['FormVars']['Required']['SlipAmt'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['BillColumn1'] }}</label>
                            <input type="text" id="bill-column1-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['BillColumn1'] }}"
                                {{ $formB['FormVars']['Required']['BillColumn1'] }}>
                        </div>
                        <div class="form-group {{ $formB['FormVars']['Display']['CardCheckNo'] }} flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['CardCheckNo'] }}</label>
                            <input class="rounded w-100" type="text" id="card-check-no"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['CardCheckNo'] }}"
                                {{ $formB['FormVars']['Required']['CardCheckNo'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item" hidden>
                <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 200px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formB['FormVars']['Display']['SorderNo'] }} flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['SorderNo'] }}</label>
                            <input type="text" id="sorder-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['SorderNo'] }}"
                                {{ $formB['FormVars']['Required']['SorderNo'] }}>
                        </div>
                        <div class="form-group {{ $formB['FormVars']['Display']['PorderNo'] }} flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['PorderNo'] }}</label>
                            <input type="text" id="porder-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['PorderNo'] }}"
                                {{ $formB['FormVars']['Required']['PorderNo'] }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0 mt-2 mx-2">
        <div class="table-responsive mt-2" style="height:143px;" id="scroll-area">
            <table class="table-row acc-slip-table">
                <thead id="acc-slip-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
                </thead>
                <tbody id="acc-slip-table-body">
                </tbody>
            </table>
        </div>

        <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
            <div class="d-flex flex-column flex-md-row">
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

@once

@push('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#acc-slip-form').find('#acc-date').val(date_to_sting(new Date()))

            $('#acc-slip-btn-group').find('.acc-slip-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': AccountingAccSlipPopupForm.btn_act_save(); break;
                    case 'new': AccountingAccSlipPopupForm.btn_act_new(); break;
                    case 'save-and-new': AccountingAccSlipPopupForm.btn_act_save_and_new(); break;
                    case 'delete': AccountingAccSlipPopupForm.btn_act_del(); break;
                }
            })

            // await Btype.fetch_slip_form_book(AccountingAccSlipPopupForm.unique, 'AccountingAccSlipPopupForm')
            // await AccountingAccSlipPopupForm.setup_acc_slip()
            // AccountingAccSlipPopupForm.btn_act_new()
        });

        (function( AccountingAccSlipPopupForm, $, undefined ) {
            AccountingAccSlipPopupForm.formB = {!! json_encode($formB) !!};
            AccountingAccSlipPopupForm.bd_page = []
            AccountingAccSlipPopupForm.unique

            AccountingAccSlipPopupForm.btn_act_new_callback = async function (variable) {
                AccountingAccSlipPopupForm.unique = variable['unique']
                $('#modal-select-popup.slip-form-book.accounting-acc-slip-popup-form').find('#myModalLabel').text(variable['title'] + '내역 조회')
                AccountingAccSlipPopupForm.data_init()
                await Btype.fetch_slip_form_book(AccountingAccSlipPopupForm.unique, 'AccountingAccSlipPopupForm')
                await AccountingAccSlipPopupForm.setup_acc_slip()
            }

            AccountingAccSlipPopupForm.setup_acc_slip = async function() {
                const response = await get_api_data('setup-get', {
                    SetupCode: 'slip-common',
                    BrandCode: 'acc-slip'
                })

                if (response.data.apiStatus) {
                    iziToast.error({
                        title: 'Error', message: page.data.body ?? $('#api-request-failed-please-check').text(),
                    })
                    return
                }
                AccountingAccSlipPopupForm.formB['SlipCommonSetup'] = response.data
            }

            AccountingAccSlipPopupForm.btn_act_save_and_new = function () {
                AccountingAccSlipPopupForm.btn_act_save(function () {
                    AccountingAccSlipPopupForm.btn_act_new()
                })
            }

            AccountingAccSlipPopupForm.btn_act_save = function (callback = null) {
                Btype.btn_act_save('#acc-slip-form #frm', async function () {
                    if (callback) {
                        callback()
                    }
                    await Btype.fetch_slip_form_book(AccountingAccSlipPopupForm.unique, 'AccountingAccSlipPopupForm')
                    // $('#modal-select-popup.accounting-acc-slip-popup-form').trigger('act.acc-slip')
                }, 'AccountingAccSlipPopupForm')
            }

            AccountingAccSlipPopupForm.btn_act_del = function () {
                Btype.btn_act_del('#acc-slip-form #frm', async function () {
                    await Btype.fetch_slip_form_book(AccountingAccSlipPopupForm.unique, 'AccountingAccSlipPopupForm')
                    // $('#modal-select-popup.accounting-acc-slip-popup-form').trigger('act.acc-slip')
                }, 'AccountingAccSlipPopupForm')
            }

            AccountingAccSlipPopupForm.show_popup_callback = async function (id, c1) {
                await Btype.fetch_slip_form_book(c1, 'AccountingAccSlipPopupForm');
            }

            AccountingAccSlipPopupForm.data_init = function () {
                $('#modal-select-popup.slip-form-book.accounting-acc-slip-popup-form .modal-header').removeClass('bg-grey-700 px-0')
                $('#modal-select-popup.slip-form-book.accounting-acc-slip-popup-form .modal-header').addClass('bg-danger-10')
                $('#modal-select-popup.slip-form-book.accounting-acc-slip-popup-form .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
                $('#modal-select-popup.slip-form-book.accounting-acc-slip-popup-form .modal-body th').addClass('bg-danger-10')

                const acc_slip_form = $('#acc-slip-form')

                $(acc_slip_form).find('#Id').val(0)
                $(acc_slip_form).find('#auto-slip-amt').val(0)
                input_box_reset_for('#acc-slip-form #frm')

                Btype.set_slip_no_btn_abled('#acc-slip-form #auto-slip-no-btn')
                $(acc_slip_form).find('#acc-date').val(date_to_sting(new Date()))
            }

            AccountingAccSlipPopupForm.btn_act_new = function () {
                AccountingAccSlipPopupForm.data_init()

                if (AccountingAccSlipPopupForm.formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                    AccountingAccSlipPopupForm.get_last_slip_no()
                }
            }

            AccountingAccSlipPopupForm.bd_cursor_click = async function (slip_no) {
                const acc_slip = AccountingAccSlipPopupForm.bd_page.filter(acc_slip => acc_slip['AccSlipNo'] === slip_no)[0]
                const acc_slip_form = $('#acc-slip-form')

                Btype.set_slip_no_btn_disabled('#acc-slip-form #auto-slip-no-btn')

                $(acc_slip_form).find('#Id').val(acc_slip.Id)
                $(acc_slip_form).find('#auto-slip-no-txt').val(acc_slip.AccSlipNo)
                $(acc_slip_form).find('#acc-date').val(moment(to_date(acc_slip.AccDate)).format('YYYY-MM-DD'))
                $(acc_slip_form).find('#slip-amt-txt').val(format_conver_for(acc_slip.SlipAmt, AccountingAccSlipPopupForm.formB.FormVars['Format'].SlipAmt))
                $(acc_slip_form).find('#bill-column1-txt').val(acc_slip.BillColumn1)
                $(acc_slip_form).find('#card-check-no').val(acc_slip.CardCheckNo)
            }

            AccountingAccSlipPopupForm.create_bd_page = function (bd_page) {
                let html = []
                let sum_total = 0

                if (isEmpty(bd_page)) {
                    html.push(`<tr><td class="text-center" colspan="${AccountingAccSlipPopupForm.formB.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` );
                }

                bd_page.forEach(bd => {
                    sum_total += parseFloat(bd.SlipAmt);

                    html.push(
                        `<tr>
                    <td class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].$Radio}" id="bd-cursor-state"
                        onclick="AccountingAccSlipPopupForm.bd_cursor_click('${bd.AccSlipNo}')">
                    </td>
                    <td
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].AccSlipNo}" ${AccountingAccSlipPopupForm.formB.ListVars['Hidden'].AccSlipNo}>${format_conver_for(bd.AccSlipNo, AccountingAccSlipPopupForm.formB.ListVars['Format'].AccSlipNo)}
                    </td>
                    <td
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].AccDate}" ${AccountingAccSlipPopupForm.formB.ListVars['Hidden'].AccDate}>${format_conver_for(bd.AccDate, AccountingAccSlipPopupForm.formB.ListVars['Format'].AccDate)}
                    </td>
                    <td
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].SlipAmt}" ${AccountingAccSlipPopupForm.formB.ListVars['Hidden'].SlipAmt}>${format_conver_for(bd.SlipAmt, AccountingAccSlipPopupForm.formB.ListVars['Format'].SlipAmt)}
                    </td>
                    <td
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].BillColumn1}" ${AccountingAccSlipPopupForm.formB.ListVars['Hidden'].BillColumn1}>${format_conver_for(bd.BillColumn1, AccountingAccSlipPopupForm.formB.ListVars['Format'].BillColumn1)}
                    </td>
                    <td
                        class="text-${AccountingAccSlipPopupForm.formB.ListVars['Align'].CardCheckNo}" ${AccountingAccSlipPopupForm.formB.ListVars['Hidden'].CardCheckNo}>${format_conver_for(bd.CardCheckNo, AccountingAccSlipPopupForm.formB.ListVars['Format'].CardCheckNo)}
                    </td>
                </tr>`)
                })

                $('#acc-slip-form').find('#SumTotal').val(format_conver_for(sum_total, AccountingAccSlipPopupForm.formB.ListVars['Format'].SlipAmt));
                document.getElementById('acc-slip-table-body').innerHTML = html.join('')
            }

            AccountingAccSlipPopupForm.get_last_slip_no = async function ($this) {
                Btype.set_slip_no_btn_disabled('#acc-slip-form #auto-slip-no-btn')
                const response = await Btype.get_last_slip_no(AccountingAccSlipPopupForm.formB['QueryVars']['QueryName']);
                $('#acc-slip-form').find('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            }

            AccountingAccSlipPopupForm.get_parameter = function () {
                const acc_slip_form = $('#acc-slip-form')
                const id = Number($(acc_slip_form).find("#Id").val())

                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    AccSlipNo: $(acc_slip_form).find('#auto-slip-no-txt').val(),
                    AccDate: moment(new Date($(acc_slip_form).find('#acc-date').val())).format('YYYYMMDD'),
                    UserId: window.User['UserId'],
                    BranchId: window.User['BranchId'],
                    DealTypeId: 21,
                    BillType: AccountingAccSlipPopupForm.unique.split(':')[1],
                    BillColumn1: $(acc_slip_form).find('#bill-column1-txt').val(),
                    SlipAmt: minusComma($(acc_slip_form).find('#slip-amt-txt').val()),
                    CardCheckNo: $(acc_slip_form).find('#card-check-no').val(),
                    AutoSlipAmt: $(acc_slip_form).find('#auto-slip-amt').val(),
                    SorderId: Number($(acc_slip_form).find('#sorder-no-txt').val()),
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
                return parameter
            }

            AccountingAccSlipPopupForm.update_hd_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    return;
                }

                const hd_page = response.data.HdPage[0]
                AccountingAccSlipPopupForm.bd_page = response.data.BdPage ?? []

                $('#acc-slip-form').find('#sorder-no-txt').val(hd_page.Id)

                AccountingAccSlipPopupForm.create_bd_page(AccountingAccSlipPopupForm.bd_page)
            }
        }( window.AccountingAccSlipPopupForm = window.AccountingAccSlipPopupForm || {}, jQuery ));
    </script>
@endpush
@endonce
