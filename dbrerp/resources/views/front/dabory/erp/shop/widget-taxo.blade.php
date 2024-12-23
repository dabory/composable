@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
<div class="content shop">
    <div class="row">
        <div class="col-xl-12">

            <div class="mb-1 pt-2 text-right d-flex justify-content-between align-items-center">
                <div class="text-danger cache-refl-text">
                    캐시삭제(반영)
                </div>
                <div>
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
                            data-variable="itemTaxoModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary widget-taxo-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'widget-taxo-act',
                        ])
                    </div>
                </div>
            </div>

            <div class="card" id="widget-taxo-form">
                <div class="card-header" id="frm">
                    <input type="text" id="real-slip-no-txt" required hidden>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card card-primary mb-3 mb-md-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="Id" name="Id" value="0">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <div class="d-flex">
                                                <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['TaxoCode'] }}</label>
                                                <div class="ml-1" data-toggle="tooltip" data-html="true" title="{{ $formB['General']['Instruction'] }}">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                            </div>
                                            <select class="rounded w-100" id="auto-slip-no-select" onchange="Btype.change_auto_slip_no_select(this)"
                                                {{ $formB['FormVars']['Required']['TaxoCode'] }}>
                                                @foreach($formB['SlipNoOptions'] as $option)
                                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                                @endforeach
                                                <option value="input">직접입력</option>
                                            </select>
                                        </div>

                                        <div class="form-group d-none flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['DirectInput'] }}</label>
                                            <input class="rounded w-100" type="text" id="direct-input-txt" onchange="Btype.change_direct_input_txt(this)">
                                        </div>
                                        <div class="d-none">
                                            <input class="rounded w-100" type="text" id="auto-slip-no-txt" required>
                                        </div>

                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['LangType'] }}</label>
                                            <select class="rounded w-100" id="lang-type-select">
                                                @foreach ($codeTitle['lang-type']['lang-type'] as $key => $lang_type)
                                                    <option value="{{ $lang_type['Code'] }}">
                                                        {{ $lang_type['Title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['DeviceType'] }}</label>
                                            <select class="rounded w-100" id="device-type-select">
                                                @foreach ($codeTitle['device-type']['device-type'] as $key => $device_type)
                                                    <option value="{{ $device_type['Code'] }}">
                                                        {{ $device_type['Title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                            <input class="rounded w-100" type="date" value="" id="widget-taxo-date"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                                {{ $formB['FormVars']['Required']['Date'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card card-info mb-3 mb-md-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['TaxoName'] }}</label>
                                            <input type="text" id="taxo-name-txt" class="rounded w-100" autocomplete="off" value=""
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['TaxoName'] }}"
                                                {{ $formB['FormVars']['Required']['TaxoName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaSize'] }}</label>
                                            <input type="text" id="media-size-txt" class="rounded w-100" autocomplete="off" value=""
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['MediaSize'] }}"
                                                {{ $formB['FormVars']['Required']['MediaSize'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
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
                    <div id="p-quote-eBody">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary mr-1" id="down-btn" onclick="override_seq_no_up_down('down')"
                                data-clicked="">▼
                            </button>
                            <button class="btn btn-primary mr-1" id="up-btn" onclick="override_seq_no_up_down('up')"
                                data-clicked="">▲
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary widget-taxo-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'widget-taxo-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row widget-taxo-table">
                                <thead id="widget-taxo-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="widget-taxo-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            @foreach ($formB['FooterVars']['Title'] as $key => $title)
                                <div class="d-flex align-items-stretch  flex-column  mb-2 mb-md-0 px-2">
                                    <label class="overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden'][$key] }}>
                                        {{ $title }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="{{ $key }}" disabled>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@foreach ($popupOptions as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $formB['General']['PickApi']
            ])
        @endpush
    @endif
@endforeach

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
    @include('front.outline.static.slip', ['moealSetFile' => $itemTaxoModal])
    @include('front.outline.static.memo')
    @include('front.outline.static.memo2')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.widget-taxo-table', make_dynamic_table_px(formB['ListVars']['Size']))

            await get_last_slip_no()
            $('#widget-taxo-date').val(date_to_sting(new Date()))

            $('.widget-taxo-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#widget-taxo-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'copy-to-another': btn_act_copy_to_another(str_replace_hyphen($(this).data('parameter'), '/')); break;
                    case 'delete': Btype.btn_act_del('#widget-taxo-form #frm'); break;
                    case 'save-and-new': Btype.btn_act_save_and_new('#widget-taxo-form #frm'); break;
                }
            });

            $('.widget-taxo-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                    case 'multi-update': override_btn_bd_act_multi_update(); break;
                }
            });

            $('#remarks-txt-area').on('dblclick', function () {
                $('#modal-memo2').find('#memo-textarea').val('')
                $('#modal-memo2').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo2').find('#memo-textarea').val($('#remarks-txt-area').val())
                $('#modal-memo2').modal('show');
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                if (unique_key.includes('#layer-media-id')) {
                    $(unique_key).val(file_url_list[0])
                } else {
                    $(unique_key).val(id_list[0])
                }
                const file_name_split = file_url_list[0].split('/')

                $(unique_key).closest('.form-group').find('.file-upload-btn').text(file_name_split[file_name_split.length - 1])
                $(unique_key).closest('tr').find('.bd-file-url').attr('src', window.env['MEDIA_URL'] + file_url_list[0])
            });

            Btype.change_auto_slip_no_select($('#auto-slip-no-select'))
            activate_button_group()
        }

        async function get_last_slip_no() {
            Btype.set_slip_no_btn_disabled()
            const response = await Btype.get_last_slip_no('widget-taxo');
            $('#real-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function btn_act_copy_to_another(parameter_name) {
            const data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            // $(`#modal-copy-to-another.${parameter_name}`).find('.target-slip-no-txt').data('slip-no', $('#real-slip-no-txt').val())
            $(`#modal-copy-to-another.${parameter_name}`).find('.source-slip-no-txt').val($('#auto-slip-no-txt').val())

            $('.shop').find('.modal-btn').data('target', 'copy-to-another')
            $('.shop').find('.modal-btn').data('variable', data['Parameter'])
            $('.shop').find('.modal-btn').data('class', parameter_name)
            $('.shop').find('.modal-btn').trigger('click')
        }

        async function override_seq_no_up_down(move) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let bd = bd_page[index]

            if (isEmpty(bd) || parseInt($(`#frm`).find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT move UP or DOWN in the status')),
                });
                return;
            }

            let data = {
                BdTableName: 'pro_widget_taxo_bd',
                HdIdName: 'widget_taxo_id',
                HdId: parseInt(bd.WidgetTaxoId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#widget-taxo-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        // start body act btn
        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.widget-taxo-table')
        }

        async function btn_bd_act_add() {
            if (parseInt($(`#frm`).find('#Id').val()) == 0) {
                if (! await Btype.btn_act_add_chain('#widget-taxo-form #frm')) { return }
            }

            if (! Btype.last_item_added_check('#widget-taxo-table-body')) {
                add_tr();
            }
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.widget-taxo-table')
        }

        function get_parameter() {
            let id = parseInt($(`#frm`).find('#Id').val())
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                WidgetTaxoNo: $('#real-slip-no-txt').val(),
                TaxoCode: $('#auto-slip-no-txt').val(),
                LangType: $('#lang-type-select').val(),
                DeviceType: $('#device-type-select').val(),
                TaxoName: $('#taxo-name-txt').val(),
                MediaSize: $('#media-size-txt').val(),
                TaxoDate: moment(new Date($('#widget-taxo-date').val())).format('YYYYMMDD'),
                UserId: window.User['UserId'],
                BranchId: window.User['BranchId'],
                Remarks: $('#remarks-txt-area').val(),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter
        }

        async function data_init() {
            bd_page = [];
            $(`#frm`).find('#Id').val(0)
            $('.save-button').prop('disabled', false)

            $('#modal-memo').find('.fr-view').html('')
            input_box_reset_for('#frm')
            $('#widget-taxo-date').val(date_to_sting(new Date()))

            $('#remarks-txt-area').val('')
            $('#remarks-preview').html('')

            // slip no 초기화
            Btype.exist_slip_no_type(formB['SlipNoOptions'][0]['Value'])

            await get_last_slip_no()

            // table body 초기화
            table_head_check_box_reset('#widget-taxo-table-head')
            $('#widget-taxo-table-body').html('')

            // footer 합계 초기화
            $('#SumTotal').val('')
        }

        function btn_act_new() {
            data_init()
        }

        function get_bd_parameter(bd) {
            // let discount_rate = Btype.discount_rate_calc(parseInt(minusComma(bd.SalesPrc)) * parseInt(minusComma(bd.PquoteQty)), parseInt(bd.PquoteSum));
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                WidgetTaxoId: parseInt(bd.WidgetTaxoId),
                MediaId: parseInt(bd.MediaId),
                SeqNo: bd.SeqNo,
                WidgetDesc: bd.WidgetDesc,
                LinkUrl: bd.LinkUrl,
                IsSkipped: bd.IsSkipped,
                Ip: window.User['Ip']
            }

            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
                delete parameter.CrtUserId;
            } else {
                delete parameter.UpdatedOn;
                delete parameter.UpdUserId;
            }
            return parameter;
        }

        function create_bd_page() {
            let html = []
            const media_url = window.env['MEDIA_URL']

            bd_page.forEach(bd => {
                let file_name = null
                if (bd.BdFileUrl) {
                    const file_name_split = bd.BdFileUrl.split('/')
                    file_name = file_name_split[file_name_split.length - 1]
                }
                html.push (
                `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Check}">
                    </td>
                    <td class="text-${formB.ListVars['Align'].BdFileUrl}">
                        <img class="bd-file-url" style="width: 100px; height: 100px;" src="${media_url + bd.BdFileUrl}" onerror="this.src='/images/folder.jpg'">
                    </td>
                    <td class="text-${formB.ListVars['Align'].MediaId}">
                    <div class="form-group px-2">
                        <input type="hidden" class="media-id-txt" id="media-id-${bd.Id}-txt" value="${bd.MediaId}">
                        <button class="btn bg-grey-700 border-grey-700 bg-grey-700-hover text-white file-upload-btn w-100"
                            onclick="upload_file(this)">
                            ${file_name ? file_name : '미디어 업로드' }
                        </button>
                    </div>
                    </td>
                    <td class="text-${formB.ListVars['Align'].LinkUrl}" ${formB.ListVars['Hidden'].LinkUrl}
                        >
                        <input type="text" class="text-${formB.ListVars['Align'].LinkUrl} border-0 bg-white link_url" value="${bd.LinkUrl}" disabled
                        onchange="Btype.check_the_checkbox_when_changing(this)">
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].WidgetDesc}" ${formB.ListVars['Hidden'].WidgetDesc}>
                        <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                            ondblclick="dblclick_memo_textarea(this, ${bd.Id})" id="memo-textarea-${bd.Id}" role="button" readonly>${remove_tag(bd.WidgetDesc)}</textarea>
                        <div class="fr-view" id="memo-preview-${bd.Id}" hidden>${bd.WidgetDesc}</div>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].IsSkipped}" ${formB.ListVars['Hidden'].IsSkipped}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)"  ${bd.IsSkipped === '1' ? 'checked' : ''}
                        class="text-${formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped" disabled>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].SaveButton}" ${formB.ListVars['Hidden'].SaveButton}>
                        <button class="btn btn-danger" onclick="show_popup('layer', 850, ${bd.Id})">서브위젯 추가</button>
                        <button class="btn btn-primary save-btn" onclick="add_td_last_tap_out(this, ${bd.Id})">저장</button>
                    </td>
                </tr>` )
            });

            $('#SumTotal').val(format_conver_for(bd_page.length, formB.ListVars['Format'].SumAmt));

            document.getElementById('widget-taxo-table-body').innerHTML = html.join('');

            // $('#widget-taxo-table-body').html(html);
        }

        async function add_td_last_tap_out($this) {
            let tr = $($this).closest('tr')
            let index = $(tr).prevAll().length

            bd_page[index].WidgetDesc = $(tr).find('.fr-view').html()
            bd_page[index].LinkUrl = $(tr).find('.link_url').val()
            bd_page[index].MediaId = $(tr).find('.media-id-txt').val()

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (! dom_required_check($(tr).find(`input`))) {
                $(tr).find('.save-btn').attr('disabled', true)
                if ($($this).data('last')) {
                    const seq_no = await Btype.get_last_seq_no('widget-taxo', $('#auto-slip-no-txt').val())
                    bd_page[index].SeqNo = seq_no;
                }

                Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                    bd_page[index].Id = page[0].Id;

                    body_act_success_callback($this, tr);
                    Btype.check_the_checkbox_when_changing($this, false)

                    $('#SumTotal').val(format_conver_for(bd_page.length, formB.ListVars['Format'].SumAmt))

                    $(tr).find('.save-btn').attr('disabled', false)
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('(*)Required item(s) omitted')),
                })
            }
        }

        function body_act_success_callback($this, tr) {
            if ($($this).data('last')) {
                add_tr()
                $($this).data('last', false)
            }
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });
        }

        function override_check_the_checkbox_when_changing($this) {
            let tr = $($this).closest('tr');
            let index = $(tr).prevAll().length

            bd_page[index]['IsSkipped'] = $(tr).find('.is-skipped').prop('checked')  ? '1' : '0'
            $(tr).find(`input[name='bd-cud-check']`).prop('checked', true)
        }

        function dblclick_memo_textarea($this, last_bd_id = 0) {
            $('#modal-memo').find('#froala-editor').data('txtarea_id', '#' + $($this).attr('id'))

            const preview_id = '#memo-preview-' + last_bd_id
            $('#modal-memo').find('#froala-editor').data('preview_id', preview_id)

            $('#modal-memo').find('.fr-view').html($(preview_id).html())
            $('#modal-memo').modal('show');
        }

        async function add_tr() {
            let last_bd_id_inc = 0;
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html = `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Radio}"
                    id="bd-cursor-state-${last_bd_id_inc}"
                    onclick="Btype.bd_cursor_click(this)">
                </td>
                <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check"
                    class="text-${formB.ListVars['Align'].$Check}"
                    type="checkbox" value="1" tabindex="-1">
                </td>
                <td class="text-${formB.ListVars['Align'].BdFileUrl}">
                    <img class="bd-file-url" src="/images/folder.jpg" style="width: 100px; height: 100px;">
                </td>
                <td class="text-${formB.ListVars['Align'].MediaId}">
                    <div class="form-group px-2">
                        <input type="hidden" class="media-id-txt" id="media-id-${last_bd_id_inc}-txt" value="0">
                        <button class="btn bg-grey-700 border-grey-700 bg-grey-700-hover text-white file-upload-btn w-100"
                            onclick="upload_file(this)">
                            미디어 업로드
                        </button>
                    </div>
                </td>
                <td class="text-${formB.ListVars['Align'].LinkUrl}" ${formB.ListVars['Hidden'].LinkUrl}
                    >
                    <input type="text" class="text-${formB.ListVars['Align'].LinkUrl} link_url"
                    onchange="Btype.check_the_checkbox_when_changing(this)">
                </td>
                <td
                    class="text-${formB.ListVars['Align'].WidgetDesc}" ${formB.ListVars['Hidden'].WidgetDesc}>
                    <textarea style="max-height: 30px;" class="rounded w-100 bg-white memo-textarea"
                        ondblclick="dblclick_memo_textarea(this, ${last_bd_id_inc})" id="memo-textarea-${last_bd_id_inc}" role="button" readonly></textarea>
                    <div class="fr-view" id="memo-preview-${last_bd_id_inc}" hidden></div>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].IsSkipped}" ${formB.ListVars['Hidden'].IsSkipped}>
                    <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped">
                </td>
                <td
                    class="text-${formB.ListVars['Align'].SaveButton}" ${formB.ListVars['Hidden'].SaveButton}>
                    <button class="btn btn-danger" onclick="custom_show_popup(this)">서브위젯 추가</button>
                    <button class="btn btn-primary save-btn" data-last=true onclick="add_td_last_tap_out(this, ${last_bd_id_inc})">저장</button>
                </td>
            </tr>`;
            $('#widget-taxo-table-body').append(html)

            await setTimeout( function() {
                $(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
            }, 100)

            bd_page.push({
                cursorId: last_bd_id_inc,
                Id: 0,
                WidgetDesc: '',
                MediaId: 0,
                LinkUrl: '',
                SeqNo: 0,
                WidgetTaxoId: parseInt($(`#frm`).find('#Id').val()),
                IsSkipped: '0',
            })
        }

        function custom_show_popup($this) {
            const tr = $($this).closest('tr');
            const index = $(tr).prevAll().length

            if (bd_page[index].Id === 0) {
                iziToast.error({
                    title: 'Error', message: '저장을 먼저 해주세요',
                })
                return
            }
            show_popup('layer', 850, bd_page[index].Id)
        }

        function upload_file($this) {
            PopupForm1FormBMediaForm.btn_act_new()

            $('#modal-media').data('target-id', '')
            const target_id = '#' + $($this).closest('.form-group').find('input').attr('id')
            $('#modal-media').data('unique-key', target_id)
            $('#modal-media-btn').data('target', 'media')
            $('#modal-media-btn').data('variable', mediaModal)
            $('#modal-media-btn').trigger('click')
        }

        function update_hd_ui(response) {
            console.log(response)
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()
            $('#direct-input-txt').val('')

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            console.log(bd_page)

            $('#Id').val(hd_page.Id)
            $('#real-slip-no-txt').val(hd_page.WidgetTaxoNo)
            Btype.input_auto_slip_no_txt(hd_page.TaxoCode)

            $('#lang-type-select').val(hd_page.LangType)
            $('#device-type-select').val(hd_page.DeviceType)

            $('#widget-taxo-date').val(moment(to_date(hd_page.TaxoDate)).format('YYYY-MM-DD'))

            $('#taxo-name-txt').val(hd_page.TaxoName)
            $('#media-size-txt').val(hd_page.MediaSize)
            $('#remarks-preview').html(hd_page.Remarks)
            $('#remarks-txt-area').val(hd_page.Remarks)

            // table body에 데이터 추가
            create_bd_page();

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide');
        }

        const itemTaxoModal = {!! json_encode($itemTaxoModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var popupOptions = {!! json_encode($popupOptions) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
