{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-seo-html-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary seo-html-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'seo-html-act',
                ])
            @endisset
        </div>
    </div>
    <div class="card mb-2" id="seo-html-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="hidden" id="view-source-url">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PageHtml'] }}</label>
                                <textarea id="page-html-textarea"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-3 common-seo-html">
                                <label class="m-0">site-verification HTML & robots.txt (.xml, .txt .html ONLY)</label>
                                <input type="file" id="upload-file" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormASeoHtmlForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column common-seo-html">
                                <label class="m-0">site-verification HTML & robots.txt (Upload)</label>
                                <div class="table-responsive mt-2" style="height:300px;" id="scroll-area">
                                    <table class="table-row seo-html-table">
                                        <thead id="seo-html-table-head">
                                        @include('front.dabory.erp.partial.make-thead', [
                                            'listVars' => [
                                                'Title' => [ 'C1' => 'site-verification HTML & robots.txt', 'C2' => ' '],
                                                'Hidden' => [ 'C1' => '', 'C2' => ''],
                                                'Size' => [ 'C1' => '3', 'C2' => '3'],
                                            ],
                                            'checkboxName' => 'seo-html-cud-check'
                                        ])
                                        </thead>
                                        <tbody id="seo-html-table-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
    <script>
        $(document).ready(async function() {
            $('#seo-html-form').find('#upload-file').fileselect()

            $('.seo-html-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormASeoHtmlForm.btn_act_save(); break;
                    case 'view-source': PopupSetupFormASeoHtmlForm.view_source(); break;
                }
            });

            $(document).on('click', '.del-btn', function () {
                const fileName = $(this).data('file');
                PopupSetupFormASeoHtmlForm.delete_file(fileName);
            });

            activate_button_group()
        });

        (function( PopupSetupFormASeoHtmlForm, $, undefined ) {
            PopupSetupFormASeoHtmlForm.formA = {!! json_encode($formA) !!};
            PopupSetupFormASeoHtmlForm.brand_code

            PopupSetupFormASeoHtmlForm.view_source = function () {
                let view_source = ''
                if (PopupSetupFormASeoHtmlForm.brand_code === 'common' || PopupSetupFormASeoHtmlForm.brand_code === 'main') {
                    view_source = 'view-source:' + window.env['APP_URL']
                } else {
                    view_source = 'view-source:' + window.env['APP_URL'] + '/' + PopupSetupFormASeoHtmlForm.brand_code
                }

                $('#seo-html-form').find('#view-source-url').attr('type', 'text');
                $('#seo-html-form').find('#view-source-url').val(view_source).select()
                const copy = document.execCommand('copy')
                if(copy) {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                }
                $('#seo-html-form').find('#view-source-url').attr('type', 'hidden');
            }

            PopupSetupFormASeoHtmlForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#seo-html-form #frm')
                PopupSetupFormASeoHtmlForm.file_list()
            }

            PopupSetupFormASeoHtmlForm.check_file_name = function (str) {
                const ext = str.split('.').pop().toLowerCase()
                return !!(str === 'sitemap.xml' || str === 'bingsiteauth.xml'
                    || ext === 'txt' || str.match(/naver\w+\.html/) || str.match(/google\w+\.html/));

            }

            PopupSetupFormASeoHtmlForm.make_seo_file_list_table = function (file_list) {
                let html = []
                file_list.forEach(file => {
                    const safeFileName = file.replace(/\./g, '-').replace(/\//g, '-'); // 슬래시도 대시로 변경
                    html.push (`
                        <tr id="file-row-${safeFileName}">
                            <td>${file}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" target="_blank" href="/${file}">
                                    확인
                                </a>
                                <a class="btn btn-sm btn-danger del-btn" data-file="/${file}">
                                    삭제
                                </a>
                            </td>
                        </tr>
                    `)
                });
                $('#seo-html-form').find('#seo-html-table-body').html(html)
            }

            PopupSetupFormASeoHtmlForm.file_list = function () {
                $.ajax({
                    url: "/seo-meta-file-list",
                    type:'POST',
                    success: function(fileNames) {
                        const file_list = fileNames.filter(fileName => PopupSetupFormASeoHtmlForm.check_file_name(fileName.toLowerCase()))
                        PopupSetupFormASeoHtmlForm.make_seo_file_list_table(file_list)
                    },
                });
            }

            PopupSetupFormASeoHtmlForm.file_upload = function ($this) {
                const file_name = $($this).val().split('\\').pop().toLowerCase()
                if (! PopupSetupFormASeoHtmlForm.check_file_name(file_name)) {
                    $('#seo-html-form').find('#upload-file').val('')
                    return iziToast.error({
                        title: 'Error', message: '*.txt, sitemap.xml, BingSiteAuth.xml, naver*.html, google*.html 만 업로드 가능',
                    });
                }

                const form = new FormData()
                form.append('_token', $('meta[name="csrf-token"]').attr('content'))
                form.append('file', $('#seo-html-form').find('#upload-file')[0].files[0])
                form.append('fileName', $($this).val().split('\\').pop())
                $.ajax({
                    url: "/seo-meta-file-upload",
                    type:'POST',
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('response : ', response);
                        PopupSetupFormASeoHtmlForm.file_list()
                        iziToast.success({
                            title: 'Success', message: $('#action-completed').text(),
                        });
                    },
                });
            }

            PopupSetupFormASeoHtmlForm.delete_file = function (fileName){
                const safeFileName = fileName.replace(/\./g, '-').replace(/\//g, '-'); // 슬래시를 대시로 변경
                if (!confirm(`${fileName} 삭제하시겠습니까?`)) {
                        return;
                }

                $.ajax({
                    url: "/file-delete",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        file_path_list: JSON.stringify([fileName])
                    },
                    success: function(response) {
                        $(`#file-row${safeFileName}`).remove();
                        PopupSetupFormASeoHtmlForm.file_list();
                        iziToast.success({
                            title: 'Success', message: '삭제되었습니다.',
                        });
                    },
                    error: function(error) {
                        console.log(error.responseJSON)
                        iziToast.error({
                            title: 'Error', message: '파일 삭제에 실패했습니다.',
                        });
                    }
                });
            }

            PopupSetupFormASeoHtmlForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormASeoHtmlForm.parameter);

                Atype.btn_act_save('#seo-html-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    // $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormASeoHtmlForm');
            }

            PopupSetupFormASeoHtmlForm.parameter = function () {
                const form = $('#seo-html-form')

                let setup = {
                    PageHtml: $(form).find('#page-html-textarea').val(),
                }
                let id = Number($(form).find('#Id').val())
                let parameter = {
                    Id: id,
                    SetupJson: JSON.stringify(setup),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                return parameter;
            }

            PopupSetupFormASeoHtmlForm.btn_act_new = async function () {
                Atype.btn_act_new('#seo-html-form #frm')
                PopupSetupFormASeoHtmlForm.file_list()
            }

            PopupSetupFormASeoHtmlForm.show_popup_callback = async function (id, setup, brand_code) {
                $('#modal-select-popup.popup-setup-form-a-seo-html-form .modal-dialog').css('maxWidth', '600px');
                PopupSetupFormASeoHtmlForm.btn_act_new()
                $('#seo-html-form').find('#Id').val(id)
                PopupSetupFormASeoHtmlForm.brand_code = brand_code

                if (PopupSetupFormASeoHtmlForm.brand_code === 'common') {
                    $('#seo-html-form').find('.common-seo-html').removeClass('d-none')
                    $('#seo-html-form').find('.common-seo-html').addClass('d-flex')
                } else {
                    $('#seo-html-form').find('.common-seo-html').addClass('d-none')
                    $('#seo-html-form').find('.common-seo-html').removeClass('d-flex')
                }
                PopupSetupFormASeoHtmlForm.set_ui(setup)
            }

            PopupSetupFormASeoHtmlForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#seo-html-form')

                $(form).find('#page-html-textarea').val(setup['PageHtml'])
            }

        }( window.PopupSetupFormASeoHtmlForm = window.PopupSetupFormASeoHtmlForm || {}, jQuery ));
    </script>
@endonce
