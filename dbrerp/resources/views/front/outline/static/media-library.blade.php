<!--- media-library --->
<div class="modal fade modal-cyan {{ $popupOption['ModalClassName'] }}" id="modal-media-library" aria-hidden="true" data-backdrop="static" style="z-index: 1051; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel">{{ $popupOption['Caption'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                @include($popupOption['BladeRoute'], [
                    $popupOption['ParameterType'] => $popupOption['Parameter']
                ])
                <div class="px-2 text-right d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" onclick="choose_media()">미디어 선택</button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script>
    async function choose_media() {
        const file_url_list = await PopupForm1FormBMediaForm.get_pluck_file_url(await ListMedia1Form.get_selected_data())
        let html = '';
        file_url_list.forEach(file_url => {
            html += `<img src="${file_url}">`
        });
        $('#modal-memo').find('.fr-view').append(html)
        $('#modal-media-library.show').modal('hide')
    }
</script>
@endonce
