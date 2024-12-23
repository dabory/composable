{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-api23e-key-pair-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary api23e-key-pair-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="api23e-key-pair-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Api23KeyPair'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center position-relative px-0 mr-1 col">
                                        <input class="rounded w-100" type="text" id="api23-key-pair-txt">
                                    </div>
                                    <button class="btn btn-sm btn-danger rounded col-3 mr-1" onclick="PopupSetupFormAApi23eKeyPairForm.generate_key_btn()">{{ $formA['FormVars']['Title']['GenerateKey'] }}</button>
                                    <button class="btn btn-sm btn-primary rounded col-3" onclick="PopupSetupFormAApi23eKeyPairForm.encrypt_key_btn()">{{ $formA['FormVars']['Title']['EncryptKey'] }}</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Api23eKeyPair'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center position-relative px-0 mr-1 col">
                                        <input class="rounded w-100" type="text" id="api23e-key-pair-txt" readonly>
                                        <i class="copy-btn input-icon icon-copy3 position-absolute" data-clipboard-target="#api23e-key-pair-txt"></i>
                                    </div>
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
            new Clipboard('.copy-btn').on('success', function(e) {
                iziToast.success({ title: 'Success', message: $('#action-completed').text() })
            }).on('error', function(e) {
                iziToast.error({ title: 'Error', message: $('#action-failed').text() })
            });

            $('.api23e-key-pair-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAApi23eKeyPairForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAApi23eKeyPairForm, $, undefined ) {
            PopupSetupFormAApi23eKeyPairForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAApi23eKeyPairForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#api23e-key-pair-form #frm')
            }

            PopupSetupFormAApi23eKeyPairForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAApi23eKeyPairForm.parameter);

                Atype.btn_act_save('#api23e-key-pair-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAApi23eKeyPairForm');
            }

            PopupSetupFormAApi23eKeyPairForm.parameter = function () {
                const form = $('#api23e-key-pair-form')

                let setup = {
                    Api23eKeyPair: $(form).find('#api23e-key-pair-txt').val(),
                }
                let id = Number($(form).find('#Id').val())
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

                return parameter;
            }

            PopupSetupFormAApi23eKeyPairForm.generate_public_key = function () {
                $.ajax({
                    url: "/generate-keys",
                    type: 'GET',
                    success: function(keys) {
                        $('#api23e-key-pair-form').find('#api23-key-pair-txt').val(keys[1]);
                    }
                });
            }

            PopupSetupFormAApi23eKeyPairForm.encrypt_key_btn = async function () {
                if (isEmpty($('#api23e-key-pair-form').find('#api23-key-pair-txt').val())) {
                    return iziToast.error({ title: 'Error', message: '새 키를 생성하세요' })
                }

                const response = await get_api_data('api23e-key-pair-get', {
                    ClientId: window.env['MAIN_API_CLIENT_ID'],
                    Api23KeyPair: $('#api23e-key-pair-form').find('#api23-key-pair-txt').val(),
                })

                $('#api23e-key-pair-form').find('#api23e-key-pair-txt').val(response.data.Api23eKeyPair)
            }

            PopupSetupFormAApi23eKeyPairForm.generate_key_btn = function () {
                if (isEmpty($('#api23e-key-pair-form').find('#api23-key-pair-txt').val())) {
                    return PopupSetupFormAApi23eKeyPairForm.generate_public_key()
                }

                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    title: 'Generate Keys',
                    message: 'The Old KeyPair will be DELETED !',
                    position: 'center',
                    buttons: [
                        [`<button><b>Confirm</b></button>`, function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                            PopupSetupFormAApi23eKeyPairForm.generate_public_key()
                        }, true],
                        [`<button>Cancel</button>`, function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });
            }

            PopupSetupFormAApi23eKeyPairForm.btn_act_new = async function () {
                Atype.btn_act_new('#api23e-key-pair-form #frm')
                $('#api23e-key-pair-txt').prop('readonly', true)
            }

            PopupSetupFormAApi23eKeyPairForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-api23e-key-pair-form .modal-dialog').css('maxWidth', '600px');
                PopupSetupFormAApi23eKeyPairForm.btn_act_new()
                $('#api23e-key-pair-form').find('#Id').val(id)

                PopupSetupFormAApi23eKeyPairForm.set_ui(setup)
            }

            PopupSetupFormAApi23eKeyPairForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#api23e-key-pair-form')

                $(form).find('#api23e-key-pair-txt').val(setup['Api23eKeyPair'])
            }

        }( window.PopupSetupFormAApi23eKeyPairForm = window.PopupSetupFormAApi23eKeyPairForm || {}, jQuery ));
    </script>
@endonce
