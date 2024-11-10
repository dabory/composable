@php $modalClassName = $modalClassName ?? ''; @endphp
<div class="modal fade modal-cyan {{ $modalClassName }}" id="modal-setting" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1100px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-end">
                    <div class="col-4" >
                        <div class="d-flex flex-column">
                            <label class="m-0">검색조건</label>
                            <div class="row">
                                <div class="col-5 pr-1">
                                    <select class="rounded w-100" id="filter-name-select">
                                        @foreach ($moealSetFile['FilterSelectOptions'] ?? [] as $key => $popupOption)
                                            <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                {{ $popupOption['Caption'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="override_enter_pressed_setting_modal_auto_search(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7" >
                        <div class="d-flex flex-column">
                            <label class="m-0">상태별 검색</label>
                            <select class="rounded w-100" id="simple-filter-select" onchange="$('#modal-setting.show').find('.modal-search').trigger('click')">
                                @foreach ($moealSetFile['SimpleSelectOptions'] ?? [] as $key => $popupOption)
                                    <option value="{{ $popupOption['Value'] }}">
                                        {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="setting" data-class="{{ $modalClassName }}"></button>
                    </div>

                    <div class="col-12 my-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="setting" data-class="{{ $modalClassName }}">
                            @include('front.outline.moption')
                        </select>
                    </div>
                    <div class="col-6" >
                        <ul class="pagination pagination-sm" style="float: right;"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="/js/modals-controller/a-type/setting.js?{{date('YmdHis')}}"></script>
@endonce
