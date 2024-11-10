{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary member-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'member-act',
        ])
    </div>
</div>

<div class="card mb-2" id="member-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="sso-sub-id">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
                            <input type="text" id="name-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Name'] }}"
                                {{ $formA['FormVars']['Required']['Name'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                            <input type="text" id="email-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Email'] }}"
                                {{ $formA['FormVars']['Required']['Email'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                            <input type="text" id="mobile-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
                                {{ $formA['FormVars']['Required']['MobileNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select class="rounded w-100" id="status-select"
                                {{ $formA['FormVars']['Required']['Status'] }}>
                                @foreach ($formA['StatusOptions'] as $option)
                                    <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-member-app-check"
                                {{ $formA['FormVars']['Required']['IsMemberApp'] }}>
                            <label class="mb-0" for="is-member-app-check">{{ $formA['FormVars']['Title']['IsMemberApp'] }}
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
            $('.member-act').on('click', function () {
                // console.log($(this).data('value'))

                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAMemberForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAMemberForm.btn_act_del(); break;
                    case 'dormant-account': PopupForm1FormAMemberForm.go_to_dormant_account(); break;
                }

            });

            activate_button_group()
        });

        (function( PopupForm1FormAMemberForm, $, undefined ) {
            PopupForm1FormAMemberForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAMemberForm.go_to_dormant_account = async function () {
                if (isEmpty($('#member-form').find('#Id').val())) {
                    iziToast.error({ title: 'Error', message: $('#no-data-found').text() })
                }

                const member_dormant_pick = await get_api_data('member-dormant-pick', {
                    Page: [ { Id: Number($('#member-form').find('#Id').val()) } ]
                }, GuestAppName)

                if (! isEmpty(member_dormant_pick.data['Page'])) {
                    iziToast.error({ title: 'Error', message: '이미 휴면 상태입니다' })
                    return
                }

                const member_pick = await get_api_data(PopupForm1FormAMemberForm.formA['General']['PickApi'], {
                    Page: [ { Id: Number($('#member-form').find('#Id').val()) } ]
                })

                const member = member_pick.data['Page'][0]

                member['Status'] = '5'
                Object.defineProperty(member, 'SgroupIdRecom',
                    Object.getOwnPropertyDescriptor(member, 'SgroupId'))
                delete member['SgroupId'];

                const member_ext_pick = await get_api_data('member-ext-pick', {
                    Page: [ { Id: Number(member['Id']) } ]
                })

                const page = { ...member, ...member_ext_pick.data['Page'][0] }

                const member_dormant_act = await get_api_data('member-dormant-act', {
                    Page: [ page ]
                }, GuestAppName)

                await PopupForm1FormAMemberForm.init_member_ext_db(Number(member['Id']))

                await PopupForm1FormAMemberForm.init_member_db(member)
            }

            PopupForm1FormAMemberForm.init_member_ext_db = async function (member_id) {
                const member_ext_act = await get_api_data('member-ext-act', {
                    Page: [
                        {
                            Id: member_id,
                            MobileNo: ''
                        }
                    ]
                })
            }

            PopupForm1FormAMemberForm.init_member_db = async function (member) {
                const member_structure = { LastSeenOn: 'INT', LastLoginOn: 'INT', MemberDate: 'STRING', Email: 'UNIQUE', Password: 'STRING',
                    LoginId: 'STRING', SsoBrand: 'STRING', SsoSub: 'STRING',
                    NickName: 'STRING', FirstName: 'STRING', SurName: 'STRING', IsActivated: 'CHAR', IsGuest: 'CHAR',
                    ProfileImg: 'STRING', ProfileWeb: 'STRING', ProfileText: 'STRING', CreatedIp: 'STRING', Sort: 'CHAR', BuyerId: 'INT',
                    SgroupId: 'INT', SgroupCode: 'STRING', LastloginIp: 'STRING', IsWithdrawn: 'CHAR', SsoSubId: 'INT',
                    IsMemberApp: 'CHAR', DormantMailOn: 'INT'
                }

                let mem_init_page = { Id: Number(member['Id']), Status: '5' }
                for (const key in member_structure) {
                    switch (member_structure[key]) {
                        case 'UNIQUE':
                            mem_init_page[key] = btoa(member['Email'])
                            break;
                        case 'STRING':
                            mem_init_page[key] = ''
                            break;
                        case 'CHAR':
                            mem_init_page[key] = '0'
                            break;
                        case 'INT':
                            mem_init_page[key] = 0
                            break;
                    }
                }

                const member_act = await get_api_data(PopupForm1FormAMemberForm.formA['General']['ActApi'], {
                    Page: [ mem_init_page ]
                })

                const member_data = member_act.data

                if (isEmpty(member_data) || member_data.apiStatus) {
                    iziToast.error({ title: 'Error', message: member_data.body ?? $('#api-request-failed-please-check').text() })
                } else {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }

            }

            PopupForm1FormAMemberForm.btn_act_for = async function (format) {
                Atype.btn_act_for(format, '#member-form', 'PopupForm1FormAMemberForm')
            }

            PopupForm1FormAMemberForm.multi_block = async function (ids, status, callback) {
                const data = ids.map(function (id) {
                    return { Id:id, UpdatedOn: get_now_time_stamp(), Status: status }
                })
                let response = await get_api_data(PopupForm1FormAMemberForm.formA['General']['ActApi'], { Page: data });
                if (response.data.Page) {
                    callback()
                } else {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text();
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                }
            }

            PopupForm1FormAMemberForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-member-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#member-form #frm');
            }

            PopupForm1FormAMemberForm.parameter = function () {
                let id = Number($('#member-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    UpdatedOn: get_now_time_stamp(),
                    Status: $('#member-form').find('#status-select').val(),
                    IsMemberApp: $('#member-form').find('#is-member-app-check:checked').val() ?? '0',
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

            PopupForm1FormAMemberForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAMemberForm.parameter);

                if ($('#member-form').find('#sso-sub-id').val() === '0' && $('#member-form').find('#is-member-app-check').prop('checked')) {
                    iziToast.error({
                        title: 'Error',
                        message: '다보리 SSO 회원만 App API를 설정할 수 있습니다',
                    })
                    return
                }

                Atype.btn_act_save('#member-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMemberForm');
            }


            PopupForm1FormAMemberForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMemberForm.btn_act_new()

                await PopupForm1FormAMemberForm.fetch_member(Number(id));
            }

            PopupForm1FormAMemberForm.fetch_member = async function (id) {
                let response = await get_api_data(PopupForm1FormAMemberForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                const member_ext = await get_api_data('member-ext-pick', {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMemberForm.set_member_ui(response, member_ext)
            }

            PopupForm1FormAMemberForm.set_member_ui = function (response, member_ext) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const member = response.data.Page[0]
                // console.log(member)

                const member_form = $('#member-form')
                $(member_form).find('#Id').val(member.Id)
                $(member_form).find('#sso-sub-id').val(member.SsoSubId)
                $(member_form).find('#name-txt').val(member.NickName)
                $(member_form).find('#email-txt').val(member.Email)
                $(member_form).find('#mobile-no-txt').val(member_ext.data.Page[0].MobileNo)
                $(member_form).find('#status-select').val(member.Status)
                $(member_form).find('#is-member-app-check').prop('checked', member.IsMemberApp == '1')
            }


        }( window.PopupForm1FormAMemberForm = window.PopupForm1FormAMemberForm || {}, jQuery ));
    </script>
@endpush
@endonce
