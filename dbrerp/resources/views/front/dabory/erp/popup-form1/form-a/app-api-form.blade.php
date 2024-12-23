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

<div class="card mb-2" id="app-api-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ApiCode'] }}</label>
                            <input type="text" id="api-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ApiCode'] }}"
                                {{ $formA['FormVars']['Required']['ApiCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ApiUri'] }}</label>
                            <input type="text" id="api-uri-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ApiUri'] }}"
                                {{ $formA['FormVars']['Required']['ApiUri'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['QueryName'] }}</label>
                            <input type="text" id="query-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['QueryName'] }}"
                                {{ $formA['FormVars']['Required']['QueryName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ApiDesc'] }}</label>
                            <textarea id="api-desc-textarea" maxlength="{{ $formA['FormVars']['MaxLength']['ApiDesc'] }}"
                                {{ $formA['FormVars']['Required']['ApiDesc'] }}></textarea>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-deprecated-check"> <label class="mb-0" for="is-deprecated-check">{{ $formA['FormVars']['Title']['IsDeprecated'] }}</label>
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
                $('.users-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAAppApiForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAAppApiForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormAAppApiForm, $, undefined ) {
                PopupForm1FormAAppApiForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormAAppApiForm.btn_act_new = function () {
                    Atype.set_parameter_callback(PopupForm1FormAAppApiForm.parameter);
                    Atype.btn_act_new('#app-api-form #frm');
                }

                PopupForm1FormAAppApiForm.btn_act_new_callback = function () {
                    PopupForm1FormAAppApiForm.btn_act_new()
                }

                PopupForm1FormAAppApiForm.parameter = function () {
                    const $app_api_form = $('#app-api-form')
                    let id = Number($($app_api_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        CreatedOn: get_now_time_stamp(),
                        UpdatedOn: get_now_time_stamp(),
                        ApiCode: $($app_api_form).find('#api-code-txt').val(),
                        ApiUri: $($app_api_form).find('#api-uri-txt').val(),
                        QueryName: $($app_api_form).find('#query-name-txt').val(),
                        ApiDesc: $($app_api_form).find('#api-desc-textarea').val(),
                        IsDeprecated: $('#is-deprecated-check:checked').val() ?? '0',
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

                PopupForm1FormAAppApiForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAAppApiForm.parameter);
                    Atype.btn_act_save('#app-api-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAAppApiForm');
                }

                PopupForm1FormAAppApiForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAAppApiForm.parameter);
                    Atype.btn_act_del('#app-api-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAAppApiForm');
                }

                PopupForm1FormAAppApiForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAAppApiForm.btn_act_new()
                    await PopupForm1FormAAppApiForm.fetch_menu(Number(id));
                }

                PopupForm1FormAAppApiForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormAAppApiForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAAppApiForm.set_ui(response)
                }

                PopupForm1FormAAppApiForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let app_api = response.data.Page[0];

                    const $app_api_form = $('#app-api-form')

                    $($app_api_form).find('#Id').val(app_api.Id)

                    $($app_api_form).find('#api-code-txt').val(app_api.ApiCode)
                    $($app_api_form).find('#api-uri-txt').val(app_api.ApiUri)
                    $($app_api_form).find('#query-name-txt').val(app_api.QueryName)
                    $($app_api_form).find('#api-desc-textarea').val(app_api.ApiDesc)
                    $($app_api_form).find('#is-deprecated-check').prop('checked', app_api.IsDeprecated == '1')
                }

            }( window.PopupForm1FormAAppApiForm = window.PopupForm1FormAAppApiForm || {}, jQuery ));
        </script>
    @endpush
@endonce
