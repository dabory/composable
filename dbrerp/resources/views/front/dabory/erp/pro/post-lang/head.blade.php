@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

    <div class="content pro">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-1 pt-2 text-right">
                    <button type="button"
                            class="btn btn-success btn-open-modal"
                            data-target="slip"
                            data-clicked="Btype.fetch_slip_form_book"
                            data-variable="postModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary post-lang-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'post-lang-act',
                        ])
                    </div>
                </div>

                <div class="card" id="post-lang-form">
                    <button type="button" id="modal-media-btn" hidden
                            class="btn btn-success btn-open-modal">
                    </button>

                    <div class="card-header" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['PostNo'] }}</label>
                                            <input type="text" id="post-no-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PostNo'] }}"
                                                {{ $formB['FormVars']['Required']['PostNo'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['PostTitle'] }}</label>
                                            <input type="text" id="post-title-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PostTitle'] }}"
                                                {{ $formB['FormVars']['Required']['PostTitle'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['PostCode'] }}</label>
                                            <select type="text" id="post-code-select" class="rounded w-100"
                                                {{ $formB['FormVars']['Required']['PostCode'] }}>
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['Status'] }}</label>
                                            <select type="text" id="status-select" class="rounded w-100"
                                                {{ $formB['FormVars']['Required']['Status'] }}>
                                                @foreach($formB['StatusOptions'] as $option)
                                                    <option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) ?? $option['Caption'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light"><!--260-->
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group {{ $formB['FormVars']['Display']['MediaId'] }} flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaId'] }}</label>
                                            <input type="text" id="bd-file-url-txt" class="w-100 rounded mb-1" disabled>
                                            <input type="hidden" id="media-id-txt">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn col text-white bg-grey-700 border-grey-700 bg-grey-700-hover" id="file-upload-btn" onclick="upload_file(this)">
                                                    {{ $formB['FormVars']['Title']['FileUpload'] }}
                                                </button>
                                                <button class="btn text-white btn-danger col-4 ml-1" onclick="delete_media_id('#media-id-txt', '#bd-file-url-txt')">삭제</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 mt-2 mx-2">
                        @include('front.dabory.erp.pro.post-lang.body')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $postModal])
    @include('front.outline.static.memo')
@endsection

@section('js')
    <script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            let query = ''
            const postCode = formB['General']['PostCode']
            if (postCode) {
                query = `post_code='${postCode}'`
            }
            const response = await get_api_data('post-type-page', {
                PageVars: {
                    Query: query,
                    Limit: 100
                }
            })
            console.log(response)
            $('#post-code-select').html(window.custom_create_options('Id', 'TypeTitle', response.data.Page));

            $('.post-lang-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': btn_act_save(); break;
                    case 'new': btn_act_new(); break;
                    case 'del': Btype.btn_act_del('#post-lang-form #frm'); break;
                }
            });

            activate_button_group()
        }

        $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
            $(unique_key).val(id_list[0])
            $(unique_key).closest('.form-group').find('#bd-file-url-txt').val(file_url_list[0])
        });

        function delete_media_id(media_dom_id, file_url_dom_id) {
            $(media_dom_id).val(0)
            $(file_url_dom_id).val('')
        }

        function upload_file($this) {
            $('#modal-media').data('target-id', '')
            const target_id = '#' + $($this).closest('.form-group').find('#media-id-txt').attr('id')

            $('#modal-media').data('unique-key', target_id)
            $('#post-lang-form').find('#modal-media-btn').data('target', 'media')
            $('#post-lang-form').find('#modal-media-btn').data('variable', mediaModal)
            $('#post-lang-form').find('#modal-media-btn').trigger('click')
        }

        function btn_act_save() {
            Btype.btn_act_save('#post-lang-form #frm')
        }

        function btn_act_new() {
            input_box_reset_for('#post-lang-form #frm')

            delete_media_id('#media-id-txt', '#bd-file-url-txt')
            // table body 초기화
            table_head_check_box_reset('.post-lang-table')
            PostLangBody.actNew()
        }

        function get_parameter() {
            let id = parseInt($('#frm').find('#Id').val());
            let parameter = {
                Id: id,
                PostNo: $('#post-no-txt').val(),
                PostTitle: $('#post-title-txt').val(),
                PostTypeId: Number($('#post-code-select').val()),
                Status: $('#status-select').val(),
                MediaId: Number($('#media-id-txt').val()),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter;
        }

        async function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            const hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            // console.log(hd_page)
            // console.log(bd_page)

            $('#Id').val(hd_page.Id)
            $('#post-no-txt').val(hd_page.PostNo)
            $('#post-title-txt').val(hd_page.PostTitle)
            $('#post-code-select').val(hd_page.PostTypeId)
            $('#status-select').val(hd_page.Status)

            $('#media-id-txt').val(hd_page.MediaId)
            const media_pick = await get_api_data('media-pick', {
                Page: [ { Id: Number(hd_page.MediaId) } ]
            })

            const page = media_pick.data['Page']
            if (page) {
                const file_url = page[0]['FileUrl']
                $('#bd-file-url-txt').val(file_url)
            }

            // table body에 데이터 추가
            PostLangBody.updateBdUi(bd_page)

            $('#modal-slip').modal('hide');
        }

        const postModal = {!! json_encode($postModal) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
