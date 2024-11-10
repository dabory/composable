{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary igroup save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'igroup',
        ])
    </div>
</div>

<div class="card mb-2" id="igroup-form">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal"></button>

    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IgroupCode'] }}</label>
                            <input type="text" id="igroup-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IgroupCode'] }}"
                                {{ $formA['FormVars']['Required']['IgroupCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IgroupName'] }}</label>
                            <input type="text" id="igroup-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IgroupName'] }}"
                                {{ $formA['FormVars']['Required']['IgroupName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IgroupSlug'] }}</label>
                            <input type="text" id="igroup-slug-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IgroupSlug'] }}"
                                {{ $formA['FormVars']['Required']['IgroupSlug'] }}>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['MediaId'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MediaId'] }}</label>
                            <input type="text" id="bd-file-url-txt" class="w-100 rounded mb-1" disabled>
                            <input type="hidden" id="media-id-txt">
                            <div class="d-flex justify-content-center">
                                <button class="btn col text-white bg-grey-700 border-grey-700 bg-grey-700-hover" id="file-upload-btn" onclick="PopupForm1FormAIgroupForm.upload_file(this)">
                                    미디어 업로드
                                </button>
                                <button class="media-id-delete-btn btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAIgroupForm.delete_media_id('#media-id-txt', '#bd-file-url-txt')">삭제</button>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select class="rounded w-100" id="status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['Status'] }}"
                                {{ $formA['FormVars']['Required']['Status'] }}>
                                @foreach($formA['StatusOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select class="rounded w-100" id="sort-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                                @foreach($formA['SortOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-end-level-check"> <label class="mb-0" for="is-end-level-check">{{ $formA['FormVars']['Title']['IsEndLevel'] }}</label>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- @endsection --}}

@push('modal')
    @include('front.outline.static.memo')
@endpush

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(async function() {
                $('.igroup').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAIgroupForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAIgroupForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormAIgroupForm, $, undefined ) {
                PopupForm1FormAIgroupForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormAIgroupForm.upload_file = function ($this) {
                    if (! PopupForm1FormBMediaForm.btn_act_new('item')) {
                        return
                    }

                    $('#modal-media').data('target-id', '')
                    const target_id = '#' + $($this).closest('.form-group').find('#media-id-txt').attr('id')
                    $('#modal-media').data('unique-key', target_id)
                    $('#igroup-form').find('#modal-media-btn').data('target', 'media')
                    $('#igroup-form').find('#modal-media-btn').data('variable', mediaModal)
                    $('#igroup-form').find('#modal-media-btn').trigger('click')
                }

                PopupForm1FormAIgroupForm.btn_act_new = function () {
                    $('#igroup-form').find('#media-id-txt').val(0)

                    Atype.set_parameter_callback(PopupForm1FormAIgroupForm.parameter);
                    $('#modal-select-popup.popup-form1-form-a-igroup-form .modal-body .media-id-delete-btn').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')

                    $('#modal-select-popup.popup-form1-form-a-igroup-form .modal-dialog').css('maxWidth', '600px');
                    Atype.btn_act_new('#igroup-form #frm');
                }

                PopupForm1FormAIgroupForm.btn_act_new_callback = function () {
                    PopupForm1FormAIgroupForm.btn_act_new()
                }

                PopupForm1FormAIgroupForm.parameter = function () {
                    const $igroup_form = $('#igroup-form')
                    let id = Number($($igroup_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        IgroupCode: $($igroup_form).find('#igroup-code-txt').val(),
                        IgroupName: $($igroup_form).find('#igroup-name-txt').val(),
                        IgroupSlug: $($igroup_form).find('#igroup-slug-txt').val(),
                        IsEndLevel: $('#is-end-level-check:checked').val() ?? '0',
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

                PopupForm1FormAIgroupForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAIgroupForm.parameter);
                    Atype.btn_act_save('#igroup-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAIgroupForm');
                }

                PopupForm1FormAIgroupForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAIgroupForm.parameter);
                    Atype.btn_act_del('#igroup-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAIgroupForm');
                }

                PopupForm1FormAIgroupForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAIgroupForm.btn_act_new()
                    await PopupForm1FormAIgroupForm.fetch_igroup(Number(id));
                }

                PopupForm1FormAIgroupForm.fetch_igroup = async function (id) {
                    let response = await get_api_data(PopupForm1FormAIgroupForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAIgroupForm.set_ui(response)
                }

                PopupForm1FormAIgroupForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    const igroup = response.data.Page[0];

                    const $igroup_form = $('#igroup-form')

                    $($igroup_form).find('#Id').val(igroup.Id)

                    $($igroup_form).find('#igroup-code-txt').val(igroup.IgroupCode)
                    $($igroup_form).find('#igroup-name-txt').val(igroup.IgroupName)
                    $($igroup_form).find('#igroup-slug-txt').val(igroup.IgroupSlug)
                    $($igroup_form).find('#is-end-level-check').prop('checked', igroup.IsEndLevel == '1')
                }

            }( window.PopupForm1FormAIgroupForm = window.PopupForm1FormAIgroupForm || {}, jQuery ));
        </script>
    @endpush
@endonce
