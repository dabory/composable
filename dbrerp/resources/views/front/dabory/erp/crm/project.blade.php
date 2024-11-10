@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content crm">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="projectModal">
                    <i class="icon-folder-open"></i>
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary project-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'project-act',
                    ])
                </div>
            </div>

            <div class="card" id="project-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 310px">
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
                                        <input class="rounded w-100" type="date" value="" id="project-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                            {{ $formB['FormVars']['Required']['Date'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['ProjectName'] }}</label>
                                        <input class="rounded w-100" id="project-name-txt" type="text"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['ProjectName'] }}"
                                            {{ $formB['FormVars']['Required']['ProjectName'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['ContractAmt'] }}</label>
                                        <input type="text" id="contract-amt-txt" class="rounded w-100 decimal" autocomplete="off"
                                               data-point="{{ $formB['FormVars']['Format']['ContractAmt'] }}"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['ContractAmt'] }}"
                                            {{ $formB['FormVars']['Required']['ContractAmt'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['PreCostAmt'] }}</label>
                                        <input type="text" id="pre-cost-amt-txt" class="rounded w-100 decimal" autocomplete="off"
                                               data-point="{{ $formB['FormVars']['Format']['PreCostAmt'] }}"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['PreCostAmt'] }}"
                                            {{ $formB['FormVars']['Required']['PreCostAmt'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 310px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 ">{{ $formB['FormVars']['Title']['Buyer'] }}</label>
                                        <div class="d-flex">
                                            <input type="text" id="buyer-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                                   onkeydown="company_model_show_cell_enter_key(event, 'BB')"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Buyer'] }}"
                                                {{ $formB['FormVars']['Required']['Buyer'] }}>
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
                                        <label class="m-0">{{ $formB['FormVars']['Title']['BuyerContact'] }}</label>
                                        <input class="rounded w-100" id="buyer-contact-txt" type="text"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['BuyerContact'] }}"
                                            {{ $formB['FormVars']['Required']['BuyerContact'] }}>
                                    </div>
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
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 310px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                        <select class="rounded w-100" data-closed="0" id="status-select" onchange="Btype.set_is_closed_val(this)"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Status'] }}"
                                            {{ $formB['FormVars']['Required']['Status'] }}>
                                            @foreach ($codeTitle['status']['project'] as $key => $status)
                                                <option value="{{ $status['Code'] }}">
                                                    {{ $status['Title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Destination'] }}</label>
                                        <select class="rounded w-100" id="destination-select"
                                                maxlength="{{ $formB['FormVars']['MaxLength']['Destination'] }}"
                                            {{ $formB['FormVars']['Required']['Destination'] }}></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 310px">
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
                                        <label class="m-0">{{ $formB['FormVars']['Title']['IsClosed'] }}</label>
                                        <input class="rounded" type="checkbox" id="is-closed-check" value="1"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['IsClosed'] }}"
                                            {{ $formB['FormVars']['Required']['IsClosed'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-0 border-light" style="height: 310px">
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
                                        <label class="m-0">{{ $formB['FormVars']['Title']['UserName'] }}</label>
                                        <input class="rounded w-100" type="text" id="user-txt" disabled
                                               maxlength="{{ $formB['FormVars']['MaxLength']['UserName'] }}"
                                            {{ $formB['FormVars']['Required']['UserName'] }}>
                                    </div>
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
    @include('front.outline.static.slip', ['moealSetFile' => $projectModal])
    @include('front.outline.static.company', ['moealSetFile' => $companyModal])
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            $('#project-date').val(date_to_sting(new Date()))

            let data = await Btype.get_slip_form_init()
            formB['SlipCommonSetup'] = data['SlipCommonSetup']
            await Btype.create_deal_type_select_box_options(data.DealTypePage)
            await Btype.create_vat_type_select_box_options(data.VatRatePage)
            await Btype.create_sgroup_select_box_options(data.SgroupPage)
            await create_etc_select_box_options(data)
            $('#user-txt').val(window.User['NickName'])

            if (formB['SlipCommonSetup']['IsLastSlipGet']) {
                // slip-search cache 사용
                Btype.set_slip_cache_data();

                if (! isEmpty(pickCacheData['query'])) {
                    let query = JSON.parse(pickCacheData['query'])
                    await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
                }
            }

            $('.project-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#project-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#project-form #frm'); break;
                    case 'delete': Btype.btn_act_del('#project-form #frm'); break;
                }
            });

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

        function data_init() {
            bd_page = [];
            $('#frm').find('#Id').val(0)
            $('.save-button').prop('disabled', false)
            input_box_reset_for('#project-form #frm')

            Btype.set_slip_no_btn_abled()
            $('#project-date').val(date_to_sting(new Date()))
            $('#buyer-txt').val('')
            $('#buyer-txt').data('id', 0)
            $('#buyer-txt').data('contact', '')

            $('#user-txt').val(window.User['NickName'])
        }

        function btn_act_new() {
            data_init()

            if (formB['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                get_last_slip_no()
            }
        }

        function get_parameter() {
            let id = parseInt($('#frm').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                ProjectNo: $('#auto-slip-no-txt').val(),
                ProjectName: $('#project-name-txt').val(),
                ContractAmt: minusComma($('#contract-amt-txt').val()),
                PreCostAmt: minusComma($('#pre-cost-amt-txt').val()),
                ProjectDate: moment(new Date($('#project-date').val())).format('YYYYMMDD'),
                UserId: window.User['UserId'],
                SgroupId: parseInt($('#sgroup-id-select').val()),
                BranchId: window.User['BranchId'],
                BuyerId: parseInt($('#buyer-txt').data('id')),
                BuyerContact: $('#buyer-txt').data('contact'),
                VatRateId: parseInt($('#vat-type-select').val()),
                PayTerms: $('#payTerms-select').val(),
                Destination: $('#destination-select').val(),
                Delivery: $('#delivery-select').val(),
                Status: $('#status-select').val(),
                IsClosed: $('#is-closed-check:checked').val() ?? '0',
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

            // console.log(parameter)
            return parameter;
        }

        async function get_last_slip_no() {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        async function get_override_supplier_id(company_no, company_id) {
            await get_supplier_id(company_id, '#buyer-txt');
            $('#buyer-contact-txt').val($('#buyer-txt').data('contact'))
        }

        async function create_etc_select_box_options(data) {
            let delivery = create_options(data.EtcDeliveryPage)
            let payTerms = create_options(data.EtcPayTermPage)
            let destination = create_options(data.EtcDestinationPage)

            $('#delivery-select').html(delivery);
            $('#payTerms-select').html(payTerms);
            $('#destination-select').html(destination);
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

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            $('#Id').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.ProjectNo)
            $('#project-name-txt').val(hd_page.ProjectName)
            $('#contract-amt-txt').val(format_conver_for(hd_page.ContractAmt, formB.FormVars['Format'].ContractAmt))
            $('#pre-cost-amt-txt').val(format_conver_for(hd_page.PreCostAmt, formB.FormVars['Format'].PreCostAmt))

            $('#project-date').val(moment(to_date(hd_page.ProjectDate)).format('YYYY-MM-DD'))
            $('#buyer-txt').val(hd_page.CompanyName)
            $('#buyer-txt').data('id', hd_page.BuyerId)
            $('#buyer-txt').data('contact', hd_page.BuyerContact)
            $('#buyer-contact-txt').val(hd_page.BuyerContact)

            $('#deal-type-select').val(hd_page.DealTypeId)
            $('#vat-type-select').val(hd_page.VatRateId)
            // $('#vat-type-select').trigger('change')
            set_vat_type_rate('#vat-type-select', false);
            $('#status-select').val(hd_page.Status)

            $('#delivery-select').val(hd_page.Delivery)
            $('#payTerms-select').val(hd_page.PayTerms)
            $('#destination-select').val(hd_page.Destination)

            $('#remarks-txt-area').val(hd_page.Remarks)
            $('#remarks-preview').html(hd_page.Remarks)
            $('#is-closed-check').prop('checked', hd_page.IsClosed == '1')

            $('#sgroup-id-select').val(hd_page.SgroupId)

            $('#modal-slip').modal('hide');
        }

        const projectModal = {!! json_encode($projectModal) !!};
        const companyModal = {!! json_encode($companyModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
