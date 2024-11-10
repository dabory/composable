{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary member-dormant-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'member-dormant-act',
        ])
    </div>
</div>

<div class="card mb-2" id="member-dormant-form">
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
            // console.log(MainAppName)
            // console.log(GuestAppName)

            $('.member-dormant-act').on('click', function () {
                // console.log($(this).data('value'))

                switch( $(this).data('value') ) {
                    case 'your-account': PopupForm1FormAMemberDormantForm.go_to_your_account(); break;
                }

            });

            activate_button_group()
        });

        (function( PopupForm1FormAMemberDormantForm, $, undefined ) {
            PopupForm1FormAMemberDormantForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAMemberDormantForm.go_to_your_account = async function () {
                if (isEmpty($('#member-dormant-form').find('#Id').val())) {
                    iziToast.error({ title: 'Error', message: $('#no-data-found').text() })
                }
                const member_dormant_pick = await get_api_data(PopupForm1FormAMemberDormantForm.formA['General']['PickApi'], {
                    Page: [ { Id: Number($('#member-dormant-form').find('#Id').val()) } ]
                }, MainAppName)

                const origin_mem_dort = member_dormant_pick.data['Page'][0]
                origin_mem_dort['Status'] = '1'
                const member_page = { ...origin_mem_dort, SgroupId: origin_mem_dort['SgroupIdRecom'] }

                const member_dormant_act = await get_api_data('member-act', {
                    Page: [ member_page ]
                })

                await PopupForm1FormAMemberDormantForm.rollback_member_ext(Number(origin_mem_dort['Id']), origin_mem_dort['MobileNo'])

                await PopupForm1FormAMemberDormantForm.delete_member_dormant(Number(origin_mem_dort['Id']))
            }

            PopupForm1FormAMemberDormantForm.rollback_member_ext = async function (member_dormant_id, mobile_no) {
                const member_ext_act = await get_api_data('member-ext-act', {
                    Page: [
                        {
                            Id: member_dormant_id,
                            MobileNo: mobile_no
                        }
                    ]
                })
            }

            PopupForm1FormAMemberDormantForm.delete_member_dormant = async function (member_dormant_id) {
                const member_act = await get_api_data(PopupForm1FormAMemberDormantForm.formA['General']['ActApi'], {
                    Page: [ { Id: member_dormant_id  * -1 } ]
                }, MainAppName)

                const member_data = member_act.data

                if (isEmpty(member_data) || member_data.apiStatus) {
                    iziToast.error({ title: 'Error', message: member_data.body ?? $('#api-request-failed-please-check').text() })
                } else {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }

            }


            PopupForm1FormAMemberDormantForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-member-dormant-form .modal-dialog').css('maxWidth', '300px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#member-dormant-form #frm');
            }


            PopupForm1FormAMemberDormantForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMemberDormantForm.btn_act_new()

                await PopupForm1FormAMemberDormantForm.fetch_member(Number(id));
            }

            PopupForm1FormAMemberDormantForm.fetch_member = async function (id) {
                let response = await get_api_data(PopupForm1FormAMemberDormantForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                }, MainAppName)

                PopupForm1FormAMemberDormantForm.set_member_ui(response)
            }

            PopupForm1FormAMemberDormantForm.set_member_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let member_dormant = response.data.Page[0]

                const member_dormant_form = $('#member-dormant-form')
                $(member_dormant_form).find('#Id').val(member_dormant.Id)
                $(member_dormant_form).find('#sso-sub-id').val(member_dormant.SsoSubId)

                $(member_dormant_form).find('#name-txt').val(member_dormant.NickName)
                $(member_dormant_form).find('#email-txt').val(member_dormant.Email)

                $(member_dormant_form).find('#status-select').val(member_dormant.Status)

                $(member_dormant_form).find('#is-member-app-check').prop('checked', member_dormant.IsMemberApp == '1')
            }


        }( window.PopupForm1FormAMemberDormantForm = window.PopupForm1FormAMemberDormantForm || {}, jQuery ));
    </script>
@endpush
@endonce
