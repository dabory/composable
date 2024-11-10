<div id="popup-setup-form-a-sso-client-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary sso-client-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="sso-client-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ClientId'] }}</label>
                                <input type="text" id="client-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ClientSecret'] }}</label>
                                <input type="text" id="client-secret-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsAppleLogin'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-apple-login-check" onchange="PopupSetupFormASsoClientForm.change_apple_login_checked(this)">
                                <label class="mb-0" for="is-apple-login-check">{{ $formA['FormVars']['Title']['IsAppleLogin'] }}</label>
                            </div>
                            <div class="flex-column mb-2" id="team-id-div" style="display: none;">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TeamId'] }}</label>
                                <input type="text" id="team-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="flex-column mb-2" id="key-id-div" style="display: none;">
                                <label class="m-0">{{ $formA['FormVars']['Title']['KeyId'] }}</label>
                                <input type="text" id="key-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="flex-column mb-2" id="private-key-div" style="display: none;">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PrivateKey'] }}</label>
                                <textarea class="rounded w-100" id="private-key-txt" cols="30" rows="10"></textarea>
{{--                                <input type="text" id="private-key-txt" class="rounded w-100" autocomplete="off">--}}
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['LoginButtonString'] }}</label>
                                <input type="text" id="login-button-string-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterMemberLoginUri'] }}</label>
                                <input type="text" id="after-member-login-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AfterUsersLoginUri'] }}</label>
                                <input type="text" id="after-users-login-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsLocalSsoServer'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-local-sso-server-check"> <label class="mb-0" for="is-local-sso-server-check">{{ $formA['FormVars']['Title']['IsLocalSsoServer'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AuthorizeUri'] }}</label>
                                <input type="text" id="authorize-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TokenUri'] }}</label>
                                <input type="text" id="token-uri-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserInfoUri'] }}</label>
                                <input type="text" id="user-info-uri-txt" class="rounded w-100" autocomplete="off">
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
            $('.sso-client-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormASsoClientForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormASsoClientForm, $, undefined ) {
            PopupSetupFormASsoClientForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormASsoClientForm.change_apple_login_checked = function ($this) {
                const sso_client_form = $('#sso-client-form')

                if ($($this).is(':checked')) {
                    $(sso_client_form).find('#team-id-div').show()
                    $(sso_client_form).find('#key-id-div').show()
                    $(sso_client_form).find('#private-key-div').show()
                } else {
                    $(sso_client_form).find('#team-id-div').hide()
                    $(sso_client_form).find('#key-id-div').hide()
                    $(sso_client_form).find('#private-key-div').hide()
                }
            }

            PopupSetupFormASsoClientForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormASsoClientForm.parameter);

                Atype.btn_act_save('#sso-client-form  #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormASsoClientForm');
            }

            PopupSetupFormASsoClientForm.parameter = function () {
                const sso_client_form = $('#sso-client-form')

                const setup = {
                    ClientId: $(sso_client_form).find('#client-id-txt').val(),
                    ClientSecret: $(sso_client_form).find('#client-secret-txt').val(),

                    IsAppleLogin: $(sso_client_form).find('#is-apple-login-check').is(':checked'),
                    TeamId: $(sso_client_form).find('#team-id-txt').val(),
                    KeyId: $(sso_client_form).find('#key-id-txt').val(),
                    PrivateKey: $(sso_client_form).find('#private-key-txt').val(),

                    LoginButtonString: $(sso_client_form).find('#login-button-string-txt').val(),

                    AuthorizeUri: $(sso_client_form).find('#authorize-uri-txt').val(),
                    TokenUri: $(sso_client_form).find('#token-uri-txt').val(),
                    UserInfoUri: $(sso_client_form).find('#user-info-uri-txt').val(),

                    AfterMemberLoginUri: $(sso_client_form).find('#after-member-login-uri-txt').val(),
                    AfterUsersLoginUri: $(sso_client_form).find('#after-users-login-uri-txt').val(),
                    IsLocalSsoServer: $(sso_client_form).find('#is-local-sso-server-check').is(':checked'),
                }
                const id = Number($(sso_client_form).find('#Id').val());
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

            PopupSetupFormASsoClientForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-sso-client-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#sso-client-form #frm');
                $('#sso-client-form').find('#Id').val(id)
                PopupSetupFormASsoClientForm.set_sso_client_ui(setup)
            }

            PopupSetupFormASsoClientForm.set_sso_client_ui = function (sso_client) {
                if (_.isEmpty(sso_client)) return;

                const sso_client_form = $('#sso-client-form')

                $(sso_client_form).find('#client-id-txt').val(sso_client.ClientId)
                $(sso_client_form).find('#client-secret-txt').val(sso_client.ClientSecret)

                $(sso_client_form).find('#is-apple-login-check').prop('checked', sso_client.IsAppleLogin)
                $(sso_client_form).find('#team-id-txt').val(sso_client.TeamId)
                $(sso_client_form).find('#key-id-txt').val(sso_client.KeyId)
                $(sso_client_form).find('#private-key-txt').val(sso_client.PrivateKey)
                PopupSetupFormASsoClientForm.change_apple_login_checked($('#is-apple-login-check'))

                $(sso_client_form).find('#login-button-string-txt').val(sso_client.LoginButtonString)

                $(sso_client_form).find('#authorize-uri-txt').val(sso_client.AuthorizeUri)
                $(sso_client_form).find('#token-uri-txt').val(sso_client.TokenUri)
                $(sso_client_form).find('#user-info-uri-txt').val(sso_client.UserInfoUri)

                $(sso_client_form).find('#after-member-login-uri-txt').val(sso_client.AfterMemberLoginUri)
                $(sso_client_form).find('#after-users-login-uri-txt').val(sso_client.AfterUsersLoginUri)
                $(sso_client_form).find('#is-local-sso-server-check').prop('checked', sso_client.IsLocalSsoServer)
            }

        }( window.PopupSetupFormASsoClientForm = window.PopupSetupFormASsoClientForm || {}, jQuery ));

    </script>
@endonce
