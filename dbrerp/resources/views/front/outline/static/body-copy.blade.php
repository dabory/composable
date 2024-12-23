<!--- body-copy-search --->
@php $modalClassName = $modalClassName ?? ''; @endphp

<div class="modal fade modal-red {{ $modalClassName }}" id="modal-bodycopy" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1050;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1250px;">
        <button type="button" hidden
            class="btn btn-success btn-open-modal modal-btn">
        </button>
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body pb-0 px-0">
                <div class="row p-0 mt-2 m-auto">
                    @foreach ($moealSetFile['BodyCopyPopupVars']['Filter'] as $key => $value)
                        <div class="col-lg-3 col-md-6 col-12 px-3">
                            <div class="{{ $moealSetFile['FormVars']['Display'][$key.'Button'] }} flex-column mb-2">
                                <label class="m-0">{{ $moealSetFile['FormVars']['Title'][$key.'Button'] }}</label>
                                <div class="d-flex">
                                    <input type="text" class="rounded w-100 bg-white filter radius-r0 {{ $value }}-txt" autocomplete="off"
                                    onkeydown="enter_pressed_auto_search(event)" data-target="bodycopy">
                                    <button type="button" class="btn-success rounded border-0 radius-l0"
                                    onclick="body_copy_show_modal('{{ $modalClassName }}', '{{ $key }}')">
                                    <i class="icon-folder-open"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($moealSetFile['FormVars']['Hidden']['AutoCreateSlipChecked'] !== 'hidden')
                        <div class="d-flex align-items-center mb-2 mb-md-0 px-0 px-md-1 pl-3">
                            <input type="checkbox" value="1" class="text-md-center w-100 overflow-hidden text-nowrap auto-create-slip-checked" name="AutoCreateSlipChecked" id="{{ $modalClassName }}-AutoCreateSlipChecked"
                                onclick="return false;">
                            <label class="m-0 text-nowrap" for="{{ $modalClassName }}-AutoCreateSlipChecked">{{ $moealSetFile['FormVars']['Title']['AutoCreateSlipChecked'] }}</label>
                        </div>
                    @endif
                </div>
                <div class="position-absolute">
                    <button type="button" class="btn btn-dark btn-sm icon-search4 modal-search top-0 right-0" hidden
                        data-target="bodycopy" data-class="{{ $modalClassName }}">
                    </button>
                    <button type="button" class="font-weight-bold btn btn-danger btn-sm icon-copy3 body-copy-act"
                        onclick="body_copy(this)">
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 mt-2 mb-2 table-responsive" style="height: 430px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="d-flex  flex-md-row justify-content-end align-items-stretch align-items-md-center col-2 mb-2 py-2 pr-0">
                    <div class="d-flex  flex-column align-items-md-center mb-2 mb-md-0 px-0 px-md-1">
                        <label class="w-100 overflow-hidden text-nowrap m-0" {{ $moealSetFile['FormVars']['Hidden']['SelectedItems'] }}
                            rowspan="1" colspan="1">
                            {{ $moealSetFile['FormVars']['Title']['SelectedItems'] }}
                        </label>
                        <input type="text" class="w-100 rounded selected-items" value="0" disabled {{ $moealSetFile['FormVars']['Hidden']['SelectedItems'] }}>

                    </div>

                    <div class="d-flex  flex-column align-items-md-center mb-2 mb-md-0 px-0 px-md-1">
                        <label class="w-100 overflow-hidden text-nowrap m-0" {{ $moealSetFile['FormVars']['Hidden']['SelectedQty'] }}
                            rowspan="1" colspan="1">
                            {{ $moealSetFile['FormVars']['Title']['SelectedQty'] }}
                        </label>
                        <input type="text" class="w-100 rounded selected-qty" value="0" disabled {{ $moealSetFile['FormVars']['Hidden']['SelectedQty'] }}>
                    </div>
                </div>

                <div class="jumbotron jumbotron-fluid w-100 mb-2 py-2">
                    <div class="col-12 d-flex flex-row flex-wrap  align-items-md-center py-2">
						<!--날짜-->
                        @if(isset($moealSetFile['FormVars']['Title']['DayFromTodayOption']) && !empty($moealSetFile['FormVars']['Title']['DayFromTodayOption']))
                            <div class="d-flex flex-column mb-2 sel-date">
                                <label class="m-0">{{ $moealSetFile['FormVars']['Title']['DayFromTodayOption'] }}</label>
                                <select class="rounded w-100 day-from-today-select">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30" selected>30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                    <option value="90">90</option>
                                    <option value="150">150</option>
                                    <option value="300">300</option>
                                    <option value="10000">10000</option>
                                </select>
                            </div>
                        @endif
                        <!--//날짜 -->

                        <div class="d-flex align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-1">
                            <label class="text-md-center text-nowrap m-0" {{ $moealSetFile['FormVars']['Hidden']['BalanceOption'] }}>
                                {{ $moealSetFile['FormVars']['Title']['BalanceOption'] }}
                            </label>
                            <select class="rounded w-100 balance-select ml-0 ml-md-1">
                                @foreach ($moealSetFile['BalanceOptions'] as $option)
                                    <option value="{{ $option['Value'] }}">{{ $option['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(isset($moealSetFile['FormVars']['Title']['ShowOnlyClosedChecked']) && !empty($moealSetFile['FormVars']['Title']['ShowOnlyClosedChecked']))
                            <div class="d-flex align-items-stretch align-items-md-center flex-column flex-md-row mb-2 mb-md-0 px-0 px-md-1 pl-3">
                                <input type="checkbox" value="1" class="text-md-center w-100 overflow-hidden text-nowrap" name="ShowOnlyClosedChecked" id="{{ $modalClassName }}-ShowOnlyClosedChecked">
                                <label class="m-0 text-nowrap" for="{{ $modalClassName }}-ShowOnlyClosedChecked">{{ $moealSetFile['FormVars']['Title']['ShowOnlyClosedChecked'] }}</label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="bodycopy" data-class="{{ $modalClassName }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="bodycopy" data-class="{{ $modalClassName }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let class_name =  {!! json_encode($modalClassName) !!};
        bodyCopy[class_name] = {!! json_encode($moealSetFile) !!};
    });
</script>

@foreach ($moealSetFile['BodyCopyPopupVars']['Display'] as $key => $i)
    @if ($moealSetFile['BodyCopyPopupVars']['Display'][$key] != 'd-none')
        @push('modal')
            @include($moealSetFile['BodyCopyPopupVars']['BladeRoute'][$key], [
                'moealSetFile' => $moealSetFile['BodyCopyPopupVars']['Parameter'][$key],
                'modalClassName' => $modalClassName
            ])
        @endpush
    @endif
@endforeach

@once
<script src="{{ csset('/js/modals-controller/b-type/body-copy.js') }}"></script>
<script>
    function body_copy_show_modal(modal_class_name, key) {
        let func_name = `get_${bodyCopy[modal_class_name]['BodyCopyPopupVars']['Filter'][key]}`;
        // 첫 번째 show 했을 때만 호출
        if (! $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('first')) {
            first_slip_date_rang(`#${modal_class_name}slip-date-navi-div`)
        }

        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('first', true)
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('filter', bodyCopy[modal_class_name]['BodyCopyPopupVars']['Filter'][key])
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('target', bodyCopy[modal_class_name]['BodyCopyPopupVars']['Component'][key])
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('variable', bodyCopy[modal_class_name]['BodyCopyPopupVars']['Parameter'][key])
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('class', modal_class_name)
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').data('clicked', snakeCase(func_name))
        $(`#modal-bodycopy.${modal_class_name}`).find('.modal-btn').trigger('click')

    }

    var bodyCopy = {}
</script>
@endonce
