<!--- item-search --->
@php $modalClassName = $modalClassName ?? ''; @endphp
<div class="modal fade modal-cyan {{ $modalClassName }}" id="modal-item" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1060;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1280px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row p-0 mt-2 m-auto">
                    {{-- 기본 텍스트 --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['ItemCode'] }}</label>
                            <input type="text" class="rounded w-100 item-code filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['ItemCode'] }}>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['ItemName'] }}</label>
                            <input type="text" class="rounded w-100 item-name filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['ItemName'] }}>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['FilterOption'] }} flex-column mb-2">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['FilterOption'] }}</label>
                            <div class="row">
                                <div class="col-5 pr-1">
                                    <select class="rounded w-100" id="filter-name-select" onchange="chagne_item_modal_filter_name_select(this)">
                                        @foreach ($moealSetFile['FilterSelectOptions'] as $key => $popupOption)
                                            <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                {{ $popupOption['Caption'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input class="rounded w-100" type="text" id="filter-value-txt" hidden onkeydown="override_enter_pressed_item_modal_auto_search(event)">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SubName'] }}</label>
                            <input type="text" class="rounded w-100 sub-name filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['SubName'] }}>
                        </div>

                        <div class="{{ $moealSetFile['FormVars']['Display']['SimpleOption'] }} flex-column">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SimpleOption'] }}</label>
                            <select class="rounded w-100" id="simple-filter-select" onchange="$('#modal-item.show').find('.modal-search').trigger('click')">
                                @foreach ($moealSetFile['SimpleSelectOptions'] as $key => $popupOption)
                                    <option value="{{ $popupOption['Value'] }}">
                                        {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="position-absolute d-flex" style="top: 32px; right: 16px;">
                    <button type="button" class="btn btn-sm btn-primary icon-search4 modal-search mr-1" style="top: unset; right: unset;" data-target="item" data-class="{{ $modalClassName }}">
                    </button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary item-search-act save-button" onclick="item_search_multi_select()" data-value="multi-select" {{ $moealSetFile['FormVars']['Hidden']['SelectButton'] }}>
                            {{ $moealSetFile['FormVars']['Title']['SelectButton'] }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-10 mt-2 mb-2 table-responsive" style="height: 400px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="col-2" style="height: 400px;">
                    <div class="d-flex flex-column mb-2" style="height: 50px;" {{ $moealSetFile['FormVars']['Hidden']['CurrStockQty'] }}>
                        <label class="m-0 overflow-hidden text-nowrap">{{ $moealSetFile['FormVars']['Title']['CurrStockQty'] }}</label>
                        <input type="text" class="rounded w-100 curr-stock-qty text-{{ $moealSetFile['FormVars']['Align']['CurrStockQty'] }}" autocomplete="off" disabled>
                    </div>
                    <div class="d-flex flex-column mb-2" style="height: 50px;" {{ $moealSetFile['FormVars']['Hidden']['PurchPrc'] }}>
                        <label class="m-0 overflow-hidden text-nowrap">{{ $moealSetFile['FormVars']['Title']['PurchPrc'] }}</label>
                        <div class="d-flex">
                            <input type="text" class="rounded w-100 radius-r0 purch-prc border-right-0 text-{{ $moealSetFile['FormVars']['Align']['PurchPrc'] }}" autocomplete="off" disabled>
                            <span class="input-group-text w-100 rounded radius-l0 col-3 p-0 count-unit d-inline-block text-{{ $moealSetFile['FormVars']['Align']['CountUnit'] }} align-middle overflow-hidden text-nowrap"></span>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-2" style="height: 50px;" {{ $moealSetFile['FormVars']['Hidden']['SalesPrc'] }}>
                        <label class="m-0 overflow-hidden text-nowrap">{{ $moealSetFile['FormVars']['Title']['SalesPrc'] }}</label>
                        <div class="d-flex">
                            <input type="text" class="rounded w-100 radius-r0 sales-prc border-right-0 text-{{ $moealSetFile['FormVars']['Align']['SalesPrc'] }}" autocomplete="off" disabled>
                            <span class="input-group-text w-100 rounded radius-l0 col-3 p-0 count-unit d-inline-block text-{{ $moealSetFile['FormVars']['Align']['CountUnit'] }} align-middle overflow-hidden text-nowrap"></span>
                        </div>
                    </div>
                    <div class="d-flex flex-column" {{ $moealSetFile['FormVars']['Hidden']['ItemDesc'] }}>
                        <label class="m-0 overflow-hidden text-nowrap">{{ $moealSetFile['FormVars']['Title']['ItemDesc'] }}</label>
                        <textarea style="height: 85px" class="rounded w-100 item-desc text-{{ $moealSetFile['FormVars']['Align']['ItemDesc'] }}" disabled></textarea>
                    </div>
                </div>
                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="item" data-class="{{ $modalClassName }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="item" data-class="{{ $modalClassName }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="{{ csset('/js/modals-controller/a-type/item.js') }}"></script>
@endonce
