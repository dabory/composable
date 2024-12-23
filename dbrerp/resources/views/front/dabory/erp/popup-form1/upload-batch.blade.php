<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary" id="upload-batch-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div id="upload-batch-btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary upload-batch-act save-button" data-value="save" {{ $uploadBatch['FormVars']['Hidden']['SaveButton'] }}>
            {{ $uploadBatch['FormVars']['Title']['SaveButton'] }}
        </button>
    </div>
</div>

<div class="card mb-2" id="upload-batch">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="mb-2 text-danger">
                            {!! $uploadBatch['NoticeVars']['Notice'] !!}
                        </div>
                        <div class="mb-2">
                            {!! $uploadBatch['NoticeVars']['Warning'] !!}
                        </div>
                        <div class="{{ $uploadBatch['FormVars']['Display']['CurrBatchNo'] }} flex-column mb-2">
                            <label class="m-0">{{ $uploadBatch['FormVars']['Title']['CurrBatchNo'] }}</label>
                            <input type="text" id="curr-batch-no-txt" class="rounded" autocomplete="off">
                        </div>
                        <div class="{{ $uploadBatch['FormVars']['Display']['LastTargetId'] }} flex-column mb-2">
                            <label class="m-0">{{ $uploadBatch['FormVars']['Title']['LastTargetId'] }}</label>
                            <input type="text" id="last-target-id-txt" class="rounded" autocomplete="off">
                        </div>

                        <div class="{{ $uploadBatch['FormVars']['Display']['ImgExtension'] }} flex-column mb-2">
                            <label class="m-0">{{ $uploadBatch['FormVars']['Title']['ImgExtension'] }}</label>
                            <select id="img-extension-select" class="rounded" autocomplete="off" style="width: 250px;">
                                <option value="png">png</option>
                                <option value="jpg">jpg</option>
                                <option value="gif">gif</option>
                                <option value="webp">webp</option>
                            </select>
                        </div>

                        <hr class="{{ $uploadBatch['FormVars']['Display']['ShowList'] }}">

                        <div class="{{ $uploadBatch['FormVars']['Display']['ShowList'] }}  flex-column mb-1">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" onchange="PopupForm1UploadBatch.change_show_list_checkbox(this)" value="1" class="text-center mr-1" id="show-list-check"> <label class="mb-0" for="show-list-check">{{ $uploadBatch['FormVars']['Title']['ShowList'] }}</label>
                            </div>
                        </div>
                        <div class="flex-column mb-2" id="upload-batch-no-div" style="display: none;">
                            <label class="m-0">Upload Batch 번호</label>
                            <div class="d-flex align-items-center">
                                <select id="upload-batch-no-select" class="rounded mr-2" autocomplete="off" style="width: 250px;">
                                </select>
                                <button type="button" class="btn btn-sm btn-primary" onclick="PopupForm1UploadBatch.btn_act_delete()">
                                    {{ $uploadBatch['FormVars']['Title']['DeleteButton'] }}
                                </button>
                            </div>
                        </div>

                        @if($uploadBatch['FormVars']['Hidden']['CreateMedia'] === '' || $uploadBatch['FormVars']['Hidden']['CropImages'] === '')
                            <hr>
                            <div class="mb-1">
                                <div>FTP Upload 폴더: <span class="text-danger" id="upload-folder"></span></div>
                            </div>
                        @endif

                        <div class="{{ $uploadBatch['FormVars']['Display']['CreateMedia'] }}  flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="create-media-check" onchange="PopupForm1UploadBatch.change_create_media(this)">
                                <label class="mb-0" for="create-media-check">{{ $uploadBatch['FormVars']['Title']['CreateMedia'] }}</label>
                            </div>
                        </div>
                        <div class="{{ $uploadBatch['FormVars']['Display']['CropImages'] }}  flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="crop-images-check">
                                <label class="mb-0" for="crop-images-check">{{ $uploadBatch['FormVars']['Title']['CropImages'] }}</label>
                            </div>
                        </div>

                        <hr>

                        <div class="{{ $uploadBatch['FormVars']['Display']['TruncateTable'] }} flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="truncate-table-check"> <label class="mb-0" for="truncate-table-check">{{ $uploadBatch['FormVars']['Title']['TruncateTable'] }}</label>
                            </div>
                        </div>
                        <div class="{{ $uploadBatch['FormVars']['Display']['BackupTable'] }} flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="backup-table-check"> <label class="mb-0" for="backup-table-check">{{ $uploadBatch['FormVars']['Title']['BackupTable'] }}</label>
                            </div>
                        </div>
                        <div class="{{ $uploadBatch['FormVars']['Display']['BackupDb'] }} flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-backup-db-check"> <label class="mb-0" for="is-backup-db-check">{{ $uploadBatch['FormVars']['Title']['BackupDb'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            await PopupForm1UploadBatch.create_media_brand_select_box_options()

            // PopupForm1UploadBatch.upload_batch_save_callback()

            $('.upload-batch-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1UploadBatch.btn_act_save(); break;
                }
            });

            activate_button_group({save_spinner_btn: '#upload-batch-save-spinner-btn', btn_group: '#upload-batch-btn-group'})
        });

        (function( PopupForm1UploadBatch, $, undefined ) {
            PopupForm1UploadBatch.uploadBatch = {!! json_encode($uploadBatch) !!};
            PopupForm1UploadBatch.parentParameter = {};
            PopupForm1UploadBatch.tdCount = 0;
            PopupForm1UploadBatch.setup;

            PopupForm1UploadBatch.create_media_brand_select_box_options = async function () {
                const response = await get_api_data('setup-page', {
                    PageVars: {
                        Query: "setup_code = 'media-body' and is_on_use = '1'",
                        Limit: 9999999, Offset: 0
                    }
                })

                const setup_json = response.data['Page'].map(setup => {
                    const data = JSON.parse(setup['SetupJson'])
                    data['BrandCode'] = setup['BrandCode']
                    return data
                })
                PopupForm1UploadBatch.setup = _.indexBy(setup_json, 'BrandCode');

                console.log(PopupForm1UploadBatch.setup)

                if (! isEmpty(PopupForm1UploadBatch.uploadBatch['ConditionVars']['MediaBody'])) {
                    $('#upload-batch').find('#upload-folder').text('{{ public_path() }}' + get_curr_setup_file_path(PopupForm1UploadBatch.setup[PopupForm1UploadBatch.uploadBatch['ConditionVars']['MediaBody']], ''))
                }
            }

            PopupForm1UploadBatch.change_show_list_checkbox = function ($this) {
                if ($($this).prop('checked')) {
                    $('#upload-batch').find('#upload-batch-no-div').show()
                } else {
                    $('#upload-batch').find('#upload-batch-no-div').hide()
                }
            }

            PopupForm1UploadBatch.change_create_media = function ($this) {
                if ($($this).prop('checked')) {
                    $('#upload-batch').find('#crop-images-check').prop('disabled', false)
                } else {
                    $('#upload-batch').find('#crop-images-check').prop('disabled', true)
                    $('#upload-batch').find('#crop-images-check').prop('checked', false)
                }
            }

            PopupForm1UploadBatch.btn_act_delete = async function() {
                const upload_batch = $('#upload-batch')

                if (isEmpty($(upload_batch).find('#upload-batch-no-select').val())) {
                    return iziToast.error({
                        title: 'Error', message: '업로드 배치 번호를 선택하세요',
                    })
                }
                const response = await get_api_data(PopupForm1UploadBatch.uploadBatch['General']['DelApi'], {
                    TableName: PopupForm1UploadBatch.uploadBatch['InsertVars']['TableName'],
                    UploadBatchVars: {
                        UploadBatch: $(upload_batch).find('#upload-batch-no-select').val(),
                        IsCreateMedia: $(upload_batch).find('#create-media-check:checked').val() === '1',
                        IsCropImage: $(upload_batch).find('#crop-images-check:checked').val() === '1',
                        ImgExtension: $(upload_batch).find('#img-extension-select').val(),
                    }
                })
                console.log(response)

                const d = response.data
                if (d.apiStatus) {
                    return iziToast.error({
                        title: 'Error', message: d.body ?? $('#api-request-failed-please-check').text(),
                    })
                }

                await PopupForm1UploadBatch.init_data()

                $('#modal-multi-popup.show').trigger('list.requery');
                iziToast.success({
                    title: 'Success', message: $('#action-completed').text(),
                });
            }

            PopupForm1UploadBatch.upload_batch_save_success = function () {
                $('#modal-multi-popup.show').trigger('list.token.init')
                $('#modal-multi-popup.show').modal('hide')
                return iziToast.success({
                    title: 'Success', message: $('#action-completed').text(),
                });
            }

            PopupForm1UploadBatch.upload_batch_save_error = function (d) {
                $('#modal-multi-popup.show').modal('hide')
                return iziToast.error({
                    title: 'Error', message: d.body ?? $('#api-request-failed-please-check').text(),
                })
            }

            PopupForm1UploadBatch.btn_act_save = async function () {
                if (PopupForm1UploadBatch.tdCount === 0 || isEmpty(PopupForm1UploadBatch.parentParameter['ListType1Vars']['ListToken'])) {
                    return iziToast.error({
                        title: 'Error',
                        message: '엑셀화일을 먼저 업로드 해주세요',
                    })
                }

                const upload_batch = $('#upload-batch')

                const response = await get_api_data(PopupForm1UploadBatch.uploadBatch['General']['ActApi'], {
                    InsertVars: {
                        QueryName: PopupForm1UploadBatch.uploadBatch['InsertVars']['QueryName'],
                        InsertType: PopupForm1UploadBatch.uploadBatch['InsertVars']['InsertType'],
                        ListToken: PopupForm1UploadBatch.parentParameter['ListType1Vars']['ListToken'],
                        IsTruncateTable: $(upload_batch).find('#truncate-table-check:checked').val() == '1',
                        IsBackupTable: $(upload_batch).find('#backup-table-check:checked').val() == '1',
                        IsBackupDb: $(upload_batch).find('#is-backup-db-check:checked').val() == '1',
                    },
                    UploadBatchVars: {
                        UploadBatch: $(upload_batch).find('#curr-batch-no-txt').val(),
                        IsCreateMedia: $(upload_batch).find('#create-media-check:checked').val() === '1',
                        IsCropImage: $(upload_batch).find('#crop-images-check:checked').val() === '1',
                        ImgExtension: $(upload_batch).find('#img-extension-select').val(),
                    }
                })
                console.log(response)

                const d = response.data
                if (d.apiStatus) {
                    return PopupForm1UploadBatch.upload_batch_save_error(d)
                }

                iziToast.info({
                    title: 'info', message: '관련 테이블과 미디어 라이브러리에 반영 중입니다. 잠시 기다려 주세요.. (*움직일 시 데이터가 누락될 수 있어요)',
                });

                if (d.UploadBatchVars['IsCreateMedia']) {
                    deactivate_button_group({save_spinner_btn: '#upload-batch-save-spinner-btn', btn_group: '#upload-batch-btn-group'})
                    await PopupForm1UploadBatch.upload_batch_save_callback(d.UploadBatchVars)
                    activate_button_group({save_spinner_btn: '#upload-batch-save-spinner-btn', btn_group: '#upload-batch-btn-group'})
                } else {
                    PopupForm1UploadBatch.upload_batch_save_success()
                }

            }

            PopupForm1UploadBatch.upload_batch_save_callback = async function (upload_batch_vars) {
                // const curr_batch_no_txt = '230126-102453'
                // const is_create_media = false
                // const is_crop_image = false

                const curr_batch_no_txt = upload_batch_vars['UploadBatch']
                const is_create_media = upload_batch_vars['IsCreateMedia']
                const is_crop_image = upload_batch_vars['IsCropImage']

                // 작업은 media 를 upload_batch로 필터해서 읽어와서
                const response = await get_api_data('media-page', {
                    PageVars: {
                        Query: `upload_batch = '${curr_batch_no_txt}'`,
                        Limit: 9999999, Offset: 0
                    }
                })
                const d = response.data
                console.log(d)
                if (d.apiStatus) {
                    return PopupForm1UploadBatch.upload_batch_save_error(d)
                }

                const request = d.Page.map(media => {
                    const file_url = get_curr_setup_file_path(PopupForm1UploadBatch.setup[PopupForm1UploadBatch.uploadBatch['ConditionVars']['MediaBody']], media['FileUrl'])
                    const path_list = file_url.split('/')
                    const file_name = path_list[path_list.length - 1]
                    const file_path = file_url.split(file_name)[0]

                    return {
                        media_id: media['Id'],
                        mine_type: media['MineType'],
                        name: file_name,
                        path: file_path,
                        setup: PopupForm1UploadBatch.setup[PopupForm1UploadBatch.uploadBatch['ConditionVars']['MediaBody']],
                        type: 'image'
                    }
                })
                console.log(request)

                // 1) media.file_url 과 file_size, width 등을 기록하고
                // 2) image화일 crop
                // 3) media_bd 추가 기록 하는 방식으로 가면 될꺼야.
                const bd_page = await call_local_api('/upload-batch', {
                    media_list: request,
                    is_crop_image: is_crop_image,
                })

                const bd_page_data = bd_page.data
                if (! isEmpty(bd_page_data.apiStatus)) {
                    return PopupForm1UploadBatch.upload_batch_save_error(bd_page_data)
                }

                PopupForm1UploadBatch.upload_batch_save_success()
            }

            PopupForm1UploadBatch.btn_act_new = function () {
                $('#modal-multi-popup .modal-dialog').css('maxWidth', '800px');

                $('#modal-multi-popup .modal-header').removeClass('bg-dark-alpha px-0')
                $('#modal-multi-popup .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

                $('#modal-multi-popup .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
                $('#modal-multi-popup .modal-header').addClass('bg-danger-10')

                if (! PopupForm1UploadBatch.uploadBatch['ConditionVars']['IsVisible']) {
                    $('#modal-multi-popup').on('show.bs.modal', function (e) { e.preventDefault(); })
                    PopupForm1UploadBatch.btn_act_save()
                }

                Atype.btn_act_new('#upload-batch #frm')

                const upload_batch = $('#upload-batch')

                $(upload_batch).find('#truncate-table-check').prop('checked', PopupForm1UploadBatch.uploadBatch['InsertVars']['IsTruncateTable'])
                $(upload_batch).find('#backup-table-check').prop('checked', PopupForm1UploadBatch.uploadBatch['InsertVars']['IsBackupTable'])
                $(upload_batch).find('#is-backup-db-check').prop('checked', PopupForm1UploadBatch.uploadBatch['InsertVars']['IsBackupDb'])

                $(upload_batch).find('#create-media-check').prop('checked', PopupForm1UploadBatch.uploadBatch['UploadBatchVars']['IsCreateMedia'])
                $(upload_batch).find('#crop-images-check').prop('checked', PopupForm1UploadBatch.uploadBatch['UploadBatchVars']['IsCropImages'])

                PopupForm1UploadBatch.change_show_list_checkbox($('#upload-batch #show-list-check'))
                PopupForm1UploadBatch.change_create_media($('#upload-batch #create-media-check'))
            }

            PopupForm1UploadBatch.init_data = async function () {
                const upload_batch = $('#upload-batch')
                $(upload_batch).find('#curr-batch-no-txt').val( moment(new Date()).format('YYMMDD-HHmmss') )
                const response = await get_api_data(PopupForm1UploadBatch.uploadBatch['General']['GetApi'], {
                    TableName: PopupForm1UploadBatch.uploadBatch['InsertVars']['TableName']
                })
                const d = response.data
                // console.log(d)
                $(upload_batch).find('#last-target-id-txt').val( d.LastId )

                $(upload_batch).find('#upload-batch-no-select').html( `<option value="">== 업로드 배치 번호 선택 ==</option>` )
                const upload_batch_no_select = window.custom_create_options('UploadBatch', 'UploadBatch', d.Page)
                $(upload_batch).find('#upload-batch-no-select').append(upload_batch_no_select)
            }

            PopupForm1UploadBatch.show_popup_callback = async function (parent_parameter, parameter, td_count) {
                PopupForm1UploadBatch.tdCount = td_count
                PopupForm1UploadBatch.btn_act_new()
                PopupForm1UploadBatch.uploadBatch = parameter
                PopupForm1UploadBatch.parentParameter = parent_parameter

                await PopupForm1UploadBatch.init_data()
            }
        }( window.PopupForm1UploadBatch = window.PopupForm1UploadBatch || {}, jQuery ));
    </script>
@endpush
@endonce
