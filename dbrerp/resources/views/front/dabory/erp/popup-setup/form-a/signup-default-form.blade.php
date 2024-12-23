<div id="popup-setup-form-a-signup-default-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary signup-default-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="signup-default-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-6 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserPermId'] }}</label>
                                <select class="rounded w-100" id="user-perm-id-select">
                                    <option value="0">Empty Permission</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserSgroupId'] }}</label>
                                <select class="rounded w-100" id="user-sgroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserBranchId'] }}</label>
                                <select class="rounded w-100" id="user-branch-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserStorageId'] }}</label>
                                <select class="rounded w-100" id="user-storage-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserAgroupId'] }}</label>
                                <select class="rounded w-100" id="user-agroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserCountryCode'] }}</label>
                                <select class="rounded w-100" id="user-country-code-select">
                                    @foreach(preg_replace('/\s+/', '', explode(',', env('LOCALE_SEQUENCE'))) as $locale)
                                        <option value="{{ $locale }}">{{ $locale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberPermId'] }}</label>
                                <select class="rounded w-100" id="member-perm-id-select">
                                    <option value="0">Empty Permission</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberSgroupId'] }}</label>
                                <select class="rounded w-100" id="member-sgroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberBranchId'] }}</label>
                                <select class="rounded w-100" id="member-branch-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberStorageId'] }}</label>
                                <select class="rounded w-100" id="member-storage-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberAgroupId'] }}</label>
                                <select class="rounded w-100" id="member-agroup-id-select"></select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MemberCountryCode'] }}</label>
                                <select class="rounded w-100" id="member-country-code-select">
                                    @foreach(preg_replace('/\s+/', '', explode(',', env('LOCALE_SEQUENCE'))) as $locale)
                                        <option value="{{ $locale }}">{{ $locale }}</option>
                                    @endforeach
                                </select>
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
            PopupSetupFormASignupDefaultForm.create_etc_select_box_options()

            $('.signup-default-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormASignupDefaultForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormASignupDefaultForm, $, undefined ) {
            PopupSetupFormASignupDefaultForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormASignupDefaultForm.create_etc_select_box_options = async function () {
                const signup_default_form = $('#signup-default-form')

                let response = await get_api_data('user-perm-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(signup_default_form).find('#user-perm-id-select').append(custom_create_options('Id', 'PermName', response.data.Page))
                $(signup_default_form).find('#member-perm-id-select').append(custom_create_options('Id', 'PermName', response.data.Page))

                response = await get_api_data('sgroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(signup_default_form).find('#user-sgroup-id-select').append(custom_create_options('Id', 'SgroupName', response.data.Page))
                $(signup_default_form).find('#member-sgroup-id-select').append(custom_create_options('Id', 'SgroupName', response.data.Page))

                response = await get_api_data('branch-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(signup_default_form).find('#user-branch-id-select').append(custom_create_options('Id', 'BranchName', response.data.Page))
                $(signup_default_form).find('#member-branch-id-select').append(custom_create_options('Id', 'BranchName', response.data.Page))

                response = await get_api_data('storage-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(signup_default_form).find('#user-storage-id-select').append(custom_create_options('Id', 'StorageName', response.data.Page))
                $(signup_default_form).find('#member-storage-id-select').append(custom_create_options('Id', 'StorageName', response.data.Page))

                response = await get_api_data('agroup-page', {
                    PageVars: { Limit: 9999999, Offset: 0 }
                })
                $(signup_default_form).find('#user-agroup-id-select').append(custom_create_options('Id', 'AgroupName', response.data.Page))
                $(signup_default_form).find('#member-agroup-id-select').append(custom_create_options('Id', 'AgroupName', response.data.Page))
            }

            PopupSetupFormASignupDefaultForm.btn_act_save =  function () {
                Atype.set_parameter_callback(PopupSetupFormASignupDefaultForm.parameter);
                Atype.btn_act_save('#signup-default-form  #frm', async function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormASignupDefaultForm');
            }

            PopupSetupFormASignupDefaultForm.setup_json_parameter = function () {
                const signup_default_form = $('#signup-default-form')

                return {
                    UserPermId: Number($(signup_default_form).find('#user-perm-id-select').val()),
                    UserSgroupId: Number($(signup_default_form).find('#user-sgroup-id-select').val()),
                    UserBranchId: Number($(signup_default_form).find('#user-branch-id-select').val()),
                    UserStorageId: Number($(signup_default_form).find('#user-storage-id-select').val()),
                    UserAgroupId: Number($(signup_default_form).find('#user-agroup-id-select').val()),
                    UserCountryCode: $(signup_default_form).find('#user-country-code-select').val(),

                    MemberPermId: Number($(signup_default_form).find('#member-perm-id-select').val()),
                    MemberSgroupId: Number($(signup_default_form).find('#member-sgroup-id-select').val()),
                    MemberBranchId: Number($(signup_default_form).find('#member-branch-id-select').val()),
                    MemberStorageId: Number($(signup_default_form).find('#member-storage-id-select').val()),
                    MemberAgroupId: Number($(signup_default_form).find('#member-agroup-id-select').val()),
                    MemberCountryCode: $(signup_default_form).find('#member-country-code-select').val(),
                }
            }

            PopupSetupFormASignupDefaultForm.parameter = function () {
                let setup = PopupSetupFormASignupDefaultForm.setup_json_parameter()
                let id = Number($('#signup-default-form').find('#Id').val());
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

            PopupSetupFormASignupDefaultForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#signup-default-form #frm');
                $('#signup-default-form').find('#Id').val(id)
                PopupSetupFormASignupDefaultForm.set_ui(setup)
            }

            PopupSetupFormASignupDefaultForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const signup_default_form = $('#signup-default-form')
                $(signup_default_form).find('#user-perm-id-select').val(setup['UserPermId'])
                $(signup_default_form).find('#user-sgroup-id').val(setup['UserSgroupId'])
                $(signup_default_form).find('#user-branch-id-select').val(setup['UserBranchId'])
                $(signup_default_form).find('#user-storage-id-select').val(setup['UserStorageId'])
                $(signup_default_form).find('#user-agroup-id-select').val(setup['UserAgroupId'])
                $(signup_default_form).find('#user-country-code-select').val(setup['UserCountryCode'])

                $(signup_default_form).find('#member-perm-id-select').val(setup['MemberPermId'])
                $(signup_default_form).find('#member-sgroup-id').val(setup['MemberSgroupId'])
                $(signup_default_form).find('#member-branch-id-select').val(setup['MemberBranchId'])
                $(signup_default_form).find('#member-storage-id-select').val(setup['MemberStorageId'])
                $(signup_default_form).find('#member-agroup-id-select').val(setup['MemberAgroupId'])
                $(signup_default_form).find('#member-country-code-select').val(setup['MemberCountryCode'])
            }

        }( window.PopupSetupFormASignupDefaultForm = window.PopupSetupFormASignupDefaultForm || {}, jQuery ));

    </script>
@endonce
