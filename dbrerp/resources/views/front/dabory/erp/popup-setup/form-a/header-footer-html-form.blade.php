{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-header-footer-html-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary header-footer-html-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'header-footer-html-act',
                ])
            @endisset
        </div>
    </div>
    <div class="card mb-2" id="header-footer-html-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="hidden" id="view-source-url">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Header'] }}</label>
                                <textarea id="header-textarea"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Body'] }}</label>
                                <textarea id="body-textarea"></textarea>
                            </div><div class="d-flex flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Footer'] }}</label>
                                <textarea id="footer-textarea"></textarea>
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
            $('#header-footer-html-form').find('#upload-file').fileselect()

            $('.header-footer-html-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAHeaderFooterHtmlForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAHeaderFooterHtmlForm, $, undefined ) {
            PopupSetupFormAHeaderFooterHtmlForm.formA = {!! json_encode($formA) !!};
            PopupSetupFormAHeaderFooterHtmlForm.brand_code


            PopupSetupFormAHeaderFooterHtmlForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#header-footer-html-form #frm')
            }

            PopupSetupFormAHeaderFooterHtmlForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAHeaderFooterHtmlForm.parameter);

                Atype.btn_act_save('#header-footer-html-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAHeaderFooterHtmlForm');
            }

            PopupSetupFormAHeaderFooterHtmlForm.parameter = function () {
                const form = $('#header-footer-html-form')

                let setup = {
                    Header: $(form).find('#header-textarea').val(),
                    Body: $(form).find('#body-textarea').val(),
                    Footer: $(form).find('#footer-textarea').val(),
                }
                let id = Number($(form).find('#Id').val())
                let parameter = {
                    Id: id,
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

            PopupSetupFormAHeaderFooterHtmlForm.btn_act_new = async function () {
                Atype.btn_act_new('#header-footer-html-form #frm')
            }

            PopupSetupFormAHeaderFooterHtmlForm.show_popup_callback = async function (id, setup, brand_code) {
                $('#modal-select-popup.popup-setup-form-a-header-footer-html-form .modal-dialog').css('maxWidth', '600px');
                PopupSetupFormAHeaderFooterHtmlForm.btn_act_new()
                $('#header-footer-html-form').find('#Id').val(id)
                PopupSetupFormAHeaderFooterHtmlForm.brand_code = brand_code
                PopupSetupFormAHeaderFooterHtmlForm.set_ui(setup)
            }

            PopupSetupFormAHeaderFooterHtmlForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const form = $('#header-footer-html-form')

                $(form).find('#header-textarea').val(setup['Header'])
                $(form).find('#body-textarea').val(setup['Body'])
                $(form).find('#footer-textarea').val(setup['Footer'])
            }

        }( window.PopupSetupFormAHeaderFooterHtmlForm = window.PopupSetupFormAHeaderFooterHtmlForm || {}, jQuery ));
    </script>
@endonce
