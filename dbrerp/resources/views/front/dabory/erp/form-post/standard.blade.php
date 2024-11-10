<div class="mb-1 pt-2 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary standard-act save-button" data-value="save" {{ $formPost['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formPost['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formPost['SelectButtonOptions'],
            'eventClassName' => 'standard-act',
        ])
    </div>

    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
</div>

<div class="card mb-0 pb-0" id="standard-form">
    <div class="row m-1" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <input type="hidden" id="attached-files">
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
                        @if($key === 1)
                            <div class="form-group d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <label class="m-0 mr-1">첨부화일들(이전 업로드 파일 복구 불가)</label>
                                    <button @click="addItem"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="d-flex align-items-center mb-2" v-for="(item, index) in attachedFiles">
                                    <input type="file" @change="handleFileChange(index)"
                                           class="cursor-pointer rounded w-100 form-control-uniform-custom mr-1" style="text-indent: 0;">
                                    <button @click="removeItem(index)"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                        @endif

                        @foreach($chunk as $key => $title)
                            @empty ($formPost['FormPostVars']['Ui'][$key]) @continue @endempty
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0">{{ $title }}</label>
                                @switch($formPost['FormPostVars']['Ui'][$key])
                                    @case('postType')
                                    <select id="{{ $key }}" class="rounded w-100"
                                            maxlength="{{ $formPost['FormPostVars']['MaxLength'][$key] }}"
                                        {{ $formPost['FormPostVars']['Required'][$key] }}>
                                    </select>
                                    @break
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
                                        <button class="text-white rounded border-0 radius-l0 col-3 bg-green-600 border-green-600" onclick="FormPostStandard.show_media_modal()">찾기</button>
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
        <button type="button" class="btn btn-sm btn-primary standard-act save-button" data-value="save" {{ $formPost['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formPost['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formPost['SelectButtonOptions'],
            'eventClassName' => 'standard-act',
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
            const AttachedFiles = new Vue({
                el: '#standard-form',

                data: function () {
                    return {
                        attachedFiles: [null],
                    };
                },

                computed: {
                },

                mounted () {
                },

                methods: {
                    addItem: function () {
                        this.attachedFiles.push(null)
                    },

                    removeItem: function (index) {
                        return this.attachedFiles.splice(index, 1)
                    },

                    handleFileChange: function (index) {
                        const file = event.target.files[0]; // 파일 선택을 받아옴
                        this.$set(this.attachedFiles, index, file); // 파일을 배열에 추가
                    },

                    save: function () {
                        console.log(this.attachedFiles)
                        if (this.attachedFiles.length <= 0 || this.attachedFiles[0] === null) {
                            return Atype.btn_act_save('#standard-form #frm', function () {
                                $('#modal-select-popup.show').trigger('list.requery');
                                $('#modal-select-popup.show').modal('hide');
                            }, 'FormPostStandard');
                        }

                        let form = new FormData();
                        form.append('_token', $('meta[name="csrf-token"]').attr('content'))
                        form.append('fileCount', this.attachedFiles.length)
                        this.attachedFiles.forEach((file, index) => {
                            form.append('file' + index, file)
                        })
                        $.ajax({
                            url: "/post-attached-files",
                            type:'POST',
                            data: form,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                $('#attached-files').val(data)
                                Atype.btn_act_save('#standard-form #frm', function () {
                                    $('#modal-select-popup.show').trigger('list.requery');
                                    $('#modal-select-popup.show').modal('hide');
                                }, 'FormPostStandard');
                            },
                        });
                    }
                }
            });

            $(document).ready(async function() {
                let query = ''
                const postCode = FormPostStandard.formA['General']['PostCode']
                if (postCode) {
                    query = `post_code='${postCode}'`
                    if (postCode === 'integrated') {
                        query = `sort = '400'`
                    }
                }
                const response = await get_api_data('post-type-page', {
                    PageVars: {
                        Query: query,
                        Limit: 100
                    }
                })
                $('#PostTypeId').html(window.custom_create_options('Id', 'TypeTitle', response.data.Page));

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

                $('.standard-act').on('click', function () {
                    switch( $(this).data('value') ) {
                        case 'save': AttachedFiles.save(); break;
                        case 'del': FormPostStandard.btn_act_del(); break;
                        case 'copy': FormPostStandard.btn_act_copy(); break;
                        case 'new': FormPostStandard.btn_act_new(); break;
                    }
                });

                $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list) {
                    $('#MediaId').val(id_list[0])
                    FormPostStandard.set_featured_image(file_url_list[0])
                });
            });

            (function( FormPostStandard, $, undefined ) {
                FormPostStandard.formA = {!! json_encode($formPost) !!}

                    FormPostStandard.show_media_modal = function () {
                    $('#modal-media').data('target-id', '')
                    PopupForm1FormBMediaForm.btn_act_new();
                    $('#modal-media-btn').data('target', 'media')
                    $('#modal-media-btn').data('variable', mediaModal)
                    $('#modal-media-btn').trigger('click')
                }

                FormPostStandard.set_featured_image = function (file_path) {
                    $('#MediaId-file-path').val(file_path)
                    $('#MediaId-img').attr('src', window.env['MEDIA_URL'] + file_path)
                    $('#MediaId-img').prop('hidden', false)
                }

                FormPostStandard.btn_act_del = function () {
                    Atype.btn_act_del('#standard-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'FormPostStandard')
                }

                FormPostStandard.btn_act_copy = function () {
                    Atype.btn_act_copy('#standard-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'FormPostStandard')
                }

                FormPostStandard.btn_act_new = function () {
                    $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                    $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup .modal-header').addClass('bg-green-600 border-green-600')
                    $('#modal-select-popup .modal-body .btn-group > button').addClass('bg-green-600 border-green-600 bg-green-600-hover')

                    $('#modal-select-popup.form-post-standard .modal-dialog').css('maxWidth', FormPostStandard.formA['DisplayVars']['Width'] + 'px');
                    Atype.set_parameter_callback(FormPostStandard.parameter)

                    $('#MediaId-img').attr('src', '')
                    $('#MediaId-img').prop('hidden', true)

                    $('#standard-form').find('.fr-view').html('')
                    Atype.btn_act_new('#standard-form #frm')

                    AttachedFiles.attachedFiles = [ null ]
                }

                FormPostStandard.parameter = function () {
                    const id = Number($('#standard-form').find('#Id').val())
                    let parameter = { Id: id, UserId: window.User['UserId'], AttachedFiles: $('#attached-files').val() }

                    for (const key in FormPostStandard.formA['FormPostVars']['Title']) {
                        if (isEmpty(FormPostStandard.formA['FormPostVars']['Type'][key])) { continue }

                        let result
                        const value = $('#standard-form').find(`#${key}`).val()
                        const format = FormPostStandard.formA['FormPostVars']['Type'][key]
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
                                result = $('#standard-form').find(`#${key}`).prop('checked') ? '1': '0'
                                break;
                            case 'editor':
                                const editor = new FroalaEditor("#standard-form #froala-editor", { key: window.env['FROALA_LICENSE_KEY'], attribution: false })
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

                    console.log(parameter)
                    return parameter;
                }

                FormPostStandard.btn_act_new_callback = function () {
                    FormPostStandard.btn_act_new()
                    Atype.set_parameter_callback(FormPostStandard.parameter);
                }

                FormPostStandard.show_popup_callback = async function (id, c1) {
                    FormPostStandard.btn_act_new()
                    await FormPostStandard.fetch_standard(Number(id));
                }

                FormPostStandard.fetch_standard = async function (id) {
                    let response = await get_api_data(FormPostStandard.formA['General']['PickApi'], {
                        QueryVars: {
                            QueryName: FormPostStandard.formA['General']['QueryName'],
                            SimpleFilter: `mx.id=${id}`
                        },
                        PageVars: {
                            Limit: 1
                        }
                    })
                    // console.log(response)

                    FormPostStandard.set_standard_ui(response)
                }

                FormPostStandard.set_standard_ui = async function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let post = response.data.Page[0];
                    if (post['MediaId']) {
                        const response = await get_api_data('media-pick', {
                            Page: [ { Id: Number(post['MediaId']) } ]
                        })

                        const page = response.data['Page']
                        if (page) {
                            const file_url = page[0]['FileUrl']
                            FormPostStandard.set_featured_image(file_url)
                        }

                    }

                    console.log(post)
                    $('#standard-form').find('#Id').val(post.Id)
                    $('#standard-form').find('#attached-files').val(post.AttachedFiles)
                    for (const key in FormPostStandard.formA['FormPostVars']['Title']) {
                        if (isEmpty(FormPostStandard.formA['FormPostVars']['Ui'][key])) { continue }

                        if (FormPostStandard.formA['FormPostVars']['Ui'][key] === 'editor') {
                            $('#standard-form').find('.fr-view').html(post[key])
                        } else if (FormPostStandard.formA['FormPostVars']['Ui'][key] === 'checkbox') {
                            $('#standard-form').find(`#${key}`).prop('checked', post[key] === '1')
                        } else {
                            let value = format_conver_for(post[key], FormPostStandard.formA['FormPostVars']['Format'][key])
                            $('#standard-form').find(`#${key}`).val(value)
                        }
                    }
                }

            }( window.FormPostStandard = window.FormPostStandard || {}, jQuery ));

            let mediaModal
        </script>
    @endpush
@endonce
