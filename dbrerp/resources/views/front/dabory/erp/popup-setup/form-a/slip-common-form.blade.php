<div id="popup-setup-form-a-slip-common-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary slip-common-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="slip-common-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 300px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SlipPrefix'] }}</label>
                                <input type="text" id="slip-prefix-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['YymmddFormat'] }}</label>
                                <select class="rounded w-100" id="yymmdd-format-select">
                                    <option value=""></option>
                                    <option value="YYMMDD">YYMMDD</option>
                                    <option value="YY-MM-DD">YY-MM-DD</option>
                                    <option value="YY.MM.DD">YY.MM.DD</option>
                                    <option value="YYMM">YYMM</option>
                                    <option value="YY">YY</option>
                                </select>
{{--                                <input type="text" id="yymmdd-format-txt" class="rounded w-100" autocomplete="off">--}}
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SerialDigit'] }}</label>
                                <input type="text" id="serial-digit-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsNewRecAutoSlipNo'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-new-rec-auto-slip-no-check"> <label class="mb-0" for="is-new-rec-auto-slip-no-check">{{ $formA['FormVars']['Title']['IsNewRecAutoSlipNo'] }}</label>
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsLastSlipGet'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-last-slip-get-check"> <label class="mb-0" for="is-last-slip-get-check">{{ $formA['FormVars']['Title']['IsLastSlipGet'] }}</label>
                            </div>
{{--                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsAutoSaveHdByItemButton'] }} mb-2">--}}
{{--                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-auto-save-hd-by-item-button-check"> <label class="mb-0" for="is-auto-save-hd-by-item-button-check">{{ $formA['FormVars']['Title']['IsAutoSaveHdByItemButton'] }}</label>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        $(document).ready(async function() {
            $('.slip-common-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormASlipCommonForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormASlipCommonForm, $, undefined ) {
            PopupSetupFormASlipCommonForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormASlipCommonForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormASlipCommonForm.parameter);

                Atype.btn_act_save('#slip-common-form  #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormASlipCommonForm');
            }

            PopupSetupFormASlipCommonForm.parameter = function () {
                let setup = {
                    SlipPrefix: $('#slip-common-form').find('#slip-prefix-txt').val(),
                    YymmddFormat: $('#slip-common-form').find('#yymmdd-format-select').val(),
                    SerialDigit: Number($('#slip-common-form').find('#serial-digit-txt').val()) || 0,
                    IsNewRecAutoSlipNo: $('#slip-common-form').find('#is-new-rec-auto-slip-no-check').is(':checked'),
                    IsLastSlipGet: $('#slip-common-form').find('#is-last-slip-get-check').is(':checked'),
                    IsAutoSaveHdByItemButton: $('#slip-common-form').find('#is-auto-save-hd-by-item-button-check').is(':checked'),
                }
                let id = Number($('#slip-common-form').find('#Id').val());
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

                // console.log(parameter)
                return parameter;
            }

            PopupSetupFormASlipCommonForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-slip-common-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#slip-common-form #frm');
                $('#slip-common-form').find('#Id').val(id)
                PopupSetupFormASlipCommonForm.set_sso_client_ui(setup)
            }

            PopupSetupFormASlipCommonForm.set_sso_client_ui = function (sso_client) {
                if (_.isEmpty(sso_client)) return;

                $('#slip-common-form').find('#slip-prefix-txt').val(sso_client.SlipPrefix)
                $('#slip-common-form').find('#yymmdd-format-select').val(sso_client.YymmddFormat)
                $('#slip-common-form').find('#serial-digit-txt').val(sso_client.SerialDigit)

                $('#slip-common-form').find('#is-new-rec-auto-slip-no-check').prop('checked', sso_client.IsNewRecAutoSlipNo)
                $('#slip-common-form').find('#is-last-slip-get-check').prop('checked', sso_client.IsLastSlipGet)
                $('#slip-common-form').find('#is-auto-save-hd-by-item-button-check').prop('checked', sso_client.IsAutoSaveHdByItemButton)
            }

        }( window.PopupSetupFormASlipCommonForm = window.PopupSetupFormASlipCommonForm || {}, jQuery ));

    </script>
@endonce
