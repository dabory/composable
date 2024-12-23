<!--- memo --->
<div class="modal fade" id="modal-memo2" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-danger-10">
                <h4 class="modal-title text-white" id="myModalLabel">메모필드 입력 -메모필드(여러줄로 입력될 수 있는 필드)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body pt-0 pb-2 px-2" style="background-color: #f5f5f5;">
                <div class="text-right">
                    <div class="btn-group my-1">
                        <button type="button" class="btn btn-primary btn-sm memo2-act save-button" data-value="save">
                            저장
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => [
                                [ 'Value' => 'close', 'Caption' => '취소' ],
                            ],
                            'eventClassName' => 'memo2-act',
                        ])
                    </div>
                </div>
                <div class="p-0">
                    <textarea class="fr-view" id="memo-textarea" style="height: 690px;"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        $(document).ready(async function() {
            $('#modal-memo2 .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
        });

        $('.memo2-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': complete_memo2(this); break;
                case 'close': $('#modal-memo2').modal('hide'); break;
            }
        });

        $(document).on('dblclick', '#modal-memo2 .fr-view', function () {
            complete_memo2(this);
        });

        $(document).delegate('#modal-memo2 #memo-textarea', 'keydown', function(e) {
            const key_code = e.keyCode || e.which

            if (key_code === 9) {
                e.preventDefault();
                const start = this.selectionStart
                const end = this.selectionEnd

                // set textarea value to: text before caret + tab + text after caret
                $(this).val($(this).val().substring(0, start)
                    + "\t"
                    + $(this).val().substring(end))

                // put caret at right position again
                this.selectionStart = this.selectionEnd = start + 1
            }
        });

        function complete_memo2($this) {
            const modal_body = $($this).closest('.modal-body')
            const editor = $(modal_body).find('#memo-textarea')
            $($('#modal-memo2').data('txtarea_id')).val( editor.val() )
            $('#modal-memo2').modal('hide')

            $('#modal-memo2').trigger('complete.memo2', [$('#modal-memo2').data('txtarea_id'), $('#modal-memo2').data('id')])
        }
    </script>
@endonce
