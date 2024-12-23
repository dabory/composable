@extends('layouts.master')
@section('title', $setupType1['General']['Title'])
@section('content')

<div class="content setupType1">
    <div class="row">
        <div class="col-xl-12">
            <button type="button" id="modal-media-btn" hidden
                    class="btn btn-success btn-open-modal">
            </button>

            <div class="mb-1 pt-2 text-right d-flex justify-content-end">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                </button>
                <div class="btn-group" hidden>
                    <button type="button" class="btn btn-sm btn-primary setupType1-act" data-value="list" {{ $setupType1['FormVars']['Hidden']['ListButton'] }}>
                        {{ $setupType1['FormVars']['Title']['ListButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $setupType1['HeadSelectOptions'],
                        'eventClassName' => 'setupType1-act',
                    ])
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $setupType1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $setupType1['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $setupType1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{--<p class="card-title p-1 ml-2">거래 조건</p>--}}
                                </div>
                                <div class="card-body">
                                    <div class="align-items-center mb-2 d-none">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-excel-column-check"> <label class="mb-0" for="is-excel-column-check"></label>
                                    </div>
                                    @if(isset($setupType1['FormVars']['Display']['SelectPopup']))
                                        <div class="{{ $setupType1['FormVars']['Display']['SelectPopup'] }} flex-column mb-2">
                                            <label class="m-0">{{ $setupType1['FormVars']['Title']['SelectPopup'] }}</label>
                                            <select class="rounded w-100" id="select-popup-select">
                                                @foreach ($setupType1['SelectPopupOptions'] as $popupOption)
                                                    <option value="{{ $popupOption['Caption'] }}" data-component="{{ $popupOption['ModalClassName'] }}"
                                                        data-type="{{ $popupOption['ParameterType'] }}" data-unique="{{ $popupOption['Unique'] }}">
                                                        {{ $popupOption['Caption'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="{{ $setupType1['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                                        <label class="m-0">{{ $setupType1['FormVars']['Title']['FilterOption'] }}</label>
                                        <div class="row">
                                            <div class="col-5 pr-1">
                                                <select class="rounded w-100" id="filter-name-select" onchange="chagne_filter_name_select(this)">
                                                    @foreach ($setupType1['FilterSelectOptions'] as $key => $popupOption)
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

                                    <div class="{{ $setupType1['FormVars']['Display']['SimpleOption'] }} flex-column">
                                        <label class="m-0">{{ $setupType1['FormVars']['Title']['SimpleOption'] }}</label>
                                        <select class="modal-order-by-select rounded w-100" id="simple-filter-select" data-target="setupType1">
                                            @foreach ($setupType1['SimpleSelectOptions'] as $key => $popupOption)
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

                <div class="card-body p-0 mt-2 mx-2" id="modal-setupType1">
                    <div class="table-responsive mt-2" style="height: {{ $setupType1['DisplayVars']['BodyHeight'] }}px">
                        <table class="table-row setupType1-table">
                            <thead id="setupType1-table-head">
                                @include('front.dabory.erp.partial.make-thead', [
                                    'listVars' => $setupType1['ListVars'],
                                    'checkboxName' => 'bd-cud-check'
                                ])
                            </thead>
                            <tbody id="setupType1-table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                        <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="setupType1">
                            @include('front.outline.moption')
                        </select>
                        <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                            <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                            <select class="modal-order-by-select w-100 rounded" data-target="setupType1" id="order-by-select">
                                <option value="{{ $setupType1['OrderByOptions'][0]['Value']}}">{{ $setupType1['OrderByOptions'][0]['Caption']}}</option>
                                <option value="{{ $setupType1['OrderByOptions'][1]['Value']}}">{{ $setupType1['OrderByOptions'][1]['Caption']}}</option>
                            </select>
                        </div>
                        <ul class="pagination pagination-sm"></ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@foreach ($setupType1['SelectPopupOptions'] as $popupOption)
    {{-- @php dd($setupType1['SelectPopupOptions']); @endphp;--}}
    @if (! empty($popupOption['Caption']) && empty($popupOption['TabbedMenuHash']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $setupType1['General']['PageApi']
            ])
        @endpush
    @endif
@endforeach

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css">
@endpush

@section('js')
<script src="{{ csset('/js/components/web-editor.js') }}"></script>
<script src="{{ csset('/js/modals-controller/list-type1/common.js') }}"></script>
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
<script src="{{ csset('/js/utils/setup.js') }}"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1b0c21220a0a5d2f4f4869f1e182bb07&libraries=services"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        window.onload = async function () {
            // console.log(window.CodeTitle)
            make_dynamic_table_css('.setupType1-table', make_dynamic_table_px(setupType1['ListVars']['Size']))

            mediaModal = await include_media_library('media-body', 'post')

            init_display_vars()

            $('.setupType1-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'new': setupType1_new(); break;
                    case 'list': setupType1_list(); break;
                    case 'clear-all-filter': setupType1_clear_all_filter(); break;
                    case 'use': setupType1_use_or_stop('1', 'use'); break;
                    case 'stop': setupType1_use_or_stop('0', 'use'); break;
                    case 'default-use': setupType1_use_or_stop('1', 'default'); break;
                    case 'default-stop': setupType1_use_or_stop('0', 'default'); break;
                }
            });

            $(document).on('hide.bs.modal','#modal-select-popup', function () {
                setupType1_list()
            });

            activate_button_group();
        }

        function show_media_modal() {
            PopupForm1FormBMediaForm.btn_act_new();
            $('#modal-media-btn').data('target', 'media')
            $('#modal-media-btn').data('variable', mediaModal)
            $('#modal-media-btn').trigger('click')
        }

        async function get_checked_id_list(table_id) {
            let data = [];
            let response = await get_api_data(setupType1['General']['PageApi'], get_setup_type1_parameter($('#modal-setupType1').data('limit'), $('#modal-setupType1').data('offset')))
            let page = response.data.Page;

            $(table_id).find(`input[name='bd-cud-check']`).each(function(index) {
                if ($(this).is(':checked')) {
                    if (page[index].Id == 0) return true;
                    data.push(page[index].Id);
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

        async function setupType1_use_or_stop(value, type) {
            const id_list = await get_checked_id_list('.setupType1-table')
            if (! id_list) return;


            const data = id_list.map(function (id) {
                let para = { Id: Number(id) }
            switch (type) {
                    case 'use':
                        para['IsOnUse'] = value
                        break;
                    case 'default':
                        para['IsDefault'] = value
                        break;
                }

                return para
            })

            const response = await get_api_data(setupType1['General']['ActApi'], { Page: data });
            if (response.data.Page) {
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
                setupType1_list()
            } else {
                let message = response.data.body ?? $('#api-request-failed-please-check').text();
                iziToast.error({
                    title: 'Error',
                    message: message,
                });
            }
        }

        function chagne_filter_name_select($this) {
            $('.setupType1').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
        }

        function override_enter_pressed_auto_search(event) {
            set_filter_option(event)
            window.enter_pressed_auto_search(event, function () {
                // $('.setupType1').find('#filter-value-txt').data('value', $(event.target).val())

                // if ($('.setupType1').find('#filter-name-select option:selected').data('reverse')) {
                //     const value = format_conver_for($(event.target).val(), $('.setupType1').find('#filter-name-select option:selected').data('reverse'))

                //     $('.setupType1').find('#filter-value-txt').data('value', value)
                // }
                setupType1_list()
            })
        }

        function converter_setup_data(popup_option) {
            if(isThemeSetup){
                const dabory_path = "{{ daboryPath('themes/' . env('DBR_THEME'))}}";
                popup_option['BladeRoute'] = `.erp.resources.views.${popup_option['Component']}`;
            }else{
                popup_option['BladeRoute'] = `front.dabory.erp.${popup_option['Component']}`;
            }

            // console.log('popup_option : ', popup_option);
            popup_option['ModalClassName'] = paramCase(popup_option['Component']);
            return popup_option;
        }

        async function show_select_popup(id, c1) {
            let setup_pick;
            if(isThemeSetup){
                setup_pick = 'theme-setup-pick'
                var theme = "{{ env('DBR_THEME') }}";
                var theme_dir = setup_pick === 'theme-setup-pick' ? `${theme}/erp` : '';
                console.log(theme_dir);
            }else{
                setup_pick = 'setup-pick'
            }

            if ($('.setupType1-table').find('#c1-tag').prop('disabled')) return;
            $('.setupType1-table').find(`input[name='bd-cursor-state']`).prop('disabled', true)
            $('.setupType1-table').find('#c1-tag').prop('disabled', true);

            // let response = await get_api_data('setup-pick', {
            //     Page: [ { Id: Number(id) } ]
            // })

            let response = await get_api_data(setup_pick, {
                Page: [ { Id: Number(id) } ]
            });

            console.log(response);

            let setup = response.data.Page[0]
            let setup_json = setup.SetupJson ? JSON.parse(setup.SetupJson) : {}
            const brand_code = setup.BrandCode
            const parameter_type = camelCase(setup['Parameter'].split('/')[3])

            setup = converter_setup_data({
                Caption: setup['SetupName'],
                Component: setup['Component'],
                ParameterDir: setup['Parameter'],
                ParameterType: parameter_type,
            })

            // response = await get_para_data(setup['ParameterType'], setup['ParameterDir'], getParameterByName('bpa'))
            response = await get_para_data(setup['ParameterType'], setup['ParameterDir'], getParameterByName('bpa'), theme_dir)
            setup['Parameter'] = response['data']['data']

            get_blades_html('front.outline.static.select-popup', setup, async function (html) {
                if (! $('#element_in_which_to_insert').find(`#${setup['ModalClassName']}`).length) {
                    $('#element_in_which_to_insert').append(html);
                    // $('#modal-select-popup .modal-body button').addClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    // $('#modal-select-popup .modal-body thead th').addClass('bg-grey-700')
                    $('#modal-select-popup .modal-body button').addClass('bg-original-purple border-original-purple bg-original-purple-hover')
                    $('#modal-select-popup .modal-body thead th').addClass('bg-original-purple')
                }

                $(`#modal-select-popup.${setup['ModalClassName']}`).find('#myModalLabel').text(setup['Caption'])
                await eval(capitalize(camelCase(setup['ModalClassName']))).show_popup_callback(id, setup_json, brand_code);
                $(`#modal-select-popup.${setup['ModalClassName']}`).modal('show')
            }, 'popupOption');
        }

        function init_display_vars() {
            if (setupType1['DisplayVars']['IsExcelColumn']) {
                $('.setupType1').find('#is-excel-column-check').prop('checked', setupType1['DisplayVars']['IsExcelColumn'])
                Type1.set_excel_column(setupType1, '.setupType1 #is-excel-column-check', '#modal-setupType1 #setupType1-table-head')
            }

            $('#modal-setupType1').find('.modal-line-select').val(setupType1['DisplayVars']['InitLines'])
            $('#modal-setupType1').data('limit', setupType1['DisplayVars']['InitLines'])

            if (setupType1['DisplayVars']['IsListFirst']) {
                setupType1_list();
            }
        }

        function get_setup_type1_parameter(limit, offset) {
            let parameter = {
                QueryVars: {
                    QueryName: setupType1['QueryVars']['QueryName']
                },
                ListType1Vars: {
                    ListToken: '',

                    FilterDate: setupType1['QueryVars']['FilterDate'],

                    OrderBy: $('.setupType1').find('#order-by-select').val(),

                    ListFilterName: $('.setupType1').find('#filter-name-select').val(),
                    ListFilterValue: $('.setupType1').find('#filter-value-txt').data('value'),
                    ListSimpleFilter: $('.setupType1').find('#simple-filter-select').val(),
                },
                PageVars: {
                    Limit: parseInt(limit),
                    Offset: parseInt(offset),
                }
            }
            return parameter;
        }

        function setupType1_list() {
            setupType1_open(
                $('#modal-setupType1').data('limit'),
                $('#modal-setupType1').data('offset'),
                $('#modal-setupType1').data('page')
            );
        }

        function setupType1_new() {
            const modal_class_name = $('#select-popup-select option:selected').data('component');
            console.log('modal_class_name : ', modal_class_name);
            console.log('modal_class_name : ', eval(capitalize(camelCase(modal_class_name))));
            const result = eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()

            if (result != -1) {
                $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
                $(`#modal-select-popup.${modal_class_name}`).modal('show')
            }
        }

        function setupType1_clear_all_filter() {
            input_box_reset_for('#frm')
            input_box_reset_for('#modal-setupType1')
            init_display_vars()

            // table body 초기화
            make_pagination('setupType1', 1, 1 );
            $('#modal-setupType1').find('.modal-line-select').val(setupType1['DisplayVars']['InitLines'])
            $('#modal-setupType1').data('limit', setupType1['DisplayVars']['InitLines']),
            $('#modal-setupType1').data('offset', 0),
            $('#modal-setupType1').data('page', 1),
            $('#setupType1-table-body').html('');
        }

        function c1_popup_conver_for(id, c1) {
            let result;
            switch (setupType1.DisplayVars.IsC1Popup) {
                case '1':
                case '2':
                    result = `
                    <a href="#" id="c1-tag" onclick="show_select_popup('${id}', '${format_conver_for(c1, 'unique')}')">
                        ${format_conver_for(c1, setupType1.ListVars['Format'].C1)}
                    </a>`;
                    break;
                default:
                    result = format_conver_for(c1, setupType1.ListVars['Format'].C1)
                    break;
            }

            return result;
        }

        function setupType1_open(limit = 10, offset = 0, page = 1) {
            let html = [];
            $('#modal-setupType1').data('limit', limit);
            $('#modal-setupType1').data('offset', offset);
            $('#modal-setupType1').data('page', page);

            $.when(get_api_data(setupType1['General']['PageApi'], get_setup_type1_parameter(limit, offset))).done(function(response) {
                let d = response.data
                console.log(d)
                if ( d.Page ) {
                    make_pagination('setupType1', d.PageVars.QueryCnt, page);
                    let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                    for (let i in d.Page) {
                        html.push(
                        `<tr>
                            <td class="text-${setupType1.ListVars['Align'].$Radio} px-import-0" ${setupType1.ListVars['Hidden'].$Radio}>
                                <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                                class="text-${setupType1.ListVars['Align'].$Radio}"
                                onclick="show_select_popup('${d.Page[i].Id}', '${format_conver_for(d.Page[i].C1, 'unique')}')">
                            </td>
                            <td class="text-${setupType1.ListVars['Align'].$Check} px-import-0" ${setupType1.ListVars['Hidden'].$Check}>
                                <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                                class="text-${setupType1.ListVars['Align'].$Check}">
                            </td>
                            <td
                                class="text-${setupType1.ListVars['Align'].No}" ${setupType1.ListVars['Hidden'].No}>${no--}
                            </td>
                            <td
                                class="text-${setupType1.ListVars['Align'].C1}" ${setupType1.ListVars['Hidden'].C1}>${c1_popup_conver_for(d.Page[i].Id, d.Page[i].C1)}
                            </td>
                        `)
                        for (const key in setupType1.ListVars['Title']) {
                            if (key === '$Radio' || key === '$Check' || key === 'No' ||
                                key === 'C1') { continue }
                            html.push ( `
                            <td
                                class="text-${setupType1.ListVars['Align'][key]}" ${setupType1.ListVars['Hidden'][key]}>${format_conver_for(d.Page[i][key], setupType1.ListVars['Format'][key])}
                            </td>` )
                        }
                        html.push ( `</tr>` )
                    }
                } else {
                    html.push( `<tr><td class="text-center" colspan="${setupType1.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` )
                    make_pagination('setupType1', 1, 1 );
                }
                document.getElementById('setupType1-table-body').innerHTML = html.join('');
            })
        }

        function set_filter_option(event){
            $('.setupType1').find('#filter-value-txt').data('value', $(event.target).val())

            if ($('.setupType1').find('#filter-name-select option:selected').data('reverse')) {
                const value = format_conver_for($(event.target).val(), $('.setupType1').find('#filter-name-select option:selected').data('reverse'))

                $('.setupType1').find('#filter-value-txt').data('value', value)
            }
        }

        let mediaModal;
        const setupType1 = {!! json_encode($setupType1) !!};
        let isThemeSetup = setupType1.DisplayVars.IsThemeSetup;
    </script>
@endsection
