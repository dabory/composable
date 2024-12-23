{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary solution-cache-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'solution-cache-act',
        ])
    </div>
</div>

<div class="card mb-2" id="solution-cache-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CacheDate'] }}</label>
                            <input type="date" id="cache-date" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CacheDate'] }}"
                                {{ $formA['FormVars']['Required']['CacheDate'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['HostHash'] }}</label>
                            <input type="text" id="host-hash-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['HostHash'] }}"
                                {{ $formA['FormVars']['Required']['HostHash'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DomainUrl'] }}</label>
                            <input type="text" id="domain-url-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DomainUrl'] }}"
                                {{ $formA['FormVars']['Required']['DomainUrl'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AiCode'] }}</label>
                            <input type="text" id="ai-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AiCode'] }}"
                                {{ $formA['FormVars']['Required']['AiCode'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['IsFixed'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IsFixed'] }}</label>
                            <input class="rounded" type="checkbox" id="is-fixed-check" value="1">
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SolutionCode'] }}</label>
                            <input type="text" id="solution-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SolutionCode'] }}"
                                {{ $formA['FormVars']['Required']['SolutionCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ReadCnt'] }}</label>
                            <input type="text" id="read-cnt-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ReadCnt'] }}"
                                {{ $formA['FormVars']['Required']['ReadCnt'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select class="rounded w-100" id="sort-select"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                                @foreach ($formA['SortOptions'] as $option)
                                    <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
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
                $('.solution-cache-act').on('click', function () {
                    // console.cache($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_save(); break;
                        case 'del': PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormADbrMainSearchSolutionCacheForm, $, undefined ) {
                PopupForm1FormADbrMainSearchSolutionCacheForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-cache-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-cache-form .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-cache-form .modal-dialog').css('maxWidth', '600px');

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-cache-form .modal-body button').addClass('btn-primary')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-cache-form .modal-header').addClass('bg-original-purple')

                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionCacheForm.parameter);
                    Atype.btn_act_new('#solution-cache-form #frm');
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_new_callback = function () {
                    PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_new()
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.parameter = function () {
                    const $solution_log_form = $('#solution-cache-form')
                    let id = Number($($solution_log_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        CacheDate: moment($($solution_log_form).find('#cache-date').val()).format('YYYYMMDD'),
                        HostHash: $($solution_log_form).find('#host-hash-txt').val(),
                        DomainUrl: $($solution_log_form).find('#domain-url-txt').val(),
                        AiCode: $($solution_log_form).find('#ai-code-txt').val(),
                        IsFixed: $($solution_log_form).find('#is-fixed-check:checked').val() ?? '0',
                        SolutionCode: $($solution_log_form).find('#solution-code-txt').val(),
                        ReadCnt: $($solution_log_form).find('#read-cnt-txt').val(),
                        Sort: $($solution_log_form).find('#sort-select').val(),
                        Status: $($solution_log_form).find('#status-select').val(),
                    }
                    if (id < 0) {
                        parameter = { Id: id }
                    } else if (id > 0) {
                        delete parameter.CreatedOn;
                    } else {
                        delete parameter.UpdatedOn;
                    }

                    // console.cache(parameter)
                    return parameter;
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionCacheForm.parameter);
                    Atype.btn_act_save('#solution-cache-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchSolutionCacheForm');
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionCacheForm.parameter);
                    Atype.btn_act_del('#solution-cache-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchSolutionCacheForm');
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormADbrMainSearchSolutionCacheForm.btn_act_new()
                    await PopupForm1FormADbrMainSearchSolutionCacheForm.fetch_menu(Number(id));
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormADbrMainSearchSolutionCacheForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormADbrMainSearchSolutionCacheForm.set_ui(response)
                }

                PopupForm1FormADbrMainSearchSolutionCacheForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    const igroup_log = response.data.Page[0];

                    const $solution_log_form = $('#solution-cache-form')

                    $($solution_log_form).find('#Id').val(igroup_log.Id)

                    $($solution_log_form).find('#cache-date').val(moment(igroup_log.CacheDate).format('YYYY-MM-DD'))
                    $($solution_log_form).find('#host-hash-txt').val(igroup_log.HostHash)
                    $($solution_log_form).find('#domain-url-txt').val(igroup_log.DomainUrl)
                    $($solution_log_form).find('#ai-code-txt').val(igroup_log.AiCode)
                    $($solution_log_form).find('#is-fixed-check').prop('checked', igroup_log.IsFixed == '1')
                    $($solution_log_form).find('#solution-code-txt').val(igroup_log.SolutionCode)
                    $($solution_log_form).find('#read-cnt-txt').val(igroup_log.ReadCnt)
                    $($solution_log_form).find('#sort-select').val(igroup_log.Sort)
                    $($solution_log_form).find('#status-select').val(igroup_log.Status)
                }

            }( window.PopupForm1FormADbrMainSearchSolutionCacheForm = window.PopupForm1FormADbrMainSearchSolutionCacheForm || {}, jQuery ));
        </script>
    @endpush
@endonce
