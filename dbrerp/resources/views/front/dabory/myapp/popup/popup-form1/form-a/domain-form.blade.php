<div class="mb-1 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary domain-act save-button"
                data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'domain-act',
        ])
    </div>
</div>
<div class="card" id="domain-form">
    <div class="card-header">
        <div class="row">
            <div class="col card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                        <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['FirstCardTitle'] }}</p>
                    </div>
                    <div class="card-body" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="host-hash-txt">

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DomainUrl'] }}</label>
                            <div class="d-flex">
                                <input class="rounded w-100 px-0 col-7 radius-r0" type="text" id="domain-url-txt"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['DomainUrl'] }}"
                                    {{ $formA['FormVars']['Required']['DomainUrl'] }}>
                                <button type="button" class="col btn-primary rounded radius-l0" id="create-before-base64-key-btn"
                                        onclick="PopupPopupForm1FormADomainForm.get_solution_code()">
                                    솔루션코드 확인
                                </button>
                            </div>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['SolutionCode'] }}</label>
                            <input class="rounded w-100" type="text" id="solution-code-txt" readonly
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SolutionCode'] }}"
                                {{ $formA['FormVars']['Required']['SolutionCode'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['OwnerName'] }}</label>
                            <input class="rounded w-100" type="text" id="owner-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['OwnerName'] }}"
                                {{ $formA['FormVars']['Required']['OwnerName'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DbrhubUrls'] }}</label>
                            <input class="rounded w-100" type="text" id="dbrhub-urls-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbrhubUrls'] }}"
                                {{ $formA['FormVars']['Required']['DbrhubUrls'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Timezone'] }}</label>
                            <input class="rounded w-100" type="text" id="timezone-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Timezone'] }}"
                                {{ $formA['FormVars']['Required']['Timezone'] }}>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.domain-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupPopupForm1FormADomainForm.btn_act_save();
                            break;
                        case 'new':
                            PopupPopupForm1FormADomainForm.btn_act_new();
                            break;
                        case 'del':
                            PopupPopupForm1FormADomainForm.btn_act_del();
                            break;
                    }
                });

                Atype.set_parameter_callback(PopupPopupForm1FormADomainForm.parameter);

                activate_button_group()
            });

            (function (PopupPopupForm1FormADomainForm, $, undefined) {
                PopupPopupForm1FormADomainForm.formA = {!! json_encode($formA) !!};

                PopupPopupForm1FormADomainForm.get_solution_code = async function () {
                    const response = await get_api_data('solution-pick', {
                        Page: [
                            { DomainUrl: $('#domain-form').find('#domain-url-txt').val().replace(/\/$/, '') }
                        ]
                    })

                    let solution_code = 'unknown'
                    if (response.data.Page) {
                        solution_code = response.data.Page[0].SolutionCode
                    }

                    $('#domain-form').find('#solution-code-txt').val(solution_code)
                }

                PopupPopupForm1FormADomainForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-popup-form1-form-a-domain-form .modal-dialog').css('maxWidth', '750px');
                    Atype.btn_act_new('#domain-form #frm');
                }

                PopupPopupForm1FormADomainForm.btn_act_save = async function () {
                    const url = new URL($('#domain-form').find('#domain-url-txt').val());
                    const hostname = url.hostname;
                    const hosthash = await call_local_api('/md5', { str: hostname } )
                    $('#domain-form').find('#host-hash-txt').val(hosthash.data)
                    Atype.btn_act_save('#domain-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupPopupForm1FormADomainForm');
                }

                PopupPopupForm1FormADomainForm.btn_act_del = function () {
                    Atype.btn_act_del('#domain-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupPopupForm1FormADomainForm');
                }

                PopupPopupForm1FormADomainForm.btn_act_new_callback = async function () {
                    PopupPopupForm1FormADomainForm.btn_act_new()
                }

                PopupPopupForm1FormADomainForm.parameter = function () {
                    const id = Number($('#domain-form').find('#Id').val());
                    let parameter = {
                        Id: id,
                        HostHash: $('#domain-form').find('#host-hash-txt').val(),
                        DomainDate: moment(new Date()).format('YYYYMMDD'),
                        DomainUrl: $('#domain-form').find('#domain-url-txt').val(),
                        SolutionCode: $('#domain-form').find('#solution-code-txt').val(),
                        OwnerName: $('#domain-form').find('#owner-name-txt').val(),
                        DbrhubUrls: $('#domain-form').find('#dbrhub-urls-txt').val(),
                        Timezone: $('#domain-form').find('#timezone-txt').val(),
                    }
                    if (id < 0) {
                        parameter = {Id: id}
                    }

                    // console.log(parameter)
                    return parameter;
                }

                PopupPopupForm1FormADomainForm.fetch_domain = async function(id) {
                    const response = await get_api_data(PopupPopupForm1FormADomainForm.formA['General']['PickApi'], {
                        Page: [{Id: id}]
                    })
                    PopupPopupForm1FormADomainForm.set_domain_ui(response)
                }

                PopupPopupForm1FormADomainForm.set_domain_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) {
                        // $('#modal-').modal('hide');
                        return
                    }

                    const domain = response.data.Page[0]

                    $('#domain-form').find("#Id").val(domain.Id)
                    $('#domain-form').find('#domain-url-txt').val(domain.DomainUrl)
                    $('#domain-form').find('#solution-code-txt').val(domain.SolutionCode)
                    $('#domain-form').find('#owner-name-txt').val(domain.OwnerName)
                    $('#domain-form').find('#dbrhub-urls-txt').val(domain.DbrhubUrls)
                    $('#domain-form').find('#timezone-txt').val(domain.Timezone)
                }


                PopupPopupForm1FormADomainForm.show_popup_callback = async function (id, c1) {
                    PopupPopupForm1FormADomainForm.btn_act_new()
                    await PopupPopupForm1FormADomainForm.fetch_domain(Number(id));
                }
            }(window.PopupPopupForm1FormADomainForm = window.PopupPopupForm1FormADomainForm || {}, jQuery));
        </script>
    @endpush
@endonce
