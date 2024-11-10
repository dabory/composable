<div id="popup-setup-form-a-general-info-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary general-info-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="general-info-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ErpParaCustomTheme'] }}</label>
                                <input type="text" class="rounded w-100" id="erp-para-custom-theme-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ErpThemes'] }}</label>
                                <input type="text" class="rounded w-100" id="erp-theme-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ProTheme'] }}</label>
                                <select class="rounded w-100" id="pro-theme-select">
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['LocaleSequence'] }}</label>
                                <input type="text" class="rounded w-100" id="locale-sequence-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AppName'] }}</label>
                                <input type="text" class="rounded w-100" id="app-name-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AppEnv'] }}</label>
                                <select class="rounded w-100" id="app-env-select">
                                    <option value="local">local</option>
                                    <option value="production">production</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AppDebug'] }}</label>
                                <select class="rounded w-100" id="app-debug-select">
                                    <option value="true">true</option>
                                    <option value="false">false</option>
                                </select>
                            </div>

                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AppUrl'] }}</label>
                                <input type="text" class="rounded w-100" id="app-url-txt">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2 text-center">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailMailer'] }}</label>
                                <select class="rounded w-100" id="mail-mailer-select">
                                    <option value="smtp">smtp</option>
                                    <option value="mailgun">mailgun</option>
                                    <option value="postmark">postmark</option>
                                    <option value="ses">ses</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailHost'] }}</label>
                                <input type="text" class="rounded w-100" id="mail-host-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailPort'] }}</label>
                                <input type="text" class="rounded w-100" id="mail-port-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailUserName'] }}</label>
                                <input type="text" class="rounded w-100" id="mail-user-name-txt">
                            </div><div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailPassword'] }}</label>
                                <input type="text" class="rounded w-100" id="mail-password-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailEncryption'] }}</label>
                                <select class="rounded w-100" id="mail-encryption-select">
                                    <option value="ssl">ssl</option>
                                    <option value="tls">tls</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MailFromAddress'] }}</label>
                                <input type="text" class="rounded w-100" id="mail-from-address-txt">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2 text-center">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['CdnType'] }}</label>
                                <select class="rounded w-100" id="cdn-type-select">
                                    <option value="local">local</option>
                                    <option value="aws-s3">aws-s3</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MediaUrl'] }}</label>
                                <input type="text" class="rounded w-100" id="media-url-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FaviconPath'] }}</label>
                                <div class="d-flex">
                                    <input type="text" class="rounded w-100 radius-r0" id="favicon-path-txt">
                                    <button class="text-white rounded border-0 radius-l0 col-3" onclick="show_media_modal()">찾기</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TagLine'] }}</label>
                                <input type="text" class="rounded w-100" id="tag-line-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AppMobileNo'] }}</label>
                                <input type="text" class="rounded w-100" id="app-mobile-no-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['IsSkipUpdate'] }}</label>
                                <select class="rounded w-100" id="is-skip-update-select">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="9">9</option>
                                </select>
{{--                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-skip-update-check"> <label class="mb-0" for="is-skip-update-check">{{ $formA['FormVars']['Title']['IsSkipUpdate'] }}</label>--}}
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsOnMemberSignup'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-on-member-signup-check"> <label class="mb-0" for="is-on-member-signup-check">{{ $formA['FormVars']['Title']['IsOnMemberSignup'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@once
    <script>
        $(document).ready(async function() {
            $(document).on('file.paste', '#modal-media', function (event, file_url_list) {
                $('#general-info-form').find('#favicon-path-txt').val(file_url_list[0])
            });

            $('.general-info-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAGeneralInfoForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAGeneralInfoForm, $, undefined ) {
            PopupSetupFormAGeneralInfoForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAGeneralInfoForm.btn_act_save =  function () {
                Atype.set_parameter_callback(PopupSetupFormAGeneralInfoForm.parameter);
                Atype.btn_act_save('#general-info-form  #frm', async function () {
                    axios.post('/set-general-info', PopupSetupFormAGeneralInfoForm.setup_json_parameter());
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAGeneralInfoForm');
            }

            PopupSetupFormAGeneralInfoForm.setup_json_parameter = function () {
                const general_info_form = $('#general-info-form')

                return {
                    ErpParaCustomTheme: $(general_info_form).find('#erp-para-custom-theme-txt').val(),
                    ErpThemes: $(general_info_form).find('#erp-theme-txt').val(),
                    ProTheme: $(general_info_form).find('#pro-theme-select').val(),
                    LocaleSequence: $(general_info_form).find('#locale-sequence-txt').val(),
                    AppName: $(general_info_form).find('#app-name-txt').val(),
                    AppEnv: $(general_info_form).find('#app-env-select').val(),
                    AppDebug: $(general_info_form).find('#app-debug-select').val(),
                    AppUrl: $(general_info_form).find('#app-url-txt').val(),

                    MailMailer: $(general_info_form).find('#mail-mailer-select').val(),
                    MailHost: $(general_info_form).find('#mail-host-txt').val(),
                    MailPort: $(general_info_form).find('#mail-port-txt').val(),
                    MailUserName: $(general_info_form).find('#mail-user-name-txt').val(),
                    MailPassword: $(general_info_form).find('#mail-password-txt').val(),
                    MailEncryption: $(general_info_form).find('#mail-encryption-select').val(),
                    MailFromAddress: $(general_info_form).find('#mail-from-address-txt').val(),

                    CdnType: $(general_info_form).find('#cdn-type-select').val(),
                    MediaUrl: $(general_info_form).find('#media-url-txt').val(),
                    FaviconPath: $(general_info_form).find('#favicon-path-txt').val(),
                    TagLine: $(general_info_form).find('#tag-line-txt').val(),
                    AppMobileNo: $(general_info_form).find('#app-mobile-no-txt').val(),
                    // IsSkipUpdate: $(general_info_form).find('#is-skip-update-check').is(':checked'),
                    IsSkipUpdate: $(general_info_form).find('#is-skip-update-select').val(),
                    IsOnMemberSignup: $(general_info_form).find('#is-on-member-signup-check').is(':checked'),
                }
            }

            PopupSetupFormAGeneralInfoForm.parameter = function () {
                let setup = PopupSetupFormAGeneralInfoForm.setup_json_parameter()
                let id = Number($('#general-info-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(setup),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                // console.log(parameter)
                return parameter;
            }

            PopupSetupFormAGeneralInfoForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-general-info-form .modal-dialog').css('maxWidth', '900px');
                Atype.btn_act_new('#general-info-form #frm');
                $('#general-info-form').find('#Id').val(id)
                const response = await axios.post('/pro-skin-directories', {});
                const html = response.data.reduce(function (accumulator, item) {
                    return accumulator + `<option value="${item}">${item}</option>`;
                }, '');
                $('#general-info-form').find('#pro-theme-select').html(html)
                PopupSetupFormAGeneralInfoForm.set_ui(setup)
            }

            PopupSetupFormAGeneralInfoForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const general_info_form = $('#general-info-form')
                $(general_info_form).find('#erp-para-custom-theme-txt').val(setup['ErpParaCustomTheme'])
                $(general_info_form).find('#erp-theme-txt').val(setup['ErpThemes'])
                $(general_info_form).find('#pro-theme-select').val(setup['ProTheme'])
                $(general_info_form).find('#locale-sequence-txt').val(setup['LocaleSequence'])
                $(general_info_form).find('#app-name-txt').val(setup['AppName'])
                $(general_info_form).find('#app-env-select').val(setup['AppEnv'])
                $(general_info_form).find('#app-debug-select').val(setup['AppDebug'])
                $(general_info_form).find('#app-url-txt').val(setup['AppUrl'])

                $(general_info_form).find('#mail-mailer-select').val(setup['MailMailer'])
                $(general_info_form).find('#mail-host-txt').val(setup['MailHost'])
                $(general_info_form).find('#mail-port-txt').val(setup['MailPort'])
                $(general_info_form).find('#mail-user-name-txt').val(setup['MailUserName'])
                $(general_info_form).find('#mail-password-txt').val(setup['MailPassword'])
                $(general_info_form).find('#mail-encryption-select').val(setup['MailEncryption'])
                $(general_info_form).find('#mail-from-address-txt').val(setup['MailFromAddress'])

                $(general_info_form).find('#cdn-type-select').val(setup['CdnType'])
                $(general_info_form).find('#media-url-txt').val(setup['MediaUrl'])
                $(general_info_form).find('#favicon-path-txt').val(setup['FaviconPath'])
                $(general_info_form).find('#tag-line-txt').val(setup['TagLine'])
                $(general_info_form).find('#app-mobile-no-txt').val(setup['AppMobileNo'])
                // $(general_info_form).find('#is-skip-update-check').prop('checked', setup.IsSkipUpdate)
                $(general_info_form).find('#is-skip-update-select').val(setup.IsSkipUpdate)
                $(general_info_form).find('#is-on-member-signup-check').prop('checked', setup.IsOnMemberSignup)
            }

        }( window.PopupSetupFormAGeneralInfoForm = window.PopupSetupFormAGeneralInfoForm || {}, jQuery ));

    </script>
@endonce
