{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-member-policy-form">
    <div class="mb-1 pt-2 text-right btn-groups">
{{--        <div class="btn-group">--}}
{{--            <button type="button" class="btn btn-sm btn-primary member-policy-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>--}}
{{--                {{ $formB['FormVars']['Title']['SaveButton'] }}--}}
{{--            </button>--}}
{{--            @isset($formB['HeadSelectOptions'])--}}
{{--                @include('front.dabory.erp.partial.select-btn-options', [--}}
{{--                    'selectBtns' => $formB['HeadSelectOptions'],--}}
{{--                    'eventClassName' => 'member-policy-act',--}}
{{--                ])--}}
{{--            @endisset--}}
{{--        </div>--}}
    </div>

    <div class="card" id="member-policy-form">
        <input type="hidden" id="Id" name="Id" value="0">

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
{{--                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupSetupFormBMemberPolicyForm.seq_no_up_down('#member-policy-table-body', 'down')"--}}
{{--                            data-clicked="">▼--}}
{{--                    </button>--}}
{{--                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupSetupFormBMemberPolicyForm.seq_no_up_down('#member-policy-table-body', 'up')"--}}
{{--                            data-clicked="">▲--}}
{{--                    </button>--}}
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary member-policy-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'member-policy-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row member-policy-table">
                        <thead id="member-policy-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="member-policy-table-body">
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
        $('.member-policy-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupSetupFormBMemberPolicyForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupSetupFormBMemberPolicyForm.btn_bd_act_multi_delete('.member-policy-table'); break;
            }
        });

    });

    (function( PopupSetupFormBMemberPolicyForm, $, undefined ) {
        PopupSetupFormBMemberPolicyForm.formB = {!! json_encode($formB) !!}
        PopupSetupFormBMemberPolicyForm.Items = []

        PopupSetupFormBMemberPolicyForm.seq_no_up_down = function (table_id, move) {
            $('#member-policy-form').find('#down-btn').prop('disabled', true);
            $('#member-policy-form').find('#up-btn').prop('disabled', true);

            PopupSetupFormBMemberPolicyForm.remove_last_item('#member-policy-table-body')

            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            const up_or_down_val = (move === 'up' ? -1 : 1);
            const temp_bd_page = changeArrayOrder(PopupSetupFormBMemberPolicyForm.Items, index, up_or_down_val)
            if (! temp_bd_page) {
                $('#member-policy-form').find('#down-btn').prop('disabled', false);
                $('#member-policy-form').find('#up-btn').prop('disabled', false);
                iziToast.error({ title: 'Error', message: $('#action-failed').text() });
                return;
            }

            PopupSetupFormBMemberPolicyForm.Items = temp_bd_page
            Btype.btn_act_save('#member-policy-form #frm', function () {
                PopupSetupFormBMemberPolicyForm.btn_act_new()
                PopupSetupFormBMemberPolicyForm.create_bd_page()

                const after_index = index + up_or_down_val;
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');

                $('#member-policy-form').find('#down-btn').prop('disabled', false);
                $('#member-policy-form').find('#up-btn').prop('disabled', false);
            }, 'PopupSetupFormBMemberPolicyForm');

        }

        PopupSetupFormBMemberPolicyForm.btn_act_new = function () {
            // table body 초기화
            $('#member-policy-form').find('#member-policy-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#member-policy-form #member-policy-table-head')
            $('#member-policy-form').find('#member-policy-table-body').html('');
        }

        PopupSetupFormBMemberPolicyForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupSetupFormBMemberPolicyForm.Items[index])
                }
            })

            if (PopupSetupFormBMemberPolicyForm.Items.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                PopupSetupFormBMemberPolicyForm.Items = data

                Btype.btn_act_save('#member-policy-form #frm', function () {
                    PopupSetupFormBMemberPolicyForm.btn_act_new()
                    PopupSetupFormBMemberPolicyForm.create_bd_page()
                }, 'PopupSetupFormBMemberPolicyForm');
            })

        }

        PopupSetupFormBMemberPolicyForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupSetupFormBMemberPolicyForm.Items.pop();
                $(tr).remove()
            }
        }

        PopupSetupFormBMemberPolicyForm.base_struct = function (policy_title, slug, isnt_used) {
            return {
                PolicyTitle: policy_title,
                Slug: slug ?? '',
                IsntUsed: isnt_used ?? false,
            }
        }

        PopupSetupFormBMemberPolicyForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupSetupFormBMemberPolicyForm')
        }

        PopupSetupFormBMemberPolicyForm.save_data_when_entering_text = function () {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            const index = $(tr).prevAll().length
            PopupSetupFormBMemberPolicyForm.Items[index] = PopupSetupFormBMemberPolicyForm.base_struct(
                $(tr).find('#policy-title-txt').val(), $(tr).find('#slug-txt').val(), $(tr).find('#isnt-used-check').prop('checked')
            )
        }

        PopupSetupFormBMemberPolicyForm.add_td_last_tap_out = function ($this) {
            Btype.btn_act_save('#member-policy-form #frm', function () {
                const tr = $($this).closest('tr')
                $(tr).find('td').data('last', false)
            }, 'PopupSetupFormBMemberPolicyForm');
        }

        PopupSetupFormBMemberPolicyForm.create_bd_page = function () {
            let html
            PopupSetupFormBMemberPolicyForm.Items.forEach(bd => {
                html +=
                `<tr>
                    <td class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].IsntUsed}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].IsntUsed}
                        >
                        <input type="checkbox" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].IsntUsed} border-0 bg-white" id="isnt-used-check"
                        ${bd.IsntUsed ? 'checked' : ''}
                        onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()" disabled>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].PolicyTitle}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].PolicyTitle}
                        >
                        <input type="text" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].PolicyTitle} border-0 bg-white" id="policy-title-txt"
                        onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()"
                        value="${bd.PolicyTitle}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].Slug}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].Slug}
                        >
                        <input type="text" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].Slug} border-0 bg-white" id="slug-txt"
                        onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()"
                        value="${bd.Slug}" disabled>
                    </td>
                    <td class="last-td">
                        <button type="button" class="py-1 px-2" onclick="PopupSetupFormBMemberPolicyForm.add_td_last_tap_out(this)">저장</button>
                    </td>
                </tr>`
            })

            $('#member-policy-form').find('#member-policy-table-body').append(html)
        }

        PopupSetupFormBMemberPolicyForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].IsntUsed}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].IsntUsed}
                    >
                    <input type="checkbox" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].IsntUsed} border-0 bg-white" id="isnt-used-check" value="1"
                    onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].PolicyTitle}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].PolicyTitle}
                    >
                    <input type="text" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].PolicyTitle} border-0 bg-white" id="policy-title-txt"
                    onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].Slug}" ${PopupSetupFormBMemberPolicyForm.formB.ListVars['Hidden'].Slug}
                    >
                    <input type="text" class="text-${PopupSetupFormBMemberPolicyForm.formB.ListVars['Align'].Slug} border-0 bg-white" id="slug-txt"
                    onfocusout="PopupSetupFormBMemberPolicyForm.save_data_when_entering_text()"
                    required>
                </td>
                <td class="last-td" data-last=true>
                    <button type="button" class="py-1 px-2" onclick="PopupSetupFormBMemberPolicyForm.add_td_last_tap_out(this)">저장</button>
                </td>
            </tr>`

            $('#member-policy-form').find('#member-policy-table-body').append(html)

            const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

            $(tr).find('input[name=bd-cursor-state]').trigger('click')
            $(tr).find('#item-code-txt').focus()

            PopupSetupFormBMemberPolicyForm.Items.push(PopupSetupFormBMemberPolicyForm.base_struct(''))
        }

        PopupSetupFormBMemberPolicyForm.btn_bd_act_add = function () {
            if (Number($('#member-policy-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() });
            }

            if (! PopupSetupFormBMemberPolicyForm.last_item_added_check('#member-policy-table-body')) {
                PopupSetupFormBMemberPolicyForm.add_tr();
            }
        }

        PopupSetupFormBMemberPolicyForm.last_item_added_check = function (table_id) {
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

        PopupSetupFormBMemberPolicyForm.get_parameter = function () {
            const setup = {
                Policies: PopupSetupFormBMemberPolicyForm.Items
            }
            const id = Number($('#member-policy-form').find('#Id').val());
            let parameter = {
                Id: id,
                SetupJson: JSON.stringify(setup),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            return parameter;
        }

        PopupSetupFormBMemberPolicyForm.show_popup_callback = async function (id, setup) {
            PopupSetupFormBMemberPolicyForm.btn_act_new()
            $('#modal-select-popup.popup-setup-form-b-member-policy-form .modal-dialog').css('maxWidth', '800px');

            $('#member-policy-form').find('#Id').val(id)
            PopupSetupFormBMemberPolicyForm.set_item_input_shortcut_ui(setup)
        }

        PopupSetupFormBMemberPolicyForm.set_item_input_shortcut_ui = function (setup) {
            if (_.isEmpty(setup)) return;

            PopupSetupFormBMemberPolicyForm.Items = setup['Policies']
            PopupSetupFormBMemberPolicyForm.create_bd_page()
            // console.log(PopupSetupFormBMemberPolicyForm.Items)
        }
    }( window.PopupSetupFormBMemberPolicyForm = window.PopupSetupFormBMemberPolicyForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
