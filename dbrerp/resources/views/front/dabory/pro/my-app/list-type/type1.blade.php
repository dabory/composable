@extends('front.dabory.pro.my-app.layouts.master')
@section('title', $type1['General']['Title'])
@section('content')
    <div class="type1">
        <div class="mb-1 pt-2 px-3 text-right d-flex justify-content-end">
            <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
            </button>

            <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
            </button>
            @if ($type1['FormVars']['Hidden']['ListButton'] == 'hidden')
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary type1-act" data-parameter="{{ $type1['HeadSelectOptions'][0]['ParameterName'] ?? '' }}" data-value="{{ $type1['HeadSelectOptions'][0]['Value'] }}"
                            data-index="0" data-component="{{ $type1['HeadSelectOptions'][0]['Component'] ?? '' }}">
                        {{ $type1['HeadSelectOptions'][0]['Caption'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => array_slice($type1['HeadSelectOptions'], 1),
                        'eventClassName' => 'type1-act',
                    ])
                </div>
            @else
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary type1-act" data-value="list">
                        {{ $type1['FormVars']['Title']['ListButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $type1['HeadSelectOptions'],
                        'eventClassName' => 'type1-act',
                    ])
                </div>
            @endif
        </div>

        <div class="card-body my-0 py-1">
            <div class="card mb-2">
                <div class="card-header pt-0" id="frm">
                    <div class="row">
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $type1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2 my-0">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body mt-0">
                                    <div class="{{ $type1['FormVars']['Display']['DateNavi'] }} flex-column mb-2">
                                        <div>
                                            <button class="btn-light btn-light-100 mr-1 px-1 py-0 rounded text-grey btn-xxs line-height-1 outline-0 border-0" id="type1-date-navi-prev-btn"
                                                    onclick="calc_date_rang('.type1-date-navi-div', $('input:radio[name=type1-date-navi]:checked').val(), -1)" style="height:14px;">
                                                <i class="fas fa-angle-left"></i>
                                            </button>
                                            <button class="btn-light btn-light-100 rounded text-grey btn-xxs line-height-2 outline-0 border-0"
                                                    onclick="first_date_rang('.type1-date-navi-div', false, true)">
                                                {{ $type1['FormVars']['Title']['DateNavi'] }}
                                            </button>
                                            {{--                                            <label class="m-0" style="vertical-align:middle;">{{ $type1['FormVars']['Title']['DateNavi'] }}</label>--}}
                                            <button class="btn-light btn-light-100 ml-1 px-1  py-0 rounded text-grey btn-xxs line-height-1 outline-0 border-0" id="type1-date-navi-next-btn"
                                                    onclick="calc_date_rang('.type1-date-navi-div', $('input:radio[name=type1-date-navi]:checked').val(), 1)" style="height:14px;">
                                                <i class="fas fa-angle-right"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-around type1-date-navi-div" style="height: 28px;">
                                            @foreach ($type1['DateNaviOptions'] ?? [] as $key => $option)
                                                @empty($option['Caption'])
                                                @else
                                                    <div class="d-flex align-items-center">
                                                        <input autocomplete="off" name="type1-date-navi" type="radio"
                                                               value="{{ $option['Value'] }}" id="{{ 'type1-date-navi-'.($key+1) }}">
                                                        <label for="{{ 'type1-date-navi-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap mb-0 ml-1">{{ $option['Caption'] }}
                                                        </label>
                                                    </div>
                                                @endempty
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="{{ $type1['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['DateRange'] }}</label>
                                        <div class="d-flex align-items-center" style="height: 28px;">
                                            @foreach ($type1['DateRangeOptions'] ?? [] as $key => $option)
                                                <input  autocomplete="off" name="type1-date-range" type="radio" value="{{ $option['Value'] }}" id="{{ 'type1-date-range-'.($key+1) }}"
                                                    {{ $option['Value'] == 'all' ? 'checked' : ''}}>
                                                <label for="{{ 'type1-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap mb-0 ml-1">{{ $option['Caption'] }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $type1['FormVars']['Display']['Date'] }} flex-column mb-2">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['Date'] }}</label>
                                        <div class="d-flex">
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="type1-start-date" type="date" value="1990-01-01">
                                            <button class="btn disabled p-1 text-center">~</button>
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="type1-end-date" type="date" value="3000-12-31">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $type1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2 my-0">
                                </div>
                                <div class="card-body mt-0">
                                    @foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $listType1RangeVar)
                                        <div class="{{ $type1['FormVars']['Display'][$listType1RangeVar] }} flex-column mb-2">
                                            <label class="m-0">{{ $type1['FormVars']['Title'][$listType1RangeVar] }}</label>
                                            <div class="d-flex">
                                                <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                       type="text" value="" id="From{{ $listType1RangeVar }}">&nbsp;
                                                <button type="button" onclick="show_modal('{{ $listType1RangeVar }}', 'From')"
                                                        class="btn-dark rounded border-0
                                                                    overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                    {{ $type1['FormVars']['Title']['From'] }}
                                                </button>&nbsp;
                                                <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                       type="text" value="" id="To{{ $listType1RangeVar }}">&nbsp;
                                                <button type="button" onclick="show_modal('{{ $listType1RangeVar }}', 'To')"
                                                        class="btn-dark rounded border-0
                                                                    overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                    {{ $type1['FormVars']['Title']['To'] }}
                                                </button>&nbsp;
                                                <button class="btn-dark rounded border-0
                                                                overflow-hidden w-100 text-nowrap col-1" style="height: 28px"
                                                        onclick="same_as_form_and_scope('{{ $listType1RangeVar }}')">=</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $type1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                <div class="card-header p-0 mb-2 my-0">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body mt-0">
                                    <div class="{{ $type1['FormVars']['Display']['SelectPopup'] }} flex-column mb-2">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['SelectPopup'] }}</label>
                                        <select class="rounded w-100" id="select-popup-select">
                                            @foreach ($type1['SelectPopupOptions'] as $popupOption)
                                                <option value="{{ $popupOption['Caption'] }}" data-component="{{ $popupOption['ModalClassName'] }}"
                                                        data-type="{{ $popupOption['ParameterType'] }}">
                                                    {{ $popupOption['Caption'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="{{ $type1['FormVars']['Display']['MultiPopup'] }} flex-column mb-2">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['MultiPopup'] }}</label>
                                        <select class="rounded w-100" id="multi-popup-select" onchange="show_multi_popup(this)">
                                            <option value=""></option>
                                            @foreach ($type1['MultiPopupOptions'] as $key => $popupOption)
                                                <option value="{{ $key }}" data-component="{{ $popupOption['ModalClassName'] }}">
                                                    {{ $popupOption['Caption'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="align-items-center mb-2 {{ $type1['FormVars']['Display']['AddTotalLine'] }}">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-add-total-line-check"> <label class="mb-0" for="is-add-total-line-check">{{ $type1['FormVars']['Title']['AddTotalLine'] }}</label>
                                    </div>
                                    <div class="align-items-center mb-2 d-none">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-excel-column-check"> <label class="mb-0" for="is-excel-column-check"></label>
                                    </div>
                                    <div class="align-items-center mb-2 {{ $type1['FormVars']['Display']['DownloadList'] }}">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-download-list-check"> <label class="mb-0" for="is-download-list-check">{{ $type1['FormVars']['Title']['DownloadList'] }}</label>
                                    </div>
                                    <div class="align-items-center mb-2  {{  $type1['FormVars']['Display']['ShowOnlyClosed'] }}">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-show-only-closed-check"> <label class="mb-0" for="is-show-only-closed-check">{{ $type1['FormVars']['Title']['ShowOnlyClosed'] }}</label>
                                    </div>

                                    <div class="{{ $type1['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['FilterOption'] }}</label>
                                        <div class="row">
                                            <div class="col-5 pr-1">
                                                <select class="rounded w-100" id="filter-name-select" onchange="chagne_filter_name_select(this)">
                                                    @foreach ($type1['FilterSelectOptions'] as $key => $popupOption)
                                                        <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                            {{ $popupOption['Caption'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col pl-0">
                                                <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="override_enter_pressed_auto_search(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="{{ $type1['FormVars']['Display']['SimpleOption'] }} flex-column">
                                        <label class="m-0">{{ $type1['FormVars']['Title']['SimpleOption'] }}</label>
                                        <select class="rounded w-100" id="simple-filter-select" onchange="filter_type1_list()">
                                            @foreach ($type1['SimpleSelectOptions'] as $key => $popupOption)
                                                <option value="{{ $popupOption['Value'] }}">
                                                    {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 mt-2 mx-2" id="modal-type1">
                    <div class="table-responsive mt-2" style="height: {{ $type1['DisplayVars']['BodyHeight'] }}px">
                        <table class="table table-row type1-table">
                            <thead id="type1-table-head">
                            @include('front.dabory.erp.partial.make-thead', [
                                'listVars' => $type1['ListVars'],
                                'checkboxName' => 'bd-cud-check'
                            ])
                            </thead>
                            <tbody id="type1-table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                        <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="type1">
                            @include('front.outline.moption')
                        </select>
                        <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                            <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                            <select class="modal-order-by-select w-100 rounded" id="order-by-select" data-target="type1">
                                @foreach ($type1['OrderByOptions'] as $option)
                                    <option value="{{ $option['Value']}}">{{ $option['Caption']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="{{ $type1['FormVars']['Display']['Balance'] }} align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-3">
                            <label class="text-md-center text-nowrap m-0">
                                {{ $type1['FormVars']['Title']['Balance'] }}
                            </label>
                            <select class="rounded w-100 balance-select ml-0 ml-md-1">
                                @foreach ($type1['BalanceOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <ul class="pagination pagination-sm"></ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@foreach ($type1['HeadSelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.multi-popup', [
                'popupOption' => $popupOption
            ])
        @endpush
    @endif
@endforeach

@foreach ($type1['SelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $type1['General']['PageApi']
            ])
        @endpush
    @endif
@endforeach

@foreach ($type1['MultiPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.multi-popup', [
                'popupOption' => $popupOption
            ])
        @endpush
    @endif
@endforeach

@foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $i)
    @if ($type1['FormVars']['Display'][$i] != 'd-none')
        @push('modal')
            @include($type1['ListType1RangeVars']['BladeRoute'][$i], [
                'moealSetFile' => $type1['ListType1RangeVars']['Parameter'][$i]
            ])
        @endpush
    @endif
@endforeach

@push('modal')
    @include('front.outline.static.uploaders')
@endpush

@section('js')
    <script src="{{ csset('/js/modals-controller/list-type1/common.js') }}"></script>
    <script>
        window.onload = function () {
            if (isEmpty(type1['FormVars']['Hidden']['DateRange'])) {
                first_date_rang('.type1-date-range-div')
            }
            if (isEmpty(type1['FormVars']['Hidden']['DateNavi'])) {
                first_date_rang('.type1-date-navi-div')
            }

            $('input:radio[name=type1-date-range]').on('click', function () {
                calc_date_rang('.type1-date-range-div', $(this).val(), 0)
            });

            $('input:radio[name=type1-date-navi]').on('click', function () {
                calc_date_rang('.type1-date-navi-div', $(this).val(), 0)
            });

            // console.log(window.CodeTitle)
            make_dynamic_table_css('.type1-table', make_dynamic_table_px(type1['ListVars']['Size']))

            init_display_vars()

            reset_list_type1_range_vars_txt()

            $('.type1-act').on('click', function () {
                if ($(this).data('component')) {
                    show_head_select_popup(this)
                    return;
                }

                switch( $(this).data('value') ) {
                    case 'new': type1_new(); break;
                    case 'list': type1_list(); break;
                    case 'multi-delete': type1_multi_delete(); break;
                    case 'clear-all-filter': type1_clear_all_filter(); break;
                    case 'xls-report': type1_report('excel'); break;
                    case 'pdf-report': type1_report('pdf'); break;
                    case 'rpt-print': rpt_print(); break;
                    case 'rpt-custom': rpt_custom(); break;
                    case 'excel-upload': $('#modal-uploaders').modal('show'); break;
                    case 'view-chart': view_chart(); break;

                    default: type1_multi_for($(this).data('value')); break;
                }
            });

            $(document).on('list.requery', '#modal-select-popup, #modal-multi-popup', function (event) {
                type1_list()
            });

            $(document).on('hide.bs.modal', '#modal-multi-popup', function () {
                $('#multi-popup-select').val('')
            });

            $(document).on('list.token.init', '#modal-multi-popup', function (event) {
                $('.type1').find('#list-token').val('')
                type1_list()
            });

            $(document).on('excel.upload', '#modal-uploaders', function (event, rows, delete_num) {
                type1_excel_upload(_.first(rows), delete_num)
                $('#modal-uploaders').modal('hide')
            });

            $(document).on('list.token.update', '#form-select', function (event, token) {
                set_list_token(token)
            });

            // activate_button_group({save_spinner_btn: '#type1-save-spinner-btn', btn_group: '#type1-btn-group'})
        }

        async function view_chart() {
            const modal_class_name = $('#chart-popup-select option:selected').data('component');
            const unique = $('#chart-popup-select option:selected').data('unique');
            const i = $('#chart-popup-select').val()
            if (isEmpty(i) || isEmpty(modal_class_name)) {
                $('#chart-popup-select').val('')
                iziToast.error({  title: 'Error', message: @json(_e('Action failed')) });
                return;
            }

            const name_space = capitalize(camelCase(modal_class_name));
            $(`#modal-chart-popup.${modal_class_name}.${unique}`).addClass('in')

            const type_para = get_type1_parameter(1000000000000000, 0)
            type_para['ListType1Vars']['ListFilterValue'] = $('.type1').find('#filter-value-txt').val()
            await eval(name_space).show_popup_callback(type1['ChartPopupOptions'][i]['Parameter'], type_para)

            console.log(`#modal-chart-popup.${modal_class_name}.${unique}`);
            const date_range = `: ${moment(new Date($('#type1-start-date').val())).format('YYYY.MM.DD')} - ${moment(new Date($('#type1-end-date').val())).format('YYYY.MM.DD')}`;
            $(`#modal-chart-popup.${modal_class_name}.${unique}`).find('.modal-title').text(type1['ChartPopupOptions'][i]['Caption'] + date_range)
            $(`#modal-chart-popup.${modal_class_name}.${unique}`).modal('show')
        }

        function change_type1_start_date(self) {
            $('.type1-date-navi-div').data('current_date', $(self).val())
            $('.type1-date-range-div').data('current_date', $(self).val())
        }

        function first_date_rang(div_dom, first_date_search = true, requery = false) {
            let date_input = $(div_dom).find('div').find('input:checked')
            $(div_dom).data('current_date', moment(new Date()).format('YYYY-MM-DD'))

            if (first_date_search) {
                date_input = $(div_dom).find('div').first().find('input')
                date_input.prop('checked', true)
            }

            calc_date_rang(div_dom, date_input.val(), 0, true, requery)
        }

        function verify_list_type1_range_vars_txt() {
            const list_type1_range_vars = ['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange']
            let result = false

            list_type1_range_vars.forEach(i => {
                if ($('.type1').find(`#From${i}`).val() && isEmpty($('.type1').find(`#To${i}`).val())) {
                    result = true
                    return true
                }
            });

            return result
        }

        function calc_date_rang(div_dom, date_val, mode, first = false, requery = true) {
            if (mode === 0) {
                if (! first) {
                    $(div_dom).data('current_date', $('#type1-start-date').val())
                }
            }

            let firDay, lasDay, currDay;
            [firDay, lasDay, currDay] = date_range_vending_machine(date_val, $(div_dom).data('current_date'), mode);

            $('#type1-start-date').val(date_to_sting(firDay))
            $('#type1-end-date').val(date_to_sting(lasDay))
            $(div_dom).data('current_date', date_to_sting(currDay))

            if (requery) {
                type1_list()
            }
        }

        function rpt_custom() {
            ModalRptCustom.show_popup_callback(type1['PrintVars']['CustomCode'], 'type1', get_type1_parameter(1000000000000000, 0)['ListType1Vars'])
            $('#modal-rpt-custom').modal('show')
        }

        function rpt_print() {
            show_recrystallize_server(type1['PrintVars'], 'type1', get_type1_parameter(1000000000000000, 0)['ListType1Vars'])
        }

        function set_list_token(token) {
            $('.type1').find('#list-token').val(token)
            $('.type1').find('#is-download-list-check').prop('checked', true)
            type1_list()
        }

        function chagne_filter_name_select($this) {
            $('.type1').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
        }

        function filter_type1_list() {
            type1_open($('#modal-type1').data('limit'), 0, 1)
        }

        function override_enter_pressed_auto_search(event) {
            window.enter_pressed_auto_search(event, function () {
                $('.type1').find('#filter-value-txt').data('value', $(event.target).val())

                if ($('.type1').find('#filter-name-select option:selected').data('reverse')) {
                    const value = format_conver_for($(event.target).val(), $('.type1').find('#filter-name-select option:selected').data('reverse'))

                    $('.type1').find('#filter-value-txt').data('value', value)
                }
                filter_type1_list()
            })
        }

        async function convert_to_multi_delete_data(table_id) {
            let data = [];
            let response = await get_api_data(type1['General']['PageApi'], get_type1_parameter($('#modal-type1').data('limit'), $('#modal-type1').data('offset')), MainAppName);
            let page = response.data.Page;

            $(table_id).find(`input[name='bd-cud-check']`).each(function(index) {
                if ($(this).is(':checked')) {
                    if (page[index].Id == 0) return true;
                    data.push({ Id: parseInt(`-${page[index].Id}`) });
                }
            })

            if (data.length == 0) {
                iziToast.error({
                    title: 'Error',
                    message: $('#click-the-checkbox-es-of-line-for-action').text(),
                });
                return false;
            }

            return data;
        }

        function type1_multi_delete() {
            confirm_message_shw_and_delete(async function() {
                const data = await convert_to_multi_delete_data('.type1-table')
                if (! data) return;

                let response = await get_api_data(type1['General']['ActApi'], { Page: data }, MainAppName);
                if (response.data.Page) {
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                    type1_list()
                } else {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text();
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                }
            })
        }

        async function type1_multi_for(format) {
            const data = await convert_to_multi_delete_data('.type1-table')
            const table = format_conver_for(null, format)

            if (! data) return;
            const update_data = data.map(function (obj) {
                let result = { Id: Math.abs(obj.Id), UpdatedOn: get_now_time_stamp() }
                result[table['Field']] = table['Value'];
                return result
            });

            let response = await get_api_data(type1['General']['ActApi'], { Page: update_data }, MainAppName)
            if (response.data.Page) {
                if (table['Field'] === 'Status' && table['Value'] === '1') {
                    const sorder_to_credit_reward = await get_api_data('sorder-to-credit-reward', { Page: update_data }, MainAppName)
                    // console.log(sorder_to_credit_reward)
                }

                iziToast.success({
                    title: 'Success', message: $('#action-completed').text(),
                });
                type1_list()
            } else {
                let message = response.data.body ?? $('#api-request-failed-please-check').text()
                iziToast.error({
                    title: 'Error', message: message,
                });
            }
        }

        async function type1_excel_upload(rows, delete_num) {
            let list_vars = [
                'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9', 'C10',
                'C11', 'C12', 'C13', 'C14', 'C15', 'C16', 'C17', 'C18', 'C19', 'C20',
                'C21', 'C22', 'C23', 'C24', 'C25', 'C26', 'C27', 'C28', 'C29', 'C30'
            ];
            if ($('.type1').find('#is-excel-column-check').prop('checked')) {
                list_vars = rows[0].map(head => {
                    return head.split(':')[0]
                })
                // console.log(list_vars)
            }
            let parameter_page = [];
            // rows.forEach(row => {
            //     parameter_page.push( _.object( list_vars, row.map(data => isEmpty(data) ? '' : String(data)) ) );
            // });

            rows.forEach(row => {
                parameter_page.push( _.object( list_vars, row.map(data => isEmpty(data) ? '' : String(data)) ) );
            });

            parameter_page = parameter_page.map(obj => JSON.parse( JSON.stringify(obj) ))
                .slice(Number(delete_num))

            parameter_page = parameter_page.filter((obj) => !are_all_fields_empty(obj));

            let parameter = { Page: parameter_page, ...get_type1_parameter(0, 0) }

            $('#pace-progress-panel').attr('hidden', false)
            const response = await get_api_data(type1['General']['ActApi'], parameter, MainAppName)
            $('#pace-progress-panel').attr('hidden', true)
            // console.log(response)

            if (isEmpty(response.data.apiStatus)) {
                iziToast.success({ title: 'Success', message: '임시 테이블에 데이터 저장 성공' });
            } else {
                iziToast.error({ title: 'Error', message: response.data.body ?? $('#api-request-failed-please-check').text() });
            }

            set_list_token(response.data['ListToken'])
        }

        function are_all_fields_empty(obj) {
            for (let key in obj) {
                if (obj[key] !== '') {
                    return false;
                }
            }
            return true;
        }

        function type1_list() {
            let admission = moment(new Date($('#type1-start-date').val()));
            let discharge = moment(new Date($('#type1-end-date').val()));

            if (discharge.diff(admission, 'days') > type1['DisplayVars']['DateRangeLimit']) {
                return iziToast.error({
                    title: 'Error', message: $('#api-request-failed-please-check').text(),
                })
            }

            if (verify_list_type1_range_vars_txt()) {
                return iziToast.error({
                    title: 'Error', message: '범위 지정이 누락되었습니다.',
                })
            }

            if (! type1['DisplayVars']['IsKibana'] ||
                (type1['DisplayVars']['IsKibana'] && ! type1['DisplayVars']['IsHideBody'])) {
                type1_open(
                    $('#modal-type1').data('limit'),
                    $('#modal-type1').data('offset'),
                    $('#modal-type1').data('page')
                );
            }

        }

        async function type1_report(type) {
            const response = await get_api_data(type1['General']['PageApi'], get_type1_parameter(1000000000000000, 0), MainAppName)
            let d = response.data;

            let head = Type1.convert_data_to_report_head(type1['ListVars']['Title'])
            if ($('.type1').find('#is-excel-column-check').prop('checked')) {
                head = Type1.convert_data_to_report_head(Type1.set_excel_column_data(type1)['Title'])
            }
            let body = Type1.convert_data_to_report_body(d.Page, d.PageVars.QueryCnt, type1['ListVars'], type1['DisplayVars']['IsRawDownload'])

            if (type === 'excel' && head.find(title => title === '번호')) {
                head = head.filter(title => title !== '번호')
                body = body.map(col => col.slice(1))
            }

            const split_query_name = type1['QueryVars']['QueryName'].split('/')
            const file_name = split_query_name[split_query_name.length - 1]

            const report = {
                head: head,
                body: body,
                title: `${capitalize(camelCase(file_name))}-${moment(new Date()).format('MMDD')}-${moment(new Date()).format('HHmm')}`,
                size: make_dynamic_table_px(type1['ListVars']['Size']) * 12,
                type: type,
            }

            Type1.download_report('.type1 #frm', report)
        }

        async function make_simple_select_page() {
            const response = await get_api_data('simple-join-page', type1['SimpleSelectPage'], MainAppName)
            if (response.data.Page) {
                $('#simple-filter-select').append(create_options([{ Value: '', Caption: '전체' }, ...response.data.Page]))
            }

        }

        function init_display_vars() {
            $('#modal-select-popup .modal-body button').addClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
            $('#modal-select-popup .modal-body thead th').addClass('bg-grey-700')

            $('#modal-multi-popup .modal-body button').addClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

            chagne_filter_name_select($('.type1').find('#filter-name-select'))

            $('.type1').find('#is-add-total-line-check').prop('checked', type1['DisplayVars']['IsAddTotalLine'])
            $('.type1').find('#is-download-list-check').prop('checked', type1['DisplayVars']['IsDownloadList'])
            $('.type1').find('#is-show-only-closed-check').prop('checked', type1['DisplayVars']['IsShowOnlyClosed'])
            if (type1['DisplayVars']['IsExcelColumn']) {
                $('.type1').find('#is-excel-column-check').prop('checked', type1['DisplayVars']['IsExcelColumn'])
                Type1.set_excel_column(type1, '.type1 #is-excel-column-check', '#modal-type1 #type1-table-head')
            }

            if (type1['DisplayVars']['IsSimpleSelectPage']) {
                make_simple_select_page()
            }

            $(`input:radio[name='type1-date-navi']:radio[value=${type1['DisplayVars']['InitDateRange']}]`).trigger('click')

            $('#modal-type1').find('.modal-line-select').val(type1['DisplayVars']['InitLines'])
            $('#modal-type1').data('limit', type1['DisplayVars']['InitLines'])
            if (type1['DisplayVars']['IsListFirst']) {
                type1_list()
            } else {
                activate_button_group({save_spinner_btn: '#type1-save-spinner-btn', btn_group: '#type1-btn-group'})
            }
        }

        function type1_new() {
            const modal_class_name = $('#select-popup-select option:selected').data('component');
            eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()
            $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        function reset_list_type1_range_vars_txt() {
            let list_type1_range_vars = ['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'];

            list_type1_range_vars.forEach(i => {
                $('.type1').find(`#From${i}`).val('');
                $('.type1').find(`#To${i}`).val('');
            });
        }

        function type1_clear_all_filter() {
            input_box_reset_for('#frm')
            input_box_reset_for('#modal-type1')
            init_display_vars()

            $('#type1-start-date').val('1990-01-01')
            $('#type1-end-date').val('3000-12-31')
            $("input:radio[name=type1-date-range]:input[value='all']").prop('checked', true);

            reset_list_type1_range_vars_txt();

            // table body 초기화
            make_pagination('type1', 1, 1 );
            $('#modal-type1').find('.modal-line-select').val(type1['DisplayVars']['InitLines'])
            $('#modal-type1').data('limit', type1['DisplayVars']['InitLines']),
                $('#modal-type1').data('offset', 0),
                $('#modal-type1').data('page', 1),
                $('#type1-table-body').html('');
        }

        function c1_popup_conver_for(id, c1) {
            let result;
            switch (type1.DisplayVars.IsC1Popup) {
                case '1':
                case '2':
                    result = `
                    <a href="javascript:;" onclick="show_select_popup('${id}', '${format_conver_for(c1, 'unique')}')">
                        ${format_conver_for(c1, type1.ListVars['Format'].C1)}
                    </a>`;
                    break;
                default:
                    result = format_conver_for(c1, type1.ListVars['Format'].C1)
                    break;
            }

            return result;
        }

        function type1_open(limit = 10, offset = 0, page = 1) {
            let html = [];
            $('#modal-type1').data('limit', limit);
            $('#modal-type1').data('offset', offset);
            $('#modal-type1').data('page', page);

            document.getElementById('type1-table-body').innerHTML =  `<tr><td class="text-center" colspan="${type1.ListVars['Count']}">검색 중...</td></tr>` ;

            deactivate_button_group({save_spinner_btn: '#type1-save-spinner-btn', btn_group: '#type1-btn-group'})

            $.when(get_api_data(type1['General']['PageApi'], get_type1_parameter(limit, offset), MainAppName)).done(function(response) {
                let d = response.data
                console.log(d)
                if ( d.Page ) {
                    make_pagination('type1', d.PageVars.QueryCnt, page);
                    let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                    for (let i in d.Page) {
                        html.push (
                            `<tr>
                            <td class="text-${type1.ListVars['Align'].$Radio} px-import-0" ${type1.ListVars['Hidden'].$Radio}>
                                <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                                class="text-${type1.ListVars['Align'].$Radio}"
                                onclick="show_select_popup('${d.Page[i].Id}', '${format_conver_for(d.Page[i].C1, 'unique')}')">
                            </td>
                            <td class="text-${type1.ListVars['Align'].$Check} px-import-0" ${type1.ListVars['Hidden'].$Check}>
                                <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                                class="text-${type1.ListVars['Align'].$Check}">
                            </td>
                            <td
                                class="text-${type1.ListVars['Align'].No}" ${type1.ListVars['Hidden'].No}>${no--}
                            </td>
                            <td
                                class="text-${type1.ListVars['Align'].C1}" ${type1.ListVars['Hidden'].C1}>${c1_popup_conver_for(d.Page[i].Id, d.Page[i].C1)}
                            </td>
                       `)
                        for (const key in type1.ListVars['Title']) {
                            if (key === '$Radio' || key === '$Check' || key === 'No' ||
                                key === 'C1') { continue }
                            html.push ( `
                            <td
                                class="text-${type1.ListVars['Align'][key]}" ${type1.ListVars['Hidden'][key]}>${format_conver_for(d.Page[i][key], type1.ListVars['Format'][key], type1['ThumbContainerVars'])}
                            </td>` )
                        }
                        html.push ( `</tr>` )
                    }
                } else {
                    if (! isEmpty(d.apiStatus)) {
                        switch (d.apiStatus) {
                            case 607:
                                html.push( `<tr><td class="text-center" colspan="${type1.ListVars['Count']}">Query Error</td></tr>` );
                                break;
                            default:
                                break;
                        }
                    } else {
                        html.push(`<tr><td class="text-center" colspan="${type1.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` );
                    }
                    make_pagination('type1', 1, 1 );
                }

                activate_button_group({save_spinner_btn: '#type1-save-spinner-btn', btn_group: '#type1-btn-group'})

                document.getElementById('type1-table-body').innerHTML = html.join('');
                // $('#type1-table-body').html(html);
            })
        }

        function get_type1_parameter(limit, offset) {
            let start_date = '19900101', end_date = '30001231'

            if (isEmpty(type1['FormVars']['Hidden']['DateRange']) || isEmpty(type1['FormVars']['Hidden']['DateNavi'])) {
                start_date = moment(new Date($('.type1').find('#type1-start-date').val())).format('YYYYMMDD')
                end_date = moment(new Date($('.type1').find('#type1-end-date').val())).format('YYYYMMDD')
            }

            let parameter = {
                QueryVars: {
                    QueryName: type1['QueryVars']['QueryName'],
                    FilterName: type1['QueryVars']['FilterName'],
                    FilterValue: type1['QueryVars']['FilterValue'],
                    SimpleFilter: type1['QueryVars']['SimpleFilter'],
                    SubSimpleFilter: type1['QueryVars']['SubSimpleFilter'],
                    // TestMode: "query"
                },
                ListType1Vars: {
                    ListToken: $('.type1').find('#list-token').val(),

                    FilterDate: type1['QueryVars']['FilterDate'],
                    StartDate: start_date,
                    EndDate: end_date,

                    FilterFirst: type1['ListType1RangeVars']['Filter']['FirstRange'],
                    StartFirst: $('.type1').find('#FromFirstRange').val(),
                    EndFirst: $('.type1').find('#ToFirstRange').val(),

                    FilterSecond: type1['ListType1RangeVars']['Filter']['SecondRange'],
                    StartSecond: $('.type1').find('#FromSecondRange').val(),
                    EndSecond: $('.type1').find('#ToSecondRange').val(),

                    FilterThird: type1['ListType1RangeVars']['Filter']['ThirdRange'],
                    StartThird: $('.type1').find('#FromThirdRange').val(),
                    EndThird: $('.type1').find('#ToThirdRange').val(),

                    FilterFourth: type1['ListType1RangeVars']['Filter']['FourthRange'],
                    StartFourth: $('.type1').find('#FromFourthRange').val(),
                    EndFourth: $('.type1').find('#ToFourthRange').val(),

                    IsAddTotalLine: $('.type1').find('#is-add-total-line-check:checked').val() == '1',
                    IsExcelColumn: $('.type1').find('#is-excel-column-check:checked').val() == '1',
                    IsDownloadList: $('.type1').find('#is-download-list-check:checked').val() == '1',
                    IsShowOnlyClosed: $('.type1').find('#is-show-only-closed-check:checked').val() == '1',

                    Balance: $('.type1').find('.balance-select').val(),

                    OrderBy: $('.type1').find('#order-by-select').val(),

                    ListFilterName: $('.type1').find('#filter-name-select').val(),
                    ListFilterValue: $('.type1').find('#filter-value-txt').data('value'),
                    ListSimpleFilter: $('.type1').find('#simple-filter-select').val(),
                },
                PageVars: {
                    Limit: Number(limit),
                    Offset: Number(offset),
                }
            }

            // console.log(parameter)
            return parameter;
        }

        async function show_select_popup(id, c1) {
            if (c1.toLowerCase() == 'total') return;

            let modal_class_name = $('#select-popup-select option:selected').data('component');
            let parameter_type = $('#select-popup-select option:selected').data('type');
            let unique = $('#select-popup-select option:selected').data('unique');
            if (isEmpty(modal_class_name)) return;

            // console.log(modal_class_name)
            // console.log(unique)
            // console.log(capitalize(camelCase(modal_class_name)))
            await eval(capitalize(camelCase(modal_class_name))).show_popup_callback(id, c1, {
                    start_date: $('#type1-start-date').val(),
                    end_date: $('#type1-end-date').val(),
                    range_val: $('input:radio[name=type1-date-range]:checked').val()
                }
            )

            // hide => 업데이트 유무
            // if (parameter_type != 'list1') {
            //     $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
            // } else {
            //     $(`#modal-select-popup.${modal_class_name}`).removeClass('list-update')
            // }

            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        async function show_head_select_popup($this) {
            const popup_option = _.first(type1['HeadSelectPopupOptions'].filter(popupOption => popupOption['ParameterName'] == $($this).data('parameter')))
            const name_space = capitalize(camelCase(popup_option['Component']));

            await eval(name_space).show_popup_callback(get_type1_parameter(1000000000000000, 0), popup_option['Parameter'], $('#type1-table-body > tr').length)
            $(`#modal-multi-popup.${popup_option['ModalClassName']}`).modal('show')
        }

        async function show_multi_popup($this) {
            let modal_class_name = $('#multi-popup-select option:selected').data('component');
            if (isEmpty($($this).val()) || isEmpty(modal_class_name)) {
                $('#multi-popup-select').val('')
                iziToast.error({  title: 'Error', message: @json(_e('Action failed')) });
                return;
            }

            let name_space = capitalize(camelCase(modal_class_name));
            await eval(name_space).show_popup_callback(get_type1_parameter(1000000000000000, 0))

            let date_range = `: ${moment(new Date($('#type1-start-date').val())).format('YYYY.MM.DD')} - ${moment(new Date($('#type1-end-date').val())).format('YYYY.MM.DD')}`;
            $(`#modal-multi-popup.${modal_class_name}`).find('.modal-title').text(type1['MultiPopupOptions'][$($this).val()]['Caption'] + date_range)
            $(`#modal-multi-popup.${modal_class_name}`).modal('show')
        }

        function same_as_form_and_scope(list_type1_range_var) {
            let from_val = $(`#From${list_type1_range_var}`).val()
            $(`#To${list_type1_range_var}`).val(from_val)
        }

        function get_from_first_range_data(id) {
            $('#FromFirstRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['FirstRange']}`).modal('hide');
        }

        function get_to_first_range_data(id) {
            $('#ToFirstRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['FirstRange']}`).modal('hide');
        }

        function get_from_second_range_data(id) {
            $('#FromSecondRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['SecondRange']}`).modal('hide');
        }

        function get_to_second_range_data(id) {
            $('#ToSecondRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['SecondRange']}`).modal('hide');
        }

        function get_from_third_range_data(id) {
            $('#FromThirdRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['ThirdRange']}`).modal('hide');
        }

        function get_to_third_range_data(id) {
            $('#ToThirdRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['ThirdRange']}`).modal('hide');
        }

        function get_from_fourth_range_data(id) {
            $('#FromFourthRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['FourthRange']}`).modal('hide');
        }

        function get_to_fourth_range_data(id) {
            $('#ToFourthRange').val(id)
            $(`#modal-${type1['ListType1RangeVars']['Component']['FourthRange']}`).modal('hide');
        }

        function show_modal(list_type1_range_var, type) {
            let func_name = `Get${type}${list_type1_range_var}Data`;

            $('.modal-btn').data('filter', type1['ListType1RangeVars']['Filter'][list_type1_range_var])
            $('.modal-btn').data('target', snakeCase(type1['ListType1RangeVars']['Component'][list_type1_range_var]))
            $('.modal-btn').data('variable', type1['ListType1RangeVars']['Parameter'][list_type1_range_var])
            $('.modal-btn').data('clicked', snakeCase(func_name))
            $('.modal-btn').trigger('click')
        }

        const type1 = {!! json_encode($type1) !!};
    </script>
@endsection
