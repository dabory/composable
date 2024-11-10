{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary main-menu-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'main-menu-act',
        ])
    </div>
</div>

<div class="card mb-2" id="main-menu-form">
    <div class="card-header" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MenuCode'] }}</label>
                            <input type="text" id="menu-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['MenuCode'] }}"
                                {{ $formA['FormVars']['Required']['MenuCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MenuName'] }}</label>
                            <input type="text" id="menu-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['MenuName'] }}"
                                {{ $formA['FormVars']['Required']['MenuName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PageUri'] }}</label>
                            <input type="text" id="page-uri-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['PageUri'] }}"
                                {{ $formA['FormVars']['Required']['PageUri'] }}>
                        </div>
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
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['LangType'] }}</label>
                            <select class="rounded w-100" id="lang-type-select">
                                @foreach ($codeTitle['lang-type']['lang-type'] as $key => $lang_type)
                                    <option value="{{ $lang_type['Code'] }}">
                                        {{ $lang_type['Title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['LinkType'] }}</label>
                            <select id="link-type-select" class="rounded w-100" autocomplete="off" onchange="PopupForm1FormAMainMenuForm.change_link_type(this)">
                                <option value="0">일반페이지</option>
                                <option value="1">품목분류</option>
                                <option value="2">게시판</option>
                            </select>
                        </div>
                        <div class="form-group flex-column mb-2 type-code-div" style="display: none;">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TypeCode'] }}</label>
                            <select id="type-code-select" class="rounded w-100" autocomplete="off" onchange="PopupForm1FormAMainMenuForm.change_type_code(this)">
                            </select>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select id="sort-select" class="rounded w-100" autocomplete="off" onchange="Atype.change_auto_slip_no_select(this, '#sort-txt', '#main-menu-form')">
                                <option value="primary">primary</option>
                                <option value="top">top</option>
                                <option value="footer">footer</option>
                                <option value="site-map">site-map</option>
                                <option value="input">직접입력</option>
                            </select>
                        </div>
                        <div class="form-group d-none flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DirectInput'] }}</label>
                            <input class="rounded w-100" type="text" id="direct-input-txt" onchange="Atype.change_direct_input_txt(this, '#sort-txt', '#main-menu-form')">
                        </div>
                        <div class="d-none">
                            <input class="rounded w-100" type="text" id="sort-txt">
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select id="status-select" class="rounded w-100" autocomplete="off">
                                <option value="all">all</option>
                                <option value="login-only">login-only</option>
                                <option value="logout-only">logout-only</option>
                            </select>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Icon'] }}</label>
                            <input type="text" id="icon-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Icon'] }}"
                                {{ $formA['FormVars']['Required']['Icon'] }}>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['CustomVar'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CustomVar'] }}</label>
                            <input type="text" id="custom-var-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CustomVar'] }}"
                                {{ $formA['FormVars']['Required']['CustomVar'] }}>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-skipped-check"> <label class="mb-0" for="is-skipped-check">{{ $formA['FormVars']['Title']['IsSkipped'] }}</label>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-tgt-blank-check"> <label class="mb-0" for="is-tgt-blank-check">{{ $formA['FormVars']['Title']['IsTgtBlank'] }}</label>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-off-pc-check"> <label class="mb-0" for="is-off-pc-check">{{ $formA['FormVars']['Title']['IsOffPc'] }}</label>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-off-mobile-check"> <label class="mb-0" for="is-off-mobile-check">{{ $formA['FormVars']['Title']['IsOffMobile'] }}</label>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-off-tablet-check"> <label class="mb-0" for="is-off-tablet-check">{{ $formA['FormVars']['Title']['IsOffTablet'] }}</label>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-login-only-check"> <label class="mb-0" for="is-login-only-check">{{ $formA['FormVars']['Title']['IsLoginOnly'] }}</label>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-logout-only-check"> <label class="mb-0" for="is-logout-only-check">{{ $formA['FormVars']['Title']['IsLogoutOnly'] }}</label>
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
                $('.main-menu-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAMainMenuForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAMainMenuForm.btn_act_del(); break;
                    }
                });

                $('.copy-btn').on('click', function() {
                    let copyText = $('#tabbed-menu-hash-txt');
                    copyText.select();
                    document.execCommand("copy");

                    // 사용자에게 복사 완료 알림
                    alert('Copied to clipboard: ' + copyText.val());
                });

                const igroupPage = await get_api_data('igroup-page', {
                    PageVars: {
                        Limit: 9999999,
                        Offset: 0,
                        Asc: 'igroup_name'
                    }
                })

                const postPage = await get_api_data('post-type-page', {
                    PageVars: {
                        Limit: 9999999,
                        Offset: 0,
                        Asc: 'post_code'
                    }
                })

                PopupForm1FormAMainMenuForm.igroupPage = igroupPage.data.Page
                PopupForm1FormAMainMenuForm.postTypePage = postPage.data.Page

                activate_button_group()
            });

            (function( PopupForm1FormAMainMenuForm, $, undefined ) {
                PopupForm1FormAMainMenuForm.formA = {!! json_encode($formA) !!};
                PopupForm1FormAMainMenuForm.igroupPage = [];
                PopupForm1FormAMainMenuForm.postTypePage = [];

                PopupForm1FormAMainMenuForm.change_type_code = function ($this) {
                    const main_menu_form = $('#main-menu-form')

                    const page_url = $(main_menu_form).find('#page-uri-txt').data('base-page') + '/' + $($this).val()
                    $(main_menu_form).find('#page-uri-txt').val(page_url)
                }

                PopupForm1FormAMainMenuForm.change_link_type = function ($this) {
                    const main_menu_form = $('#main-menu-form')

                    switch (Number($($this).val())) {
                        case 0:
                            $(main_menu_form).find('#page-uri-txt').val('/')
                            $(main_menu_form).find('#page-uri-txt').prop('disabled', false)
                            $(main_menu_form).find('.type-code-div').hide()
                            $(main_menu_form).find('#type-code-select').html('')
                            break;
                        case 1:
                            $(main_menu_form).find('#type-code-select').html(custom_create_options('IgroupCode', 'IgroupName', PopupForm1FormAMainMenuForm.igroupPage))

                            $(main_menu_form).find('#page-uri-txt').data('base-page', '/item-gallery')
                            $(main_menu_form).find('#page-uri-txt').prop('disabled', true)
                            $(main_menu_form).find('.type-code-div').show()

                            PopupForm1FormAMainMenuForm.change_type_code($(main_menu_form).find('#type-code-select'))
                            break;
                        case 2:
                            $(main_menu_form).find('#type-code-select').html(custom_create_options('TypeSlug', 'PostCode', PopupForm1FormAMainMenuForm.postTypePage))

                            $(main_menu_form).find('#page-uri-txt').data('base-page', '/post')
                            $(main_menu_form).find('#page-uri-txt').prop('disabled', true)
                            $(main_menu_form).find('.type-code-div').show()

                            PopupForm1FormAMainMenuForm.change_type_code($(main_menu_form).find('#type-code-select'))
                            break;
                    }
                }

                PopupForm1FormAMainMenuForm.btn_act_new = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMainMenuForm.parameter);
                    Atype.btn_act_new('#main-menu-form #frm');

                    Atype.change_auto_slip_no_select($('#main-menu-form').find('#sort-select'), '#sort-txt', '#main-menu-form')

                    $('#main-menu-form').find('#page-uri-txt').prop('disabled', false)
                }

                PopupForm1FormAMainMenuForm.btn_act_new_callback = function () {
                    PopupForm1FormAMainMenuForm.btn_act_new()
                }

                PopupForm1FormAMainMenuForm.parameter = function () {
                    const main_menu_form = $('#main-menu-form')

                    let id = Number($(main_menu_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        CreatedOn: get_now_time_stamp(),
                        UpdatedOn: get_now_time_stamp(),
                        MenuCode: $(main_menu_form).find('#menu-code-txt').val(),
                        MenuName: $(main_menu_form).find('#menu-name-txt').val(),
                        PageUri: $(main_menu_form).find('#page-uri-txt').val(),
                        TabbedMenuHash: $(main_menu_form).find('#tabbed-menu-hash-txt').val(),

                        LangType: $(main_menu_form).find('#lang-type-select').val(),
                        DeviceType: $(main_menu_form).find('#device-type-select').val(),
                        LinkType: $(main_menu_form).find('#link-type-select').val(),
                        Sort: $(main_menu_form).find('#sort-txt').val(),
                        Status: $(main_menu_form).find('#status-select').val(),
                        TypeCode: $(main_menu_form).find('#type-code-select').val() ?? '',
                        Icon: $(main_menu_form).find('#icon-txt').val(),
                        CustomVar: $(main_menu_form).find('#custom-var-txt').val(),

                        IsSkipped: $(main_menu_form).find('#is-skipped-check:checked').val() ?? '0',
                        IsTgtBlank: $(main_menu_form).find('#is-tgt-blank-check:checked').val() ?? '0',

                        IsOffPc: $(main_menu_form).find('#is-off-pc-check:checked').val() ?? '0',
                        IsOffMobile: $(main_menu_form).find('#is-off-mobile-check:checked').val() ?? '0',
                        IsOffTablet: $(main_menu_form).find('#is-off-tablet-check:checked').val() ?? '0',
                        IsLoginOnly: $(main_menu_form).find('#is-login-only-check:checked').val() ?? '0',
                        IsLogoutOnly: $(main_menu_form).find('#is-logout-only-check:checked').val() ?? '0',
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

                PopupForm1FormAMainMenuForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMainMenuForm.parameter);
                    Atype.btn_act_save('#main-menu-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAMainMenuForm');
                }

                PopupForm1FormAMainMenuForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAMainMenuForm.parameter);
                    Atype.btn_act_del('#main-menu-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAMainMenuForm');
                }

                PopupForm1FormAMainMenuForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAMainMenuForm.btn_act_new()
                    await PopupForm1FormAMainMenuForm.fetch_menu(Number(id));
                }

                PopupForm1FormAMainMenuForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormAMainMenuForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAMainMenuForm.set_menu_ui(response)
                }

                PopupForm1FormAMainMenuForm.set_menu_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    const menu = response.data.Page[0]
                    const main_menu_form = $('#main-menu-form')

                    $(main_menu_form).find('#Id').val(menu.Id)

                    $(main_menu_form).find('#menu-code-txt').val(menu.MenuCode)
                    $(main_menu_form).find('#menu-name-txt').val(menu.MenuName)

                    $(main_menu_form).find('#lang-type-select').val(menu.LangType)
                    $(main_menu_form).find('#device-type-select').val(menu.DeviceType)
                    $(main_menu_form).find('#link-type-select').val(menu.LinkType)
                    PopupForm1FormAMainMenuForm.change_link_type($(main_menu_form).find('#link-type-select'))
                    // $(main_menu_form).find('#sort-select').val(menu.Sort)
                    Atype.input_auto_slip_no_txt(menu.Sort, '#sort-select', '#sort-txt', '#main-menu-form', ['primary', 'top', 'footer', 'site-map'])

                    $(main_menu_form).find('#status-select').val(menu.Status)
                    $(main_menu_form).find('#type-code-select').val(menu.TypeCode)
                    $(main_menu_form).find('#icon-txt').val(menu.Icon)

                    $(main_menu_form).find('#page-uri-txt').val(menu.PageUri)
                    $(main_menu_form).find('#tabbed-menu-hash-txt').val(menu.TabbedMenuHash)

                    $(main_menu_form).find('#is-skipped-check').prop('checked', menu.IsSkipped === '1')
                    $(main_menu_form).find('#is-tgt-blank-check').prop('checked', menu.IsTgtBlank === '1')

                    $(main_menu_form).find('#is-off-pc-check').prop('checked', menu.IsOffPc === '1')
                    $(main_menu_form).find('#is-off-mobile-check').prop('checked', menu.IsOffMobile === '1')
                    $(main_menu_form).find('#is-off-tablet-check').prop('checked', menu.IsOffTablet === '1')
                    $(main_menu_form).find('#is-login-only-check').prop('checked', menu.IsLoginOnly === '1')
                    $(main_menu_form).find('#is-logout-only-check').prop('checked', menu.IsLogoutOnly === '1')
                }

            }( window.PopupForm1FormAMainMenuForm = window.PopupForm1FormAMainMenuForm || {}, jQuery ));
        </script>
    @endpush
@endonce
