{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-text-template-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <div class="btn-group mr-2" id="text-template-btn-group">
            <button type="button" class="btn btn-sm btn-primary text-template-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => $formA['SelectButtonOptions'],
                'eventClassName' => 'text-template-act',
            ])
        </div>
    </div>

    <div class="mms_wrap" id="text-template-form">
        <div class="mms" id="frm">
            <!-- 상단 버튼 시작 -->
            <ul class="top_btn">
                {{-- <button type="button">sms</button>
                <button type="button">lms</button>
                <button type="button">mms</button> --}}
            </ul>
            <!--// 상단 버튼 끝 -->

            <!-- 핸드폰 영역 시작 -->
            <div class="input_field">
                <input type="hidden" id="Id" name="Id" value="0">
                <div class="txt_byte">
                    <div class="byte-info">
                        <span class="cur-byte">0</span>/999 byte
                    </div>
                </div>

                <div class="input_box">
                    <div class="form-group d-flex flex-column disabled">
                        <label class="m-0">{{ $formA['FormVars']['Title']['TextCode'] }}</label>
                        <input type="text" id="text-code-txt" class="rounded w-100" autocomplete="off"
                               maxlength="{{ $formA['FormVars']['MaxLength']['TextCode'] }}"
                            {{ $formA['FormVars']['Required']['TextCode'] }} readonly>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label class="m-0">{{ $formA['FormVars']['Title']['TextName'] }}</label>
                        <input type="text" id="text-name-txt" class="rounded w-100" autocomplete="off"
                               maxlength="{{ $formA['FormVars']['MaxLength']['TextName'] }}"
                            {{ $formA['FormVars']['Required']['TextName'] }}>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label class="m-0">{{ $formA['FormVars']['Title']['TextTitle'] }}</label>
                        <input type="text" id="text-title-txt" class="rounded w-100" autocomplete="off"
                               maxlength="{{ $formA['FormVars']['MaxLength']['TextTitle'] }}"
                            {{ $formA['FormVars']['Required']['TextTitle'] }}>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                        <select id="sort-select" class="rounded w-100" onchange="PopupSetupFormATextTemplateForm.change_sort_select(this)"
                                maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                            {{ $formA['FormVars']['Required']['Sort'] }}>
                            @foreach ($formA['SortSelectOptions'] as $key => $popupOption)
                                <option value="{{ $popupOption['Value'] }}">
                                    {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <ul class="nav nav-tabs nav-tabs-solid rounded">
                        <li class="nav-item main-text-tab"><a href="#main-text-tab" class="nav-link rounded-left active" data-toggle="tab">{{ $formA['FormVars']['Title']['TextTab'] }}</a></li>
                        <li class="nav-item"><a href="#main-media-tab" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['MediaTab'] }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="main-text-tab" style="height: 430px;">
                            <textarea id="main-text-txt-area" style="height:200px;" onkeyup="PopupSetupFormATextTemplateForm.main_text_keyup(this)"></textarea>
                            <div class="keyboard-btn">
                                <ul class="mid_btn">
                                    @foreach ($formA['ReplaceStringVars'] as $option)
                                        <button type="button" data-value="{{ $option['Value'] }}" onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'ReplaceString')">{{ $option['Value'] }}</button>
                                    @endforeach
                                </ul>

                                <div class="charater">
                                    @foreach ($formA['SpecialCharVars'] as $option)
                                        <button type="button" data-value="{{ $option['Value'] }}" onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'SpecialChar')">{{ $option['Caption'] }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="main-media-tab" style="height: 430px;">
                            <div class="w-100 py-1">
                                <button type="button" class="btn w-100 media-search-btn" onclick="PopupSetupFormATextTemplateForm.find_media()">{{ $formA['FormVars']['Title']['MediaSearchButton'] }}</button>
                            </div>
                            <div id="main-media-group" style="overflow-y: scroll; height: 384px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// 핸드폰 영역 끝 -->

        </div>
    </div>
</div>
{{-- @endsection --}}

