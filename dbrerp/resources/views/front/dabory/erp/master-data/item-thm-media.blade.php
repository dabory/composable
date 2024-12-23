<div class="tab-pane fade" id="thm-media">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <div class="card-header" id="item-thm-media">
		<div class="stit">
			<h3>추가이미지</h3>
		</div>
        <div class="col-12 card-header-item">
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-header p-0 mb-3">
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 이미지1</label>
                        <input type="text" class="w-100 rounded mb-1 file-url-txt tooltip-show-img" id="file-url1-txt" disabled>
                        <input type="hidden" id="media-id1-txt" class="media-id-txt">
                        <div class="d-flex justify-content-center">
                            <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                미디어 업로드
                            </button>
                            <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id1-txt', '#file-url1-txt')">삭제</button>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 이미지2</label>
                        <input type="text" class="w-100 rounded mb-1 file-url-txt tooltip-show-img" id="file-url2-txt" disabled>
                        <input type="hidden" id="media-id2-txt" class="media-id-txt">
                        <div class="d-flex justify-content-center">
                            <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                미디어 업로드
                            </button>
                            <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id2-txt', '#file-url2-txt')">삭제</button>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 이미지3</label>
                        <input type="text" class="w-100 rounded mb-1 file-url-txt tooltip-show-img" id="file-url3-txt" disabled>
                        <input type="hidden" id="media-id3-txt" class="media-id-txt">
                        <div class="d-flex justify-content-center">
                            <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                미디어 업로드
                            </button>
                            <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id3-txt', '#file-url3-txt')">삭제</button>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 이미지4</label>
                        <input type="text" class="w-100 rounded mb-1 file-url-txt tooltip-show-img" id="file-url4-txt" disabled>
                        <input type="hidden" id="media-id4-txt" class="media-id-txt">
                        <div class="d-flex justify-content-center">
                            <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                미디어 업로드
                            </button>
                            <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id4-txt', '#file-url4-txt')">삭제</button>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 이미지5</label>
                        <input type="text" class="w-100 rounded mb-1 file-url-txt tooltip-show-img" id="file-url5-txt" disabled>
                        <input type="hidden" id="media-id5-txt" class="media-id-txt">
                        <div class="d-flex justify-content-center">
                            <button class="btn text-white col bg-green-600 border-green-600 bg-green-600-hover" id="file-upload-btn" onclick="PopupForm1FormAMasterItemThmMediaForm.upload_file(this)">
                                미디어 업로드
                            </button>
                            <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMasterItemThmMediaForm.delete_media_id('#media-id5-txt', '#file-url5-txt')">삭제</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
    <script>
        $(document).ready(async function() {
            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                $('#item-thm-media').find(unique_key).val(id_list[0])
                $('#item-thm-media').find(unique_key).closest('.form-group').find('.file-url-txt').val(file_url_list[0])
            });
        });

        (function( PopupForm1FormAMasterItemThmMediaForm, $, undefined ) {

                PopupForm1FormAMasterItemThmMediaForm.upload_file = function ($this) {
                if (! PopupForm1FormBMediaForm.btn_act_new('item')) {
                    return
                }

                const item_thm_media_btn_groups = $('#thm-media')
                $('#modal-media').data('target-id', '')
                const target_id = '#' + $($this).closest('.form-group').find('.media-id-txt').attr('id')
                $('#modal-media').data('unique-key', target_id)
                $(item_thm_media_btn_groups).find('#modal-media-btn').data('target', 'media')
                $(item_thm_media_btn_groups).find('#modal-media-btn').data('variable', mediaModal)
                $(item_thm_media_btn_groups).find('#modal-media-btn').trigger('click')
            }

            PopupForm1FormAMasterItemThmMediaForm.btn_act_save = async function () {
                const response = await get_api_data('item-thm-act', {
                    Page: [ PopupForm1FormAMasterItemThmMediaForm.parameter() ]
                })
            }

            PopupForm1FormAMasterItemThmMediaForm.btn_act_new = async function () {
                Atype.btn_act_new('#item-thm-media #frm')
                const item_thm_media = $('#item-thm-media')

                $(item_thm_media).find('#media-id1-txt').val(0)
                $(item_thm_media).find('#media-id2-txt').val(0)
                $(item_thm_media).find('#media-id3-txt').val(0)
                $(item_thm_media).find('#media-id4-txt').val(0)
                $(item_thm_media).find('#media-id5-txt').val(0)
            }

            PopupForm1FormAMasterItemThmMediaForm.parameter = function () {
                const item_thm_media = $('#item-thm-media')
                let id = Number( $('#item-form').find('#Id').val() )
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
                console.log(parameter)

                return parameter;
            }

            PopupForm1FormAMasterItemThmMediaForm.delete_media_id = function (media_dom_id, file_url_dom_id) {
                const item_thm_media = $('#item-thm-media')
                $(item_thm_media).find(media_dom_id).val(1)
                $(item_thm_media).find(file_url_dom_id).val('')
            }

            PopupForm1FormAMasterItemThmMediaForm.set_ui = async function (item_id) {
                const response = await get_api_data('item-thm-pick', {
                    ImageType: 'thumb',
                    Page: [ { Id: item_id } ]
                })

                const item_thm = response.data.Page[0]
                const media_bd1_page = response.data.MediaBd1Page[0]
                const media_bd2_page = response.data.MediaBd2Page[0]
                const media_bd3_page = response.data.MediaBd3Page[0]
                const media_bd4_page = response.data.MediaBd4Page[0]
                const media_bd5_page = response.data.MediaBd5Page[0]
                const item_thm_media = $('#item-thm-media')

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
            }

        }( window.PopupForm1FormAMasterItemThmMediaForm = window.PopupForm1FormAMasterItemThmMediaForm || {}, jQuery ));
    </script>
@endpush
@endonce
