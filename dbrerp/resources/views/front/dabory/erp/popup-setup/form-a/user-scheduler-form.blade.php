{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-user-scheduler-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary user-scheduler-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="user-scheduler-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OrderWaitPayDays'] }}</label>
                                <input type="text" id="order-wait-pay-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ShipWaitDays'] }}</label>
                                <input type="text" id="ship-wait-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['CancelWaitDays'] }}</label>
                                <input type="text" id="cancel-wait-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ReturnWaitDays'] }}</label>
                                <input type="text" id="return-wait-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ExchangeWaitDays'] }}</label>
                                <input type="text" id="exchange-wait-days-txt" class="rounded w-100" autocomplete="off">
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
            $('.user-scheduler-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAUserSchedulerForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAUserSchedulerForm, $, undefined ) {
            PopupSetupFormAUserSchedulerForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAUserSchedulerForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#user-scheduler-form #frm');
            }

            PopupSetupFormAUserSchedulerForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAUserSchedulerForm.parameter);

                Atype.btn_act_save('#user-scheduler-form #frm', async function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAUserSchedulerForm');
            }

            PopupSetupFormAUserSchedulerForm.request_data = function () {
                const user_scheduler_form = $('#user-scheduler-form')

                return {
                    OrderWaitPayDays: Number($(user_scheduler_form).find('#order-wait-pay-days-txt').val()),
                    ShipWaitDays: Number($(user_scheduler_form).find('#ship-wait-days-txt').val()),
                    CancelWaitDays: Number($(user_scheduler_form).find('#cancel-wait-days-txt').val()),
                    ReturnWaitDays: Number($(user_scheduler_form).find('#return-wait-days-txt').val()),
                    ExchangeWaitDays: Number($(user_scheduler_form).find('#exchange-wait-days-txt').val()),
                }
            }

            PopupSetupFormAUserSchedulerForm.parameter = function () {
                const user_scheduler_form = $('#user-scheduler-form')
                let setup = PopupSetupFormAUserSchedulerForm.request_data()
                let id = Number($(user_scheduler_form).find('#Id').val());
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

            PopupSetupFormAUserSchedulerForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#user-scheduler-form #frm');
                $('#user-scheduler-form').find('#Id').val(id)
                PopupSetupFormAUserSchedulerForm.set_ui(setup)
            }

            PopupSetupFormAUserSchedulerForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const user_scheduler_form = $('#user-scheduler-form')

                $(user_scheduler_form).find('#order-wait-pay-days-txt').val(setup['OrderWaitPayDays'])
                $(user_scheduler_form).find('#ship-wait-days-txt').val(setup['ShipWaitDays'])
                $(user_scheduler_form).find('#cancel-wait-days-txt').val(setup['CancelWaitDays'])
                $(user_scheduler_form).find('#return-wait-days-txt').val(setup['ReturnWaitDays'])
                $(user_scheduler_form).find('#exchange-wait-days-txt').val(setup['ExchangeWaitDays'])
            }

        }( window.PopupSetupFormAUserSchedulerForm = window.PopupSetupFormAUserSchedulerForm || {}, jQuery ));
    </script>
@endonce
