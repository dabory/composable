<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" {{ count($formB['HeadSelectOptions']) <= 3 ? 'hidden' : '' }}
        class="btn btn-success btn-open-modal"
        data-target="slip"
        data-clicked="Btype.fetch_slip_form_book"
        data-variable="accSlipModal">
        <i class="icon-folder-open"></i>
    </button>
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
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
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="auto-slip-amt" value="0">
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
                            <label class="m-0">{{ $formB['FormVars']['Title']['AccDate'] }}</label>
                            <input class="rounded w-100" type="date" value="" id="acc-date" onchange="occur_date_change()"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['AccDate'] }}"
                                {{ $formB['FormVars']['Required']['AccDate'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['OccurDate'] }}</label>
                            <input class="rounded w-100" type="date" value="" id="occur-date"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['OccurDate'] }}"
                                {{ $formB['FormVars']['Required']['OccurDate'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0 ">{{ $formB['FormVars']['Title']['Company'] }}</label>
                            <div class="d-flex">
                                <input type="text" id="supplier-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                onkeydown="company_model_show_cell_enter_key(event, 'BB')"
                                       maxlength="{{ $formB['FormVars']['MaxLength']['Company'] }}"
                                    {{ $formB['FormVars']['Required']['Company'] }}>
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
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0 ">{{ $formB['FormVars']['Title']['DealType'] }}</label>
                            <select class="rounded w-100" id="deal-type-select"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['DealType'] }}"
                                {{ $formB['FormVars']['Required']['DealType'] }}>
                                <option value="">==필수 입력==</option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['BillType'] }}</label>
                            <select class="rounded w-100" id="bill-type-select"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['BillType'] }}"
                                {{ $formB['FormVars']['Required']['BillType'] }}>
                                <option value="">==지불 없슴==</option>
                                @forelse ($codeTitle['bill-type']['bill_type'] ?? [] as $key => $option)
                                    @if ($option['Code'] !== '')
                                        <option value="{{ $option['Code'] }}">{{ $option['Title'] }}</option>
                                    @endif
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['BillColumn1'] }}</label>
                            <input type="text" id="bill-column1-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['BillColumn1'] }}"
                                {{ $formB['FormVars']['Required']['BillColumn1'] }}>
                        </div>
                        <div class="form-group d-flex flex-column">
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
                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['SgroupName'] }}</label>
                            <select class="rounded w-100" data-closed="0" id="sgroup-id-select"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['SgroupName'] }}"
                                {{ $formB['FormVars']['Required']['SgroupName'] }}>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                            <select class="rounded w-100" id="status-select"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                {{ $formB['FormVars']['Required']['Status'] }}>
                                <option value=""></option>
                                <option value="{{ $formB['StatusOptions'][0]['Value'] }}">{{ $formB['StatusOptions'][0]['Caption'] }}</option>
                                <option value="{{ $formB['StatusOptions'][1]['Value'] }}">{{ $formB['StatusOptions'][1]['Caption'] }}</option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formB['FormVars']['Title']['Remarks'] }}</label>
                            <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                            <div class="fr-view" id="remarks-preview" hidden></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 250px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['CardCheckNo'] }}</label>
                            <input class="rounded w-100" type="text" id="card-check-no"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['CardCheckNo'] }}"
                                {{ $formB['FormVars']['Required']['CardCheckNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['SorderNo'] }}</label>
                            <div class="d-flex">
                                <input type="text" id="sorder-no-txt" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['SorderNo'] }}"
                                    {{ $formB['FormVars']['Required']['SorderNo'] }}>
                                <button type="button"
                                        class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window sorder-modal-btn"
                                        data-target="slip"
                                        data-clicked="get_sorder_no"
                                        data-variable="sorderModal">
                                        <i class="icon-folder-open"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['PorderNo'] }}</label>
                            <div class="d-flex">
                                <input type="text" id="porder-no-txt" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['PorderNo'] }}"
                                    {{ $formB['FormVars']['Required']['PorderNo'] }}>
                                <button type="button"
                                    class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window porder-modal-btn"
                                    data-target="slip"
                                    data-clicked="get_porder_no"
                                    data-variable="porderModal">
                                    <i class="icon-folder-open"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-around">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-approved-check"> <label class="mb-0" for="is-approved-check">{{ $formB['FormVars']['Title']['IsApproved'] }}</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-fixed-check"> <label class="mb-0" for="is-fixed-check">{{ $formB['FormVars']['Title']['IsFixed'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-control custom-switch text-center mb-2" {{ count($formB['HeadSelectOptions']) > 3 ? 'hidden' : '' }}>
    <input type="checkbox" class="custom-control-input" id="is-acc-slip-approved-switch" value="1">
    <label class="custom-control-label" for="is-acc-slip-approved-switch">{{ $formB['FormVars']['Title']['IsApproved'] }}</label>
