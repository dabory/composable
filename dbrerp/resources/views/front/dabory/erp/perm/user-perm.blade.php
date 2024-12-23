@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
<div class="content perm">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-1 pt-2 text-right">
                    <button type="button" hidden
                            class="btn btn-success btn-open-modal modal-btn">
                    </button>

                    <button type="button"
                            class="btn btn-success btn-open-modal"
                            data-target="slip"
                            data-clicked="Btype.fetch_slip_form_book"
                            data-variable="userPermModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary user-perm-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'user-perm-act',
                        ])
                    </div>
                </div>

                <div class="card" id="user-perm-form">
                    <div class="card-header" id="frm">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="Id" name="Id" value="0">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                            <select class="rounded w-100" id="auto-slip-no-select" onchange="Btype.change_auto_slip_no_select(this)"
                                                {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                                @foreach($formB['SlipNoOptions'] as $option)
                                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                                @endforeach
                                                <option value="input">직접입력</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['DirectInput'] }}</label>
                                            <input class="rounded w-100" type="text" id="direct-input-txt" onchange="Btype.change_direct_input_txt(this)">
                                        </div>
                                        <div class="d-none">
                                            <input class="rounded w-100" type="text" id="auto-slip-no-txt" required>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                            <input class="rounded w-100" type="date" value="" id="user-perm-date"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                                {{ $formB['FormVars']['Required']['Date'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['SortType'] }}</label>
                                            <select class="rounded w-100" id="sort-type-select" onchange="change_sort_type()"
                                                {{ $formB['FormVars']['Required']['SortType'] }}>
                                                <option value="">전체</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['PermissionId'] }}</label>
                                            <input class="rounded w-100" type="text" value="" id="permission-id-txt"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PermissionId'] }}"
                                                {{ $formB['FormVars']['Required']['PermissionId'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['CreatedDate'] }}</label>
                                            <input class="rounded w-100" type="text" value="" id="created-date-txt"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['CreatedDate'] }}"
                                                {{ $formB['FormVars']['Required']['CreatedDate'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['UpdateDate'] }}</label>
                                            <input class="rounded w-100" type="text" value="" id="update-date-txt"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['UpdateDate'] }}"
                                                {{ $formB['FormVars']['Required']['UpdateDate'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['PermissionName'] }}</label>
                                            <input class="rounded w-100" type="text" value="" id="permission-name-txt"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PermissionName'] }}"
                                                {{ $formB['FormVars']['Required']['PermissionName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Description'] }}</label>
                                            <textarea style="height: 85px" class="rounded w-100" id="description-txt-area"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 mt-2 mx-2">
                        <div>
                            <div class="d-flex justify-content-end">
                                @if ($formB['FormVars']['Hidden']['AddNewBdButton'] == 'hidden')
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary user-perm-bd-act" data-parameter="{{ $formB['BodySelectOptions'][0]['ParameterName'] ?? '' }}" data-value="{{ $formB['BodySelectOptions'][0]['Value'] }}">
                                            {{ $formB['BodySelectOptions'][0]['Caption'] }}
                                        </button>

                                        @include('front.dabory.erp.partial.select-btn-options', [
                                            'selectBtns' => array_slice($formB['BodySelectOptions'], 1),
                                            'eventClassName' => 'user-perm-bd-act'
                                        ])
                                    </div>
                                @else
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary user-perm-bd-act" data-value="add">
                                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                        </button>

                                        @include('front.dabory.erp.partial.select-btn-options', [
                                            'selectBtns' => $formB['BodySelectOptions'],
                                            'eventClassName' => 'user-perm-bd-act'
                                        ])
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                                <table class="table-row user-perm-table">
                                    <thead id="user-perm-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                    </thead>
                                    <tbody id="user-perm-table-body">
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                                <div class="d-flex flex-column flex-md-row">
                                    <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                        <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SumTotal'] }}
                                        rowspan="1" colspan="1">
                                            {{ $formB['FooterVars']['Title']['SumTotal'] }}
                                        </label>
                                        <input type="text" class="w-100 w-md-80 rounded" id="SumTotal" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $userPermModal])
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.user-perm-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#user-perm-date').val(date_to_sting(new Date()))

            const data = await Btype.get_slip_form_init('perm/user')
            const sort_menu_page = custom_create_options('SortType', 'SortType', data.SortMenuPage)
            $('#sort-type-select').append(sort_menu_page);

            $('.user-perm-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#user-perm-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'delete': Btype.btn_act_del('#user-perm-form #frm'); break;
                }
            });

            $('.user-perm-bd-act').on('click', function () {
                if ($('#Id').val() == 0) {
                    iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                    return
                }
                switch( $(this).data('value') ) {
                    case 'all-create': user_menu_to_perm_bd_copy(false); break;
                    case 'all-delete': user_menu_to_perm_bd_copy(true); break;
                    case 'all-checked': btn_bd_all_auth_checked(true); break;
                    case 'all-unchecked': btn_bd_all_auth_checked(false); break;
                    case 'multi-update': override_btn_bd_act_multi_update(); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                }
            });


            Btype.change_auto_slip_no_select($('#auto-slip-no-select'))
            activate_button_group()
        }

        function change_direct_input_txt($this) {
            $('#auto-slip-no-txt').val($($this).val())
        }

        function btn_act_new() {
            Btype.set_slip_no_btn_abled()
            window.input_box_reset_for('#user-perm-form #frm')
            $('#user-perm-date').val(date_to_sting(new Date()))

            // slip no 초기화
            Btype.exist_slip_no_type(formB['SlipNoOptions'][0]['Value'])

            // table body 초기화
            table_head_check_box_reset('#user-perm-table-head')
            $('#user-perm-table-body').html('');

            // footer 합계 초기화
            $('#SumTotal').val('')
        }

        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.user-perm-table')
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.user-perm-table')
        }

        function get_bd_parameter(bd) {
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                IsUse: bd.IsUse,
                IsMymenu: bd.IsMymenu,
                IsList: bd.IsList,
                IsRead: bd.IsRead,
                IsCreate: bd.IsCreate,
                IsUpdate: bd.IsUpdate,
                IsDelete: bd.IsDelete,
                IsNewtab: bd.IsNewtab,
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

        function change_sort_type() {
            if ($('#sort-type-select').val()) {
                bd_page = init_bd_page.filter(user_pern => {
                    return user_pern['SortType'] === $('#sort-type-select').val()
                })
            } else {
                bd_page = init_bd_page
            }

            create_bd_page()
        }

        function override_check_the_checkbox_when_changing($this) {
            let tr = $($this).closest('tr');
            let index = $(tr).prevAll().length

            if (bd_page[index].Id == 0) return

            bd_page[index]['IsUse'] = $(tr).find('.is-use-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsMymenu'] = $(tr).find('.is-mymenu-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsList'] = $(tr).find('.is-list-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsRead'] = $(tr).find('.is-read-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsCreate'] = $(tr).find('.is-create-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsUpdate'] = $(tr).find('.is-update-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsDelete'] = $(tr).find('.is-delete-check').prop('checked')  ? '1' : '0'
            bd_page[index]['IsNewtab'] = $(tr).find('.is-new-tab-check').prop('checked')  ? '1' : '0'
            $(tr).find(`input[name='bd-cud-check']`).prop('checked', true)
        }

        function btn_bd_all_auth_checked(is_checked) {
            $('.all-check').prop('checked', true)
            checkbox_all_checked($('.all-check'), 'bd-cud-check')

            const val = is_checked ? '1' : '0'
            for (let i = 0; i < bd_page.length; i++) {
                bd_page[i]['IsUse'] = val
                bd_page[i]['IsMymenu'] = val
                bd_page[i]['IsList'] = val
                bd_page[i]['IsRead'] = val
                bd_page[i]['IsCreate'] = val
                bd_page[i]['IsUpdate'] = val
                bd_page[i]['IsDelete'] = val
                bd_page[i]['IsNewtab'] = val
            }
            $('.is-use-check').prop('checked', is_checked)
            $('.is-mymenu-check').prop('checked', is_checked)
            $('.is-list-check').prop('checked', is_checked)
            $('.is-read-check').prop('checked', is_checked)
            $('.is-create-check').prop('checked', is_checked)
            $('.is-update-check').prop('checked', is_checked)
            $('.is-delete-check').prop('checked', is_checked)
            $('.is-new-tab-check').prop('checked', is_checked)

            // console.log(bd_page)
        }

        function get_parameter() {
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                PermNo: $('#auto-slip-no-txt').val(),
                PermDate: moment(new Date($('#user-perm-date').val())).format('YYYYMMDD'),
                PermName: $('#permission-name-txt').val(),
                PermDesc: $('#description-txt-area').val(),
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

        async function user_menu_to_perm_bd_copy(is_delete) {
            const response = await get_api_data('user-menu-to-perm-bd-copy', {
                UserPermId: Number($('#Id').val()),
                IsDelete: is_delete,
            })

            if (response.data.apiStatus) {
                iziToast.error({ title: 'Error', message: response.data.body ?? $('#api-request-failed-please-check').text() })
                return
            }

            await Btype.fetch_slip_form_book($('#auto-slip-no-txt').val())
            iziToast.success({ title: 'Success',  message: $('#action-completed').text() })
        }

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function create_bd_page() {
            let html = []
            let sum_total = 0;
            // console.log(bd_page)


            bd_page.forEach(bd => {
                sum_total++;

                html.push (
                    `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Check}">
                    </td>
                    <td class="text-${formB.ListVars['Align'].MenuCode}" ${formB.ListVars['Hidden'].MenuCode}>
                        ${bd.MenuCode}
                    </td>
                    <td class="text-${formB.ListVars['Align'].SortType}" ${formB.ListVars['Hidden'].SortType}>
                        ${bd.SortType}
                    </td>
                    <td class="text-${formB.ListVars['Align'].MenuName}" ${formB.ListVars['Hidden'].MenuName}>
                        ${bd.MenuName}
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsSkipped}" ${formB.ListVars['Hidden'].IsSkipped}>
                        ${format_conver_for(bd.IsSkipped, 'check')}
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsUse}" ${formB.ListVars['Hidden'].IsUse}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsUse} border-0 bg-white is-use-check" ${bd.IsUse === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsMymenu}" ${formB.ListVars['Hidden'].IsMymenu}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsMymenu} border-0 bg-white is-mymenu-check" ${bd.IsMymenu === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsList}" ${formB.ListVars['Hidden'].IsList}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsList} border-0 bg-white is-list-check" ${bd.IsList === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsRead}" ${formB.ListVars['Hidden'].IsRead}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsRead} border-0 bg-white is-read-check" ${bd.IsRead === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsCreate}" ${formB.ListVars['Hidden'].IsCreate}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsCreate} border-0 bg-white is-create-check" ${bd.IsCreate === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsUpdate}" ${formB.ListVars['Hidden'].IsUpdate}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsUpdate} border-0 bg-white is-update-check" ${bd.IsUpdate === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsDelete}" ${formB.ListVars['Hidden'].IsDelete}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsDelete} border-0 bg-white is-delete-check" ${bd.IsDelete === '1' ? 'checked' : ''} disabled>
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsNewtab}" ${formB.ListVars['Hidden'].IsNewtab}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsNewtab} border-0 bg-white is-new-tab-check" ${bd.IsNewtab === '1' ? 'checked' : ''} disabled>
                    </td>
                </tr>` )
            });

            $('#SumTotal').val(sum_total);

            document.getElementById('user-perm-table-body').innerHTML = html.join('');
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()
            $('#direct-input-txt').val('')

            let hd_page = response.data.HdPage[0]
            init_bd_page = bd_page = response.data.BdPage ?? []

            $('#Id').val(hd_page.Id)
            Btype.input_auto_slip_no_txt(hd_page.PermNo)

            $('#permission-id-txt').val(hd_page.Id)
            $('#user-perm-date').val(moment(to_date(hd_page.PermDate)).format('YYYY-MM-DD'))
            $('#permission-name-txt').val(hd_page.PermName)
            $('#description-txt-area').val(hd_page.PermDesc)

            $('#created-date-txt').val(format_conver_for(hd_page.CreatedOn, 'unixtime'))
            $('#update-date-txt').val(format_conver_for(hd_page.UpdatedOn, 'unixtime'))
            // table body에 데이터 추가
            create_bd_page();

            $('#modal-slip').modal('hide');
        }

        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
        var init_bd_page = [];
        const userPermModal = {!! json_encode($userPermModal) !!};
    </script>
@endsection
