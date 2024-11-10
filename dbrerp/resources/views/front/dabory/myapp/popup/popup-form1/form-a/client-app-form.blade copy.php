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
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-0">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">

                        <div class="d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppType'] ?? '' }}</label>
                            <select class="rounded w-100" id="app-type-select" required>
                                @foreach($formA['SelectOptions'] as $appType)
                                    <option value="{{ $appType['Value'] }}"> {{ $appType['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['ClientId'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="client-id-txt" disabled>
                                <i class="icon-copy3 float-left ml-1" id="clientIdCp" style="cursor: pointer"></i>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['RedirectURI'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="redirect-uri-txt">
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppName'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="app-name-txt">
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['ClientSecret'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="client-secret-txt" disabled>
                                <i class="icon-copy3 float-left ml-1" id="clientSecretCp" style="cursor: pointer"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-0">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <div>
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-dabory-app-check">
                                <label class="mb-0" for="is-dabory-app-check">{{ $formA['FormVars']['Title']['UseDaboryApp'] }}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <a class="btn btn-light" id="generate-key-btn">{{ $formA['FormVars']['Title']['GenerateKeys'] ?? '' }}</a>
                        </div>
                        <div class="d-flex flex-column">
                            <label>{{ $formA['FormVars']['Title']['PublicKey'] ?? '' }}</label>
                            <div class="d-flex align-items-center">
                                <input class="rounded w-100 float-left" type="text" id="public-key-txt" disabled>
                                <input class="rounded w-100 float-left" type="hidden" id="keypair-txt">
                                <i class="icon-copy3 float-left ml-1" id="keysCp" style="cursor: pointer"></i>
                                <i class="icon-loop float-left ml-2" id="reGenerateKey" style="cursor: pointer"></i>
                            </div>
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
            $(document).ready(async function () {
                $('.client-apps-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupForm1FormAClientAppForm.btn_act_save();
                            break;
                        case 'new':
                            Atype.btn_act_new('#client-apps-form #frm');
                            break;
                        case 'del':
                            PopupForm1FormAClientAppForm.btn_act_del();
                            break;
                    }
                });

                Atype.set_parameter_callback(client_apps_parameter);

                activate_button_group()


                $("#clientIdCp").click(function (e) {
                    copyToClipboard("client-id-txt")
                    e.preventDefault()
                });

                $("#clientSecretCp").click(function (e) {
                    copyToClipboard("client-secret-txt")
                    e.preventDefault()
                });

                $("#keysCp").click(function (e) {
                    copyToClipboard("public-key-txt")
                    e.preventDefault()
                });

                $('#generate-key-btn, #reGenerateKey').click(function (e) {
                    generatePublicKey();
                    e.preventDefault();
                })
            });

            (function (PopupForm1FormAClientAppForm, $, undefined) {
                const allCharacters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$';
                const noSpecialCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const numbers = '0123456789';

                PopupForm1FormAClientAppForm.btn_act_save = function () {
                    Atype.btn_act_save('#client-apps-form #frm', function () {
                        $('#modal-select-popup').modal('hide');
                    });
                }

                PopupForm1FormAClientAppForm.btn_act_del = function () {
                    Atype.btn_act_del('#client-apps-form #frm', function () {
                        $('#modal-select-popup').modal('hide');
                    });
                }

                PopupForm1FormAClientAppForm.btn_act_new_callback = function () {
                    Atype.btn_act_new('#client-apps-form #frm');
                    const clientID = makeRandom(32, allCharacters);
                    const secretKey = makeRandom(32, allCharacters);
                    $('#client-apps-form').find('#client-id-txt').val(clientID);
                    $('#client-apps-form').find('#client-secret-txt').val(secretKey);
                }

                PopupForm1FormAClientAppForm.show_popup_callback = async function (id, c1) {
                    await fetch_client_app(Number(id));
                }
            }(window.PopupForm1FormAClientAppForm = window.PopupForm1FormAClientAppForm || {}, jQuery));

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
                        iziToast.success({
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
                const isDaboryApp = Number($('#client-apps-form').find('#is-dabory-app-check:checked').val()) ?? 0;
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    AppType: $('#client-apps-form').find('#app-type-select').val(),
                    AppName: $('#client-apps-form').find('#app-name-txt').val(),
                    ClientId: $('#client-apps-form').find('#client-id-txt').val(),
                    ClientSecret: $('#client-apps-form').find('#client-secret-txt').val(),
                    RedirectURI: $('#client-apps-form').find('#redirect-uri-txt').val(),
                    IsDaboryApp: isDaboryApp,
                    MemberId: window.Member['MemberId'],
                    PublicKey: isDaboryApp == 1 ? $('#client-apps-form').find('#public-key-txt').val() : '',
                    DbrKeyPair: isDaboryApp == 1 ? $('#client-apps-form').find('#keypair-txt').val() : '',
                }
                if (id < 0) {
                    parameter = {Id: id}
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                // console.log(parameter)
                return parameter;
            }

            async function generatePublicKey() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/generate-keys",
                    type:'GET',
                    success: function(keys) {
                        $('#public-key-txt').val(keys[0]);
                        $('#keypair-txt').val(keys[1]);
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
                // console.log(client_app)

                $('#client-apps-form').find("#Id").val(client_app.Id)
                $('#client-apps-form').find('#app-type-select').val(client_app.AppType)
                $('#client-apps-form').find('#app-name-txt').val(client_app.AppName)
                $('#client-apps-form').find('#client-id-txt').val(client_app.ClientId)
                $('#client-apps-form').find('#client-secret-txt').val(client_app.ClientSecret)
                $('#client-apps-form').find('#redirect-uri-txt').val(client_app.RedirectUri)
                $('#client-apps-form').find('#is-dabory-app-check').prop('checked', client_app.IsDaboryApp == '1')
                $('#client-apps-form').find('#public-key-txt').val(client_app.PublicKey)
                $('#client-apps-form').find('#keypair-txt').val(client_app.DbrKeyPair)
            }

            var formA = {!! json_encode($formA) !!};
        </script>
    @endpush
@endonce
