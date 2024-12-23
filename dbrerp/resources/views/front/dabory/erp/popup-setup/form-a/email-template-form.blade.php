{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-email-template-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary email-template-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'email-template-act',
                ])
            @endisset
        </div>
    </div>
    <div class="card mb-2" id="email-template-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FilePath'] }}</label>
                                <input type="text" id="file-path-txt" class="rounded w-100" autocomplete="off">
                            </div>
{{--                        <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Theme'] }}</label>
                                <input type="text" id="theme-txt" class="rounded w-100" autocomplete="off">
                            </div>--}}
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Subject'] }}</label>
                                <input type="text" id="subject-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Message'] }}</label>
{{--                                @include('components.web-editor')--}}
                                <button class="btn btn-primary" style="border-radius:unset;" onclick="PopupSetupFormAEmailTemplateForm.toggle_code_view()">Toggle Code View</button>
                                <textarea id="message-textarea" style="height: 650px;"></textarea>
                                <pre id="message-code-view" style="display:none;"></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-email-test" aria-hidden="true" data-backdrop="static" style="z-index: 3000; overflow: auto;">
        <div class="modal-dialog modal-dialog-centered m-auto pt-4" style="width: 620px;">
            <div class="modal-content">
                <div class="modal-header bg-danger-10">
                    <h4 class="modal-title text-white">테스트송신자로 메일전송</h4>
                    <button type="button" class="close" onclick="$('#modal-email-test').modal('hide')"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body p-2" style="background-color: #f5f5f5;">
                    <div class="mt-4 card">
                        <div class="d-flex flex-column p-2">
                            <label class="m-0">테스트 메일 보낼 이메일 주소</label>
                            <input type="email" id="test-to-email-txt" required class="rounded w-100">
                        </div>
                    </div>
                    <div class="position-absolute" style="top: 3px; right: 10px;">
                        <button type="button" class="font-weight-bold btn text-white bg-danger-10 btn-sm"
                            onclick="PopupSetupFormAEmailTemplateForm.email_send_test()">
                            메일전송
                        </button>
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
            $('.email-template-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAEmailTemplateForm.btn_act_save(); break;
                    case 'email-send-test': PopupSetupFormAEmailTemplateForm.btn_act_email_send_test(); break;
                }
            });

            // $(document).on('hide.bs.modal','.popup-setup-form-a-email-template-form.show', function () {
            //     const editor = $('#email-template-form').find('#froala-editor')[0]['data-froala.editor']
            //
            //     if (editor.codeView.isActive()) {
            //         editor.codeView.toggle()
            //     }
            // });

            activate_button_group()
        });

        (function( PopupSetupFormAEmailTemplateForm, $, undefined ) {
            PopupSetupFormAEmailTemplateForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAEmailTemplateForm.btn_act_email_send_test = async function () {
                $('#modal-email-test').find('#test-to-email-txt').val( window.env['ADMIN_EMAIL'] )
                $('#modal-email-test').modal('show')
            }

            PopupSetupFormAEmailTemplateForm.email_send_test = async function () {
                const emailHeaderFooter = await get_api_data('setup-get', {
                    SetupCode: 'email-header-footer'
                })

                let data = {
                    C1: emailHeaderFooter.data['Logo'],
                    C2: emailHeaderFooter.data['Url'],
                    C3: emailHeaderFooter.data['Name'],
                    C4: emailHeaderFooter.data['Footer'],
                }
                for (let i = 5; i <= 30; i++) {
                    data['C' + i] = '$C' + i;
                }
                for (let i = 50; i <= 60; i++) {
                    data['C' + i] = [];
                }

                const email_template_form = $('#email-template-form')
                let component = $(email_template_form).find('#file-path-txt').val().replace('/', '.')
                component = `msg.dabory.pro.ko_KR.email.${component}`
                // if ($(email_template_form).find('#theme-txt').val()) {
                //     component = 'views.' + component
                // }

                const response = await call_local_api('/dabory-app/test-send-mail',  {
                    "Component": component,
                    "Data": data,
                    "ToMail": $('#modal-email-test').find('#test-to-email-txt').val(),
                    "Subject": $(email_template_form).find('#subject-txt').val() + ' TEST'
                })

                if (response.data.error) {
                    iziToast.error({
                        title: 'Error', message: response.data.message,
                    });
                } else {
                    $('#modal-email-test').modal('hide')
                    iziToast.success({
                        title: 'Success', message: $('#action-completed').text(),
                    });
                }
            }

            PopupSetupFormAEmailTemplateForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#email-template-form #frm');
            }

            PopupSetupFormAEmailTemplateForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAEmailTemplateForm.parameter);

                Atype.btn_act_save('#email-template-form #frm', function () {
                    call_local_api('/put-msg-template',  PopupSetupFormAEmailTemplateForm.setup_json_data())

                    $('#modal-select-popup.show').trigger('list.requery')
                }, 'PopupSetupFormAEmailTemplateForm');
            }

            PopupSetupFormAEmailTemplateForm.setup_json_data = function () {
                const email_template_form = $('#email-template-form')

                return {
                    FilePath: $(email_template_form).find('#file-path-txt').val(),
                    // Theme: $(email_template_form).find('#theme-txt').val(),
                    Subject: $(email_template_form).find('#subject-txt').val(),
                    Message: $(email_template_form).find('#message-textarea').val(),
                }
            }

            PopupSetupFormAEmailTemplateForm.parameter = function () {
                let id = Number($('#email-template-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(PopupSetupFormAEmailTemplateForm.setup_json_data()),
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

            PopupSetupFormAEmailTemplateForm.btn_act_new = function () {
                Atype.btn_act_new('#email-template-form #frm');
                $('#popup-setup-form-a-email-template-form #email-template-form button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#popup-setup-form-a-email-template-form #modal-email-test button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                // $('#froala-editor').data('target-id', '#email-template-form')

                const email_template_form = $('#email-template-form')
                const textarea = $(email_template_form).find('#message-textarea')
                const codeView = $(email_template_form).find('#message-code-view')
                textarea.show();
                codeView.hide();
            }

            PopupSetupFormAEmailTemplateForm.show_popup_callback = function (id, setup) {
                PopupSetupFormAEmailTemplateForm.btn_act_new()

                $('#email-template-form').find('#Id').val(id)

                PopupSetupFormAEmailTemplateForm.set_email_templatet_ui(setup)
            }

            PopupSetupFormAEmailTemplateForm.toggle_code_view = function () {
                const email_template_form = $('#email-template-form')
                const textarea = $(email_template_form).find('#message-textarea')
                const codeView = $(email_template_form).find('#message-code-view')

                if (textarea.is(':hidden')) {
                    textarea.show();
                    codeView.hide();
                } else {
                    textarea.hide();
                    codeView.show().html(textarea.val());
                }
            }

            PopupSetupFormAEmailTemplateForm.set_email_templatet_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const email_template_form = $('#email-template-form')

                $(email_template_form).find('#file-path-txt').val(setup['FilePath'])
                // $(email_template_form).find('#theme-txt').val(setup['Theme'])
                $(email_template_form).find('#subject-txt').val(setup['Subject'])
                $(email_template_form).find('#message-textarea').val(setup['Message'])

                // if ($(email_template_form).find('#froala-editor .fr-view').length === 0) {
                //     init_froala_editor('#email-template-form #froala-editor', setup['Message'])
                // } else {
                //     $(email_template_form).find('.fr-view').html(setup['Message'])
                // }
            }

        }( window.PopupSetupFormAEmailTemplateForm = window.PopupSetupFormAEmailTemplateForm || {}, jQuery ));
    </script>
@endonce
