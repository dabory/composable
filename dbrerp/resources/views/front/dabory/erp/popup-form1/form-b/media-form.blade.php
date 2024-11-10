{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" {{ count($formB['HeadSelectOptions']) <= 3 ? 'hidden' : '' }}
        class="btn btn-success btn-open-modal"
        data-target="slip"
        data-clicked="Btype.fetch_slip_form_book"
        data-variable="accSlipModal">
        <i class="icon-folder-open"></i>
    </button>
{{--    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">--}}
{{--        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>--}}
{{--            Loading...--}}
{{--    </button>--}}
        <div class="btn-group media-btn-group">
            @php
                if ($formB['FormVars']['Hidden']['SaveButton'] == 'hidden') {
                    $firstHeadOpt = $formB['HeadSelectOptions'][0];
                    $parameter = $firstHeadOpt['ParameterName'] ?? '';
                    $value = $firstHeadOpt['Value'];
                    $caption = $firstHeadOpt['Caption'];
                    $selectBtns = array_slice($formB['HeadSelectOptions'], 1);
                }
                else {
                    $parameter = '';
                    $value = 'save';
                    $caption = $formB['FormVars']['Title']['SaveButton'];
                    $selectBtns = $formB['HeadSelectOptions'];
                }
            @endphp
            <button type="button" class="btn btn-sm btn-primary media-act save-button"
                    data-parameter="{{ $parameter }}"
                    data-value="{{ $value }}">
                {{ $caption }}
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => $selectBtns,
                'eventClassName' => 'media-act',
            ])
        </div>
</div>

<div class="card" id="media-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                            <div class="col-12 d-flex p-0">
                                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                    onclick="PopupForm1FormBMediaForm.get_last_slip_no(this)">
                                    <span class="icon-cogs"></span>
                                </button>
                                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                       maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                    {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['FileSelect'] }}</label>
                            <input type="file" id="upload-file" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                            onchange="PopupForm1FormBMediaForm.file_upload(this)"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['FileSelect'] }}"
                                {{ $formB['FormVars']['Required']['FileSelect'] }}>
                        </div>
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaClass'] }}</label>
                            <select class="rounded w-100" id="media-class-select"
                                    maxlength="{{ $formB['FormVars']['MaxLength']['MediaClass'] }}"
                                {{ $formB['FormVars']['Required']['MediaClass'] }}>
                                @foreach ($formB['MediaClassOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">
                                        {{ $option['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaName'] }}</label>
                            <input type="text" id="media-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['MediaName'] }}"
                                {{ $formB['FormVars']['Required']['MediaName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['FileUrl'] }}</label>
                            <input type="text" id="file-url-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['FileUrl'] }}"
                                {{ $formB['FormVars']['Required']['FileUrl'] }}>
                        </div>
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaCaption'] }}</label>
                            <input type="text" id="media-caption-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['MediaCaption'] }}"
                                {{ $formB['FormVars']['Required']['MediaCaption'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light"><!--260-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaBrand'] }}</label>
                            <select class="rounded w-100" id="media-brand-select" onchange="PopupForm1FormBMediaForm.change_media_brand()"
                                {{ $formB['FormVars']['Required']['MediaBrand'] }}>
                            </select>
                        </div>
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['FileSize'] }}</label>
                            <input type="text" id="file-size-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['FileSize'] }}"
                                {{ $formB['FormVars']['Required']['FileSize'] }}>
                        </div>
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['LinkLocation'] }}</label>
                            <input type="text" id="link-location-txt" class="rounded w-100" disabled autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['LinkLocation'] }}"
                                {{ $formB['FormVars']['Required']['LinkLocation'] }}>
                        </div>
                        <div class="d-none justify-content-around">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-linked-check"> <label class="mb-0" for="is-linked-check">{{ $formB['FormVars']['Title']['IsLinked'] }}</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-closed-check"> <label class="mb-0" for="is-closed-check">{{ $formB['FormVars']['Title']['IsClosed'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="img-frame" class="text-center">
    </div>

    <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch p-2 border rounded">
        <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FormVars']['Hidden']['UserName'] }}>
                    {{ $formB['FormVars']['Title']['UserName'] }}
                </label>
                <input type="text" class="w-100 w-md-80 rounded text-left" id="UserName" disabled>
            </div>
            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FormVars']['Hidden']['BranchName'] }}>
                    {{ $formB['FormVars']['Title']['BranchName'] }}
                </label>
                <input type="text" class="w-100 w-md-80 rounded text-left" id="BranchName" disabled>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}

@once
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#media-form').find('#upload-file').fileselect()

            PopupForm1FormBMediaForm.get_branch_name()
            $('#media-form').find('#UserName').val(window.User['NickName'])

            $('.media-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save-and-paste': PopupForm1FormBMediaForm.btn_act_save(true); break;
                    case 'save': PopupForm1FormBMediaForm.btn_act_save(); break;
                    case 'new': PopupForm1FormBMediaForm.btn_act_new(); break;
                    case 'delete': PopupForm1FormBMediaForm.btn_act_del(); break;
                }
            });

            await PopupForm1FormBMediaForm.create_media_brand_select_box_options()
            // activate_button_group()
        });

        (function( PopupForm1FormBMediaForm, $, undefined ) {
            PopupForm1FormBMediaForm.formB = {!! json_encode($formB) !!};
            PopupForm1FormBMediaForm.setup;

            PopupForm1FormBMediaForm.create_media_brand_select_box_options = async function () {
                const response = await get_api_data('setup-page', {
                    PageVars: {
                        Query: "setup_code = 'media-body' and is_on_use = '1'",
                        Limit: 9999999, Offset: 0
                    }
                })

                $('#media-form').find('#media-brand-select').append(custom_create_options('BrandCode', 'BrandCode', response.data.Page))

                const setup_json = response.data['Page'].map(setup => {
                    const data = JSON.parse(setup['SetupJson'])
                    data['BrandCode'] = setup['BrandCode']
                    return data
                })
                PopupForm1FormBMediaForm.setup = _.indexBy(setup_json, 'BrandCode');
            }

            PopupForm1FormBMediaForm.get_pluck_file_url = async function (data) {
                const response = await get_api_data(PopupForm1FormBMediaForm.formB['General']['PickApi'], { Page: data });
                const media_page = response.data.Page;

                return _.pluck(media_page, 'FileUrl')
            }

            PopupForm1FormBMediaForm.get_branch_name = async function () {
                const response = await get_api_data('branch-pick', { Page: [ { Id:  window.User['BranchId'] } ] })

                $('#media-form').find('#BranchName').val(response.data.Page[0]['BranchName'])
            }

            PopupForm1FormBMediaForm.btn_act_new = function (media_brand_code = false) {
                input_box_reset_for('#media-form #frm')

                const media_form = $('#media-form')
                if (isEmpty($(media_form).find('#media-brand-select').html())) {
                    iziToast.info({
                        title: 'info',
                        message: '로딩 중입니다. 잠시 기다려 주세요..',
                    });

                    return false
                }

                if (media_brand_code) {
                    $(media_form).find('#media-brand-select').val(media_brand_code)
                    $(media_form).find('#media-brand-select').prop('disabled', true)
                } else {
                    $(media_form).find('#media-brand-select').prop('disabled', false)
                }

                $(media_form).find('#img-frame').empty()
                $('.custom-file-label').text('Choose file...')
                $('.custom-file-label').removeClass('disabled')
                $(media_form).find('#upload-file').prop('disabled', false)
                $(media_form).find('#upload-file').attr('required' , true);
                $(media_form).find('#file-url-txt').prop('disabled', false)
                $(media_form).find('#upload-file').addClass('cursor-pointer')
                $('.media-btn-group button').prop('disabled', false);
                Btype.set_slip_no_btn_abled('#media-form #auto-slip-no-btn')

                PopupForm1FormBMediaForm.get_last_slip_no()

                return true
            }

            PopupForm1FormBMediaForm.btn_act_multi_delete_callback = async function (data, callback) {
                let abs_data = [];
                data.forEach(item => {
                    abs_data.push({ Id: Math.abs(item.Id) })
                });
                let response = await get_api_data(PopupForm1FormBMediaForm.formB['General']['PickApi'], { Page: abs_data });
                const media_page = response.data.Page;
                let file_id_list = _.pluck(response.data.Page, 'Id')
                response = await get_api_data('media-bd-page', {
                    PageVars: {
                        Query: `dbr_media_bd.media_id in (${file_id_list})`
                    }
                })
                const media_bd_page = response.data.Page;
                let file_path_list = [];
                media_page.forEach(media => {
                    const page = media_bd_page.filter(media_bd => media_bd.MediaId == media.Id)
                    file_path_list.push(...PopupForm1FormBMediaForm.get_file_path_list(media.FileUrl, page))
                });

                PopupForm1FormBMediaForm.call_act_api({ HdPage: data }, function () {
                    callback();
                    $.ajax({
                        url: "/file-delete",
                        type:'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            file_path_list: JSON.stringify(file_path_list)
                        },
                        success: function(response) {
                            // console.log(response)
                        },
                    });
                })
            }

            PopupForm1FormBMediaForm.btn_act_new_callback = function () {
                // PopupForm1FormBMediaForm.setup = setup;
                PopupForm1FormBMediaForm.btn_act_new();
            }

            PopupForm1FormBMediaForm.get_last_slip_no = async function ($this) {
                Btype.set_slip_no_btn_disabled('#media-form #auto-slip-no-btn')
                let response = await Btype.get_last_slip_no(PopupForm1FormBMediaForm.formB['QueryVars']['QueryName']);
                $('#media-form').find('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            }

            PopupForm1FormBMediaForm.get_current_setup = function () {
                return PopupForm1FormBMediaForm.setup[$('#media-brand-select').val()]
            }

            PopupForm1FormBMediaForm.change_file_url = function (file_name) {
                const setup = PopupForm1FormBMediaForm.get_current_setup()

                $('#media-form').find('#file-url-txt').val(get_curr_setup_file_path(setup, file_name))
            }

            PopupForm1FormBMediaForm.change_media_brand = function () {
                const file_url = $('#media-form').find('#file-url-txt').val()
                if (isEmpty(file_url)) {
                    return
                }
                const file_url_split = file_url.split('/')
                const file_name = file_url_split[file_url_split.length - 1]

                PopupForm1FormBMediaForm.change_file_url(file_name)
            }

            PopupForm1FormBMediaForm.file_upload = function ($this) {
                const file = $($this)[0].files[0];
                if (isEmpty(file)) {
                    input_box_reset_for('#media-form #frm')
                    return;
                }
                const media_class = PopupForm1FormBMediaForm.media_class_selected(file.type)
                $($this).data('min-type', file.type)
                $('#media-form').find('#file-size-txt').val(Math.round(file.size/1024))


                PopupForm1FormBMediaForm.change_file_url(file.name)
                // let month_year_folder = ''
                //
                // const now = new Date()
                // const month = now.getMonth() + 1
                // if (PopupForm1FormBMediaForm.get_current_setup()['DateFolderType'] === '0') {
                //     month_year_folder = `/${now.getFullYear()}/` + ('00' + month.toString()).slice(-2)
                // } else if (PopupForm1FormBMediaForm.get_current_setup()['DateFolderType'] === '1') {
                //     const day = now.getDate()
                //     month_year_folder = `/${now.getFullYear()}/` + ('00' + month.toString()).slice(-2) + '/' + ('00' + day.toString()).slice(-2)
                // }
                //
                // $('#media-form').find('#file-url-txt').val(`/uploads${month_year_folder}/` + file.name)

                switch (media_class) {
                    case 'image':
                        PopupForm1FormBMediaForm.create_image(file)
                        break;
                    default:
                        $('#media-form').find('#img-frame').empty()
                        break;
                }
            }

            PopupForm1FormBMediaForm.create_image = function (file) {
                const _URL = window.URL || window.webkitURL;
                const img = new Image();
                img.src = _URL.createObjectURL(file);
                $(img).addClass('is-rwd')
                $(img).css('max-width', '100%')

                $('#media-form').find('#img-frame').html(img)
                img.onload = function() {
                    $('#media-form').find('#upload-file').data('width', this.width)
                    $('#media-form').find('#upload-file').data('height', this.height)
                }
            }

            PopupForm1FormBMediaForm.media_class_selected = function (type) {
                let media_class;
                if (type.includes('image')) {
                    media_class = 'image';
                } else if (type.includes('video')) {
                    media_class = 'movie';
                } else if (type.includes('audio')) {
                    media_class = 'audio';
                } else if (type.includes('zip')) {
                    media_class = 'zip';
                } else {
                    media_class = 'document';
                }
                $('#media-form').find('#media-class-select').val(media_class)

                return media_class;
            }

            PopupForm1FormBMediaForm.call_act_api = function (data, callback) {
                $('.media-btn-group button').prop('disabled', true);
                $.when(get_api_data(PopupForm1FormBMediaForm.formB['General']['ActApi'], data))
                .done(function(response) {
                    let d = response.data
                    if (d.HdPage) {
                        callback(d.HdPage[0]);
                    } else {
                        let message = response.data.body ?? $('#api-request-failed-please-check').text();
                        iziToast.error({
                            title: 'Error',
                            message: message,
                        });
                        $('.media-btn-group button').prop('disabled', false);
                    }
                });
            }

            PopupForm1FormBMediaForm.get_parameter = function () {
                const id = Number($('#media-form').find('#Id').val())
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    MediaNo: $('#media-form').find('#auto-slip-no-txt').val(),
                    MediaDate: moment(new Date()).format('YYYYMMDD'),
                    UserId: window.User['UserId'],
                    BranchId: window.User['BranchId'],

                    MediaBrand: $('#media-form').find('#media-brand-select').val(),
                    MediaName: $('#media-form').find('#media-name-txt').val(),
                    FileUrl: $('#media-form').find('#file-url-txt').val(),
                    FileSize: Number($('#media-form').find('#file-size-txt').val()),

                    MediaWidth: Number($('#media-form').find('#upload-file').data('width')),
                    MediaHeight: Number($('#media-form').find('#upload-file').data('height')),
                    MineType: $('#media-form').find('#upload-file').data('min-type'),
                    MediaCaption: $('#media-form').find('#media-caption-txt').val(),
                    LinkLocation: $('#media-form').find('#link-location-txt').val(),

                    IsLinked: $('#media-form').find('#is-linked-check:checked').val() ?? '0',
                    IsClosed: $('#media-form').find('#is-closed-check:checked').val() ?? '0',

                    Ip: window.User['Ip']
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

            PopupForm1FormBMediaForm.get_bd_parameter = function (data) {
                const media_id = Number($('#media-form').find('#Id').val())
                let parameter = {
                    Id: 0,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    MediaId: media_id,
                    ImageType: data['ImageType'],
                    BdFileUrl: data['BdFileUrl'],
                    BdFileSize: data['BdFileSize'],
                    BdWidth: data['BdWidth'],
                    BdHeight: data['BdHeight'],
                }
                if (Id < 0) {
                    parameter = { Id: Id }
                } else if (Id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                return parameter;
            }

            PopupForm1FormBMediaForm.get_media_data = function (file_url) {
                const path_list = file_url.split('/')
                const file_name = path_list[path_list.length - 1]
                const file_path = file_url.split(file_name)[0]

                return {
                    name: file_name,
                    path: file_path,
                    setup: PopupForm1FormBMediaForm.get_current_setup(),
                    type: $('#media-form').find('#media-class-select').val(),
                }
            }

            PopupForm1FormBMediaForm.btn_act_save = async function (paste = false) {
                if (dom_required_check('#media-form #frm input') || dom_required_check('#media-form #frm select')) {
                    iziToast.warning({
                        title: 'Warning',
                        message: $('#required-item-omitted').text(),
                    });
                    return;
                }

                const media = PopupForm1FormBMediaForm.get_media_data($('#media-form').find('#file-url-txt').val());
                // console.log(media)

                const id = Number($('#media-form').find('#Id').val())
                const upload_file = $('#media-form').find('#upload-file')[0].files[0]

                // 화열 선택을 했을 때 파일존재 여부 체크
                if (! isEmpty(upload_file)) {
                    $('.media-btn-group button').prop('disabled', true);
                    const response = await axios.post('/file-exists', {file_path: media['path'] + media['name']});
                    $('.media-btn-group button').prop('disabled', false);
                    if (response.data) {
                        const split_media_name = media['name'].split('.')
                        const change_file_name = media['path'] + split_media_name[0] + '-change.' + split_media_name[1]

                        $('#media-form').find('#file-url-txt').focus()

                        iziToast.error({
                            title: 'Error',
                            message: `화일주소에 화일이 존재합니다. 저장을 원하시면 화일주소 입력창에서 ${media['name']} 이름을 직접 변경해주세요. Ex: ${change_file_name}`,
                        });
                        return;
                    }
                }

                if (id !== 0) {
                    $('.media-btn-group button').prop('disabled', true);
                    // 이미지 수정이고 화일선택이 안비어 있을 때
                    if (! isEmpty(upload_file)) {
                        const media_page = await get_api_data('media-page', {
                            PageVars: {
                                Query: `dbr_media.id=${id}`
                            }
                        })

                        if (isEmpty(media_page.data) || media_page.data.apiStatus) {
                            iziToast.error({
                                title: 'Error', message: media_page.data['body'],
                            });
                            $('.media-btn-group button').prop('disabled', false);
                            return
                        }

                        const media_bd_page = await get_api_data('media-bd-page', {
                            PageVars: {
                                Query: `dbr_media_bd.media_id=${id}`
                            }
                        })

                        let media_bd_act_page = []
                        media_bd_page.data.Page.forEach(function (media_bd) {
                            media_bd_act_page.push({ Id: Number(`-${media_bd['Id']}`) })
                        });

                        const media_bd_act = await get_api_data('media-bd-act', {
                            Page: media_bd_act_page
                        })

                        if (isEmpty(media_bd_act.data) || media_bd_act.data.apiStatus) {
                            iziToast.error({
                                title: 'Error', message: media_bd_act.data['body'],
                            });
                            $('.media-btn-group button').prop('disabled', false);
                            return
                        }

                        const file_delete = await call_local_api('/file-delete', {
                            file_path_list: JSON.stringify(PopupForm1FormBMediaForm.get_file_path_list(media_page.data['Page'][0]['FileUrl'], media_bd_page.data.Page))
                        })

                        $('.media-btn-group button').prop('disabled', false);
                    }
                }

                PopupForm1FormBMediaForm.call_act_api({
                    HdPage: [ PopupForm1FormBMediaForm.get_parameter() ]
                }, function(Hd_page) {
                    set_as_response_id(Hd_page.Id, '#media-form #frm')

                    if (isEmpty(upload_file)) {
                        $('#modal-select-popup.popup-form1-form-b-media-form').modal('hide');
                        return
                    }

                    $('#pace-progress-panel').attr('hidden', false)
                    iziToast.info({
                        title: 'info',
                        message: '파일 업로드중입니다. 잠시 기다려 주세요.. (*움직일 시 파일이 누락될 수 있어요)',
                    });

                    let form = new FormData();
                    form.append('_token', $('meta[name="csrf-token"]').attr('content'))
                    form.append('file', $('#media-form').find('#upload-file')[0].files[0])
                    form.append('media', JSON.stringify(media));
                    $.ajax({
                        url: "/file-upload",
                        type:'POST',
                        data: form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (! isEmptyArr(data)) {
                                PopupForm1FormBMediaForm.call_bd_act_api(data, paste)
                            } else {
                                PopupForm1FormBMediaForm.callback_success()

                                PopupForm1FormBMediaForm.btn_act_new()
                                $('#modal-select-popup.show').trigger('list.requery')
                                $('#modal-select-popup.popup-form1-form-b-media-form').modal('hide')
                            }
			},
                    });
                });
            }

            PopupForm1FormBMediaForm.callback_success = function () {
                $('#pace-progress-panel').attr('hidden', true)
                iziToast.success({
                    title: 'Success', message: $('#action-completed').text(),
                });
            }

            PopupForm1FormBMediaForm.call_bd_act_api = function (data, paste) {
                const bd_page = []
                data.forEach(item => {
                    bd_page.push(PopupForm1FormBMediaForm.get_bd_parameter(item))
                })

                const parameter = {
                    HdPage: [
                        PopupForm1FormBMediaForm.get_parameter(),
                    ],
                    BdPage: bd_page
                }
                PopupForm1FormBMediaForm.call_act_api(parameter, function() {
                    PopupForm1FormBMediaForm.callback_success()

                    PopupForm1FormBMediaForm.btn_act_new()

                    // 미디어 찾기에서 업로드 할 때 바로 이미지 붙여 넣기
                    if (paste && $('#modal-media').hasClass('show')) {
                        PopupForm1FormBMediaForm.paste_image_directly(parameter['HdPage'][0])
                    }

                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.popup-form1-form-b-media-form').modal('hide')
                });
            }

            PopupForm1FormBMediaForm.paste_image_directly = function (media) {
                let file_url_list = [];
                let id_list = [];
                const media_url = window.env['MEDIA_URL']

                file_url_list.push(media['FileUrl'])
                id_list.push(media['Id'])
                const target_id = $('#modal-media').data('target-id')
                if (target_id) {
                    $(target_id).find('.fr-view').append(`<img src="${media_url + media['FileUrl']}">`)
                } else {
                    const unique_key = $('#modal-media').data('unique-key')
                    $('#modal-media').trigger('file.paste', [file_url_list, id_list, unique_key]);
                }
                $('#modal-media.show').modal('hide')
            }

            PopupForm1FormBMediaForm.get_file_path_list = function (file_url, page) {
                let file_path_list = [];

                if (file_url) {
                    file_path_list.push(PopupForm1FormBMediaForm.get_media_data(file_url))
                }
                if (page) {
                    let bd_file_url_list = page.map(function (data) {
                        return PopupForm1FormBMediaForm.get_media_data(data['BdFileUrl']);
                    })
                    file_path_list.push(...bd_file_url_list)
                }

                return file_path_list.map(data => data['path'] + data['name'] );
            }

            PopupForm1FormBMediaForm.btn_act_del = async function () {
                if (befo_del_copy_id() || $('#media-form').find('#Id').val() == 0) {
                    iziToast.error({
                        title: 'Error',
                        message: $('#can-not-delete-in-the-status').text(),
                    });
                    return;
                }

                const id = $('#media-form').find('#Id').val();
                let response = await get_api_data('media-bd-page', {
                    PageVars: {
                        Query: `dbr_media_bd.media_id=${Number(id)}`
                    }
                })

                confirm_message_shw_and_delete(function() {
                    $('#media-form').find('#Id').val( `-${id}` );

                    PopupForm1FormBMediaForm.call_act_api({
                        HdPage: [ PopupForm1FormBMediaForm.get_parameter() ]
                    }, function(Hd_page) {
                        set_as_response_id(Hd_page.Id, '#media-form #frm')
                        iziToast.success({
                            title: 'Success',
                            message: $('#action-completed').text(),
                        });
                        $.ajax({
                            url: "/file-delete",
                            type:'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                file_path_list: JSON.stringify(PopupForm1FormBMediaForm.get_file_path_list($('#media-form').find('#file-url-txt').val(), response.data.Page))
                            },
                            success: function(response) {
                                // console.log(response)
                            },
                        });

                        PopupForm1FormBMediaForm.btn_act_new();
                        $('#modal-select-popup.show').trigger('list.requery')
                        $('#modal-select-popup.popup-form1-form-b-media-form').modal('hide');
                    });
                })
            }

            PopupForm1FormBMediaForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormBMediaForm.btn_act_new()
                await PopupForm1FormBMediaForm.fetch_media(Number(id));
            }

            PopupForm1FormBMediaForm.fetch_media = async function (id) {
                let response = await get_api_data(PopupForm1FormBMediaForm.formB['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormBMediaForm.set_media_ui(response)
            }

            PopupForm1FormBMediaForm.set_media_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                Btype.set_slip_no_btn_disabled('#media-form #auto-slip-no-btn')
                const hd_page = response.data.Page[0];
                // console.log(hd_page)
                const media_form = $('#media-form')

                // $('.custom-file-label').addClass('disabled')
                $(media_form).find('#upload-file').attr('required' , false);

                $(media_form).find('#Id').val(hd_page.Id)
                $(media_form).find('#auto-slip-no-txt').val(hd_page.MediaNo)

                $(media_form).find('#media-brand-select').val(hd_page.MediaBrand)
                $(media_form).find('#media-brand-select').prop('disabled', true)
                // $(media_form).find('#upload-file').prop('disabled', true)
                // $(media_form).find('#upload-file').removeClass('cursor-pointer')
                const media_class = PopupForm1FormBMediaForm.media_class_selected(hd_page.MineType)
                $(media_form).find('#img-frame').html(`
                    <img src="${window.env['MEDIA_URL'] + hd_page.FileUrl}" class="is-rwd" style="max-width: 100%;" onerror="this.style.display='none';">
                `)

                $(media_form).find('#media-name-txt').val(hd_page.MediaName)
                $(media_form).find('#file-url-txt').val(hd_page.FileUrl)
                // $(media_form).find('#file-url-txt').prop('disabled', true)
                $(media_form).find('#media-caption-txt').val(hd_page.MediaCaption)

                $(media_form).find('#file-size-txt').val(hd_page.FileSize)
                $(media_form).find('#link-location-txt').val(hd_page.LinkLocation)

                $(media_form).find('#upload-file').data('width', hd_page.MediaWidth)
                $(media_form).find('#upload-file').data('height', hd_page.MediaHeight)
                $(media_form).find('#upload-file').data('min-type', hd_page.MineType)

                $(media_form).find('#is-linked-check').prop('checked', hd_page.IsLinked == '1')
                $(media_form).find('#is-closed-check').prop('checked', hd_page.IsClosed == '1')
            }


        }( window.PopupForm1FormBMediaForm = window.PopupForm1FormBMediaForm || {}, jQuery ));
    </script>
@endonce
