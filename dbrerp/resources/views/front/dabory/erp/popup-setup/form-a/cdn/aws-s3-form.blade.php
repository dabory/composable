<div id="popup-setup-form-a-cdn-aws-s3-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary aws-s3-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="cdn-aws-s3-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['AccessKeyId'] }}</label>
                                <input type="text" class="rounded w-100" id="access-key-id-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SecretAccessKey'] }}</label>
                                <input type="text" class="rounded w-100" id="secret-access-key-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['DefaultRegion'] }}</label>
                                <input type="text" class="rounded w-100" id="default-region-txt">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Bucket'] }}</label>
                                <input type="text" class="rounded w-100" id="bucket-txt">
                            </div>
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
            $('.aws-s3-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormACdnAwsS3Form.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormACdnAwsS3Form, $, undefined ) {
            PopupSetupFormACdnAwsS3Form.formA = {!! json_encode($formA) !!};

            PopupSetupFormACdnAwsS3Form.btn_act_save =  function () {
                Atype.set_parameter_callback(PopupSetupFormACdnAwsS3Form.parameter);
                Atype.btn_act_save('#cdn-aws-s3-form  #frm', async function () {
                    axios.post('/set-aws-s3', PopupSetupFormACdnAwsS3Form.setup_json_parameter());
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormACdnAwsS3Form');
            }

            PopupSetupFormACdnAwsS3Form.setup_json_parameter = function () {
                const general_info_form = $('#cdn-aws-s3-form')

                return {
                    AccessKeyId: $(general_info_form).find('#access-key-id-txt').val(),
                    SecretAccessKey: $(general_info_form).find('#secret-access-key-txt').val(),
                    DefaultRegion: $(general_info_form).find('#default-region-txt').val(),
                    Bucket: $(general_info_form).find('#bucket-txt').val(),
                }
            }

            PopupSetupFormACdnAwsS3Form.parameter = function () {
                let setup = PopupSetupFormACdnAwsS3Form.setup_json_parameter()
                let id = Number($('#cdn-aws-s3-form').find('#Id').val());
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

            PopupSetupFormACdnAwsS3Form.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-cdn-aws-s3-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#cdn-aws-s3-form #frm');
                $('#cdn-aws-s3-form').find('#Id').val(id)
                PopupSetupFormACdnAwsS3Form.set_ui(setup)
            }

            PopupSetupFormACdnAwsS3Form.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const general_info_form = $('#cdn-aws-s3-form')
                $(general_info_form).find('#access-key-id-txt').val(setup['AccessKeyId'])
                $(general_info_form).find('#secret-access-key-txt').val(setup['SecretAccessKey'])
                $(general_info_form).find('#default-region-txt').val(setup['DefaultRegion'])
                $(general_info_form).find('#bucket-txt').val(setup['Bucket'])
            }

        }( window.PopupSetupFormACdnAwsS3Form = window.PopupSetupFormACdnAwsS3Form || {}, jQuery ));

    </script>
@endonce
