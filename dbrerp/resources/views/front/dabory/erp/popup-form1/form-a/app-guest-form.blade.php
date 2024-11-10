{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary app-guest-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'app-guest-act',
        ])
    </div>
</div>

<div class="card mb-2" id="app-guest-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AppName'] }}</label>
                            <input type="text" id="app-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AppName'] }}"
                                {{ $formA['FormVars']['Required']['AppName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ApiUri'] }}</label>
                            <input type="text" id="api-uri-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ApiUri'] }}"
                                {{ $formA['FormVars']['Required']['ApiUri'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AppBase64'] }}</label>
                            <input type="text" id="app-base64-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AppBase64'] }}"
                                {{ $formA['FormVars']['Required']['AppBase64'] }}>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-on-use-check"> <label class="mb-0" for="is-on-use-check">{{ $formA['FormVars']['Title']['IsOnUse'] }}</label>
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
            $('.app-guest-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAAppGuestForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAAppGuestForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAAppGuestForm, $, undefined ) {
            PopupForm1FormAAppGuestForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAAppGuestForm.btn_act_new = function () {
                $('#modal-select-popup.popup-form1-form-a-app-guest-form .modal-dialog').css('maxWidth', '600px');

                Atype.set_parameter_callback(PopupForm1FormAAppGuestForm.parameter);
                Atype.btn_act_new('#app-guest-form #frm');
            }

            PopupForm1FormAAppGuestForm.btn_act_new_callback = function () {
                PopupForm1FormAAppGuestForm.btn_act_new()
            }

            PopupForm1FormAAppGuestForm.parameter = function () {
                const app_guest_form = $('#app-guest-form')

                let id = Number($(app_guest_form).find('#Id').val());
                let parameter = {
                    Id: id,
                    AppName: $(app_guest_form).find('#app-name-txt').val(),
                    ApiUri: $(app_guest_form).find('#api-uri-txt').val(),
                    AppBase64: $(app_guest_form).find('#app-base64-txt').val(),
                    IsOnUse: $(app_guest_form).find('#is-on-use-check:checked').val() ?? '0',
                }
                if (id < 0) {
                    parameter = { Id: id }
                }

                // console.log(parameter)
                return parameter;
            }

            PopupForm1FormAAppGuestForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAAppGuestForm.parameter);
                Atype.btn_act_save('#app-guest-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAAppGuestForm');
            }

            PopupForm1FormAAppGuestForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAAppGuestForm.parameter);
                Atype.btn_act_del('#app-guest-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAAppGuestForm');
            }

            PopupForm1FormAAppGuestForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAAppGuestForm.btn_act_new()
                await PopupForm1FormAAppGuestForm.fetch_app_guest(Number(id));
            }

            PopupForm1FormAAppGuestForm.fetch_app_guest = async function (id) {
                let response = await get_api_data(PopupForm1FormAAppGuestForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAAppGuestForm.set_app_guest_ui(response)
            }

            PopupForm1FormAAppGuestForm.set_app_guest_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let app_guest = response.data.Page[0];
                // console.log(menu)

                const app_guest_form = $('#app-guest-form')

                $(app_guest_form).find('#Id').val(app_guest.Id)

                $(app_guest_form).find('#app-name-txt').val(app_guest.AppName)
                $(app_guest_form).find('#api-uri-txt').val(app_guest.ApiUri)
                $(app_guest_form).find('#app-base64-txt').val(app_guest.AppBase64)

                $(app_guest_form).find('#is-on-use-check').prop('checked', app_guest.IsOnUse == '1')
            }

        }( window.PopupForm1FormAAppGuestForm = window.PopupForm1FormAAppGuestForm || {}, jQuery ));
    </script>
@endpush
@endonce
