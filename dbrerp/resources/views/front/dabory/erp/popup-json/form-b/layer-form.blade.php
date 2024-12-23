{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-json-form-b-layer-form">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>

    <div class="mb-1 pt-2 text-right btn-groups">

    </div>

    <div class="card" id="layer-form">
        <input type="hidden" id="Id" name="Id" value="0">
{{--        <div class="card-header" id="frm">--}}
{{--        </div>--}}

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mr-1" id="down-btn" onclick="PopupJsonFormBLayerForm.seq_no_up_down('#layer-table-body', 'down')"
                            data-clicked="">▼
                    </button>
                    <button class="btn btn-primary mr-1" id="up-btn" onclick="PopupJsonFormBLayerForm.seq_no_up_down('#layer-table-body', 'up')"
                            data-clicked="">▲
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary layer-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'layer-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row layer-table">
                        <thead id="layer-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="layer-table-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@endsection--}}

{{--@section('modal')--}}
{{--    @include('front.outline.static.memo')--}}
{{--@endsection--}}

@once
{{--@push('js')--}}
<script src="{{ csset('/js/utils/setup.js') }}"></script>
{{--<script src="{{ csset('/js/components/web-editor.js') }}"></script>--}}
{{--<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>--}}
    <script>
    $(document).ready(async function() {
        make_dynamic_table_css('.layer-table', make_dynamic_table_px(PopupJsonFormBLayerForm.formB['ListVars']['Size']))

        $('.layer-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupJsonFormBLayerForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupJsonFormBLayerForm.btn_bd_act_multi_delete('.layer-table'); break;
            }
        });

    });

    (function( PopupJsonFormBLayerForm, $, undefined ) {
        PopupJsonFormBLayerForm.formB = {!! json_encode($formB) !!}
        PopupJsonFormBLayerForm.LayerJson = []
        PopupJsonFormBLayerForm.addTdIndex = 0

        PopupJsonFormBLayerForm.seq_no_up_down = function (table_id, move) {
            $('#layer-form').find('#down-btn').prop('disabled', true)
            $('#layer-form').find('#up-btn').prop('disabled', true)

            PopupJsonFormBLayerForm.remove_last_item('#layer-table-body')

            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            const up_or_down_val = (move === 'up' ? -1 : 1)
            const temp_bd_page = changeArrayOrder(PopupJsonFormBLayerForm.LayerJson, index, up_or_down_val)
            if (! temp_bd_page) {
                iziToast.error({ title: 'Error', message: $('#action-failed').text() })
                $('#layer-form').find('#down-btn').prop('disabled', false)
                $('#layer-form').find('#up-btn').prop('disabled', false)
                return
            }

            PopupJsonFormBLayerForm.LayerJson = temp_bd_page
            Btype.btn_act_save('#layer-form #frm', function () {
                PopupJsonFormBLayerForm.btn_act_new()
                PopupJsonFormBLayerForm.create_bd_page()

                const after_index = index + up_or_down_val
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true)
                $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click')

                $('#layer-form').find('#down-btn').prop('disabled', false)
                $('#layer-form').find('#up-btn').prop('disabled', false)
            }, 'PopupJsonFormBLayerForm')
        }

        PopupJsonFormBLayerForm.btn_act_new = function () {
            $('#modal-memo').find('.fr-view').html('')

            $('#modal-select-popup.popup-json-form-b-layer-form .modal-dialog').css('maxWidth', '1100px')

            $('#modal-select-popup.popup-json-form-b-layer-form .modal-header').removeClass('bg-grey-700')
            $('#modal-select-popup.popup-json-form-b-layer-form .modal-header').addClass('bg-danger-10')
            $('#modal-select-popup.popup-json-form-b-layer-form .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
            $('#modal-select-popup.popup-json-form-b-layer-form .modal-body th').addClass('bg-danger-10')


            PopupJsonFormBLayerForm.addTdIndex = 0

            // table body 초기화
            $('#layer-form').find('#layer-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#layer-form #layer-table-head')
            $('#layer-form').find('#layer-table-body').html('');
        }

        PopupJsonFormBLayerForm.btn_act_save = function () {
            PopupJsonFormBLayerForm.remove_last_item('#layer-table-body')

            Btype.btn_act_save('#layer-form #frm', function () {
                $('#modal-select-popup.show').trigger('list.requery')
                // $('#modal-select-popup.show').modal('hide');
            }, 'PopupJsonFormBLayerForm');
        }

        PopupJsonFormBLayerForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupJsonFormBLayerForm.LayerJson[index])
                }
            })

            if (PopupJsonFormBLayerForm.LayerJson.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                PopupJsonFormBLayerForm.LayerJson = data

                Btype.btn_act_save('#layer-form #frm', function () {
                    PopupJsonFormBLayerForm.btn_act_new()
                    PopupJsonFormBLayerForm.create_bd_page()
                }, 'PopupJsonFormBLayerForm');
            })

        }

        PopupJsonFormBLayerForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupJsonFormBLayerForm.LayerJson.pop();
                $(tr).remove()
            }
        }

        PopupJsonFormBLayerForm.struct = function (layer_desc, file_url, link_url, is_skipped) {
            return {
                LayerDesc: layer_desc,
                FileUrl: file_url,
                LinkUrl: link_url,
                IsSkipped: is_skipped ? '1' : '0',
            }
        }

        PopupJsonFormBLayerForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupJsonFormBLayerForm')
        }

        PopupJsonFormBLayerForm.set_item_data_to_textbox = function (item) {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            $(tr).find('#item-code-txt').val(item.ItemCode)
            $(tr).find('#button-cation-txt').val(item.ItemName)
            $(tr).find('#basic-qty-txt').val(1)
            $(tr).find('#basic-price-txt').text(format_conver_for(item.SalesPrc, PopupJsonFormBLayerForm.formB.ListVars['Format'].BasicPrice))

            const index = $(tr).prevAll().length;
            PopupJsonFormBLayerForm.LayerJson[index] = PopupJsonFormBLayerForm.struct(item.ItemCode, item.ItemName, 1)

            return $(tr).find('#button-cation-txt')
        }

        PopupJsonFormBLayerForm.add_td_last_tap_out = function ($this) {
            const tr = $($this).closest('tr')
            const index = $(tr).prevAll().length

            $(tr).find('.save-btn').attr('disabled', true)

            PopupJsonFormBLayerForm.LayerJson[index] = PopupJsonFormBLayerForm.struct(
                $(tr).find('.fr-view').html(), $(tr).find('.layer-media-id-txt').val(),
                $(tr).find('.link_url').val(), $(tr).find('.is-skipped').prop('checked')
            )

            Btype.btn_act_save('#layer-form #frm', function () {
                $(tr).find(`input[name='bd-cud-check']`).prop('checked', false)
                $(tr).find('.link_url').prop('disabled', true)
                $(tr).find('.link_url').addClass('border-0 bg-white')
                $(tr).find('.is-skipped').prop('disabled', true)


                if ($($this).data('last')) {
                    PopupJsonFormBLayerForm.add_tr();
                    $($this).data('last', false)
                }

                $(tr).find('.save-btn').attr('disabled', false)
            }, 'PopupJsonFormBLayerForm');
        }

        PopupJsonFormBLayerForm.create_bd_page = function () {
            let html
            PopupJsonFormBLayerForm.LayerJson.forEach(bd => {
                let file_name= '미디어 업로드'
                if (! isEmpty(bd.FileUrl)) {
                    const file_name_split = bd.FileUrl.split('/')
                    file_name = file_name_split[file_name_split.length - 1]
                }

                html +=
                    `<tr>
                        <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Radio} px-import-0">
                            <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Radio}"
                            onclick="Btype.bd_cursor_click(this)">
                        </td>
                        <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Check} px-import-0">
                            <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Check}">
                        </td>
                        <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].FileUrl}">
                            <div class="form-group px-2">
                                <input type="hidden" class="layer-media-id-txt" id="layer-media-id-${PopupJsonFormBLayerForm.addTdIndex}-txt" value="${bd.FileUrl}">
                                <button class="btn bg-grey-700 border-grey-700 bg-grey-700-hover text-white file-upload-btn w-100"
                                    onclick="upload_file(this)">
                                    ${file_name}
                                </button>
                            </div>
                        </td>

                        <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LinkUrl}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].LinkUrl}>
                            <input type="text" class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LinkUrl} border-0 bg-white link_url" value="${bd.LinkUrl}" disabled>
                        </td>
                        <td
                            class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LayerDesc}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].LayerDesc}>
                            <textarea style="max-height: 30px;" class="rounded w-100 bg-white layer-memo-textarea"
                                ondblclick="PopupJsonFormBLayerForm.dblclick_memo_textarea(this, ${PopupJsonFormBLayerForm.addTdIndex})"
                                id="layer-memo-textarea-${PopupJsonFormBLayerForm.addTdIndex}" role="button" readonly>${remove_tag(bd.LayerDesc)}</textarea>
                            <div class="fr-view" id="layer-memo-preview-${PopupJsonFormBLayerForm.addTdIndex}" hidden>${bd.LayerDesc}</div>
                        </td>
                        <td
                            class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].IsSkipped}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].IsSkipped}>
                            <input type="checkbox" class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped" ${bd.IsSkipped === '1' ? 'checked' : ''} disabled>
                        </td>
                        <td
                            class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].SaveButton}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].SaveButton}>
                            <button class="btn bg-danger-10 border-danger-10 bg-danger-10-hover text-white save-btn last-td" onclick="PopupJsonFormBLayerForm.add_td_last_tap_out(this)">저장</button>
                        </td>
                    </tr>`

                PopupJsonFormBLayerForm.addTdIndex += 1
            })

            $('#layer-form').find('#layer-table-body').append(html)
        }

        PopupJsonFormBLayerForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].$Check}">
                </td>
                <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].FileUrl}">
                    <div class="form-group px-2">
                        <input type="hidden" class="layer-media-id-txt" id="layer-media-id-${PopupJsonFormBLayerForm.addTdIndex}-txt" value="">
                        <button class="btn bg-grey-700 border-grey-700 bg-grey-700-hover text-white file-upload-btn w-100"
                            onclick="upload_file(this)">
                            미디어 업로드
                        </button>
                    </div>
                </td>

                <td class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LinkUrl}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].LinkUrl}>
                    <input type="text" class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LinkUrl} link_url">
                </td>
                <td
                    class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].LayerDesc}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].LayerDesc}>
                    <textarea style="max-height: 30px;" class="rounded w-100 bg-white layer-memo-textarea"
                        ondblclick="PopupJsonFormBLayerForm.dblclick_memo_textarea(this, ${PopupJsonFormBLayerForm.addTdIndex})" id="layer-memo-textarea-${PopupJsonFormBLayerForm.addTdIndex}" role="button" readonly></textarea>
                    <div class="fr-view" id="layer-memo-preview-${PopupJsonFormBLayerForm.addTdIndex}" hidden></div>
                </td>
                <td
                    class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].IsSkipped}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].IsSkipped}>
                    <input type="checkbox" class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].IsSkipped} border-0 bg-white is-skipped">
                </td>
                <td
                    class="text-${PopupJsonFormBLayerForm.formB.ListVars['Align'].SaveButton}" ${PopupJsonFormBLayerForm.formB.ListVars['Hidden'].SaveButton}>
                    <button class="btn bg-danger-10 border-danger-10 bg-danger-10-hover text-white save-btn last-td" data-last=true onclick="PopupJsonFormBLayerForm.add_td_last_tap_out(this)">저장</button>
                </td>
            </tr>`

            PopupJsonFormBLayerForm.addTdIndex += 1
            $('#layer-form').find('#layer-table-body').append(html)

            PopupJsonFormBLayerForm.LayerJson.push(PopupJsonFormBLayerForm.struct(''))
        }

        PopupJsonFormBLayerForm.dblclick_memo_textarea = function ($this, last_bd_id = 0) {
            $('#modal-memo').find('#froala-editor').data('txtarea_id', '#' + $($this).attr('id'))

            const preview_id = '#layer-memo-preview-' + last_bd_id
            $('#modal-memo').find('#froala-editor').data('preview_id', preview_id)
            $('#modal-memo').find('.fr-view').html($(preview_id).html())
            $('#modal-memo').modal('show');
        }

        PopupJsonFormBLayerForm.btn_bd_act_add = function () {
            if (Number($('#layer-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                return
            }

            if (! PopupJsonFormBLayerForm.last_item_added_check('#layer-table-body')) {
                PopupJsonFormBLayerForm.add_tr()
            }
        }

        PopupJsonFormBLayerForm.last_item_added_check = function (table_id) {
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

        PopupJsonFormBLayerForm.get_parameter = function () {
            const id = Number($('#layer-form').find('#Id').val());
            let parameter = {
                Id: id,
                LayerJson: JSON.stringify({ Page: PopupJsonFormBLayerForm.LayerJson }),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter;
        }

        PopupJsonFormBLayerForm.btn_act_new_callback = async function (id) {
            $('#layer-form').find('#Id').val(id)
            PopupJsonFormBLayerForm.btn_act_new()

            const response = await get_api_data(PopupJsonFormBLayerForm.formB['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            let json = {Page: []}
            if (! isEmpty(response.data.Page[0]['LayerJson'])) {
                json = JSON.parse(response.data.Page[0]['LayerJson'])
            }
            PopupJsonFormBLayerForm.set_ui(json)
        }

        PopupJsonFormBLayerForm.set_ui = function (json) {
            if (_.isEmpty(json)) return;

            PopupJsonFormBLayerForm.LayerJson = json['Page']
            PopupJsonFormBLayerForm.create_bd_page()
            // console.log(PopupJsonFormBLayerForm.LayerJson)
        }
    }( window.PopupJsonFormBLayerForm = window.PopupJsonFormBLayerForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
