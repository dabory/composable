{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary igroup-cache-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'igroup-cache-act',
        ])
    </div>
</div>

<div class="card mb-2" id="igroup-cache-form">
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
                            <label class="m-0">{{ $formA['FormVars']['Title']['ItemHash'] }}</label>
                            <input type="text" id="item-hash-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ItemHash'] }}"
                                {{ $formA['FormVars']['Required']['ItemHash'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ItemName'] }}</label>
                            <input type="text" id="item-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ItemName'] }}"
                                {{ $formA['FormVars']['Required']['ItemName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AiName'] }}</label>
                            <input type="text" id="ai-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AiName'] }}"
                                {{ $formA['FormVars']['Required']['AiName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['AiCode'] }}</label>
                            <input type="text" id="ai-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AiCode'] }}"
                                {{ $formA['FormVars']['Required']['AiCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CountTime'] }}</label>
                            <input type="text" id="count-time-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CountTime'] }}"
                                {{ $formA['FormVars']['Required']['CountTime'] }}>
                        </div>

                        <div class="form-group {{ $formA['FormVars']['Display']['IsFixed'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IsFixed'] }}</label>
                            <input class="rounded" type="checkbox" id="is-fixed-check" value="1">
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IgroupName'] }}</label>
                            <input type="text" id="igroup-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IgroupName'] }}"
                                {{ $formA['FormVars']['Required']['IgroupName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IgroupCode'] }}</label>
                            <input type="text" id="igroup-code-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IgroupCode'] }}"
                                {{ $formA['FormVars']['Required']['IgroupCode'] }}>
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
                $('.igroup-cache-act').on('click', function () {
                    // console.cache($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_save(); break;
                        case 'del': PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormADbrMainSearchIgroupCacheForm, $, undefined ) {
                PopupForm1FormADbrMainSearchIgroupCacheForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-igroup-cache-form .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-igroup-cache-form .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-igroup-cache-form .modal-dialog').css('maxWidth', '600px');

                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-igroup-cache-form .modal-body button').addClass('btn-primary')
                    $('#modal-select-popup.popup-form1-form-a-dbr-main-search-igroup-cache-form .modal-header').addClass('bg-original-purple')

                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchIgroupCacheForm.parameter);
                    Atype.btn_act_new('#igroup-cache-form #frm');
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_new_callback = function () {
                    PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_new()
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.parameter = function () {
                    const $igroup_log_form = $('#igroup-cache-form')
                    let id = Number($($igroup_log_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        CacheDate: moment($($igroup_log_form).find('#cache-date').val()).format('YYYYMMDD'),
                        ItemHash: $($igroup_log_form).find('#item-hash-txt').val(),
                        ItemName: $($igroup_log_form).find('#item-name-txt').val(),
                        AiName: $($igroup_log_form).find('#ai-name-txt').val(),
                        AiCode: $($igroup_log_form).find('#ai-code-txt').val(),
                        CountTime: $($igroup_log_form).find('#count-time-txt').val(),
                        IsFixed: $($igroup_log_form).find('#is-fixed-check:checked').val() ?? '0',
                        IgroupName: $($igroup_log_form).find('#igroup-name-txt').val(),
                        IgroupCode: $($igroup_log_form).find('#igroup-code-txt').val(),
                        ReadCnt: $($igroup_log_form).find('#read-cnt-txt').val(),
                        Sort: $($igroup_log_form).find('#sort-select').val(),
                        Status: $($igroup_log_form).find('#status-select').val(),
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

                PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchIgroupCacheForm.parameter);
                    Atype.btn_act_save('#igroup-cache-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchIgroupCacheForm');
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormADbrMainSearchIgroupCacheForm.parameter);
                    Atype.btn_act_del('#igroup-cache-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormADbrMainSearchIgroupCacheForm');
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormADbrMainSearchIgroupCacheForm.btn_act_new()
                    await PopupForm1FormADbrMainSearchIgroupCacheForm.fetch_menu(Number(id));
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormADbrMainSearchIgroupCacheForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormADbrMainSearchIgroupCacheForm.set_ui(response)
                }

                PopupForm1FormADbrMainSearchIgroupCacheForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    const igroup_log = response.data.Page[0];

                    const $igroup_log_form = $('#igroup-cache-form')

                    $($igroup_log_form).find('#Id').val(igroup_log.Id)

                    $($igroup_log_form).find('#cache-date').val(moment(igroup_log.CacheDate).format('YYYY-MM-DD'))
                    $($igroup_log_form).find('#item-hash').val(igroup_log.ItemHash)
                    $($igroup_log_form).find('#item-name-txt').val(igroup_log.ItemName)
                    $($igroup_log_form).find('#ai-name-txt').val(igroup_log.AiName)
                    $($igroup_log_form).find('#ai-code-txt').val(igroup_log.AiCode)
                    $($igroup_log_form).find('#count-time-txt').val(igroup_log.CountTime)
                    $($igroup_log_form).find('#is-fixed-check').prop('checked', igroup_log.IsFixed == '1')
                    $($igroup_log_form).find('#igroup-name-txt').val(igroup_log.IgroupName)
                    $($igroup_log_form).find('#igroup-code-txt').val(igroup_log.IgroupCode)
                    $($igroup_log_form).find('#read-cnt-txt').val(igroup_log.ReadCnt)
                    $($igroup_log_form).find('#sort-select').val(igroup_log.Sort)
                    $($igroup_log_form).find('#status-select').val(igroup_log.Status)
                }

            }( window.PopupForm1FormADbrMainSearchIgroupCacheForm = window.PopupForm1FormADbrMainSearchIgroupCacheForm || {}, jQuery ));
        </script>
    @endpush
@endonce
