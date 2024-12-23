<div id="kibana-type1-form">
{{--    <div class="card mb-1" {{ $list1['FormVars']['Hidden']['HeadFirst'] }}>--}}
{{--        <div class="row text-center">--}}
{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadFirst'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadFirst'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="head-first-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadSecond'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadSecond'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="head-second-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadThird'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadThird'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="head-third-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['HeadFourth'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['HeadFourth'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="head-fourth-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
                            <div class="d-flex">
                                <input class="rounded overflow-hidden w-100 text-nowrap" id="list1-start-date" type="date" value="1990-01-01">
                                <label class="btn disabled p-1 text-center">~</label>
                                <input class="rounded overflow-hidden w-100 text-nowrap" id="list1-end-date" type="date" value="3000-12-31">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 card-header-item px-2">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $list1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                        </div>
{{--                        <div class="card-body">--}}
{{--                            <div class="align-items-center mb-2 d-none">--}}
{{--                                <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-excel-column-check"> <label class="mb-0" for="list1-is-excel-column-check"></label>--}}
{{--                            </div>--}}
{{--                            <div class="align-items-center mb-2 {{ $list1['FormVars']['Display']['DownloadList'] }}">--}}
{{--                                <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-download-list-check"> <label class="mb-0" for="list1-is-download-list-check">{{ $list1['FormVars']['Title']['DownloadList'] }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="align-items-center {{  $list1['FormVars']['Display']['ShowOnlyClosed'] }}">--}}
{{--                                <input type="checkbox" value="1" class="text-center mr-1" id="list1-is-show-only-closed-check"> <label class="mb-0" for="list1-is-show-only-closed-check">{{ $list1['FormVars']['Title']['ShowOnlyClosed'] }}</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        @if ($list1['DisplayVars']['BodyHeight'] !== 'd-none')
            <div class="card-body p-0 mt-2 mx-2" id="modal-list1">

{{--                <iframe src="https://kibana-seoul-a.daboryhost.com:5601/app/kibana#/dashboard/b8d26e10-164f-11ee-a283-e1f69ada928d?embed=true&_a=(description:'',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),panels:!((embeddableConfig:(),gridData:(h:17,i:'1d696a03-41da-4e05-8b7f-5aed3dc34284',w:48,x:0,y:0),id:'987c8970-164f-11ee-a283-e1f69ada928d',panelIndex:'1d696a03-41da-4e05-8b7f-5aed3dc34284',type:lens,version:'7.6.1')),query:(language:kuery,query:'$query'),timeRestore:!f,title:%5Berp_sorder%5D,viewMode:edit)&_g=(refreshInterval:(pause:!f,value:900000),time:(from:'$from',to:'$to'))" height="600" width="800"></iframe>--}}
{{--                <iframe src="" id="kibana-iframe"--}}
{{--                        height="550" width="100%"></iframe>--}}
            </div>

        @endif
    </div>

{{--    <div class="card mb-1" {{ $list1['FormVars']['Hidden']['FootFirst'] }}>--}}
{{--        <div class="row text-center">--}}
{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['FootFirst'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootFirst'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="foot-first-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['FootSecond'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootSecond'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="foot-second-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['FootThird'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootThird'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="foot-third-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-3" {{ $list1['FormVars']['Hidden']['FootFourth'] }}>--}}
{{--                <div class="my-2">--}}
{{--                    <span class="text-muted font-size-sm">{{ $list1['FormVars']['Title']['FootFourth'] }}</span>--}}
{{--                    <h5 class="font-weight-semibold mb-0" id="foot-fourth-txt"></h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/list-type1/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.list1-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': ChartsKibanaType1.list1_list(); break;
                    case 'xls-report': ChartsKibanaType1.list1_report('excel'); break;
                    case 'pdf-report': ChartsKibanaType1.list1_report('pdf'); break;
                }
            });

            // activate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})
        });

        (function( ChartsKibanaType1, $, undefined ) {
            ChartsKibanaType1.list1
            ChartsKibanaType1.sum_filter = {
                SumFilterName: '',
                SumFilterValue: ''
            }

            ChartsKibanaType1.calc_date_rang = function (date_val) {
                let firDay, lasDay;
                [firDay, lasDay] = date_range_vending_machine(date_val)

                $('#kibana-type1-form').find('#list1-start-date').val(date_to_sting(firDay))
                $('#kibana-type1-form').find('#list1-end-date').val(date_to_sting(lasDay))
            }

            ChartsKibanaType1.get_kibana_filter_query = function (list_type1_vars) {
                let queryMapperList = [];
                ['First', 'Second', 'Third', 'Fourth'].forEach(i => {
                    queryMapperList.push({
                        field: ChartsKibanaType1.list1['QueryMapper'][i + 'Range'],
                        from: list_type1_vars['Start' + i],
                        to: list_type1_vars['End' + i],
                    })
                });

                let query = queryMapperList.reduce((previousValue, data) => {
                    if (data['from']) {
                        let str = previousValue + `(${data['field']}.keyword >= "${data['from']}"`
                        if (data['to']) {
                            return str + ` and ${data['field']}.keyword <= "${data['to']}") and `
                        }

                        return str + ') and '
                    } else if (data['to']) {
                        return previousValue + `(${data['field']}.keyword <= "${data['to']}") and `
                    } else {
                        return previousValue
                    }
                }, '')

                const client_code = @json(substr(md5(session('user')['OfcCode']), 0, 16));
                query = query +  `(ClientCode.keyword: ${client_code}) and `

                if (list_type1_vars['ListFilterValue']) {
                    query = query +  `(${list_type1_vars['ListFilterName']}.keyword: *${list_type1_vars['ListFilterValue']}*) and `
                }

                if (list_type1_vars['ListSimpleFilter']) {
                    query = query +  `(${list_type1_vars['ListSimpleFilter'].replace(/'/g, '"')})`
                }

                query = query.replace(/\s+and \s*$/, '')
                console.log(query)
                return query
            }

            ChartsKibanaType1.show_popup_callback = async function (parameter, type1_parameter) {
                input_box_reset_for('.charts-kibana-type1.in #kibana-type1-form')
                const list_type1_vars = type1_parameter['ListType1Vars']
                ChartsKibanaType1.list1 = parameter

                const start_date = moment(list_type1_vars['StartDate']).format('YYYY-MM-DD')
                const end_date = moment(list_type1_vars['EndDate']).format('YYYY-MM-DD')

                let iframe_src = ChartsKibanaType1.list1['General']['Iframe']
                    .replace('$from', new Date(start_date).toISOString())
                    .replace('$to', new Date(end_date).toISOString())
                    .replace('$query', ChartsKibanaType1.get_kibana_filter_query(list_type1_vars))

                // const random = generate_random_string(30)
                iframe_src = window.env['KIBANA_URL'] + iframe_src

                $('.charts-kibana-type1.in #modal-list1').html(`<iframe src="${iframe_src}" id="kibana-iframe"
                        height="${ChartsKibanaType1.list1['PopupList1Vars']['PopupHeight']}" width="100%"></iframe>`)

                // $('.charts-kibana-type1.in #kibana-iframe').attr('src', iframe_src)

                $('.charts-kibana-type1.in #kibana-type1-form').find('#list1-start-date').val(start_date)
                $('.charts-kibana-type1.in #kibana-type1-form').find('#list1-end-date').val(end_date)

                ChartsKibanaType1.init_display_vars()
            }

            ChartsKibanaType1.init_display_vars = function () {

                $('#modal-chart-popup.charts-kibana-type1.in .modal-dialog').css('maxWidth', `${ChartsKibanaType1.list1['PopupList1Vars']['PopupWidth']}px`);

                // ChartsKibanaType1.list1_list()
            }

            ChartsKibanaType1.get_list1_parameter = function (limit, offset) {
                let parameter = {
                    QueryVars: {
                        QueryName: ChartsKibanaType1.list1['QueryVars']['QueryName'],
                        IsntPagination: ChartsKibanaType1.list1['DisplayVars']['IsntPagination'],
                    },
                    // PopupList1Vars: {
                    //     PopupFilterName: ChartsKibanaType1.list1['PopupList1Vars']['PopupFilterName'],
                    //     PopupFilterValue: $('#kibana-type1-form').find('#Id').val(),
                    //     SumFilterName: ChartsKibanaType1.sum_filter['SumFilterName'],
                    //     SumFilterValue: ChartsKibanaType1.sum_filter['SumFilterValue'],
                    // },
                    ListType1Vars: {
                        ListToken: '',

                        ListFilterName: ChartsKibanaType1.list1['PopupList1Vars']['PopupFilterName'],
                        ListFilterValue: $('.charts-kibana-type1.in #kibana-type1-form').find('#Id').val(),
                        SumFilterName: ChartsKibanaType1.sum_filter['SumFilterName'],
                        SumFilterValue: ChartsKibanaType1.sum_filter['SumFilterValue'],

                        FilterDate: ChartsKibanaType1.list1['QueryVars']['FilterDate'],
                        StartDate: moment(new Date($('.charts-kibana-type1.in #kibana-type1-form').find('#list1-start-date').val())).format('YYYYMMDD'),
                        EndDate: moment(new Date($('.charts-kibana-type1.in #kibana-type1-form').find('#list1-end-date').val())).format('YYYYMMDD'),

                        IsExcelColumn: $('.charts-kibana-type1.in #kibana-type1-form').find('#list1-is-excel-column-check:checked').val() == '1',
                        IsDownloadList: $('.charts-kibana-type1.in #kibana-type1-form').find('#list1-is-download-list-check:checked').val() == '1',
                        IsShowOnlyClosed: $('.charts-kibana-type1.in #kibana-type1-form').find('#list1-is-show-only-closed-check:checked').val() == '1',

                        Balance: $('.charts-kibana-type1.in #kibana-type1-form').find('.balance-select').val(),

                        OrderBy: $('.charts-kibana-type1.in #kibana-type1-form').find('.modal-order-by-select').val(),
                    },
                    PageVars: {
                        Limit: parseInt(limit),
                        Offset: parseInt(offset),
                    }
                }

                // console.log(parameter)
                return parameter;
            }

            ChartsKibanaType1.set_head_and_foot_ui = function (sum_page) {
                $('.charts-kibana-type1.in #kibana-type1-form').find('#head-first-txt').text(format_conver_for(sum_page.H1, ChartsKibanaType1.list1['FormVars']['Format']['HeadFirst']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#head-second-txt').text(format_conver_for(sum_page.H2, ChartsKibanaType1.list1['FormVars']['Format']['HeadSecond']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#head-third-txt').text(format_conver_for(sum_page.H3, ChartsKibanaType1.list1['FormVars']['Format']['HeadThird']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#head-fourth-txt').text(format_conver_for(sum_page.H4, ChartsKibanaType1.list1['FormVars']['Format']['HeadFourth']))

                $('.charts-kibana-type1.in #kibana-type1-form').find('#column-first-txt').text(format_conver_for(sum_page.C1, ChartsKibanaType1.list1['FormVars']['Format']['ColumnFirst']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#column-second-txt').text(format_conver_for(sum_page.C2, ChartsKibanaType1.list1['FormVars']['Format']['ColumnSecond']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#column-third-txt').text(format_conver_for(sum_page.C3, ChartsKibanaType1.list1['FormVars']['Format']['ColumnThird']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#column-fourth-txt').text(format_conver_for(sum_page.C4, ChartsKibanaType1.list1['FormVars']['Format']['ColumnFourth']))

                $('.charts-kibana-type1.in #kibana-type1-form').find('#text-first-txt').text(format_conver_for(sum_page.T1, ChartsKibanaType1.list1['FormVars']['Format']['TextFirst']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#text-second-txt').text(format_conver_for(sum_page.T2, ChartsKibanaType1.list1['FormVars']['Format']['TextSecond']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#text-third-txt').text(format_conver_for(sum_page.T3, ChartsKibanaType1.list1['FormVars']['Format']['TextThird']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#text-fourth-txt').text(format_conver_for(sum_page.T4, ChartsKibanaType1.list1['FormVars']['Format']['TextFourth']))

                $('.charts-kibana-type1.in #kibana-type1-form').find('#foot-first-txt').text(format_conver_for(sum_page.F1, ChartsKibanaType1.list1['FormVars']['Format']['FootFirst']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#foot-second-txt').text(format_conver_for(sum_page.F2, ChartsKibanaType1.list1['FormVars']['Format']['FootSecond']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#foot-third-txt').text(format_conver_for(sum_page.F3, ChartsKibanaType1.list1['FormVars']['Format']['FootThird']))
                $('.charts-kibana-type1.in #kibana-type1-form').find('#foot-fourth-txt').text(format_conver_for(sum_page.F4, ChartsKibanaType1.list1['FormVars']['Format']['FootFourth']))
            }

        }( window.ChartsKibanaType1 = window.ChartsKibanaType1 || {}, jQuery ));

        function list1_open(limit = 10, offset = 0, page = 1) {
            let html = [];
            $('#modal-list1').data('limit', limit);
            $('#modal-list1').data('offset', offset);
            $('#modal-list1').data('page', page);

            // document.getElementById('list1-table-body').innerHTML =  `<tr><td class="text-center" colspan="${ChartsKibanaType1.list1.ListVars['Count']}">검색 중...</td></tr>` ;

            // deactivate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})

            $.when(get_api_data(ChartsKibanaType1.list1['General']['PageApi'], ChartsKibanaType1.get_list1_parameter(limit, offset))).done(function(response) {
                let d = response.data
                console.log(d)
                if ( d.BodyPage ) {
                    // make_pagination('list1', d.PageVars.QueryCnt, page);
                    // let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                    // for (let i in d.BodyPage) {
                    //     html.push(
                    //     `<tr>
                    //         <td class="text-${ChartsKibanaType1.list1.ListVars['Align'].$Radio} px-import-0">
                    //             <input name="list1-cursor-state" type="radio" value="1" tabindex="-1"
                    //             class="text-${ChartsKibanaType1.list1.ListVars['Align'].$Radio}">
                    //         </td>
                    //         <td
                    //             class="text-${ChartsKibanaType1.list1.ListVars['Align'].No}" ${ChartsKibanaType1.list1.ListVars['Hidden'].No}>${no--}
                    //         </td>
                    //     `)
                    //     for (const key in ChartsKibanaType1.list1.ListVars['Title']) {
                    //         if (key === '$Radio' || key === '$Check' || key === 'No') { continue }
                    //         html.push ( `
                    //             <td
                    //                 class="text-${ChartsKibanaType1.list1.ListVars['Align'][key]}" ${ChartsKibanaType1.list1.ListVars['Hidden'][key]}>${format_conver_for(d.BodyPage[i][key], ChartsKibanaType1.list1.ListVars['Format'][key])}
                    //             </td>` )
                    //     }
                    //     html.push ( `</tr>` )
                    // }
                    ChartsKibanaType1.set_head_and_foot_ui(d.SumPage[0])
                } else {
                    // html.push( `<tr><td class="text-center" colspan="${ChartsKibanaType1.list1.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` )
                    // make_pagination('list1', 1, 1 );
                }
                // $('#modal-select-popup .modal-body .pagination .page-item.active .page-link').addClass('bg-danger-10 border-danger-10')
                //
                activate_button_group({save_spinner_btn: '#list-form-save-spinner-btn', btn_group: '#list-form-btn-group'})

                // document.getElementById('list1-table-body').innerHTML = html.join('');
            })
        }
    </script>
@endpush
@endonce

