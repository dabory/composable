<!--- json-editor --->
<div class="modal fade" id="modal-json-editor" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-slate-300">
                <h4 class="modal-title text-white" id="myModalLabel">제이슨필드 입력</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                <div class="mt-4 card">
                    <div id="editor" class="json-editor"></div>
                    <pre class="table-footer" id="json"></pre>
                </div>
                <div class="position-absolute" style="top: 3px; right: 10px;">
                    <button type="button" class="font-weight-bold btn btn-danger btn-sm icon-copy3 complete-memo-btn"
                    onclick="complete_json()">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<link href="/css/jsoneditor.css?{{ date('YmdHis') }}" rel="stylesheet" type="text/css">
<script src="/js/components/jquery.jsoneditor.js?{{date('YmdHis')}}"></script>

<script>
    $(document).on('shown.bs.modal','#modal-json-editor', function (e) {
        let json = {}
        if (! isEmpty($('#modal-json-editor').find('#json').html())) {
            json = JSON.parse($('#modal-json-editor').find('#json').html());
        }
        $('#modal-json-editor').find('#editor').jsonEditor(json, { change: function(data) {
            $('#modal-json-editor').find('#json').html(JSON.stringify(data));
        } });
    })

    // $(document).on('dblclick', '#modal-json-editor #editor', function() {
    //     complete_json()
    // });

    function complete_json() {
        $('#modal-json-editor').modal('hide');
        let dom = $('#modal-json-editor').data('parameter')
        $(dom).val($('#modal-json-editor').find('#json').html())
    }
</script>
@endonce
