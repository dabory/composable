{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary theme-setup-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'theme-setup-act',
        ])
    </div>
</div>

<div class="card mb-2" id="theme-setup-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px"> <!--200-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group {{ $formA['FormVars']['Display']['SetupName'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SetupName'] }}</label>
                            <input type="text" id="setup-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SetupName'] }}"
                                {{ $formA['FormVars']['Required']['SetupName'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['SetupCode'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SetupCode'] }}</label>
                            <input type="text" id="setup-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SetupCode'] }}"
                                {{ $formA['FormVars']['Required']['SetupCode'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['SetupType'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SetupType'] }}</label>
                            <input type="text" id="setup-type-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SetupType'] }}"
                                {{ $formA['FormVars']['Required']['SetupType'] }}>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px"> <!--200-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formA['FormVars']['Display']['Parameter'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Parameter'] }}</label>
                            <input type="text" id="parameter-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Parameter'] }}"
                                {{ $formA['FormVars']['Required']['Parameter'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['Component'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Component'] }}</label>
                            <input type="text" id="component-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Component'] }}"
                                {{ $formA['FormVars']['Required']['Component'] }}>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-on-use-check"> <label class="mb-0" for="is-on-use-check">{{ $formA['FormVars']['Title']['IsOnUse'] }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-default-check"> <label class="mb-0" for="is-default-check">{{ $formA['FormVars']['Title']['IsDefault'] }}</label>
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
            $('.theme-setup-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAThemeSetupForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAThemeSetupForm.btn_act_del(); break;
                }
            });

            $('.copy-btn').on('click', function() {
                let copyText = $('#tabbed-menu-hash-txt');
                copyText.select();
                document.execCommand("copy");

                // 사용자에게 복사 완료 알림
                alert('Copied to clipboard: ' + copyText.val());
            });

            let response = await get_api_data('app-guest-page', {
                PageVars: {
                    Query: 'is_on_use = 1',
                    Asc: 'app_name',
                    Limit: 9999999,
                    Offset: 0
                }
            })

            const options = custom_create_options('Id', 'AppName', response.data.Page)
            $('#theme-setup-form').find('#guest-app-id-select').append(options)
            $('#theme-setup-form').find('#main-app-id-select').append(options)

            activate_button_group()
        });

        (function( PopupForm1FormAThemeSetupForm, $, undefined ) {
            PopupForm1FormAThemeSetupForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAThemeSetupForm.btn_act_new = function () {
                Atype.set_parameter_callback(PopupForm1FormAThemeSetupForm.parameter);
                Atype.btn_act_new('#theme-setup-form #frm');
            }

            PopupForm1FormAThemeSetupForm.btn_act_new_callback = function () {
                PopupForm1FormAThemeSetupForm.btn_act_new()
            }

            PopupForm1FormAThemeSetupForm.parameter = function () {
                let id = Number($('#theme-setup-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupName: $('#theme-setup-form').find('#setup-name-txt').val(),
                    SetupCode: $('#theme-setup-form').find('#setup-code-txt').val(),
                    SetupType: $('#theme-setup-form').find('#setup-type-txt').val(),
                    Parameter: $('#theme-setup-form').find('#parameter-txt').val(),
                    Component: $('#theme-setup-form').find('#component-txt').val(),
                    IsOnUse: $('#is-on-use-check:checked').val() ?? '0',
                    IsDefault: $('#is-default-check:checked').val() ?? '0',
                    SetupJson:  $('#theme-setup-form').find('#setup-json-txt').val()
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                console.log('save : ', parameter)
                return parameter;
            }

            PopupForm1FormAThemeSetupForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAThemeSetupForm.parameter);
                Atype.btn_act_save('#theme-setup-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAThemeSetupForm');
            }

            PopupForm1FormAThemeSetupForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAThemeSetupForm.parameter);
                Atype.btn_act_del('#theme-setup-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAThemeSetupForm');
            }

            PopupForm1FormAThemeSetupForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAThemeSetupForm.btn_act_new()
                await PopupForm1FormAThemeSetupForm.fetch_menu(Number(id));
            }

            PopupForm1FormAThemeSetupForm.fetch_menu = async function (id) {
                let response = await get_api_data(PopupForm1FormAThemeSetupForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAThemeSetupForm.set_ui(response)
            }

            PopupForm1FormAThemeSetupForm.set_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let theme_setup = response.data.Page[0];
                // console.log(theme_setup)

                $('#theme-setup-form').find('#Id').val(theme_setup.Id)

                $('#theme-setup-form').find('#setup-name-txt').val(theme_setup.SetupName)
                $('#theme-setup-form').find('#setup-code-txt').val(theme_setup.SetupCode)
                $('#theme-setup-form').find('#setup-type-txt').val(theme_setup.SetupType)

                $('#theme-setup-form').find('#parameter-txt').val(theme_setup.Parameter)
                $('#theme-setup-form').find('#component-txt').val(theme_setup.Icon)

                $('#theme-setup-form').find('#is-on-use-check').prop('checked', theme_setup.IsOnUse == '1')
                $('#theme-setup-form').find('#is-default-check').prop('checked', theme_setup.IsDefault == '1')

            }

        }( window.PopupForm1FormAThemeSetupForm = window.PopupForm1FormAThemeSetupForm || {}, jQuery ));
    </script>
@endpush
@endonce
