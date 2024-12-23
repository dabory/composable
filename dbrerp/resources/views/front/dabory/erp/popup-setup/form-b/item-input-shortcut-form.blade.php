{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-item-input-shortcut-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" hidden
                class="btn-open-modal PopupSetupFormBItemInputShortcutForm item-modal-btn"
                data-target="item"
                data-clicked="PopupSetupFormBItemInputShortcutForm.override_get_item_id"
                data-variable="PopupSetupFormBItemInputShortcutForm.itemModal">
        </button>

        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary item-input-shortcut-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formB['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formB['HeadSelectOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['HeadSelectOptions'],
                    'eventClassName' => 'item-input-shortcut-act',
                ])
            @endisset
        </div>
    </div>

    <div class="card" id="item-input-shortcut-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 90px">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['DiscountItem'] }}</label>
                                <div class="d-flex">
                                    <input type="text" id="discount-item-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['DiscountItem'] }}"
                                        {{ $formB['FormVars']['Required']['DiscountItem'] }}>
                                    <button type="button"
                                            class="btn-dark rounditem-input-shortcut-formed btn-open-modal border-0 radius-l0 col-3"
                                            onclick="$('#modal-item.item-input-shortcut input').val('')"
                                            data-target="item"
                                            data-class="item-input-shortcut"
                                            data-clicked="PopupSetupFormBItemInputShortcutForm.get_discount_item_code"
                                            data-variable="PopupSetupFormBItemInputShortcutForm.itemModal">
                                        <i class="icon-folder-open"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupSetupFormBItemInputShortcutForm.seq_no_up_down('#item-input-shortcut-table-body', 'down')"
                            data-clicked="">▼
                    </button>
                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupSetupFormBItemInputShortcutForm.seq_no_up_down('#item-input-shortcut-table-body', 'up')"
                            data-clicked="">▲
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary item-input-shortcut-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'item-input-shortcut-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row item-input-shortcut-table">
                        <thead id="item-input-shortcut-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="item-input-shortcut-table-body">
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
        $('.item-input-shortcut-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': PopupSetupFormBItemInputShortcutForm.btn_act_save(); break;
                case 'preview': PopupSetupFormBItemInputShortcutForm.btn_act_preview(); break;
            }
        });

        $('.item-input-shortcut-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupSetupFormBItemInputShortcutForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupSetupFormBItemInputShortcutForm.btn_bd_act_multi_delete('.item-input-shortcut-table'); break;
            }
        });

        PopupSetupFormBItemInputShortcutForm.include_blades()
    });

    (function( PopupSetupFormBItemInputShortcutForm, $, undefined ) {
        PopupSetupFormBItemInputShortcutForm.formB = {!! json_encode($formB) !!}
        PopupSetupFormBItemInputShortcutForm.FrequentItems = []
        PopupSetupFormBItemInputShortcutForm.itemModal

        PopupSetupFormBItemInputShortcutForm.btn_act_preview = async function () {
            PopupSetupFormBItemInputShortcutForm.remove_last_item('#item-input-shortcut-table-body')

            const shortcut_input = await get_para_data('modal', '/search/item-shortcut-input-preview')
            const shortcut_input_modal = shortcut_input['data']
            shortcut_input_modal['ItemInputShortcutSetup'] = {
                DiscountItem: PopupSetupFormBItemInputShortcutForm.item_base_struct(
                    $('#item-input-shortcut-form').find('#discount-item-txt').val(),
                ),
                FrequentItems: PopupSetupFormBItemInputShortcutForm.FrequentItems
            }

            // item-shortcut-input
            get_blades_html('front.outline.static.item-shortcut-input', shortcut_input_modal, function (html) {
                if ($('#element_in_which_to_insert').find('#modal-item-shortcut-input').length) {
                    $('#element_in_which_to_insert').find('#modal-item-shortcut-input').remove()
                }
                $('#element_in_which_to_insert').append(html);
                $('#modal-item-shortcut-input').modal('show')
            });

        }

        PopupSetupFormBItemInputShortcutForm.seq_no_up_down = function (table_id, move) {
            $('#item-input-shortcut-form').find('#down-btn').prop('disabled', true);
            $('#item-input-shortcut-form').find('#up-btn').prop('disabled', true);

            PopupSetupFormBItemInputShortcutForm.remove_last_item('#item-input-shortcut-table-body')

            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            const up_or_down_val = (move === 'up' ? -1 : 1);
            const temp_bd_page = changeArrayOrder(PopupSetupFormBItemInputShortcutForm.FrequentItems, index, up_or_down_val)
            if (! temp_bd_page) {
                iziToast.error({ title: 'Error', message: $('#action-failed').text() });
                $('#item-input-shortcut-form').find('#down-btn').prop('disabled', false);
                $('#item-input-shortcut-form').find('#up-btn').prop('disabled', false);
                return;
            }

            PopupSetupFormBItemInputShortcutForm.FrequentItems = temp_bd_page
            Btype.btn_act_save('#item-input-shortcut-form #frm', function () {
                PopupSetupFormBItemInputShortcutForm.btn_act_new()
                PopupSetupFormBItemInputShortcutForm.create_bd_page()

                const after_index = index + up_or_down_val;
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');

                $('#item-input-shortcut-form').find('#down-btn').prop('disabled', false);
                $('#item-input-shortcut-form').find('#up-btn').prop('disabled', false);
            }, 'PopupSetupFormBItemInputShortcutForm');

        }

        PopupSetupFormBItemInputShortcutForm.btn_act_new = function () {
            // table body 초기화
            $('#item-input-shortcut-form').find('#item-input-shortcut-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#item-input-shortcut-form #item-input-shortcut-table-head')
            $('#item-input-shortcut-form').find('#item-input-shortcut-table-body').html('');
        }

        PopupSetupFormBItemInputShortcutForm.btn_act_save = function () {
            PopupSetupFormBItemInputShortcutForm.remove_last_item('#item-input-shortcut-table-body')

            Btype.btn_act_save('#item-input-shortcut-form #frm', function () {
                $('#modal-select-popup.show').trigger('list.requery')
                // $('#modal-select-popup.show').modal('hide');
            }, 'PopupSetupFormBItemInputShortcutForm');
        }

        PopupSetupFormBItemInputShortcutForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupSetupFormBItemInputShortcutForm.FrequentItems[index])
                }
            })

            if (PopupSetupFormBItemInputShortcutForm.FrequentItems.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                PopupSetupFormBItemInputShortcutForm.FrequentItems = data

                Btype.btn_act_save('#item-input-shortcut-form #frm', function () {
                    PopupSetupFormBItemInputShortcutForm.btn_act_new()
                    PopupSetupFormBItemInputShortcutForm.create_bd_page()
                }, 'PopupSetupFormBItemInputShortcutForm');
            })

        }

        PopupSetupFormBItemInputShortcutForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupSetupFormBItemInputShortcutForm.FrequentItems.pop();
                $(tr).remove()
            }
        }

        PopupSetupFormBItemInputShortcutForm.item_base_struct = function (item_code, button_cation, basic_qty) {
            return {
                ItemCode: item_code,
                ButtonCation: button_cation ?? '',
                BasicQty: basic_qty ?? '',
            }
        }

        PopupSetupFormBItemInputShortcutForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupSetupFormBItemInputShortcutForm')
        }

        PopupSetupFormBItemInputShortcutForm.set_item_data_to_textbox = function (item) {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).find('#item-code-txt').val(item.ItemCode)
            $(tr).find('#button-cation-txt').val(item.ItemName)
            $(tr).find('#basic-qty-txt').val(1)
            $(tr).find('#basic-price-txt').text(format_conver_for(item.SalesPrc, PopupSetupFormBItemInputShortcutForm.formB.ListVars['Format'].BasicPrice))

            const index = $(tr).prevAll().length;
            PopupSetupFormBItemInputShortcutForm.FrequentItems[index] = PopupSetupFormBItemInputShortcutForm.item_base_struct(item.ItemCode, item.ItemName, 1)

            return $(tr).find('#button-cation-txt')
        }

        PopupSetupFormBItemInputShortcutForm.save_data_when_entering_text = function () {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            const index = $(tr).prevAll().length
            PopupSetupFormBItemInputShortcutForm.FrequentItems[index] = PopupSetupFormBItemInputShortcutForm.item_base_struct(
                $(tr).find('#item-code-txt').val(), $(tr).find('#button-cation-txt').val(), $(tr).find('#basic-qty-txt').val()
            )
        }

        PopupSetupFormBItemInputShortcutForm.add_td_last_tap_out = function ($this) {
            Btype.btn_act_save('#item-input-shortcut-form #frm', function () {
                if ($($this).data('last')) {
                    PopupSetupFormBItemInputShortcutForm.add_tr();
                    $($this).data('last', false)
                }
            }, 'PopupSetupFormBItemInputShortcutForm');
        }

        PopupSetupFormBItemInputShortcutForm.create_bd_page = function () {
            let html
            PopupSetupFormBItemInputShortcutForm.FrequentItems.forEach(bd => {
                html +=
                    `<tr>
                    <td class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.enterPressedinCell(event, 1, 'PopupSetupFormBItemInputShortcutForm')"
                        class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ItemCode}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].ItemCode}
                        >
                        <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ItemCode} border-0 bg-white"
                        id="item-code-txt" value="${bd.ItemCode}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ButtonCation}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].ButtonCation}
                        >
                        <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ButtonCation} border-0 bg-white" id="button-cation-txt"
                        onfocusout="PopupSetupFormBItemInputShortcutForm.save_data_when_entering_text()"
                        value="${bd.ButtonCation}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        onfocusout="PopupSetupFormBItemInputShortcutForm.add_td_last_tap_out(this)"
                        class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicQty} last-td" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].BasicQty}
                        >
                        <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicQty} border-0 bg-white" id="basic-qty-txt"
                        onfocusout="PopupSetupFormBItemInputShortcutForm.save_data_when_entering_text()"
                        value="${bd.BasicQty}" disabled required>
                    </td>
                </tr>`
                    // <td
                    //     class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicPrice}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].BasicPrice}
                    //     id="basic-price-txt">
                    // </td>
            })

            $('#item-input-shortcut-form').find('#item-input-shortcut-table-body').append(html)
        }

        PopupSetupFormBItemInputShortcutForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.enterPressedinCell(event, 1, 'PopupSetupFormBItemInputShortcutForm')"
                    class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ItemCode}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].ItemCode}
                    >
                    <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ItemCode} border-0 bg-white" id="item-code-txt" required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ButtonCation}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].ButtonCation}
                    >
                    <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].ButtonCation} border-0 bg-white" id="button-cation-txt"
                    onfocusout="PopupSetupFormBItemInputShortcutForm.save_data_when_entering_text()"
                    required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    data-last=true onfocusout="PopupSetupFormBItemInputShortcutForm.add_td_last_tap_out(this)"
                    class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicQty} last-td" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].BasicQty}
                    >
                    <input type="text" class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicQty} border-0 bg-white" id="basic-qty-txt"
                    onfocusout="PopupSetupFormBItemInputShortcutForm.save_data_when_entering_text()"
                    required>
                </td>
            </tr>`
                // <td
                //     class="text-${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Align'].BasicPrice}" ${PopupSetupFormBItemInputShortcutForm.formB.ListVars['Hidden'].BasicPrice}
                //     id="basic-price-txt">
                // </td>

            $('#item-input-shortcut-form').find('#item-input-shortcut-table-body').append(html)

            const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

            $(tr).find('input[name=bd-cursor-state]').trigger('click')
            $(tr).find('#item-code-txt').focus()

            PopupSetupFormBItemInputShortcutForm.FrequentItems.push(PopupSetupFormBItemInputShortcutForm.item_base_struct(''))
        }

        PopupSetupFormBItemInputShortcutForm.btn_bd_act_add = function () {
            if (Number($('#item-input-shortcut-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                return
            }

            if (! PopupSetupFormBItemInputShortcutForm.last_item_added_check('#item-input-shortcut-table-body')) {
                PopupSetupFormBItemInputShortcutForm.add_tr()
            }
        }

        PopupSetupFormBItemInputShortcutForm.last_item_added_check = function (table_id) {
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

        PopupSetupFormBItemInputShortcutForm.get_parameter = function () {
            const setup = {
                DiscountItem: PopupSetupFormBItemInputShortcutForm.item_base_struct(
                    $('#item-input-shortcut-form').find('#discount-item-txt').val(),
                ),
                FrequentItems: PopupSetupFormBItemInputShortcutForm.FrequentItems
            }
            const id = Number($('#item-input-shortcut-form').find('#Id').val());
            let parameter = {
                Id: id,
                SetupJson: JSON.stringify(setup),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            return parameter;
        }

        PopupSetupFormBItemInputShortcutForm.get_discount_item_code = async function (id) {
            const response = await get_api_data('item-pick', {
                Page: [ { Id: id } ]
            })

            $('#item-input-shortcut-form').find('#discount-item-txt').val(response.data.Page[0]['ItemCode'])
            $('#modal-item.show').modal('hide')
        }

        PopupSetupFormBItemInputShortcutForm.include_blades = async function() {
            const item = await get_para_data('modal', '/search/item-search/item')
            PopupSetupFormBItemInputShortcutForm.itemModal = item['data']

            get_blades_html('front.outline.static.item', PopupSetupFormBItemInputShortcutForm.itemModal, function (html) {
                if ($('#element_in_which_to_insert').find('#modal-item').length) return;
                $('#element_in_which_to_insert').append(html);
            }, 'moealSetFile', { modalClassName: 'item-input-shortcut' });
        }

        PopupSetupFormBItemInputShortcutForm.show_popup_callback = async function (id, setup) {
            PopupSetupFormBItemInputShortcutForm.btn_act_new()
            $('#modal-select-popup.popup-setup-form-b-item-input-shortcut-form .modal-dialog').css('maxWidth', '800px');

            $('#item-input-shortcut-form').find('#Id').val(id)
            PopupSetupFormBItemInputShortcutForm.set_item_input_shortcut_ui(setup)
        }

        PopupSetupFormBItemInputShortcutForm.set_item_input_shortcut_ui = function (setup) {
            if (_.isEmpty(setup)) return;

            $('#item-input-shortcut-form').find('#discount-item-txt').val(setup['DiscountItem']['ItemCode'])

            PopupSetupFormBItemInputShortcutForm.FrequentItems = setup['FrequentItems']
            PopupSetupFormBItemInputShortcutForm.create_bd_page()
            // console.log(PopupSetupFormBItemInputShortcutForm.FrequentItems)
        }
    }( window.PopupSetupFormBItemInputShortcutForm = window.PopupSetupFormBItemInputShortcutForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
