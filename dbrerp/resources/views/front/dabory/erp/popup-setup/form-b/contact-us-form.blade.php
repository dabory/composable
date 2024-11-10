{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-contact-us-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary contact-us-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formB['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formB['HeadSelectOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['HeadSelectOptions'],
                    'eventClassName' => 'contact-us-act',
                ])
            @endisset
        </div>
    </div>

    <div class="card" id="contact-us-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="card-header-item d-flex">
                <div class="card col-4 card card-primary mb-3 mb-md-2 mb-lg-0 border-light mr-2">
                    <div class="card-header p-0 mb-2">
                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0 ">{{ $formB['FormVars']['Title']['ToMail'] }}</label>
                            <textarea type="text" id="to-mail-txt" data-id="0" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['ToMail'] }}"
                                {{ $formB['FormVars']['Required']['ToMail'] }}></textarea>
                        </div>
                    </div>
                </div>

                <div class="card col-4 card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="align-items-center {{ $formB['FormVars']['Display']['OkMobile'] }} mb-2">
                            <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="ok-mobile-check" onchange="PopupSetupFormBContactUsForm.change_ok_mobile(this)">
                            <label class="mb-0" for="ok-mobile-check">{{ $formB['FormVars']['Title']['OkMobile'] }}</label>
                        </div>

                        <div class="form-group flex-column mb-2" style="display: none;" id="to-mobile-div">
                            <label class="m-0 ">{{ $formB['FormVars']['Title']['ToMobile'] }}</label>
                            <textarea type="text" id="to-mobile-txt" data-id="0" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formB['FormVars']['MaxLength']['ToMobile'] }}"
                                {{ $formB['FormVars']['Required']['ToMobile'] }}></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
{{--                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupSetupFormBContactUsForm.seq_no_up_down('#contact-us-table-body', 'down')"--}}
{{--                            data-clicked="">▼--}}
{{--                    </button>--}}
{{--                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupSetupFormBContactUsForm.seq_no_up_down('#contact-us-table-body', 'up')"--}}
{{--                            data-clicked="">▲--}}
{{--                    </button>--}}
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary contact-us-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'contact-us-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row contact-us-table">
                        <thead id="contact-us-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="contact-us-table-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@endsection--}}

@once
{{--@push('js')--}}
{{--<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>--}}
    <script>
    $(document).ready(async function() {
        $('.contact-us-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': PopupSetupFormBContactUsForm.btn_act_save(); break;
            }
        });

        $('.contact-us-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupSetupFormBContactUsForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupSetupFormBContactUsForm.btn_bd_act_multi_delete('.contact-us-table'); break;
            }
        });

    });

    (function( PopupSetupFormBContactUsForm, $, undefined ) {
        PopupSetupFormBContactUsForm.formB = {!! json_encode($formB) !!}
        PopupSetupFormBContactUsForm.Items = []

        PopupSetupFormBContactUsForm.change_ok_mobile = function (self) {
            if ($(self).prop('checked')) {
                $('#contact-us-form').find('#to-mobile-div').show()
            } else {
                $('#contact-us-form').find('#to-mobile-div').hide()
            }
        }

        PopupSetupFormBContactUsForm.btn_act_save = function () {
            PopupSetupFormBContactUsForm.remove_last_item('#contact-us-table-body')

            Btype.btn_act_save('#contact-us-form #frm', function () {
                $('#modal-select-popup.show').trigger('list.requery')
                // $('#modal-select-popup.show').modal('hide');
            }, 'PopupSetupFormBContactUsForm');
        }

        PopupSetupFormBContactUsForm.seq_no_up_down = function (table_id, move) {
            $('#contact-us-form').find('#down-btn').prop('disabled', true);
            $('#contact-us-form').find('#up-btn').prop('disabled', true);

            PopupSetupFormBContactUsForm.remove_last_item('#contact-us-table-body')

            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            const up_or_down_val = (move === 'up' ? -1 : 1);
            const temp_bd_page = changeArrayOrder(PopupSetupFormBContactUsForm.Items, index, up_or_down_val)
            if (! temp_bd_page) {
                $('#contact-us-form').find('#down-btn').prop('disabled', false);
                $('#contact-us-form').find('#up-btn').prop('disabled', false);
                iziToast.error({ title: 'Error', message: $('#action-failed').text() });
                return;
            }

            PopupSetupFormBContactUsForm.Items = temp_bd_page
            Btype.btn_act_save('#contact-us-form #frm', function () {
                PopupSetupFormBContactUsForm.btn_act_new()
                PopupSetupFormBContactUsForm.create_bd_page()

                const after_index = index + up_or_down_val;
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');

                $('#contact-us-form').find('#down-btn').prop('disabled', false);
                $('#contact-us-form').find('#up-btn').prop('disabled', false);
            }, 'PopupSetupFormBContactUsForm');

        }

        PopupSetupFormBContactUsForm.btn_act_new = function () {
            // table body 초기화
            $('#contact-us-form').find('#contact-us-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#contact-us-form #contact-us-table-head')
            $('#contact-us-form').find('#contact-us-table-body').html('');
        }

        PopupSetupFormBContactUsForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupSetupFormBContactUsForm.Items[index])
                }
            })

            if (PopupSetupFormBContactUsForm.Items.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                PopupSetupFormBContactUsForm.Items = data

                Btype.btn_act_save('#contact-us-form #frm', function () {
                    PopupSetupFormBContactUsForm.btn_act_new()
                    PopupSetupFormBContactUsForm.create_bd_page()
                }, 'PopupSetupFormBContactUsForm');
            })

        }

        PopupSetupFormBContactUsForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupSetupFormBContactUsForm.Items.pop();
                $(tr).remove()
            }
        }

        PopupSetupFormBContactUsForm.base_struct = function (name, caption, type, required) {
            return {
                Name: name,
                Caption: caption,
                Type: type,
                Required: required,
            }
        }

        PopupSetupFormBContactUsForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupSetupFormBContactUsForm')
        }

        PopupSetupFormBContactUsForm.save_data_when_entering_text = function () {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            const index = $(tr).prevAll().length
            PopupSetupFormBContactUsForm.Items[index] = PopupSetupFormBContactUsForm.base_struct(
                $(tr).find('#name-txt').val(), $(tr).find('#caption-txt').val(),
                $(tr).find('#type-select').val(), $(tr).find('#required-check').prop('checked')
            )
        }

        PopupSetupFormBContactUsForm.add_td_last_tap_out = function ($this) {
            Btype.btn_act_save('#contact-us-form #frm', function () {
                const tr = $($this).closest('tr')
                $(tr).find('td').data('last', false)
            }, 'PopupSetupFormBContactUsForm');
        }

        PopupSetupFormBContactUsForm.make_type_select = function (bd_type) {
            let html = ''
            const type_list = ['text', 'textarea', 'tel', 'checkbox', 'email', 'date']

            type_list.forEach(type => {
                html += `<option value="${type}" ${type === bd_type ? 'selected' : ''}>${type}</option>`
            })

            return html
        }

        PopupSetupFormBContactUsForm.create_bd_page = function () {
            let html
            PopupSetupFormBContactUsForm.Items.forEach(bd => {
                html +=
                `<tr>
                    <td class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Name}
                        >
                        <input type="text" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Name} border-0 bg-white" id="name-txt"
                        onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()"
                        value="${bd.Name}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Caption}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Caption}
                        >
                        <input type="text" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Caption} border-0 bg-white" id="caption-txt"
                        onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()"
                        value="${bd.Caption}" disabled>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Type}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Type}
                        >
                        <select class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Type} w-100 border-0 bg-white" id="type-select"
                            onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()" disabled>
                            ${PopupSetupFormBContactUsForm.make_type_select(bd.Type)}
                        </select>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Required}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Required}
                        >
                        <input type="checkbox" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Required} border-0 bg-white" id="required-check"
                        onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()" ${bd.Required ? 'checked' : ''} disabled>
                    </td>
                    <td class="last-td">
                        <button type="button" class="py-1 px-2" onclick="PopupSetupFormBContactUsForm.add_td_last_tap_out(this)">저장</button>
                    </td>
                </tr>`
            })

            $('#contact-us-form').find('#contact-us-table-body').append(html)
        }

        PopupSetupFormBContactUsForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Name}
                    >
                    <input type="text" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Name} border-0 bg-white" id="name-txt"
                    onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Caption}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Caption}
                    >
                    <input type="text" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Caption} border-0 bg-white" id="caption-txt"
                    onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Type}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Type}
                        >
                        <select class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Type} w-100 border-0 bg-white" id="type-select"
                            onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()" disabled>
                            ${PopupSetupFormBContactUsForm.make_type_select('')}
                        </select>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Required}" ${PopupSetupFormBContactUsForm.formB.ListVars['Hidden'].Required}
                        >
                        <input type="checkbox" class="text-${PopupSetupFormBContactUsForm.formB.ListVars['Align'].Required} border-0 bg-white" id="required-check"
                        onfocusout="PopupSetupFormBContactUsForm.save_data_when_entering_text()" disabled>
                    </td>

                <td class="last-td" data-last=true>
                    <button type="button" class="py-1 px-2" onclick="PopupSetupFormBContactUsForm.add_td_last_tap_out(this)">저장</button>
                </td>
            </tr>`

            $('#contact-us-form').find('#contact-us-table-body').append(html)

            const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

            $(tr).find('input[name=bd-cursor-state]').trigger('click')
            $(tr).find('#item-code-txt').focus()

            PopupSetupFormBContactUsForm.Items.push(PopupSetupFormBContactUsForm.base_struct('', '', '', ''))
        }

        PopupSetupFormBContactUsForm.btn_bd_act_add = function () {
            if (Number($('#contact-us-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() });
            }

            if (! PopupSetupFormBContactUsForm.last_item_added_check('#contact-us-table-body')) {
                PopupSetupFormBContactUsForm.add_tr();
            }
        }

        PopupSetupFormBContactUsForm.last_item_added_check = function (table_id) {
            const tr = $(`${table_id} tr:last`);
            const index = $(`${table_id} tr`).length;
            const table = $(table_id).closest('table');

            if (index > 0 && $(tr).find('.last-td').data('last')) {
                $(tr).children(`td:eq(0)`).find('input').prop('checked', true);
                $(tr).children(`td:eq(0)`).find('input').trigger('click');
                $(tr).children(`td:eq(${Btype.get_first_required_th_index(table)})`).find('input').focus();
                iziToast.error({ title: 'Error', message: $('#finish-editting-in-the-last-item-line').text() });
                return true;
            }
            return false;
        }

        PopupSetupFormBContactUsForm.get_parameter = function () {
            const setup = {
                ToMail: $('#contact-us-form').find('#to-mail-txt').val(),
                OkMobile: $('#contact-us-form').find('#ok-mobile-check').prop('checked'),
                ToMobile: $('#contact-us-form').find('#to-mobile-txt').val(),
                Fields: PopupSetupFormBContactUsForm.Items
            }
            const id = Number($('#contact-us-form').find('#Id').val());
            let parameter = {
                Id: id,
                SetupJson: JSON.stringify(setup),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            return parameter;
        }

        PopupSetupFormBContactUsForm.show_popup_callback = async function (id, setup) {
            PopupSetupFormBContactUsForm.btn_act_new()
            $('#modal-select-popup.popup-setup-form-b-contact-us-form .modal-dialog').css('maxWidth', '800px');

            $('#contact-us-form').find('#Id').val(id)
            PopupSetupFormBContactUsForm.set_item_input_shortcut_ui(setup)
        }

        PopupSetupFormBContactUsForm.set_item_input_shortcut_ui = function (setup) {
            if (_.isEmpty(setup)) return;

            $('#contact-us-form').find('#to-mail-txt').val(setup['ToMail'])
            $('#contact-us-form').find('#ok-mobile-check').prop('checked', setup['OkMobile'] ?? false)
            $('#contact-us-form').find('#to-mobile-txt').val(setup['ToMobile'])
            PopupSetupFormBContactUsForm.Items = setup['Fields']

            PopupSetupFormBContactUsForm.change_ok_mobile($('#contact-us-form').find('#ok-mobile-check'))
            PopupSetupFormBContactUsForm.create_bd_page()
            // console.log(PopupSetupFormBContactUsForm.Items)
        }
    }( window.PopupSetupFormBContactUsForm = window.PopupSetupFormBContactUsForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
