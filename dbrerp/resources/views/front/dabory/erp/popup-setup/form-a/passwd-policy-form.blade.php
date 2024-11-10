{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-passwd-policy-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary user-credit-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="passwd-policy-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 230px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PolicyDesc'] }}</label>
                                <input type="text" id="policy-desc-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MinLength'] }}</label>
                                <input type="text" id="min-length-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsUpperMixed'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-upper-mixed-check"> <label class="mb-0" for="is-upper-mixed-check">{{ $formA['FormVars']['Title']['IsUpperMixed'] }}</label>
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsSpecialMixed'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-special-mixed-check"> <label class="mb-0" for="is-special-mixed-check">{{ $formA['FormVars']['Title']['IsSpecialMixed'] }}</label>
                            </div>
                            <div class="align-items-center {{ $formA['FormVars']['Display']['IsProhibitReuse'] }} mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-prohibit-reuse-check"> <label class="mb-0" for="is-prohibit-reuse-check">{{ $formA['FormVars']['Title']['IsProhibitReuse'] }}</label>
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
            $('.user-credit-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAPasswdPolicyForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAPasswdPolicyForm, $, undefined ) {
            PopupSetupFormAPasswdPolicyForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAPasswdPolicyForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#passwd-policy-form #frm');
            }

            PopupSetupFormAPasswdPolicyForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAPasswdPolicyForm.parameter);

                Atype.btn_act_save('#passwd-policy-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAPasswdPolicyForm');
            }

            PopupSetupFormAPasswdPolicyForm.parameter = function () {
                let setup = {
                    PolicyDesc: $('#passwd-policy-form').find('#policy-desc-txt').val(),
                    MinLength: Number($('#passwd-policy-form').find('#min-length-txt').val()),
                    IsUpperMixed: $('#passwd-policy-form').find('#is-upper-mixed-check').is(':checked'),
                    IsSpecialMixed: $('#passwd-policy-form').find('#is-special-mixed-check').is(':checked'),
                    IsProhibitReuse: $('#passwd-policy-form').find('#is-prohibit-reuse-check').is(':checked'),
                }
                let id = Number($('#passwd-policy-form').find('#Id').val());
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

            PopupSetupFormAPasswdPolicyForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#passwd-policy-form #frm');
                $('#passwd-policy-form').find('#Id').val(id)
                PopupSetupFormAPasswdPolicyForm.set_ui(setup)
            }

            PopupSetupFormAPasswdPolicyForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#passwd-policy-form').find('#policy-desc-txt').val(setup['PolicyDesc'])
                $('#passwd-policy-form').find('#min-length-txt').val(setup['MinLength'])

                $('#passwd-policy-form').find('#is-upper-mixed-check').prop('checked', setup.IsUpperMixed)
                $('#passwd-policy-form').find('#is-special-mixed-check').prop('checked', setup.IsSpecialMixed)
                $('#passwd-policy-form').find('#is-prohibit-reuse-check').prop('checked', setup.IsProhibitReuse)
            }

        }( window.PopupSetupFormAPasswdPolicyForm = window.PopupSetupFormAPasswdPolicyForm || {}, jQuery ));
    </script>
@endonce
