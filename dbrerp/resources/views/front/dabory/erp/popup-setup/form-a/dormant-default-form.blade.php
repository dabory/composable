{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-dormant-default-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary dormant-default-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="dormant-default-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['GuestApp'] }}</label>
                                <select id="guest-app-select" class="rounded w-100">
                                    <option value="">local</option>
                                    <option value="api23">api23</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ActiveMonth'] }}</label>
                                <input type="text" id="active-month-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ActiveNoticeDays'] }}</label>
                                <input type="text" id="active-notice-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FinishMonth'] }}</label>
                                <input type="text" id="finishMonth-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['FinishNoticeDays'] }}</label>
                                <input type="text" id="finish-notice-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['NoticeIntervalDays'] }}</label>
                                <input type="text" id="notice-interval-days-txt" class="rounded w-100" autocomplete="off">
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
            $('.dormant-default-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormADormantDefaultForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormADormantDefaultForm, $, undefined ) {
            PopupSetupFormADormantDefaultForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormADormantDefaultForm.create_etc_select_box_options = async function () {
                // let response = await get_api_data('app-guest-page', {
                //     PageVars: { Limit: 9999999, Offset: 0 }
                // })
                //
                // const option_list = `<option value="">local</option>` + custom_create_options('AppName', 'AppName', response.data.Page)
                // $('#dormant-default-form').find('#guest-app-select').html(option_list)
            }

            PopupSetupFormADormantDefaultForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#dormant-default-form #frm');
            }

            PopupSetupFormADormantDefaultForm.btn_act_save = function () {
                if ( check_dom_input_number(['#active-month-txt', '#active-notice-days-txt',
                    '#finishMonth-txt', '#finish-notice-days-txt', '#notice-interval-days-txt']) ) return;

                Atype.set_parameter_callback(PopupSetupFormADormantDefaultForm.parameter);

                Atype.btn_act_save('#dormant-default-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormADormantDefaultForm');
            }

            PopupSetupFormADormantDefaultForm.parameter = function () {
                const dormant_default_form = $('#dormant-default-form')
                let setup = {
                    GuestApp: $(dormant_default_form).find('#guest-app-select').val(),
                    ActiveMonth: Number($(dormant_default_form).find('#active-month-txt').val()),
                    ActiveNoticeDays: Number($(dormant_default_form).find('#active-notice-days-txt').val()),
                    FinishMonth: Number($(dormant_default_form).find('#finishMonth-txt').val()),
                    FinishNoticeDays: Number($(dormant_default_form).find('#finish-notice-days-txt').val()),
                    NoticeIntervalDays: Number($(dormant_default_form).find('#notice-interval-days-txt').val()),
                }
                let id = Number($(dormant_default_form).find('#Id').val());
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

            PopupSetupFormADormantDefaultForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#dormant-default-form #frm');
                $('#dormant-default-form').find('#Id').val(id)

                // await PopupSetupFormADormantDefaultForm.create_etc_select_box_options()
                PopupSetupFormADormantDefaultForm.set_dormant_default_ui(setup)
            }

            PopupSetupFormADormantDefaultForm.set_dormant_default_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const dormant_default_form = $('#dormant-default-form')

                $(dormant_default_form).find('#guest-app-select').val(setup['GuestApp'])
                $(dormant_default_form).find('#active-month-txt').val(setup['ActiveMonth'])
                $(dormant_default_form).find('#active-notice-days-txt').val(setup['ActiveNoticeDays'])
                $(dormant_default_form).find('#finishMonth-txt').val(setup['FinishMonth'])
                $(dormant_default_form).find('#finish-notice-days-txt').val(setup['FinishNoticeDays'])
                $(dormant_default_form).find('#notice-interval-days-txt').val(setup['NoticeIntervalDays'])
            }

        }( window.PopupSetupFormADormantDefaultForm = window.PopupSetupFormADormantDefaultForm || {}, jQuery ));
    </script>
@endonce
