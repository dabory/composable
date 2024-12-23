@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline pt-1 pb-1 d-flex justify-content-end">
                        <div class="mb-1 pt-2 text-right">
{{--                            <button type="button"--}}
{{--                                    class="btn btn-success"--}}
{{--                                    onclick="BalanceForm.balance_act_search()">--}}
{{--                                    <i class="icon-folder-open"></i>--}}
{{--                            </button>--}}

                            <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                                <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                                    Loading...
                            </button>
                            <div class="btn-group query-vars" hidden
                                data-queryname="{{ $formB['QueryVars']['QueryName'] }}" data-filtername="{{ $formB['QueryVars']['FilterName'] }}"
                                data-filtervalue="{{ $formB['QueryVars']['FilterValue'] }}">
                                <button type="button" class="btn btn-sm btn-primary balance-act save-button" data-value="list" {{ $formB['FormVars']['Hidden']['ListButton'] }}>
                                    {{ $formB['FormVars']['Title']['ListButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['SelectButtonOptions'],
                                    'eventClassName' => 'balance-act',
                                ])
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="balance-form">
                        <div class="form-group mb-3" {{ $formB['FormVars']['Hidden']['Month'] }}>
                            <label>{{ $formB['FormVars']['Title']['Month'] }}</label>
                            <br>
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <input type="text" id="year-txt" autocomplete="off">
                                    <select class="ml-1" id="mounth-select">
                                        <option value="01">1</option>
                                        <option value="02">2</option>
                                        <option value="03">3</option>
                                        <option value="04">4</option>
                                        <option value="05">5</option>
                                        <option value="06">6</option>
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3" {{ $formB['FormVars']['Hidden']['Branch'] }}>
                            <label>{{ $formB['FormVars']['Title']['Branch'] }}</label>
                            <br>
                            <select id="branch-id-select"></select>
                        </div>

                        <div class="form-group mb-3" {{ $formB['FormVars']['Hidden']['Storage'] }}>
                            <label>{{ $formB['FormVars']['Title']['Storage'] }}</label>
                            <br>
                            <select id="storage-id-select"></select>
                        </div>

                        <div class="form-group mb-3" {{ $formB['FormVars']['Hidden']['CodeRange'] }}>
                            <label>{{ $formB['FormVars']['Title']['CodeRange'] }}</label>
                            <br>
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <input type="text" id="code-start-txt" value="!">
                                    <span>&nbsp; ~ &nbsp;</span>
                                    <input type="text" id="code-end-txt" value="zzzzzzzzzzzzzz">
                                </div>
                            </div>
                        </div>

                        <div class="balance" id="modal-BalanceForm">
                            <div class="table-responsive mt-2" style="height:400px;">
                                <table class="table-row balance-table">
                                    <thead id="balance-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                    ])
                                    </thead>
                                    <tbody id="balance-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                                <div class="d-flex flex-column flex-md-row">
                                    <div class="{{ $formB['FooterVars']['Display']['BalanceTotal'] }} align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                        <label class="w-100 overflow-hidden text-nowrap m-0 p-0"
                                            rowspan="1" colspan="1">
                                            {{ $formB['FooterVars']['Title']['BalanceTotal'] }}
                                        </label>
                                        <input type="text" class="w-100 w-md-80 rounded" id="balance-total-txt" disabled>
                                    </div>

                                    <div class="{{ $formB['FooterVars']['Display']['Balance2Total'] }} align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                        <label class="w-100 overflow-hidden text-nowrap m-0 p-0"
                                            rowspan="1" colspan="1">
                                            {{ $formB['FooterVars']['Title']['Balance2Total'] }}
                                        </label>
                                        <input type="text" class="w-100 w-md-80 rounded" id="balance2-total-txt" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2 px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row  btn_wrap">
                                <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="BalanceForm.balance">
                                    @include('front.outline.moption')
                                </select>
                                <div class="{{ $formB['FormVars']['Display']['OrderBy'] }} mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                                    <label class="m-0 mr-1 w-20 " id="oderby-label"></label>
                                    <select class="modal-order-by-select w-100 rounded" id="order-by-select" data-target="BalanceForm.balance">
                                        @foreach ($formB['OrderByOptions'] as $option)
                                            <option value="{{ $option['Value']}}">{{ $option['Caption']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <ul class="pagination pagination-sm"></ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.balance-table', make_dynamic_table_px(BalanceForm.formB['ListVars']['Size']))

            $('#balance-form').find('#year-txt').val(moment().format('YYYY'))
            $('#balance-form').find('#mounth-select').val(moment().format('MM'))

            if (BalanceForm.formB['FormVars']['Hidden']['Branch'] !== 'hidden' ) {
                await BalanceForm.create_branch_select_box_options()
            }

            if (BalanceForm.formB['FormVars']['Hidden']['Storage'] !== 'hidden' ) {
                await BalanceForm.create_storage_select_box_options()
            }

            $('.balance-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': BalanceForm.balance_open(); break;
                    case 'multi-save': BalanceForm.balance_act_multi_save(); break;
                    case 'save-and-appply-balace': BalanceForm.balance_act_multi_save('save-and-appply-balace'); break;
                }
            });

            activate_button_group()
        };

        (function( BalanceForm, $, undefined ) {
            BalanceForm.formB = {!! json_encode($formB) !!}
            BalanceForm.multiSaveData = []

            BalanceForm.change_balance_data = function ($this) {
                const tr = $($this).closest('tr')
                let find_data = BalanceForm.multiSaveData.find(item => item.CodeId === $(tr).data('code-id'))

                if ( find_data ) {
                    find_data['Balance'] = minusComma($(tr).find('#balance-txt').val())
                    find_data['Balance2'] = minusComma($(tr).find('#balance2-txt').val())
                    return
                }

                BalanceForm.multiSaveData.push(
                    {
                        Id: $(tr).data('id'),
                        CodeId: $(tr).data('code-id'),
                        Code: trim($(tr).find('#code-td').text()),
                        Name: trim($(tr).find('#name-td').text()),
                        Name2: trim($(tr).find('#name2-td').text()),
                        Balance: minusComma($(tr).find('#balance-txt').val()),
                        Balance2: minusComma($(tr).find('#balance2-txt').val()),
                    }
                )
            }

            BalanceForm.balance_act_multi_save = async function (type) {

                let isType = !!type;
                if (!isType && isEmptyArr(BalanceForm.multiSaveData)) {
                    iziToast.info({ title: 'Info', message: '변경사항이 없습니다.' });
                    return;
                }

                const parameter = { ...BalanceForm.get_parameter(0, 0), Page: BalanceForm.multiSaveData }
                if(isType) parameter.ListFormBalanceVars.IsApplyBalance = true;
                const response = await get_api_data(BalanceForm.formB['General']['ActApi'], parameter)
                show_iziToast_msg(response.data, function () {
                    BalanceForm.multiSaveData = []
                    BalanceForm.balance_open(
                        $('#modal-BalanceForm').data('limit'),
                        $('#modal-BalanceForm').data('offset'),
                        $('#modal-BalanceForm').data('page'),
                    )
                })
            }

            BalanceForm.amt_calc = function() {
                let balance_total = 0
                let balance2_total = 0

                $('#balance-table-body > tr').each(function () {
                    balance_total += Number( minusComma($(this).find('#balance-txt').val()) )
                    balance2_total += Number( minusComma($(this).find('#balance2-txt').val()) )
                })

                $('#balance-form').find('#balance-total-txt').val(format_conver_for(balance_total, BalanceForm.formB.ListVars['Format'].Balance))
                $('#balance-form').find('#balance2-total-txt').val(format_conver_for(balance2_total, BalanceForm.formB.ListVars['Format'].Balance2))
            }

            BalanceForm.balance_open = function (limit = 10, offset = 0, page = 1) {
                let html = []
                let balance_total = 0
                let balance2_total = 0

                $('#modal-BalanceForm').data('limit', limit);
                $('#modal-BalanceForm').data('offset', offset);
                $('#modal-BalanceForm').data('page', page);

                document.getElementById('balance-table-body').innerHTML = `<tr><td class="text-center" colspan="${BalanceForm.formB.ListVars['Count']}">검색 중...</td></tr>`

                deactivate_button_group()

                // $('#pace-progress-panel').attr('hidden', false)
                $.when(get_api_data(BalanceForm.formB['General']['PageApi'], BalanceForm.get_parameter(limit, offset))).done(function(response) {
                    let d = response.data
                    console.log(d);
                    if ( d.Page ) {
                        make_pagination('BalanceForm.balance', d.PageVars.QueryCnt, page);
                        let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                        for (let i in d.Page) {
                            balance_total += Number(d.Page[i].Balance)
                            balance2_total += Number(d.Page[i].Balance2)

                            html.push (
                            `<tr data-id=${d.Page[i].Id} data-code-id=${d.Page[i].CodeId}>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].No}" ${BalanceForm.formB.ListVars['Hidden'].No}>
                                    ${no--}
                                </td>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].Code}" ${BalanceForm.formB.ListVars['Hidden'].Code} id="code-td">
                                    ${format_conver_for(d.Page[i].Code, BalanceForm.formB.ListVars['Format'].Code)}
                                </td>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].Name}" ${BalanceForm.formB.ListVars['Hidden'].Name} id="name-td">
                                    ${format_conver_for(d.Page[i].Name, BalanceForm.formB.ListVars['Format'].Name)}
                                </td>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].Name2}" ${BalanceForm.formB.ListVars['Hidden'].Name2} id="name2-td">
                                    ${format_conver_for(d.Page[i].Name2, BalanceForm.formB.ListVars['Format'].Name2)}
                                </td>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].Balance}" ${BalanceForm.formB.ListVars['Hidden'].Balance}>
                                    <input type="text" class="decimal text-${BalanceForm.formB.ListVars['Align'].Balance}" id="balance-txt"
                                            onchange="BalanceForm.change_balance_data(this)"
                                            value="${format_conver_for(d.Page[i].Balance, BalanceForm.formB.ListVars['Format'].Balance)}"
                                            data-point="${BalanceForm.formB.ListVars['Format'].Balance}">
                                </td>
                                <td class="text-${BalanceForm.formB.ListVars['Align'].Balance2}" ${BalanceForm.formB.ListVars['Hidden'].Balance2}>
                                    <input type="text" class="decimal text-${BalanceForm.formB.ListVars['Align'].Balance2}" id="balance2-txt"
                                            onchange="BalanceForm.change_balance_data(this)"
                                            value="${format_conver_for(d.Page[i].Balance2, BalanceForm.formB.ListVars['Format'].Balance2)}"
                                            data-point="${BalanceForm.formB.ListVars['Format'].Balance2}">
                                </td>
                            </tr> ` )
                        }
                        $('#balance-form').find('#balance-total-txt').val(format_conver_for(balance_total, BalanceForm.formB.ListVars['Format'].Balance))
                        $('#balance-form').find('#balance2-total-txt').val(format_conver_for(balance2_total, BalanceForm.formB.ListVars['Format'].Balance2))
                    } else {
                        if (! isEmpty(d.apiStatus)) {
                            switch (d.apiStatus) {
                                case 607:
                                    html.push( `<tr><td class="text-center" colspan="${BalanceForm.formB.ListVars['Count']}">Query Error</td></tr>` );
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            html.push( `<tr><td class="text-center" colspan="${BalanceForm.formB.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>` );
                        }
                        make_pagination('BalanceForm.balance', 1, 1 );
                    }


                    activate_button_group()

                    // $('#pace-progress-panel').attr('hidden', true)
                    document.getElementById('balance-table-body').innerHTML = html.join('');
                    // $('#balance-form').find('#balance-table-body').html(html);
                })
            }

            BalanceForm.get_parameter = function (limit, offset) {
                let parameter = {
                    QueryVars: {
                        QueryName: BalanceForm.formB['QueryVars']['QueryName'],
                        FilterName: BalanceForm.formB['QueryVars']['FilterName'],
                        FilterValue: BalanceForm.formB['QueryVars']['FilterValue'],
                    },
                    ListFormBalanceVars: {
                        YyyyMm: $('#balance-form').find('#year-txt').val() + $('#balance-form').find('#mounth-select').val(),
                        // SelectedId: Number($('#balance-form').find('#storage-id-select').val()),
                        SelectedId: Number($('#balance-form').find('#branch-id-select').val()),
                        StartCode: $('#balance-form').find('#code-start-txt').val(),
                        EndCode: $('#balance-form').find('#code-end-txt').val(),
                        IsApplyBalance : false,
                    },
                    PageVars: {
                        Limit: Number(limit),
                        Offset: Number(offset),
                    }
                }

                if($('#balance-form').find('#storage-id-select').val() != null){
                    parameter.ListFormBalanceVars.SelectedId = Number($('#balance-form').find('#storage-id-select').val());
                }

                return parameter;
            }

            BalanceForm.create_branch_select_box_options = async function () {
                const response = await get_api_data('setting-search-page', {
                    QueryVars: {
                        QueryName: 'branch',
                        FilterName: 'dbr_branch.id',
                    },
                    PageVars: {
                        Limit: 9999,
                        Offset: 0,
                    }
                })

                const branch_id_select = custom_create_options('Id', 'Name', response.data.Page)
                $('#balance-form').find('#branch-id-select').append(branch_id_select);
            }

            BalanceForm.create_storage_select_box_options = async function () {
                const response = await get_api_data('setting-search-page', {
                    QueryVars: {
                        QueryName: 'storage',
                        FilterName: 'dbr_storage.id',
                    },
                    PageVars: {
                        Limit: 9999,
                        Offset: 0,
                    }
                })
                const storage_id_select = custom_create_options('Id', 'Name', response.data.Page)
                $('#balance-form').find('#storage-id-select').append(storage_id_select);
            }
        }( window.BalanceForm = window.BalanceForm || {}, jQuery ));
    </script>
@endsection
