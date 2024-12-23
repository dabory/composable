{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary user-ext-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'user-ext-act',
        ])
    </div>
</div>

<div class="card mb-2" id="user-ext-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                            <input type="text" id="mobile-no-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
                                {{ $formA['FormVars']['Required']['MobileNo'] }}>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['UserPermId'] }}</label>
                            <select id="user-perm-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['UserPermId'] }}"
                                {{ $formA['FormVars']['Required']['UserPermId'] }}>
                                <option value="0">Empty Permission</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SgroupId'] }}</label>
                            <select id="sgroup-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['SgroupId'] }}"
                                {{ $formA['FormVars']['Required']['SgroupId'] }}>
                                <option value="0">Empty Value</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['BranchId'] }}</label>
                            <select id="branch-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['BranchId'] }}"
                                {{ $formA['FormVars']['Required']['BranchId'] }}>
                                <option value="0">Empty Value</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['StorageId'] }}</label>
                            <select id="storage-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['StorageId'] }}"
                                {{ $formA['FormVars']['Required']['StorageId'] }}>
                                <option value="0">Empty Value</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AgroupId'] }}</label>
                            <select id="agroup-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['AgroupId'] }}"
                                {{ $formA['FormVars']['Required']['AgroupId'] }}>
                                <option value="0">Empty Value</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CountryCode'] }}</label>
                            <select id="country-code-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['CountryCode'] }}"
                                {{ $formA['FormVars']['Required']['CountryCode'] }}>
                                @foreach(preg_replace('/\s+/', '', explode(',', env('LOCALE_SEQUENCE'))) as $locale)
                                    <option value="{{ $locale }}">{{ $locale }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-expired-check">
                            <label class="mb-0" for="is-expired-check">{{ $formA['FormVars']['Title']['IsExpired'] }}
                            </label>
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
            await PopupForm1FormAUserExtForm.create_etc_select_box_options()

            $('.user-ext-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAUserExtForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAUserExtForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAUserExtForm, $, undefined ) {
            PopupForm1FormAUserExtForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAUserExtForm.create_etc_select_box_options = async function () {
                let response = await get_api_data('user-perm-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#user-perm-id-select').append(custom_create_options('Id', 'PermName', response.data.Page))

                response = await get_api_data('sgroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#sgroup-id-select').append(custom_create_options('Id', 'SgroupName', response.data.Page))

                response = await get_api_data('branch-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#branch-id-select').append(custom_create_options('Id', 'BranchName', response.data.Page))

                response = await get_api_data('storage-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#storage-id-select').append(custom_create_options('Id', 'StorageName', response.data.Page))

                response = await get_api_data('agroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#agroup-id-select').append(custom_create_options('Id', 'AgroupName', response.data.Page))
            }

            PopupForm1FormAUserExtForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-user-ext-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#user-ext-form #frm');
            }

            PopupForm1FormAUserExtForm.btn_act_new_callback = function () {
                PopupForm1FormAUserExtForm.btn_act_new()
                Atype.set_parameter_callback(PopupForm1FormAUserExtForm.parameter);
            }

            PopupForm1FormAUserExtForm.parameter = function () {
                const user_ext_form = $('#user-ext-form')

                let id = Number($('#user-ext-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    MobileNo: $(user_ext_form).find('#mobile-no-txt').val(),
                    UserPermId: Number($(user_ext_form).find('#user-perm-id-select').val()),
                    SgroupId: Number($(user_ext_form).find('#sgroup-id-select').val()),
                    BranchId: Number($(user_ext_form).find('#branch-id-select').val()),
                    StorageId: Number($(user_ext_form).find('#storage-id-select').val()),
                    AgroupId: Number($(user_ext_form).find('#agroup-id-select').val()),
                    CountryCode: $(user_ext_form).find('#country-code-select').val(),
                    IsExpired: $(user_ext_form).find('#is-expired-check:checked').val() ?? '0',
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

            PopupForm1FormAUserExtForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAUserExtForm.parameter);
                Atype.btn_act_save('#user-ext-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAUserExtForm');
            }

            PopupForm1FormAUserExtForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAUserExtForm.parameter);
                Atype.btn_act_del('#user-ext-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAUserExtForm');
            }

            PopupForm1FormAUserExtForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAUserExtForm.btn_act_new()
                await PopupForm1FormAUserExtForm.fetch_user_ext(Number(id));
            }

            PopupForm1FormAUserExtForm.fetch_user_ext = async function (id) {
                let response = await get_api_data(PopupForm1FormAUserExtForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAUserExtForm.set_user_ext_ui(response)
            }

            PopupForm1FormAUserExtForm.set_user_ext_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let user_ext = response.data.Page[0];
                // console.log(user_ext)

                const user_ext_form = $('#user-ext-form')
                $(user_ext_form).find('#Id').val(user_ext.Id)

                $(user_ext_form).find('#mobile-no-txt').val(user_ext.MobileNo)
                $(user_ext_form).find('#user-perm-id-select').val(user_ext.UserPermId)
                $(user_ext_form).find('#sgroup-id-select').val(user_ext.SgroupId)
                $(user_ext_form).find('#branch-id-select').val(user_ext.BranchId)
                $(user_ext_form).find('#storage-id-select').val(user_ext.StorageId)
                $(user_ext_form).find('#agroup-id-select').val(user_ext.AgroupId)
                $(user_ext_form).find('#country-code-select').val(user_ext.CountryCode)
                $(user_ext_form).find('#is-expired-check').prop('checked', user_ext.IsExpired == '1')
            }

        }( window.PopupForm1FormAUserExtForm = window.PopupForm1FormAUserExtForm || {}, jQuery ));
    </script>
@endpush
@endonce
