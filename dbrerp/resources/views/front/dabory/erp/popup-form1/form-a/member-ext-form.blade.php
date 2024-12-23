{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary member-ext-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'member-ext-act',
        ])
    </div>
</div>

<div class="card mb-2" id="member-ext-form">
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
                            <label class="m-0">{{ $formA['FormVars']['Title']['MemberPermId'] }}</label>
                            <select id="member-perm-id-select" class="rounded w-100" autocomplete="off"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['MemberPermId'] }}"
                                {{ $formA['FormVars']['Required']['MemberPermId'] }}>
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
            await PopupForm1FormAMemberExtForm.create_etc_select_box_options()

            $('.member-ext-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAMemberExtForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAMemberExtForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAMemberExtForm, $, undefined ) {
            PopupForm1FormAMemberExtForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAMemberExtForm.create_etc_select_box_options = async function () {
                let response = await get_api_data('member-perm-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $('#member-perm-id-select').append(custom_create_options('Id', 'PermName', response.data.Page))

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

            PopupForm1FormAMemberExtForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-member-ext-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#member-ext-form #frm');
            }

            PopupForm1FormAMemberExtForm.btn_act_new_callback = function () {
                PopupForm1FormAMemberExtForm.btn_act_new()
                Atype.set_parameter_callback(PopupForm1FormAMemberExtForm.parameter);
            }

            PopupForm1FormAMemberExtForm.parameter = function () {
                const member_ext_form = $('#member-ext-form')

                let id = Number($('#member-ext-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    MobileNo: $(member_ext_form).find('#mobile-no-txt').val(),
                    MemberPermId: Number($(member_ext_form).find('#member-perm-id-select').val()),
                    SgroupId: Number($(member_ext_form).find('#sgroup-id-select').val()),
                    BranchId: Number($(member_ext_form).find('#branch-id-select').val()),
                    StorageId: Number($(member_ext_form).find('#storage-id-select').val()),
                    AgroupId: Number($(member_ext_form).find('#agroup-id-select').val()),
                    CountryCode: $(member_ext_form).find('#country-code-select').val(),
                    IsExpired: $(member_ext_form).find('#is-expired-check:checked').val() ?? '0',
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

            PopupForm1FormAMemberExtForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAMemberExtForm.parameter);
                Atype.btn_act_save('#member-ext-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMemberExtForm');
            }

            PopupForm1FormAMemberExtForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAMemberExtForm.parameter);
                Atype.btn_act_del('#member-ext-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMemberExtForm');
            }

            PopupForm1FormAMemberExtForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMemberExtForm.btn_act_new()
                await PopupForm1FormAMemberExtForm.fetch_member_ext(Number(id));
            }

            PopupForm1FormAMemberExtForm.fetch_member_ext = async function (id) {
                let response = await get_api_data(PopupForm1FormAMemberExtForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMemberExtForm.set_member_ext_ui(response)
            }

            PopupForm1FormAMemberExtForm.set_member_ext_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let member_ext = response.data.Page[0];
                // console.log(member_ext)

                const member_ext_form = $('#member-ext-form')
                $(member_ext_form).find('#Id').val(member_ext.Id)

                $(member_ext_form).find('#mobile-no-txt').val(member_ext.MobileNo)
                $(member_ext_form).find('#member-perm-id-select').val(member_ext.MemberPermId)
                $(member_ext_form).find('#sgroup-id-select').val(member_ext.SgroupId)
                $(member_ext_form).find('#branch-id-select').val(member_ext.BranchId)
                $(member_ext_form).find('#storage-id-select').val(member_ext.StorageId)
                $(member_ext_form).find('#agroup-id-select').val(member_ext.AgroupId)
                $(member_ext_form).find('#country-code-select').val(member_ext.CountryCode)
                $(member_ext_form).find('#is-expired-check').prop('checked', member_ext.IsExpired == '1')
            }

        }( window.PopupForm1FormAMemberExtForm = window.PopupForm1FormAMemberExtForm || {}, jQuery ));
    </script>
@endpush
@endonce
