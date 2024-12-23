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

<div class="card mb-2" id="menu-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 310px"> <!--200-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group {{ $formA['FormVars']['Display']['MenuCode'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MenuCode'] }}</label>
                            <input type="text" id="menu-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['MenuCode'] }}"
                                {{ $formA['FormVars']['Required']['MenuCode'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['MenuLang0'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MenuLang0'] }}</label>
                            <input type="text" id="menu-lang0-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['MenuLang0'] }}"
                                {{ $formA['FormVars']['Required']['MenuLang0'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['PageUri'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PageUri'] }}</label>
                            <input type="text" id="page-uri-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['PageUri'] }}"
                                {{ $formA['FormVars']['Required']['PageUri'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['ParaName'] }} flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ParaName'] }}</label>
                            <input type="text" id="para-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ParaName'] }}"
                                {{ $formA['FormVars']['Required']['ParaName'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 310px"> <!--200-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formA['FormVars']['Display']['Icon'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Icon'] }}</label>
                            <input type="text" id="icon-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Icon'] }}"
                                {{ $formA['FormVars']['Required']['Icon'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['ManualUri'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ManualUri'] }}</label>
                            <input type="text" id="manual-uri-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ManualUri'] }}"
                                {{ $formA['FormVars']['Required']['ManualUri'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['SortType'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SortType'] }}</label>
                            <input type="text" id="sort-type-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SortType'] }}"
                                {{ $formA['FormVars']['Required']['SortType'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['ThemeDir'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ThemeDir'] }}</label>
                            <input type="text" id="theme-dir-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ThemeDir'] }}"
                                {{ $formA['FormVars']['Required']['ThemeDir'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['GuestAppId'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['GuestAppId'] }}</label>
                            <select id="guest-app-id-select" class="rounded w-100"
                                {{ $formA['FormVars']['Required']['GuestAppId'] }}>
                                <option value="0">없음</option>
                            </select>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['MainAppId'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MainAppId'] }}</label>
                            <select id="main-app-id-select" class="rounded w-100"
                                {{ $formA['FormVars']['Required']['MainAppId'] }}>
                                <option value="0">없음</option>
                            </select>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['CustomVar'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CustomVar'] }}</label>
                            <input type="text" id="custom-var-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CustomVar'] }}"
                                {{ $formA['FormVars']['Required']['CustomVar'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="align-items-center position-relative mb-2">
                            <div class="mb-0">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TabbedMenuHash'] }}</label>
                            </div>
                            <input type="text" id="tabbed-menu-hash-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TabbedMenuHash'] }}"
                                {{ $formA['FormVars']['Required']['TabbedMenuHash'] }} readonly>
                            <div class="position-absolute input-icon2">
                                <i class="copy-btn icon-copy3" data-clipboard-target="#tabbed-menu-hash-txt"></i>

                            </div>
                        </div>


                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="disable-l-menu-check"> <label class="mb-0" for="disable-l-menu-check">{{ $formA['FormVars']['Title']['DisableLMenu'] }}</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="enable-r-menu-check"> <label class="mb-0" for="enable-r-menu-check">{{ $formA['FormVars']['Title']['EnableRMenu'] }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-skipped-check"> <label class="mb-0" for="is-skipped-check">{{ $formA['FormVars']['Title']['IsSkipped'] }}</label>
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
                    case 'save': PopupForm1FormAMenuForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAMenuForm.btn_act_del(); break;
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
            $('#menu-form').find('#guest-app-id-select').append(options)
            $('#menu-form').find('#main-app-id-select').append(options)

            activate_button_group()
        });

        (function( PopupForm1FormAMenuForm, $, undefined ) {
            PopupForm1FormAMenuForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAMenuForm.btn_act_new = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuForm.parameter);
                Atype.btn_act_new('#menu-form #frm');
            }

            PopupForm1FormAMenuForm.btn_act_new_callback = function () {
                PopupForm1FormAMenuForm.btn_act_new()
            }

            PopupForm1FormAMenuForm.parameter = function () {
                let id = Number($('#menu-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    MenuCode: $('#menu-form').find('#menu-code-txt').val(),
                    MenuLang0: $('#menu-form').find('#menu-lang0-txt').val(),
                    PageUri: $('#menu-form').find('#page-uri-txt').val(),
                    ParaName: $('#menu-form').find('#para-name-txt').val(),
                    Icon: $('#menu-form').find('#icon-txt').val(),
                    ManualUri: $('#menu-form').find('#manual-uri-txt').val(),
                    SortType: $('#menu-form').find('#sort-type-txt').val(),
                    ThemeDir: $('#menu-form').find('#theme-dir-txt').val(),
                    GuestAppId: Number($('#menu-form').find('#guest-app-id-select').val()),
                    MainAppId: Number($('#menu-form').find('#main-app-id-select').val()),
                    CustomVar: $('#menu-form').find('#custom-var-txt').val(),
                    TabbedMenuHash: $('#menu-form').find('#tabbed-menu-hash-txt').val(),

                    DisableLMenu: $('#disable-l-menu-check:checked').val() ?? '0',
                    EnableRMenu: $('#enable-r-menu-check:checked').val() ?? '0',
                    IsSkipped: $('#is-skipped-check:checked').val() ?? '0',
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

            PopupForm1FormAMenuForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuForm.parameter);
                Atype.btn_act_save('#menu-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMenuForm');
            }

            PopupForm1FormAMenuForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuForm.parameter);
                Atype.btn_act_del('#menu-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMenuForm');
            }

            PopupForm1FormAMenuForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMenuForm.btn_act_new()
                await PopupForm1FormAMenuForm.fetch_menu(Number(id));
            }

            PopupForm1FormAMenuForm.fetch_menu = async function (id) {
                let response = await get_api_data(PopupForm1FormAMenuForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMenuForm.set_menu_ui(response)
            }

            PopupForm1FormAMenuForm.set_menu_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let menu = response.data.Page[0];
                // console.log(menu)

                $('#menu-form').find('#Id').val(menu.Id)

                $('#menu-form').find('#menu-code-txt').val(menu.MenuCode)
                $('#menu-form').find('#menu-lang0-txt').val(menu.MenuLang0)
                $('#menu-form').find('#page-uri-txt').val(menu.PageUri)

                $('#menu-form').find('#para-name-txt').val(menu.ParaName)
                $('#menu-form').find('#icon-txt').val(menu.Icon)
                $('#menu-form').find('#manual-uri-txt').val(menu.ManualUri)
                $('#menu-form').find('#tabbed-menu-hash-txt').val(menu.TabbedMenuHash)

                $('#menu-form').find('#sort-type-txt').val(menu.SortType)
                $('#menu-form').find('#theme-dir-txt').val(menu.ThemeDir)
                $('#menu-form').find('#guest-app-id-select').val(menu.GuestAppId)
                $('#menu-form').find('#main-app-id-select').val(menu.MainAppId)
                $('#menu-form').find('#disable-l-menu-check').prop('checked', menu.DisableLMenu == '1')
                $('#menu-form').find('#enable-r-menu-check').prop('checked', menu.EnableRMenu == '1')
                $('#menu-form').find('#is-skipped-check').prop('checked', menu.IsSkipped == '1')
            }

        }( window.PopupForm1FormAMenuForm = window.PopupForm1FormAMenuForm || {}, jQuery ));
    </script>
@endpush
@endonce
