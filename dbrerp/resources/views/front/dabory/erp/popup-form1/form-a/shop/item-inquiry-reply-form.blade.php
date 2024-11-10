{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary item-inquiry-reply-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'item-inquiry-reply-act',
        ])
    </div>
</div>

<div class="card mb-2" id="item-inquiry-reply-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <input type="text" id="sort-txt" readonly class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PostTitle'] }}</label>
                            <input type="text" id="post-title-txt" readonly class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['PostTitle'] }}"
                                {{ $formA['FormVars']['Required']['PostTitle'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PostContents'] }}</label>
                            <textarea id="post-contents-textarea" readonly></textarea>
                        </div>
                        <hr>
                        <div id="replies-html"></div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['WriterName'] }}</label>
                            <input type="text" id="writer-name-txt" class="rounded w-100" autocomplete="off" required
                                   maxlength="{{ $formA['FormVars']['MaxLength']['WriterName'] }}"
                                {{ $formA['FormVars']['Required']['WriterName'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Contents'] }}</label>
                            <textarea id="contents-textarea" required></textarea>
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
                $('.item-inquiry-reply-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAShopItemInquiryReplyForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAShopItemInquiryReplyForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormAShopItemInquiryReplyForm, $, undefined ) {
                PopupForm1FormAShopItemInquiryReplyForm.formA = {!! json_encode($formA) !!};
                PopupForm1FormAShopItemInquiryReplyForm.PostReplies = [];

                PopupForm1FormAShopItemInquiryReplyForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-shop-item-inquiry-reply-form .modal-header').removeClass('bg-grey-700 px-0')
                    $('#modal-select-popup.popup-form1-form-a-shop-item-inquiry-reply-form .modal-header').addClass('bg-original-purple')
                    $('#modal-select-popup.popup-form1-form-a-shop-item-inquiry-reply-form .modal-dialog').css('maxWidth', '600px');

                    Atype.set_parameter_callback(PopupForm1FormAShopItemInquiryReplyForm.parameter);
                    Atype.btn_act_new('#item-inquiry-reply-form #frm');
                    PopupForm1FormAShopItemInquiryReplyForm.PostReplies = []
                    $('#replies-html').html('')
                }

                PopupForm1FormAShopItemInquiryReplyForm.btn_act_new_callback = function () {
                    PopupForm1FormAShopItemInquiryReplyForm.btn_act_new()
                }

                PopupForm1FormAShopItemInquiryReplyForm.parameter = function () {
                    const $item_inquiry_reply_form = $('#item-inquiry-reply-form')

                    let json = {
                        CreatedOn: get_now_time_stamp(),
                        WriterName: $($item_inquiry_reply_form).find('#writer-name-txt').val(),
                        QnaSw: 'A',
                        Contents: $($item_inquiry_reply_form).find('#contents-textarea').val(),
                    }

                    PopupForm1FormAShopItemInquiryReplyForm.PostReplies.push(json)
                    let id = Number($($item_inquiry_reply_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        Status: '1',
                        UserId: window.User['UserId'],
                        PostReplies: PopupForm1FormAShopItemInquiryReplyForm.PostReplies,
                    }
                    if (id < 0) {
                        parameter = { Id: id }
                    }

                    console.log(parameter)
                    return parameter;
                }

                PopupForm1FormAShopItemInquiryReplyForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopItemInquiryReplyForm.parameter);
                    Atype.btn_act_save('#item-inquiry-reply-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopItemInquiryReplyForm');
                }

                PopupForm1FormAShopItemInquiryReplyForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopItemInquiryReplyForm.parameter);
                    Atype.btn_act_del('#item-inquiry-reply-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopItemInquiryReplyForm');
                }

                PopupForm1FormAShopItemInquiryReplyForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAShopItemInquiryReplyForm.btn_act_new()
                    await PopupForm1FormAShopItemInquiryReplyForm.fetch_menu(Number(id));
                }

                PopupForm1FormAShopItemInquiryReplyForm.fetch_menu = async function (id) {
                    let response = await get_api_data(PopupForm1FormAShopItemInquiryReplyForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAShopItemInquiryReplyForm.set_ui(response)
                }

                PopupForm1FormAShopItemInquiryReplyForm.post_replies = function () {
                    let html = ''
                    PopupForm1FormAShopItemInquiryReplyForm.PostReplies.forEach(function (reply) {
                        html += `
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">작성일</label>
                            <input type="text" class="rounded w-100" autocomplete="off"
                                readonly value="${format_conver_for(reply['CreatedOn'], 'unixtime')}">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">작성자 이름</label>
                            <input type="text" class="rounded w-100" autocomplete="off"
                                readonly value="${reply['WriterName']}">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">타입</label>
                            <input type="text" class="rounded w-100" autocomplete="off"
                                readonly value="${reply['QnaSw']}">
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">내용</label>
                            <textarea readonly>${reply['Contents']}</textarea>
                        </div>
                        <hr>
                        `
                    });

                    $('#replies-html').html(html)
                }

                PopupForm1FormAShopItemInquiryReplyForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let item_inquiry_reply = response.data.Page[0];

                    const $item_inquiry_reply_form = $('#item-inquiry-reply-form')

                    $($item_inquiry_reply_form).find('#Id').val(item_inquiry_reply.Id)
                    $($item_inquiry_reply_form).find('#sort-txt').val(item_inquiry_reply.Pc1)
                    $($item_inquiry_reply_form).find('#post-title-txt').val(item_inquiry_reply.PostTitle)
                    $($item_inquiry_reply_form).find('#post-contents-textarea').val(item_inquiry_reply.PostContents)

                    if (item_inquiry_reply['PostReplies']) {
                        PopupForm1FormAShopItemInquiryReplyForm.PostReplies = item_inquiry_reply['PostReplies']
                        PopupForm1FormAShopItemInquiryReplyForm.post_replies()
                    }
                }

            }( window.PopupForm1FormAShopItemInquiryReplyForm = window.PopupForm1FormAShopItemInquiryReplyForm || {}, jQuery ));
        </script>
    @endpush
@endonce
