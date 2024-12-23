@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content eyetest" id="eyetest">
    <div class="row" id="sorder-sale">
        <div class="col-xl-12">
			<div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal bodycopy-modal-btn"
                    data-target="bodycopy"
                    data-clicked="checked_data"
                    data-variable="bodyCopy">
                </button>

                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="sorderModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary" id="eyetest-save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" id="eyetest-btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary eyetest-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'eyetest-act',
                    ])
                </div>
            </div>

			<div class="row">
				<!-- 오른쪽박스 시작 -->
				<div class="col-12">
					<!-- 주문출고 시작 -->
					<div class="card card_r2">
						<div class="card_inner">

							<!-- 탭시작 -->
							<ul class="nav nav-tabs nav-tabs-solid rounded">
                                <li class="nav-item sorder-tab"><a href="#sorder-tab" class="nav-link rounded-left active" data-toggle="tab">{{ $formB['FormVars']['Title']['SorderTab'] }}</a></li>
                                <li class="nav-item add-sales-tab" data-count="0"><a href="#" class="nav-link">{{ $formB['FormVars']['Title']['SalesTab'] }}(+)</a></li>
                            </ul>
							<!--// 탭 끝 -->

							<!-- 탭내용 시작 -->
							<div class="tab-content">
                                <input type="hidden" id="BuyerId" value="0">
                                <!-- 주문 시작 -->
								@include('front.dabory.erp.induspex.optical-pos.simple-sale.tab.eyetest-sorder')
								<!--// 주문 끝 -->

                                <!-- 출고 시작 -->
                                @foreach (range(1, 100) as $i)
                                    @include('front.dabory.erp.induspex.optical-pos.simple-sale.tab.eyetest-sales', [
                                        'formB' => $salesFormB,
                                        'tabId' => "sales${i}-tab"
                                    ])
                                @endforeach
								<!--// 출고 끝 -->

                            </div>
							<!--// 탭 내용 끝 -->

						</div>
					</div>
					<!--// 주문출고 끝 -->

					<!-- 합계 시작 -->
					<div class="card card_r3">
						<div class="card_inner d-flex">
							<div class="box_left">
                                <div class="d-flex flex-column">
                                    <label class="m-0">{{ $formB['FooterVars']['Title']['BranchName'] }}</label>
                                    <input class="rounded w-100" type="text" id="BranchName" disabled>
								</div>

								<div class="d-flex flex-column">
                                    <label class="m-0">{{ $formB['FooterVars']['Title']['StorageName'] }}</label>
                                    <input class="rounded w-100" type="text" id="StorageName" disabled>
								</div>
							</div>

							<div class="box_right" id="total-frm">
								<div class="d-flex flex-column">
									<label class="m-0 sum-total-label">{{ $formB['FooterVars']['Title']['SorderTotal'] }}</label>
                                    <input class="rounded w-100" type="text" id="SumTotal" disabled>
								</div>

								<div class="d-flex flex-column">
									<label class="m-0">{{ $formB['FooterVars']['Title']['CardTotal'] }}</label>
                                    <input class="rounded w-100" type="text" id="card-total" disabled>
								</div>

								<div class="d-flex flex-column">
									<label class="m-0">{{ $formB['FooterVars']['Title']['CashTotal'] }}</label>
                                    <input class="rounded w-100" type="text" id="cash-total" disabled>
								</div>

								<div class="d-flex flex-column">
									<label class="m-0">{{ $formB['FooterVars']['Title']['GiftTotal'] }}</label>
                                    <input class="rounded w-100" type="text" id="gift-total" disabled>
								</div>
                                <div class="d-flex flex-column">
                                    <label class="m-0">{{ $formB['FooterVars']['Title']['UserCreditTotal'] }}</label>
                                    <input class="rounded w-100" type="text" id="user-credit-total" disabled>
                                </div>
                                <div class="d-flex flex-column">
                                    <label class="m-0">{{ $formB['FooterVars']['Title']['Recievable'] }}</label>
                                    <input class="rounded w-100 text-danger" type="text" id="recievable" disabled>
                                </div>
                            </div>

						</div>
					</div>
					<!--// 합계 끝 -->

				</div>
				<!--// 오른쪽박스 끝 -->
			</div>

        </div>
    </div>
