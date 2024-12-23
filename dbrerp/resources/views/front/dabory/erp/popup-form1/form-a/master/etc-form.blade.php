{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary etc-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'etc-act',
        ])
    </div>
</div>

<div class="card mb-2" id="etc-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['EtcType'] }}</label>
                            <input type="text" id="etc-type-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['EtcType'] }}"
                                {{ $formA['FormVars']['Required']['EtcType'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SelectName'] }}</label>
                            <input type="text" id="select-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SelectName'] }}"
                                {{ $formA['FormVars']['Required']['SelectName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SortNo'] }}</label>
                            <input type="text" id="sort-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SortNo'] }}"
                                {{ $formA['FormVars']['Required']['SortNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Value'] }}</label>
                            <input type="text" id="value-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Value'] }}"
                                {{ $formA['FormVars']['Required']['Value'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Caption'] }}</label>
                            <input type="text" id="caption-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Caption'] }}"
                                {{ $formA['FormVars']['Required']['Caption'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['EtcMemo'] }}</label>
                            <textarea id="etc-memo-textarea" maxlength="{{ $formA['FormVars']['MaxLength']['EtcMemo'] }}"
                                {{ $formA['FormVars']['Required']['EtcMemo'] }}></textarea>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-unchangeable-check"> <label class="mb-0" for="is-unchangeable-check">{{ $formA['FormVars']['Title']['IsUnchangeable'] }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-undeletable-check"> <label class="mb-0" for="is-undeletable-check">{{ $formA['FormVars']['Title']['IsUndeletable'] }}</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- @endsection --}}

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(async function() {
                $('.etc-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAMasterEtcForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAMasterEtcForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormAMasterEtcForm, $, undefined ) {
                PopupForm1FormAMasterEtcForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormAMasterEtcForm.btn_act_new = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMasterEtcForm.parameter);
                    Atype.btn_act_new('#etc-form #frm');
                }

                PopupForm1FormAMasterEtcForm.btn_act_new_callback = function () {
                    PopupForm1FormAMasterEtcForm.btn_act_new()
                }

                PopupForm1FormAMasterEtcForm.parameter = function () {
                    const $etc = $('#etc-form')
                    let id = Number($($etc).find('#Id').val());
                    let parameter = {
                        Id: id,
                        EtcType: $($etc).find('#etc-type-txt').val(),
                        SelectName: $($etc).find('#select-name-txt').val(),
                        SortNo: Number($($etc).find('#sort-no-txt').val()),
                        Value: $($etc).find('#value-txt').val(),
                        Caption: $($etc).find('#caption-txt').val(),
                        EtcMemo: $($etc).find('#etc-memo-textarea').val(),
                        IsUnchangeable: $('#is-unchangeable-check:checked').val() ?? '0',
                        IsUndeletable: $('#is-undeletable-check:checked').val() ?? '0',
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

                PopupForm1FormAMasterEtcForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMasterEtcForm.parameter);
                    Atype.btn_act_save('#etc-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAMasterEtcForm');
                }

                PopupForm1FormAMasterEtcForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMasterEtcForm.parameter);
                    Atype.btn_act_del('#etc-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAMasterEtcForm');
                }

                PopupForm1FormAMasterEtcForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAMasterEtcForm.btn_act_new()
                    await PopupForm1FormAMasterEtcForm.fetch_menu(Number(id));
                }

                PopupForm1FormAMasterEtcForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormAMasterEtcForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAMasterEtcForm.set_ui(response)
                }

                PopupForm1FormAMasterEtcForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let etc = response.data.Page[0];

                    const $etc = $('#etc-form')

                    $($etc).find('#Id').val(etc.Id)

                    $($etc).find('#etc-type-txt').val(etc.EtcType)
                    $($etc).find('#select-name-txt').val(etc.SelectName)
                    $($etc).find('#sort-no-txt').val(etc.SortNo)
                    $($etc).find('#value-txt').val(etc.Value)
                    $($etc).find('#caption-txt').val(etc.Caption)
                    $($etc).find('#etc-memo-textarea').val(etc.EtcMemo)
                    $($etc).find('#is-unchangeable-check').prop('checked', etc.IsUnchangeable == '1')
                    $($etc).find('#is-undeletable-check').prop('checked', etc.IsUndeletable == '1')
                }

            }( window.PopupForm1FormAMasterEtcForm = window.PopupForm1FormAMasterEtcForm || {}, jQuery ));
        </script>
    @endpush
@endonce
