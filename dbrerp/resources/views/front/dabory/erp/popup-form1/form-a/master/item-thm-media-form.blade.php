<div class="mb-1 pt-2 text-right btn-groups" id="item-thm-media-btn-groups">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="item-thm-media-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" id="item-thm-media-group" hidden>
        <button type="button" class="btn btn-sm btn-primary item-thm-media-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'item-thm-media-act',
        ])
    </div>
</div>

<div class="card p-2" id="item-thm-media">
    <div class="card-header" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="row">
            <div class="col-12 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId1'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId1'] }}</label>
                            <input type="text" class="w-100 rounded mb-1 file-url-txt" id="file-url1-txt" disabled>
                            <input type="hidden" id="media-id1-txt" class="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                    {{ $formA['FormVars']['Title']['FileUpload'] }}
                                </button>
                                <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id1-txt', '#file-url1-txt')">삭제</button>
                            </div>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId2'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId2'] }}</label>
                            <input type="text" class="w-100 rounded mb-1 file-url-txt" id="file-url2-txt" disabled>
                            <input type="hidden" id="media-id2-txt" class="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                    {{ $formA['FormVars']['Title']['FileUpload'] }}
                                </button>
                                <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id2-txt', '#file-url2-txt')">삭제</button>
                            </div>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId3'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId3'] }}</label>
                            <input type="text" class="w-100 rounded mb-1 file-url-txt" id="file-url3-txt" disabled>
                            <input type="hidden" id="media-id3-txt" class="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                    {{ $formA['FormVars']['Title']['FileUpload'] }}
                                </button>
                                <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id3-txt', '#file-url3-txt')">삭제</button>
                            </div>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId4'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId4'] }}</label>
                            <input type="text" class="w-100 rounded mb-1 file-url-txt" id="file-url4-txt" disabled>
                            <input type="hidden" id="media-id4-txt" class="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                    {{ $formA['FormVars']['Title']['FileUpload'] }}
                                </button>
                                <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id4-txt', '#file-url4-txt')">삭제</button>
                            </div>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId5'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId5'] }}</label>
                            <input type="text" class="w-100 rounded mb-1 file-url-txt" id="file-url5-txt" disabled>
                            <input type="hidden" id="media-id5-txt" class="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                    {{ $formA['FormVars']['Title']['FileUpload'] }}
                                </button>
                                <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id5-txt', '#file-url5-txt')">삭제</button>
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
<script src="{{ csset('/js/components/web-editor.js') }}"></script>
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            mediaModal = await include_media_library('media-body', 'post')

            PopupForm1FormAMasterItemThmMediaForm.btn_act_new()

            $('.item-thm-media-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAMasterItemThmMediaForm.btn_act_save(); break;
                }
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                $('#item-thm-media').find(unique_key).val(id_list[0])
                $('#item-thm-media').find(unique_key).closest('.form-group').find('.file-url-txt').val(file_url_list[0])
            });

            $('#item-thm-media-save-spinner-btn').prop('hidden', true)
            $('#item-thm-media-group').prop('hidden', false)
        });

        (function( PopupForm1FormAMasterItemThmMediaForm, $, undefined ) {
            PopupForm1FormAMasterItemThmMediaForm.formA = {!! json_encode($formA) !!}

            PopupForm1FormAMasterItemThmMediaForm.upload_file = function ($this) {
                if (! PopupForm1FormBMediaForm.btn_act_new('item')) {
                    return
                }

                const item_thm_media_btn_groups = $('#item-thm-media-btn-groups')
                $('#modal-media').data('target-id', '')
                const target_id = '#' + $($this).closest('.form-group').find('.media-id-txt').attr('id')
                $('#modal-media').data('unique-key', target_id)
                $(item_thm_media_btn_groups).find('#modal-media-btn').data('target', 'media')
                $(item_thm_media_btn_groups).find('#modal-media-btn').data('variable', mediaModal)
                $(item_thm_media_btn_groups).find('#modal-media-btn').trigger('click')
            }

            PopupForm1FormAMasterItemThmMediaForm.btn_act_save = function () {
                Atype.btn_act_save('#item-thm-media #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide')
                }, 'PopupForm1FormAMasterItemThmMediaForm');
            }

            PopupForm1FormAMasterItemThmMediaForm.btn_act_new = async function () {
                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-header').addClass('bg-green-600 border-green-600')
                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-body .btn-group > button').addClass('bg-green-600 border-green-600 bg-green-600-hover')

                $('#modal-select-popup.popup-form1-form-a-master-item-thm-media-form .modal-dialog').css('maxWidth', '600px');

                Atype.set_parameter_callback(PopupForm1FormAMasterItemThmMediaForm.parameter)
                Atype.btn_act_new('#item-thm-media #frm')
                const item_thm_media = $('#item-thm-media')

                $(item_thm_media).find('#media-id1-txt').val(0)
                $(item_thm_media).find('#media-id2-txt').val(0)
                $(item_thm_media).find('#media-id3-txt').val(0)
                $(item_thm_media).find('#media-id4-txt').val(0)
                $(item_thm_media).find('#media-id5-txt').val(0)
            }

            PopupForm1FormAMasterItemThmMediaForm.show_popup_callback = async function (id) {
                $('#item-modal-btn').prop('hidden', true)
                PopupForm1FormAMasterItemThmMediaForm.btn_act_new()
                await PopupForm1FormAMasterItemThmMediaForm.fetch_item_thm_media(Number(id));
            }

            PopupForm1FormAMasterItemThmMediaForm.parameter = function () {
                const item_thm_media = $('#item-thm-media')
                let id = Number( $(item_thm_media).find('#Id').val() )
                let parameter = {
                    Id: id,
                    MediaId1: Number($(item_thm_media).find('#media-id1-txt').val() ?? 0),
                    MediaId2: Number($(item_thm_media).find('#media-id2-txt').val() ?? 0),
                    MediaId3: Number($(item_thm_media).find('#media-id3-txt').val() ?? 0),
                    MediaId4: Number($(item_thm_media).find('#media-id4-txt').val() ?? 0),
                    MediaId5: Number($(item_thm_media).find('#media-id5-txt').val() ?? 0),
                }
                if (id < 0) {
                    parameter = { Id: id }
                }
                // console.log(parameter)

                return parameter;
            }

            PopupForm1FormAMasterItemThmMediaForm.fetch_item_thm_media = async function (id) {
                let response = await get_api_data(PopupForm1FormAMasterItemThmMediaForm.formA['General']['PickApi'], {
                    ImageType: 'thumb',
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMasterItemThmMediaForm.set_item_thm_media_ui(response)
            }

            PopupForm1FormAMasterItemThmMediaForm.delete_media_id = function (media_dom_id, file_url_dom_id) {
                const item_thm_media = $('#item-thm-media')
                $(item_thm_media).find(media_dom_id).val(1)
                $(item_thm_media).find(file_url_dom_id).val('')
            }

            PopupForm1FormAMasterItemThmMediaForm.set_item_thm_media_ui = async function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    return;
                }

                const item_thm = response.data.Page[0]
                const media_bd1_page = response.data.MediaBd1Page[0]
                const media_bd2_page = response.data.MediaBd2Page[0]
                const media_bd3_page = response.data.MediaBd3Page[0]
                const media_bd4_page = response.data.MediaBd4Page[0]
                const media_bd5_page = response.data.MediaBd5Page[0]
                const item_thm_media = $('#item-thm-media')

                $(item_thm_media).find('#Id').val(item_thm.Id)

                $(item_thm_media).find('#media-id1-txt').val(item_thm['MediaId1'])
                $(item_thm_media).find('#file-url1-txt').val(media_bd1_page.BdFileUrl)

                $(item_thm_media).find('#media-id2-txt').val(item_thm['MediaId2'])
                $(item_thm_media).find('#file-url2-txt').val(media_bd2_page.BdFileUrl)

                $(item_thm_media).find('#media-id3-txt').val(item_thm['MediaId3'])
                $(item_thm_media).find('#file-url3-txt').val(media_bd3_page.BdFileUrl)

                $(item_thm_media).find('#media-id4-txt').val(item_thm['MediaId4'])
                $(item_thm_media).find('#file-url4-txt').val(media_bd4_page.BdFileUrl)

                $(item_thm_media).find('#media-id5-txt').val(item_thm['MediaId5'])
                $(item_thm_media).find('#file-url5-txt').val(media_bd5_page.BdFileUrl)

                $('#modal-item').modal('hide');
            }

        }( window.PopupForm1FormAMasterItemThmMediaForm = window.PopupForm1FormAMasterItemThmMediaForm || {}, jQuery ));

        let mediaModal
    </script>
@endpush
@endonce
