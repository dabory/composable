{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-popup-slider-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary popup-slider-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="popup-slider-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PosX'] }}</label>
                                <input class="rounded w-100" type="text" id="pos-x-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PosY'] }}</label>
                                <input class="rounded w-100" type="text" id="pos-y-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                <input class="rounded w-100" type="text" id="width-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FooterHeight'] }}</label>
                                <input class="rounded w-100" type="text" id="footer-height-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FooterBackColor'] }}</label>
                                <input class="rounded w-100" type="text" id="footer-back-color-txt">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FooterFontColor'] }}</label>
                                <input class="rounded w-100" type="text" id="footer-font-color-txt">
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
            $('#footer-back-color-txt').colorpicker()
            $('#footer-font-color-txt').colorpicker()

            $('.popup-slider-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAPopupSliderForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAPopupSliderForm, $, undefined ) {
            PopupSetupFormAPopupSliderForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAPopupSliderForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#popup-slider-form #frm')
            }

            PopupSetupFormAPopupSliderForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAPopupSliderForm.parameter);

                Atype.btn_act_save('#popup-slider-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAPopupSliderForm');
            }

            PopupSetupFormAPopupSliderForm.parameter = function () {
                const form = $('#popup-slider-form')

                let setup = {
                    PosX: Number($(form).find('#pos-x-txt').val()),
                    PosY: Number($(form).find('#pos-y-txt').val()),
                    Width: Number($(form).find('#width-txt').val()),
                    FooterHeight: Number($(form).find('#footer-height-txt').val()),
                    FooterBackColor: $(form).find('#footer-back-color-txt').val(),
                    FooterFontColor: $(form).find('#footer-font-color-txt').val(),
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

            PopupSetupFormAPopupSliderForm.btn_act_new = async function () {
                Atype.btn_act_new('#popup-slider-form #frm')
                $('#modal-select-popup.popup-setup-form-a-popup-slider-form .modal-dialog').css('maxWidth', '600px');
            }

            PopupSetupFormAPopupSliderForm.show_popup_callback = async function (id, setup) {
                PopupSetupFormAPopupSliderForm.btn_act_new()
                $('#popup-slider-form').find('#Id').val(id)

                PopupSetupFormAPopupSliderForm.set_ui(setup)
            }

            PopupSetupFormAPopupSliderForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#popup-slider-form')

                $(form).find('#pos-x-txt').val(setup['PosX'])
                $(form).find('#pos-y-txt').val(setup['PosY'])
                $(form).find('#width-txt').val(setup['Width'])
                $(form).find('#footer-height-txt').val(setup['FooterHeight'])
                $(form).find('#footer-back-color-txt').val(setup['FooterBackColor'])
                $(form).find('#footer-font-color-txt').val(setup['FooterFontColor'])
            }

        }( window.PopupSetupFormAPopupSliderForm = window.PopupSetupFormAPopupSliderForm || {}, jQuery ));
    </script>
@endonce
