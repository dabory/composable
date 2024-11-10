{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-courier-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary courier-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="courier-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
                                <input type="text" id="name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TrackUrl'] }}</label>
                                <input type="text" id="track-url-txt" class="rounded w-100" autocomplete="off">
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
            $('.courier-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormACourierForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormACourierForm, $, undefined ) {
            PopupSetupFormACourierForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormACourierForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#courier-form #frm');
            }

            PopupSetupFormACourierForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormACourierForm.parameter);

                Atype.btn_act_save('#courier-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormACourierForm');
            }

            PopupSetupFormACourierForm.parameter = function () {
                const form = $('#courier-form')

                let setup = {
                    Name: $(form).find('#name-txt').val(),
                    TrackUrl: $(form).find('#track-url-txt').val(),
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

            PopupSetupFormACourierForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-courier-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#courier-form #frm');
                $('#courier-form').find('#Id').val(id)

                PopupSetupFormACourierForm.set_ui(setup)
            }

            PopupSetupFormACourierForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#courier-form')

                $(form).find('#name-txt').val(setup['Name'])
                $(form).find('#track-url-txt').val(setup['TrackUrl'])
            }

        }( window.PopupSetupFormACourierForm = window.PopupSetupFormACourierForm || {}, jQuery ));
    </script>
@endonce
