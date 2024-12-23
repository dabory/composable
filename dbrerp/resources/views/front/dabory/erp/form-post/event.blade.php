<div class="mb-1 pt-2 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary event-act save-button" data-value="save" {{ $formPost['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formPost['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formPost['SelectButtonOptions'],
            'eventClassName' => 'event-act',
        ])
    </div>

    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
</div>

<div class="card mb-0 pb-0" id="event-form">
    <div class="row m-1" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        @php
            $collection = collect($formPost['FormPostVars']['Title']);
            $chunk = $collection->splice($formPost['DisplayVars']['Chunk'] + 1);
            if ($formPost['DisplayVars']['Chunk'] == 999) {
                $cardWidth = [12, 0];
            } else {
                $cardWidth = [8, 4];
            }
        @endphp
        @foreach([$collection->all(), $chunk->all()] as $key => $chunk)
            <div class="{{ 'col-md-'.$cardWidth[$key] }} col-12 card-header-item px-0">
                <div class="card card-primary mb-1 mb-md-0 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2"></div>

                    <div class="card-body">

                        @foreach($chunk as $key => $title)
                            @empty ($formPost['FormPostVars']['Ui'][$key]) @continue @endempty
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0">{{ $title }}</label>
                            @switch($formPost['FormPostVars']['Ui'][$key])
                                @case('select')
                                    <select id="{{ $key }}" class="rounded w-100"
                                            maxlength="{{ $formPost['FormPostVars']['MaxLength'][$key] }}"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>

                                        @foreach($formPost[$formPost['FormPostVars']['Format'][$key]] as $option)
                                        <option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) ?? $option['Caption'] }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                @case('checkbox')
                                    <input type="checkbox" id="{{ $key }}" class="rounded" value="1"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    @break
                                @case('text')
                                    <input type="text" id="{{ $key }}" class="rounded w-100" autocomplete="off"
                                           maxlength="{{ $formPost['FormPostVars']['MaxLength'][$key] }}"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    @break
                                @case('date')
                                    <input type="date" id="{{ $key }}" class="rounded w-100"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    @break
                                @case('time')
                                    <input type="time" id="{{ $key }}" class="rounded w-100"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    @break
                                @case('datetime')
                                    <input type="text" id="{{ $key }}" name="datetime" class="rounded w-100"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    @break
                                @case('editor')
                                    <div id="modal-memo">
                                        @include('components.web-editor')
                                    </div>
                                    @break
                                @case('textarea')
                                    <textarea id="{{ $key }}" maxlength="{{ $formPost['FormPostVars']['MaxLength'][$key] }}"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}></textarea>
                                    @break
                                @case('media')
                                    <div class="d-flex">
                                        <input type="hidden" id="{{ $key }}">
                                        <input type="text" id="{{ $key . '-file-path' }}" class="rounded w-100 radius-r0" autocomplete="off"
                                               maxlength="{{ $formPost['FormPostVars']['MaxLength'][$key] }}"
                                            {{ $formPost['FormPostVars']['Required'][$key] }}>
                                        <button class="text-white rounded border-0 radius-l0 col-3 bg-green-600 border-green-600" onclick="FormPostEvent.show_media_modal()">찾기</button>
                                    </div>
                                    <div class="form-post-title">
                                        <div class="form-post-img-div">
                                            <img id="{{ $key . '-img' }}" class="mt-2 form-post-img" src="">
                                        </div>
                                    </div>
                                @break
                                @default
                            @endswitch
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="pt-0 mt-1 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary event-act save-button" data-value="save" {{ $formPost['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formPost['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formPost['SelectButtonOptions'],
            'eventClassName' => 'event-act',
        ])
    </div>
</div>

@once
@push('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="{{ csset('/js/components/web-editor.js') }}"></script>
    <script>
        $(document).ready(async function() {
            mediaModal = await include_media_library('media-body', 'post')

            $('input[name="datetime"]').daterangepicker({
                locale: {
                    applyLabel: "확인",
                    cancelLabel: "취소",
                    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
                    monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                    format: "YYYY-MM-DD HH:mm:ss"
                },
                drops: 'auto',
                timePicker24Hour: true,
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                applyButtonClasses: "btn-apply"
            });

            $('#dbupdate-form').find('#dbupdate-date').val(date_to_sting(new Date()))

            $('.event-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': FormPostEvent.btn_act_save(); break;
                    case 'del': FormPostEvent.btn_act_del(); break;
                    case 'copy': FormPostEvent.btn_act_copy(); break;
                    case 'new': FormPostEvent.btn_act_new(); break;
                }
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list) {
                $('#MediaId').val(id_list[0])
                FormPostEvent.set_featured_image(file_url_list[0])
            });
        });

        (function( FormPostEvent, $, undefined ) {
            FormPostEvent.formA = {!! json_encode($formPost) !!}

            FormPostEvent.show_media_modal = function () {
                $('#modal-media').data('target-id', '')
                PopupForm1FormBMediaForm.btn_act_new();
                $('#modal-media-btn').data('target', 'media')
                $('#modal-media-btn').data('variable', mediaModal)
                $('#modal-media-btn').trigger('click')
            }

            FormPostEvent.set_featured_image = function (file_path) {
                $('#MediaId-file-path').val(file_path)
                $('#MediaId-img').attr('src', window.env['MEDIA_URL'] + file_path)
                $('#MediaId-img').prop('hidden', false)
            }

            FormPostEvent.btn_act_del = function () {
                Atype.btn_act_del('#event-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'FormPostEvent')
            }

            FormPostEvent.btn_act_copy = function () {
                Atype.btn_act_copy('#event-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'FormPostEvent')
            }

            FormPostEvent.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup .modal-header').addClass('bg-green-600 border-green-600')
                $('#modal-select-popup .modal-body .btn-group > button').addClass('bg-green-600 border-green-600 bg-green-600-hover')

                $('#modal-select-popup.form-post-standard .modal-dialog').css('maxWidth', FormPostEvent.formA['DisplayVars']['Width'] + 'px');
                Atype.set_parameter_callback(FormPostEvent.parameter)

                $('#MediaId-img').attr('src', '')
                $('#MediaId-img').prop('hidden', true)

                $('#event-form').find('.fr-view').html('')
                Atype.btn_act_new('#event-form #frm')
            }

            FormPostEvent.btn_act_save = function () {
                // 저장할 때 조건
                if ($('#Pc4').val() > $('#Pc5').val()) {
                    return iziToast.info({ title: 'Info', message: '현재 종료일자를 시작일자보다 이전날짜를 입력했습니다.' })
                }

                Atype.btn_act_save('#event-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'FormPostEvent');
            }

            FormPostEvent.parameter = function () {
                const id = Number($('#event-form').find('#Id').val())
                let parameter = { Id: id, UserId: window.User['UserId'] }

                for (const key in FormPostEvent.formA['FormPostVars']['Title']) {
                    if (isEmpty(FormPostEvent.formA['FormPostVars']['Type'][key])) { continue }

                    let result
                    const value = $('#event-form').find(`#${key}`).val()
                    const format = FormPostEvent.formA['FormPostVars']['Type'][key]
                    switch (format) {
                        case 'YYYY-MM-DD': case 'YYYY.MM.DD': case 'YYYYMMDD':
                        case 'YY-MM-DD': case 'YY.MM.DD': case 'YYMMDD':
                        case 'yy-mm-dd': case 'yy.mm.dd': case 'yymmdd':
                            result = moment(value).format(format);
                            break;
                        case 'string':
                            result = String(value)
                            break;
                        case 'number':
                            result = Number(value)
                            break;
                        case 'check':
                            result = $('#event-form').find(`#${key}`).prop('checked') ? '1': '0'
                            break;
                        case 'editor':
                            const editor = new FroalaEditor("#event-form #froala-editor", { key: window.env['FROALA_LICENSE_KEY'], attribution: false })
                            if (editor.codeView.isActive()) {
                                result = editor.codeView.get()
                                editor.codeView.toggle()
                            } else {
                                result = editor.html.get()
                            }
                            break;
                        default:
                            break;
                    }

                    parameter[key] = result
                }

                if (id < 0) {
                    parameter = { Id: id }
                }

                // console.log(parameter)
                return parameter;
            }

            FormPostEvent.btn_act_new_callback = function () {
                FormPostEvent.btn_act_new()
                Atype.set_parameter_callback(FormPostEvent.parameter);
            }

            FormPostEvent.show_popup_callback = async function (id, c1) {
                FormPostEvent.btn_act_new()
                await FormPostEvent.fetch_standard(Number(id));
            }

            FormPostEvent.fetch_standard = async function (id) {
                let response = await get_api_data(FormPostEvent.formA['General']['PickApi'], {
                    QueryVars: {
                        QueryName: FormPostEvent.formA['General']['QueryName'],
                        SimpleFilter: `mx.id=${id}`
                    },
                    PageVars: {
                        Limit: 1
                    }
                })
                // console.log(response)

                FormPostEvent.set_standard_ui(response)
            }

            FormPostEvent.set_standard_ui = async function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let post = response.data.Page[0];
                if (post['MediaId']) {
                    const response = await get_api_data('media-pick', {
                        Page: [ { Id: Number(post['MediaId']) } ]
                    })

                    const page = response.data['Page']
                    if (page) {
                        const file_url = page[0]['FileUrl']
                        FormPostEvent.set_featured_image(file_url)
                    }

                }

                $('#event-form').find('#Id').val(post.Id)
                for (const key in FormPostEvent.formA['FormPostVars']['Title']) {
                    if (isEmpty(FormPostEvent.formA['FormPostVars']['Ui'][key])) { continue }

                    if (FormPostEvent.formA['FormPostVars']['Ui'][key] === 'editor') {
                        $('#event-form').find('.fr-view').html(post[key])
                    } else if (FormPostEvent.formA['FormPostVars']['Ui'][key] === 'checkbox') {
                        $('#event-form').find(`#${key}`).prop('checked', post[key] === '1')
                    } else {
                        let value = format_conver_for(post[key], FormPostEvent.formA['FormPostVars']['Format'][key])
                        $('#event-form').find(`#${key}`).val(value)
                    }
                }
            }

        }( window.FormPostEvent = window.FormPostEvent || {}, jQuery ));

        let mediaModal
    </script>
@endpush
@endonce
