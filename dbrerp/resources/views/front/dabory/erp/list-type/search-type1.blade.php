{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="search-type1-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden id="search-type1-btn-group">
        <button type="button" class="btn btn-sm btn-primary search-type1-act" data-value="list" {{ $searchType1['FormVars']['Hidden']['ListButton'] }}>
            {{ $searchType1['FormVars']['Title']['ListButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $searchType1['HeadSelectOptions'],
            'eventClassName' => 'search-type1-act',
        ])
    </div>
</div>

<div id="search-type1-form">
    <button type="button" hidden
        class="btn btn-success btn-open-modal modal-btn">
    </button>

    <div class="card">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-md-4 card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $searchType1['DisplayVars']['HeadHeight'] }}px">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="{{ $searchType1['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['DateRange'] }}</label>
                                <div class="d-flex align-items-center" style="height: 28px;">
                                    @foreach ($searchType1['DateRangeOptions'] as $key => $option)
                                        <input  autocomplete="off" name="search-type1-date-range" type="radio" value="{{ $option['Value'] }}" id="{{ 'search-type1-date-range-'.($key+1) }}"
                                        {{ $option['Value'] == 'all' ? 'checked' : ''}}>
                                        <label for="{{ 'search-type1-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="{{ $searchType1['FormVars']['Display']['Date'] }} flex-column mb-2">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['Date'] }}</label>
                                <div class="d-flex">
                                    <input class="rounded overflow-hidden w-100 text-nowrap" id="search-type1-start-date" type="date" value="1990-01-01">
                                    <label class="btn disabled p-1 text-center">~</label>
                                    <input class="rounded overflow-hidden w-100 text-nowrap" id="search-type1-end-date" type="date" value="3000-12-31">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $searchType1['DisplayVars']['HeadHeight'] }}px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            @foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $listType1RangeVar)
                                <div class="{{ $searchType1['FormVars']['Display'][$listType1RangeVar] }} flex-column mb-2">
                                    <label class="m-0">{{ $searchType1['FormVars']['Title'][$listType1RangeVar] }}</label>
                                    <div class="d-flex">
                                        <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                            type="text" value="" id="From{{ $listType1RangeVar }}">&nbsp;
                                        <button type="button" onclick="ListTypeSearchType1.show_modal('{{ $listType1RangeVar }}', 'From')"
                                            class="btn-dark rounded border-0
                                                overflow-hidden w-100 text-nowrap" style="height: 28px">
                                            {{ $searchType1['FormVars']['Title']['From'] }}
                                        </button>&nbsp;
                                        <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                            type="text" value="" id="To{{ $listType1RangeVar }}">&nbsp;
                                        <button type="button" onclick="ListTypeSearchType1.show_modal('{{ $listType1RangeVar }}', 'To')"
                                            class="btn-dark rounded border-0
                                                overflow-hidden w-100 text-nowrap" style="height: 28px">
                                            {{ $searchType1['FormVars']['Title']['To'] }}
                                        </button>&nbsp;
                                        <button class="btn-dark rounded border-0
                                            overflow-hidden w-100 text-nowrap col-1" style="height: 28px"
                                            onclick="ListTypeSearchType1.same_as_form_and_scope('{{ $listType1RangeVar }}')">=</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $searchType1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="{{ $searchType1['FormVars']['Display']['SelectPopup'] }} flex-column mb-2">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['SelectPopup'] }}</label>
                                <select class="rounded w-100" id="select-popup-select">
                                    @foreach ($searchType1['SelectPopupOptions'] as $popupOption)
                                        <option value="{{ $popupOption['Caption'] }}" data-component="{{ $popupOption['ModalClassName'] }}"
                                            data-type="{{ $popupOption['ParameterType'] }}">
                                            {{ $popupOption['Caption'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="{{ $searchType1['FormVars']['Display']['MultiPopup'] }} flex-column mb-2">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['MultiPopup'] }}</label>
                                <select class="rounded w-100" id="multi-popup-select" onchange="ListTypeSearchType1.show_multi_popup(this)">
                                    <option value=""></option>
                                    @foreach ($searchType1['MultiPopupOptions'] as $key => $popupOption)
                                        <option value="{{ $key }}" data-component="{{ $popupOption['ModalClassName'] }}">
                                            {{ $popupOption['Caption'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="align-items-center mb-2 {{ $searchType1['FormVars']['Display']['AddTotalLine'] }}">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-add-total-line-check"> <label class="mb-0" for="is-add-total-line-check">{{ $searchType1['FormVars']['Title']['AddTotalLine'] }}</label>
                            </div>
                            <div class="align-items-center mb-2 d-none">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-excel-column-check"> <label class="mb-0" for="is-excel-column-check"></label>
                            </div>
                            <div class="align-items-center mb-2 {{ $searchType1['FormVars']['Display']['DownloadList'] }}">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-download-list-check"> <label class="mb-0" for="is-download-list-check">{{ $searchType1['FormVars']['Title']['DownloadList'] }}</label>
                            </div>
                            <div class="align-items-center mb-2  {{  $searchType1['FormVars']['Display']['ShowOnlyClosed'] }}">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-show-only-closed-check"> <label class="mb-0" for="is-show-only-closed-check">{{ $searchType1['FormVars']['Title']['ShowOnlyClosed'] }}</label>
                            </div>

                            <div class="{{ $searchType1['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['FilterOption'] }}</label>
                                <div class="row">
                                    <div class="col-5 pr-1">
                                        <select class="rounded w-100" id="filter-name-select" onchange="ListTypeSearchType1.chagne_filter_name_select(this)">
                                            @foreach ($searchType1['FilterSelectOptions'] as $key => $popupOption)
                                                <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                    {{ $popupOption['Caption'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0">
                                        <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="ListTypeSearchType1.override_enter_pressed_auto_search(event)">
                                    </div>
                                </div>
                            </div>

                            <div class="{{ $searchType1['FormVars']['Display']['SimpleOption'] }} flex-column">
                                <label class="m-0">{{ $searchType1['FormVars']['Title']['SimpleOption'] }}</label>
                                <select class="modal-order-by-select rounded w-100" id="simple-filter-select" data-target="ListTypeSearchType1.searchType1">
                                    @foreach ($searchType1['SimpleSelectOptions'] as $key => $popupOption)
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

        <div class="card-body p-0 mt-2 mx-2 searchType1" id="modal-ListTypeSearchType1">
            <div class="table-responsive mt-2" style="height: {{ $searchType1['DisplayVars']['BodyHeight'] }}px">
                <table class="table-row search-type1-table">
                    <thead id="search-type1-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $searchType1['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                    </thead>
                    <tbody id="search-type1-table-body">
                    </tbody>
                </table>
            </div>
            <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="ListTypeSearchType1.searchType1">
                    @include('front.outline.moption')
                </select>
                <div class="{{ $searchType1['FormVars']['Display']['OrderBy'] }} mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                    <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                    <select class="modal-order-by-select w-100 rounded" id="order-by-select" data-target="ListTypeSearchType1.searchType1">
                        @foreach ($searchType1['OrderByOptions'] as $option)
                            <option value="{{ $option['Value']}}">{{ $option['Caption']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="{{ $searchType1['FormVars']['Display']['Balance'] }} align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-3">
                    <label class="text-md-center text-nowrap m-0">
                        {{ $searchType1['FormVars']['Title']['Balance'] }}
                    </label>
                    <select class="rounded w-100 balance-select ml-0 ml-md-1">
                        @foreach ($searchType1['BalanceOptions'] as $option)
                            <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                        @endforeach
                    </select>
                </div>
                <ul class="pagination pagination-sm"></ul>
            </div>

        </div>

    </div>


</div>

{{-- @endsection --}}

@foreach ($searchType1['SelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $searchType1['General']['PageApi']
            ])
        @endpush
    @endif
@endforeach

@foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $i)
    @if ($searchType1['FormVars']['Display'][$i] != 'd-none')
        @push('modal')
            @include($searchType1['ListType1RangeVars']['BladeRoute'][$i], [
                'moealSetFile' => $searchType1['ListType1RangeVars']['Parameter'][$i],
                'modalClassName' => $searchType1['QueryVars']['QueryName']
            ])
        @endpush
    @endif
@endforeach

@once
@push('js')
<script src="/js/modals-controller/list-type1/common.js?{{date('YmdHis')}}"></script>
    <script>
        $(document).ready(async function() {
            make_dynamic_table_css('#search-type1-form .search-type1-table', make_dynamic_table_px(ListTypeSearchType1.para['ListVars']['Size']))

            // ListTypeSearchType1.init_display_vars()

            ListTypeSearchType1.reset_list_type1_range_vars_txt()

            $('input:radio[name=search-type1-date-range]').on('click', function () {
                let firDay, lasDay;
                [firDay, lasDay] = date_range_vending_machine($(this).val());

                $('#search-type1-start-date').val(date_to_sting(firDay))
                $('#search-type1-end-date').val(date_to_sting(lasDay))
            });

            $('.search-type1-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'new': ListTypeSearchType1_search_type1_new(); break;
                    case 'list': ListTypeSearchType1.search_type1_list(); break;
                    case 'multi-delete': ListTypeSearchType1.search_type1_multi_delete(); break;

                    default: ListTypeSearchType1.search_type1_multi_for($(this).data('value')); break;
                }
            });

            $(document).on('hide.bs.modal', `#modal-select-popup.${ListTypeSearchType1.para['General']['PageApi']}`, function () {
                if ($(this).hasClass('list-update')) {
                    ListTypeSearchType1.search_type1_list();
                }
            });

            // activate_button_group({save_spinner_btn: '#search-type1-save-spinner-btn', btn_group: '#search-type1-btn-group'});
        });

        (function( ListTypeSearchType1, $, undefined ) {
            ListTypeSearchType1.para = {!! json_encode($searchType1) !!};
            ListTypeSearchType1.parentParameter = {};

            ListTypeSearchType1_search_type1_new = function () {
                let modal_class_name = $('#search-type1-form').find('#select-popup-select option:selected').data('component');

                eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()
                $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
                $(`#modal-select-popup.${modal_class_name}`).modal('show')
            }

            ListTypeSearchType1.search_type1_multi_delete = function () {
                confirm_message_shw_and_delete(async function() {
                    const data = await ListTypeSearchType1.convert_to_multi_delete_data('#search-type1-form .search-type1-table')
                    if (! data) return;

                    let response = await get_api_data(ListTypeSearchType1.para['General']['ActApi'], { Page: data });
                    if (response.data.Page) {
                        iziToast.success({
                            title: 'Success',
                            message: $('#action-completed').text(),
                        });
                        ListTypeSearchType1.search_type1_list();
                    } else {
                        let message = response.data.body ?? $('#api-request-failed-please-check').text();
                        iziToast.error({
                            title: 'Error',
                            message: message,
                        });
                    }
                })
            }

            ListTypeSearchType1.convert_to_multi_delete_data = async function (table_id) {
                let data = [];
                let response = await get_api_data(ListTypeSearchType1.para['General']['PageApi'], ListTypeSearchType1.get_parameter($('#modal-ListTypeSearchType1').data('limit'), $('#modal-ListTypeSearchType1').data('offset')));
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

            ListTypeSearchType1.search_type1_multi_for = async function (format) {
                const data = await ListTypeSearchType1.convert_to_multi_delete_data('#search-type1-form .search-type1-table')
                const table = format_conver_for(null, format);

                if (! data) return;
                const update_data = data.map(function (obj) {
                    let result = { Id: Math.abs(obj.Id), UpdatedOn: get_now_time_stamp() };
                    result[table['Field']] = table['Value'];
                    return result
                });

                let response = await get_api_data(ListTypeSearchType1.para['General']['ActApi'], { Page: update_data });
                if (response.data.Page) {
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                    ListTypeSearchType1.search_type1_list();
                } else {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text();
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                }
            }

            ListTypeSearchType1.chagne_filter_name_select = function ($this) {
                $('#search-type1-form').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
            }

            ListTypeSearchType1.override_enter_pressed_auto_search = function (event) {
                window.enter_pressed_auto_search(event, function () {
                    $('#search-type1-form').find('#filter-value-txt').data('value', $(event.target).val())

                    if ($('#search-type1-form').find('#filter-name-select option:selected').data('reverse')) {
                        const value = format_conver_for($(event.target).val(), $('#search-type1-form').find('#filter-name-select option:selected').data('reverse'))

                        $('#search-type1-form').find('#filter-value-txt').data('value', value)
                    }
                    ListTypeSearchType1.search_type1_list();
                })
            }

            ListTypeSearchType1.show_popup_callback = function (parameter) {
                input_box_reset_for('#search-type1-form #frm')
                ListTypeSearchType1.parentParameter = parameter
                ListTypeSearchType1.init_display_vars()
            }

            ListTypeSearchType1.reset_list_type1_range_vars_txt = function () {
                let list_type1_range_vars = ['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'];

                list_type1_range_vars.forEach(i => {
                    $('#search-type1-form').find(`#From${i}`).val('');
                    $('#search-type1-form').find(`#To${i}`).val('');
                });
            }

            ListTypeSearchType1.init_display_vars = function () {
                $('#modal-multi-popup .modal-header').removeClass('bg-grey-700')
                $('#modal-multi-popup .modal-header').addClass('bg-blue-600')
                $('#modal-multi-popup .modal-body button').addClass('bg-blue-600 border-blue-600 bg-blue-600-hover')
                $('#modal-multi-popup .modal-body thead th').addClass('bg-blue-600')

                $('#modal-multi-popup .modal-header').removeClass('bg-dark-alpha')
                $('#modal-multi-popup .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

                $('#modal-multi-popup.list-type-search-type1 .modal-dialog').css('maxWidth', `${ListTypeSearchType1.para['PopupList1Vars']['PopupWidth']}px`);

                $('#search-type1-form').find('#is-add-total-line-check').prop('checked', ListTypeSearchType1.para['DisplayVars']['IsAddTotalLine'])
                $('#search-type1-form').find('#is-download-list-check').prop('checked', ListTypeSearchType1.para['DisplayVars']['IsDownloadList'])
                $('#search-type1-form').find('#is-show-only-closed-check').prop('checked', ListTypeSearchType1.para['DisplayVars']['IsShowOnlyClosed'])
                if (ListTypeSearchType1.para['DisplayVars']['IsExcelColumn']) {
                    $('#search-type1-form').find('#is-excel-column-check').prop('checked', ListTypeSearchType1.para['DisplayVars']['IsExcelColumn'])
                    Type1.set_excel_column(ListTypeSearchType1.para, '#search-type1-form #is-excel-column-check', '#modal-ListTypeSearchType1 #search-type1-table-head')
                }

                $('#modal-ListTypeSearchType1').find('.modal-line-select').val(ListTypeSearchType1.para['DisplayVars']['InitLines'])
                $('#modal-ListTypeSearchType1').data('limit', ListTypeSearchType1.para['DisplayVars']['InitLines'])
                if (ListTypeSearchType1.para['DisplayVars']['IsListFirst']) {
                    ListTypeSearchType1.search_type1_list();
                } else {
                    activate_button_group({save_spinner_btn: '#search-type1-save-spinner-btn', btn_group: '#search-type1-btn-group'});
                }
            }

            ListTypeSearchType1.search_type1_list = function () {
                ListTypeSearchType1.searchType1_open(
                    $('#modal-ListTypeSearchType1').data('limit'),
                    $('#modal-ListTypeSearchType1').data('offset'),
                    $('#modal-ListTypeSearchType1').data('page'),
                );
            }

            ListTypeSearchType1.show_select_popup = async function (id, c1) {
                if (c1.toLowerCase() == 'total') return;

                let modal_class_name = $('#search-type1-form').find('#select-popup-select option:selected').data('component');
                let parameter_type = $('#search-type1-form').find('#select-popup-select option:selected').data('type');
                if (isEmpty(modal_class_name)) return;

                // console.log(capitalize(camelCase(modal_class_name)))
                await eval(capitalize(camelCase(modal_class_name))).show_popup_callback(id, c1, {
                        start_date: $('#search-type1-start-date').val(),
                        end_date: $('#search-type1-end-date').val(),
                        range_val: $('input:radio[name=search-type1-date-range]:checked').val()
                    },
                    [ListTypeSearchType1.parentParameter, ListTypeSearchType1.get_parameter(1000000000000000, 0)]
                );

                // hide => 업데이트 유무
                if (parameter_type != 'list1') {
                    $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
                } else {
                    $(`#modal-select-popup.${modal_class_name}`).removeClass('list-update')
                }

                $(`#modal-select-popup.${modal_class_name}`).modal('show')
            }

            ListTypeSearchType1.c1_popup_conver_for = function (id, c1) {
                let result;
                switch (ListTypeSearchType1.para.DisplayVars.IsC1Popup) {
                    case '1':
                    case '2':
                        result = `
                        <a href="javascript:;" onclick="ListTypeSearchType1.show_select_popup('${id}', '${format_conver_for(c1, 'unique')}')">
                            ${format_conver_for(c1, ListTypeSearchType1.para.ListVars['Format'].C1)}
                        </a>`;
                        break;
                    default:
                        result = format_conver_for(c1, ListTypeSearchType1.para.ListVars['Format'].C1)
                        break;
                }

                return result;
            }

            ListTypeSearchType1.searchType1_open = function (limit = 10, offset = 0, page = 1) {
                let html = ``;
                $('#modal-ListTypeSearchType1').data('limit', limit);
                $('#modal-ListTypeSearchType1').data('offset', offset);
                $('#modal-ListTypeSearchType1').data('page', page);

                $('#search-type1-form').find('#search-type1-table-body').html(
                    `<tr><td class="text-center" colspan="${ListTypeSearchType1.para.ListVars['Count']}">검색 중...</td></tr>`
                )

                deactivate_button_group({save_spinner_btn: '#search-type1-save-spinner-btn', btn_group: '#search-type1-btn-group'});

                let parameter = ListTypeSearchType1.get_parameter(limit, offset)
                $.when(get_api_data(ListTypeSearchType1.para['General']['PageApi'], parameter)).done(function(response) {
                    let d = response.data
                    console.log(d)
                    if ( d.Page ) {
                        make_pagination('ListTypeSearchType1.searchType1', d.PageVars.QueryCnt, page);
                        let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                        for (let i in d.Page) {
                            html +=
                            `<tr>
                                <td class="text-${ListTypeSearchType1.para.ListVars['Align'].$Radio} px-import-0" ${ListTypeSearchType1.para.ListVars['Hidden'].$Radio}>
                                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].$Radio}"
                                    onclick="ListTypeSearchType1.show_select_popup('${d.Page[i].Id}', '${format_conver_for(d.Page[i].C1, 'unique')}')">
                                </td>
                                <td class="text-${ListTypeSearchType1.para.ListVars['Align'].$Check} px-import-0" ${ListTypeSearchType1.para.ListVars['Hidden'].$Check}>
                                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].$Check}">
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].No}" ${ListTypeSearchType1.para.ListVars['Hidden'].No}>${no--}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C1}" ${ListTypeSearchType1.para.ListVars['Hidden'].C1}>${ListTypeSearchType1.c1_popup_conver_for(d.Page[i].Id, d.Page[i].C1)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C2}" ${ListTypeSearchType1.para.ListVars['Hidden'].C2}>${format_conver_for(d.Page[i].C2, ListTypeSearchType1.para.ListVars['Format'].C2)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C3}" ${ListTypeSearchType1.para.ListVars['Hidden'].C3}>${format_conver_for(d.Page[i].C3, ListTypeSearchType1.para.ListVars['Format'].C3)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C4}" ${ListTypeSearchType1.para.ListVars['Hidden'].C4}>${format_conver_for(d.Page[i].C4, ListTypeSearchType1.para.ListVars['Format'].C4)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C5}" ${ListTypeSearchType1.para.ListVars['Hidden'].C5}>${format_conver_for(d.Page[i].C5, ListTypeSearchType1.para.ListVars['Format'].C5)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C6}" ${ListTypeSearchType1.para.ListVars['Hidden'].C6}>${format_conver_for(d.Page[i].C6, ListTypeSearchType1.para.ListVars['Format'].C6)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C7}" ${ListTypeSearchType1.para.ListVars['Hidden'].C7}>${format_conver_for(d.Page[i].C7, ListTypeSearchType1.para.ListVars['Format'].C7)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C8}" ${ListTypeSearchType1.para.ListVars['Hidden'].C8}>${format_conver_for(d.Page[i].C8, ListTypeSearchType1.para.ListVars['Format'].C8)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C9}" ${ListTypeSearchType1.para.ListVars['Hidden'].C9}>${format_conver_for(d.Page[i].C9, ListTypeSearchType1.para.ListVars['Format'].C9)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C10}" ${ListTypeSearchType1.para.ListVars['Hidden'].C10}>${format_conver_for(d.Page[i].C10, ListTypeSearchType1.para.ListVars['Format'].C10)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C11}" ${ListTypeSearchType1.para.ListVars['Hidden'].C11}>${format_conver_for(d.Page[i].C11, ListTypeSearchType1.para.ListVars['Format'].C11)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C12}" ${ListTypeSearchType1.para.ListVars['Hidden'].C12}>${format_conver_for(d.Page[i].C12, ListTypeSearchType1.para.ListVars['Format'].C12)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C13}" ${ListTypeSearchType1.para.ListVars['Hidden'].C13}>${format_conver_for(d.Page[i].C13, ListTypeSearchType1.para.ListVars['Format'].C13)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C14}" ${ListTypeSearchType1.para.ListVars['Hidden'].C14}>${format_conver_for(d.Page[i].C14, ListTypeSearchType1.para.ListVars['Format'].C14)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C15}" ${ListTypeSearchType1.para.ListVars['Hidden'].C15}>${format_conver_for(d.Page[i].C15, ListTypeSearchType1.para.ListVars['Format'].C15)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C16}" ${ListTypeSearchType1.para.ListVars['Hidden'].C16}>${format_conver_for(d.Page[i].C16, ListTypeSearchType1.para.ListVars['Format'].C16)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C17}" ${ListTypeSearchType1.para.ListVars['Hidden'].C17}>${format_conver_for(d.Page[i].C17, ListTypeSearchType1.para.ListVars['Format'].C17)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C18}" ${ListTypeSearchType1.para.ListVars['Hidden'].C18}>${format_conver_for(d.Page[i].C18, ListTypeSearchType1.para.ListVars['Format'].C18)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C19}" ${ListTypeSearchType1.para.ListVars['Hidden'].C19}>${format_conver_for(d.Page[i].C19, ListTypeSearchType1.para.ListVars['Format'].C19)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C20}" ${ListTypeSearchType1.para.ListVars['Hidden'].C20}>${format_conver_for(d.Page[i].C20, ListTypeSearchType1.para.ListVars['Format'].C20)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C21}" ${ListTypeSearchType1.para.ListVars['Hidden'].C21}>${format_conver_for(d.Page[i].C21, ListTypeSearchType1.para.ListVars['Format'].C21)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C22}" ${ListTypeSearchType1.para.ListVars['Hidden'].C22}>${format_conver_for(d.Page[i].C22, ListTypeSearchType1.para.ListVars['Format'].C22)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C23}" ${ListTypeSearchType1.para.ListVars['Hidden'].C23}>${format_conver_for(d.Page[i].C23, ListTypeSearchType1.para.ListVars['Format'].C23)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C24}" ${ListTypeSearchType1.para.ListVars['Hidden'].C24}>${format_conver_for(d.Page[i].C24, ListTypeSearchType1.para.ListVars['Format'].C24)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C25}" ${ListTypeSearchType1.para.ListVars['Hidden'].C25}>${format_conver_for(d.Page[i].C25, ListTypeSearchType1.para.ListVars['Format'].C25)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C26}" ${ListTypeSearchType1.para.ListVars['Hidden'].C26}>${format_conver_for(d.Page[i].C26, ListTypeSearchType1.para.ListVars['Format'].C26)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C27}" ${ListTypeSearchType1.para.ListVars['Hidden'].C27}>${format_conver_for(d.Page[i].C27, ListTypeSearchType1.para.ListVars['Format'].C27)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C28}" ${ListTypeSearchType1.para.ListVars['Hidden'].C28}>${format_conver_for(d.Page[i].C28, ListTypeSearchType1.para.ListVars['Format'].C28)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C29}" ${ListTypeSearchType1.para.ListVars['Hidden'].C29}>${format_conver_for(d.Page[i].C29, ListTypeSearchType1.para.ListVars['Format'].C29)}
                                </td>
                                <td
                                    class="text-${ListTypeSearchType1.para.ListVars['Align'].C30}" ${ListTypeSearchType1.para.ListVars['Hidden'].C30}>${format_conver_for(d.Page[i].C30, ListTypeSearchType1.para.ListVars['Format'].C30)}
                                </td>
                            </tr>`;
                        }
                    } else {
                        if (! isEmpty(d.apiStatus)) {
                            switch (d.apiStatus) {
                                case 607:
                                    html = `<tr><td class="text-center" colspan="${ListTypeSearchType1.para.ListVars['Count']}">Query Error</td></tr>`;
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            html = `<tr><td class="text-center" colspan="${ListTypeSearchType1.para.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                        }
                        make_pagination('ListTypeSearchType1.searchType1', 1, 1 );
                    }

                    activate_button_group({save_spinner_btn: '#search-type1-save-spinner-btn', btn_group: '#search-type1-btn-group'});

                    $('#search-type1-form').find('#search-type1-table-body').html(html);
                })
            }

            ListTypeSearchType1.get_parameter = function (limit, offset) {
                let parameter = {
                    QueryVars: {
                        QueryName: ListTypeSearchType1.para['QueryVars']['QueryName'],
                    },
                    ListType1Vars: {
                        ListToken: '',

                        FilterDate: ListTypeSearchType1.para['QueryVars']['FilterDate'],
                        StartDate: moment(new Date($('#search-type1-form').find('#search-type1-start-date').val())).format('YYYYMMDD'),
                        EndDate: moment(new Date($('#search-type1-form').find('#search-type1-end-date').val())).format('YYYYMMDD'),

                        FilterFirst: ListTypeSearchType1.para['ListType1RangeVars']['Filter']['FirstRange'],
                        StartFirst: $('#search-type1-form').find('#FromFirstRange').val(),
                        EndFirst: $('#search-type1-form').find('#ToFirstRange').val(),

                        FilterSecond: ListTypeSearchType1.para['ListType1RangeVars']['Filter']['SecondRange'],
                        StartSecond: $('#search-type1-form').find('#FromSecondRange').val(),
                        EndSecond: $('#search-type1-form').find('#ToSecondRange').val(),

                        FilterThird: ListTypeSearchType1.para['ListType1RangeVars']['Filter']['ThirdRange'],
                        StartThird: $('#search-type1-form').find('#FromThirdRange').val(),
                        EndThird: $('#search-type1-form').find('#ToThirdRange').val(),

                        FilterFourth: ListTypeSearchType1.para['ListType1RangeVars']['Filter']['FourthRange'],
                        StartFourth: $('#search-type1-form').find('#FromFourthRange').val(),
                        EndFourth: $('#search-type1-form').find('#ToFourthRange').val(),

                        IsFirstCheck: $('#search-type1-form').find('#is-first-check:checked').val() == '1',
                        IsSecondCheck: $('#search-type1-form').find('#is-second-check:checked').val() == '1',
                        IsThirdCheck: $('#search-type1-form').find('#is-third-check:checked').val() == '1',
                        IsFoutchCheck: $('#search-type1-form').find('#is-fourth-check:checked').val() == '1',

                        Balance: $('#search-type1-form').find('.balance-select').val(),

                        OrderBy: $('#search-type1-form').find('#order-by-select').val(),

                        ListFilterName: $('#search-type1-form').find('#filter-name-select').val(),
                        ListFilterValue: $('#search-type1-form').find('#filter-value-txt').data('value'),
                        ListSimpleFilter: $('#search-type1-form').find('#simple-filter-select').val(),
                    },
                    PageVars: {
                        Limit: parseInt(limit),
                        Offset: parseInt(offset),
                    }
                }

                // console.log(parameter)
                return parameter;
            }

            ListTypeSearchType1.same_as_form_and_scope = function (list_type1_range_var) {
                let from_val = $('#search-type1-form').find(`#From${list_type1_range_var}`).val()
                $('#search-type1-form').find(`#To${list_type1_range_var}`).val(from_val)
            }

            ListTypeSearchType1.get_from_first_range_data = function (id) {
                $('#search-type1-form').find('#FromFirstRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_to_first_range_data = function (id) {
                $('#search-type1-form').find('#ToFirstRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_from_second_range_data = function (id) {
                $('#search-type1-form').find('#FromSecondRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_to_second_range_data = function (id) {
                $('#search-type1-form').find('#ToSecondRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_from_third_range_data = function (id) {
                $('#search-type1-form').find('#FromThirdRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_to_third_range_data = function (id) {
                $('#search-type1-form').find('#ToThirdRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_from_fourth_range_data = function (id) {
                $('#search-type1-form').find('#FromFourthRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.get_to_fourth_range_data = function (id) {
                $('#search-type1-form').find('#ToFourthRange').val(id)
                $(`#modal-${ListTypeSearchType1.para['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListTypeSearchType1.show_modal = function (list_type1_range_var, type) {
                let func_name = `Get${type}${list_type1_range_var}Data`;

                $('#search-type1-form .modal-btn').data('filter', ListTypeSearchType1.para['ListType1RangeVars']['Filter'][list_type1_range_var])
                $('#search-type1-form .modal-btn').data('target', ListTypeSearchType1.para['ListType1RangeVars']['Component'][list_type1_range_var])
                $('#search-type1-form .modal-btn').data('variable', ListTypeSearchType1.para['ListType1RangeVars']['Parameter'][list_type1_range_var])
                $('#search-type1-form .modal-btn').data('class', ListTypeSearchType1.para['QueryVars']['QueryName'])
                $('#search-type1-form .modal-btn').data('clicked', `ListTypeSearchType1.${snakeCase(func_name)}`)
                $('#search-type1-form .modal-btn').trigger('click')
            }
        }( window.ListTypeSearchType1 = window.ListTypeSearchType1 || {}, jQuery ));
    </script>
@endpush
@endonce
