{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-import-pg-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary import-pg-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="import-pg-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MerchantId'] }}</label>
                                <input type="text" id="merchant-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PG'] }}</label>
                                <input type="text" id="pg-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ClientId'] }}</label>
                                <input type="text" id="client-id-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ClientSecret'] }}</label>
                                <input type="text" id="client-secret-txt" class="rounded w-100" autocomplete="off">
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
            $('.import-pg-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAImportPgForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAImportPgForm, $, undefined ) {
            PopupSetupFormAImportPgForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAImportPgForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#import-pg-form #frm');
            }

            PopupSetupFormAImportPgForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAImportPgForm.parameter);

                Atype.btn_act_save('#import-pg-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAImportPgForm');
            }

            PopupSetupFormAImportPgForm.parameter = function () {
                const form = $('#import-pg-form')

                let setup = {
                    MerchantId: $(form).find('#merchant-id-txt').val(),
                    PG: $(form).find('#pg-txt').val(),
                    ClientId: $(form).find('#client-id-txt').val(),
                    ClientSecret: $(form).find('#client-secret-txt').val(),
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

            PopupSetupFormAImportPgForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-import-pg-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#import-pg-form #frm');
                $('#import-pg-form').find('#Id').val(id)

                PopupSetupFormAImportPgForm.set_ui(setup)
            }

            PopupSetupFormAImportPgForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#import-pg-form')

                $(form).find('#merchant-id-txt').val(setup['MerchantId'])
                $(form).find('#pg-txt').val(setup['PG'])
                $(form).find('#client-id-txt').val(setup['ClientId'])
                $(form).find('#client-secret-txt').val(setup['ClientSecret'])
            }

        }( window.PopupSetupFormAImportPgForm = window.PopupSetupFormAImportPgForm || {}, jQuery ));
    </script>
@endonce