</div>

@once
@push('modal')
    @include('front.outline.static.memo')
@endpush

@push('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            include_the_blades_required_for_the_acc_slip()

            $('#acc-date').val(date_to_sting(new Date()))
            $('#occur-date').val(date_to_sting(new Date()))

            slipInit = await Btype.get_slip_form_init()
            await Btype.create_deal_type_select_box_options(slipInit.DealTypePage)
            await Btype.create_sgroup_select_box_options(slipInit.SgroupPage)
            await create_etc_select_box_options(slipInit)

            $('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo').find('.fr-view').html($('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            if (slipInit['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                $('.is-new-rec-auto-slip-no').text('자동채번')
                $('#auto-slip-no-txt').prop('disabled', true)
                // get_last_slip_no()
            }

            $('.acc-slip-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': AccountingAccSlipForm.btn_act_save(); break;
                    case 'new': btn_act_new(); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#acc-slip-form #frm'); break;
                    case 'body-copy': btn_bd_act_body_copy(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': AccountingAccSlipForm.btn_act_del(); break;
                }
            });

            $(document).on('unlink.company', '#modal-company', function (event) {
                init_company_id($('#acc-slip-form').find('#supplier-txt'))
            });

            $('#is-acc-slip-approved-switch').on('change', function () {
                $('#acc-slip-form').find('#is-approved-check').prop('checked', $(this).prop('checked') == '1')
            });
            $('#acc-slip-form #is-approved-check').on('change', function () {
                $('#is-acc-slip-approved-switch').prop('checked', $(this).prop('checked') == '1')
            });

            activate_button_group()
        });

        (function( AccountingAccSlipForm, $, undefined ) {
            AccountingAccSlipForm.btn_act_save = function () {
                Btype.btn_act_save('#acc-slip-form #frm', function () {
                    $('#acc-slip-form').find('.sorder-modal-btn').prop('disabled', true)
                    $('#acc-slip-form').find('.porder-modal-btn').prop('disabled', true)
                    $('#modal-select-popup').modal('hide');
                });
            }

            AccountingAccSlipForm.btn_act_del = function () {
                Btype.btn_act_del('#acc-slip-form #frm', function () {
                    $('#modal-select-popup').modal('hide');
                });
            }

            AccountingAccSlipForm.show_popup_callback = async function (id, c1) {
                await Btype.fetch_slip_form_book(c1);
            }
        }( window.AccountingAccSlipForm = window.AccountingAccSlipForm || {}, jQuery ));

        function set_company_data_to_textbox(company) {
            get_supplier_id(company.Id)
            return $('.save-button')
        }

        // 수주번호 찾기 -> 수주번호 입력
        function get_sorder_no(slip_no){
            $('#sorder-no-txt').val(slip_no);
            modalQuery = sorderModal['QueryVars']['QueryName'];
            const response = Btype.fetch_slip_form_book(slip_no, 'window', update_modal_hd);
	        $('#modal-slip').modal('hide');
        }

        // 수주번호 찾기 -> 수주번호 입력
        function get_porder_no(slip_no){
            $('#porder-no-txt').val(slip_no);
            modalQuery = porderModal['QueryVars']['QueryName'];
            const response = Btype.fetch_slip_form_book(slip_no, 'window', update_modal_hd);
	        $('#modal-slip').modal('hide');
        }

        function update_modal_hd(response){
            if(response.data.QueryVars.QueryName === 'sales/sorder'){
                console.log('update_modal_hd : ', response);
                // $('#supplier-txt').val(response.data.HdPage[0].CompanyName);
                // $('#supplier-txt').data('id', response.data.HdPage[0].BuyerId);
                // $('#supplier-txt').data('contact', response.data.HdPage[0].BuyerContact);
                $('#sorder-no-txt').data('id', response.data.HdPage[0].Id);
                // $('#supplier-txt').prop('readonly', true);
                // $('.company-modal-btn').prop('disabled', true);
            }else{
                $('#porder-no-txt').data('id', response.data.HdPage[0].Id);
            }
        }

        function get_parameter() {
            const deal_name = slipInit['DealTypePage'].filter(page => page['Id'] === Number($('#deal-type-select').val()))[0]['DealName']
            console.log('DealTypePage', slipInit['DealTypePage']);
            let id = parseInt($('#acc-slip-form').find("#Id").val())
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                AccSlipNo: $('#acc-slip-form').find('#auto-slip-no-txt').val(),
                AccDate: moment(new Date($('#acc-slip-form').find('#acc-date').val())).format('YYYYMMDD'),
                UserId: window.User['UserId'],
                SgroupId: parseInt($('#acc-slip-form').find('#sgroup-id-select').val()),
                BranchId: window.User['BranchId'],
                CompanyId: parseInt($('#acc-slip-form').find('#supplier-txt').data('id')),
                DealTypeId: parseInt($('#acc-slip-form').find('#deal-type-select').val()),
                BillType: $('#acc-slip-form').find('#bill-type-select').val(),
                BillColumn1: $('#acc-slip-form').find('#bill-column1-txt').val(),
                SlipAmt: minusComma($('#acc-slip-form').find('#slip-amt-txt').val()),
                OccurDate: moment(new Date($('#acc-slip-form').find('#occur-date').val())).format('YYYYMMDD'),
                Remarks: $('#acc-slip-form').find('#remarks-preview').html(),
                CardCheckNo: $('#acc-slip-form').find('#card-check-no').val(),
                AutoSlipAmt: $('#acc-slip-form').find('#auto-slip-amt').val(),
                IsFixed: $('#acc-slip-form').find('#is-fixed-check:checked').val() ?? '0',
                IsApproved: $('#acc-slip-form').find('#is-approved-check:checked').val() ?? '0',
                Status: $('#acc-slip-form').find('#status-select').val(),
                SorderId: $('#acc-slip-form').find('#sorder-no-txt').data('id'),
                PorderId: $('#acc-slip-form').find('#porder-no-txt').data('id'),
                DealName: deal_name,
                Ip: window.User['Ip']
            }
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }

            console.log('save : ', parameter)
            return parameter;
        }

        function btn_act_new() {
            bd_page = [];
            $('#acc-slip-form').find('#Id').val(0)
            $('#acc-slip-form').find('#auto-slip-amt').val(0)
            $('.save-button').prop('disabled', false)
            input_box_reset_for('#acc-slip-form #frm')
            $('#acc-slip-form').find('#supplier-txt').val('')
            $('#acc-slip-form').find('#supplier-txt').data('id', 0)
            $('#acc-slip-form').find('#supplier-txt').data('contact', '')

            $('#acc-slip-form').find('#sorder-no-txt').val('')
            $('#acc-slip-form').find('#sorder-no-txt').data('id', 0)
            $('#acc-slip-form').find('#porder-no-txt').val('')
            $('#acc-slip-form').find('#porder-no-txt').data('id', 0)
            $('#acc-slip-form').find('#status-select').val('')

            $('#acc-slip-form').find('.company-modal-btn').prop('disabled', false)
            $('#acc-slip-form').find('.sorder-modal-btn').prop('disabled', false)
            $('#acc-slip-form').find('.porder-modal-btn').prop('disabled', false)
            $('#acc-slip-form').find('#supplier-txt').prop('readonly', false);
            $('#acc-slip-form').find('#sorder-no-txt').prop('readonly', false);
            $('#acc-slip-form').find('#porder-no-txt').prop('readonly', false);

            Btype.set_slip_no_btn_abled()
            get_last_slip_no();
            $('#acc-slip-form').find('#acc-date').val(date_to_sting(new Date()))
            $('#acc-slip-form').find('#occur-date').val(date_to_sting(new Date()))
        }

        async function include_the_blades_required_for_the_acc_slip() {
            const response = await get_para_data('modal', '/search/company-search/company')
            companyModal = response['data']

            get_blades_html('front.outline.static.company', companyModal, function (html) {
                if ($('#element_in_which_to_insert').find('#modal-company').length) return;
                $('#element_in_which_to_insert').append(html);
            });
        }

        async function create_etc_select_box_options(data) {
            // let bill_type = create_options(data.EtcBillTypePage)
            const status = create_options(data.EtcAccStatusPage)

            // $('#bill-type-select').html(bill_type);
            $('#status-select').html(status);
        }

        function occur_date_change() {
            $('#occur-date').val($('#acc-date').val())
        }

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        async function update_hd_ui(response) {
            console.log(response)
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }

            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            // console.log(hd_page)
            if(hd_page.SorderId != 0){
                let sorder = await get_api_data('sorder-pick', { Page: [ { Id: hd_page.SorderId } ] });
                hd_page.SorderNo = sorder.data.Page[0].SorderNo;
            }

            if(hd_page.PorderId != 0){
                let porder = await get_api_data('porder-pick', { Page: [ { Id: hd_page.PorderId } ] });
                hd_page.PorderNo = porder.data.Page[0].PorderNo;
            }

            $('#acc-slip-form').find("#Id").val(hd_page.Id)
            $('#acc-slip-form').find('#auto-slip-no-txt').val(hd_page.AccSlipNo)
            $('#acc-slip-form').find('#acc-date').val(moment(to_date(hd_page.AccDate)).format('YYYY-MM-DD'))

            $('#acc-slip-form').find('#supplier-txt').val(hd_page.CompanyName)
            $('#acc-slip-form').find('#supplier-txt').data('id', hd_page.CompanyId)


            $('#acc-slip-form').find('#supplier-txt').prop('readonly',  hd_page.CompanyName != "")
            $('#acc-slip-form').find('.company-modal-btn').prop('disabled',  hd_page.CompanyName != "")
            $('#acc-slip-form').find('#sorder-no-txt').prop('readonly',  hd_page.SorderNo != "")
            $('#acc-slip-form').find('.sorder-modal-btn').prop('disabled',  hd_page.SorderId != 0)
            $('#acc-slip-form').find('#porder-no-txt').prop('readonly',  hd_page.PorderId != 0)
            $('#acc-slip-form').find('.porder-modal-btn').prop('disabled',  hd_page.PorderId != 0)


            $('#acc-slip-form').find('#deal-type-select').val(hd_page.DealTypeId)
            $('#acc-slip-form').find('#bill-type-select').val(hd_page.BillType)
            $('#acc-slip-form').find('#slip-amt-txt').val(format_conver_for(hd_page.SlipAmt, formB.FormVars['Format'].SlipAmt))

            $('#acc-slip-form').find('#occur-date').val(moment(to_date(hd_page.OccurDate)).format('YYYY-MM-DD'))
            $('#acc-slip-form').find('#sgroup-id-select').val(hd_page.SgroupId)
            $('#acc-slip-form').find('#remarks-txt-area').val(remove_tag(hd_page.Remarks))
            $('#acc-slip-form').find('#remarks-preview').html(hd_page.Remarks)

            $('#acc-slip-form').find('#card-check-no').val(hd_page.CardCheckNo)
            $('#acc-slip-form').find('#status-select').val(hd_page.Status)
            $('#acc-slip-form').find('#sorder-no-txt').val(hd_page.SorderNo)
            $('#acc-slip-form').find('#sorder-no-txt').data('id', hd_page.SorderId)
            $('#acc-slip-form').find('#porder-no-txt').val(hd_page.PorderNo)
            $('#acc-slip-form').find('#porder-no-txt').data('id', hd_page.PorderId)
            $('#acc-slip-form').find('#deal-type-select').val(hd_page.DealTypeId)
            $('#acc-slip-form').find('#is-approved-check').prop('checked', hd_page.IsApproved == '1')
            $('#is-acc-slip-approved-switch').prop('checked', hd_page.IsApproved == '1')
            let is_fixed = hd_page.IsFixed == '1'
            $('#acc-slip-form').find('#is-fixed-check').prop('checked', is_fixed)

            $('#modal-slip').modal('hide');
        }

        let companyModal;
        let sorderModal = {!! json_encode($sorderModal) !!};
        let porderModal = {!! json_encode($porderModal) !!};
        var formB = {!! json_encode($formB) !!};
        let slipInit = null;
        var modalQuery = [];
        // console.log('formB : ', formB);
    </script>
@endpush
@endonce
