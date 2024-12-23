<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="list-form-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" id="list-form-btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary list1-act" data-value="list" {{ $list1['FormVars']['Hidden']['ListButton'] }}>
            {{ $list1['FormVars']['Title']['ListButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $list1['HeadSelectOptions'],
            'eventClassName' => 'list1-act',
        ])
    </div>
</div>

@isset ($list1['TabOptions'])
<div class="card mb-1 px-2">
    <ul class="nav nav-tabs nav-tabs-solid rounded my-2">
        @foreach($list1['TabOptions'] as $i => $tab)
        <li class="nav-item d-flex" id="{{ $tab['Value'] }}-nav-item"><a href="#{{ $tab['Value'] }}" class="nav-link {{ $i === 0 ? 'active' : '' }}" data-toggle="tab">{{ $tab['Caption'] }}</a></li>
        @endforeach
    </ul>
</div>
@endisset

<div class="tab-content" id="list1-form">
@isset ($list1['TabOptions'])
    <div class="tab-pane fade {{ $list1['TabOptions'][0]['Value'] === 'basic' ? 'active show' : '' }}" id="{{ $list1['TabOptions'][0]['Value'] }}">
@endisset
        <div class="card mb-1" {{ $list1['FormVars']['Hidden']['HeadFirst'] }}>
            <div class="row text-center">
                <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadFirst'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadFirst'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="head-first-txt"></h5>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadSecond'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadSecond'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="head-second-txt"></h5>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadThird'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadThird'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="head-third-txt"></h5>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadFourth'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadFourth'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="head-fourth-txt"></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-1" {{ $list1['FormVars']['Hidden']['ColumnFirst'] }}>
            <div class="row text-center">
                <div class="col-3" {{ $list1['FormVars']['Hidden']['ColumnFirst'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['ColumnFirst'] }}</span>
                        <p class="mb-0" id="column-first-txt"></p>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['ColumnSecond'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['ColumnSecond'] }}</span>
                        <p class="mb-0" id="column-second-txt"></p>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['ColumnThird'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['ColumnThird'] }}</span>
                        <p class="mb-0" id="column-third-txt"></p>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['ColumnFourth'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['ColumnFourth'] }}</span>
                        <p class="mb-0" id="column-fourth-txt"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-1" {{ $list1['FormVars']['Hidden']['TextFirst'] }}>
            <div class="text-center">

                <div {{ $list1['FormVars']['Hidden']['TextFirst'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['TextFirst'] }}</span>
                        <p class="mb-0" id="text-first-txt"></p>
                    </div>
                </div>

                <div {{ $list1['FormVars']['Hidden']['TextSecond'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['TextSecond'] }}</span>
                        <p class="mb-0" id="text-second-txt"></p>
                    </div>
                </div>

                <div {{ $list1['FormVars']['Hidden']['TextThird'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['TextThird'] }}</span>
                        <p class="mb-0" id="text-third-txt"></p>
                    </div>
                </div>

                <div {{ $list1['FormVars']['Hidden']['TextFourth'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['TextFourth'] }}</span>
                        <p class="mb-0" id="text-fourth-txt"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-1">
            <div class="card-header {{ $list1['DisplayVars']['HeadHeight'] }}" id="frm">
                <div class="row">
                    <div class="col-md-6 card-header-item px-2">
                        <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $list1['DisplayVars']['HeadHeight'] }}px">
                            <div class="card-header p-0 mb-2">
                                {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                            </div>
                            <div class="card-body">

                                <input type="hidden" id="Id" name="Id" value="0">
                                <div class="{{ $list1['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                    <label class="m-0">{{ $list1['FormVars']['Title']['DateRange'] }}</label>
                                    <div class="d-flex align-items-center justify-content-around" style="height: 28px;">
                                        @foreach ($list1['DateRangeOptions'] as $key => $option)
                                            @empty($option['Caption'])
                                            @else
                                                <div class="d-flex align-items-center list1-date-range-div">
                                                    <input  autocomplete="off" name="list1-date-range" type="radio" onchange="ListTypeList1Form.list1_list()"
                                                            value="{{ $option['Value'] }}" id="{{ 'list1-date-range-'.($key+1) }}">
                                                    <label for="{{ 'list1-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                                    </label>
                                                </div>
                                            @endempty
                                        @endforeach
                                    </div>
                                </div>
                                <div class="{{ $list1['FormVars']['Display']['Date'] }} flex-column">
                                    <label class="m-0">{{ $list1['FormVars']['Title']['Date'] }}</label>
                                    <div class="d-flex">
                                        <input class="rounded overflow-hidden w-100 text-nowrap" id="list1-start-date" type="date" value="1990-01-01">
                                        <label class="btn disabled p-1 text-center">~</label>
                                        <input class="rounded overflow-hidden w-100 text-nowrap" id="list1-end-date" type="date" value="3000-12-31">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 card-header-item px-2">
                        <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $list1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                            <div class="card-header p-0 mb-2">
                                {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="align-items-center mb-2 d-none">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-excel-column-check"> <label class="mb-0" for="list1-is-excel-column-check"></label>
                                </div>
                                <div class="align-items-center mb-2 {{ $list1['FormVars']['Display']['DownloadList'] }}">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-download-list-check"> <label class="mb-0" for="list1-is-download-list-check">{{ $list1['FormVars']['Title']['DownloadList'] }}</label>
                                </div>
                                <div class="align-items-center {{  $list1['FormVars']['Display']['ShowOnlyClosed'] }}">
                                    <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-show-only-closed-check"> <label class="mb-0" for="list1-is-show-only-closed-check">{{ $list1['FormVars']['Title']['ShowOnlyClosed'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($list1['DisplayVars']['BodyHeight'] !== 'd-none')
                <div class="card-body p-0 mt-2 mx-2" id="modal-list1">
                    <div class="table-responsive mt-2" style="height: {{ $list1['DisplayVars']['BodyHeight'] }}px">
                        <table class="table-row list1-table">
                            <thead id="list1-table-head">
                            @include('front.dabory.erp.partial.make-thead', [
                                'listVars' => $list1['ListVars'],
                                'checkboxName' => 'bd-cud-check'
                            ])
                            </thead>
                            <tbody id="list1-table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                        <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="list1">
                            @include('front.outline.moption')
                        </select>
                        <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                            <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                            <select class="modal-order-by-select w-100 rounded" data-target="list1">
                                @foreach ($list1['OrderByOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="{{ $list1['FormVars']['Display']['Balance'] }} align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-3">
                            <label class="text-md-center text-nowrap m-0">
                                {{ $list1['FormVars']['Title']['Balance'] }}
                            </label>
                            <select class="rounded w-100 balance-select ml-0 ml-md-1">
                                @foreach ($list1['BalanceOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <ul class="pagination pagination-sm"></ul>
                    </div>

                </div>
            @endif
        </div>

        <div class="card mb-1" {{ $list1['FormVars']['Hidden']['FootFirst'] }}>
            <div class="row text-center">
                <div class="col-3" {{ $list1['FormVars']['Hidden']['FootFirst'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootFirst'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="foot-first-txt"></h5>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['FootSecond'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootSecond'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="foot-second-txt"></h5>
                    </div>
                </div>

                <div class="col-3" {{ $list1['FormVars']['Hidden']['FootThird'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootThird'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="foot-third-txt"></h5>
                    </div>
                </div>
                <div class="col-3" {{ $list1['FormVars']['Hidden']['FootFourth'] }}>
                    <div class="my-2">
                        <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootFourth'] }}</span>
                        <h5 class="font-weight-semibold mb-0" id="foot-fourth-txt"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@isset ($list1['TabOptions'])
    @include("front.dabory.erp.popup.popup-list1.form-tab.{$list1['QueryVars']['QueryName']}")
@endisset
</div>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/list-type1/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            const first_date_range = $('.list1-date-range-div').first().find('input')
            first_date_range.prop('checked', true)

            ListTypeList1Form.calc_date_rang(first_date_range.val())

            make_dynamic_table_css('#list1-form .list1-table', make_dynamic_table_px(ListTypeList1Form.list1['ListVars']['Size']))

            $('input:radio[name=list1-date-range]').on('click', function () {
                ListTypeList1Form.calc_date_rang($(this).val())
            });

            $('.list1-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': ListTypeList1Form.list1_save(); break;
                    case 'xls-report': ListTypeList1Form.list1_report('excel'); break;
                    case 'pdf-report': ListTypeList1Form.list1_report('pdf'); break;
                }
            });

            // activate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})
        });

        (function( ListTypeList1Form, $, undefined ) {
            ListTypeList1Form.list1 = {!! json_encode($list1) !!};
            ListTypeList1Form.sum_filter = {
                SumFilterName: '',
                SumFilterValue: ''
            }

            ListTypeList1Form.calc_date_rang = function (date_val) {
                let firDay, lasDay;
                [firDay, lasDay] = date_range_vending_machine(date_val)

                $('#list1-form').find('#list1-start-date').val(date_to_sting(firDay))
                $('#list1-form').find('#list1-end-date').val(date_to_sting(lasDay))
            }

            ListTypeList1Form.show_popup_callback = async function (id, c1, date_range, sum_filter = null) {
                input_box_reset_for('#list1-form')
                $('#modal-list1').data('offset', 0)
                $('#modal-list1').data('page', 1)
                $(`input:radio[name=list1-date-range]:input[value=${date_range.range_val}]`).prop('checked', true)
                $('#list1-form').find('#list1-start-date').val(date_range.start_date)
                $('#list1-form').find('#list1-end-date').val(date_range.end_date)
                $('#list1-form').find('#Id').val(id)

                // 첫 번째 탭을 active로 설정
                $('ul.nav-tabs li a').removeClass('active');

                // 첫 번째 탭의 내용을 보이게 설정
                $('ul.nav-tabs li:first-child a').addClass('active');
                $('.tab-pane').removeClass('show active'); // 기존에 활성화된 탭 초기화
                $('#basic').addClass('show active');

                if (sum_filter) {
                    ListTypeList1Form.sum_filter = sum_filter
                }
                ListTypeList1Form.init_display_vars()

                if (ListTypeList1Form.list1['TabOptions']) {
                    ListTypeList1FromTab.ui(id)
                }
            }

            ListTypeList1Form.list1_save = function () {
                if (ListTypeList1Form.list1['TabOptions']) {
                    ListTypeList1FromTab.save()
                }

                ListTypeList1Form.list1_list()
            }

            ListTypeList1Form.list1_list = function () {
                Type1.set_excel_column(ListTypeList1Form.list1, '#list1-form #list1-is-excel-column-check', '#modal-list1 #list1-table-head')
                // $('#modal-select-popup .modal-body thead th').addClass('bg-danger-10')

                list1_open(
                    $('#modal-list1').data('limit'),
                    $('#modal-list1').data('offset'),
                    $('#modal-list1').data('page')
                );
            }

            ListTypeList1Form.list1_report = async function (type) {
                const response = await get_api_data(ListTypeList1Form.list1['General']['PageApi'], ListTypeList1Form.get_list1_parameter(1000000000000000, 0))
                let d = response.data;

                let head = Type1.convert_data_to_report_head(ListTypeList1Form.list1['ListVars']['Title'])
                let body = Type1.convert_data_to_report_body(d.BodyPage, d.PageVars.QueryCnt, ListTypeList1Form.list1['ListVars'])

                if (type === 'excel' && head.find(title => title === '번호')) {
                    head = head.filter(title => title !== '번호')
                    body = body.map(col => col.slice(1))
                }

                const split_query_name = ListTypeList1Form.list1['QueryVars']['QueryName'].split('/')
                const file_name = split_query_name[split_query_name.length - 1]

                const report = {
                    head: head,
                    body: body,
                    title: `${capitalize(camelCase(file_name))}-${moment(new Date($('#list1-form').find('#list1-start-date').val())).format('YYMM')}-${moment(new Date($('#list1-form').find('#list1-end-date').val())).format('YYMM')}`,
                    size: make_dynamic_table_px(ListTypeList1Form.list1['ListVars']['Size']) * 12,
                    type: type,
                }

                Type1.download_report('#list1-form #frm', report);
            }

            ListTypeList1Form.init_display_vars = function () {
                $('#modal-select-popup.list-type-list1-form .modal-header').removeClass('bg-grey-700')
                $('#modal-select-popup.list-type-list1-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup.list-type-list1-form .modal-body thead th').removeClass('bg-grey-700')

                $('#modal-select-popup.list-type-list1-form .modal-dialog').css('maxWidth', `${ListTypeList1Form.list1['PopupList1Vars']['PopupWidth']}px`);

                $('#list1-form').find('#list1-is-excel-column-check').prop('checked', ListTypeList1Form.list1['DisplayVars']['IsExcelColumn'])
                $('#list1-form').find('#list1-is-download-list-check').prop('checked', ListTypeList1Form.list1['DisplayVars']['IsDownloadList'])
                $('#list1-form').find('#list1-is-show-only-closed-check').prop('checked', ListTypeList1Form.list1['DisplayVars']['IsShowOnlyClosed'])

                $('#modal-list1').find('.modal-line-select').val(ListTypeList1Form.list1['DisplayVars']['InitLines'])
                $('#modal-list1').data('limit', ListTypeList1Form.list1['DisplayVars']['InitLines'])
                if (ListTypeList1Form.list1['DisplayVars']['IsListFirst']) {
                    ListTypeList1Form.list1_list();
                } else {
                    activate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})
                }
            }

            ListTypeList1Form.get_list1_parameter = function (limit, offset) {
                let parameter = {
                    QueryVars: {
                        QueryName: ListTypeList1Form.list1['QueryVars']['QueryName'],
                        IsntPagination: ListTypeList1Form.list1['DisplayVars']['IsntPagination'],
                    },
                    // PopupList1Vars: {
                    //     PopupFilterName: ListTypeList1Form.list1['PopupList1Vars']['PopupFilterName'],
                    //     PopupFilterValue: $('#list1-form').find('#Id').val(),
                    //     SumFilterName: ListTypeList1Form.sum_filter['SumFilterName'],
                    //     SumFilterValue: ListTypeList1Form.sum_filter['SumFilterValue'],
                    // },
                    ListType1Vars: {
                        ListToken: '',

                        ListFilterName: ListTypeList1Form.list1['PopupList1Vars']['PopupFilterName'],
                        ListFilterValue: $('#list1-form').find('#Id').val(),
                        SumFilterName: ListTypeList1Form.sum_filter['SumFilterName'],
                        SumFilterValue: ListTypeList1Form.sum_filter['SumFilterValue'],

                        FilterDate: ListTypeList1Form.list1['QueryVars']['FilterDate'],
                        StartDate: moment(new Date($('#list1-form').find('#list1-start-date').val())).format('YYYYMMDD'),
                        EndDate: moment(new Date($('#list1-form').find('#list1-end-date').val())).format('YYYYMMDD'),

                        IsExcelColumn: $('#list1-form').find('#list1-is-excel-column-check:checked').val() == '1',
                        IsDownloadList: $('#list1-form').find('#list1-is-download-list-check:checked').val() == '1',
                        IsShowOnlyClosed: $('#list1-form').find('#list1-is-show-only-closed-check:checked').val() == '1',

                        Balance: $('#list1-form').find('.balance-select').val(),

                        OrderBy: $('#list1-form').find('.modal-order-by-select').val(),
                    },
                    PageVars: {
                        Limit: parseInt(limit),
                        Offset: parseInt(offset),
                    }
                }

                // console.log(parameter)
                return parameter;
            }

            ListTypeList1Form.set_head_and_foot_ui = function (sum_page) {
                $('#list1-form').find('#head-first-txt').text(format_conver_for(sum_page.H1, ListTypeList1Form.list1['FormVars']['Format']['HeadFirst']))
                $('#list1-form').find('#head-second-txt').text(format_conver_for(sum_page.H2, ListTypeList1Form.list1['FormVars']['Format']['HeadSecond']))
                $('#list1-form').find('#head-third-txt').text(format_conver_for(sum_page.H3, ListTypeList1Form.list1['FormVars']['Format']['HeadThird']))
                $('#list1-form').find('#head-fourth-txt').text(format_conver_for(sum_page.H4, ListTypeList1Form.list1['FormVars']['Format']['HeadFourth']))

                $('#list1-form').find('#column-first-txt').text(format_conver_for(sum_page.C1, ListTypeList1Form.list1['FormVars']['Format']['ColumnFirst']))
                $('#list1-form').find('#column-second-txt').text(format_conver_for(sum_page.C2, ListTypeList1Form.list1['FormVars']['Format']['ColumnSecond']))
                $('#list1-form').find('#column-third-txt').text(format_conver_for(sum_page.C3, ListTypeList1Form.list1['FormVars']['Format']['ColumnThird']))
                $('#list1-form').find('#column-fourth-txt').text(format_conver_for(sum_page.C4, ListTypeList1Form.list1['FormVars']['Format']['ColumnFourth']))

                $('#list1-form').find('#text-first-txt').text(format_conver_for(sum_page.T1, ListTypeList1Form.list1['FormVars']['Format']['TextFirst']))
                $('#list1-form').find('#text-second-txt').text(format_conver_for(sum_page.T2, ListTypeList1Form.list1['FormVars']['Format']['TextSecond']))
                $('#list1-form').find('#text-third-txt').text(format_conver_for(sum_page.T3, ListTypeList1Form.list1['FormVars']['Format']['TextThird']))
                $('#list1-form').find('#text-fourth-txt').text(format_conver_for(sum_page.T4, ListTypeList1Form.list1['FormVars']['Format']['TextFourth']))

                $('#list1-form').find('#foot-first-txt').text(format_conver_for(sum_page.F1, ListTypeList1Form.list1['FormVars']['Format']['FootFirst']))
                $('#list1-form').find('#foot-second-txt').text(format_conver_for(sum_page.F2, ListTypeList1Form.list1['FormVars']['Format']['FootSecond']))
                $('#list1-form').find('#foot-third-txt').text(format_conver_for(sum_page.F3, ListTypeList1Form.list1['FormVars']['Format']['FootThird']))
                $('#list1-form').find('#foot-fourth-txt').text(format_conver_for(sum_page.F4, ListTypeList1Form.list1['FormVars']['Format']['FootFourth']))
            }

        }( window.ListTypeList1Form = window.ListTypeList1Form || {}, jQuery ));

        function list1_open(limit = 10, offset = 0, page = 1) {
            let html = [];
            $('#modal-list1').data('limit', limit);
            $('#modal-list1').data('offset', offset);
            $('#modal-list1').data('page', page);

            document.getElementById('list1-table-body').innerHTML =  `<tr><td class="text-center" colspan="${ListTypeList1Form.list1.ListVars['Count']}">검색 중...</td></tr>` ;

            deactivate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})

            $.when(get_api_data(ListTypeList1Form.list1['General']['PageApi'], ListTypeList1Form.get_list1_parameter(limit, offset))).done(function(response) {
                let d = response.data
                console.log(d)
                if ( d.BodyPage ) {
                    make_pagination('list1', d.PageVars.QueryCnt, page);
                    let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                    for (let i in d.BodyPage) {
                        html.push(
                        `<tr>
                            <td class="text-${ListTypeList1Form.list1.ListVars['Align'].$Radio} px-import-0">
                                <input name="list1-cursor-state" type="radio" value="1" tabindex="-1"
                                class="text-${ListTypeList1Form.list1.ListVars['Align'].$Radio}">
                            </td>
                            <td
                                class="text-${ListTypeList1Form.list1.ListVars['Align'].No}" ${ListTypeList1Form.list1.ListVars['Hidden'].No}>${no--}
                            </td>
                        `)
                        for (const key in ListTypeList1Form.list1.ListVars['Title']) {
                            if (key === '$Radio' || key === '$Check' || key === 'No') { continue }
                            html.push ( `
                                <td
                                    class="text-${ListTypeList1Form.list1.ListVars['Align'][key]}" ${ListTypeList1Form.list1.ListVars['Hidden'][key]}>${format_conver_for(d.BodyPage[i][key], ListTypeList1Form.list1.ListVars['Format'][key])}
                                </td>` )
                        }
                        html.push ( `</tr>` )
                    }
                    ListTypeList1Form.set_head_and_foot_ui(d.SumPage[0])
                } else {
                    html.push( `<tr><td class="text-center" colspan="${ListTypeList1Form.list1.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` )
                    make_pagination('list1', 1, 1 );
                }
                // $('#modal-select-popup .modal-body .pagination .page-item.active .page-link').addClass('bg-danger-10 border-danger-10')

                activate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})

                document.getElementById('list1-table-body').innerHTML = html.join('');
            })
        }
    </script>
@endpush
@endonce