@once
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#text-template-btn-group').find('.text-template-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormATextTemplateForm.btn_act_save(); break;
                    case 'del': PopupSetupFormATextTemplateForm.btn_act_del(); break;
                    case 'text-send': PopupSetupFormATextTemplateForm.btn_act_text_send(false); break;
                    case 'text-send-test': PopupSetupFormATextTemplateForm.btn_act_text_send(true); break;
                }
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list) {
                let html = '';
                file_url_list.forEach(src => {
                    html += PopupSetupFormATextTemplateForm.get_media_html('image', src);
                });
                $('#text-template-form').find('#main-media-group').append(html)
            });

        });

        (function( PopupSetupFormATextTemplateForm, $, undefined ) {
            PopupSetupFormATextTemplateForm.formA = {!! json_encode($formA) !!};
            PopupSetupFormATextTemplateForm.parentParameters = [];

            PopupSetupFormATextTemplateForm.btn_act_text_send = async function (test_mode) {
                const list_vars = [
                    'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9', 'C10',
                    'C11', 'C12', 'C13', 'C14', 'C15', 'C16', 'C17', 'C18', 'C19', 'C20',
                    'C21', 'C22', 'C23', 'C24', 'C25', 'C26', 'C27', 'C28', 'C29', 'C30'
                ];

                let response = await get_api_data('list-type1-page', PopupSetupFormATextTemplateForm.parentParameters[0])
                if (! response.data.Page) {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text()
                    iziToast.error({ title: 'Error', message: message, })
                    return
                }

                // response.data.Page c1~c30 외 나머지 필드 제거
                let parameter_page = [];

                response.data.Page.forEach(obj => {
                    let temp_obj = {}
                    list_vars.forEach(c => {
                        if (c === 'C1') {
                            temp_obj[c] = obj[c].replace(/-/g, '')
                        } else {
                            temp_obj[c] = obj[c]
                        }
                    });
                    parameter_page.push(temp_obj)
                });

                // ReplaceStringVars 이용해서 헤더 만들기
                const var_name_list =  ['_mobile_no', ...PopupSetupFormATextTemplateForm.formA['ReplaceStringVars'].map(obj => obj['Value']), '_qr_code', '_image_url']

                let page = [];
                parameter_page.forEach(parameter => {
                    const parameter_zip = _.zip(var_name_list, _.values(parameter));
                    // var_name_list.length 만큼 잘라준다
                    parameter_zip.splice(var_name_list.length)
                    const replace_vars = parameter_zip
                        .map(item => {
                        return {
                            VarName: _.first(item),
                            VarValue: _.last(item) || ''
                        }
                    });
                    page.push({
                        ReplaceVars: replace_vars
                    })
                });

                // 테스트 모드일 때 테스트 번호로 보내기
                if (test_mode) {
                    response = await get_api_data('setup-pick', { Page: [ { SetupCode: 'text-send' } ] })
                    const setup = JSON.parse(response.data.Page[0]['SetupJson'])
                    console.log(setup)
                    _.first(page)['ReplaceVars'].forEach(replace_var => {
                        if (replace_var['VarName'] == '_mobile_no') {
                            replace_var['VarValue'] = setup['TestReceiver']
                        }
                    });
                    page = [ _.first(page) ]
                }
                console.log(page)

                // console.log({
                //     TextVars: {
                //         Email: 'kimhi65@naver.com',
                //         PublicKey: 'IOHvWyD8GyTuDO-o',
                //         BrandCode: 'aligo',
                //         ReservedTime: '',
                //         TemplateCode: $('#text-template-form').find('#text-code-txt').val(),
                //         TemplateTitle: '',
                //         TemplateText: '',
                //         UniqueImage: $('#text-template-form').find('#main-media-group img').first().attr('src') ?? '',
                //     },
                //     Page: page
                // })

                response = await get_api_data('text-send', {
                    TextVars: {
                        Email: 'kimhi65@naver.com',
                        PublicKey: 'IOHvWyD8GyTuDO-o',
                        BrandCode: 'aligo',
                        ReservedTime: '',
                        TemplateCode: $('#text-template-form').find('#text-code-txt').val(),
                        TemplateTitle: '',
                        TemplateText: '',
                        UniqueImage: $('#text-template-form').find('#main-media-group img').first().attr('src') ?? '',
                    },
                    Page: page
                })
                console.log(response)

                if (response.data.message == 'success' || isEmpty(response.data.apiStatus)) {
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.data.body.message ?? response.data.body,
                    });
                }
                // console.log( response )
            }

            PopupSetupFormATextTemplateForm.delete_media = function ($this) {
                confirm_message_shw_and_delete(function() {
                    $($this).closest('.img-frame').remove()
                });
            }

            PopupSetupFormATextTemplateForm.get_media_html = function (type, src) {
                return `
                <div class="position-relative img-frame">
                    <img class="w-100 mb-1" src="${window.env['MEDIA_URL'] + src}" data-media_path="${src}">
                    <button type="button" class="tab-close position-absolute top-0 right-0 color-danger"
                    onclick="PopupSetupFormATextTemplateForm.delete_media(this)">
                        <i class="fas fa-times fa-xs"></i>
                    </button>
                </div>`
            }

            PopupSetupFormATextTemplateForm.find_media = function () {
                $('.content').append(`
                    <button type="button" id="modal-media-btn" hidden
                        class="btn btn-success btn-open-modal">
                    </button>
                `)
                $('#modal-media #media-form button').addClass('bg-primary')
                $('#modal-media').data('fr-view', '#main-media-group')
                $('#modal-media').data('img-class', 'w-100 mb-1')
                PopupForm1FormBMediaForm.btn_act_new();
                $('#modal-media-btn').data('target', 'media')
                $('#modal-media-btn').data('variable', mediaModal)
                $('#modal-media-btn').trigger('click')
            }

            PopupSetupFormATextTemplateForm.change_sort_select = function($this) {
                switch (format_conver_for($($this).val(), "sort('text-template')").toUpperCase()) {
                    case 'MMS':
                        $('#text-template-form').find('.nav-tabs-solid').removeClass('d-none');
                        break;

                    default:
                        $('#text-template-form').find('.nav-tabs-solid').addClass('d-none');
                        $('#text-template-form').find('.nav-tabs-solid .main-text-tab a').trigger('click')
                        break;
                }
            }

            PopupSetupFormATextTemplateForm.btn_act_new_callback = function () {
                PopupSetupFormATextTemplateForm.btn_act_new()
            }

            PopupSetupFormATextTemplateForm.btn_act_new = function () {
                $('#text-template-form').find('#main-media-group').empty();
                $('#modal-select-popup.popup-setup-form-a-text-template-form .modal-dialog').css('maxWidth', '400px');
                Atype.set_parameter_callback(PopupSetupFormATextTemplateForm.parameter);
                Atype.btn_act_new('#text-template-form #frm');

                $('#text-template-form').find('#sort-select').trigger('change')
            }

            PopupSetupFormATextTemplateForm.btn_act_save = function () {
                Atype.btn_act_save('#text-template-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormATextTemplateForm');
            }

            PopupSetupFormATextTemplateForm.btn_act_del = function () {
                Atype.btn_act_del('#text-template-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormATextTemplateForm');
            }

            PopupSetupFormATextTemplateForm.main_text_keyup = function ($this) {
                $('#text-template-form').find('.cur-byte').text(Number( getByte($($this).val()) ))
            }

            PopupSetupFormATextTemplateForm.keyboard_click = function ($this, type) {
                let txt = $('#text-template-form').find('#main-text-txt-area').val();
                let value = $($this).data('value');

                if (type == 'ReplaceString') {
                    value = `{${value}}`
                }
                $('#text-template-form').find('#main-text-txt-area').val(txt + value)
                PopupSetupFormATextTemplateForm.main_text_keyup($('#text-template-form').find('#main-text-txt-area'))
            }

            PopupSetupFormATextTemplateForm.setup_json_data = function () {
                const text_template_form = $('#text-template-form')
                let mms_images = '';
                $('#text-template-form').find('#main-media-group img').each(function () {
                    mms_images += $(this).data('media_path') + ',';
                });

                return {
                    TextCode: $('#text-template-form').find('#text-code-txt').val(),
                    TextName: $('#text-template-form').find('#text-name-txt').val(),
                    TextTitle: $('#text-template-form').find('#text-title-txt').val(),
                    Sort: $('#text-template-form').find('#sort-select').val(),
                    MainText: $('#text-template-form').find('#main-text-txt-area').val(),
                    MmsImages: mms_images.replace(/,$/, ''),
                }
            }


            PopupSetupFormATextTemplateForm.parameter = function () {
                let id = Number($('#text-template-form').find('#Id').val());
                // console.log('save_id : ', id);
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(PopupSetupFormATextTemplateForm.setup_json_data()),
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

            PopupSetupFormATextTemplateForm.show_popup_callback = async function (id, setup_json, brand_code, parameters) {
                PopupSetupFormATextTemplateForm.parentParameters = parameters

                $('#text-template-form').find('#Id').val(id)

                PopupSetupFormATextTemplateForm.btn_act_new()
                // await PopupSetupFormATextTemplateForm.fetch_text_template(Number(id));
                PopupSetupFormATextTemplateForm.set_text_template_ui(id, setup_json);
            }

            PopupSetupFormATextTemplateForm.fetch_text_template = async function (id) {
                let response = await get_api_data(PopupSetupFormATextTemplateForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })
                console.log(response);
                // PopupSetupFormATextTemplateForm.set_text_template_ui(response)
            }

            PopupSetupFormATextTemplateForm.set_text_template_ui = function (id, setup) {
                // if (_.isEmpty(setup)) return;
                // let text_template = {};
                // if(response.data.Page[0]['SetupJson']){
                //     text_template = JSON.parse(response.data.Page[0]['SetupJson']);
                // }
                // const setup_json_data = text_template['setup_json'];
                $('#text-template-form').find('#Id').val(id)
                $('#text-template-form').find('#text-code-txt').val(setup.TextCode)
                $('#text-template-form').find('#text-name-txt').val(setup.TextName)

                $('#text-template-form').find('#text-title-txt').val(setup.TextTitle)
                $('#text-template-form').find('#sort-select').val(setup.Sort)

                $('#text-template-form').find('#main-text-txt-area').val(setup.MainText)
                // $('#text-template-form').find('#main-text-preview').html(text_template.MainText)

                let html = '';
                if (setup.MmsImages) {
                    setup.MmsImages.split(',').forEach(src => {
                        html += PopupSetupFormATextTemplateForm.get_media_html('image', src);
                    });
                }
                $('#text-template-form').find('#main-media-group').html(html)

                PopupSetupFormATextTemplateForm.change_sort_select($('#text-template-form').find('#sort-select'))
                $('#text-template-form').find('.nav-tabs-solid .main-text-tab a').trigger('click')
                PopupSetupFormATextTemplateForm.main_text_keyup($('#text-template-form').find('#main-text-txt-area'))
            }

        }( window.PopupSetupFormATextTemplateForm = window.PopupSetupFormATextTemplateForm || {}, jQuery ));
    </script>
@endonce
