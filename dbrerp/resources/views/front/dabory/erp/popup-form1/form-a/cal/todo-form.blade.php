{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary todo-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'todo-act',
        ])
    </div>
</div>

<div class="card mb-2" id="todo-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">

                        <div class="form-group {{ $formA['FormVars']['Display']['TodoDate'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TodoDate'] }}</label>
                            <input type="date" id="todo-date" class="rounded w-100"/>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['TodoTime'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TodoTime'] }}</label>
                            <input type="time" id="todo-time" class="rounded w-100"/>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['TodoTitle'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TodoTitle'] }}</label>
                            <input type="text" id="todo-title-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TodoTitle'] }}"
                                {{ $formA['FormVars']['Required']['TodoTitle'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['TodoMemo'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TodoMemo'] }}</label>
                            <textarea style="height: 85px" class="rounded w-100" id="todo-memo-txtarea"></textarea>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <select class="rounded w-100" id="sort-select"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                                @foreach ($formA['SortOptions'] as $option)
                                    <option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
                            <select class="rounded w-100" id="status-select"
                                {{ $formA['FormVars']['Required']['Status'] }}>
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
            $('.todo-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormACalTodoForm.btn_act_save(); break;
                    case 'del': PopupForm1FormACalTodoForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormACalTodoForm, $, undefined ) {
            PopupForm1FormACalTodoForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormACalTodoForm.btn_act_new = function () {
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup.popup-form1-form-a-cal-todo-form .modal-dialog').css('maxWidth', '700px');

                Atype.set_parameter_callback(PopupForm1FormACalTodoForm.parameter);
                Atype.btn_act_new('#todo-form #frm');
            }

            PopupForm1FormACalTodoForm.btn_act_new_callback = function (date) {
                PopupForm1FormACalTodoForm.btn_act_new()
                $('#todo-form').find('#todo-date').val(moment(date).format('YYYY-MM-DD'))
                $('#todo-form').find('#todo-time').val(moment(new Date()).format("HH:mm"))
            }

            PopupForm1FormACalTodoForm.parameter = function () {
                let id = Number($('#todo-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    TodoDate: moment($('#todo-form').find('#todo-date').val()).format('YYYYMMDD'),
                    TodoOn: get_now_time_stamp(),
                    TodoTime: $('#todo-form').find('#todo-time').val(),
                    TodoTitle: $('#todo-form').find('#todo-title-txt').val(),
                    TodoMemo: $('#todo-form').find('#todo-memo-txtarea').val(),
                    Sort: $('#todo-form').find('#sort-select').val(),
                    Status: $('#todo-form').find('#status-select').val(),
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

            PopupForm1FormACalTodoForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormACalTodoForm.parameter);
                Atype.btn_act_save('#todo-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').trigger('add.todo', PopupForm1FormACalTodoForm.parameter());
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormACalTodoForm');
            }

            PopupForm1FormACalTodoForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormACalTodoForm.parameter);
                Atype.btn_act_del('#todo-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').trigger('delete.todo');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormACalTodoForm');
            }

            PopupForm1FormACalTodoForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormACalTodoForm.btn_act_new()
                await PopupForm1FormACalTodoForm.fetch_todo(Number(id));
            }

            PopupForm1FormACalTodoForm.fetch_todo = async function (id) {
                let response = await get_api_data(PopupForm1FormACalTodoForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormACalTodoForm.set_todo_ui(response)
            }

            PopupForm1FormACalTodoForm.set_todo_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const todo = response.data.Page[0];

                $('#todo-form').find('#Id').val(todo.Id)
                $('#todo-form').find('#todo-date').val(moment(todo.TodoDate).format('YYYY-MM-DD'))
                $('#todo-form').find('#todo-time').val(todo.TodoTime)
                $('#todo-form').find('#todo-title-txt').val(todo.TodoTitle)
                $('#todo-form').find('#todo-memo-txtarea').val(todo.TodoMemo)
                $('#todo-form').find('#sort-select').val(todo.Sort)
                $('#todo-form').find('#status-select').val(todo.Status)
            }

        }( window.PopupForm1FormACalTodoForm = window.PopupForm1FormACalTodoForm || {}, jQuery ));
    </script>
@endpush
@endonce
