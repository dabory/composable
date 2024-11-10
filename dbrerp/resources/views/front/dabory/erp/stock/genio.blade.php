@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content stock">
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
                    data-variable="genioModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary genio-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'genio-act',
                    ])
                </div>
            </div>

            <div class="card" id="genio-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="Id" name="Id" value="0">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}(<span class="is-new-rec-auto-slip-no">수동입력</span>)</label>
                                        <div class="col-12 d-flex p-0">
{{--                                        <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"--}}
{{--                                            onclick="get_last_slip_no(this)">--}}
{{--                                            <span class="icon-cogs"></span>--}}
{{--                                        </button>--}}
                                            <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                                        maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                            {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['GenioDate'] }}</label>
                                        <input class="rounded w-100" type="date" value="" id="genio-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['GenioDate'] }}"
                                            {{ $formB['FormVars']['Required']['GenioDate'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['DealType'] }}</label>
                                        <select class="rounded w-100" id="deal-type-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['DealType'] }}"
                                            {{ $formB['FormVars']['Required']['DealType'] }}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['CompanyName'] }}</label>
                                        <div class="d-flex">
                                            <input type="text" id="supplier-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                            onkeydown="company_model_show_cell_enter_key(event, 'BB')"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['CompanyName'] }}"
                                                {{ $formB['FormVars']['Required']['CompanyName'] }}>
                                            <button type="button"
                                                class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window company-modal-btn"
                                                data-target="company"
                                                data-clicked="get_override_supplier_id"
                                                data-variable="companyModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Contact'] }}</label>
                                        <input class="rounded w-100" id="supplier-contact-txt" type="text"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['Contact'] }}"
                                            {{ $formB['FormVars']['Required']['Contact'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="status-select" onchange="Btype.set_is_closed_val(this)"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                            {{ $formB['FormVars']['Required']['Status'] }}>
                                            @foreach ($codeTitle['status']['genio'] as $key => $status)
                                                <option value="{{ $status['Code'] }}">
                                                    {{ $status['Title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['VatType'] }}</label>
                                        <select class="rounded w-100" id="vat-type-select" onchange="set_vat_type_rate(this)"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['VatType'] }}"
                                            {{ $formB['FormVars']['Required']['VatType'] }}>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['VatTypeRate'] }}</label>
                                        <input type="text" id="vat-type-rate-text" class="rounded w-100" autocomplete="off" value="" disabled
                                               maxlength="{{ $formB['FormVars']['MaxLength']['VatTypeRate'] }}"
                                            {{ $formB['FormVars']['Required']['VatTypeRate'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['SgroupName'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="sgroup-id-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['SgroupName'] }}"
                                            {{ $formB['FormVars']['Required']['SgroupName'] }}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">기타</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['OurContact'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="our-contact-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['OurContact'] }}"
                                            {{ $formB['FormVars']['Required']['OurContact'] }}>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Column1'] }}</label>
                                        <select class="rounded w-100" id="column1-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Column1'] }}"
                                            {{ $formB['FormVars']['Required']['Column1'] }}></select>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Column2'] }}</label>
                                        <select class="rounded w-100" id="column2-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Column2'] }}"
                                            {{ $formB['FormVars']['Required']['Column2'] }}></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
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
                    <!-- 탭시작 -->
                    <ul class="nav nav-tabs nav-tabs-solid rounded">
                        <li class="nav-item correct-tab"><a href="#correct-tab" class="nav-link rounded-left active" data-toggle="tab">{{ $formB['FormVars']['Title']['Genio'] }}</a></li>
                        <li class="nav-item -tab"><a href="#-tab" class="nav-link" data-toggle="tab">{{ $formB['FormVars']['Title']['Moutio'] }}</a></li>
                    </ul>
                    <!--// 탭 끝 -->

                    <!-- 탭내용 시작 -->
                    <div class="tab-content">
                        @include('front.dabory.erp.stock.tab.genio-correct')
                        <div class="tab-pane fade" id="-tab">
                            자재소모내역
                        </div>
                    </div>
                    <!--// 탭 내용 끝 -->

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
    @include('front.outline.static.slip', ['moealSetFile' => $genioModal])
    @include('front.outline.static.company', ['moealSetFile' => $companyModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.company-modal-btn').on('click', function() {
                if(!checkModalOpen(this)){
                    return false;
                }
            });
        });
        window.onload = async function () {
            $('#genio-date').val(date_to_sting(new Date()))

            let sgroup_pick = await get_api_data('sgroup-pick', { Page: [ { Id:  parseInt(window.User['SgroupId']) } ] });
            window.User['SgroupName'] = sgroup_pick['data']['Page'][0]['SgroupName']
            Btype.get_storage_name_and_branch_name()
            // let data = await Btype.get_slip_form_init()

            slipInit = @json($slipFormInitCacheData);
            formB['SlipCommonSetup'] = slipInit['SlipCommonSetup']
            // select box 만들기
            await Btype.create_deal_type_select_box_options(slipInit.DealTypePage)
            await Btype.create_vat_type_select_box_options(slipInit.VatRatePage)
            await Btype.create_sgroup_select_box_options(slipInit.SgroupPage)
            await create_etc_select_box_options(slipInit)

            $('#user-txt').val(window.User['NickName'])

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);

                }
            }

            // if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
            //     $('.is-new-rec-auto-slip-no').text('자동채번')
            //     $('#auto-slip-no-txt').prop('disabled', true)
            //     // get_last_slip_no()
            // }


            $('.genio-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#genio-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'copy-to-another': btn_act_copy_to_another(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#genio-form #frm'); break;
                    case 'delete': Btype.btn_act_del('#genio-form #frm'); break;
                }
            });
            // 비고
            $('#remarks-txt-area').on('dblclick', function () {
                $('#modal-memo2').find('#memo-textarea').val('')
                $('#modal-memo2').data('txtarea_id', '#remarks-txt-area')
                $('#modal-memo2').find('#memo-textarea').val($('#remarks-txt-area').val())
                $('#modal-memo2').modal('show');
            });

            activate_button_group()
        }

        function set_company_data_to_textbox(company) {
            get_override_supplier_id(company.Id)
            return $('.save-button')
        }

        function btn_act_new() {
            GenioCorrect.bd_page = [];
            input_box_reset_for('#frm', ['user-txt'])
            input_box_reset_for('#total-frm')
            $('#supplier-txt').data('id', 0)
            $('#supplier-txt').data('contact', '')
            $('#supplier-txt').prop('readonly', false)
            $('#vat-type-select').trigger('change');
            $('#status-select').data('closed', 0)

            $('.genio-act.save-button').prop('disabled', false)
            $('.company-modal-btn').removeClass('disabled')

            Btype.set_slip_no_btn_abled()
            $('#genio-date').val(date_to_sting(new Date()))

            // table body 초기화
            table_head_check_box_reset('#genio-table-head')
            $('#genio-table-body').html('');

            if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                get_last_slip_no()
            }
        }

        function get_parameter() {
            const deal_name = slipInit['DealTypePage'].filter(page => page['Id'] === Number($('#deal-type-select').val()))[0]['DealName']
            const vat_rate = $('#vat-type-select').find('option:selected').data('vatrate')
            const vat_name = slipInit['VatRatePage'].filter(page => page['Id'] === Number($('#vat-type-select').val()))[0]['VatName']
            const itmtot_qty = GenioCorrect.bd_page.reduce((accumulator, bd) => {
                return accumulator + parseFloat(bd.GenioQty)
            }, 0)
            let first_item = ''
            if (GenioCorrect.bd_page.length > 0) {
                const first_genio = GenioCorrect.bd_page[0]
                console.log('first_genio : ', first_genio);
                first_item = first_genio['ItemCode'] + '_' + first_genio['ItemName']
                if (first_genio['SubName']) {
                    first_item += '_' + first_genio['SubName']
                }
                // first_item += '(' + itmtot_qty + ')'
            }
            const itmtot_amt = GenioCorrect.bd_page.reduce((accumulator, bd) => {
                return accumulator + parseFloat(bd.GenioSupply) + parseFloat(bd.GenioVat) // 합계금액 (공급가액 + 세액)
            }, 0)
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                GenioNo: $('#auto-slip-no-txt').val(),
                GenioDate: moment(new Date($('#genio-date').val())).format('YYYYMMDD'),
                DealTypeId: parseInt($('#deal-type-select').val()),
                UserId: window.User['UserId'],
                SgroupId: parseInt($('#sgroup-id-select').val()),
                BranchId: window.User['BranchId'],
                StorageId: window.User['StorageId'],
                CompanyId: parseInt($('#supplier-txt').data('id')),
                VatRateId: parseInt($('#vat-type-select').val()),
                CompanyContact: $('#supplier-txt').data('contact'),
                OurContact: $('#our-contact-select').val(),
                Status: $('#status-select').val(),
                Column1: $('#column1-select').val(),
                Column2: $('#column2-select').val(),
                Remarks: $('#remarks-txt-area').val(),
                Ip: window.User['Ip'],

                FirstItem: first_item,
                ItmtotAmt: String(itmtot_amt),
                DiscountAmt: '0',
                TotalAmt: String(Number(itmtot_amt) - 0),
                TotalQty: String(Number(itmtot_qty) - 0),
                DealName: deal_name,
                VatRate: vat_rate,
                VatName: vat_name,
                SgroupName: window.User['SgroupName']
            }

            console.log(parameter);
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }

            return parameter;
        }
        // DealTypePage, VatRatePage, SgroupPage과 마찬가지로 reduce를 통해 data 배열을 순회하면서 option 태그를 생성 for create_options()
        async function create_etc_select_box_options(data) {
            let column1 = create_options(data.EtcColumn1Page)
            let column2 = create_options(data.EtcColumn2Page)
            let our_contact = create_options(data.EtcOurContactPage)
            // 공란1
            $('#column1-select').html(column1);
            // 공란2
            $('#column2-select').html(column2);
            // 발주담당자
            $('#our-contact-select').html(our_contact);
        }

        // start head act btn
        function btn_act_copy_to_another(parameter_name) {
            let data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            // $(`#modal-copy-to-another.${parameter_name}`).find('.target-slip-no-txt').data('slip-no', $('#auto-slip-no-txt').val())
            $(`#modal-copy-to-another.${parameter_name}`).find('.source-slip-no-txt').val($('#auto-slip-no-txt').val())
            $('.stock').find('.modal-btn').data('target', 'copy-to-another')
            $('.stock').find('.modal-btn').data('variable', data['Parameter'])
            $('.stock').find('.modal-btn').data('class', parameter_name)
            $('.stock').find('.modal-btn').trigger('click')
        }

        function bd_update_due_to_vat_rate_change() {
            let data = [];

            GenioCorrect.bd_page = GenioCorrect.bd_page.filter(function (bd) {
                return bd.Id != 0;
            });

            GenioCorrect.bd_page.forEach(bd => {
                let supply_amt, vat_amt, sum_amt;
                [supply_amt, vat_amt, sum_amt] = Btype.amt_calc({ pquote_prc: parseFloat(bd.GenioPrc), pquote_qty: parseFloat(bd.GenioQty) },
                    parseFloat($('#vat-type-select').find('option:selected').data('vatrate')));
                bd.GenioSupply = supply_amt;
                bd.GenioVat = vat_amt;
                bd.GenioSum = sum_amt;

                data.push({
                    Id: parseInt(bd.Id),
                    GenioSupply: String(bd.GenioSupply),
                    GenioVat: String(bd.GenioVat),
                    GenioSum: String(bd.GenioSum),
                    Ip: window.User['Ip']
                })
            });
            return data;
        }

        function set_vat_type_rate($this, msg = true) {
            let vate_rate = $($this).find('option:selected').data('viewvatrate');
            $('#vat-type-rate-text').val(vate_rate + '%')

            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0 || ! msg) return;
            Btype.call_act_api(get_parameter(), function() { });

            if (isEmpty(GenioCorrect.bd_page)) return;

            let data = bd_update_due_to_vat_rate_change();
            Btype.call_bd_act_api(data, function() {
                GenioCorrect.create_bd_page();
            })
        }

        async function get_override_supplier_id(supplier_id) {
            await get_supplier_id(supplier_id);
            $('#supplier-contact-txt').val($('#supplier-txt').data('contact'))
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
            let bd_page = response.data.BdPage ?? []
            console.log('hd_page : ', hd_page);
            $('#Id').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.GenioNo)
            $('#genio-date').val(moment(to_date(hd_page.GenioDate)).format('YYYY-MM-DD'))
            $('#deal-type-select').val(hd_page.DealTypeId)
            $('#supplier-txt').val(hd_page.CompanyName)
            $('#supplier-txt').data('id', hd_page.CompanyId)
            $('#supplier-txt').data('contact', hd_page.CompanyContact)
            $('#supplier-contact-txt').val(hd_page.CompanyContact)
            $('#status-select').val(hd_page.Status)

            // 저장된 데이터 불러올 경우 고객업체 비활성화
            // $('#supplier-txt').prop('readonly',  hd_page.CompanyName != "")
            // $('.company-modal-btn').prop('disabled',  hd_page.CompanyName != "")
            // $('.disabled-if-saved').prop('disabled',  true)
            // showFlashPopup('.company-modal-btn');
            // showFlashPopup('.disabled-if-saved');
            disabledmenu(hd_page);

            $('#vat-type-select').val(hd_page.VatRateId)
            set_vat_type_rate('#vat-type-select', false);
            $('#sgroup-id-select').val(hd_page.SgroupId)

            $('#our-contact-select').val(hd_page.OurContact)
            $('#column1-select').val(hd_page.Column1)
            $('#column2-select').val(hd_page.Column2)

            $('#remarks-txt-area').val(hd_page.Remarks)
            $('#remarks-preview').html(hd_page.Remarks)

            // table body에 데이터 추가
            GenioCorrect.update_bd_ui(bd_page);

            $('#modal-slip').modal('hide');
        }

        function showFlashPopup(dom_val) {
            if($(dom_val).prop('disabled')){
                $(dom_val).on('mouseover', function() {
                    showNotice();
                });
            }
        }

        function disabledmenu(hd_page) {
            const isCompanySaved = hd_page.CompanyName !== "";
            $('#supplier-txt').prop('readonly',  isCompanySaved)
            $('.company-modal-btn').toggleClass('disabled', isCompanySaved);
        }

        function checkModalOpen(element) {
            const $this = $(element);
            const auto_slip_no = $('#auto-slip-no-txt').val();

            // 전표번호가 비어 있을 경우
            if (!auto_slip_no) {
                iziToast.warning({
                    title: "warning",
                    message: "저장>추가 버튼을 클릭하여 새 전표번호로 시작하세요."
                });
                return false;
            }
            // disabled인 경우
            if ($this.hasClass('disabled')) {
                let msg = "저장된 해당정보는 변경할 수 없으며 전표 삭제만 가능합니다.";
                if ($this.hasClass('disabled-if-saved')) { // 항목추가인 경우
                    msg = "연관 전표번호가 있을경우 연관복사로만 추가가 가능합니다.";
                }
                iziToast.warning({
                    title: "warning",
                    message: msg
                });
                return false;
            }
            return true;
        }

        const genioModal = {!! json_encode($genioModal) !!};
        const companyModal = {!! json_encode($companyModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        let slipInit = null;

    </script>
@endsection
