<div class="content listMedia1 pb-0">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right d-flex justify-content-end">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary listMedia1-act" data-value="list" {{ $listMedia1['FormVars']['Hidden']['ListButton'] }}>
                        {{ $listMedia1['FormVars']['Title']['ListButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $listMedia1['HeadSelectOptions'],
                        'eventClassName' => 'listMedia1-act',
                    ])
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $listMedia1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="{{ $listMedia1['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title']['DateRange'] }}</label>
                                        <div class="d-flex align-items-center" style="height: 28px;">
                                            @foreach ($listMedia1['DateRangeOptions'] as $key => $option)
                                                <input  autocomplete="off" name="listMedia1-date-range" type="radio" onchange="ListMedia1Form.list_media1_list()"
                                                        value="{{ $option['Value'] }}" id="{{ 'listMedia1-date-range-'.($key+1) }}"
                                                {{ $option['Value'] == 'all' ? 'checked' : ''}}>
                                                <label for="{{ 'listMedia1-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $listMedia1['FormVars']['Display']['Date'] }} flex-column mb-2">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title']['Date'] }}</label>
                                        <div class="d-flex">
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="listMedia1-start-date" type="date" value="1990-01-01">
                                            <label class="btn disabled p-1 text-center">~</label>
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="listMedia1-end-date" type="date" value="3000-12-31">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $listMedia1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    @foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $listType1RangeVar)
                                    <div class="{{ $listMedia1['FormVars']['Display'][$listType1RangeVar] }} flex-column mb-2">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title'][$listType1RangeVar] }}</label>
                                        <div class="d-flex">
                                            <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                type="text" value="" id="From{{ $listType1RangeVar }}">&nbsp;
                                            <button type="button" onclick="ListMedia1Form.show_modal('{{ $listType1RangeVar }}', 'From')"
                                                class="btn-dark rounded border-0
                                                    overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                {{ $listMedia1['FormVars']['Title']['From'] }}
                                            </button>&nbsp;
                                            <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                type="text" value="" id="To{{ $listType1RangeVar }}">&nbsp;
                                            <button type="button" onclick="ListMedia1Form.show_modal('{{ $listType1RangeVar }}', 'To')"
                                                class="btn-dark rounded border-0
                                                    overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                {{ $listMedia1['FormVars']['Title']['To'] }}
                                            </button>&nbsp;
                                            <button class="btn-dark rounded border-0
                                                overflow-hidden w-100 text-nowrap col-1" style="height: 28px"
                                                onclick="ListMedia1Form.same_as_form_and_scope('{{ $listType1RangeVar }}')">=</button>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $listMedia1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="{{ $listMedia1['FormVars']['Display']['SelectPopup'] }} flex-column mb-2">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title']['SelectPopup'] }}</label>
                                        <select class="rounded w-100" id="select-popup-select">
                                            @foreach ($listMedia1['SelectPopupOptions'] as $popupOption)
                                                <option value="{{ $popupOption['Caption'] }}" data-component="{{ $popupOption['ModalClassName'] }}"
                                                    data-type="{{ $popupOption['ParameterType'] }}">
                                                    {{ $popupOption['Caption'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="{{ $listMedia1['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title']['FilterOption'] }}</label>
                                        <div class="row">
                                            <div class="col-5 pr-1">
                                                <select class="rounded w-100" id="filter-name-select" onchange="ListMedia1Form.chagne_filter_name_select(this)">
                                                    @foreach ($listMedia1['FilterSelectOptions'] as $key => $popupOption)
                                                        <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                            {{ $popupOption['Caption'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col pl-0">
                                                <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="ListMedia1Form.override_enter_pressed_auto_search(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="{{ $listMedia1['FormVars']['Display']['SimpleOption'] }} flex-column">
                                        <label class="m-0">{{ $listMedia1['FormVars']['Title']['SimpleOption'] }}</label>
                                        <select class="rounded w-100" id="simple-filter-select" onchange="ListMedia1Form.filter_list_media1_list()">
                                            @foreach ($listMedia1['SimpleSelectOptions'] as $key => $popupOption)
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

                <div class="card-body p-0 mt-2 mx-2 listMedia1" id="modal-ListMedia1Form">
                    <div id="grid-layout">
                    </div>

                    <div id="list-layout" class="table-responsive mt-2" style="height: {{ $listMedia1['DisplayVars']['BodyHeight'] }}px">
                        <table class="table-row listMedia1-table">
                            <thead id="listMedia1-table-head">
                                @include('front.dabory.erp.partial.make-thead', [
                                    'listVars' => $listMedia1['ListVars'],
                                    'checkboxName' => 'bd-cud-check'
                                ])
                            </thead>
                            <tbody id="listMedia1-table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                        <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="ListMedia1Form.listMedia1">
                            @include('front.outline.moption')
                        </select>
                        <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                            <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                            <select class="modal-order-by-select w-100 rounded" data-target="ListMedia1Form.listMedia1">
                                <option value="{{ $listMedia1['OrderByOptions'][0]['Value']}}">{{ $listMedia1['OrderByOptions'][0]['Caption']}}</option>
                                <option value="{{ $listMedia1['OrderByOptions'][1]['Value']}}">{{ $listMedia1['OrderByOptions'][1]['Caption']}}</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-3">
                            <div class="view-switch">
                                <button class="btn px-1 active" onclick="ListMedia1Form.show_media_mode(this, 'list')"><i class="fas fa-list fa-lg" style="line-height: 24px;"></i></button>
                                <button class="btn px-1" onclick="ListMedia1Form.show_media_mode(this, 'grid')"><i class="fas fa-border-all fa-lg" style="line-height: 24px;"></i></button>
                            </div>
                        </div>
                        <ul class="pagination pagination-sm"></ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@foreach ($listMedia1['SelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption
            ])
        @endpush
    @endif
@endforeach

@foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $i)
    @if ($listMedia1['ListType1RangeVars']['Display'][$i] != 'd-none')
        @push('modal')
            @include($listMedia1['ListType1RangeVars']['BladeRoute'][$i], [
                'moealSetFile' => $listMedia1['ListType1RangeVars']['Parameter'][$i],
                'modalClassName' => $i
            ])
        @endpush
    @endif
@endforeach

@push('js')
<script src="{{ csset('/js/modals-controller/list-type1/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#modal-select-popup').css('zIndex', '1052')
            make_dynamic_table_css('.listMedia1-table', make_dynamic_table_px(ListMedia1Form.listMedia1['ListVars']['Size']))

            ListMedia1Form.init_display_vars()

            ListMedia1Form.reset_list_type1_range_vars_txt()

            $('input:radio[name=listMedia1-date-range]').on('click', function () {
                let firDay, lasDay;
                [firDay, lasDay] = date_range_vending_machine($(this).val());

                $('#listMedia1-start-date').val(date_to_sting(firDay))
                $('#listMedia1-end-date').val(date_to_sting(lasDay))
            });

            $('.listMedia1-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'new': ListMedia1Form.list_media1_new(); break;
                    case 'list': ListMedia1Form.list_media1_list(); break;
                    case 'multi-delete': ListMedia1Form.list_media1_multi_delete(); break;
                    case 'clear-all-filter': ListMedia1Form.list_media1_clear_all_filter(); break;
                }
            });

            $(document).on('hide.bs.modal','#modal-select-popup', function () {
                ListMedia1Form.list_media1_list()
            });

            activate_button_group();
        });

        (function( ListMedia1Form, $, undefined ) {
            ListMedia1Form.listMedia1 = {!! json_encode($listMedia1) !!};

            ListMedia1Form.override_enter_pressed_auto_search = function (event) {
                window.enter_pressed_auto_search(event, function () {
                    $('.listMedia1').find('#filter-value-txt').data('value', $(event.target).val())

                    if ($('.listMedia1').find('#filter-name-select option:selected').data('reverse')) {
                        const value = format_conver_for($(event.target).val(), $('.listMedia1').find('#filter-name-select option:selected').data('reverse'))

                        $('.listMedia1').find('#filter-value-txt').data('value', value)
                    }
                    ListMedia1Form.filter_list_media1_list()
                })
            }

            ListMedia1Form.chagne_filter_name_select = function ($this) {
                $('.listMedia1').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
            }

            ListMedia1Form.filter_list_media1_list = function () {
                ListMedia1Form.listMedia1_open($('#modal-type1').data('limit'), 0, 1)
            }

            ListMedia1Form.get_selected_data = async function () {
                let data = [];
                let response = await get_api_data(ListMedia1Form.listMedia1['General']['PageApi'], ListMedia1Form.get_listMedia1_parameter($('#modal-ListMedia1Form').data('limit'), $('#modal-ListMedia1Form').data('offset')));
                let page = response.data.Page;

                $('.listMedia1-table').find(`input[name='bd-cud-check']`).each(function(index) {
                    if ($(this).is(':checked')) {
                        if (page[index].Id == 0) return true;
                        data.push(page[index]);
                    }
                })

                return data;
            }

            ListMedia1Form.convert_to_multi_delete_data = async function (table_id) {
                let data = [];
                let response = await get_api_data(ListMedia1Form.listMedia1['General']['PageApi'], ListMedia1Form.get_listMedia1_parameter($('#modal-ListMedia1Form').data('limit'), $('#modal-ListMedia1Form').data('offset')));
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

            ListMedia1Form.list_media1_multi_delete = function () {
                confirm_message_shw_and_delete(async function() {
                    let modal_class_name = $('#select-popup-select option:selected').data('component');
                    const data = await ListMedia1Form.convert_to_multi_delete_data('.listMedia1-table')
                    if (! data) return;

                    eval(capitalize(camelCase(modal_class_name))).btn_act_multi_delete_callback(data, function () {
                        iziToast.success({
                            title: 'Success',
                            message: $('#action-completed').text(),
                        });
                        ListMedia1Form.list_media1_list()
                    })
                })
            }

            ListMedia1Form.view_switch_btn_active = function ($this) {
                $('#modal-ListMedia1Form').find('.view-switch button').removeClass('active')
                $($this).addClass('active')
            }

            ListMedia1Form.show_media_mode = function ($this, mode) {
                $('#modal-ListMedia1Form').data('mode', mode);
                ListMedia1Form.list_media1_list()
                ListMedia1Form.view_switch_btn_active($this)
            }

            ListMedia1Form.list_media1_clear_all_filter = function () {
                input_box_reset_for('.listMedia1 #frm')
                input_box_reset_for('#modal-ListMedia1Form')
                ListMedia1Form.init_display_vars()

                $('#listMedia1-start-date').val('1990-01-01')
                $('#listMedia1-end-date').val('3000-12-31')
                $("input:radio[name=listMedia1-date-range]:input[value='all']").prop('checked', true)

                ListMedia1Form.reset_list_type1_range_vars_txt()

                // table body 초기화
                make_pagination('ListMedia1Form.listMedia1', 1, 1 );
                $('#modal-ListMedia1Form').find('.modal-line-select').val(ListMedia1Form.listMedia1['DisplayVars']['InitLines'])
                $('#modal-ListMedia1Form').data('limit', ListMedia1Form.listMedia1['DisplayVars']['InitLines'])
                $('#modal-ListMedia1Form').data('offset', 0)
                $('#modal-ListMedia1Form').data('page', 1)
                $('#listMedia1-table-body').html('')
            }

            ListMedia1Form.list_media1_new = async function () {
                let response = await get_api_data(ListMedia1Form.listMedia1['General']['PageApi'], ListMedia1Form.get_listMedia1_parameter(0, 0))
                // const setup = JSON.parse(response.data.SetupVars[0]['SetupJson'])

                let modal_class_name = $('#select-popup-select option:selected').data('component');

                eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()
                $(`#modal-select-popup.${modal_class_name}`).modal('show')
            }

            ListMedia1Form.reset_list_type1_range_vars_txt = function () {
                let list_type1_range_vars = ['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'];

                list_type1_range_vars.forEach(i => {
                    $(`#From${i}`).val('');
                    $(`#To${i}`).val('');
                });
            }

            ListMedia1Form.list_media1_list = function () {
                ListMedia1Form.listMedia1_open(
                    $('#modal-ListMedia1Form').data('limit'),
                    $('#modal-ListMedia1Form').data('offset'),
                    $('#modal-ListMedia1Form').data('page'),
                );
            }

            ListMedia1Form.show_select_popup = async function (id, c1) {
                if (c1.toLowerCase() == 'total') return;

                let modal_class_name = $('#select-popup-select option:selected').data('component');
                let parameter_type = $('#select-popup-select option:selected').data('type');
                if (isEmpty(modal_class_name)) return;

                // console.log(capitalize(camelCase(modal_class_name)))
                await eval(capitalize(camelCase(modal_class_name))).show_popup_callback(id, c1, {
                        start_date: $('#listMedia1-start-date').val(),
                        end_date: $('#listMedia1-end-date').val(),
                        range_val: $('input:radio[name=listMedia1-date-range]:checked').val()
                    }
                );

                $(`#modal-select-popup.${modal_class_name}`).modal('show')
            }

            ListMedia1Form.get_listMedia1_parameter = function (limit, offset) {
                let parameter = {
                    QueryVars: {
                        QueryName: ListMedia1Form.listMedia1['QueryVars']['QueryName'],
                        FilterName: ListMedia1Form.listMedia1['QueryVars']['FilterName'],
                        FilterValue: ListMedia1Form.listMedia1['QueryVars']['FilterValue'],
                        SimpleFilter: ListMedia1Form.listMedia1['QueryVars']['SimpleFilter'],
                    },
                    ListType1Vars: {
                        ListToken: '',

                        FilterDate: ListMedia1Form.listMedia1['QueryVars']['FilterDate'],
                        StartDate: moment(new Date($('.listMedia1').find('#listMedia1-start-date').val())).format('YYYYMMDD'),
                        EndDate: moment(new Date($('.listMedia1').find('#listMedia1-end-date').val())).format('YYYYMMDD'),

                        FilterFirst: ListMedia1Form.listMedia1['ListType1RangeVars']['Filter']['FirstRange'],
                        StartFirst: $('.listMedia1').find('#FromFirstRange').val(),
                        EndFirst: $('.listMedia1').find('#ToFirstRange').val(),

                        FilterSecond: ListMedia1Form.listMedia1['ListType1RangeVars']['Filter']['SecondRange'],
                        StartSecond: $('.listMedia1').find('#FromSecondRange').val(),
                        EndSecond: $('.listMedia1').find('#ToSecondRange').val(),

                        FilterThird: ListMedia1Form.listMedia1['ListType1RangeVars']['Filter']['ThirdRange'],
                        StartThird: $('.listMedia1').find('#FromThirdRange').val(),
                        EndThird: $('.listMedia1').find('#ToThirdRange').val(),

                        FilterFourth: ListMedia1Form.listMedia1['ListType1RangeVars']['Filter']['FourthRange'],
                        StartFourth: $('.listMedia1').find('#FromFourthRange').val(),
                        EndFourth: $('.listMedia1').find('#ToFourthRange').val(),

                        IsAddTotalLine: $('.listMedia1').find('#is-add-total-line-check:checked').val() == '1',

                        OrderBy: $('.listMedia1').find('.modal-order-by-select').val(),

                        ListFilterName: $('.listMedia1').find('#filter-name-select').val(),
                        ListFilterValue: $('.listMedia1').find('#filter-value-txt').data('value'),
                        ListSimpleFilter: $('.listMedia1').find('#simple-filter-select').val(),
                    },
                    PageVars: {
                        Limit: parseInt(limit),
                        Offset: parseInt(offset),
                    },
                    // SetupVars: [
                    //     {
                    //         SetupCode: ListMedia1Form.listMedia1['SetupVars'][0]['SetupCode']
                    //     }
                    // ]
                }

                // console.log(parameter)
                return parameter;
            }

            ListMedia1Form.c1_popup_conver_for = function (id, c1) {
                let result;
                switch (ListMedia1Form.listMedia1.DisplayVars.IsC1Popup) {
                    case '1':
                    case '2':
                        result = `
                        <a href="#" onclick="ListMedia1Form.show_select_popup('${id}', '${format_conver_for(c1, 'unique')}')">
                            ${format_conver_for(c1, ListMedia1Form.listMedia1.ListVars['Format'].C1, ListMedia1Form.listMedia1['ThumbContainerVars'])}
                        </a>`;
                        break;
                    default:
                        result = format_conver_for(c1, ListMedia1Form.listMedia1.ListVars['Format'].C1, ListMedia1Form.listMedia1['ThumbContainerVars'])
                        break;
                }

                return result;
            }

            ListMedia1Form.get_list_html = function (d) {
                $('.listMedia1').find('#list-layout').removeClass('d-none')
                $('.listMedia1').find('#grid-layout').addClass('d-none')
                let html = ``;

                if ( d.Page ) {
                    make_pagination('ListMedia1Form.listMedia1', d.PageVars.QueryCnt, $('#modal-ListMedia1Form').data('page'));
                    let no = get_table_no(d.PageVars.QueryCnt, $('#modal-ListMedia1Form').data('page'), $('#modal-ListMedia1Form').data('limit'));
                    d.Page.forEach(list_media1 => {
                        html +=
                        `<tr>
                            <td class="text-${ListMedia1Form.listMedia1.ListVars['Align'].$Radio} px-import-0" ${ListMedia1Form.listMedia1.ListVars['Hidden'].$Radio}>
                                <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                                class="text-${ListMedia1Form.listMedia1.ListVars['Align'].$Radio}"
                                onclick="ListMedia1Form.show_select_popup('${list_media1.Id}', '${format_conver_for(list_media1.C1, 'unique')}')">
                            </td>
                            <td class="text-${ListMedia1Form.listMedia1.ListVars['Align'].$Check} px-import-0" ${ListMedia1Form.listMedia1.ListVars['Hidden'].$Check}>
                                <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                                class="text-${ListMedia1Form.listMedia1.ListVars['Align'].$Check}">
                            </td>
                            <td
                                class="text-${ListMedia1Form.listMedia1.ListVars['Align'].No}" ${ListMedia1Form.listMedia1.ListVars['Hidden'].No}>${no--}
                            </td>
                            <td
                                class="text-${ListMedia1Form.listMedia1.ListVars['Align'].C1}" ${ListMedia1Form.listMedia1.ListVars['Hidden'].C1}>${ListMedia1Form.c1_popup_conver_for(list_media1.Id, list_media1.C1)}
                            </td>
                        `;
                        for (const key in ListMedia1Form.listMedia1.ListVars['Title']) {
                            if (key === '$Radio' || key === '$Check' || key === 'No' ||
                                key === 'C1') { continue }
                            html += `
                            <td
                                class="text-${ListMedia1Form.listMedia1.ListVars['Align'][key]}" ${ListMedia1Form.listMedia1.ListVars['Hidden'][key]}>${format_conver_for(list_media1[key], ListMedia1Form.listMedia1.ListVars['Format'][key], ListMedia1Form.listMedia1['ThumbContainerVars'])}
                            </td>`;
                        }
                        html += `</tr>`;
                    });
                } else {
                    html = `<tr><td class="text-center" colspan="${ListMedia1Form.listMedia1.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                    make_pagination('ListMedia1Form.listMedia1', 1, 1 );
                }

                $('.listMedia1').find('#listMedia1-table-body').html(html);
            }

            ListMedia1Form.get_grid_html = function (d) {
                $('.listMedia1').find('#grid-layout').removeClass('d-none')
                $('.listMedia1').find('#list-layout').addClass('d-none')
                let html = ``;

                if ( d.Page ) {
                    make_pagination('ListMedia1Form.listMedia1', d.PageVars.QueryCnt, $('#modal-ListMedia1Form').data('page'));
                    d.Page.forEach((list_media1, index) => {
                        html +=
                        `
                        <br class="${(index) % ListMedia1Form.listMedia1.ThumbContainerVars['ImagePerLine'] == 0 ? '' : 'd-none'}"/>
                        <button class="item p-0 mx-1 mb-2" onclick="ListMedia1Form.show_select_popup('${list_media1.Id}', '${list_media1.C1}')">
                            <img width="${ListMedia1Form.listMedia1.ThumbContainerVars['GalleryWidth']}" height="${ListMedia1Form.listMedia1.ThumbContainerVars['GalleryHeight']}" src="${window.env['MEDIA_URL'] + list_media1.C6}" onerror="this.src='/images/folder.jpg'"/>
                        </button>
                        `;
                    });
                }
                else {
                    html = `<h3 class="text-center">${$('#no-data-found').text()}</h3>`;
                    make_pagination('ListMedia1Form.listMedia1', 1, 1 );
                }

                $('#grid-layout').html(html)
            }

            ListMedia1Form.listMedia1_open = function (limit = 10, offset = 0, page = 1) {
                $('#modal-ListMedia1Form').data('limit', limit);
                $('#modal-ListMedia1Form').data('offset', offset);
                $('#modal-ListMedia1Form').data('page', page);

                $.when(get_api_data(ListMedia1Form.listMedia1['General']['PageApi'], ListMedia1Form.get_listMedia1_parameter(limit, offset))).done(function(response) {
                    let d = response.data;
                    console.log(d)
                    switch ($('#modal-ListMedia1Form').data('mode') || 'list') {
                    case 'list':
                        ListMedia1Form.get_list_html(d)
                        break;
                    case 'grid':
                        ListMedia1Form.get_grid_html(d)
                        break;
                    }
                })
            }

            ListMedia1Form.init_display_vars = function () {
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').addClass('bg-blue-600')
                $('#modal-select-popup .modal-body button').addClass('bg-blue-600 border-blue-600 bg-blue-600-hover')
                $('#modal-select-popup .modal-body thead th').addClass('bg-blue-600')

                $('#modal-multi-popup .modal-body button').addClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

                $('.listMedia1').find('#is-add-total-line-check').prop('checked', ListMedia1Form.listMedia1['DisplayVars']['IsAddTotalLine'])

                $('#modal-ListMedia1Form').find('.modal-line-select').val(ListMedia1Form.listMedia1['DisplayVars']['InitLines'])
                $('#modal-ListMedia1Form').data('limit', ListMedia1Form.listMedia1['DisplayVars']['InitLines'])
                if (ListMedia1Form.listMedia1['DisplayVars']['IsListFirst']) {
                    ListMedia1Form.list_media1_list();
                }
            }

            ListMedia1Form.same_as_form_and_scope = function (list_type1_range_var) {
                let from_val = $('.listMedia1').find(`#From${list_type1_range_var}`).val()
                $('.listMedia1').find(`#To${list_type1_range_var}`).val(from_val)
            }

            ListMedia1Form.get_from_first_range_data = function (id) {
                $('.listMedia1').find('#FromFirstRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_to_first_range_data = function (id) {
                $('.listMedia1').find('#ToFirstRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_from_second_range_data = function (id) {
                $('.listMedia1').find('#FromSecondRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_to_second_range_data = function (id) {
                $('.listMedia1').find('#ToSecondRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_from_third_range_data = function (id) {
                $('.listMedia1').find('#FromThirdRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_to_third_range_data = function (id) {
                $('.listMedia1').find('#ToThirdRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_from_fourth_range_data = function (id) {
                $('.listMedia1').find('#FromFourthRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListMedia1Form.get_to_fourth_range_data = function (id) {
                $('.listMedia1').find('#ToFourthRange').val(id)
                $(`#modal-${ListMedia1Form.listMedia1['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListMedia1Form.show_modal = function (list_type1_range_var, type) {
                let func_name = `Get${type}${list_type1_range_var}Data`;

                $('.listMedia1').find('.modal-btn').data('filter', ListMedia1Form.listMedia1['ListType1RangeVars']['Filter'][list_type1_range_var])
                $('.listMedia1').find('.modal-btn').data('target', ListMedia1Form.listMedia1['ListType1RangeVars']['Component'][list_type1_range_var])
                $('.listMedia1').find('.modal-btn').data('variable', ListMedia1Form.listMedia1['ListType1RangeVars']['Parameter'][list_type1_range_var])
                $('.listMedia1').find('.modal-btn').data('class', list_type1_range_var)
                $('.listMedia1').find('.modal-btn').data('clicked', `ListMedia1Form.${snakeCase(func_name)}`)
                $('.listMedia1').find('.modal-btn').trigger('click')
            }

        }( window.ListMedia1Form = window.ListMedia1Form || {}, jQuery ));
    </script>
@endpush
