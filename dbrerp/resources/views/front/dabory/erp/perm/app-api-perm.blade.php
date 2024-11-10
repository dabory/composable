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
                            data-variable="appApiPermModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary app-api-perm-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'app-api-perm-act',
                        ])
                    </div>
                </div>

                <div class="card" id="app-api-perm-form">
                    <div class="card-header" id="frm">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="Id" name="Id" value="0">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                            <div class="col-12 d-flex p-0">
                                                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                                        onclick="get_last_slip_no(this)">
                                                    <span class="icon-cogs"></span>
                                                </button>
                                                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                                       maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                                    {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                            <input class="rounded w-100" type="date" value="" id="app-api-perm-date"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                                {{ $formB['FormVars']['Required']['Date'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['PermissionId'] }}</label>
                                            <input class="rounded w-100" type="text" value="" id="permission-id-txt"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PermissionId'] }}"
                                                {{ $formB['FormVars']['Required']['PermissionId'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
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
                                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
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
                                        <button class="btn btn-sm btn-primary app-api-perm-bd-act" data-parameter="{{ $formB['BodySelectOptions'][0]['ParameterName'] ?? '' }}" data-value="{{ $formB['BodySelectOptions'][0]['Value'] }}">
                                            {{ $formB['BodySelectOptions'][0]['Caption'] }}
                                        </button>

                                        @include('front.dabory.erp.partial.select-btn-options', [
                                            'selectBtns' => array_slice($formB['BodySelectOptions'], 1),
                                            'eventClassName' => 'app-api-perm-bd-act'
                                        ])
                                    </div>
                                @else
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary app-api-perm-bd-act" data-value="add">
                                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                        </button>

                                        @include('front.dabory.erp.partial.select-btn-options', [
                                            'selectBtns' => $formB['BodySelectOptions'],
                                            'eventClassName' => 'app-api-perm-bd-act'
                                        ])
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                                <table class="table-row app-api-perm-table">
                                    <thead id="app-api-perm-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                    </thead>
                                    <tbody id="app-api-perm-table-body">
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
    @include('front.outline.static.slip', ['moealSetFile' => $appApiPermModal])
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.app-api-perm-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#app-api-perm-date').val(date_to_sting(new Date()))

            $('.app-api-perm-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#app-api-perm-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'delete': Btype.btn_act_del('#app-api-perm-form #frm'); break;
                }
            });

            $('.app-api-perm-bd-act').on('click', function () {
                if ($('#Id').val() == 0) {
                    iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                    return
                }
                switch( $(this).data('value') ) {
                    case 'all-create': app_api_to_perm_bd_copy(false); break;
                    case 'all-delete': app_api_to_perm_bd_copy(true); break;
                    case 'all-checked': btn_bd_all_auth_checked(true); break;
                    case 'all-unchecked': btn_bd_all_auth_checked(false); break;
                    case 'multi-update': override_btn_bd_act_multi_update(); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                }
            });


            activate_button_group()
        }

        function btn_act_new() {
            Btype.set_slip_no_btn_abled()
            window.input_box_reset_for('#app-api-perm-form #frm')
            $('#app-api-perm-date').val(date_to_sting(new Date()))

            // table body 초기화
            table_head_check_box_reset('#app-api-perm-table-head')
            $('#app-api-perm-table-body').html('');

            // footer 합계 초기화
            $('#SumTotal').val('')
        }

        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.app-api-perm-table')
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.app-api-perm-table')
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

        function override_check_the_checkbox_when_changing($this) {
            let tr = $($this).closest('tr');
            let index = $(tr).prevAll().length

            if (bd_page[index].Id == 0) return

            bd_page[index]['IsUse'] = $(tr).find('.is-use-check').prop('checked')  ? '1' : '0'
            $(tr).find(`input[name='bd-cud-check']`).prop('checked', true)
        }

        function btn_bd_all_auth_checked(is_checked) {
            $('.all-check').prop('checked', true)
            checkbox_all_checked($('.all-check'), 'bd-cud-check')

            const val = is_checked ? '1' : '0'
            for (let i = 0; i < bd_page.length; i++) {
                bd_page[i]['IsUse'] = val
            }
            $('.is-use-check').prop('checked', is_checked)

            // console.log(bd_page)
        }

        function get_parameter() {
            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                PermNo: $('#auto-slip-no-txt').val(),
                PermDate: moment(new Date($('#app-api-perm-date').val())).format('YYYYMMDD'),
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

        async function app_api_to_perm_bd_copy(is_delete) {
            const response = await get_api_data('app-api-to-perm-bd-copy', {
                AppPermId: Number($('#Id').val()),
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

            bd_page.forEach(bd => {
                sum_total++;

                // console.log(bd)
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
                    <td class="text-${formB.ListVars['Align'].ApiCode}" ${formB.ListVars['Hidden'].ApiCode}>
                        ${bd.ApiCode}
                    </td>
                    <td class="text-${formB.ListVars['Align'].ApiUri}" ${formB.ListVars['Hidden'].ApiUri}>
                        ${bd.ApiUri}
                    </td>
                    <td class="text-${formB.ListVars['Align'].IsUse}" ${formB.ListVars['Hidden'].IsUse}>
                        <input type="checkbox" onchange="override_check_the_checkbox_when_changing(this)" class="text-${formB.ListVars['Align'].IsUse} border-0 bg-white is-use-check" ${bd.IsUse === '1' ? 'checked' : ''} disabled>
                    </td>
                </tr>` )
            });

            $('#SumTotal').val(sum_total);

            document.getElementById('app-api-perm-table-body').innerHTML = html.join('');
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            $('#Id').val(hd_page.Id)
            $('#permission-id-txt').val(hd_page.Id)
            $('#auto-slip-no-txt').val(hd_page.PermNo)
            $('#app-api-perm-date').val(moment(to_date(hd_page.PermDate)).format('YYYY-MM-DD'))
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
        const appApiPermModal = {!! json_encode($appApiPermModal) !!};
    </script>
@endsection
