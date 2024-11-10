{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary dbupdate-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'dbupdate-act',
        ])
    </div>
</div>

<div style="z-index: 1050" id="dbupdate-form">
    <div id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="form-group d-flex flex-column mb-2">
            <label class="m-0 overflow-hidden text-nowrap">{{ $formA['FormVars']['Title']['DbupdateNo'] }}</label>
            <div class="col-12 d-flex p-0">
                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-2 text-center text-white text-nowrap radius-r0"
                        onclick="PopupForm1FormADbupdateForm.get_last_slip_no(this)">
                    <span class="icon-cogs"></span>
                </button>
                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                       maxlength="{{ $formA['FormVars']['MaxLength']['DbupdateNo'] }}"
                    {{ $formA['FormVars']['Required']['DbupdateNo'] }}>
            </div>
        </div>
        <div class="form-group d-flex flex-column mb-2">
            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
            <select id="sort-select" class="rounded w-100" autocomplete="off"
                   maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                {{ $formA['FormVars']['Required']['Sort'] }}>
                @foreach($formA['SortSelectOptions'] as $option)
                <option value="{{ $option['Value'] }}">
                    {{ DataConverter::execute(null, $option['Caption']) }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group d-flex flex-column mb-2">
            <label class="m-0">{{ $formA['FormVars']['Title']['RelatedTables'] }}</label>
            <input type="text" id="related-tables-txt" class="rounded w-100" autocomplete="off"
                   maxlength="{{ $formA['FormVars']['MaxLength']['RelatedTables'] }}"
                {{ $formA['FormVars']['Required']['RelatedTables'] }}>
        </div>
        <div class="d-flex align-items-center mb-2">
            <input type="checkbox" value="1" class="text-center mr-1" id="is-confirmed-check">
            <label class="mb-0" for="is-confirmed-check">{{ $formA['FormVars']['Title']['IsConfirmed'] }}
            </label>
        </div>
        <div class="form-group" id="modal-memo">
            <label class="m-0">{{ $formA['FormVars']['Title']['SqlCommand'] }}</label>
            <textarea id="sql-command-textarea"
                      maxlength="{{ $formA['FormVars']['MaxLength']['SqlCommand'] }}"
                    {{ $formA['FormVars']['Required']['SqlCommand'] }}></textarea>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
    <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#dbupdate-form').find('#dbupdate-date').val(date_to_sting(new Date()))

            $('.dbupdate-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormADbupdateForm.btn_act_save(); break;
                    case 'del': PopupForm1FormADbupdateForm.btn_act_del(); break;
                    case 'new': PopupForm1FormADbupdateForm.btn_act_new(); break;

                    default: PopupForm1FormADbupdateForm.btn_act_for($(this).data('value')); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormADbupdateForm, $, undefined ) {
            PopupForm1FormADbupdateForm.formA = {!! json_encode($formA) !!};
            PopupForm1FormADbupdateForm.codeMirror;

            PopupForm1FormADbupdateForm.set_slip_no_btn_disabled = function () {
                $('#dbupdate-form').find('#auto-slip-no-btn').attr('disabled', true);
                $('#dbupdate-form').find('#auto-slip-no-btn').removeClass('text-white')
                $('#dbupdate-form').find('#auto-slip-no-btn').addClass('bg-white text-black')
            }

            PopupForm1FormADbupdateForm.set_slip_no_btn_abled = function () {
                $('#dbupdate-form').find('#auto-slip-no-btn').addClass('text-white')
                $('#dbupdate-form').find('#auto-slip-no-btn').removeClass('bg-white text-black')
                $('#dbupdate-form').find('#auto-slip-no-btn').attr('disabled', false)
            }

            PopupForm1FormADbupdateForm.get_last_slip_no = async function ($this) {
                PopupForm1FormADbupdateForm.set_slip_no_btn_disabled()
                let response = await get_api_data('last-slip-no-get', {
                    TableName: 'dbupdate',
                    YYMMDD: moment(new Date()).format('YYMMDD'),
                })
                $('#dbupdate-form').find('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            }


            PopupForm1FormADbupdateForm.btn_act_new_callback = function () {
                PopupForm1FormADbupdateForm.confirmed_all_dbupdate()
                PopupForm1FormADbupdateForm.btn_act_new()
                Atype.set_parameter_callback(PopupForm1FormADbupdateForm.parameter);
            }

            PopupForm1FormADbupdateForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormADbupdateForm.parameter);
                Atype.btn_act_save('#dbupdate-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormADbupdateForm');
            }

            PopupForm1FormADbupdateForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormADbupdateForm.parameter);
                Atype.btn_act_del('#dbupdate-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormADbupdateForm');
            }

            PopupForm1FormADbupdateForm.parameter = function () {
                let id = Number($('#dbupdate-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    DbupdateNo: $('#dbupdate-form').find('#auto-slip-no-txt').val(),
                    Sort: $('#dbupdate-form').find('#sort-select').val(),
                    RelatedTables: $('#dbupdate-form').find('#related-tables-txt').val(),
                    SqlCommand: PopupForm1FormADbupdateForm.codeMirror.getValue(),
                    IsConfirmed: $('#dbupdate-form').find('#is-confirmed-check:checked').val() ?? '0',
                    UserId: window.User['UserId'],
                    Ip: window.User['Ip']
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

            PopupForm1FormADbupdateForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                if (PopupForm1FormADbupdateForm.codeMirror) {
                    PopupForm1FormADbupdateForm.codeMirror.setValue('')
                    PopupForm1FormADbupdateForm.codeMirror.toTextArea()
                }

                PopupForm1FormADbupdateForm.codeMirror = CodeMirror.fromTextArea($('#sql-command-textarea')[0], {
                    extraKeys: {"Ctrl-Space": "autocomplete"},
                    theme: 'mdn-like',
                    mode: "sql",
                    lineWrapping : false,
                    autoRefresh:true,
                    lineNumbers : true,
                });

                PopupForm1FormADbupdateForm.set_slip_no_btn_abled()

                Atype.btn_act_new('#dbupdate-form #frm');
            }

            PopupForm1FormADbupdateForm.confirmed_all_dbupdate = async function () {
                const response = await get_api_data('dbupdate-page', {
                    PageVars: {
                        Query: "is_confirmed = '0'",
                        Limit: 999999999,
                        Offset: 0,
                    }
                })

                if (response.data['Page']) {
                    iziToast.info({
                        title: 'Info',
                        message: '실행 승인 체크가 안 된 DB 업데이트가 존재합니다',
                    });
                }
            }

            PopupForm1FormADbupdateForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormADbupdateForm.confirmed_all_dbupdate()
                PopupForm1FormADbupdateForm.btn_act_new()
                await PopupForm1FormADbupdateForm.fetch_dbupdate(Number(id));
            }

            PopupForm1FormADbupdateForm.fetch_dbupdate = async function (id) {
                let response = await get_api_data(PopupForm1FormADbupdateForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormADbupdateForm.set_dbupdate_ui(response)
            }

            PopupForm1FormADbupdateForm.set_dbupdate_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let dbupdate = response.data.Page[0];
                // console.log(dbupdate)
                PopupForm1FormADbupdateForm.set_slip_no_btn_disabled()
                $('#dbupdate-form').find('#Id').val(dbupdate.Id)

                $('#dbupdate-form').find('#auto-slip-no-txt').val(dbupdate.DbupdateNo)
                $('#dbupdate-form').find('#sort-select').val(dbupdate.Sort)
                $('#dbupdate-form').find('#related-tables-txt').val(dbupdate.RelatedTables)
                $('#dbupdate-form').find('#is-confirmed-check').prop('checked', dbupdate.IsConfirmed == '1')
                PopupForm1FormADbupdateForm.codeMirror.setValue(dbupdate.SqlCommand)
                PopupForm1FormADbupdateForm.codeMirror.refresh()
            }


        }( window.PopupForm1FormADbupdateForm = window.PopupForm1FormADbupdateForm || {}, jQuery ));
        let mediaModal;
    </script>
@endpush
@endonce
