{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary prompt-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'prompt-act',
        ])
    </div>
</div>

<div class="card mb-2" id="prompt-form">
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
                            <label class="m-0">{{ $formA['FormVars']['Title']['PromptNo'] }}</label>
                            <input type="text" id="prompt-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['PromptNo'] }}"
                                {{ $formA['FormVars']['Required']['PromptNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ModelVer'] }}</label>
                            <input type="text" id="model-ver-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['ModelVer'] }}"
                                {{ $formA['FormVars']['Required']['ModelVer'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['FuncTitle'] }}</label>
                            <input type="text" id="func-title-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['FuncTitle'] }}"
                                {{ $formA['FormVars']['Required']['FuncTitle'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['FuncVer'] }}</label>
                            <input type="text" id="func-ver-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['FuncVer'] }}"
                                {{ $formA['FormVars']['Required']['FuncVer'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PromptFeed'] }}</label>
                            <input type="text" id="prompt-feed-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['PromptFeed'] }}"
                                {{ $formA['FormVars']['Required']['PromptFeed'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TestFeed'] }}</label>
                            <input type="text" id="test-feed-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['TestFeed'] }}"
                                {{ $formA['FormVars']['Required']['TestFeed'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TestResult'] }}</label>
                            <input type="text" id="test-result-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['TestResult'] }}"
                                {{ $formA['FormVars']['Required']['TestResult'] }}>
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
            $('.prompt-act').on('click', function () {
                // console.log($(this).data('value'))

                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAPromptForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAPromptForm.btn_act_del(); break;
                    case 'dormant-account': PopupForm1FormAPromptForm.go_to_dormant_account(); break;
                }

            });

            activate_button_group()
        });

        (function( PopupForm1FormAPromptForm, $, undefined ) {
            PopupForm1FormAPromptForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAPromptForm.go_to_dormant_account = async function () {
                if (isEmpty($('#prompt-form').find('#Id').val())) {
                    iziToast.error({ title: 'Error', message: $('#no-data-found').text() })
                }

                const prompt_dormant_pick = await get_api_data('prompt-dormant-pick', {
                    Page: [ { Id: Number($('#prompt-form').find('#Id').val()) } ]
                }, GuestAppName)

                if (! isEmpty(prompt_dormant_pick.data['Page'])) {
                    iziToast.error({ title: 'Error', message: '이미 휴면 상태입니다' })
                    return
                }

                const prompt_pick = await get_api_data(PopupForm1FormAPromptForm.formA['General']['PickApi'], {
                    Page: [ { Id: Number($('#prompt-form').find('#Id').val()) } ]
                })

                const prompt = prompt_pick.data['Page'][0]

                prompt['Status'] = '5'
                Object.defineProperty(prompt, 'SgroupIdRecom',
                    Object.getOwnPropertyDescriptor(prompt, 'SgroupId'))
                delete prompt['SgroupId'];

                const prompt_ext_pick = await get_api_data('prompt-ext-pick', {
                    Page: [ { Id: Number(prompt['Id']) } ]
                })

                const page = { ...prompt, ...prompt_ext_pick.data['Page'][0] }

                const prompt_dormant_act = await get_api_data('prompt-dormant-act', {
                    Page: [ page ]
                }, GuestAppName)

                await PopupForm1FormAPromptForm.init_prompt_ext_db(Number(prompt['Id']))

                await PopupForm1FormAPromptForm.init_prompt_db(prompt)
            }

            PopupForm1FormAPromptForm.init_prompt_ext_db = async function (prompt_id) {
                const prompt_ext_act = await get_api_data('prompt-ext-act', {
                    Page: [
                        {
                            Id: prompt_id,
                            MobileNo: ''
                        }
                    ]
                })
            }

            PopupForm1FormAPromptForm.init_prompt_db = async function (prompt) {
                const prompt_structure = { LastSeenOn: 'INT', LastLoginOn: 'INT', promptDate: 'STRING', Email: 'UNIQUE', Password: 'STRING',
                    LoginId: 'STRING', SsoBrand: 'STRING', SsoSub: 'STRING',
                    NickName: 'STRING', FirstName: 'STRING', SurName: 'STRING', IsActivated: 'CHAR', IsGuest: 'CHAR',
                    ProfileImg: 'STRING', ProfileWeb: 'STRING', ProfileText: 'STRING', CreatedIp: 'STRING', Sort: 'CHAR', BuyerId: 'INT',
                    SgroupId: 'INT', SgroupCode: 'STRING', LastloginIp: 'STRING', IsWithdrawn: 'CHAR', SsoSubId: 'INT',
                    IspromptApp: 'CHAR', DormantMailOn: 'INT'
                }

                let mem_init_page = { Id: Number(prompt['Id']), Status: '5' }
                for (const key in prompt_structure) {
                    switch (prompt_structure[key]) {
                        case 'UNIQUE':
                            mem_init_page[key] = btoa(prompt['Email'])
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

                const prompt_act = await get_api_data(PopupForm1FormAPromptForm.formA['General']['ActApi'], {
                    Page: [ mem_init_page ]
                })

                const prompt_data = prompt_act.data

                if (isEmpty(prompt_data) || prompt_data.apiStatus) {
                    iziToast.error({ title: 'Error', message: prompt_data.body ?? $('#api-request-failed-please-check').text() })
                } else {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }

            }

            PopupForm1FormAPromptForm.btn_act_for = async function (format) {
                Atype.btn_act_for(format, '#prompt-form', 'PopupForm1FormAPromptForm')
            }

            PopupForm1FormAPromptForm.multi_block = async function (ids, status, callback) {
                const data = ids.map(function (id) {
                    return { Id:id, UpdatedOn: get_now_time_stamp(), Status: status }
                })
                let response = await get_api_data(PopupForm1FormAPromptForm.formA['General']['ActApi'], { Page: data });
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

            PopupForm1FormAPromptForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-prompt-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#prompt-form #frm');
            }

            PopupForm1FormAPromptForm.parameter = function () {
                let id = Number($('#prompt-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    UpdatedOn: get_now_time_stamp(),
                    Status: $('#prompt-form').find('#status-select').val(),
                    IspromptApp: $('#prompt-form').find('#is-prompt-app-check:checked').val() ?? '0',
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

            PopupForm1FormAPromptForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAPromptForm.parameter);

                if ($('#prompt-form').find('#sso-sub-id').val() === '0' && $('#prompt-form').find('#is-prompt-app-check').prop('checked')) {
                    iziToast.error({
                        title: 'Error',
                        message: '다보리 SSO 회원만 App API를 설정할 수 있습니다',
                    })
                    return
                }

                Atype.btn_act_save('#prompt-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAPromptForm');
            }


            PopupForm1FormAPromptForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAPromptForm.btn_act_new()

                await PopupForm1FormAPromptForm.fetch_prompt(Number(id));
            }

            PopupForm1FormAPromptForm.fetch_prompt = async function (id) {
                let response = await get_api_data(PopupForm1FormAPromptForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                // const prompt_ext = await get_api_data('prompt-ext-pick', {
                //     Page: [ { Id: id } ]
                // })

                PopupForm1FormAPromptForm.set_prompt_ui(response)
            }

            PopupForm1FormAPromptForm.set_prompt_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const prompt = response.data.Page[0]
                console.log(prompt)

                const prompt_form = $('#prompt-form')
                $(prompt_form).find('#Id').val(prompt.Id)
                $(prompt_form).find('#prompt-no-txt').val(prompt.PromptNo)
                $(prompt_form).find('#model-ver-txt').val(prompt.ModelVer)
                $(prompt_form).find('#func-title-txt').val(prompt.FuncTitle)
                $(prompt_form).find('#func-ver-txt').val(prompt.FuncVer)
                $(prompt_form).find('#prompt-feed-txt').val(prompt.PromptFeed)
                $(prompt_form).find('#test-feed-txt').val(prompt.TestFeed)
                $(prompt_form).find('#test-result-txt').val(prompt.TestResult)
                $(prompt_form).find('#status-select').val(prompt.Status)
            }


        }( window.PopupForm1FormAPromptForm = window.PopupForm1FormAPromptForm || {}, jQuery ));
    </script>
@endpush
@endonce
