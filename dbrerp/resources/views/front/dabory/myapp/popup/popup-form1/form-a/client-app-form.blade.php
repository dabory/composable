<div class="mb-1 text-right btn-groups">
    <button type="button" {{ count($formA['SelectButtonOptions']) <= 3 ? 'hidden' : '' }}
    class="btn btn-success btn-open-modal"
            data-target=""
            data-clicked=""
            data-variable="">
        <i class="icon-folder-open"></i>
    </button>
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary client-apps-act save-button"
                data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'client-apps-act',
        ])
    </div>
</div>
<div class="card" id="client-apps-form">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                        <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['FirstCardTitle'] }}</p>
                    </div>
                    <div class="card-body" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="auto-slip-no">
                        <input type="hidden" id="sso-app-date">

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppType'] ?? '' }}</label>
                            <select class="rounded w-100" id="app-type-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['AppType'] }}"
                                {{ $formA['FormVars']['Required']['AppType'] }}>
                                @foreach($formA['SelectOptions'] as $appType)
                                    <option value="{{ $appType['Value'] }}"> {{ $appType['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppName'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="app-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['AppName'] }}"
                                {{ $formA['FormVars']['Required']['AppName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['RedirectURI'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="redirect-uri-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['RedirectURI'] }}"
                                {{ $formA['FormVars']['Required']['RedirectURI'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['ClientId'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="client-id-txt" readonly
                                       maxlength="{{ $formA['FormVars']['MaxLength']['ClientId'] }}"
                                    {{ $formA['FormVars']['Required']['ClientId'] }}>
                                <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#client-id-txt"></i>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['ClientSecret'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="client-secret-txt" readonly
                                       maxlength="{{ $formA['FormVars']['MaxLength']['ClientSecret'] }}"
                                    {{ $formA['FormVars']['Required']['ClientSecret'] }}>
                                <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#client-secret-txt"></i>
                            </div>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <div class="d-flex">
                                <button type="button" class="btn btn-sm btn-danger col-6 mr-1" id="generate-key-btn">
                                    {{ $formA['FormVars']['Title']['GenerateKeys'] ?? '' }}
                                </button>
                                <button type="button" class="btn btn-sm col-6" style="color: white !important;" id="extract-key-btn" onclick="extractPublicKey()">
                                    {{ $formA['FormVars']['Title']['ExtractKeys'] ?? '' }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['PublicKey'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100 float-left" type="text" id="public-key-txt" readonly
                                       maxlength="{{ $formA['FormVars']['MaxLength']['PublicKey'] }}"
                                    {{ $formA['FormVars']['Required']['PublicKey'] }}>
                                <input class="rounded w-100 float-left" type="hidden" id="keypair-txt">
                                <div class="position-absolute input-icon">
                                    <i class="copy-btn icon-copy3" data-clipboard-target="#public-key-txt"></i>
                                    <i class="icon-loop" id="reGenerateKey" style="cursor: pointer; margin-left: 0.1725rem"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Keypair'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100 float-left" type="password" id="keypair-view-txt" readonly
                                       maxlength="{{ $formA['FormVars']['MaxLength']['Keypair'] }}"
                                    {{ $formA['FormVars']['Required']['Keypair'] }}>
                                <div class="position-absolute input-icon">
                                    <i class="copy-btn icon-copy3" data-clipboard-target="#keypair-view-txt"></i>
                                    <i class="fas fa-eye fa-lg" id="keypair-view-btn" style="cursor: pointer; margin-left: 0.1725rem;"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                        <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['SecondCardTitle'] }}</p>
                    </div>
                    <div class="card-body" id="create-bb64-frm">
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['ApiHost'] ?? '' }}</label>
                            <select class="rounded w-100" id="api-host-select" onchange="PopupPopupForm1FormAClientAppForm.change_db_host_select(this)"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['ApiHost'] }}"
                                {{ $formA['FormVars']['Required']['ApiHost'] }}>
                                <option value="direct">=직접지정=</option>
                                <option value="http://13.124.2.254:18080">http://13.124.2.254:18080(개발서버)</option>
                                <option value="http://localhost:18080">http://localhost:18080(로컬서버)</option>
                                <option value="http://host.docker.internal:18080">http://host.docker.internal:18080(도커서버)</option>
                            </select>
                            <input type="text" id="api-host-txt" class="w-100 mt-2" required>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DbHost'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="db-host-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbHost'] }}"
                                {{ $formA['FormVars']['Required']['DbHost'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DbUser'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="db-user-txt"
                                   onfocusout="PopupPopupForm1FormAClientAppForm.db_user_focusout(event)"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbUser'] }}"
                                {{ $formA['FormVars']['Required']['DbUser'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DbName'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="db-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbName'] }}"
                                {{ $formA['FormVars']['Required']['DbName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['DbPassword'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="db-password-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DbPassword'] }}"
                                {{ $formA['FormVars']['Required']['DbPassword'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Prefix'] ?? '' }}</label>
                            <select class="rounded w-100" id="prefix-select"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Prefix'] }}"
                                {{ $formA['FormVars']['Required']['Prefix'] }}>
                                <option value="MAIN_API">MAIN_API</option>
                                <option value="SUB_FIRST_API">SUB_FIRST_API</option>
                                <option value="SUB_SECOND_API">SUB_SECOND_API</option>
                                <option value="SUB_THIRD_API">SUB_THIRD_API</option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <button type="button" class="btn btn-sm btn-primary" id="create-before-base64-key-btn"
                            onclick="PopupPopupForm1FormAClientAppForm.create_before_base64_key()">
                                {{ $formA['FormVars']['Title']['CreateBeforeBase64Key'] ?? '' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(function () {
                new Clipboard('.copy-btn').on('success', function(e) {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                }).on('error', function(e) {
                    iziToast.error({ title: 'Error', message: $('#action-failed').text() })
                });

                $('.client-apps-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupPopupForm1FormAClientAppForm.btn_act_save();
                            break;
                        case 'new':
                            PopupPopupForm1FormAClientAppForm.btn_act_new();
                            break;
                        case 'del':
                            PopupPopupForm1FormAClientAppForm.btn_act_del();
                            break;
                    }
                });

                Atype.set_parameter_callback(client_apps_parameter);

                activate_button_group()

                $('#generate-key-btn, #reGenerateKey').click(function (e) {
                    generatePublicKeyBtn()
                })

                $('#client-apps-form').find('#keypair-view-btn').on('click',function(){
                    const keypair_view_txt = $('#client-apps-form').find('#keypair-view-txt')
                    $(keypair_view_txt).toggleClass('active')
                    if($(keypair_view_txt).hasClass('active')) {
                        $(this).attr('class',"fa fa-eye-slash fa-lg")
                        $(keypair_view_txt).attr('type', 'text')
                    } else {
                        $(this).attr('class',"fa fa-eye fa-lg")
                        $(keypair_view_txt).attr('type', 'password')
                    }
                });
            });

            (function (PopupPopupForm1FormAClientAppForm, $, undefined) {
                const allCharacters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$';
                const noSpecialCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const numbers = '0123456789';


                PopupPopupForm1FormAClientAppForm.db_user_focusout = function (event) {
                    $('#client-apps-form').find('#db-name-txt').val($(event.target).val())
                }

                PopupPopupForm1FormAClientAppForm.change_db_host_select = function ($this) {
                    $('#client-apps-form').find('#api-host-txt').prop('hidden', $($this).val() !== 'direct')
                    $('#client-apps-form').find('#api-host-txt').attr('required', $($this).val() === 'direct')

                    if ($($this).val() === 'direct') {
                        $('#client-apps-form').find('#api-host-txt').val('')
                    } else {
                        $('#client-apps-form').find('#api-host-txt').val($($this).val())
                    }
                }

                PopupPopupForm1FormAClientAppForm.create_before_base64_key = function () {
                    if (isEmpty($('#client-apps-form').find('#public-key-txt').val())) {
                        iziToast.warning({ title: 'Warning', message: 'Public key is empty' });
                        return;
                    }

                    if (window.dom_required_check('#create-bb64-frm input')) {
                        iziToast.warning({ title: 'Warning', message: $('#required-item-omitted').text() });
                        return;
                    }

                    const [host, port] = $('#client-apps-form').find('#db-host-txt').val().split(':');

                    PopupPopupForm1FormAClientAppForm.post_crypto_sodium({
                        Driver: 'mysql',
                        Host: host,
                        Port: Number(port),
                        Username: $('#client-apps-form').find('#db-user-txt').val(),
                        Database: $('#client-apps-form').find('#db-name-txt').val(),
                        Password: $('#client-apps-form').find('#db-password-txt').val(),
                    }, $('#client-apps-form').find('#public-key-txt').val(), true, function (before_base64) {
                        PopupPopupForm1FormAClientAppForm.download_env_dabory(before_base64)
                    })
                }

                // PopupPopupForm1FormAClientAppForm.generate_app_base64_key = function () {
                //     if (isEmpty($('#client-apps-form').find('#public-key-txt').val())) {
                //         iziToast.warning({ title: 'Warning', message: 'Public key is empty' });
                //         return;
                //     }
                //
                //     PopupPopupForm1FormAClientAppForm.post_crypto_sodium($('#client-apps-form').find('#client-id-txt').val(),
                //         $('#client-apps-form').find('#public-key-txt').val(), false, function (before_base64) {
                //         $('#client-apps-form').find('#app-base64-txt').val(before_base64)
                //     })
                // }

                PopupPopupForm1FormAClientAppForm.post_crypto_sodium = function (decrypted, public_key, json_encode, callback) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/crypto/sodium',
                        type: 'POST',
                        data: JSON.stringify({
                            decrypted: decrypted,
                            public_key: public_key,
                            json_encode: json_encode,
                        }),
                        success: function(before_base64) {
                            // console.log(before_base64)
                            callback(before_base64)
                        }
                    });
                }

                PopupPopupForm1FormAClientAppForm.download_env_dabory = function (before_base64) {
                    const $client_apps_form = $('#client-apps-form')
                    const api_host = $($client_apps_form).find('#api-host-txt').val()

                    const env = {
                        api_url: api_host,
                        client_id: $($client_apps_form).find('#client-id-txt').val(),
                        client_secret: $($client_apps_form).find('#client-secret-txt').val(),
                        before_base64: before_base64,
                    }

                    const form = $('<form>', {'method': 'POST', 'action': '/download/env-dabory'}).hide();
                    const csrfVar = $('meta[name="csrf-token"]').attr('content');
                    form.append($('<input>', {'type': 'hidden', 'name': '_token', 'value': csrfVar}));
                    form.append($('<input>', {'type': 'hidden', 'name': 'env', 'value': JSON.stringify(env)}));
                    form.append($('<input>', {'type': 'hidden', 'name': 'prefix', 'value': $($client_apps_form).find('#prefix-select').val()}));
                    form.append($('<input>', {'type': 'hidden', 'name': 'app_name', 'value': $($client_apps_form).find('#app-name-txt').val()}));
                    $('#client-apps-form').append(form);
                    form.submit();
                    form.remove();
                }

                PopupPopupForm1FormAClientAppForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-popup-form1-form-a-client-app-form .modal-dialog').css('maxWidth', '1400px');
                    $('#modal-select-popup.popup-popup-form1-form-a-client-app-form #generate-key-btn').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    Atype.btn_act_new('#client-apps-form #frm');
                    Atype.btn_act_new('#client-apps-form #create-bb64-frm');

                    $('#client-apps-form').find('#keypair-view-txt').removeClass('active')
                    $('#client-apps-form').find('#keypair-view-txt').attr('type', 'password')
                    $('#client-apps-form').find('#keypair-view-btn').attr('class',"fa fa-eye fa-lg")

                    $("#client-apps-form #db-host-select option:eq(0)").prop("selected", true)
                    $('#client-apps-form').find('#api-host-select').trigger('change')
                }

                PopupPopupForm1FormAClientAppForm.btn_act_save = function () {
                    const redirect_uri = $('#client-apps-form').find('#redirect-uri-txt').val()

                    if (! isEmpty(redirect_uri)) {
                        const redirect_uri_split = redirect_uri.split('://')
                        if (isEmpty(redirect_uri_split[1])) {
                            iziToast.error({ title: 'Error', message: 'Redirect Uri의 올바른 형식이 아닙니다 예: https://example.com, http://localhost' })
                            return
                        }

                        const is_secure = redirect_uri_split[0] === 'https'
                        const page_uri = redirect_uri_split[1].split('/')[0]
                        const is_localhost = ['localhost', '127.0.0.1'].some(str => page_uri.includes(str))

                        if (! is_localhost && !is_secure) {
                            iziToast.error({ title: 'Error', message: 'Redirect Uri은 Https만 허용합니다' })
                            return
                        }
                    }

                    Atype.btn_act_save('#client-apps-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    });
                }

                PopupPopupForm1FormAClientAppForm.btn_act_del = function () {
                    Atype.btn_act_del('#client-apps-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    });
                }

                PopupPopupForm1FormAClientAppForm.btn_act_new_callback = async function () {
                    PopupPopupForm1FormAClientAppForm.btn_act_new()
                    const clientID = makeRandom(18, allCharacters);
                    const secretKey = makeRandom(18, allCharacters);
                    $('#client-apps-form').find('#client-id-txt').val(clientID);
                    $('#client-apps-form').find('#client-secret-txt').val(secretKey);

                    PopupPopupForm1FormAClientAppForm.get_last_slip_no()
                }

                PopupPopupForm1FormAClientAppForm.get_last_slip_no = async function () {
                    const response = await get_api_data('last-slip-no-get', {
                        TableName: 'sso-app',
                        YYMMDD: moment(new Date()).format('YYMMDD'),
                    })

                    $('#client-apps-form').find('#auto-slip-no').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
                    $('#client-apps-form').find('#sso-app-date').val(moment(new Date()).format('YYYYMMDD'))
                }

                PopupPopupForm1FormAClientAppForm.show_popup_callback = async function (id, c1) {
                    PopupPopupForm1FormAClientAppForm.btn_act_new()
                    await fetch_client_app(Number(id));

                    if (! isEmpty($('#client-apps-form').find('#keypair-txt').val())) {
                        extractPublicKey()
                    }
                }
            }(window.PopupPopupForm1FormAClientAppForm = window.PopupPopupForm1FormAClientAppForm || {}, jQuery));

            function makeRandom(length, characters) {
                let result = '';
                const charactersLength = characters.length;
                for (let i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }

            function copyToClipboard(idInput) {
                /* Get the text field */
                const copyText = document.getElementById(idInput);
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(copyText.value).catch(err => {
                        iziToast.error({
                            title: 'Error',
                            message: 'Could not copy text',
                        });
                    });
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                } else {
                    const dummyElement = document.createElement('span');
                    dummyElement.style.whiteSpace = 'pre'
                    dummyElement.textContent = copyText.value;
                    document.body.appendChild(dummyElement)

                    const selection = window.getSelection();
                    selection.removeAllRanges()
                    const range = document.createRange()
                    range.selectNode(dummyElement)
                    selection.addRange(range)

                    document.execCommand('copy');

                    selection.removeAllRanges()
                    document.body.removeChild(dummyElement)
                }
            }

            function client_apps_parameter() {
                let id = Number($('#client-apps-form').find('#Id').val());
                // const isDaboryApp = Number($('#client-apps-form').find('#is-dabory-app-check:checked').val()) ?? 0;
                let parameter = {
                    Id: id,
                    SsoAppNo: $('#client-apps-form').find('#auto-slip-no').val(),
                    SsoAppDate: $('#client-apps-form').find('#sso-app-date').val(),

                    AppType: $('#client-apps-form').find('#app-type-select').val(),
                    AppName: $('#client-apps-form').find('#app-name-txt').val(),
                    ClientId: $('#client-apps-form').find('#client-id-txt').val(),
                    ClientSecret: $('#client-apps-form').find('#client-secret-txt').val(),
                    RedirectUri: $('#client-apps-form').find('#redirect-uri-txt').val(),
                    IsDaboryApp: 1,
                    MemberId: window.Member['MemberId'],
                    PublicKey: $('#client-apps-form').find('#public-key-txt').val(),
                    DbrKeyPair: $('#client-apps-form').find('#keypair-txt').val()
                }
                if (id < 0) {
                    parameter = {Id: id}
                }

                // console.log(parameter)
                return parameter;
            }

            function generatePublicKeyBtn() {
                if (isEmpty($('#keypair-txt').val())) {
                    return generatePublicKey()
                }

                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    title: 'Generate Keys',
                    message: 'The Old Keys will be DELETED !',
                    position: 'center',
                    buttons: [
                        [`<button><b>Confirm</b></button>`, function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                            generatePublicKey()
                        }, true],
                        [`<button>Cancel</button>`, function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });
            }

            function generatePublicKey() {
                $.ajax({
                    url: "/generate-keys",
                    type: 'GET',
                    success: function(keys) {
                        $('#public-key-txt').val(keys[0]);
                        $('#keypair-txt').val(keys[1]);
                        $('#keypair-view-txt').val(keys[1]);
                    }
                });
            }

            function extractPublicKey() {
                $.ajax({
                    url: "/extract-keys",
                    type: 'GET',
                    data: {
                        key_pair: $('#client-apps-form').find('#keypair-txt').val()
                    },
                    success: function(public_key) {
                        $('#public-key-txt').val(public_key);
                    }
                });
            }

            async function fetch_client_app(id) {
                let response = await get_api_data(formA['General']['PickApi'], {
                    Page: [{Id: id}]
                })
                set_client_app_ui(response)
            }

            function set_client_app_ui(response) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    // $('#modal-').modal('hide');
                    return;
                }

                let client_app = response.data.Page[0];

                $('#client-apps-form').find("#Id").val(client_app.Id)
                $('#client-apps-form').find('#auto-slip-no').val(client_app.SsoAppNo)
                $('#client-apps-form').find('#sso-app-date').val(client_app.SsoAppDate)

                $('#client-apps-form').find('#app-type-select').val(client_app.AppType)
                $('#client-apps-form').find('#app-name-txt').val(client_app.AppName)
                $('#client-apps-form').find('#client-id-txt').val(client_app.ClientId)
                $('#client-apps-form').find('#client-secret-txt').val(client_app.ClientSecret)
                $('#client-apps-form').find('#redirect-uri-txt').val(client_app.RedirectUri)
                // $('#client-apps-form').find('#is-dabory-app-check').prop('checked', client_app.IsDaboryApp == '1')
                $('#client-apps-form').find('#public-key-txt').val(client_app.PublicKey)
                $('#client-apps-form').find('#keypair-txt').val(client_app.DbrKeyPair)
                $('#client-apps-form').find('#keypair-view-txt').val('')

            }

            var formA = {!! json_encode($formA) !!};
        </script>
    @endpush
@endonce
