{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-seo-meta-form">
    <div class="mb-1 pt-2 text-right btn-groups">
{{--        <div class="btn-group">--}}
{{--            <button type="button" class="btn btn-sm btn-primary seo-meta-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>--}}
{{--                {{ $formB['FormVars']['Title']['SaveButton'] }}--}}
{{--            </button>--}}
{{--            @isset($formB['HeadSelectOptions'])--}}
{{--                @include('front.dabory.erp.partial.select-btn-options', [--}}
{{--                    'selectBtns' => $formB['HeadSelectOptions'],--}}
{{--                    'eventClassName' => 'seo-meta-act',--}}
{{--                ])--}}
{{--            @endisset--}}
{{--        </div>--}}
    </div>

    <div class="card" id="seo-meta-form">
        <input type="hidden" id="Id" name="Id" value="0">

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
{{--                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupSetupFormBSeoMetaForm.seq_no_up_down('#seo-meta-table-body', 'down')"--}}
{{--                            data-clicked="">▼--}}
{{--                    </button>--}}
{{--                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupSetupFormBSeoMetaForm.seq_no_up_down('#seo-meta-table-body', 'up')"--}}
{{--                            data-clicked="">▲--}}
{{--                    </button>--}}
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary seo-meta-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'seo-meta-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row seo-meta-table">
                        <thead id="seo-meta-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="seo-meta-table-body">
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
        $('.seo-meta-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupSetupFormBSeoMetaForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupSetupFormBSeoMetaForm.btn_bd_act_multi_delete('.seo-meta-table'); break;
            }
        });

    });

    (function( PopupSetupFormBSeoMetaForm, $, undefined ) {
        PopupSetupFormBSeoMetaForm.formB = {!! json_encode($formB) !!}
        PopupSetupFormBSeoMetaForm.Items = []

        PopupSetupFormBSeoMetaForm.seq_no_up_down = function (table_id, move) {
            $('#seo-meta-form').find('#down-btn').prop('disabled', true);
            $('#seo-meta-form').find('#up-btn').prop('disabled', true);

            PopupSetupFormBSeoMetaForm.remove_last_item('#seo-meta-table-body')

            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            const up_or_down_val = (move === 'up' ? -1 : 1);
            const temp_bd_page = changeArrayOrder(PopupSetupFormBSeoMetaForm.Items, index, up_or_down_val)
            if (! temp_bd_page) {
                $('#seo-meta-form').find('#down-btn').prop('disabled', false);
                $('#seo-meta-form').find('#up-btn').prop('disabled', false);
                iziToast.error({ title: 'Error', message: $('#action-failed').text() });
                return;
            }

            PopupSetupFormBSeoMetaForm.Items = temp_bd_page
            Btype.btn_act_save('#seo-meta-form #frm', function () {
                PopupSetupFormBSeoMetaForm.btn_act_new()
                PopupSetupFormBSeoMetaForm.create_bd_page()

                const after_index = index + up_or_down_val;
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');

                $('#seo-meta-form').find('#down-btn').prop('disabled', false);
                $('#seo-meta-form').find('#up-btn').prop('disabled', false);
            }, 'PopupSetupFormBSeoMetaForm');

        }

        PopupSetupFormBSeoMetaForm.btn_act_new = function () {
            // table body 초기화
            $('#seo-meta-form').find('#seo-meta-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#seo-meta-form #seo-meta-table-head')
            $('#seo-meta-form').find('#seo-meta-table-body').html('');
        }

        PopupSetupFormBSeoMetaForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupSetupFormBSeoMetaForm.Items[index])
                }
            })

            if (PopupSetupFormBSeoMetaForm.Items.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                data = data.filter(item => ! isEmpty(item['Name']))
                PopupSetupFormBSeoMetaForm.Items = data

                Btype.btn_act_save('#seo-meta-form #frm', function () {
                    PopupSetupFormBSeoMetaForm.btn_act_new()
                    PopupSetupFormBSeoMetaForm.create_bd_page()
                }, 'PopupSetupFormBSeoMetaForm');
            })

        }

        PopupSetupFormBSeoMetaForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupSetupFormBSeoMetaForm.Items.pop();
                $(tr).remove()
            }
        }

        PopupSetupFormBSeoMetaForm.base_struct = function (name) {
            return {
                Name: name,
                Content: ''
            }
        }

        PopupSetupFormBSeoMetaForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupSetupFormBSeoMetaForm')
        }

        PopupSetupFormBSeoMetaForm.save_data_when_entering_text = function () {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            const index = $(tr).prevAll().length
            PopupSetupFormBSeoMetaForm.Items[index] = PopupSetupFormBSeoMetaForm.base_struct(
                $(tr).find('#name-txt').val()
            )
        }

        PopupSetupFormBSeoMetaForm.add_td_last_tap_out = function ($this) {
            PopupSetupFormBSeoMetaForm.Items = PopupSetupFormBSeoMetaForm.Items.filter(item => ! isEmpty(item['Name']))

            const tr = $($this).closest('tr')
            if (isEmpty($(tr).find('#name-txt').val())) {
                iziToast.error({ title: 'Error', message: $('#required-item-omitted').text() });
                return
            }

            Btype.btn_act_save('#seo-meta-form #frm', function () {
                if ($($this).data('last')) {
                    // PopupSetupFormBSeoMetaForm.add_tr();
                    $($this).data('last', false)
                }

                PopupSetupFormBSeoMetaForm.create_bd_page()
            }, 'PopupSetupFormBSeoMetaForm');
        }

        PopupSetupFormBSeoMetaForm.create_bd_page = function () {
            let html
            PopupSetupFormBSeoMetaForm.Items.forEach(bd => {
                html +=
                `<tr>
                    <td class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="PopupSetupFormBSeoMetaForm.add_td_last_tap_out(this)"
                        class="last-td text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBSeoMetaForm.formB.ListVars['Hidden'].Name}
                        >
                        <input type="text" class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].Name} border-0 bg-white" id="name-txt"
                        onfocusout="PopupSetupFormBSeoMetaForm.save_data_when_entering_text()"
                        value="${bd.Name}" disabled required>
                    </td>
                </tr>`
            })

            $('#seo-meta-form').find('#seo-meta-table-body').html(html)
        }

        PopupSetupFormBSeoMetaForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="PopupSetupFormBSeoMetaForm.add_td_last_tap_out(this)" data-last=true
                    class="last-td text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBSeoMetaForm.formB.ListVars['Hidden'].Name}
                    >
                    <input type="text" class="text-${PopupSetupFormBSeoMetaForm.formB.ListVars['Align'].Name} border-0 bg-white"
                    id="name-txt" required
                    onfocusout="PopupSetupFormBSeoMetaForm.save_data_when_entering_text()">
                </td>
            </tr>`

            $('#seo-meta-form').find('#seo-meta-table-body').append(html)

            const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

            $(tr).find('input[name=bd-cursor-state]').trigger('click')
            $(tr).find('#name-txt').focus()

            PopupSetupFormBSeoMetaForm.Items.push(PopupSetupFormBSeoMetaForm.base_struct(''))
        }

        PopupSetupFormBSeoMetaForm.btn_bd_act_add = function () {
            if (Number($('#seo-meta-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() });
            }

            if (! PopupSetupFormBSeoMetaForm.last_item_added_check('#seo-meta-table-body')) {
                PopupSetupFormBSeoMetaForm.add_tr();
            }
        }

        PopupSetupFormBSeoMetaForm.last_item_added_check = function (table_id) {
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

        PopupSetupFormBSeoMetaForm.get_parameter = function () {
            const setup = {
                Metas: PopupSetupFormBSeoMetaForm.Items
            }
            const id = Number($('#seo-meta-form').find('#Id').val());
            let parameter = {
                Id: id,
                SetupJson: JSON.stringify(setup),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter;
        }

        PopupSetupFormBSeoMetaForm.show_popup_callback = async function (id, setup) {
            PopupSetupFormBSeoMetaForm.btn_act_new()
            $('#modal-select-popup.popup-setup-form-b-seo-meta-form .modal-dialog').css('maxWidth', '800px');

            $('#seo-meta-form').find('#Id').val(id)
            PopupSetupFormBSeoMetaForm.set_seo_meta_ui(setup)
        }

        PopupSetupFormBSeoMetaForm.set_seo_meta_ui = function (setup) {
            if (_.isEmpty(setup)) return;

            PopupSetupFormBSeoMetaForm.Items = setup['Metas']
            PopupSetupFormBSeoMetaForm.create_bd_page()
            console.log(PopupSetupFormBSeoMetaForm.Items)
        }
    }( window.PopupSetupFormBSeoMetaForm = window.PopupSetupFormBSeoMetaForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
