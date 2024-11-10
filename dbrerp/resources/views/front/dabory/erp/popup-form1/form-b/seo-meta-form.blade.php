{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-form1-form-b-seo-meta-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary seo-meta-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formB['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>

    <div class="card" id="seo-meta-form">
        <input type="hidden" id="Id" name="Id" value="0">

        <div class="card-header" id="frm">
            <div class="row">
                <div class="card-header-item col-4">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 90px">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0">{{ $formB['FormVars']['Title']['SeoSlug'] }}</label>
                                <input type="text" id="seo-slug-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formB['FormVars']['MaxLength']['SeoSlug'] }}"
                                    {{ $formB['FormVars']['Required']['SeoSlug'] }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0 mt-2 mx-2">
            <div id="">
                <div class="d-flex justify-content-end">
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
<script src="{{ asset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
    $(document).ready(async function() {
        $('.seo-meta-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': PopupForm1FormBSeoMetaForm.btn_act_save(); break;
            }
        });

        $('.seo-meta-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupForm1FormBSeoMetaForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupForm1FormBSeoMetaForm.btn_bd_act_multi_delete('.seo-meta-table'); break;
            }
        });

    });

    (function( PopupForm1FormBSeoMetaForm, $, undefined ) {
        PopupForm1FormBSeoMetaForm.formB = {!! json_encode($formB) !!}
        PopupForm1FormBSeoMetaForm.Items = []

        PopupForm1FormBSeoMetaForm.btn_act_save = function () {
            PopupForm1FormBSeoMetaForm.remove_last_item('#seo-meta-table-body')

            Btype.btn_act_save('#seo-meta-form #frm', function () {
                $('#modal-select-popup.show').trigger('list.requery')
                // $('#modal-select-popup.show').modal('hide');
            }, 'PopupForm1FormBSeoMetaForm');
        }

        PopupForm1FormBSeoMetaForm.btn_act_new = function () {
            // table body 초기화
            $('#seo-meta-form').find('#seo-meta-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#seo-meta-form #seo-meta-table-head')
            $('#seo-meta-form').find('#seo-meta-table-body').html('');
        }

        PopupForm1FormBSeoMetaForm.btn_bd_act_multi_delete = function (table_id) {
            let data = []

            $(table_id).find(`input[name='bd-cud-check']`).each(function (index) {
                if (! $(this).is(':checked')) {
                    data.push(PopupForm1FormBSeoMetaForm.Items[index])
                }
            })

            if (PopupForm1FormBSeoMetaForm.Items.length == data.length) {
                iziToast.error({ title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text() });
                return;
            }

            confirm_message_shw_and_delete(function() {
                data = data.filter(item => ! isEmpty(item['Name']))
                PopupForm1FormBSeoMetaForm.Items = data

                Btype.btn_act_save('#seo-meta-form #frm', function () {
                    PopupForm1FormBSeoMetaForm.btn_act_new()
                    PopupForm1FormBSeoMetaForm.create_bd_page()
                }, 'PopupForm1FormBSeoMetaForm');
            })

        }

        PopupForm1FormBSeoMetaForm.remove_last_item = function (table_id) {
            const tr = $(`${table_id} tr:last`);

            if ($(tr).find('.last-td').data('last')) {
                iziToast.info({ title: 'Info', message: $('#last-item-line-is-removed').text() });
                PopupForm1FormBSeoMetaForm.Items.pop();
                $(tr).remove()
            }
        }

        PopupForm1FormBSeoMetaForm.base_struct = function (name, content) {
            return {
                Name: name,
                Content: content
            }
        }

        PopupForm1FormBSeoMetaForm.override_get_item_id = function (item_id) {
            Btype.get_item_id(item_id, 'PopupForm1FormBSeoMetaForm')
        }

        PopupForm1FormBSeoMetaForm.save_data_when_entering_text = function () {
            const tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            const index = $(tr).prevAll().length
            PopupForm1FormBSeoMetaForm.Items[index] = PopupForm1FormBSeoMetaForm.base_struct(
                $(tr).find('#name-txt').val(), $(tr).find('#content-txt').val()
            )
        }

        PopupForm1FormBSeoMetaForm.add_td_last_tap_out = function ($this) {
            PopupForm1FormBSeoMetaForm.Items = PopupForm1FormBSeoMetaForm.Items.filter(item => ! isEmpty(item['Name']))

            const tr = $($this).closest('tr')
            if (isEmpty($(tr).find('#name-txt').val())) {
                iziToast.error({ title: 'Error', message: $('#required-item-omitted').text() });
                return
            }

            Btype.btn_act_save('#seo-meta-form #frm', function () {
                if ($($this).data('last')) {
                    // PopupForm1FormBSeoMetaForm.add_tr()
                    $($this).data('last', false)
                }

                PopupForm1FormBSeoMetaForm.create_bd_page()
            }, 'PopupForm1FormBSeoMetaForm');
        }

        PopupForm1FormBSeoMetaForm.create_bd_page = function () {
            let html
            PopupForm1FormBSeoMetaForm.Items.forEach(bd => {
                html +=
                `<tr>
                    <td class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Name}" ${PopupForm1FormBSeoMetaForm.formB.ListVars['Hidden'].Name}
                        >
                        <input type="text" class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Name} border-0 bg-white" id="name-txt"
                        onfocusout="PopupForm1FormBSeoMetaForm.save_data_when_entering_text()"
                        value="${bd.Name}" disabled required>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="PopupForm1FormBSeoMetaForm.add_td_last_tap_out(this)"
                        class="last-td text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Content}" ${PopupForm1FormBSeoMetaForm.formB.ListVars['Hidden'].Content}
                        >
                        <input type="text" class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Content} border-0 bg-white" id="content-txt"
                        onfocusout="PopupForm1FormBSeoMetaForm.save_data_when_entering_text()"
                        value="${bd.Content}" disabled>
                    </td>
                </tr>`
            })

            $('#seo-meta-form').find('#seo-meta-table-body').html(html)
        }

        PopupForm1FormBSeoMetaForm.add_tr = async function () {
            const html =
            `<tr>
                <td class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Radio}"
                    onclick="Btype.bd_cursor_click(this)" checked>
                </td>
                <td class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].$Check}">
                </td>
                 <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Name}" ${PopupForm1FormBSeoMetaForm.formB.ListVars['Hidden'].Name}>
                    <input type="text" class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Name} border-0 bg-white"
                    id="name-txt" required
                    onfocusout="PopupForm1FormBSeoMetaForm.save_data_when_entering_text()">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)" onfocusout="PopupForm1FormBSeoMetaForm.add_td_last_tap_out(this)" data-last=true
                    class="last-td text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Content}" ${PopupForm1FormBSeoMetaForm.formB.ListVars['Hidden'].Content}
                    >
                    <input type="text" class="text-${PopupForm1FormBSeoMetaForm.formB.ListVars['Align'].Content} border-0 bg-white"
                    id="content-txt"
                    onfocusout="PopupForm1FormBSeoMetaForm.save_data_when_entering_text()">
                </td>
            </tr>`

            $('#seo-meta-form').find('#seo-meta-table-body').append(html)

            const tr = $('input[name=bd-cursor-state]:checked').closest('tr')

            $(tr).find('input[name=bd-cursor-state]').trigger('click')
            $(tr).find('#name-txt').focus()

            PopupForm1FormBSeoMetaForm.Items.push(PopupForm1FormBSeoMetaForm.base_struct(''))
        }

        PopupForm1FormBSeoMetaForm.btn_bd_act_add = function () {
            if (Number($('#seo-meta-form').find('#Id').val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#action-failed').text() });
            }

            if (! PopupForm1FormBSeoMetaForm.last_item_added_check('#seo-meta-table-body')) {
                PopupForm1FormBSeoMetaForm.add_tr();
            }
        }

        PopupForm1FormBSeoMetaForm.last_item_added_check = function (table_id) {
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

        PopupForm1FormBSeoMetaForm.get_parameter = function () {
            const setup = {
                Metas: PopupForm1FormBSeoMetaForm.Items
            }
            const id = Number($('#seo-meta-form').find('#Id').val());
            let parameter = {
                Id: id,
            }

            parameter[PopupForm1FormBSeoMetaForm.formB.ActFields.Slug] = $('#seo-meta-form').find('#seo-slug-txt').val()
            parameter[PopupForm1FormBSeoMetaForm.formB.ActFields.Meta] = JSON.stringify(setup)

            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter
        }

        PopupForm1FormBSeoMetaForm.show_popup_callback = async function (id, c1) {
            PopupForm1FormBSeoMetaForm.btn_act_new()
            $('#modal-select-popup.popup-form1-form-b-seo-meta-form .modal-dialog').css('maxWidth', '1200px');

            $('#seo-meta-form').find('#Id').val(id)
            await PopupForm1FormBSeoMetaForm.fetch_seo_meta(Number(id));
        }

        PopupForm1FormBSeoMetaForm.fetch_seo_meta = async function (id) {
            const response = await get_api_data(PopupForm1FormBSeoMetaForm.formB['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            PopupForm1FormBSeoMetaForm.set_seo_meta_ui(response)
        }


        PopupForm1FormBSeoMetaForm.set_seo_meta_ui = async function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                return;
            }

            const seo_meta = response.data.Page[0]
            const seo_meta_form = $('#seo-meta-form')
            // console.log(seo_meta)
            $(seo_meta_form).find('#seo-slug-txt').val(seo_meta[PopupForm1FormBSeoMetaForm.formB.ActFields.Slug])

            if (isEmpty(seo_meta[PopupForm1FormBSeoMetaForm.formB.ActFields.Meta])) {
                const seoMeta = await get_api_data('setup-get', {
                    SetupCode: 'seo-meta'
                })

                PopupForm1FormBSeoMetaForm.Items = seoMeta.data['Metas']
            } else {
                PopupForm1FormBSeoMetaForm.Items = JSON.parse(seo_meta[PopupForm1FormBSeoMetaForm.formB.ActFields.Meta])['Metas']
            }
            PopupForm1FormBSeoMetaForm.create_bd_page()
        }
    }( window.PopupForm1FormBSeoMetaForm = window.PopupForm1FormBSeoMetaForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
