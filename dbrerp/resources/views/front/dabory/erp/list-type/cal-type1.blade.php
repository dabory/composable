@extends('layouts.master')
@section('title', $calType1['General']['Title'])

@section('content')
    <div class="content cal-type1">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-1 pt-2 text-right d-flex justify-content-between align-items-center">
                    <div class="text-danger cache-refl-text">
                        @if ($calType1['DisplayVars']['IsCache'])
                            캐시삭제(반영)
                        @endif
                    </div>

                    <div>
                        <button type="button" hidden
                                class="btn btn-success btn-open-modal modal-btn">
                        </button>

{{--                        <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="type1-save-spinner-btn">--}}
{{--                            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>--}}
{{--                            Loading...--}}
{{--                        </button>--}}

                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="frm">
                        <input type="hidden" id="list-token">
                        <div class="row">
                            <div class="col-md-4 card-header-item px-0">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $calType1['DisplayVars']['HeadHeight'] }}px">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="{{ $calType1['FormVars']['Display']['DateNavi'] }} flex-column mb-2">
                                            <div>
                                                <button class="btn-light btn-light-100 mr-1 px-1 py-0 rounded text-grey btn-xxs line-height-1" id="type1-date-navi-prev-btn"
                                                        onclick="calc_date_rang('.type1-date-navi-div', $('input:radio[name=type1-date-navi]:checked').val(), -1)" style="height:14px;">
                                                    <i class="fas fa-angle-left"></i>
                                                </button>
                                                <button class="btn-light btn-light-100 rounded text-grey btn-xxs line-height-2"
                                                        onclick="first_date_rang('.type1-date-navi-div', false, true)">
                                                    {{ $calType1['FormVars']['Title']['DateNavi'] }}
                                                </button>
                                                {{--                                            <label class="m-0" style="vertical-align:middle;">{{ $calType1['FormVars']['Title']['DateNavi'] }}</label>--}}
                                                <button class="btn-light btn-light-100 ml-1 px-1  py-0 rounded text-grey btn-xxs line-height-1" id="type1-date-navi-next-btn"
                                                        onclick="calc_date_rang('.type1-date-navi-div', $('input:radio[name=type1-date-navi]:checked').val(), 1)" style="height:14px;">
                                                    <i class="fas fa-angle-right"></i>
                                                </button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-around type1-date-navi-div" style="height: 28px;">
                                                @foreach ($calType1['DateNaviOptions'] ?? [] as $key => $option)
                                                    @empty($option['Caption'])
                                                    @else
                                                        <div class="d-flex align-items-center">
                                                            <input autocomplete="off" name="type1-date-navi" type="radio"
                                                                   value="{{ $option['Value'] }}" id="{{ 'type1-date-navi-'.($key+1) }}">
                                                            <label for="{{ 'type1-date-navi-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                                            </label>
                                                        </div>
                                                    @endempty
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="{{ $calType1['FormVars']['Display']['Date'] }} flex-column mb-2">
                                            <label class="m-0">{{ $calType1['FormVars']['Title']['Date'] }}</label>
                                            <div class="d-flex">
                                                <input class="rounded overflow-hidden w-100 text-nowrap" onchange="change_type1_start_date(this)"
                                                       id="type1-start-date" type="date" value="1990-01-01">
                                                <button class="btn disabled p-1 text-center">~</button>
                                                <input class="rounded overflow-hidden w-100 text-nowrap" id="type1-end-date" type="date" value="3000-12-31">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 card-header-item">
                                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $calType1['DisplayVars']['HeadHeight'] }}px">
                                    <div class="card-header p-0 mb-2">
                                    </div>
                                    <div class="card-body">
                                        @foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $listType1RangeVar)
                                            <div class="{{ $calType1['FormVars']['Display'][$listType1RangeVar] }} flex-column mb-2">
                                                <label class="m-0">{{ $calType1['FormVars']['Title'][$listType1RangeVar] }}</label>
                                                <div class="d-flex">
                                                    <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                           type="text" value="" id="From{{ $listType1RangeVar }}">&nbsp;
                                                    <button type="button" onclick="show_modal('{{ $listType1RangeVar }}', 'From')"
                                                            class="btn-dark rounded border-0
                                                        overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $calType1['FormVars']['Title']['From'] }}
                                                    </button>&nbsp;
                                                    <input class="rounded overflow-hidden w-100 text-nowrap col-4 px-0"
                                                           type="text" value="" id="To{{ $listType1RangeVar }}">&nbsp;
                                                    <button type="button" onclick="show_modal('{{ $listType1RangeVar }}', 'To')"
                                                            class="btn-dark rounded border-0
                                                        overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $calType1['FormVars']['Title']['To'] }}
                                                    </button>&nbsp;
                                                    <button class="btn-dark rounded border-0
                                                    overflow-hidden w-100 text-nowrap col-1" style="height: 28px"
                                                            onclick="same_as_form_and_scope('{{ $listType1RangeVar }}')">=</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 card-header-item">
                                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: {{ $calType1['DisplayVars']['HeadHeight'] }}px"><!--260-->
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="{{ $calType1['FormVars']['Display']['ChartPopup'] }} flex-column mb-2">
                                            <label class="m-0">{{ $calType1['FormVars']['Title']['ChartPopup'] }}</label>
                                            <select class="rounded w-100" id="chart-popup-select">
                                                @foreach ($calType1['ChartPopupOptions'] as $key => $popupOption)
                                                    <option value="{{ $key }}" data-component="{{ $popupOption['ModalClassName'] }}"
                                                            data-unique="{{ $popupOption['Unique'] }}">
                                                        {{ $popupOption['Caption'] }}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="{{ $calType1['FormVars']['Display']['MultiPopup'] }} flex-column mb-2">
                                            <label class="m-0">{{ $calType1['FormVars']['Title']['MultiPopup'] }}</label>
                                            <select class="rounded w-100" id="multi-popup-select" onchange="show_multi_popup(this)">
                                                <option value=""></option>
                                                @foreach ($calType1['MultiPopupOptions'] as $key => $popupOption)
                                                    <option value="{{ $key }}" data-component="{{ $popupOption['ModalClassName'] }}">
                                                        {{ $popupOption['Caption'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="align-items-center mb-2 {{ $calType1['FormVars']['Display']['AddTotalLine'] }}">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-add-total-line-check"> <label class="mb-0" for="is-add-total-line-check">{{ $calType1['FormVars']['Title']['AddTotalLine'] }}</label>
                                        </div>
                                        <div class="align-items-center mb-2 d-none">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-excel-column-check"> <label class="mb-0" for="is-excel-column-check"></label>
                                        </div>
                                        <div class="align-items-center mb-2 {{ $calType1['FormVars']['Display']['DownloadList'] }}">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-download-list-check"> <label class="mb-0" for="is-download-list-check">{{ $calType1['FormVars']['Title']['DownloadList'] }}</label>
                                        </div>
                                        <div class="align-items-center mb-2  {{  $calType1['FormVars']['Display']['ShowOnlyClosed'] }}">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-show-only-closed-check"> <label class="mb-0" for="is-show-only-closed-check">{{ $calType1['FormVars']['Title']['ShowOnlyClosed'] }}</label>
                                        </div>

                                        <div class="{{ $calType1['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                                            <label class="m-0">{{ $calType1['FormVars']['Title']['FilterOption'] }}</label>
                                            <div class="row">
                                                <div class="col-5 pr-1">
                                                    <select class="rounded w-100" id="filter-name-select" onchange="chagne_filter_name_select(this)">
                                                        @foreach ($calType1['FilterSelectOptions'] as $key => $popupOption)
                                                            <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                                {{ $popupOption['Caption'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col pl-0">
                                                    <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="override_enter_pressed_auto_search(event)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="{{ $calType1['FormVars']['Display']['SimpleOption'] }} flex-column">
                                            <label class="m-0">{{ $calType1['FormVars']['Title']['SimpleOption'] }}</label>
                                            <select class="rounded w-100" id="simple-filter-select" onchange="filter_type1_list()">
                                                @foreach ($calType1['SimpleSelectOptions'] as $key => $popupOption)
                                                    <option value="{{ $popupOption['Value'] }}">
                                                        {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="opticalpos dashboard card-body p-0 mt-2 mx-2 {{ $calType1['DisplayVars']['IsHideBody'] ? 'd-none' : '' }}" id="modal-type1">
                        @include('components.groupware.basic.todo')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@foreach ($calType1['HeadSelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.multi-popup', [
                'popupOption' => $popupOption
            ])
        @endpush
    @endif
@endforeach

@foreach (['FirstRange', 'SecondRange', 'ThirdRange', 'FourthRange'] as $i)
    @if ($calType1['FormVars']['Display'][$i] != 'd-none')
        @push('modal')
            @include($calType1['ListType1RangeVars']['BladeRoute'][$i], [
                'moealSetFile' => $calType1['ListType1RangeVars']['Parameter'][$i]
            ])
        @endpush
    @endif
@endforeach

@push('js')
    <script>
        window.onload = function () {
            chagne_filter_name_select($('.cal-type1').find('#filter-name-select'))
        }

        function chagne_filter_name_select($this) {
            $('.cal-type1').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
        }

        function override_enter_pressed_auto_search(event) {
            window.enter_pressed_auto_search(event, function () {
                $('.cal-type1').find('#filter-value-txt').data('value', $(event.target).val())

                if ($('.cal-type1').find('#filter-name-select option:selected').data('reverse')) {
                    const value = format_conver_for($(event.target).val(), $('.cal-type1').find('#filter-name-select option:selected').data('reverse'))

                    $('.cal-type1').find('#filter-value-txt').data('value', value)
                }
                //    get list
            })
        }
    </script>
@endpush
