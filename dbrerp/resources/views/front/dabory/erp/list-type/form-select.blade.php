{{-- @extends('layouts.master')
@section('content') --}}

<div class="content" id="form-select">
    <div class="mb-1 pt-1 text-right d-flex justify-content-end" style="margin-top: -18px">

        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary form-select-act" data-value="list" {{ $formSelect['FormVars']['Hidden']['ListButton'] }}>
                {{ $formSelect['FormVars']['Title']['ListButton'] }}
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => $formSelect['HeadSelectOptions'],
                'eventClassName' => 'form-select-act',
            ])
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-solid rounded">
            <li class="nav-item"><a href="#TabA" class="nav-link active" data-toggle="tab">{{ $formSelect['FormVars']['Title']['TabA'] }}</a></li>
            <li class="nav-item"><a href="#TabB" class="nav-link" data-toggle="tab">{{ $formSelect['FormVars']['Title']['TabB'] }}</a></li>
        </ul>

        <div class="tab-content" id="frm">
            <div class="tab-pane fade active show" id="TabA">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['StrTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['Str'] as $key => $str)
                                        @if ($str['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $str['FilterName'] }}</label>
                                                <input type="text" id="str-{{ $key }}" class="rounded w-100 str" autocomplete="off">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['ChkTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['Chk'] as $key => $chk)
                                        @if ($chk['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $chk['FilterName'] }}</label>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="mr-1">
                                                        <input type="checkbox" value="1" tabindex="-1" class="text-center" id="no-chk-{{ $key }}" checked onchange="ListTypeFormSelect.reset_check_filters(this, '{{ count($chk['Opt']) }}')"> <label class="mb-0" for="no-chk-{{ $key }}">{{ $formSelect['FormVars']['Title']['NoCheck'] }}</label>
                                                    </div>
                                                    @foreach ($chk['Opt'] as $optKey => $option)
                                                        @if ($option['FilterName'])
                                                            <div class="mr-1">
                                                                <input type="checkbox" value="1" tabindex="-1" class="text-center" id="chk-{{ $key }}-opt-{{ $optKey }}" onchange="ListTypeFormSelect.reset_no_check_filter(this)"> <label class="mb-0" for="chk-{{ $key }}-opt-{{ $optKey }}">{{ $option['FilterName'] }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['RngTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['Rng'] as $key => $rng)
                                        @if ($rng['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $rng['FilterName'] }}</label>
                                                <div class="d-flex">
                                                    <input type="text" id="rng-from-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['From'] }}
                                                    </button>&nbsp;
                                                    <input type="text" id="rng-to-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['To'] }}
                                                    </button>&nbsp;
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2 bg-purple-300 text-white">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['DecTitle'] }}</p>
                                </div>
                                <div class="card-body pt-0">
                                    @foreach ($formSelect['FormVars']['Title']['Dec'] as $key => $dec)
                                        @if ($dec['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $dec['FilterName'] }}</label>
                                                <div class="d-flex">
                                                    <input type="text" id="dec-from-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['From'] }}
                                                    </button>&nbsp;
                                                    <input type="text" id="dec-to-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['To'] }}
                                                    </button>&nbsp;
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="TabB">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['StrTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['StrItem'] as $key => $strItem)
                                        @if ($strItem['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $strItem['FilterName'] }}</label>
                                                <input type="text" id="stritem-{{ $key }}" class="rounded w-100" autocomplete="off">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['ChkTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['ChkItem'] as $key => $chkItem)
                                        @if ($chkItem['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $chkItem['FilterName'] }}</label>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="mr-1">
                                                        <input type="checkbox" value="1" tabindex="-1" class="text-center" id="no-chkitem-{{ $key }}" checked onchange="ListTypeFormSelect.reset_check_filters(this, '{{ count($chkItem['Opt']) }}')"> <label class="mb-0" for="no-chkitem-{{ $key }}">{{ $formSelect['FormVars']['Title']['NoCheck'] }}</label>
                                                    </div>
                                                    @foreach ($chkItem['Opt'] as $optKey => $option)
                                                        @if ($option['FilterName'])
                                                            <div class="mr-1">
                                                                <input type="checkbox" value="1" tabindex="-1" class="text-center" id="chkitem-{{ $key }}-opt-{{ $optKey }}" onchange="ListTypeFormSelect.reset_no_check_filter(this)"> <label class="mb-0" for="chkitem-{{ $key }}-opt-{{ $optKey }}">{{ $option['FilterName'] }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['RngTitle'] }}</p>
                                </div>
                                <div class="card-body">
                                    @foreach ($formSelect['FormVars']['Title']['RngItem'] as $key => $rngItem)
                                        @if ($rngItem['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $rngItem['FilterName'] }}</label>
                                                <div class="d-flex">
                                                    <input type="text" id="rngitem-from-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['From'] }}
                                                    </button>&nbsp;
                                                    <input type="text" id="rngitem-to-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['To'] }}
                                                    </button>&nbsp;
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 p-1 card-header-item">
                            <div class="card card mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-header p-0 mb-2 bg-purple-300 text-white">
                                    <p class="card-title p-1 ml-2">{{ $formSelect['FormVars']['Title']['DecTitle'] }}</p>
                                </div>
                                <div class="card-body pt-0">
                                    @foreach ($formSelect['FormVars']['Title']['DecItem'] as $key => $decItem)
                                        @if ($decItem['FilterName'])
                                            <div class="d-flex flex-column mb-2">
                                                <label class="m-0">{{ $decItem['FilterName'] }}</label>
                                                <div class="d-flex">
                                                    <input type="text" id="decitem-from-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['From'] }}
                                                    </button>&nbsp;
                                                    <input type="text" id="decitem-to-{{ $key }}" class="rounded overflow-hidden w-100 text-nowrap col-4 px-0 mr-1" autocomplete="off">
                                                    <button type="button" tabindex="-1" class="btn-dark rounded border-0 overflow-hidden w-100 text-nowrap" style="height: 28px">
                                                        {{ $formSelect['FormVars']['Title']['To'] }}
                                                    </button>&nbsp;
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('js')
    <script>
        $(document).ready(async function() {
            $('#form-select .form-select-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': ListTypeFormSelect.list(); break;
                    case 'clear-all-filter': ListTypeFormSelect.clear_all_filter(); break;
                }
            });

            $('#form-select input').on('dblclick', function () {
                $(this).val('')
            });

            $('#form-select .str').on('keyup', function (event) {
                if (event.keyCode === 13) {
                    ListTypeFormSelect.list()
                    $(this).blur()
                }
            });
        });

        (function( ListTypeFormSelect, $, undefined ) {
            ListTypeFormSelect.para = {!! json_encode($formSelect) !!};

            ListTypeFormSelect.reset_check_filters = function ($this, option_count) {
                if ($($this).prop('checked')) {
                    for (let j = 0; j < option_count; j++) {
                        const split_list = $($this).attr('id').split('-')
                        $('#form-select').find(`#${split_list[1]}-${split_list[2]}-opt-${j}`).prop('checked', false)
                    }
                }
            }

            ListTypeFormSelect.reset_no_check_filter = function ($this) {
                if ($($this).prop('checked')) {
                    const split_list = $($this).attr('id').split('-')
                    $('#form-select').find(`#no-${split_list[0]}-${split_list[1]}`).prop('checked', false)
                }
            }

            ListTypeFormSelect.clear_all_filter = function () {
                input_box_reset_for('#form-select #frm')
                const tabs = ['', 'Item']
                tabs.forEach(key => {
                    ListTypeFormSelect.para['FormVars']['Title']['Chk' + key].forEach((chk, i) => {
                        $('#form-select').find(`#no-chk${key.toLowerCase()}-${i}`).prop('checked', true)
                    });
                });
            }


            ListTypeFormSelect.list = async function () {
                    const tabs = ['', 'Item']
                    let where = '';
                    const strColumns = ['CompanyName', 'TelNo', 'MobileNo', 'Email']
                    const chkColumns = ['Sex', 'IsOkText', 'IsOkEmail', 'IsOkDm']
                    const rngColumns = ['BirthDate', 'BirthDate', 'LastVistDate', 'LastSOrderDate', 'SellerName']
                    const decColumns = ['SorderSum', 'RewardSum']

                    tabs.forEach(key => {
                        ListTypeFormSelect.para['FormVars']['Title']['Str' + key].forEach((str, i) => {
                            const val = $('#form-select').find(`#str${key.toLowerCase()}-${i}`).val()
                            if (! str['FilterName'] || isEmpty(val)) { return; }
                            where += `${strColumns[i]} LIKE '%${val}%' AND `
                        });

                        let arr = [];
                        ListTypeFormSelect.para['FormVars']['Title']['Chk' + key].forEach((chk, i) => {
                            if (! chk['FilterName']) { return; }
                            arr[i] = new Array(chk['Opt'].length)
                            chk['Opt'].forEach((option, j) => {
                                if (! option['FilterName']) { return; }

                                const chk = $('#form-select').find(`#chk${key.toLowerCase()}-${i}-opt-${j}`)


                                let filter_value

                                if ($('#form-select').find(`#no-chk${key.toLowerCase()}-${i}`).prop('checked')) { filter_value = null }

                                if ($(chk).prop('checked')) {
                                    filter_value = '1'

                                    if (chkColumns[i] === 'Sex') {
                                        if (j === 0) {
                                            filter_value = 'm'
                                        } else if (j === 1) {
                                            filter_value = 'w'
                                        }
                                    }
                                } else {
                                    filter_value = '0'
                                }

                                arr[i][j] = filter_value
                            });
                        });

                        arr.forEach((chk, i) => {
                            chk.forEach((option, j) => {
                                if (option === null || option === '0') {
                                    return
                                }

                                where += `${chkColumns[i]} = '${option}' OR `
                            })

                            where = where.replace(/\s+OR \s*$/, ' AND ')
                        })

                        ListTypeFormSelect.para['FormVars']['Title']['Rng' + key].forEach((rng, i) => {
                            const from_value = $('#form-select').find(`#rng${key.toLowerCase()}-from-${i}`).val()
                            const to_value = $('#form-select').find(`#rng${key.toLowerCase()}-to-${i}`).val()

                            if (! rng['FilterName'] || isEmpty(from_value) || isEmpty(to_value)) { return; }

                            where += `${rngColumns[i]} BETWEEN '${from_value}' AND '${to_value}' AND `
                            if (i === 0 || i === 1) {
                                where += `IsLunar = '${i}' AND `
                            }
                        });

                        ListTypeFormSelect.para['FormVars']['Title']['Dec' + key].forEach((dec, i) => {
                            const from_value = $('#form-select').find(`#dec${key.toLowerCase()}-from-${i}`).val()
                            const to_value = $('#form-select').find(`#dec${key.toLowerCase()}-to-${i}`).val()

                            if (! dec['FilterName'] || isEmpty(from_value) || isEmpty(to_value)) { return; }
                            where += `${decColumns[i]} BETWEEN '${from_value}' AND '${to_value}' AND `
                        });

                    });

                where = where.replace(/\s+AND \s*$/, '')

                let query = `SELECT MobileNo, CompanyName, BirthDate, LastVistDate, LastSOrderDate,
  RewardSum, Email, SellerName, CgroupName FROM erp_buyer`
                if (where) {
                    query += ` WHERE ${where}`
                }

                console.log(query)
                const response = await call_local_api('/dabory-app/elasticsearch', {
                    query: query
                })

                // 엑셀 형식으로 변환
                const rows = [
                    response.data,
                ]

                $('#modal-uploaders').trigger('excel.upload', [rows, 0]);
                $('#modal-multi-popup.show').modal('hide');
            }

            // ListTypeFormSelect.list = async function () {
            //     let SelectType1Vars = []
            //     const tabs = ['', 'Item']
            //     tabs.forEach(key => {
            //         let select_vars = { Str: [], Chk: [], Rng: [], Dec: [] };
            //         ListTypeFormSelect.para['FormVars']['Title']['Str' + key].forEach((str, i) => {
            //             if (! str['FilterName']) { return; }
            //             select_vars['Str'].push({
            //                 FilterValue: $('#form-select').find(`#str${key.toLowerCase()}-${i}`).val()
            //             })
            //         });
            //
            //         ListTypeFormSelect.para['FormVars']['Title']['Chk' + key].forEach((chk, i) => {
            //             if (! chk['FilterName']) { return; }
            //             let opt = [];
            //             chk['Opt'].forEach((option, j) => {
            //                 if (! option['FilterName']) { return; }
            //
            //                 let filter_value = $('#form-select').find(`#chk${key.toLowerCase()}-${i}-opt-${j}:checked`).val() ?? '0'
            //                 if ($('#form-select').find(`#no-chk${key.toLowerCase()}-${i}`).prop('checked')) { filter_value = '' }
            //                 opt.push({ FilterValue: filter_value })
            //             });
            //             select_vars['Chk'].push({ Opt: opt });
            //         });
            //
            //         ListTypeFormSelect.para['FormVars']['Title']['Rng' + key].forEach((rng, i) => {
            //             if (! rng['FilterName']) { return; }
            //             select_vars['Rng'].push({
            //                 FromValue: $('#form-select').find(`#rng${key.toLowerCase()}-from-${i}`).val(),
            //                 ToValue: $('#form-select').find(`#rng${key.toLowerCase()}-to-${i}`).val(),
            //             })
            //         });
            //
            //         ListTypeFormSelect.para['FormVars']['Title']['Dec' + key].forEach((dec, i) => {
            //             if (! dec['FilterName']) { return; }
            //             select_vars['Dec'].push({
            //                 FromValue: $('#form-select').find(`#dec${key.toLowerCase()}-from-${i}`).val(),
            //                 ToValue: $('#form-select').find(`#dec${key.toLowerCase()}-to-${i}`).val(),
            //             })
            //         });
            //
            //         SelectType1Vars.push(select_vars)
            //     });
            //
            //     // console.log({
            //     //     QueryVars: {
            //     //         QueryName: ListTypeFormSelect.para['QueryVars']['QueryName'],
            //     //     },
            //     //     SelectType1Vars: {
            //     //         ListToken: '',
            //     //         Having: {Prefix: 'mx', ...SelectType1Vars[0]},
            //     //         Where: {Prefix: 'mb', ...SelectType1Vars[1]},
            //     //         IsDownloadList: true,
            //     //         OrderBy: 'mx.created_on desc'
            //     //     },
            //     //     PageVars: {
            //     //         Limit: 10,
            //     //         Offset: 0,
            //     //     }
            //     // })
            //     let response = await get_api_data(ListTypeFormSelect.para['General']['PageApi'], {
            //         QueryVars: {
            //             QueryName: ListTypeFormSelect.para['QueryVars']['QueryName'],
            //         },
            //         SelectType1Vars: {
            //             ListToken: '',
            //             Having: {Prefix: 'mb', ...SelectType1Vars[1]},
            //             Where: {Prefix: 'mx', ...SelectType1Vars[0]},
            //             IsDownloadList: true,
            //             OrderBy: 'mx.created_on desc'
            //         },
            //         PageVars: {
            //             Limit: 10,
            //             Offset: 0,
            //         }
            //     })
            //     console.log(response)
            //     $('#form-select').trigger('list.token.update', [ response.data['SelectType1Vars']['ListToken'] ]);
            //     $('#modal-multi-popup.show').modal('hide');
            // }

            ListTypeFormSelect.show_popup_callback = function () {
                ListTypeFormSelect.init_display_vars()
            }

            ListTypeFormSelect.init_display_vars = function () {
                $('#modal-multi-popup.list-type-form-select .modal-header').addClass('bg-blue-600')
                $('#modal-multi-popup.list-type-form-select .modal-body button').addClass('bg-blue-600 border-blue-600 bg-blue-600-hover')

                $('#modal-multi-popup.list-type-form-select .modal-header').removeClass('bg-dark-alpha')
                $('#modal-multi-popup.list-type-form-select .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

                $('#modal-multi-popup.list-type-form-select .modal-dialog').css('maxWidth', `${ListTypeFormSelect.para['PopupList1Vars']['PopupWidth']}px`);
            }
        }( window.ListTypeFormSelect = window.ListTypeFormSelect || {}, jQuery ));
    </script>
@endpush
@endonce
