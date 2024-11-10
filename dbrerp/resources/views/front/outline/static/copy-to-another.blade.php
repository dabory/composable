<!--- copy-to-anther --->
@php $modalClassName = $modalClassName ?? '';
//var_dump($moealSetFile['General']['Title']);
@endphp
<div class="modal fade {{ $modalClassName }}" id="modal-copy-to-another" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4" style="width: 480px;">
        <button type="button" hidden
            class="btn btn-success btn-open-modal modal-btn">
        </button>
        <div class="modal-content">
            <div class="modal-header" style="background-color: #45748a;">
                <h4 class="modal-title text-white" id="myModalLabel">{{ $moealSetFile['General']['Title'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body pb-2">
                <div class="d-flex flex-row justify-content-center">
                    <div class="mr-2">
                        <button type="button" class="w-100 btn-sm mb-1 border-0 source-btn"
                        onclick="copy_to_another_show_modal('{{ $modalClassName }}', 'Source')">
                            {{ $moealSetFile['FormVars']['Title']['SourceButton'] }}
                        </button>
                        <input type="text" class="text-center rounded w-100 source-slip-no-txt" autocomplete="off" required>
                    </div>

                    <div>
                        <button class="w-100 btn-sm mb-1 target-slip-no-btn border-0"
                            onclick="get_target_last_slip_no(this)">
                            {{ $moealSetFile['FormVars']['Title']['TargetButton'] }}
                        </button>
                        <input type="text" class="text-center rounded w-100 target-slip-no-txt" autocomplete="off" required>
                    </div>

                    <button class="btn_copy btn btn-sm btn-secondary rounded btn-sm icon-copy3 ml-2" onclick="copy_to_another()"></button>

                </div>
            </div>
            <div class="d-flex pb-3 flex-column row02">
                <div class="mb-1">
                    <input type="checkbox" value="1" name="EqualLabel" id="{{ $modalClassName }}-EqualLabel" onchange="change_target_text(this)">
                    <label class="m-0 font-weight-bold"
                        for="{{ $modalClassName }}-EqualLabel">{{ $moealSetFile['FormVars']['Title']['EqualLabel'] }}</label>
                    <input type="hidden" name="EqualLabel" value='0' id="EqualLabel_hidden">
                </div>

                <div class="d-flex px-2 border border-light">
                    <label class="m-0 font-weight-bold">{{ $moealSetFile['FormVars']['Title']['ItemCopyLabel'] }}</label>

                    <input name="{{ $modalClassName }}-CopyItemCheckRadio" type="radio" value="true" id="{{ $modalClassName }}-CopyItemRadio">
                    <label class="m-0" for="{{ $modalClassName }}-CopyItemRadio">
                        {{ $moealSetFile['FormVars']['Title']['CopyItemRadio'] }}
                    </label>

                    <input name="{{ $modalClassName }}-CopyItemCheckRadio" type="radio" value="false" id="{{ $modalClassName }}-DontCopyRadio">
                    <label class="m-0" for="{{ $modalClassName }}-DontCopyRadio">
                        {{ $moealSetFile['FormVars']['Title']['DontCopyRadio'] }}
                    </label>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let class_name =  {!! json_encode($modalClassName) !!};
        copyToAnother[class_name] = {!! json_encode($moealSetFile) !!};
    });
</script>

@php
 //var_dump($moealSetFile['CopyToAnotherPopupVars']['Display']);
@endphp

@foreach ($moealSetFile['CopyToAnotherPopupVars']['Display'] as $key => $i)
    @if ($moealSetFile['CopyToAnotherPopupVars']['Display'][$key] != 'd-none')
        @push('modal')
            @include($moealSetFile['CopyToAnotherPopupVars']['BladeRoute'][$key], [
                'moealSetFile' => $moealSetFile['CopyToAnotherPopupVars']['Parameter'][$key],
                'modalClassName' => 'copy-to-another-'.$modalClassName
            ])
        @endpush
    @endif
@endforeach

@once
<script src="{{ csset('/js/modals-controller/b-type/copy-to-another.js') }}"></script>
<script>
    function copy_to_another_show_modal(class_name, key) {
        let modal_class_name = 'copy-to-another-' + class_name;
        let func_name = `get_source_${copyToAnother[class_name]['CopyToAnotherPopupVars']['Filter'][key]}`;

        // 첫 번째 show 했을 때만 호출
        if (! $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('first')) {
            first_slip_date_rang(`#${modal_class_name}slip-date-navi-div`)
        }
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('first', true)
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('filter', copyToAnother[class_name]['CopyToAnotherPopupVars']['Filter'][key])
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('target', copyToAnother[class_name]['CopyToAnotherPopupVars']['Component'][key])
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('variable', copyToAnother[class_name]['CopyToAnotherPopupVars']['Parameter'][key])
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('class', modal_class_name)
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').data('clicked', snakeCase(func_name))
        $(`#modal-copy-to-another.${class_name}`).find('.modal-btn').trigger('click')

    }
    var copyToAnother = {}
</script>
@endonce
