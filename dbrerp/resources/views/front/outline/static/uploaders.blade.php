<!--- uploaders --->
<div class="modal fade" id="modal-uploaders" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4" style="width: 620px;">
        <div class="modal-content">
            <div class="modal-header bg-danger-10 ">
                <h4 class="modal-title text-white" id="myModalLabel">업로더</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                <div class="mt-4 card">
                    <div class="d-flex flex-column p-2">
                        <label class="m-0">-중요코드(예:품목코드)중복시 에러</label>
                        <label class="m-0">-타이틀 추가시 에러</label>
                        <label class="m-0"></label>
                        <label class="m-0">타이틀제거 Line수</label>
                        <input type="number" id="rows-delete-num-txt" class="rounded w-100" value="1" min="0">
                    </div>
                    <div class="dropzone" id="fileDropzone">
                    </div>
                </div>
                <div class="position-absolute" style="top: 3px; right: 10px;">
                    <button type="button" class="font-weight-bold btn btn-danger btn-sm icon-copy3 complete-memo-btn"
                    id="btn-upload-file">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<link href="{{ csset('/css/uploaders/dropzone.css') }}" rel="stylesheet" type="text/css">
<script src="{{ csset('/js/plugins/uploaders/dropzone.js') }}"></script>

<script>
    Dropzone.options.fileDropzone = {
        paramName: 'file',
        url: '/excel-import',
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        acceptedFiles: ".csv,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xls,.xml,.xlt,.xlam,.xla,.xlw",
        init: function () {
            var submitButton = document.querySelector("#btn-upload-file");
            var myDropzone = this;

            submitButton.addEventListener("click", function () {
                myDropzone.processQueue();
            });

        },
        autoProcessQueue: false,    // 자동업로드 여부 (true일 경우, 바로 업로드 되어지며, false일 경우, 서버에는 올라가지 않은 상태임 processQueue() 호출시 올라간다.)
        clickable: true,            // 클릭가능여부
        thumbnailHeight: 90,        // Upload icon size
        thumbnailWidth: 90,         // Upload icon size
        // maxFiles: 1,                // 업로드 파일수
        // maxFilesize: 100,            // 최대업로드용량 : 100MB
        parallelUploads: 1,        // 동시파일업로드 수(이걸 지정한 수 만큼 여러파일을 한번에 컨트롤러에 넘긴다.)
        addRemoveLinks: true,       // 삭제버튼 표시 여부
        dictRemoveFile: '삭제',     // 삭제버튼 표시 텍스트
        uploadMultiple: false,       // 다중업로드 기능

        success: function(file, response)
        {
            if (isEmptyArr(response)) {
                iziToast.error({ title: 'Error', message: $('#no-data-found').text() });
                return;
            }
            $('#modal-uploaders').trigger('excel.upload', [response, $('#rows-delete-num-txt').val()]);

            iziToast.success({ title: 'Success', message: '** Please WAIT UNTIL tmp table created **' });
        },
        error: function(file, response)
        {
            iziToast.error({ title: 'Error', message: 'excel upload error' });
            return false;
        }
    };

    // $(document).on('shown.bs.modal','#modal-uploaders', function (e) {
    // })

</script>
@endonce
