<!--- slip-search --->
@php $modalClassName = $modalClassName ?? '';@endphp

<div class="modal fade modal-brown {{ $modalClassName }}" id="modal-slip" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1060;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1250px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary"><!--p-2-->
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row p-0 mt-2 m-auto">
                    <div class="col-lg-4 col-md-6 col-12">

                        <div class="{{ $moealSetFile['FormVars']['Display']['DateNavi'] }} flex-column mb-2" style="height: 50px;">
                            <div>
                                <button class="btn-light btn-light-100 mr-1 px-1 py-0 rounded text-grey btn-xxs line-height-1" id="slip-date-navi-prev-btn"
                                        onclick="calc_slip_date_rang('#{{ $modalClassName }}slip-date-navi-div', $('input:radio[name={{ $modalClassName }}date-navi]:checked').val(), -1)">
                                    <i class="fas fa-angle-left"></i>
                                </button>
                                <button class="btn-light btn-light-100 rounded text-grey btn-xxs line-height-2"
                                        onclick="first_slip_date_rang('#{{ $modalClassName }}slip-date-navi-div', false)">
                                    {{ $moealSetFile['FormVars']['Title']['DateNavi'] }}
                                </button>
                                <button class="btn-light btn-light-100 ml-1 px-1  py-0 rounded text-grey btn-xxs line-height-1" id="slip-date-navi-next-btn"
                                        onclick="calc_slip_date_rang('#{{ $modalClassName }}slip-date-navi-div', $('input:radio[name={{ $modalClassName }}date-navi]:checked').val(), 1)">
                                    <i class="fas fa-angle-right"></i>
                                </button>
                            </div>
                            <div class="d-flex align-items-center" style="height: 28px;" id="{{ $modalClassName }}slip-date-navi-div">
                                @foreach ($moealSetFile['DateNaviOptions'] ?? [] as $key => $option)
                                    <input autocomplete="off" name="{{ $modalClassName }}date-navi" type="radio" class="slip-date-navi"
                                            value="{{ $option['Value'] }}" id="{{ $modalClassName.'date-navi-'.($key+1) }}">
                                    <label for="{{ $modalClassName.'date-navi-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['DateRange'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0 ">{{ $moealSetFile['FormVars']['Title']['DateRange'] }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;" id="slip-date-rang-div">
                                @foreach ($moealSetFile['DateRangeOptions'] ?? [] as $key => $option)
                                    <input  autocomplete="off" name="{{ $modalClassName }}date-range" type="radio" class="slip-date-range"
                                    value="{{ $option['Value'] }}" id="{{ $modalClassName.'date-range-'.($key+1) }}"
                                        {{ $option['Value'] == 'day' ? 'checked' : ''}}>
                                    <label for="{{ $modalClassName.'date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['Date'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0 ">{{ $moealSetFile['FormVars']['Title']['Date'] }}</label>
                            <div class="d-flex">
{{--                                <input class="rounded overflow-hidden w-100 text-nowrap start-date" type="date" value="1990-01-01">--}}
{{--                                <button class="btn disabled p-1 text-center">~</button>--}}
{{--                                <input class="rounded overflow-hidden w-100 text-nowrap end-date" type="date" value="3000-12-31">--}}
                                <input class="rounded overflow-hidden w-100 text-nowrap start-date" type="date" value="">
                                <button class="btn p-1 text-center" onclick="click_slip_equal_btn()">=</button>
                                <input class="rounded overflow-hidden w-100 text-nowrap end-date" type="date" value="">
                            </div>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['QuerySpeed'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0 ">{{ $moealSetFile['FormVars']['Title']['QuerySpeed'] }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;">
                                @foreach($moealSetFile['QuerySpeedOptions'] as $index => $option)
                                    <input name="{{ $modalClassName }}query-speed" type="radio" value="{{ $option['Value'] }}" id="{{ $modalClassName.'query-speed-'.$index }}"
                                        {{ $index == 0 ? 'checked' : '' }} onchange="change_slip_query_speed()">
                                    <label class="w-100 rounded overflow-hidden mr-0 text-nowrap" for="{{ $modalClassName.'query-speed-'.$index }}">{{ $option['Caption'] }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="{{ $moealSetFile['FormVars']['Display']['SlipNo'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SlipNo'] }}</label>
                            <input type="text" class="rounded w-100 slip-no filter" autocomplete="off">
                        </div>
                        <div class="{{ $moealSetFile['FormVars']['Display']['CompanyName'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['CompanyName'] }}</label>
                            <input type="text" class="rounded w-100 company-name filter" autocomplete="off">
                        </div>
                        <div class="{{ $moealSetFile['FormVars']['Display']['ItemCode'] }} flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['ItemCode'] }}</label>
                            <input type="text" class="rounded w-100 item-code filter" autocomplete="off">
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['FilterOption'] }}</label>
                            <div class="row">
                                <div class="col-5 pr-1">
                                    <select class="rounded w-100" id="filter-name-select" onchange="chagne_slip_modal_filter_name_select(this)">
                                        @foreach ($moealSetFile['FilterSelectOptions'] ?? [] as $key => $popupOption)
                                            <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                {{ $popupOption['Caption'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input class="rounded w-100" type="text" id="filter-value-txt" hidden onkeydown="override_enter_pressed_slip_modal_auto_search(event)">
                                </div>
                            </div>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['SimpleOption'] }} flex-column">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SimpleOption'] }}</label>
                            <select class="rounded w-100" id="simple-filter-select" onchange="$('#modal-slip.show').find('.modal-search').trigger('click')">
                                @foreach ($moealSetFile['SimpleSelectOptions'] ?? [] as $key => $popupOption)
                                    <option value="{{ $popupOption['Value'] }}">
                                        {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                </div>

                <button type="button" class="btn btn-dark btn-sm modal-search position-absolute slip-save-spinner-btn" disabled>
                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <button type="button" class="btn btn-dark btn-sm icon-search4 modal-search position-absolute slip-search-btn"  data-target="slip" data-class="{{ $modalClassName }}"></button>
            </div>
            <div class="modal-footer">
                <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="slip" data-class="{{ $modalClassName }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="slip" data-class="{{ $modalClassName }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="{{ csset('/js/modals-controller/b-type/slip.js') }}"></script>
@endonce
