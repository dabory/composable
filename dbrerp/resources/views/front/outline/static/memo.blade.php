<!--- memo --->
<div class="modal fade" id="modal-memo" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-slate-300">
                <h4 class="modal-title text-white" id="myModalLabel">메모필드 입력 -메모필드(여러줄로 입력될 수 있는 필드)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                <div class="mt-4">
                    @include('components.web-editor')
                    <textarea id="memo-editor" style="height: 690px; display: none;"></textarea>
                </div>
                <div class="position-absolute" style="top: 3px; right: 10px;">
                    <button type="button" class="font-weight-bold btn btn-secondary"
                            onclick="change_memo_mode(this)">
                        모드 Toggle
                    </button>
                    <button type="button" class="font-weight-bold btn btn-danger btn-sm icon-copy3 complete-memo-btn"
                        onclick="complete_memo(this)">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="{{ csset('/js/components/web-editor.js') }}"></script>

<script>
    $('#modal-memo').on('show.bs.modal', function (event) {
        $(this).find('#froala-editor').show()
        $(this).find('#memo-editor').hide()

        $(this).find('#memo-editor').val('')
    })


    $('#modal-memo').on('hide.bs.modal', function (event) {
        const editor = $(this).find('#froala-editor')[0]['data-froala.editor']
        if (editor.codeView.isActive()) {
            editor.codeView.toggle()
        }
    })

    $(document).ready(async function() {
        let para_path = @json($paraPath ?? '');
        if (para_path) {
            mediaModal = await include_media_library('media-body', 'post', para_path)
        } else {
            mediaModal = await include_media_library('media-body', 'post')
        }
    });

    let mediaModal;
</script>
@endonce

