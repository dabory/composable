<div class="card" id="client-apps-bd-form">
    <div class="card-header">
        <div class="row">
            <div class="col-md-12 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
{{--                        <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['FirstCardTitle'] }}</p>--}}
                    </div>
                    <div class="card-body" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">

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
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="redirect-uri-txt"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['RedirectURI'] }}"
                                    {{ $formA['FormVars']['Required']['RedirectURI'] }}>
                                <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#redirect-uri-txt"></i>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Ab64Desc'] ?? '' }}</label>
                            <input class="rounded w-100" type="text" id="ab64-desc-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Ab64Desc'] }}"
                                {{ $formA['FormVars']['Required']['Ab64Desc'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppBase64'] ?? '' }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <textarea class="rounded w-100 float-left" type="text" id="app-base64-txt"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['AppBase64'] }}"
                                    {{ $formA['FormVars']['Required']['AppBase64'] }}></textarea>
                                <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#app-base64-txt"></i>
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
            $(document).ready(function () {
                new Clipboard('.copy-btn').on('success', function(e) {
                    iziToast.success({ title: 'Success', message: $('#action-completed').text() })
                }).on('error', function(e) {
                    iziToast.error({ title: 'Error', message: $('#action-failed').text() })
                });

                $('.client-apps-bd-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupPopupForm1FormAClientAppBdForm.btn_act_save();
                            break;
                        case 'new':
                            PopupPopupForm1FormAClientAppBdForm.btn_act_new();
                            break;
                        case 'del':
                            PopupPopupForm1FormAClientAppBdForm.btn_act_del();
                            break;
                    }
                });

                activate_button_group()
            });

            (function (PopupPopupForm1FormAClientAppBdForm, $, undefined) {
                PopupPopupForm1FormAClientAppBdForm.formA = {!! json_encode($formA) !!}

                PopupPopupForm1FormAClientAppBdForm.btn_act_new = function () {
                    Atype.btn_act_new('#client-apps-bd-form #frm');
                }

                PopupPopupForm1FormAClientAppBdForm.show_popup_callback = async function (id, c1) {
                    PopupPopupForm1FormAClientAppBdForm.btn_act_new()
                    await fetch_client_app_bd(Number(id));
                }
            }(window.PopupPopupForm1FormAClientAppBdForm = window.PopupPopupForm1FormAClientAppBdForm || {}, jQuery));

            async function fetch_client_app_bd(id) {
                const response = await get_api_data(PopupPopupForm1FormAClientAppBdForm.formA['General']['PickApi'], {
                    Page: [{Id: id}]
                })

                set_client_app_bd_ui(response)
            }

            async function set_client_app_bd_ui(response) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    // $('#modal-').modal('hide');
                    return;
                }

                const client_app_bd = response.data.Page[0];

                const sso_app_pick = await get_api_data('sso-app-pick', {
                    Page: [{Id: client_app_bd.SsoAppId}]
                })

                const client_app = sso_app_pick.data['Page'][0]
                const client_apps_bd_form = $('#client-apps-bd-form')

                $(client_apps_bd_form).find('#Id').val(client_app_bd.Id)
                $(client_apps_bd_form).find('#app-base64-txt').val(client_app_bd.AppBase64)
                $(client_apps_bd_form).find('#ab64-desc-txt').val(client_app_bd.Ab64Desc)

                $(client_apps_bd_form).find('#app-type-select').val(client_app.AppType)
                $(client_apps_bd_form).find('#app-name-txt').val(client_app.AppName)

                const redirect_uri = client_app.RedirectUri ? new URL(client_app.RedirectUri)['origin'] + '/dabory-app' : ''
                $(client_apps_bd_form).find('#redirect-uri-txt').val(redirect_uri)
            }
        </script>
    @endpush
@endonce
