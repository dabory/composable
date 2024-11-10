<div class="mb-1 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary api23-app-act save-button"
                data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'api23-app-act',
        ])
    </div>
</div>
<div class="card" id="api23-app-form">
    <div class="card-header">
        <div class="row">
            <div class="col card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                        <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['FirstCardTitle'] }}</p>
                    </div>
                    <div class="card-body" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <input type="hidden" id="auto-slip-no">
                        <input type="hidden" id="app-date">

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['AppType'] ?? '' }}</label>
                            <select class="rounded w-100" id="app-type-select"
                                {{ $formA['FormVars']['Required']['AppType'] }}>
                                @foreach($formA['SelectOptions'] as $appType)
                                    <option value="{{ $appType['Value'] }}"> {{ $appType['Caption'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select class="rounded w-100" type="text" id="sort-select">
                                @forelse ($codeTitle['sort']['api23-app'] ?? [] as $key => $status)
                                    <option value="{{ $status['Code'] }}">
                                        {{ $status['Title'] }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['OriginUrl'] }}</label>
                            <input class="rounded w-100" type="text" id="origin-url-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['OriginUrl'] }}"
                                {{ $formA['FormVars']['Required']['OriginUrl'] }}>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <button type="button" class="btn btn-sm btn-danger col" id="generate-key-btn"
                                onclick="PopupPopupForm1FormAApi23AppForm.generate_api23_app_btn()">
                                {{ $formA['FormVars']['Title']['GenerateKeys'] }}
                            </button>
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label>{{ $formA['FormVars']['Title']['Api23Key'] }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input class="rounded w-100" type="text" id="api23-key-txt" readonly
                                       maxlength="{{ $formA['FormVars']['MaxLength']['Api23Key'] }}"
                                    {{ $formA['FormVars']['Required']['Api23Key'] }}>
                                <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#api23-key-txt"></i>
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

                $('.api23-app-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupPopupForm1FormAApi23AppForm.btn_act_save();
                            break;
                        case 'new':
                            PopupPopupForm1FormAApi23AppForm.btn_act_new();
                            break;
                        case 'del':
                            PopupPopupForm1FormAApi23AppForm.btn_act_del();
                            break;
                    }
                });

                Atype.set_parameter_callback(PopupPopupForm1FormAApi23AppForm.parameter);

                activate_button_group()
            });

            (function (PopupPopupForm1FormAApi23AppForm, $, undefined) {
                PopupPopupForm1FormAApi23AppForm.formA = {!! json_encode($formA) !!};

                PopupPopupForm1FormAApi23AppForm.generate_api23_app_btn = function () {
                    iziToast.question({
                        timeout: 20000,
                        close: false,
                        overlay: true,
                        displayMode: 'once',
                        id: 'question',
                        title: 'Generate Keys',
                        message: 'The Old Api23 Keys will be DELETED !',
                        position: 'center',
                        buttons: [
                            [`<button><b>Confirm</b></button>`, function (instance, toast) {
                                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                                PopupPopupForm1FormAApi23AppForm.generate_api23_app()
                            }, true],
                            [`<button>Cancel</button>`, function (instance, toast) {
                                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                            }],
                        ],
                    });
                }

                PopupPopupForm1FormAApi23AppForm.generate_api23_app = async function () {
                    const response = await get_api_data('api23-key-get', {
                        ClientId: window.env['MAIN_API_CLIENT_ID'],
                        Api23eKeyPair: window.env['API23E_KEY_PAIR'],
                        OriginUrl: $('#api23-app-form').find('#origin-url-txt').val(),
                        AppType: $('#api23-app-form').find('#app-type-select').val(),
                        Sort: $('#api23-app-form').find('#sort-select').val(),
                    })

                    if (! isEmpty(response.data.apiStatus)) {
                        return iziToast.error({
                            title: 'Error',
                            message: response.data.body ?? $('#api-request-failed-please-check').text(),
                        })
                    }

                    $('#api23-app-form').find('#api23-key-txt').val(response.data.Api23Key)

                }

                PopupPopupForm1FormAApi23AppForm.get_last_slip_no = async function () {
                    const response = await get_api_data('last-slip-no-get', {
                        TableName: 'api23-app',
                        YYMMDD: moment(new Date()).format('YYMMDD'),
                    })

                    $('#api23-app-form').find('#auto-slip-no').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
                    $('#api23-app-form').find('#app-date').val(moment(new Date()).format('YYYYMMDD'))
                }

                PopupPopupForm1FormAApi23AppForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-popup-form1-form-a-api23-app-form .modal-dialog').css('maxWidth', '750px');
                    Atype.btn_act_new('#api23-app-form #frm');
                }

                PopupPopupForm1FormAApi23AppForm.btn_act_save = function () {const redirect_uri = $('#api23-app-form').find('#origin-url-txt').val()

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

                    Atype.btn_act_save('#api23-app-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupPopupForm1FormAApi23AppForm');
                }

                PopupPopupForm1FormAApi23AppForm.btn_act_del = function () {
                    Atype.btn_act_del('#api23-app-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupPopupForm1FormAApi23AppForm');
                }

                PopupPopupForm1FormAApi23AppForm.btn_act_new_callback = async function () {
                    PopupPopupForm1FormAApi23AppForm.btn_act_new()

                    PopupPopupForm1FormAApi23AppForm.get_last_slip_no()
                }

                PopupPopupForm1FormAApi23AppForm.parameter = function () {
                    const id = Number($('#api23-app-form').find('#Id').val());
                    let parameter = {
                        Id: id,
                        AppNo: $('#api23-app-form').find('#auto-slip-no').val(),
                        AppDate: $('#api23-app-form').find('#app-date').val(),

                        AppType: $('#api23-app-form').find('#app-type-select').val(),
                        Sort: $('#api23-app-form').find('#sort-select').val(),
                        OriginUrl: $('#api23-app-form').find('#origin-url-txt').val(),
                        Api23Key: $('#api23-app-form').find('#api23-key-txt').val(),
                        MemberId: window.Member['MemberId'],
                    }
                    if (id < 0) {
                        parameter = {Id: id}
                    }

                    // console.log(parameter)
                    return parameter;
                }

                PopupPopupForm1FormAApi23AppForm.fetch_api23_app = async function(id) {
                    const response = await get_api_data(PopupPopupForm1FormAApi23AppForm.formA['General']['PickApi'], {
                        Page: [{Id: id}]
                    })
                    PopupPopupForm1FormAApi23AppForm.set_api23_app_ui(response)
                }

                PopupPopupForm1FormAApi23AppForm.set_api23_app_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) {
                        // $('#modal-').modal('hide');
                        return
                    }

                    const app_ui = response.data.Page[0]

                    $('#api23-app-form').find("#Id").val(app_ui.Id)
                    $('#api23-app-form').find('#auto-slip-no').val(app_ui.AppNo)
                    $('#api23-app-form').find('#app-date').val(app_ui.AppDate)

                    $('#api23-app-form').find('#app-type-select').val(app_ui.AppType)
                    $('#api23-app-form').find('#sort-select').val(app_ui.Sort)
                    $('#api23-app-form').find('#origin-url-txt').val(app_ui.OriginUrl)
                    $('#api23-app-form').find('#api23-key-txt').val(app_ui.Api23Key)
                }


                PopupPopupForm1FormAApi23AppForm.show_popup_callback = async function (id, c1) {
                    PopupPopupForm1FormAApi23AppForm.btn_act_new()
                    await PopupPopupForm1FormAApi23AppForm.fetch_api23_app(Number(id));
                }
            }(window.PopupPopupForm1FormAApi23AppForm = window.PopupPopupForm1FormAApi23AppForm || {}, jQuery));
        </script>
    @endpush
@endonce
