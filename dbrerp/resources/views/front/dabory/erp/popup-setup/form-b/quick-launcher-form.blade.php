{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-quick-launcher-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" hidden
                class="btn-open-modal PopupSetupFormBQuickLauncherForm item-modal-btn"
                data-target="item"
                data-clicked="PopupSetupFormBQuickLauncherForm.override_get_item_id"
                data-variable="PopupSetupFormBQuickLauncherForm.itemModal">
        </button>

        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary quick-launcher-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formB['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formB['HeadSelectOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['HeadSelectOptions'],
                    'eventClassName' => 'quick-launcher-act',
                ])
            @endisset
        </div>
    </div>

    <div class="card" id="quick-launcher-form">
        <div class="card-header px-2" id="frm">
            <div class="col-6">
                <div class="card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 90px">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['Type'] }}</label>
                                <select id="type-select" class="rounded w-100">
                                    <option value="right-floating">right-floating</option>
                                    <option value="right-attached">right-attached</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupSetupFormBQuickLauncherForm.seq_no_up_down('#quick-launcher-table-body', 'down')"
                            data-clicked="">▼
                    </button>
                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupSetupFormBQuickLauncherForm.seq_no_up_down('#quick-launcher-table-body', 'up')"
                            data-clicked="">▲
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary quick-launcher-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                            @include('front.dabory.erp.partial.select-btn-options', [
                                'selectBtns' => $formB['BodySelectOptions'],
                                'eventClassName' => 'quick-launcher-bd-act'
                            ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row quick-launcher-table">
                        <thead id="quick-launcher-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="quick-launcher-table-body">
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
            $('.quick-launcher-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormBQuickLauncherForm.btn_act_save(); break;
                }
            });

            $('.quick-launcher-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': PopupSetupFormBQuickLauncherForm.btn_bd_act_add(); break;
                    case 'multi-delete': PopupSetupFormBQuickLauncherForm.btn_bd_act_multi_delete('.quick-launcher-table'); break;
                }
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                $(unique_key).val(window.env['MEDIA_URL'] + file_url_list[0])
            });

        });

        (function( PopupSetupFormBQuickLauncherForm, $, undefined ) {
            PopupSetupFormBQuickLauncherForm.formB = {!! json_encode($formB) !!}
            PopupSetupFormBQuickLauncherForm.Items = []

            PopupSetupFormBQuickLauncherForm.upload_file = function ($this) {
                PopupForm1FormBMediaForm.btn_act_new()

                $('#modal-media').data('target-id', '')
                const target_id = '#' + $($this).closest('.form-group').find('input').attr('id')
                $('#modal-media').data('unique-key', target_id)
                $('#modal-media-btn').data('target', 'media')
                $('#modal-media-btn').data('variable', mediaModal)
                $('#modal-media-btn').trigger('click')
            }

            PopupSetupFormBQuickLauncherForm.seq_no_up_down = function (table_id, move) {
                $('#quick-launcher-form').find('#down-btn').prop('disabled', true);
                $('#quick-launcher-form').find('#up-btn').prop('disabled', true);

                PopupSetupFormBQuickLauncherForm.remove_last_item('#quick-launcher-table-body')

                let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
                let index = $(tr).prevAll().length

                const up_or_down_val = (move === 'up' ? -1 : 1);
                const temp_bd_page = changeArrayOrder(PopupSetupFormBQuickLauncherForm.Items, index, up_or_down_val)
                if (! temp_bd_page) {
                    iziToast.error({ title: 'Error', message: $('#action-failed').text() });
                    $('#quick-launcher-form').find('#down-btn').prop('disabled', false);
                    $('#quick-launcher-form').find('#up-btn').prop('disabled', false);
                    return;
                }

                PopupSetupFormBQuickLauncherForm.Items = temp_bd_page
                Btype.btn_act_save('#quick-launcher-form #frm', function () {
                    PopupSetupFormBQuickLauncherForm.btn_act_new()
                    PopupSetupFormBQuickLauncherForm.create_bd_page()

                    const after_index = index + up_or_down_val;
                    $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
                    $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');

                    $('#quick-launcher-form').find('#down-btn').prop('disabled', false);
                    $('#quick-launcher-form').find('#up-btn').prop('disabled', false);
                }, 'PopupSetupFormBQuickLauncherForm');

            }

            PopupSetupFormBQuickLauncherForm.btn_act_new = function () {
                // table body 초기화
                $('#quick-launcher-form').find('#quick-launcher-table-head .all-check').prop('checked', false)
                table_head_check_box_reset('#quick-launcher-form #quick-launcher-table-head')
                $('#quick-launcher-form').find('#quick-launcher-table-body').html('');
            }

            PopupSetupFormBQuickLauncherForm.btn_act_save = function () {
                PopupSetupFormBQuickLauncherForm.remove_last_item('#quick-launcher-table-body')

                $('#quick-launcher-table-body tr').each(function (index) {
                    PopupSetupFormBQuickLauncherForm.Items[index] = PopupSetupFormBQuickLauncherForm.item_base_struct(
                        $(this).find('#name-txt').val(), $(this).find('.image-url-txt').val(), $(this).find('#class-txt').val()
                    )
                });

                Btype.btn_act_save('#quick-launcher-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    // $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormBQuickLauncherForm');
            }

            PopupSetupFormBQuickLauncherForm.btn_bd_act_multi_delete = function (table_id) {
                let data = []

                $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                    if (! $(this).is(':checked')) {
                        data.push(PopupSetupFormBQuickLauncherForm.Items[index])
                    }
                })

                if (PopupSetupFormBQuickLauncherForm.Items.length === data.length) {
                    iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                    return;
                }

                confirm_message_shw_and_delete(function() {
                    PopupSetupFormBQuickLauncherForm.Items = data

                    Btype.btn_act_save('#quick-launcher-form #frm', function () {
                        PopupSetupFormBQuickLauncherForm.btn_act_new()
                        PopupSetupFormBQuickLauncherForm.create_bd_page()
                    }, 'PopupSetupFormBQuickLauncherForm');
                })

            }

            PopupSetupFormBQuickLauncherForm.remove_last_item = function (table_id) {
                const tr = $(`${table_id} tr:last`);

                if ($(tr).find('.last-td').data('last')) {
                    iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                    PopupSetupFormBQuickLauncherForm.Items.pop();
                    $(tr).remove()
                }
            }

            PopupSetupFormBQuickLauncherForm.item_base_struct = function (name, image_url, class_name) {
                return {
                    Name: name,
                    ImageUrl: image_url ?? '',
                    Class: class_name ?? '',
                }
            }

            PopupSetupFormBQuickLauncherForm.override_get_item_id = function (item_id) {
                Btype.get_item_id(item_id, 'PopupSetupFormBQuickLauncherForm')
            }

            PopupSetupFormBQuickLauncherForm.save_data_when_entering_text = function () {
                const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
                const index = $(tr).prevAll().length
                PopupSetupFormBQuickLauncherForm.Items[index] = PopupSetupFormBQuickLauncherForm.item_base_struct(
                    $(tr).find('#name-txt').val(), $(tr).find('.image-url-txt').val(), $(tr).find('#class-txt').val()
                )
            }

            PopupSetupFormBQuickLauncherForm.add_td_last_tap_out = function ($this) {
                Btype.btn_act_save('#quick-launcher-form #frm', function () {
                    if ($($this).data('last')) {
                        PopupSetupFormBQuickLauncherForm.add_tr();
                        $($this).data('last', false)
                    }
                }, 'PopupSetupFormBQuickLauncherForm');
            }

            PopupSetupFormBQuickLauncherForm.create_bd_page = function () {
                let html
                PopupSetupFormBQuickLauncherForm.Items.forEach((bd, index) => {
                    html +=
                        `<tr>
                    <td class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].Name}
                        >
                        <input type="text" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Name} border-0 bg-white"
                        id="name-txt" value="${bd.Name}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].ImageUrl}">
                        <div class="form-group d-flex">
                            <input type="text" class="rounded w-100 radius-r0 image-url-txt border-0 bg-white" id="image-url-${index}-txt" value="${bd.ImageUrl}" disabled>
                            <button class="text-white rounded border-0 bg-grey-700 border-grey-700 bg-grey-700-hover radius-l0 col-3" onclick="PopupSetupFormBQuickLauncherForm.upload_file(this)">
                                찾기
                            </button>
                        </div>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        onfocusout="PopupSetupFormBQuickLauncherForm.add_td_last_tap_out(this)"
                        class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Class} last-td" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].Class}
                        >
                        <input type="text" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Class} border-0 bg-white" id="class-txt"
                        onfocusout="PopupSetupFormBQuickLauncherForm.save_data_when_entering_text()"
                        value="${bd.Class}" disabled>
                    </td>
                </tr>`
                    // <td
                    //     class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].BasicPrice}" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].BasicPrice}
                    //     id="basic-price-txt">
                    // </td>
                })

                $('#quick-launcher-form').find('#quick-launcher-table-body').append(html)
            }

            PopupSetupFormBQuickLauncherForm.add_tr = async function () {
                console.log(PopupSetupFormBQuickLauncherForm.Items.length)
                const html =
                    `<tr>
                <td class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].$Check}">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Name}" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].Name}
                    >
                    <input type="text" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Name} border-0 bg-white" id="name-txt" required>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].ImageUrl}">
                    <div class="form-group d-flex">
                        <input type="text" class="rounded w-100 radius-r0 image-url-txt border-0 bg-white" id="image-url-${PopupSetupFormBQuickLauncherForm.Items.length}-txt">
                        <button class="text-white rounded border-0 bg-grey-700 border-grey-700 bg-grey-700-hover radius-l0 col-3" onclick="PopupSetupFormBQuickLauncherForm.upload_file(this)">
                            찾기
                        </button>
                    </div>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    data-last=true onfocusout="PopupSetupFormBQuickLauncherForm.add_td_last_tap_out(this)"
                    class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Class} last-td" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].Class}
                    >
                    <input type="text" class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].Class} border-0 bg-white" id="class-txt"
                    onfocusout="PopupSetupFormBQuickLauncherForm.save_data_when_entering_text()">
                </td>
            </tr>`
                // <td
                //     class="text-${PopupSetupFormBQuickLauncherForm.formB.ListVars['Align'].BasicPrice}" ${PopupSetupFormBQuickLauncherForm.formB.ListVars['Hidden'].BasicPrice}
                //     id="basic-price-txt">
                // </td>

                $('#quick-launcher-form').find('#quick-launcher-table-body').append(html)

                const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

                $(tr).find('input[name=bd-cursor-state]').trigger('click')
                $(tr).find('#name-txt').focus()

                PopupSetupFormBQuickLauncherForm.Items.push(PopupSetupFormBQuickLauncherForm.item_base_struct(''))
            }

            PopupSetupFormBQuickLauncherForm.btn_bd_act_add = function () {
                if (Number($('#quick-launcher-form').find('#Id').val()) == 0) {
                    iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                    return
                }

                if (! PopupSetupFormBQuickLauncherForm.last_item_added_check('#quick-launcher-table-body')) {
                    PopupSetupFormBQuickLauncherForm.add_tr()
                }
            }

            PopupSetupFormBQuickLauncherForm.last_item_added_check = function (table_id) {
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

            PopupSetupFormBQuickLauncherForm.get_parameter = function () {
                const setup = {
                    Type: $('#quick-launcher-form').find('#type-select').val(),
                    Buttons: PopupSetupFormBQuickLauncherForm.Items
                }
                const id = Number($('#quick-launcher-form').find('#Id').val());
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

            PopupSetupFormBQuickLauncherForm.show_popup_callback = async function (id, setup) {
                PopupSetupFormBQuickLauncherForm.btn_act_new()
                $('#modal-select-popup.popup-setup-form-b-quick-launcher-form .modal-dialog').css('maxWidth', '800px');

                $('#quick-launcher-form').find('#Id').val(id)
                PopupSetupFormBQuickLauncherForm.set_item_input_shortcut_ui(setup)
            }

            PopupSetupFormBQuickLauncherForm.set_item_input_shortcut_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                $('#quick-launcher-form').find('#type-select').val(setup['Type'])

                PopupSetupFormBQuickLauncherForm.Items = setup['Buttons']
                PopupSetupFormBQuickLauncherForm.create_bd_page()
                // console.log(PopupSetupFormBQuickLauncherForm.Items)
            }
        }( window.PopupSetupFormBQuickLauncherForm = window.PopupSetupFormBQuickLauncherForm || {}, jQuery ));
    </script>
    {{--@endpush--}}
@endonce
