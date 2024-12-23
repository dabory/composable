{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-form1-setup-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary setup-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => $formA['SelectButtonOptions'],
                'eventClassName' => 'setup-act',
            ])
        </div>
    </div>
    <div class="card mb-2" id="setup-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SetupCode'] }}</label>
                                <input type="text" id="setup-code-txt" class="rounded w-100" autocomplete="off" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SetupName'] }}</label>
                                <input type="text" id="setup-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Component'] }}</label>
                                <input type="text" id="component-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Parameter'] }}</label>
                                <input type="text" id="parameter-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 140px"><!--260-->
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SetupJson'] }}</label>
                                <textarea style="height: 85px" class="rounded w-100 bg-white" id="json-txt-area" role="button" readonly></textarea>
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
@include('front.outline.static.json-editor')

<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.setup-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1SetupForm.btn_act_save(); break;
                    case 'del': PopupForm1SetupForm.btn_act_del(); break;
                }
            });

            $('#setup-form').find('#json-txt-area').on('dblclick', function () {
                $('#modal-json-editor').data('parameter', '#setup-form #json-txt-area')
                $('#modal-json-editor').find('#json').html($('#setup-form').find('#json-txt-area').val())
                $('#modal-json-editor').modal('show');
            });

            Atype.set_parameter_callback(PopupForm1SetupForm.parameter);

            activate_button_group()
        });

        (function( PopupForm1SetupForm, $, undefined ) {
            PopupForm1SetupForm.formA = {!! json_encode($formA) !!};

            PopupForm1SetupForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#setup-form #frm');
            }

            PopupForm1SetupForm.btn_act_save = function () {
                Atype.btn_act_save('#setup-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1SetupForm');
            }

            PopupForm1SetupForm.btn_act_del = function () {
                Atype.btn_act_del('#setup-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1SetupForm');
            }

            PopupForm1SetupForm.show_popup_callback = async function (id, c1) {
                await PopupForm1SetupForm.fetch_setup(Number(id));
            }

            PopupForm1SetupForm.fetch_setup = async function (id) {
                let response = await get_api_data(PopupForm1SetupForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1SetupForm.set_coupon_ui(response)
            }

            PopupForm1SetupForm.set_coupon_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let setup = response.data.Page[0];

                $('#setup-form').find('#Id').val(setup.Id)

                $('#setup-form').find('#setup-code-txt').val(setup.SetupCode)
                $('#setup-form').find('#setup-name-txt').val(setup.SetupName)

                $('#setup-form').find('#component-txt').val(setup.Component)
                $('#setup-form').find('#parameter-txt').val(setup.Parameter)

                $('#setup-form').find('#json-txt-area').val(setup.SetupJson)
            }

            PopupForm1SetupForm.parameter = function () {
                let id = Number($('#setup-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupCode: $('#setup-form').find('#setup-code-txt').val(),
                    SetupName: $('#setup-form').find('#setup-name-txt').val(),
                    Component: $('#setup-form').find('#component-txt').val(),
                    Parameter: $('#setup-form').find('#parameter-txt').val(),
                    SetupJson: $('#setup-form').find('#json-txt-area').val(),
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

        }( window.PopupForm1SetupForm = window.PopupForm1SetupForm || {}, jQuery ));
    </script>
@endonce
