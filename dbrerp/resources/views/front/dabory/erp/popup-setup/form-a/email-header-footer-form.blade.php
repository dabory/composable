{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-email-header-footer-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary email-header-footer-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="email-header-footer-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Logo'] }}</label>
                                <div class="d-flex">
                                    <input type="text" class="rounded w-100 radius-r0" id="logo-txt">
                                    <button class="text-white rounded border-0 radius-l0 col-3" onclick="show_media_modal()">찾기</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Url'] }}</label>
                                <input type="text" id="url-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
                                <input type="text" id="name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Footer'] }}</label>
                                <textarea id="footer-textarea" cols="30" rows="10"></textarea>
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
            $(document).on('file.paste', '#modal-media', function (event, file_url_list) {
                $('#email-header-footer-form').find('#logo-txt').val(file_url_list[0])
            });

            $('.email-header-footer-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAEmailHeaderFooterForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAEmailHeaderFooterForm, $, undefined ) {
            PopupSetupFormAEmailHeaderFooterForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAEmailHeaderFooterForm.create_etc_select_box_options = async function () {
                // let response = await get_api_data('app-guest-page', {
                //     PageVars: { Limit: 9999999, Offset: 0 }
                // })
                //
                // const option_list = `<option value="">local</option>` + custom_create_options('AppName', 'AppName', response.data.Page)
                // $('#email-header-footer-form').find('#guest-app-select').html(option_list)
            }

            PopupSetupFormAEmailHeaderFooterForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#email-header-footer-form #frm');
            }

            PopupSetupFormAEmailHeaderFooterForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAEmailHeaderFooterForm.parameter);

                Atype.btn_act_save('#email-header-footer-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAEmailHeaderFooterForm');
            }

            PopupSetupFormAEmailHeaderFooterForm.parameter = function () {
                const email_header_footer_form = $('#email-header-footer-form')
                let setup = {
                    Logo: $(email_header_footer_form).find('#logo-txt').val(),
                    Name: $(email_header_footer_form).find('#name-txt').val(),
                    Url: $(email_header_footer_form).find('#url-txt').val(),
                    Footer: $(email_header_footer_form).find('#footer-textarea').val(),
                }
                let id = Number($(email_header_footer_form).find('#Id').val());
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

            PopupSetupFormAEmailHeaderFooterForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#email-header-footer-form #frm');
                $('#email-header-footer-form').find('#Id').val(id)

                // await PopupSetupFormAEmailHeaderFooterForm.create_etc_select_box_options()
                PopupSetupFormAEmailHeaderFooterForm.set_email_header_footer_ui(setup)
            }

            PopupSetupFormAEmailHeaderFooterForm.set_email_header_footer_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const email_header_footer_form = $('#email-header-footer-form')

                $(email_header_footer_form).find('#logo-txt').val(setup['Logo'])
                $(email_header_footer_form).find('#name-txt').val(setup['Name'])
                $(email_header_footer_form).find('#url-txt').val(setup['Url'])
                $(email_header_footer_form).find('#footer-textarea').val(setup['Footer'])
            }

        }( window.PopupSetupFormAEmailHeaderFooterForm = window.PopupSetupFormAEmailHeaderFooterForm || {}, jQuery ));
    </script>
@endonce
