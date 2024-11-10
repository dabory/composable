@extends('views.layouts.master')
@section('content')

<div class="sub_wrap member_credit my-app">
    <!-- content 시작 -->
    <div class="content container" id="ssh-app-form">
        @include('views.layouts.my-app-left-sidebar')

        <div class="right_warp">
            <div class="card right">
                @include('views.layouts.my-app-navbar')

                <div class="card-body">
                    <div class="card">
                        <div class="mb-2 pt-2 text-right d-flex justify-content-end">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary ssh-app-act" data-value="list" {{ $list['FormVars']['Hidden']['ListButton'] }}>
                                    {{ $list['FormVars']['Title']['ListButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $list['HeadSelectOptions'],
                                    'eventClassName' => 'ssh-app-act',
                                ])
                            </div>
                        </div>


                        <div class="d-none">
                            <select class="rounded w-100" id="select-popup-select">
                                @foreach($list['SelectPopupOptions'] as $popupOption)
                                    <option value="{{ $popupOption['Caption'] }}"
                                        data-component="{{ $popupOption['ModalClassName'] }}"
                                        data-type="{{ $popupOption['ParameterType'] }}">
                                        {{ $popupOption['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card_1" id="modal-ssh_app">
                            <div class="table-responsive"
                                style="height: {{ $list['DisplayVars']['BodyHeight'] }}px;">
                                <table class="table table-row ssh-app-table">
                                    <thead>
                                        @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $list['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                        ])
                                    </thead>
                                    <tbody id="ssh-app-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                                <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="ssh_app">
                                    @include('front.outline.moption')
                                </select>
                                <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                                    <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                                    <select class="modal-order-by-select w-100 rounded" data-target="ssh_app">
                                        <option
                                            value="{{ $list['OrderByOptions'][0]['Value'] }}">
                                            {{ $list['OrderByOptions'][0]['Caption'] }}
                                        </option>
                                        <option
                                            value="{{ $list['OrderByOptions'][1]['Value'] }}">
                                            {{ $list['OrderByOptions'][1]['Caption'] }}
                                        </option>
                                    </select>
                                </div>
                                <ul class="pagination pagination-sm"></ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            @include('views.layouts.my-app-right-sidebar')
        </div>

    </div>
    <!--// content 끝 -->

</div>
@endsection

@foreach ($list['SelectPopupOptions'] as $popupOption)
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption
            ])
        @endpush
    @endif
@endforeach

@once
@push('js')
    <script>
        $(document).ready(function() {
            make_dynamic_table_css('.ssh-app-table', make_dynamic_table_px(list['ListVars']['Size']))

            $('.ssh-app-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'new': ssh_app_new(); break;
                    case 'list': ssh_app_list(); break;
                    case 'multi-delete': ssh_app_multi_delete(); break;
                }
            });

            $(document).on('hide.bs.modal','#modal-select-popup', function () {
                ssh_app_list();
            });

            ssh_app_open()
        });

        function ssh_app_list() {
            ssh_app_open(
                $('#modal-ssh_app').data('limit'),
                $('#modal-ssh_app').data('offset'),
                $('#modal-ssh_app').data('page')
            );
        }

        async function convert_to_multi_delete_data(table_id) {
            let data = [];
            let response = await get_api_data(list['General']['PageApi'], get_ssh_app_parameter($('#modal-ssh_app').data('limit'), $('#modal-ssh_app').data('offset')));
            let page = response.data.Page;

            $(table_id).find(`input[name='bd-cud-check']`).each(function(index) {
                if ($(this).is(':checked')) {
                    if (page[index].Id == 0) return true;
                    data.push({ Id: parseInt(`-${page[index].Id}`) });
                }
            })

            if (data.length == 0) {
                iziToast.error({
                    title: 'Error',
                    message: $('#click-the-checkbox-es-of-line-for-action').text(),
                });
                return false;
            }

            return data;
        }

        function ssh_app_multi_delete() {
            confirm_message_shw_and_delete(async function() {
                let modal_class_name = $('#select-popup-select option:selected').data('component');
                const data = await convert_to_multi_delete_data('.ssh-app-table')
                if (! data) return;
                eval(capitalize(camelCase(modal_class_name))).btn_act_multi_delete_callback(data, function () {
                    iziToast.success({
                        title: 'Success',
                        message: $('#action-completed').text(),
                    });
                    ssh_app_list()
                })
            })
        }

        function ssh_app_new() {
            let modal_class_name = $('#select-popup-select option:selected').data('component');


            eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback()
            $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        function ssh_app_open(limit = 10, offset = 0, page = 1) {
            let html = ``;
            $('#modal-ssh_app').data('limit', limit);
            $('#modal-ssh_app').data('offset', offset);
            $('#modal-ssh_app').data('page', page);

            $.when(get_api_data(list['General']['PageApi'], get_ssh_app_parameter(limit, offset))).done(function (response) {
                let d = response.data

                // console.log(d)
                if ( d.Page ) {
                    make_pagination('ssh_app', d.PageVars.QueryCnt, page);
                    let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                    d.Page.forEach(ssh_app => {
                        html +=
                        `<tr>
                            <td class="text-${list.ListVars['Align'].$Radio} px-import-0">
                                <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                                class="text-${list.ListVars['Align'].$Radio}"
                                onclick="show_select_popup('${ssh_app.Id}', '${ssh_app.C1}')">
                            </td>
                            <td class="text-${list.ListVars['Align'].$Check} px-import-0" ${list.ListVars['Hidden'].$Check}>
                                <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                                class="text-${list.ListVars['Align'].$Check}">
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].No}" ${list.ListVars['Hidden'].No}>${no--}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C1}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C1, list.ListVars['Format'].C1)}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C2}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C2, list.ListVars['Format'].C2)}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C3}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C3, list.ListVars['Format'].C3)}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C4}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C4, list.ListVars['Format'].C4)}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C5}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C5, list.ListVars['Format'].C5)}
                            </td>
                            <td
                                class="text-${list.ListVars['Align'].C6}" ${list.ListVars['Hidden'].C1}>${format_conver_for(ssh_app.C6, list.ListVars['Format'].C6)}
                            </td>
                        </tr>
                        `
                    });
                } else {
                    html = `<tr><td class="text-center" colspan="${list.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                    make_pagination('ssh_app', 1, 1 );
                }
                $('#ssh-app-table-body').html(html);
            });
        }

        async function show_select_popup(id, c1) {
            if (c1.toLowerCase() == 'total') return;

            let modal_class_name = $('#select-popup-select option:selected').data('component');
            let parameter_type = $('#select-popup-select option:selected').data('type');

            if (isEmpty(modal_class_name)) return;

            // console.log(capitalize(camelCase(modal_class_name)))
            await eval(capitalize(camelCase(modal_class_name))).show_popup_callback(id, c1, {
                    start_date: $('#type1-start-date').val(),
                    end_date: $('#type1-end-date').val(),
                    range_val: $('input:radio[name=type1-date-range]:checked').val()
                }
            );

            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        function get_ssh_app_parameter(limit, offset) {
            let parameter = {
                QueryVars: {
                    QueryName: list['QueryVars']['QueryName']
                },
                ListType1Vars: {
                    ListToken: '',
                    FilterDate: list['QueryVars']['FilterDate'],
                    OrderBy: $('#ssh-app-form').find('.modal-order-by-select').val(),
                },
                PageVars: {
                    Limit: parseInt(limit),
                    Offset: parseInt(offset),
                }
            }

            // console.log(parameter)

            return parameter;
        }

        const list = {!! json_encode($list) !!};
    </script>
@endpush
@endonce

