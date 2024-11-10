{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary solution-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'solution-act',
        ])
    </div>
</div>

<div class="card mb-2" id="solution-form">
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
                            <label class="m-0">{{ $formA['FormVars']['Title']['SolutionCode'] }}</label>
                            <input type="text" id="solution-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SolutionCode'] }}"
                                {{ $formA['FormVars']['Required']['SolutionCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SearchTool'] }}</label>
                            <input type="text" id="search-tool-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SearchTool'] }}"
                                {{ $formA['FormVars']['Required']['SearchTool'] }}>
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
                $('.solution-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormADbrMainSearchSolutionForm.btn_act_save(); break;
                        case 'del': PopupForm1FormADbrMainSearchSolutionForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormADbrMainSearchSolutionForm, $, undefined ) {
                PopupForm1FormADbrMainSearchSolutionForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormADbrMainSearchSolutionForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-form .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-form .modal-dialog').css('maxWidth', '600px');

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-form .modal-body button').addClass('btn-primary')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-solution-form .modal-header').addClass('bg-original-purple')

                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionForm.parameter);
                    Atype.btn_act_new('#solution-form #frm');
                }

                PopupForm1FormADbrMainSearchSolutionForm.btn_act_new_callback = function () {
                    PopupForm1FormADbrMainSearchSolutionForm.btn_act_new()
                }

                PopupForm1FormADbrMainSearchSolutionForm.parameter = function () {
                    const $solution_form = $('#solution-form')
                    let id = Number($($solution_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        DomainUrl: $($solution_form).find('#domain-url-txt').val(),
                        SolutionCode: $($solution_form).find('#solution-code-txt').val(),
                        SearchTool: $($solution_form).find('#search-tool-txt').val(),
                        Status: $($solution_form).find('#status-select').val(),
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

                PopupForm1FormADbrMainSearchSolutionForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionForm.parameter);
                    Atype.btn_act_save('#solution-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchSolutionForm');
                }

                PopupForm1FormADbrMainSearchSolutionForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchSolutionForm.parameter);
                    Atype.btn_act_del('#solution-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchSolutionForm');
                }

                PopupForm1FormADbrMainSearchSolutionForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormADbrMainSearchSolutionForm.btn_act_new()
                    await PopupForm1FormADbrMainSearchSolutionForm.fetch_menu(Number(id));
                }

                PopupForm1FormADbrMainSearchSolutionForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormADbrMainSearchSolutionForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormADbrMainSearchSolutionForm.set_ui(response)
                }

                PopupForm1FormADbrMainSearchSolutionForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let solution = response.data.Page[0];

                    const $solution_form = $('#solution-form')

                    $($solution_form).find('#Id').val(solution.Id)

                    $($solution_form).find('#domain-url-txt').val(solution.DomainUrl)
                    $($solution_form).find('#solution-code-txt').val(solution.SolutionCode)
                    $($solution_form).find('#search-tool-txt').val(solution.SearchTool)
                    $($solution_form).find('#status-select').val(solution.Status)
                }

            }( window.PopupForm1FormADbrMainSearchSolutionForm = window.PopupForm1FormADbrMainSearchSolutionForm || {}, jQuery ));
        </script>
    @endpush
@endonce
