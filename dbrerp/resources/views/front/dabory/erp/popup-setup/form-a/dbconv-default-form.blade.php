<div id="popup-setup-form-a-dbconv-default-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary dbconv-default-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="dbconv-default-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['CgroupId'] }}</label>
                                <select class="rounded w-100" id="cgroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['IgroupId'] }}</label>
                                <select class="rounded w-100" id="igroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SgroupId'] }}</label>
                                <select class="rounded w-100" id="sgroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['StorageId'] }}</label>
                                <select class="rounded w-100" id="storage-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['BranchId'] }}</label>
                                <select class="rounded w-100" id="branch-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['DealTypeId'] }}</label>
                                <select class="rounded w-100" id="deal-type-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['VatRateId'] }}</label>
                                <select class="rounded w-100" id="vat-rate-id-select"></select>
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
            PopupSetupFormADbconvDefaultForm.create_etc_select_box_options()

            $('.dbconv-default-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormADbconvDefaultForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormADbconvDefaultForm, $, undefined ) {
            PopupSetupFormADbconvDefaultForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormADbconvDefaultForm.create_etc_select_box_options = async function () {
                const dbconv_default_form = $('#dbconv-default-form')

                let response = await get_api_data('cgroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#cgroup-id-select').append(custom_create_options('Id', 'CgroupName', response.data.Page))

                response = await get_api_data('igroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#igroup-id-select').append(custom_create_options('Id', 'IgroupName', response.data.Page))

                response = await get_api_data('sgroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#sgroup-id-select').append(custom_create_options('Id', 'SgroupName', response.data.Page))

                response = await get_api_data('storage-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#storage-id-select').append(custom_create_options('Id', 'StorageName', response.data.Page))

                response = await get_api_data('branch-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#branch-id-select').append(custom_create_options('Id', 'BranchName', response.data.Page))

                response = await get_api_data('deal-type-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#deal-type-id-select').append(custom_create_options('Id', 'DealName', response.data.Page))

                response = await get_api_data('vat-rate-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(dbconv_default_form).find('#vat-rate-id-select').append(custom_create_options('Id', 'VatName', response.data.Page))
            }

            PopupSetupFormADbconvDefaultForm.btn_act_save =  function () {
                Atype.set_parameter_callback(PopupSetupFormADbconvDefaultForm.parameter);
                Atype.btn_act_save('#dbconv-default-form  #frm', async function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormADbconvDefaultForm');
            }

            PopupSetupFormADbconvDefaultForm.setup_json_parameter = function () {
                const dbconv_default_form = $('#dbconv-default-form')

                return {
                    CgroupId: Number($(dbconv_default_form).find('#cgroup-id-select').val()),
                    IgroupId: Number($(dbconv_default_form).find('#igroup-id-select').val()),
                    SgroupId: Number($(dbconv_default_form).find('#sgroup-id-select').val()),
                    StorageId: Number($(dbconv_default_form).find('#storage-id-select').val()),
                    BranchId: Number($(dbconv_default_form).find('#branch-id-select').val()),
                    DealTypeId: Number($(dbconv_default_form).find('#deal-type-id-select').val()),
                    VatRateId: Number($(dbconv_default_form).find('#vat-rate-id-select').val()),
                }
            }

            PopupSetupFormADbconvDefaultForm.parameter = function () {
                let setup = PopupSetupFormADbconvDefaultForm.setup_json_parameter()
                let id = Number($('#dbconv-default-form').find('#Id').val());
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

            PopupSetupFormADbconvDefaultForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-dbconv-default-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#dbconv-default-form #frm');
                $('#dbconv-default-form').find('#Id').val(id)
                PopupSetupFormADbconvDefaultForm.set_ui(setup)
            }

            PopupSetupFormADbconvDefaultForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const dbconv_default_form = $('#dbconv-default-form')
                $(dbconv_default_form).find('#cgroup-id-select').val(setup['CgroupId'])
                $(dbconv_default_form).find('#igroup-id-select').val(setup['IgroupId'])
                $(dbconv_default_form).find('#sgroup-id-select').val(setup['SgroupId'])
                $(dbconv_default_form).find('#storage-id-select').val(setup['StorageId'])
                $(dbconv_default_form).find('#branch-id-select').val(setup['BranchId'])
                $(dbconv_default_form).find('#deal-type-id-select').val(setup['DealTypeId'])
                $(dbconv_default_form).find('#vat-rate-id-select').val(setup['VatRateId'])
            }

        }( window.PopupSetupFormADbconvDefaultForm = window.PopupSetupFormADbconvDefaultForm || {}, jQuery ));

    </script>
@endonce
