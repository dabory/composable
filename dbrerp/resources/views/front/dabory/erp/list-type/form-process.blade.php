<div class="content form-f">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-1 text-right d-flex justify-content-end" style="margin-top: -18px">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary form-f-act" data-value="execute" {{ $formProcess['FormVars']['Hidden']['ExecuteButton'] }}>
                        {{ $formProcess['FormVars']['Title']['ExecuteButton'] }}
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-md-6 p-1 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $formProcess['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="{{ $formProcess['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formProcess['FormVars']['Title']['DateRange'] }}</label>
                                        <div class="d-flex align-items-center" style="height: 28px;">
                                            @foreach ($formProcess['DateRangeOptions'] as $key => $option)
                                                <input  autocomplete="off" name="form-f-date-range" type="radio" value="{{ $option['Value'] }}" id="{{ 'form-f-date-range-'.($key+1) }}"
                                                {{ $option['Value'] == 'all' ? 'checked' : ''}}>
                                                <label for="{{ 'form-f-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $formProcess['FormVars']['Display']['Date'] }} flex-column mb-2">
                                        <label class="m-0">{{ $formProcess['FormVars']['Title']['Date'] }}</label>
                                        <div class="d-flex">
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="form-f-start-date" type="date" value="1990-01-01">
                                            <label class="btn disabled p-1 text-center">~</label>
                                            <input class="rounded overflow-hidden w-100 text-nowrap" id="form-f-end-date" type="date" value="3000-12-31">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-1 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $formProcess['DisplayVars']['HeadHeight'] }}px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    @foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $listType1RangeVar)
                                        <div class="{{ $formProcess['FormVars']['Display'][$listType1RangeVar] }} flex-column mb-2">
                                            <label class="m-0">{{ $formProcess['FormVars']['Title'][$listType1RangeVar] }}</label>
                                            <div class="d-flex">
                                                <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                    type="text" value="" id="From{{ $listType1RangeVar }}">&nbsp;
                                                <button type="button" onclick="ListTypeFormProcess.show_modal('{{ $listType1RangeVar }}', 'From')"
                                                    class="btn-dark rounded border-0
                                                        overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                    {{ $formProcess['FormVars']['Title']['From'] }}
                                                </button>&nbsp;
                                                <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                    type="text" value="" id="To{{ $listType1RangeVar }}">&nbsp;
                                                <button type="button" onclick="ListTypeFormProcess.show_modal('{{ $listType1RangeVar }}', 'To')"
                                                    class="btn-dark rounded border-0
                                                        overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                    {{ $formProcess['FormVars']['Title']['To'] }}
                                                </button>&nbsp;
                                                <button class="btn-dark rounded border-0
                                                    overflow-hidden w-100 text-nowrap col-1" style="height: 28px"
                                                    onclick="ListTypeFormProcess.same_as_form_and_scope('{{ $listType1RangeVar }}')">=</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $formProcess['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-around mb-2">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-first-check"> <label class="mb-0" for="is-first-check">{{ $formProcess['FormVars']['Title']['IsFirstCheck'] }}</label>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-second-check"> <label class="mb-0" for="is-second-check">{{ $formProcess['FormVars']['Title']['IsSecondCheck'] }}</label>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-third-check"> <label class="mb-0" for="is-third-check">{{ $formProcess['FormVars']['Title']['IsThirdCheck'] }}</label>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-fourth-check"> <label class="mb-0" for="is-fourth-check">{{ $formProcess['FormVars']['Title']['IsFourthCheck'] }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $formProcess['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $i)
    @if ($formProcess['FormVars']['Display'][$i] != 'd-none')
        @push('modal')
            @include($formProcess['ListType1RangeVars']['BladeRoute'][$i], [
                'moealSetFile' => $formProcess['ListType1RangeVars']['Parameter'][$i],
                'modalClassName' => $formProcess['FuncVars']['FuncName']
            ])
        @endpush
    @endif
@endforeach