</div>

@endsection

@foreach ($popupOptions as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $formB['General']['PickApi']
            ])
        @endpush
    @endif
@endforeach

@push('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $sorderModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
@endpush

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
<script src="/js/modals-controller/b-type/copy-to-another.js?{{date('YmdHis')}}"></script>
    <script>
        window.onload = async function () {
            // console.log( format_conver_for('0', "sort('sgroup')") )
            $('#eyetest').find('.add-sales-tab').on('click', function () {
                copy_from_sorder_to_sales();
            });

            $(document).on('click','#eyetest .tab-close', function () {
                let $this = this;

                confirm_message_shw_and_delete(function() {
                    let sales_a = $($this).closest('li').find('a');
                    if ($(sales_a).hasClass('active')) {
                        $('.sorder-tab a').trigger('click')
                    }

                    let parameter = { Id: Number(`-${$($(sales_a).attr('href')).data('id')}`) }
                    EyetestSales.call_act_api(parameter, 'sales-act', function (response) {
                        $($this).closest('li').remove()
                        sales_tab_caption_reset()
                    });
                })
            });

            $(document).on('success.body-copy','#modal-bodycopy', async function (event, sorder_no) {
                await Btype.fetch_slip_form_book(sorder_no);
            });

            $(document).on('click','#eyetest .nav-tabs-solid [data-toggle="tab"]', function () {
                window.tabId = $(this).attr('href')
                // console.log($(this).attr('href'))
                if (window.tabId == '#sorder-tab') {
                    $('.sum-total-label').text(formB['FooterVars']['Title']['SorderTotal'])
                    EyetestSorder.amt_total_calc()
                } else {
                    $('.sum-total-label').text(formB['FooterVars']['Title']['SalesTotal'])
                    EyetestSales.bd_page = EyetestSales.bd_pages[window.tabId];
                    EyetestSales.amt_total_calc()
                }
            });

            await Btype.get_storage_name_and_branch_name()
            let eyetest_init_data = await Btype.get_slip_form_init()
            // console.log(eyetest_init_data)
            formB['SlipCommonSetup'] = eyetest_init_data['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(eyetest_init_data.DealTypePage || [])
            await Btype.create_vat_type_select_box_options(eyetest_init_data.VatRatePage|| [])
            await EyetestSorder.create_etc_select_box_options(eyetest_init_data|| [])

            $('.eyetest-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': btn_act_save('#sorder-tab #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'copy': btn_act_copy(); break;
                    case 'save-and-new': btn_act_save_and_new('#sorder-tab #frm'); break;
                    case 'body-copy': btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': btn_act_del('#sorder-tab #frm'); break;
                }
            });

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                // slip-search 캐시적용
                Btype.set_slip_cache_data('#modal-slip')

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }  else {
                    activate_button_group({save_spinner_btn: '#eyetest-save-spinner-btn', btn_group: '#eyetest-btn-group'})
                }
            } else {
                activate_button_group({save_spinner_btn: '#eyetest-save-spinner-btn', btn_group: '#eyetest-btn-group'})
            }


        }

        async function show_popup(component, width) {
            popupOption = popupOptions.filter(option => option.Component.includes(component))
            if (isEmpty(popupOption)) { return }

            const modal_class_name = popupOption[0]['ModalClassName'];
            $(`#modal-select-popup.${modal_class_name} .modal-dialog`).css('max-width', `${width}px`)
            eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()
            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        function sales_tab_caption_reset() {
            $('#eyetest').find('.sales-tab a').each(function (index) {
                $(this).text( `${formB['FormVars']['Title']['SalesTab']}(${index + 1})` )
            })
        }

        async function btn_act_save(argObj) {
            if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
                iziToast.warning({
                    title: 'Warning',
                    message: $('#required-item-omitted').text(),
                });
                return false
            }

            await call_act_api(get_parameter(), function() {
                Btype.fetch_slip_form_book($('#sorder-tab').find('.auto-slip-no-txt').val(), 'window', function (response) {
                    let payment_page = response.data.PaymentPage;
                    if (isEmpty(payment_page)) return;
                    set_as_payment_response_id(payment_page)

                    update_payment_ui(payment_page)
                    update_recievable_calc()
                });
            });

            return true
        }

        function btn_act_copy() {
            $('.cont-lens-table .r-cont-lens').find('.sph-txt').val($('.eye-lens-table .r-eye-lens').find('.sph-txt').val())
            $('.cont-lens-table .r-cont-lens').find('.cyl-txt').val($('.eye-lens-table .r-eye-lens').find('.cyl-txt').val())
            $('.cont-lens-table .r-cont-lens').find('.axis-txt').val($('.eye-lens-table .r-eye-lens').find('.axis-txt').val())
            $('.cont-lens-table .r-cont-lens').find('.add-txt').val($('.eye-lens-table .r-eye-lens').find('.add-txt').val())

            $('.cont-lens-table .l-cont-lens').find('.sph-txt').val($('.eye-lens-table .l-eye-lens').find('.sph-txt').val())
            $('.cont-lens-table .l-cont-lens').find('.cyl-txt').val($('.eye-lens-table .l-eye-lens').find('.cyl-txt').val())
            $('.cont-lens-table .l-cont-lens').find('.axis-txt').val($('.eye-lens-table .l-eye-lens').find('.axis-txt').val())
            $('.cont-lens-table .l-cont-lens').find('.add-txt').val($('.eye-lens-table .l-eye-lens').find('.add-txt').val())
        }

        function btn_act_save_and_new(argObj) {
            if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
                iziToast.warning({
                    title: 'Warning',
                    message: $('#required-item-omitted').text(),
                });
                return;
            }

            call_act_api(get_parameter(), function() {
                data_init();
            });
        }

        function btn_act_del(argObj) {
            if (befo_del_copy_id() || $(argObj).find(`input[name="Id"]`).val() == 0) {
                iziToast.error({
                    title: 'Error',
                    message: $('#can-not-delete-in-the-status').text(),
                });
                return;
            }

            confirm_message_shw_and_delete(function() {
                const id = $(`#frm`).find(`input[name="Id"]`).val();
                $(`#frm`).find(`input[name="Id"]`).val( `-${id}` );
                call_act_api(get_parameter(), function() {
                    data_init();
                });
            })
        }

        async function data_init() {
            $('#sorder-sale').find('#BuyerId').val('0')

            Btype.get_storage_name_and_branch_name()
            EyetestSorder.bd_page = [];
            sales_tab_reset();

            input_box_reset_for('#frm')
            input_box_reset_for('#payment-frm')
            input_box_reset_for('#lens-frm')
            input_box_reset_for('#total-frm')

            $('.eyetest-act.save-button').prop('disabled', false)

            Btype.set_slip_no_btn_abled('#sorder-tab #auto-slip-no-btn')
            $('#sorder-date').val(date_to_sting(new Date()))

            payment_input_data_id_reset();

            // table body 초기화
            table_head_check_box_reset('#eyetest-table-head')
            $('#eyetest-table-body').html('');
        }

        function btn_act_new() {
            data_init()

            if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                EyetestSorder.get_last_slip_no()
            }
        }

        function payment_input_data_id_reset() {
            let bill_types = ['cc', 'cs', 'gc', 'uc'];

            bill_types.forEach(bill_type => {
                $(`#bill-type-${bill_type}-txt`).data('id', 0);
            });
        }

        async function call_act_api(data, callback) {
            $('.save-button').prop('disabled', true);

            const response = await get_api_data(formB.General.ActApi, data)
            let d = response.data
            if (d.HdPage) {
                set_as_response_id(d.HdPage[0].Id)
                // console.log(parseInt($(`#frm`).find(`input[name="Id"]`).val()))
                // set_as_payment_response_id(d.PaymentPage)
                callback();
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
            $('.save-button').prop('disabled', false);
        }

        function copy_from_sorder_to_sales() {
            const data = new CopyToAnother('sorder', 'sales',
            $('#sorder-tab').find('.auto-slip-no-txt').val(), '', true);
            fetch_copy_to_another('copy-to-another', data, async function (response) {
                if (! isEmpty(response.data.body)) {
                    iziToast.error({
                        title: 'Error',
                        message: response.data.body,
                    });
                    return;
                }
                add_sales_tab();

                let d = response
                let sales = ( await get_api_data('sales-pick', { Page: [ { Id:  parseInt(d.data.Hd.LastInsertId) } ] }) ).data.Page[0];

                if (d.data.Hd) {
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                    Btype.fetch_slip_form_book(sales.SalesNo, 'EyetestSales');
                    $('#eyetest').find('.nav-tabs-solid [data-toggle="tab"]:last').trigger('click')
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: $('#api-request-failed-please-check').text(),
                    });
                }
            })
        }

        function add_sales_tab() {
            if ($('.add-sales-tab').data('count') == EyetestSales.tab_count) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Action failed')),
                });
                location.reload();
                return;
            }

            let tab_count = $('.add-sales-tab').data('count') + 1;
            let tab_id = window.tabId = `#sales${tab_count}-tab`;
            EyetestSales.create(tab_id);

            let html = `
                <li class="nav-item position-relative sales-tab">
                    <a href="${tab_id}" class="nav-link" data-toggle="tab">
                        ${formB['FormVars']['Title']['SalesTab']}(${tab_count})
                    </a>
                    <button type="button" class="tab-close position-absolute top-0 right-0 color-danger">
                        <i class="fas fa-times fa-xs"></i>
                    </button>
                </li>`

            $('.add-sales-tab').before(html)
            // $('.nav-tabs-solid').append(html)
            $('.add-sales-tab').data('count', tab_count);
            sales_tab_caption_reset()
        }

        async function sales_tab_reset() {
            await setTimeout( function() {
                $('.sorder-tab a').trigger('click')
            }, 100);

            $('.add-sales-tab').data('count', 0);
            $('.sales-tab a').each(function () {
                $(this).closest('li').remove()

                let id = $(this).attr('href');
                EyetestSales.bd_page[id] = [];
                input_box_reset_for(`${id} #sales-frm`)
                $(id).find('#sales-date').val(date_to_sting(new Date()))
                Btype.set_slip_no_btn_abled(`${id} #auto-slip-no-btn`)

                // table body 초기화
                table_head_check_box_reset(`${id} #eyetest-table-head`)
                $(`${id} #eyetest-table-body`).html('');
            })
        }

        function get_payment_parameter()
        {
            let parameter = [
                {
                    Id: Number($('#bill-type-cc-txt').data('id')),
                    BillType: 'CC',
                    BillColumn1: $('#card-company-select').val(),
                    SlipAmt: minusComma($('#bill-type-cc-txt').val()),
                    CardCheckNo: ''
                },
                {
                    Id: Number($('#bill-type-cs-txt').data('id')),
                    BillType: 'CS',
                    BillColumn1: $('#cash-receipt-select').val(),
                    SlipAmt: minusComma($('#bill-type-cs-txt').val()),
                    CardCheckNo: ''
                },
                {
                    Id: Number($('#bill-type-gc-txt').data('id')),
                    BillType: 'GC',
                    BillColumn1: $('#gift-card-select').val(),
                    SlipAmt: minusComma($('#bill-type-gc-txt').val()),
                    CardCheckNo: ''
                },
                {
                    Id: Number($('#bill-type-uc-txt').data('id')),
                    BillType: 'UC',
                    BillColumn1: $('#user-credit-select').val(),
                    SlipAmt: minusComma($('#bill-type-uc-txt').val()),
                    CardCheckNo: ''
                }
            ]

            let bill_types = ['cc', 'cs', 'gc', 'uc'];
            bill_types.forEach(bill_type => {
                if (isEmpty($(`#bill-type-${bill_type}-txt`).val())) {
                    parameter = parameter.filter((payment) => payment.BillType != bill_type.toUpperCase());
                }
            });

            // console.log(parameter)
            return parameter;
        }

        function get_parameter() {
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                SorderNo: $('#sorder-tab').find('.auto-slip-no-txt').val(),
                SorderDate: moment(new Date($('#sorder-date').val())).format('YYYYMMDD'),
                // BuyerId: Number($('#sorder-sale').find('#BuyerId').val()),
                BuyerId: 1,
                UserId: window.User['UserId'],
                SgroupId: window.User['SgroupId'],
                BranchId: window.User['BranchId'],
                StorageId: window.User['StorageId'],
                DealTypeId: parseInt($('#sorder-tab').find('#deal-type-select').val()),
                VatRateId: parseInt($('#vat-type-select').val()),
                Status: $('#sorder-tab').find('#status-select').val(),
                IsClosed: $('#is-closed-check:checked').val() ?? '0',
                SgroupId: Number($('#sorder-tab').find('#sales-user1-id-select').val()),
                Sgroup2Id: Number($('#sorder-tab').find('#sales-user2-id-select').val()),
                Remarks: $('#sorder-tab').find('#remarks-textarea').val(),
                Ip: window.User['Ip'],
            }

            let data = { }
            if (id < 0) {
                parameter = { Id: parseInt($(`#frm`).find(`input[name="Id"]`).val()) }
            } else if (id > 0) {
                data['PaymentPage'] = get_payment_parameter()
                delete parameter.CreatedOn;
            } else {
                data['PaymentPage'] = get_payment_parameter()
                delete parameter.UpdatedOn;
            }
            data['HdPage'] = [ parameter ]

            // console.log(data)

            return data;
        }

        function update_cont_lens_input(cont_lens, dom_class) {
            $(dom_class).find('.sph-txt').val(cont_lens['Sph'])
            $(dom_class).find('.cyl-txt').val(cont_lens['Cyl'])
            $(dom_class).find('.axis-txt').val(cont_lens['Axis'])
            $(dom_class).find('.add-txt').val(cont_lens['Add'])
            $(dom_class).find('.bc-txt').val(cont_lens['Bc'])
            $(dom_class).find('.dia-txt').val(cont_lens['Dia'])
            $(dom_class).find('.kerato-txt').val(cont_lens['Kerato'])
            $(dom_class).find('.prescript-txt').val(cont_lens['Prescript'])
            $(dom_class).find('.adjust-txt').val(cont_lens['Adjust'])
        }

        function update_eye_lens_input(eye_lens, dom_class) {
            $(dom_class).find('.sph-txt').val(eye_lens['Sph'])
            $(dom_class).find('.cyl-txt').val(eye_lens['Cyl'])
            $(dom_class).find('.axis-txt').val(eye_lens['Axis'])
            $(dom_class).find('.long-pd-txt').val(eye_lens['LongPd'])
            $(dom_class).find('.add-txt').val(eye_lens['Add'])
            $(dom_class).find('.short-pd-txt').val(eye_lens['ShortPd'])
            $(dom_class).find('.base-i-txt').val(eye_lens['BaseIo'].split('/')[0])
            $(dom_class).find('.base-o-txt').val(eye_lens['BaseIo'].split('/')[1])
            $(dom_class).find('.base-u-txt').val(eye_lens['BaseUd'].split('/')[0])
            $(dom_class).find('.base-d-txt').val(eye_lens['BaseUd'].split('/')[1])
            $(dom_class).find('.bare-eye-txt').val(eye_lens['BareEye'])
            $(dom_class).find('.adjust-txt').val(eye_lens['Adjust'])
        }

        function update_recievable_calc() {
            let recievable = Number(minusComma( $('#SumTotal').val() ))
                - ( Number(minusComma( $('#card-total').val() )) + Number(minusComma( $('#cash-total').val() ))
                + Number(minusComma( $('#gift-total').val() )) + Number(minusComma( $('#user-credit-total').val() ))  );

            $('#recievable').val(format_conver_for(recievable, formB.ListVars['Format'].SorderPrc))
        }

        function set_as_payment_response_id(payment_page) {
            let bill_types = ['cc', 'cs', 'gc', 'uc'];
            let index = 0;

            bill_types.forEach(bill_type => {
                let input_id = `#bill-type-${bill_type}-txt`
                if (isEmpty($(input_id).val()) || $(input_id).val() == 0) return;

                if (payment_page[index].Id > 0) {
                    $(input_id).data('id', payment_page[index].Id);
                }
                index++;
            });
        }

        function update_payment_ui(payment_page) {
            let total = []

            payment_page.forEach(payment => {
                let input_id = `#bill-type-${payment.BillType.toLowerCase()}-txt`
                total[payment.BillType.toLowerCase()] = parseFloat(payment.SlipAmt)

                $(input_id).val(format_conver_for(payment.SlipAmt, formB.ListVars['Format'].SorderPrc))
                $(input_id).data('id', payment.Id)
                $(input_id).data('bill-column1', payment.BillColumn1)
            });

            $('#card-company-select').val( $('#bill-type-cc-txt').data('bill-column1') )
            $('#cash-receipt-select').val( $('#bill-type-cs-txt').data('bill-column1') )
            $('#gift-card-select').val( $('#bill-type-gc-txt').data('bill-column1') )
            $('#user-credit-select').val( $('#bill-type-uc-txt').data('bill-column1') )

            $('#card-total').val(format_conver_for(total['cc'] || 0, formB.ListVars['Format'].SorderPrc))
            $('#cash-total').val(format_conver_for(total['cs'] || 0, formB.ListVars['Format'].SorderPrc))
            $('#gift-total').val(format_conver_for(total['gc'] || 0, formB.ListVars['Format'].SorderPrc))
            $('#user-credit-total').val(format_conver_for(total['uc'] || 0, formB.ListVars['Format'].SorderPrc))
        }

        function update_sales_tab_ui(sales_tab_page) {
            sales_tab_page.forEach(el => {
                window.add_sales_tab()
            });

            sales_tab_page.forEach(async (el, index) => {
                let sales = ( await get_api_data('sales-pick', { Page: [ { Id:  parseInt(el.Id) } ] }) ).data.Page[0];
                Btype.fetch_slip_form_book(sales.SalesNo, 'EyetestSales', function (response) {
                    EyetestSales.update_hd_ui(response, `#sales${index + 1}-tab`)
                });
            });
        }

        async function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                activate_button_group({save_spinner_btn: '#eyetest-save-spinner-btn', btn_group: '#eyetest-btn-group'})
                $('#modal-slip').modal('hide');
                return;
            }
            await data_init()

            Btype.set_slip_no_btn_disabled('#sorder-tab #auto-slip-no-btn')

            let hd_page = response.data.HdPage[0]
            let payment_page = response.data.PaymentPage ?? []
            let sales_tab_page = response.data.SalesTabPage ?? []
            let bd_page = response.data.BdPage ?? []

            update_sales_tab_ui(sales_tab_page);

            $('#frm').find('#Id').val(hd_page.Id)
            $('#sorder-sale').find('#BuyerId').val(hd_page.BuyerId)
            $('#sorder-tab').find('.auto-slip-no-txt').val(hd_page.SorderNo)
            $('#sorder-date').val(moment(to_date(hd_page.SorderDate)).format('YYYY-MM-DD'))
            $('#sorder-tab').find('#deal-type-select').val(hd_page.DealTypeId)
            $('#sorder-tab').find('#vat-type-select').val(hd_page.VatRateId)
            $('#sorder-tab').find('#status-select').val(hd_page.Status)
            $('#is-closed-check').prop('checked', hd_page.IsClosed == '1')

            $('#sorder-tab').find('#sales-user1-id-select').val(hd_page.SgroupId)
            $('#sorder-tab').find('#sales-user2-id-select').val(hd_page.Sgroup2Id)

            $('#sorder-tab').find('#remarks-textarea').val(hd_page.Remarks)


            $('#is-sales-completed-check').prop('checked', response.data.IsSalesCompleted == '1')

            $('#StorageName').val(hd_page.StorageName)
            $('#BranchName').val(hd_page.BranchName)

            update_payment_ui(payment_page)
            EyetestSorder.update_bd_ui(bd_page)
            activate_button_group({save_spinner_btn: '#eyetest-save-spinner-btn', btn_group: '#eyetest-btn-group'})

            $('#modal-slip').modal('hide');
        }

        const sorderModal = {!! json_encode($sorderModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const popupOptions = {!! json_encode($popupOptions) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var tabId;
    </script>
@endsection
