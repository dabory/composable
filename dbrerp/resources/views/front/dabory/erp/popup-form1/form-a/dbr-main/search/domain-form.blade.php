{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary domain-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'domain-act',
        ])
    </div>
</div>

<div class="card mb-2" id="domain-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DomainUrl'] }}</label>
                            <input type="text" id="domain-url-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DomainUrl'] }}"
                                {{ $formA['FormVars']['Required']['DomainUrl'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['OwnerName'] }}</label>
                            <input type="text" id="owner-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['OwnerName'] }}"
                                {{ $formA['FormVars']['Required']['OwnerName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SolutionCode'] }}</label>
                            <input type="text" id="solution-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SolutionCode'] }}"
                                {{ $formA['FormVars']['Required']['SolutionCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['OwnerFile'] }}</label>
                            <input type="text" id="owner-file-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['OwnerFile'] }}"
                                {{ $formA['FormVars']['Required']['OwnerFile'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DbrhubUrls'] }}</label>
                            <input type="text" id="dbrhub-urls-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbrhubUrls'] }}"
                                {{ $formA['FormVars']['Required']['DbrhubUrls'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Timezone'] }}</label>
                            <input type="text" id="timezone-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Timezone'] }}"
                                {{ $formA['FormVars']['Required']['Timezone'] }}>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['IsCrawled'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IsCrawled'] }}</label>
                            <input class="rounded" type="checkbox" id="is-crawled-check" value="1">
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AggregHash'] }}</label>
                            <input type="text" id="aggreg-hash-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AggregHash'] }}"
                                {{ $formA['FormVars']['Required']['AggregHash'] }}>
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
                $('.domain-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormADbrMainSearchDomainForm.btn_act_save(); break;
                        case 'del': PopupForm1FormADbrMainSearchDomainForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormADbrMainSearchDomainForm, $, undefined ) {
                PopupForm1FormADbrMainSearchDomainForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormADbrMainSearchDomainForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-domain-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-domain-form .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-domain-form .modal-dialog').css('maxWidth', '600px');

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-domain-form .modal-body button').addClass('btn-primary')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-domain-form .modal-header').addClass('bg-original-purple')

                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchDomainForm.parameter);
                    Atype.btn_act_new('#domain-form #frm');
                }

                PopupForm1FormADbrMainSearchDomainForm.btn_act_new_callback = function () {
                    PopupForm1FormADbrMainSearchDomainForm.btn_act_new()
                }

                PopupForm1FormADbrMainSearchDomainForm.parameter = function () {
                    const $domain_form = $('#domain-form')
                    let id = Number($($domain_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        DomainUrl: $($domain_form).find('#domain-url-txt').val(),
                        OwnerName: $($domain_form).find('#owner-name-txt').val(),
                        SolutionCode: $($domain_form).find('#solution-code-txt').val(),
                        OwnerFile: $($domain_form).find('#owner-file-txt').val(),
                        DbrhubUrls: $($domain_form).find('#dbrhub-urls-txt').val(),
                        Timezone: $($domain_form).find('#timezone-txt').val(),
                        IsCrawled: $($domain_form).find('#is-crawled-check:checked').val() ?? '0',
                        AggregHash: $($domain_form).find('#aggreg-hash-txt').val(),
                        Status: $($domain_form).find('#status-select').val(),
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

                PopupForm1FormADbrMainSearchDomainForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchDomainForm.parameter);
                    Atype.btn_act_save('#domain-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchDomainForm');
                }

                PopupForm1FormADbrMainSearchDomainForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchDomainForm.parameter);
                    Atype.btn_act_del('#domain-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchDomainForm');
                }

                PopupForm1FormADbrMainSearchDomainForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormADbrMainSearchDomainForm.btn_act_new()
                    await PopupForm1FormADbrMainSearchDomainForm.fetch_menu(Number(id));
                }

                PopupForm1FormADbrMainSearchDomainForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormADbrMainSearchDomainForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormADbrMainSearchDomainForm.set_ui(response)
                }

                PopupForm1FormADbrMainSearchDomainForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let domain = response.data.Page[0];

                    const $domain_form = $('#domain-form')

                    $($domain_form).find('#Id').val(domain.Id)

                    $($domain_form).find('#domain-url-txt').val(domain.DomainUrl)
                    $($domain_form).find('#owner-name-txt').val(domain.OwnerName)
                    $($domain_form).find('#solution-code-txt').val(domain.SolutionCode)
                    $($domain_form).find('#owner-file-txt').val(domain.OwnerFile)
                    $($domain_form).find('#dbrhub-urls-txt').val(domain.DbrhubUrls)
                    $($domain_form).find('#timezone-txt').val(domain.Timezone)
                    $($domain_form).find('#is-crawled-check').prop('checked', domain.IsCrawled == '1')
                    $($domain_form).find('#aggreg-hash-txt').val(domain.AggregHash)
                    $($domain_form).find('#status-select').val(domain.Status)
                }

            }( window.PopupForm1FormADbrMainSearchDomainForm = window.PopupForm1FormADbrMainSearchDomainForm || {}, jQuery ));
        </script>
    @endpush
@endonce
