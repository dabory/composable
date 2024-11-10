{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary users-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'users-act',
        ])
    </div>
</div>

<div class="card mb-2" id="users-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
                            <input type="text" id="name-txt" class="rounded w-100" required autocomplete="off">
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                            <input type="email" id="email-txt" class="rounded w-100" disabled autocomplete="off">
                        </div>
                        <div class="d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select class="rounded w-100" id="status-select" required>
                                @foreach ($formA['StatusOptions'] as $option)
                                    <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.users-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAUsersForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAUsersForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAUsersForm, $, undefined ) {
            PopupForm1FormAUsersForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAUsersForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-users-form .modal-dialog').css('maxWidth', '300px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#users-form #frm');
            }

            PopupForm1FormAUsersForm.btn_act_new_callback = function () {
                PopupForm1FormAUsersForm.btn_act_new()
                Atype.set_parameter_callback(PopupForm1FormAUsersForm.parameter);
            }

            PopupForm1FormAUsersForm.parameter = function () {
                let id = Number($('#users-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SignupDate: moment(new Date()).format('YYYYMMDD'),
                    NickName: $('#users-form').find('#name-txt').val(),
                    Status: $('#users-form').find('#status-select').val(),
                    CreatedIpAddress: window.User['Ip']
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

            PopupForm1FormAUsersForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAUsersForm.parameter);
                Atype.btn_act_save('#users-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAUsersForm');
            }

            PopupForm1FormAUsersForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAUsersForm.parameter);
                Atype.btn_act_del('#users-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAUsersForm');
            }

            PopupForm1FormAUsersForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAUsersForm.btn_act_new()
                await PopupForm1FormAUsersForm.fetch_users(Number(id));
            }

            PopupForm1FormAUsersForm.fetch_users = async function (id) {
                let response = await get_api_data(PopupForm1FormAUsersForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAUsersForm.set_users_ui(response)
            }

            PopupForm1FormAUsersForm.set_users_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let users = response.data.Page[0];
                // console.log(users)

                const users_form = $('#users-form')

                $(users_form).find('#Id').val(users.Id)

                $(users_form).find('#name-txt').val(users.NickName)
                $(users_form).find('#email-txt').val(users.Email)

                $(users_form).find('#status-select').val(users.Status)
            }

        }( window.PopupForm1FormAUsersForm = window.PopupForm1FormAUsersForm || {}, jQuery ));
    </script>
@endpush
@endonce
