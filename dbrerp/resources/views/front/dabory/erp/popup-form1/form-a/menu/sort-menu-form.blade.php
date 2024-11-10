{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary sort-menu-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'sort-menu-act',
        ])
    </div>
</div>

<div class="card mb-2" id="sort-menu-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
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
                        <div class="form-group {{ $formA['FormVars']['Display']['SortType'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SortType'] }}</label>
                            <input type="text" id="sort-type-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SortType'] }}"
                                {{ $formA['FormVars']['Required']['SortType'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['BgcolorCode'] }} flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['BgcolorCode'] }}</label>
                            <input type="text" id="bgcolor-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['BgcolorCode'] }}"
                                {{ $formA['FormVars']['Required']['BgcolorCode'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formA['FormVars']['Display']['DashPageUrl'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DashPageUrl'] }}</label>
                            <input type="text" id="dash-page-url-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DashPageUrl'] }}"
                                {{ $formA['FormVars']['Required']['DashPageUrl'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['Component'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Component'] }}</label>
                            <input type="text" id="component-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Component'] }}"
                                {{ $formA['FormVars']['Required']['Component'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['Parameter'] }} flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Parameter'] }}</label>
                            <input type="text" id="parameter-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Parameter'] }}"
                                {{ $formA['FormVars']['Required']['Parameter'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $formA['FormVars']['Display']['Icon'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Icon'] }}</label>
                            <input type="text" id="icon-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Icon'] }}"
                                {{ $formA['FormVars']['Required']['Icon'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['MgtType'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MgtType'] }}</label>
                            <select type="text" id="mgt-type-select" class="rounded w-100" autocomplete="off"
                                {{ $formA['FormVars']['Required']['MgtType'] }}>
                                <option value="user">user</option>
                                <option value="member">member</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-enabled-check"> <label class="mb-0" for="is-enabled-check">{{ $formA['FormVars']['Title']['IsEnabled'] }}</label>
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
            $('.sort-menu-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAMenuSortMenuForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAMenuSortMenuForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAMenuSortMenuForm, $, undefined ) {
            PopupForm1FormAMenuSortMenuForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAMenuSortMenuForm.btn_act_new = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuSortMenuForm.parameter);
                Atype.btn_act_new('#sort-menu-form #frm');
            }

            PopupForm1FormAMenuSortMenuForm.btn_act_new_callback = function () {
                PopupForm1FormAMenuSortMenuForm.btn_act_new()
            }

            PopupForm1FormAMenuSortMenuForm.parameter = function () {
                let id = Number($('#sort-menu-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    MenuCode: $('#sort-menu-form').find('#menu-code-txt').val(),
                    SortType: $('#sort-menu-form').find('#sort-type-txt').val(),
                    BgcolorCode: $('#sort-menu-form').find('#bgcolor-code-txt').val(),
                    DashPageUrl: $('#sort-menu-form').find('#dash-page-url-txt').val(),
                    Component: $('#sort-menu-form').find('#component-txt').val(),
                    Parameter: $('#sort-menu-form').find('#parameter-txt').val(),
                    Icon: $('#sort-menu-form').find('#icon-txt').val(),
                    MgtType: $('#sort-menu-form').find('#mgt-type-select').val(),
                    IsEnabled: $('#is-enabled-check:checked').val() ?? '0',
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

            PopupForm1FormAMenuSortMenuForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuSortMenuForm.parameter);
                Atype.btn_act_save('#sort-menu-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMenuSortMenuForm');
            }

            PopupForm1FormAMenuSortMenuForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAMenuSortMenuForm.parameter);
                Atype.btn_act_del('#sort-menu-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMenuSortMenuForm');
            }

            PopupForm1FormAMenuSortMenuForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMenuSortMenuForm.btn_act_new()
                await PopupForm1FormAMenuSortMenuForm.fetch_menu(Number(id));
            }

            PopupForm1FormAMenuSortMenuForm.fetch_menu = async function (id) {
                let response = await get_api_data(PopupForm1FormAMenuSortMenuForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMenuSortMenuForm.set_menu_ui(response)
            }

            PopupForm1FormAMenuSortMenuForm.set_menu_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const menu = response.data.Page[0];

                $('#sort-menu-form').find('#Id').val(menu.Id)

                $('#sort-menu-form').find('#menu-code-txt').val(menu.MenuCode)
                $('#sort-menu-form').find('#sort-type-txt').val(menu.SortType)
                $('#sort-menu-form').find('#bgcolor-code-txt').val(menu.BgcolorCode)

                $('#sort-menu-form').find('#dash-page-url-txt').val(menu.DashPageUrl)
                $('#sort-menu-form').find('#component-txt').val(menu.Component)
                $('#sort-menu-form').find('#parameter-txt').val(menu.Parameter)

                $('#sort-menu-form').find('#icon-txt').val(menu.Icon)
                $('#sort-menu-form').find('#mgt-type-select').val(menu.MgtType)
                $('#sort-menu-form').find('#is-enabled-check').prop('checked', menu.IsEnabled == '1')
            }

        }( window.PopupForm1FormAMenuSortMenuForm = window.PopupForm1FormAMenuSortMenuForm || {}, jQuery ));
    </script>
@endpush
@endonce
