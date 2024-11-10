{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary users-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'users-act',
        ])
    </div>
</div>

<div class="card-body p-0 mt-2 mx-2">
    <!-- 탭시작 -->
    <ul class="nav nav-tabs nav-tabs-solid rounded mb-0">
        <li class="nav-item post-type-tab1"><a href="#post-type-tab1" class="nav-link rounded-left active" data-toggle="tab">기본 설정</a></li>
        <li class="nav-item post-type-tab2"><a href="#post-type-tab2" class="nav-link" data-toggle="tab">게시판 디자인</a></li>
    </ul>
    <!--// 탭 끝 -->

    <!-- 탭내용 시작 -->
    <div class="tab-content" id="post-type-form">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="tab-pane fade show active" id="post-type-tab1">
            <div class="card mb-2">
                <div class="card-header px-2">
                    <div class="row">
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group {{ $formA['FormVars']['Display']['PostCode'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PostCode'] }}</label>
                                        <input type="text" id="post-code-txt" class="rounded w-100" autocomplete="off" data-copy="true"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PostCode'] }}"
                                            {{ $formA['FormVars']['Required']['PostCode'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['BrandCode'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['BrandCode'] }}</label>
                                        <input type="text" id="brand-code-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['BrandCode'] }}"
                                            {{ $formA['FormVars']['Required']['BrandCode'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['SortDesc'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['SortDesc'] }}</label>
                                        <input type="text" id="sort-desc-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['SortDesc'] }}"
                                            {{ $formA['FormVars']['Required']['SortDesc'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['TypeTitle'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['TypeTitle'] }}</label>
                                        <input type="text" id="type-title-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['TypeTitle'] }}"
                                            {{ $formA['FormVars']['Required']['TypeTitle'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['TypeSlug'] }} flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['TypeSlug'] }}</label>
                                        <input type="text" id="type-slug-txt" class="rounded w-100" autocomplete="off" data-copy="true"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['TypeSlug'] }}"
                                            {{ $formA['FormVars']['Required']['TypeSlug'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group {{ $formA['FormVars']['Display']['SeqNo'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['SeqNo'] }}</label>
                                        <input type="text" id="seq-no-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['SeqNo'] }}"
                                            {{ $formA['FormVars']['Required']['SeqNo'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['Status'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                                        <select class="rounded w-100" id="status-select"
                                            {{ $formA['FormVars']['Required']['Status'] }}>
                                            @foreach ($formA['StatusOptions'] as $option)
                                                <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group {{ $formA['FormVars']['Display']['SetupCode'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['SetupCode'] }}</label>
                                        <select class="rounded w-100" id="setup-code-select"
                                            {{ $formA['FormVars']['Required']['SetupCode'] }}>
                                            @foreach ($formA['SetupCodeOptions'] as $option)
                                                <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group {{ $formA['FormVars']['Display']['Sort'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                                        <select class="rounded w-100" id="sort-select"
                                            {{ $formA['FormVars']['Required']['Sort'] }}>
                                            @foreach ($formA['SortOptions'] as $option)
                                                <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-unused-check"> <label class="mb-0" for="is-unused-check">{{ $formA['FormVars']['Title']['IsUnused'] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="post-type-tab2">
            <div class="card mb-2">
                <div class="card-header px-2">
                    <div class="row">
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcTitleLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcTitleLeng'] }}</label>
                                        <input type="text" id="pc-title-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcTitleLeng'] }}"
                                            {{ $formA['FormVars']['Required']['PcTitleLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcPageLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcPageLeng'] }}</label>
                                        <input type="text" id="pc-page-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcPageLeng'] }}"
                                            {{ $formA['FormVars']['Required']['PcPageLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcGalleryLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcGalleryLeng'] }}</label>
                                        <input type="text" id="pc-gallery-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcGalleryLeng'] }}"
                                            {{ $formA['FormVars']['Required']['PcGalleryLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcGalleryWidth'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcGalleryWidth'] }}</label>
                                        <input type="text" id="pc-gallery-width-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcGalleryWidth'] }}"
                                            {{ $formA['FormVars']['Required']['PcGalleryWidth'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcGalleryHeight'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcGalleryHeight'] }}</label>
                                        <input type="text" id="pc-gallery-height-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcGalleryHeight'] }}"
                                            {{ $formA['FormVars']['Required']['PcGalleryHeight'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcVideoLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcVideoLeng'] }}</label>
                                        <input type="text" id="pc-video-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcVideoLeng'] }}"
                                            {{ $formA['FormVars']['Required']['PcVideoLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcVideoWidth'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcVideoWidth'] }}</label>
                                        <input type="text" id="pc-video-width-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcVideoWidth'] }}"
                                            {{ $formA['FormVars']['Required']['PcVideoWidth'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['PcVideoHeight'] }} flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['PcVideoHeight'] }}</label>
                                        <input type="text" id="pc-video-height-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['PcVideoHeight'] }}"
                                            {{ $formA['FormVars']['Required']['PcVideoHeight'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoTitleLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoTitleLeng'] }}</label>
                                        <input type="text" id="mo-title-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoTitleLeng'] }}"
                                            {{ $formA['FormVars']['Required']['MoTitleLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoPageLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoPageLeng'] }}</label>
                                        <input type="text" id="mo-page-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoPageLeng'] }}"
                                            {{ $formA['FormVars']['Required']['MoPageLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoGalleryLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoGalleryLeng'] }}</label>
                                        <input type="text" id="mo-gallery-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoGalleryLeng'] }}"
                                            {{ $formA['FormVars']['Required']['MoGalleryLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoGalleryWidth'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoGalleryWidth'] }}</label>
                                        <input type="text" id="mo-gallery-width-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoGalleryWidth'] }}"
                                            {{ $formA['FormVars']['Required']['MoGalleryWidth'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoGalleryHeight'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoGalleryHeight'] }}</label>
                                        <input type="text" id="mo-gallery-height-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoGalleryHeight'] }}"
                                            {{ $formA['FormVars']['Required']['MoGalleryHeight'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoVideoLeng'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoVideoLeng'] }}</label>
                                        <input type="text" id="mo-video-leng-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoVideoLeng'] }}"
                                            {{ $formA['FormVars']['Required']['MoVideoLeng'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoVideoWidth'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoVideoWidth'] }}</label>
                                        <input type="text" id="mo-video-width-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoVideoWidth'] }}"
                                            {{ $formA['FormVars']['Required']['MoVideoWidth'] }}>
                                    </div>
                                    <div class="form-group {{ $formA['FormVars']['Display']['MoVideoHeight'] }} flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['MoVideoHeight'] }}</label>
                                        <input type="text" id="mo-video-height-txt" class="rounded w-100" autocomplete="off"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MoVideoHeight'] }}"
                                            {{ $formA['FormVars']['Required']['MoVideoHeight'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// 탭 내용 끝 -->

</div>



{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.users-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAPostTypeForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAPostTypeForm.btn_act_del(); break;
                    case 'copy': PopupForm1FormAPostTypeForm.btn_act_copy(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAPostTypeForm, $, undefined ) {
            PopupForm1FormAPostTypeForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAPostTypeForm.btn_act_new = function () {
                Atype.set_parameter_callback(PopupForm1FormAPostTypeForm.parameter);
                Atype.btn_act_new('#post-type-form');
            }

            PopupForm1FormAPostTypeForm.btn_act_new_callback = function () {
                PopupForm1FormAPostTypeForm.btn_act_new()
            }

            PopupForm1FormAPostTypeForm.parameter = function () {
                let id = Number($('#post-type-form').find('#Id').val());
                const form = $('#post-type-form')

                const json = {
                    Design: {
                        PcTitleLeng: Number($(form).find('#pc-title-leng-txt').val()),
                        PcPageLeng: Number($(form).find('#pc-page-leng-txt').val()),
                        PcGalleryLeng: Number($(form).find('#pc-gallery-leng-txt').val()),
                        PcGalleryWidth: Number($(form).find('#pc-gallery-width-txt').val()),
                        PcGalleryHeight: Number($(form).find('#pc-gallery-height-txt').val()),
                        PcVideoLeng: Number($(form).find('#pc-video-leng-txt').val()),
                        PcVideoWidth: Number($(form).find('#pc-video-width-txt').val()),
                        PcVideoHeight: Number($(form).find('#pc-video-height-txt').val()),

                        MoTitleLeng: Number($(form).find('#mo-title-leng-txt').val()),
                        MoPageLeng: Number($(form).find('#mo-page-leng-txt').val()),
                        MoGalleryLeng: Number($(form).find('#mo-gallery-leng-txt').val()),
                        MoGalleryWidth: Number($(form).find('#mo-gallery-width-txt').val()),
                        MoGalleryHeight: Number($(form).find('#mo-gallery-height-txt').val()),
                        MoVideoLeng: Number($(form).find('#mo-video-leng-txt').val()),
                        MoVideoWidth: Number($(form).find('#mo-video-width-txt').val()),
                        MoVideoHeight: Number($(form).find('#mo-video-height-txt').val()),
                    }
                }

                let parameter = {
                    Id: id,
                    PostCode: $(form).find('#post-code-txt').val(),
                    BrandCode: $(form).find('#brand-code-txt').val(),
                    SetupCode: $(form).find('#setup-code-select').val(),
                    SortDesc: $(form).find('#sort-desc-txt').val(),
                    TypeTitle: $(form).find('#type-title-txt').val(),
                    TypeSlug: $(form).find('#type-slug-txt').val(),
                    SeqNo: Number($(form).find('#seq-no-txt').val()),
                    Status: $(form).find('#status-select').val(),
                    Sort: $(form).find('#sort-select').val(),
                    IsUnused: $(form).find('#is-unused-check:checked').val() ?? '0',
                    TypeJson: JSON.stringify(json),
                }
                if (id < 0) {
                    parameter = { Id: id }
                }

                console.log(parameter)
                return parameter;
            }

            PopupForm1FormAPostTypeForm.btn_act_copy = function () {
                Atype.set_parameter_callback(PopupForm1FormAPostTypeForm.parameter);
                Atype.btn_act_copy('#post-type-form', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                }, 'PopupForm1FormAPostTypeForm');
            }

            PopupForm1FormAPostTypeForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAPostTypeForm.parameter);
                Atype.btn_act_save('#post-type-form', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAPostTypeForm');
            }

            PopupForm1FormAPostTypeForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAPostTypeForm.parameter);
                Atype.btn_act_del('#post-type-form', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAPostTypeForm');
            }

            PopupForm1FormAPostTypeForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAPostTypeForm.btn_act_new()
                await PopupForm1FormAPostTypeForm.fetch_menu(Number(id));
            }

            PopupForm1FormAPostTypeForm.fetch_menu = async function (id) {
                let response = await get_api_data(PopupForm1FormAPostTypeForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAPostTypeForm.set_menu_ui(response)
            }

            PopupForm1FormAPostTypeForm.set_menu_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let post_type = response.data.Page[0];
                const form = $('#post-type-form')
                // console.log(post_type)

                $(form).find('#Id').val(post_type.Id)

                $(form).find('#post-code-txt').val(post_type.PostCode)
                $(form).find('#brand-code-txt').val(post_type.BrandCode)
                $(form).find('#setup-code-select').val(post_type.SetupCode)
                $(form).find('#sort-desc-txt').val(post_type.SortDesc)
                $(form).find('#type-title-txt').val(post_type.TypeTitle)
                $(form).find('#type-slug-txt').val(post_type.TypeSlug)
                $(form).find('#seq-no-txt').val(post_type.SeqNo)
                $(form).find('#status-select').val(post_type.Status)
                $(form).find('#sort-select').val(post_type.Sort)
                $(form).find('#is-unused-check').prop('checked', post_type.IsUnused == '1')

                if (post_type.TypeJson) {
                    const json = JSON.parse(post_type.TypeJson)
                    const design = json['Design']
                    $(form).find('#pc-title-leng-txt').val(design.PcTitleLeng)
                    $(form).find('#pc-page-leng-txt').val(design.PcPageLeng)
                    $(form).find('#pc-gallery-leng-txt').val(design.PcGalleryLeng)
                    $(form).find('#pc-gallery-width-txt').val(design.PcGalleryWidth)
                    $(form).find('#pc-gallery-height-txt').val(design.PcGalleryHeight)
                    $(form).find('#pc-video-leng-txt').val(design.PcVideoLeng)
                    $(form).find('#pc-video-width-txt').val(design.PcVideoWidth)
                    $(form).find('#pc-video-height-txt').val(design.PcVideoHeight)

                    $(form).find('#mo-title-leng-txt').val(design.MoTitleLeng)
                    $(form).find('#mo-page-leng-txt').val(design.MoPageLeng)
                    $(form).find('#mo-gallery-leng-txt').val(design.MoGalleryLeng)
                    $(form).find('#mo-gallery-width-txt').val(design.MoGalleryWidth)
                    $(form).find('#mo-gallery-height-txt').val(design.MoGalleryHeight)
                    $(form).find('#mo-video-leng-txt').val(design.MoVideoLeng)
                    $(form).find('#mo-video-width-txt').val(design.MoVideoWidth)
                    $(form).find('#mo-video-height-txt').val(design.MoVideoHeight)
                }
            }

        }( window.PopupForm1FormAPostTypeForm = window.PopupForm1FormAPostTypeForm || {}, jQuery ));
    </script>
@endpush
@endonce
