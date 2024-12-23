@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content coupon-reward">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="rewardModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn-dark btn-sm btn-primary reward-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'reward-act',
                    ])
                </div>
            </div>

            <div class="card" id="reward-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg card-header-item">
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
                                        <input class="rounded w-100" type="date" id="reward-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                            {{ $formB['FormVars']['Required']['Date'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['ManualAmt'] }}</label>
                                        <input class="rounded w-100 decimal" type="text" id="manual-amt-txt"
                                               data-point="{{ $formB['FormVars']['Format']['ManualAmt'] }}"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['ManualAmt'] }}"
                                            {{ $formB['FormVars']['Required']['ManualAmt'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2 to-customer-group">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['ToCustomer'] }}</label>
                                        <div class="d-flex">
                                            <input type="text" id="to-customer-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" disabled
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['ToCustomer'] }}"
                                                {{ $formB['FormVars']['Required']['ToCustomer'] }}>
                                            <button type="button"
                                                class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 form-customer-modal-btn"
                                                data-target="company"
                                                data-clicked="get_override_to_customer_id"
                                                data-variable="customerModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-none flex-column mb-2 form-customer-group">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['FormCustomer'] }}</label>
                                        <div class="d-flex">
                                            <input type="text" id="form-customer-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" disabled
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['FormCustomer'] }}"
                                                {{ $formB['FormVars']['Required']['FormCustomer'] }}>
                                            <button type="button"
                                                class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 to-customer-modal-btn"
                                                data-target="company"
                                                data-clicked="get_override_form_customer_id"
                                                data-variable="customerModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-transfer-check" onclick="form_customer_toggle(this)"> <label class="mb-0" for="is-transfer-check">{{ $formB['FormVars']['Title']['IsTransfer'] }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['DealType'] }}</label>
                                        <select class="rounded w-100" id="deal-type-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['DealType'] }}"
                                            {{ $formB['FormVars']['Required']['DealType'] }}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['UserName'] }}</label>
                                        <input class="rounded w-100" type="text" id="user-txt" disabled
                                               maxlength="{{ $formB['FormVars']['MaxLength']['UserName'] }}"
                                            {{ $formB['FormVars']['Required']['UserName'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
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
                    <div id="">
                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row reward-table">
                                <thead id="reward-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="reward-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
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

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $rewardModal])
    @include('front.outline.static.company', ['moealSetFile' => $customerModal])
    @include('front.outline.static.memo')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.to-customer-modal-btn, .form-customer-modal-btn').on('click', function() {
                if(!Btype.checkModalOpen(this)){
                    return false;
                }
            });
        });
        window.onload = async function () {
            make_dynamic_table_css('.reward-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#reward-date').val(date_to_sting(new Date()))

            Btype.get_storage_name_and_branch_name()
            let data = await Btype.get_slip_form_init()
            formB['SlipCommonSetup'] = data['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(data.DealTypePage)
            $('#user-txt').val(window.User['NickName'])

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }
            }

            $('.reward-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save':
                        if(!Btype.checkModalOpen(this)){
                            return false;
                        }
                        btn_act_save('#reward-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'save-and-new': btn_act_save_and_new('#reward-form #frm'); break;
                    case 'delete': btn_act_del('#reward-form #frm'); break;
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

        function btn_act_new() {
            data_init()

            if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                get_last_slip_no()
            }
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
                const id = $(`#frm`).find('#Id').val();
                $(`#frm`).find('#Id').val( `-${id}` );
                call_act_api(get_parameter(), function() {
                    btn_act_new();
                });
            })
        }

        function btn_act_save(argObj) {
            if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
                iziToast.warning({
                    title: 'Warning',
                    message: $('#required-item-omitted').text(),
                });
                return;
            }

            call_act_api(get_parameter(), function() {
                Btype.fetch_slip_form_book( $('#auto-slip-no-txt').val() )
            });
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
                btn_act_new();
            });
        }

        function call_act_api(data, callback) {
            console.log(data);
            $('.save-button').prop('disabled', true);
            $.when(get_api_data(formB.General.ActApi, {
                Page: [ data ]
            }))
            .done(function(response) {
                let d = response.data
                console.log(response);
                if (d.Page) {
                    set_as_response_id(d.Page[0].Id)
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
            });
        }

        function get_parameter() {
            let id = Number($('.coupon-reward').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                RewardNo: $('#auto-slip-no-txt').val(),
                RewardDate: moment(new Date($('#reward-date').val())).format('YYYYMMDD'),
                DealTypeId: Number($('#deal-type-select').val()),

                IsTransfer: $('#is-transfer-check:checked').val() ?? '0',
                ToBuyerId: Number($('#to-customer-txt').data('id')),
                FromBuyerId: Number($('#form-customer-txt').data('id')),
                ManualAmt: minusComma($('#manual-amt-txt').val()),

                UserId: window.User['UserId'],
                BranchId: window.User['BranchId'],
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

        function data_init(){
            bd_page = [];

            input_box_reset_for('#frm', ['user-txt'])
            input_box_reset_for('#total-frm')
            $('#to-customer-txt').data('id', 0)
            $('#form-customer-txt').data('id', 0)
            $('.coupon-reward').find('.form-customer-group').removeClass('d-flex');
            $('.coupon-reward').find('.form-customer-group').addClass('d-none');

            $('#to-customer-txt').prop('readonly', false);
            $('#form-customer-txt').prop('readonly', false);
            $('.to-customer-modal-btn').removeClass('disabled');
            $('.form-customer-modal-btn').removeClass('disabled');
            $('.reward-act.save-button').removeClass('disabled')

            Btype.set_slip_no_btn_abled()
            $('#reward-date').val(date_to_sting(new Date()))

            // table body 초기화
            table_head_check_box_reset('#reward-table-head')
            $('#reward-table-body').html('');
        }

        function form_customer_toggle($this) {
            if ($($this).prop('checked')) {
                $('.coupon-reward').find('.form-customer-group').removeClass('d-none');
                $('.coupon-reward').find('.form-customer-group').addClass('d-flex');
            } else {
                // $('#form-customer-txt').val('')
                // $('#form-customer-txt').data('id', 0)
                $('.coupon-reward').find('.form-customer-group').removeClass('d-flex');
                $('.coupon-reward').find('.form-customer-group').addClass('d-none');
            }
        }

        async function fetch_customer(customer_name) {
            let response = await call_slip_form_book('slip-form-book', 'customer', customer_name);
            console.log(response);
            return response.data.HdPage[0];
        }

        async function get_override_to_customer_id(customer_name) {
            let customer = await fetch_customer(customer_name);

            $('#to-customer-txt').val(customer.CompanyName)
            $('#to-customer-txt').data('id', customer.Id)
            $('#modal-company').modal('hide');
        }

        async function get_override_form_customer_id(customer_name) {
            let customer = await fetch_customer(customer_name);

            $('#form-customer-txt').val(customer.CompanyName)
            $('#form-customer-txt').data('id', customer.Id)
            $('#modal-company').modal('hide');
        }

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        async function add_td_last_tap_out($this, id) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (! dom_required_check($(tr).find(`input`))) {
                Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                    bd_page[index].Id = page[0].Id;

                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('(*)Required item(s) omitted')),
                });
            }
        }

        function get_bd_parameter(bd) {
            let discount_rate = Btype.discount_rate_calc(parseInt(minusComma(bd.StdPurchPrc)) * parseInt(minusComma(bd.PorderQty)), parseInt(bd.PorderSum));
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                UpdatedOn: get_now_time_stamp(),
                AddMsg: bd.AddMsg,
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

        function save_data_when_entering_text() {
            let tr = $('.coupon-reward').find(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            bd_page[index].AddMsg = $(tr).find('.column1-txt').val()
        }

        function create_bd_page() {
            let html = []
            let sum_total = 0;

            bd_page.forEach((bd, index) => {
                console.log('bd.CreditAmt('+index+') : ', bd.RewardAmt);
                sum_total += parseFloat(bd.RewardAmt);

                // 품목코드, 수량, 단가, 공급가액, 세액, 합계금액
                html.push (
                `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${formB.ListVars['Align'].CompanyNo}" ${formB.ListVars['Hidden'].CompanyNo}>
                        ${format_conver_for(bd.CompanyNo, formB.ListVars['Format'].CompanyNo)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].Customer}" ${formB.ListVars['Hidden'].Customer}>
                        ${format_conver_for(bd.CompanyName, formB.ListVars['Format'].Customer)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].DealName}" ${formB.ListVars['Hidden'].DealName}>
                        ${format_conver_for(bd.DealName, formB.ListVars['Format'].DealName)}
                    </td>
                    <td class="text-${formB.ListVars['Align'].RewardAmt}" ${formB.ListVars['Hidden'].RewardAmt}>
                        ${format_conver_for(bd.RewardAmt, formB.ListVars['Format'].RewardAmt)}
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                    class="text-${formB.ListVars['Align'].AddMsg}" ${formB.ListVars['Hidden'].AddMsg}>
                        <input type="text" class="text-${formB.ListVars['Align'].PorderQty} border-0 bg-white column1-txt"
                        onfocusout="save_data_when_entering_text()"
                        value="${format_conver_for(bd.AddMsg, formB.ListVars['Format'].AddMsg)}" disabled>
                    </td>
                </tr>` )

                // <td class="text-${formB.ListVars['Align'].IsManual}" ${formB.ListVars['Hidden'].IsManual}>
                //     <input type="checkbox" value="1" class="text-center" onClick="return false;" ${bd.IsManual == '1' ? 'checked' : ''}>
                //     </td>
            });

            $('#SumTotal').val(format_conver_for(sum_total, formB.ListVars['Format'].CreditAmt) || 0);

            document.getElementById('reward-table-body').innerHTML = html.join('');
            // $('#reward-table-body').html(html);
        }

        function update_hd_ui(response) {
            console.log(response);
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []
            // console.log('bd_page : ', bd_page);

            $('.save-button').addClass('disabled');
            $('#Id').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.RewardNo)
            $('#reward-date').val(moment(to_date(hd_page.RewardDate)).format('YYYY-MM-DD'))
            $('#manual-amt-txt').val(format_conver_for(hd_page.ManualAmt, "decimal('sales_amt')" ))

            $('#deal-type-select').val(hd_page.DealTypeId)

            $('#is-transfer-check').prop('checked', hd_page.IsTransfer == '1')
            form_customer_toggle('#is-transfer-check')
            $('#to-customer-txt').val(hd_page.ToCompanyName)
            $('#to-customer-txt').data('id', hd_page.ToBuyerId)
            $('#form-customer-txt').val(hd_page.FromCompanyName)
            $('#form-customer-txt').data('id', hd_page.FromBuyerId)

            // 저장된 데이터 불러올 경우 업체 비활성화
            $('#to-customer-txt').prop('readonly',  hd_page.ToCompanyName != "")
            $('#form-customer-txt').prop('readonly',  hd_page.FromCompanyName != "")
            disabled_menu(hd_page)

            $('#remarks-txt-area').val(remove_tag(hd_page.Remarks))
            $('#remarks-preview').html(hd_page.Remarks)

            $('#sgroup-id-select').val(hd_page.SgroupId)
            $('#our-contact-select').val(hd_page.OurContact)

            if($('#is-transfer-check').val() == 1){
                bd_page.forEach(bd => {
                    // 전송처리시 주는고객 적립금 - 처리
                    if (hd_page.FromBuyerId === bd.BuyerId) {
                        bd.RewardAmt = -Math.abs(bd.RewardAmt);
                    }
                });
            }

            function disabled_menu(hd_page) {
                const isToCustomerSaved = hd_page.ToCompanyName != ""
                const isFromCustomerSaved = hd_page.FromCompanyName != ""

                $('.to-customer-modal-btn').addClass('disabled',  isToCustomerSaved)
                $('.form-customer-modal-btn').addClass('disabled',  isFromCustomerSaved)
            }

            Btype.set_slip_no_btn_disabled()
            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        const customerModal = {!! json_encode($customerModal) !!};
        const rewardModal = {!! json_encode($rewardModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