@once
@push('js')
    <script>
        $(document).ready(async function() {
            $('input:radio[name=form-f-date-range]').on('click', function () {
                let firDay, lasDay;
                [firDay, lasDay] = date_range_vending_machine($(this).val());

                $('#form-f-start-date').val(date_to_sting(firDay))
                $('#form-f-end-date').val(date_to_sting(lasDay))
            });

            $('.form-f-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'execute': ListTypeFormProcess.execute(); break;
                }
            });
        });

        (function( ListTypeFormProcess, $, undefined ) {
            ListTypeFormProcess.para = {!! json_encode($formProcess) !!};

            ListTypeFormProcess.execute = async function () {
                let response = await get_api_data(ListTypeFormProcess.para['General']['PageApi'], ListTypeFormProcess.get_parameter());
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
                $('#modal-multi-popup.show').modal('hide');
            }

            ListTypeFormProcess.get_parameter = function () {
                let parameter = {
                    FuncVars: {
                        FuncName: ListTypeFormProcess.para['FuncVars']['FuncName']
                    },
                    FuncType1Vars: {
                        ListToken: '',

                        FilterDate: ListTypeFormProcess.para['FuncVars']['FilterDate'],
                        StartDate: moment(new Date($('.form-f').find('#form-f-start-date').val())).format('YYYYMMDD'),
                        EndDate: moment(new Date($('.form-f').find('#form-f-end-date').val())).format('YYYYMMDD'),

                        FilterFirst: ListTypeFormProcess.para['ListType1RangeVars']['Filter']['FirstRange'],
                        StartFirst: $('.form-f').find('#FromFirstRange').val(),
                        EndFirst: $('.form-f').find('#ToFirstRange').val(),

                        FilterSecond: ListTypeFormProcess.para['ListType1RangeVars']['Filter']['SecondRange'],
                        StartSecond: $('.form-f').find('#FromSecondRange').val(),
                        EndSecond: $('.form-f').find('#ToSecondRange').val(),

                        FilterThird: ListTypeFormProcess.para['ListType1RangeVars']['Filter']['ThirdRange'],
                        StartThird: $('.form-f').find('#FromThirdRange').val(),
                        EndThird: $('.form-f').find('#ToThirdRange').val(),

                        FilterFourth: ListTypeFormProcess.para['ListType1RangeVars']['Filter']['FourthRange'],
                        StartFourth: $('.form-f').find('#FromFourthRange').val(),
                        EndFourth: $('.form-f').find('#ToFourthRange').val(),

                        IsFirstCheck: $('.form-f').find('#is-first-check:checked').val() == '1',
                        IsSecondCheck: $('.form-f').find('#is-second-check:checked').val() == '1',
                        IsThirdCheck: $('.form-f').find('#is-third-check:checked').val() == '1',
                        IsFoutchCheck: $('.form-f').find('#is-fourth-check:checked').val() == '1',
                    },
                }

                // console.log(parameter)
                return parameter;
            }

            ListTypeFormProcess.get_current_date_range_value = function (start_date, end_date) {
                let result;
                ['day', 'week', 'month', 'quarterly', 'semiannual', 'year', 'all'].forEach(date_range => {
                    let firDay, lasDay;
                    [firDay, lasDay] = date_range_vending_machine(date_range)
                    if (date_to_sting(firDay) == start_date && date_to_sting(lasDay) == end_date) {
                        result = date_range;
                        return true;
                    }
                });
                return result;
            };

            ListTypeFormProcess.show_popup_callback = function (type1_parameter) {
                input_box_reset_for('.form-f #frm')
                let start_date = moment(type1_parameter['ListType1Vars']['StartDate']).format('YYYY-MM-DD');
                let end_date = moment(type1_parameter['ListType1Vars']['EndDate']).format('YYYY-MM-DD');
                $(`input:radio[name='form-f-date-range']:radio[value='${ListTypeFormProcess.get_current_date_range_value(start_date, end_date)}']`).prop('checked', true);
                $('.form-f').find('#form-f-start-date').val(start_date)
                $('.form-f').find('#form-f-end-date').val(end_date)
                ListTypeFormProcess.init_display_vars()
            }

            ListTypeFormProcess.same_as_form_and_scope = function (list_type1_range_var) {
                let from_val = $('.form-f').find(`#From${list_type1_range_var}`).val()
                $('.form-f').find(`#To${list_type1_range_var}`).val(from_val)
            }

            ListTypeFormProcess.init_display_vars = function () {
                $('.form-f').find('#is-first-check').prop('checked', ListTypeFormProcess.para['DisplayVars']['IsFirstCheck'])
                $('.form-f').find('#is-second-check').prop('checked', ListTypeFormProcess.para['DisplayVars']['IsSecondCheck'])
                $('.form-f').find('#is-third-check').prop('checked', ListTypeFormProcess.para['DisplayVars']['IsThirdCheck'])
                $('.form-f').find('#is-fourth-check').prop('checked', ListTypeFormProcess.para['DisplayVars']['IsFourthCheck'])
            }

            ListTypeFormProcess.get_from_first_range_data = function (id) {
                $('.form-f').find('#FromFirstRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_to_first_range_data = function (id) {
                $('.form-f').find('#ToFirstRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['FirstRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_from_second_range_data = function (id) {
                $('.form-f').find('#FromSecondRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_to_second_range_data = function (id) {
                $('.form-f').find('#ToSecondRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['SecondRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_from_third_range_data = function (id) {
                $('.form-f').find('#FromThirdRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_to_third_range_data = function (id) {
                $('.form-f').find('#ToThirdRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['ThirdRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_from_fourth_range_data = function (id) {
                $('.form-f').find('#FromFourthRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.get_to_fourth_range_data = function (id) {
                $('.form-f').find('#ToFourthRange').val(id)
                $(`#modal-${ListTypeFormProcess.para['ListType1RangeVars']['Component']['FourthRange']}.show`).modal('hide');
            }

            ListTypeFormProcess.show_modal = function (list_type1_range_var, type) {
                let func_name = `Get${type}${list_type1_range_var}Data`;

                $('.form-f .modal-btn').data('filter', ListTypeFormProcess.para['ListType1RangeVars']['Filter'][list_type1_range_var])
                $('.form-f .modal-btn').data('target', ListTypeFormProcess.para['ListType1RangeVars']['Component'][list_type1_range_var])
                $('.form-f .modal-btn').data('variable', ListTypeFormProcess.para['ListType1RangeVars']['Parameter'][list_type1_range_var])
                $('.form-f .modal-btn').data('class', ListTypeFormProcess.para['FuncVars']['FuncName'])
                $('.form-f .modal-btn').data('clicked', `ListTypeFormProcess.${snakeCase(func_name)}`)
                $('.form-f .modal-btn').trigger('click')
            }
        }( window.ListTypeFormProcess = window.ListTypeFormProcess || {}, jQuery ));
    </script>
@endpush
@endonce
