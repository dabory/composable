@extends('layouts.master')
@section('content')

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary sorder-pro-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formB['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formB['HeadSelectOptions'],
            'eventClassName' => 'ticket-act',
        ])
    </div>
</div>

<div class="card mb-2" id="sorder-pro-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 630px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                            <div class="col-12 d-flex p-0">
                                <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                    onclick="PopupForm1FormBSorderProForm.get_last_slip_no(this)">
                                    <span class="icon-cogs"></span>
                                </button>
                                <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" required disabled>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <div class="row">
                                <div class="col-7 pr-1">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['SorderSumTotal'] }}</label>
                                    <input type="text" id="sorder-sum-total-txt" class="rounded w-100" autocomplete="off" disabled>
                                </div>
                                <div class="col-5 pl-1">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['SorderDate'] }}</label>
                                    <input class="rounded w-100" type="text" id="sorder-date" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formB['FormVars']['Title']['PaymentType'] }}</label>
                            <input type="text" id="payment-type-txt" class="rounded w-100" autocomplete="off" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@once

@push('modal')
@endpush

@push('js')
<script src="/js/modals-controller/b-type/common.js?{{ date('YmdHis') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.ticket-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#ticket-form #frm', function () {}, 'PopupForm1FormBSorderProForm'); break;
                    default: PopupForm1FormBSorderProForm.btn_act($(this).data('value')); break;
                }

            });

            activate_button_group()
        });

        (function( PopupForm1FormBSorderProForm, $, undefined ) {
            PopupForm1FormBSorderProForm.formB = {!! json_encode($formB) !!};
            PopupForm1FormBSorderProForm.bd_page = [];

            PopupForm1FormBSorderProForm.btn_act_multi_update_callback = async function (ids, code, callback) {
                const data = ids.map(function (id) {
                    return { Id:id, UpdatedOn: get_now_time_stamp(), Status: String(code) }
                })
                let response = await get_api_data(PopupForm1FormBSorderProForm.formB['General']['ActApi'], { Page: data });
                if (response.data.Page) {
                    callback()
                } else {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text();
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                }
            }

            PopupForm1FormBSorderProForm.btn_act = function (value) {
                let status = undefined;
                switch (value) {
                    case 'tempsave':
                        status = 0; break;
                    case 'complete':
                        status = 1; break;
                    case 'pending':
                        status = 2; break;
                    default: break;
                }

                $('#ticket-form').find('#status-select').val(status)
                Btype.btn_act_save('#ticket-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormBSorderProForm');
            }

            PopupForm1FormBSorderProForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-b-ticket-form .modal-dialog').css('maxWidth', '600px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')


                input_box_reset_for('#ticket-form #frm')
            }

            PopupForm1FormBSorderProForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormBSorderProForm.btn_act_new()
                await PopupForm1FormBSorderProForm.fetch_ticket(Number(id));
            }

            PopupForm1FormBSorderProForm.fetch_ticket = async function (id) {
                let response = await get_api_data('ticket-pick', {
                    Page: [ { Id: id } ]
                })

                Btype.fetch_slip_form_book(response.data.Page[0].TicketNo, 'PopupForm1FormBSorderProForm');
            }

            PopupForm1FormBSorderProForm.update_hd_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    return;
                }
                Btype.set_slip_no_btn_disabled()

                let hd_page = response.data.HdPage[0]
                PopupForm1FormBSorderProForm.bd_page = response.data.BdPage ?? []

                // console.log(hd_page)

                $('#ticket-form').find('#Id').val(hd_page.Id)
                $('#ticket-form').find('#auto-slip-no-txt').val(hd_page.TicketNo)
                $('#ticket-form').find('#subject-txt').val(hd_page.Subject)
                $('#ticket-form').find('#ticket-date').val(moment(new Date(hd_page.CreatedOn * 1000)).format('YYYY-MM-DD HH:mm'))
                $('#ticket-form').find('#content-txt-area').val(hd_page.Content)
                $('#ticket-form').find('#author-name-txt').val(hd_page.NickName)
                $('#ticket-form').find('#mobile-no-txt').val(hd_page.MobileNo)
                $('#ticket-form').find('#email-txt').val(hd_page.Email)
                $('#ticket-form').find('#status-select').val(hd_page.Status)
                $('#remarks-txt-area').val(hd_page.ReplyContent)
            }

            PopupForm1FormBSorderProForm.get_last_slip_no = async function ($this) {
                Btype.set_slip_no_btn_disabled('#ticket-form #auto-slip-no-btn')
                let response = await Btype.get_last_slip_no(PopupForm1FormBSorderProForm.formB['QueryVars']['QueryName']);
                $('#ticket-form').find('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
            }

            PopupForm1FormBSorderProForm.get_parameter = function () {
                const id = Number($('#ticket-form').find('#Id').val())
                let parameter = {
                    Id: id,
                    RepliedOn: get_now_time_stamp(),
                    UserId: window.User['UserId'],
                    Status: $('#ticket-form').find('#status-select').val(),
                    ReplyContent: $('#ticket-form').find('#remarks-txt-area').val(),
                }

                if (id < 0) {
                    parameter = { Id: id }
                }

                // console.log(parameter)
                return parameter;
            }


        }( window.PopupForm1FormBSorderProForm = window.PopupForm1FormBSorderProForm || {}, jQuery ));
    </script>
@endpush
@endonce
