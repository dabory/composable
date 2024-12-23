{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-user-reward-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary user-reward-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="user-reward-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReservePoint'] }}</label>
                                <input type="text" id="reserve-point-txt" class="rounded w-100 decimal" autocomplete="off"
                                data-point="{{ $formA['FormVars']['Format']['ReservePoint'] }}">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MinUsePoint'] }}</label>
                                <input type="text" id="min-use-point-txt" class="rounded w-100 decimal" autocomplete="off"
                                data-point="{{ $formA['FormVars']['Format']['MinUsePoint'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px"><!--260-->
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
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
            $('.user-reward-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAUserRewardForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAUserRewardForm, $, undefined ) {
            PopupSetupFormAUserRewardForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAUserRewardForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#user-reward-form #frm');
            }

            PopupSetupFormAUserRewardForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAUserRewardForm.parameter);

                Atype.btn_act_save('#user-reward-form  #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAUserRewardForm');
            }

            PopupSetupFormAUserRewardForm.parameter = function () {
                let setup = {
                    ReservePoint: Number(minusComma($('#user-reward-form').find('#reserve-point-txt').val())),
                    MinUsePoint: Number(minusComma($('#user-reward-form').find('#min-use-point-txt').val())),
                }
                let id = Number($('#user-reward-form').find('#Id').val());
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

            PopupSetupFormAUserRewardForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#user-reward-form #frm');
                $('#user-reward-form').find('#Id').val(id)
                PopupSetupFormAUserRewardForm.set_coupon_ui(setup)
            }

            PopupSetupFormAUserRewardForm.set_coupon_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#user-reward-form').find('#reserve-point-txt').val(format_conver_for(setup['ReservePoint'], PopupSetupFormAUserRewardForm.formA['FormVars']['Format']['ReservePoint']))
                $('#user-reward-form').find('#min-use-point-txt').val(format_conver_for(setup['MinUsePoint'], PopupSetupFormAUserRewardForm.formA['FormVars']['Format']['MinUsePoint']))
            }

        }( window.PopupSetupFormAUserRewardForm = window.PopupSetupFormAUserRewardForm || {}, jQuery ));
    </script>
@endonce
