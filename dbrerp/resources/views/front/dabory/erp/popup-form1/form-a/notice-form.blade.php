{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary notice-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'notice-act',
        ])
    </div>
</div>

<div style="z-index: 1050" id="notice-form">
    <div id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <input class="rounded w-100" type="hidden" id="notice-date">
        <div class="form-group d-flex flex-column mb-2">
            <label class="m-0">{{ $formA['FormVars']['Title']['Subject'] }}</label>
            <input type="text" id="subject-txt" class="rounded w-100" required autocomplete="off">
        </div>
        <div class="form-group" id="modal-memo">
            <label class="m-0">{{ $formA['FormVars']['Title']['NoticeDesc'] }}</label>
            @include('components.web-editor')
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/components/web-editor.js') }}"></script>
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            mediaModal = await include_media_library('media-body', 'post')

            $('.notice-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormANoticeForm.btn_act_save(); break;
                    case 'del': PopupForm1FormANoticeForm.btn_act_del(); break;

                    default: PopupForm1FormANoticeForm.btn_act_for($(this).data('value')); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormANoticeForm, $, undefined ) {
            PopupForm1FormANoticeForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormANoticeForm.btn_act_for = async function (format) {
                Atype.btn_act_for(format, '#notice-form', 'PopupForm1FormANoticeForm')
            }

            PopupForm1FormANoticeForm.btn_act_new_callback = function () {
                PopupForm1FormANoticeForm.btn_act_new()
                Atype.set_parameter_callback(PopupForm1FormANoticeForm.parameter);
            }

            PopupForm1FormANoticeForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormANoticeForm.parameter);
                Atype.btn_act_save('#notice-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormANoticeForm');
            }

            PopupForm1FormANoticeForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormANoticeForm.parameter);
                Atype.btn_act_del('#notice-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormANoticeForm');
            }

            PopupForm1FormANoticeForm.parameter = function () {
                let editor = new FroalaEditor("#notice-form #froala-editor", { key: window.env['FROALA_LICENSE_KEY'], attribution: false });
                let id = Number($('#notice-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    Subject: $('#notice-form').find('#subject-txt').val(),
                    NoticeDate: $('#notice-form').find('#notice-date').val() || moment(new Date()).format('YYYYMMDD'),
                    NoticeDesc: editor.html.get(),
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

            PopupForm1FormANoticeForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                $('#notice-form').find('#notice-date').val('')
                $('#notice-form').find('.fr-view').html('')

                Atype.btn_act_new('#notice-form #frm');
            }

            PopupForm1FormANoticeForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormANoticeForm.btn_act_new()
                await PopupForm1FormANoticeForm.fetch_notice(Number(id));
            }

            PopupForm1FormANoticeForm.fetch_notice = async function (id) {
                let response = await get_api_data(PopupForm1FormANoticeForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormANoticeForm.set_notice_ui(response)
            }

            PopupForm1FormANoticeForm.set_notice_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let notice = response.data.Page[0];

                $('#notice-form').find('#Id').val(notice.Id)

                $('#notice-form').find('#notice-date').val(notice.NoticeDate)
                $('#notice-form').find('#subject-txt').val(notice.Subject)
                $('#notice-form').find('.fr-view').html(notice.NoticeDesc)
            }


        }( window.PopupForm1FormANoticeForm = window.PopupForm1FormANoticeForm || {}, jQuery ));
        let mediaModal;
    </script>
@endpush
@endonce
