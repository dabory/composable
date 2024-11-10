<!--- modal-select-popup-search --->
<div class="modal fade {{ $attachClassName ?? '' }} {{ $popupOption['ModalClassName'] }} {{ $popupOption['Unique'] ?? '' }}"
     id="modal-select-popup" aria-hidden="true" data-backdrop="static" style="z-index: 1049; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-original-purple">
                <h4 class="modal-title text-white" id="myModalLabel">{{ $popupOption['Caption'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                @include($popupOption['BladeRoute'], [
                    $popupOption['ParameterType'] => $popupOption['Parameter']
                ])
            </div>
        </div>
    </div>
</div>
