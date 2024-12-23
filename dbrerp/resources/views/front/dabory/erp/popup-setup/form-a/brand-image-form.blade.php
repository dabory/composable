{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-brand-image-form">
{{-- <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary brand-image-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'brand-image-act',
                ])
            @endisset
        </div>
    </div> --}}
    <div class="card mb-2" id="brand-image-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="hidden" id="view-source-url">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-3 common-brand-img logo-image-small">
                            <div class="d-flex align-items-center w-100">
                                <label class="m-0">{{ $formA['FormVars']['Title']['LogoImageSmall'] }}</label>
                                <span class="ml-1">{{ $formA['FormVars']['Title']['LogoImageSmallPath'] }}</span>
                            </div>
                                <input type="file" id="upload-file-small" data-type="small" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column mb-3 common-brand-img logo-image-medium">
                                <div class="d-flex align-items-center w-100">
                                    <label class="m-0">{{ $formA['FormVars']['Title']['LogoImageMedium'] }}</label>
                                    <span class="ml-1">{{ $formA['FormVars']['Title']['LogoImageMediumPath'] }}</span>
                                </div>
                                <input type="file" id="upload-file-medium" data-type="medium" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column mb-3 common-brand-img logo-image-big">
                                    <div class="d-flex align-items-center w-100">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['LogoImageBig'] }}</label>
                                        <span class="ml-1">{{ $formA['FormVars']['Title']['LogoImageBigPath'] }}</span>
                                    </div>
                                <input type="file" id="upload-file-big" data-type="big" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column mb-3 common-brand-img og-image">
                                    <div class="d-flex align-items-center w-100">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['OgImageBig'] }}</label>
                                        <span class="ml-1">{{ $formA['FormVars']['Title']['OgImageBigPath'] }}</span>
                                    </div>
                                <input type="file" id="upload-file-og" data-type="og" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column mb-3 common-brand-img pavicon-image">
                                <div class="d-flex align-items-center w-100">
                                    <label class="m-0">{{ $formA['FormVars']['Title']['PaviconImage'] }}</label>
                                    <span class="ml-1">{{ $formA['FormVars']['Title']['PaviconImagePath'] }}</span>
                                </div>
                                <input type="file" id="upload-file-pavicon" data-type="pavicon" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column mb-3 common-brand-img coming-soon-image">
                                <div class="d-flex align-items-center w-100">
                                    <label class="m-0">{{ $formA['FormVars']['Title']['ComingSoonImage'] }}</label>
                                    <span class="ml-1">{{ $formA['FormVars']['Title']['ComingSoonImagePath'] }}</span>
                                </div>
                                <input type="file" id="upload-file-coming" data-type="coming" class="cursor-pointer rounded w-100 form-control-uniform-custom" style="text-indent: 0;"
                                       onchange="PopupSetupFormABrandImageForm.file_upload(this)">
                            </div>
                            <div class="d-flex flex-column common-brand-img">
                                <label class="m-0">로고/파비콘 & OG image (Upload)</label>
                                <div class="table-responsive mt-2" style="height:300px;" id="scroll-area">
                                    <table class="table-row brand-image-table">
                                        <thead id="brand-image-table-head">
                                        @include('front.dabory.erp.partial.make-thead', [
                                            'listVars' => [
                                                'Title' => [ 'C1' => 'Title', 'C2' => ' '],
                                                'Hidden' => [ 'C1' => '', 'C2' => ''],
                                                'Size' => [ 'C1' => '3', 'C2' => '3'],
                                            ],
                                            'checkboxName' => 'brand-image-cud-check'
                                        ])
                                        </thead>
                                        <tbody id="brand-image-table-body">
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
        let file_name=""
        let uploadedFiles = [];
        $(document).ready(async function() {
            $('#brand-image-form').find('[id^="upload-file"]').fileselect()
            $('.brand-image-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormABrandImageForm.btn_act_save(); break;
                    case 'view-source': PopupSetupFormABrandImageForm.view_source(); break;
                }
            });

            $(document).on('click', '.del-btn', function () {
                const fileName = $(this).data('file');
                PopupSetupFormABrandImageForm.delete_file(fileName);
            });

            activate_button_group()
        });

        (function( PopupSetupFormABrandImageForm, $, undefined ) {
            PopupSetupFormABrandImageForm.formA = {!! json_encode($formA) !!};
            PopupSetupFormABrandImageForm.brand_code

            PopupSetupFormABrandImageForm.view_source = function () {
                let view_source = ''
                if (PopupSetupFormABrandImageForm.brand_code === 'common' || PopupSetupFormABrandImageForm.brand_code === 'main') {
                    view_source = 'view-source:' + window.env['APP_URL']
                } else {
                    view_source = 'view-source:' + window.env['APP_URL'] + '/' + PopupSetupFormABrandImageForm.brand_code
                }

                $('#brand-image-form').find('#view-source-url').attr('type', 'text');
                $('#brand-image-form').find('#view-source-url').val(view_source).select()
                const copy = document.execCommand('copy')
                if(copy) {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                }
                $('#brand-image-form').find('#view-source-url').attr('type', 'hidden');
            }

            PopupSetupFormABrandImageForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#brand-image-form #frm')
                PopupSetupFormABrandImageForm.file_list()
            }

            // PopupSetupFormABrandImageForm.check_file_name = function (str) {
            //     const ext = str.split('.').pop().toLowerCase()
            //     return !!(str === 'sitemap.xml' || str === 'bingsiteauth.xml'
            //         || ext === 'txt' || str.match(/naver\w+\.html/) || str.match(/google\w+\.html/));
            // }

            PopupSetupFormABrandImageForm.check_file = function (filename) {
                const exists = uploadedFiles.some(file => filename === file);
                return exists ? false : true;
            }

            PopupSetupFormABrandImageForm.make_brand_file_list_table = function (file_list) {
                let html = []
                const theme = "{{ env('DBR_THEME') }}";
                const parent_url = `public/themes/${theme}/pro/resources/assets/brand-images/`;

                file_list.forEach(file => {
                    const safeFileName = file.replace(/\./g, '-').replace(/\//g, '-');
                    html.push (`
                        <tr id="file-row-${safeFileName}">
                            <td>${file}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" target="_blank" href="/${parent_url}${file}">
                                    확인
                                </a>
                                <a class="btn btn-sm btn-danger del-btn" data-file="${file}">
                                    삭제
                                </a>
                            </td>
                        </tr>
                    `)
                });

                $('#brand-image-form').find('#brand-image-table-body').html(html)
            }

            PopupSetupFormABrandImageForm.file_list = function () {
                $.ajax({
                    url: "/brand-image-file-list",
                    type:'POST',
                    success: function(fileNames) {
                        // console.log('test : ', fileNames);
                        const file_list = fileNames.filter(fileName => fileName)
                        PopupSetupFormABrandImageForm.make_brand_file_list_table(file_list)
                        uploadedFiles = file_list;
                        // PopupSetupFormABrandImageForm.displayFileNames(uploadedFiles);
                    },
                });
            }

            PopupSetupFormABrandImageForm.file_upload = function ($this) {
                const data_type = $($this).data('type')
                let file_name;
                switch( data_type ) {
                    case 'small': file_name = 'logo-small.jpg'; break;
                    case 'medium': file_name = 'logo-medium.jpg'; break;
                    case 'big': file_name = 'logo-big.jpg'; break;
                    case 'og': file_name = 'og.jpg'; break;
                    case 'pavicon': file_name = 'pavicon.jpg'; break;
                    case 'coming': file_name = 'coming-soon.jpg'; break;
                }

                if (!PopupSetupFormABrandImageForm.check_file(file_name)) {
                    const del_type = "auto"
                    PopupSetupFormABrandImageForm.delete_file(file_name, del_type)
                        .then(function() {
                            uploadFile(data_type, file_name);
                        })
                        .catch(function(error) {
                            console.error('파일 삭제 실패:', error);
                        });
                } else {
                    uploadFile(data_type, file_name);
                }

            }

            function uploadFile(data_type, file_name) {
                console.log('uploadFile_file_name : ', file_name);
                const form = new FormData();
                form.append('_token', $('meta[name="csrf-token"]').attr('content'));
                form.append('file', $('#brand-image-form').find(`[id="upload-file-${data_type}"]`)[0].files[0]);
                form.append('fileName', file_name);

                $.ajax({
                    url: "/brand-image-file-upload",
                    type: 'POST',
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        PopupSetupFormABrandImageForm.file_list();
                        iziToast.success({
                            title: 'Success',
                            message: $('#action-completed').text(),
                        });
                        // $('#modal-select-popup.show').modal('hide');
                    },
                });
            }

            PopupSetupFormABrandImageForm.delete_file = function (fileName, type) {
                const safeFileName = fileName.replace(/\./g, '-').replace(/\//g, '-');
                return new Promise((resolve, reject) => {
                    if(type !== 'auto'){
                        if (!confirm(`${fileName} 삭제하시겠습니까?`)) {
                            return;
                        }
                    }
                    $.ajax({
                        url: "/brand-image-file-delete",
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            file_path_list: JSON.stringify([fileName])
                        },
                        success: function(response) {
                            $(`#file-row${safeFileName}`).remove();
                            uploadedFiles = uploadedFiles.filter(file => file !== safeFileName);
                            PopupSetupFormABrandImageForm.file_list();
                            iziToast.success({
                                title: 'Success', message: '삭제완료.',
                            });
                            resolve(response); // 파일 삭제 성공 후 resolve
                        },
                        error: function(error) {
                            console.log(error.responseJSON)
                            iziToast.error({
                                title: 'Error', message: '삭제실패.',
                            });
                            reject('파일 삭제 실패'); // 실패 시 reject
                        }
                    });
                });
            };

            PopupSetupFormABrandImageForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormABrandImageForm.parameter);

                // Atype.btn_act_save('#brand-image-form #frm', function () {
                //     $('#modal-select-popup.show').trigger('list.requery')
                //     // $('#modal-select-popup.show').modal('hide');
                // }, 'PopupSetupFormABrandImageForm');
            }

            PopupSetupFormABrandImageForm.parameter = function () {
                const form = $('#brand-image-form')

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

            PopupSetupFormABrandImageForm.btn_act_new = async function () {
                Atype.btn_act_new('#brand-image-form #frm')
                PopupSetupFormABrandImageForm.file_list()
            }

            PopupSetupFormABrandImageForm.show_popup_callback = async function (id, setup, brand_code) {
                $('#modal-select-popup.popup-setup-form-a-brand-image-form .modal-dialog').css('maxWidth', '1000px');
                PopupSetupFormABrandImageForm.btn_act_new()
                $('#brand-image-form').find('#Id').val(id)
                PopupSetupFormABrandImageForm.brand_code = brand_code

                if (PopupSetupFormABrandImageForm.brand_code === 'common') {
                    $('#brand-image-form').find('.common-brand-img').removeClass('d-none')
                    $('#brand-image-form').find('.common-brand-img').addClass('d-flex')
                } else {
                    $('#brand-image-form').find('.common-brand-img').addClass('d-none')
                    $('#brand-image-form').find('.common-brand-img').removeClass('d-flex')
                }
                PopupSetupFormABrandImageForm.set_ui(setup)
            }

            PopupSetupFormABrandImageForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#brand-image-form')

                $(form).find('#page-html-textarea').val(setup['PageHtml'])
            }

            PopupSetupFormABrandImageForm.displayFileNames = function (file_list) {
                $('.logo-image-small span').empty();
                $('.logo-image-medium span').empty();
                $('.logo-image-big span').empty();
                $('.og-image span').empty();
                $('.pavicon-image span').empty();
                $('.coming-soon-image span').empty();
                file_list.forEach(file => {
                    let file_name = "";
                    switch (file) {
                        case 'logo-small.jpg':
                            file_name = 'logo-small.jpg';
                            $('.logo-image-small span').append(` (${file_name})`);
                            break;
                        case 'logo-medium.jpg':
                            file_name = 'logo-medium.jpg';
                            $('.logo-image-medium span').append(` (${file_name})`);
                            break;
                        case 'logo-big.jpg':
                            file_name = 'logo-big.jpg';
                            $('.logo-image-big span').append(` (${file_name})`);
                            break;
                        case 'og.jpg':
                            file_name = 'og.jpg';
                            $('.og-image span').append(` (${file_name})`);
                            break;
                        case 'pavicon.jpg':
                            file_name = 'pavicon.jpg';
                            $('.pavicon-image span').append(` (${file_name})`);
                            break;
                        case 'coming-soon.jpg':
                            file_name = 'coming-soon.jpg';
                            $('.coming-soon-image span').append(` (${file_name})`);
                            break;
                        default:
                            console.log('Unknown file:', file);
                    }
                });
            }

        }( window.PopupSetupFormABrandImageForm = window.PopupSetupFormABrandImageForm || {}, jQuery ));
    </script>
@endonce
