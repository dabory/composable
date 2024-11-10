<!--- modal-chart-popup-search --->
<div class="modal fade modal-cyan {{ $popupOption['ModalClassName'] }} {{ $popupOption['Unique'] }}" id="modal-chart-popup" aria-hidden="true" data-backdrop="static" style="z-index: 1049; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-dark-alpha">
                <h4 class="modal-title text-white" id="myModalLabel">{{ $popupOption['Caption'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            {{-- @dd($popupOption) --}}
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                @include($popupOption['BladeRoute'], [
                    $popupOption['ParameterType'] => $popupOption['Parameter']
                ])
            </div>
        </div>
    </div>
</div>
