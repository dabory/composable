<div class="tab-pane fade" id="delivery">
    @inject('cacheService', 'App\Services\CacheService')
    <input type="hidden" id="Id" name="Id" value="0">
    <input type="hidden" id="taken_on_unixtime" value="0">
    <input type="hidden" id="paid_on_unixtime" value="0">
    <input type="hidden" id="paymethod" value="">
    <div class="card-header p-0 mr-1">
        <div class="row">
            <div class="col-6 pr-0 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            @php
                                $brandCode = $mode === 'erp' ? 'user' : 'myapp';
                                $setup = $cacheService->getSetup('shop-status-permission', $brandCode);
                                $situationList = collect($codeTitle['status']['sorder'])->filter(function ($status) {
                                    return $status['Code'] !== '';
                                    /*return $status['Code'] !== '' && $status['Code'] !== '0' && $status['Code'] !== '1';*/
                                })->map(function ($status) {
                                    return array_merge($status, ['Unique' => $status['Code'] >= '0' && $status['Code'] <= '9' ? '0' : '1']);
                                })->groupBy('Unique')->toArray();

                                $situationList[0] = collect($situationList[0])->filter(function ($status) use ($setup) {
                                    if ($status['Code'] === '0' || $status['Code'] === '1') {
                                        return true;
                                    } else if ($status['Code'] === '2' && $setup['ShipPreShip']) {
                                        return true;
                                    } else if ($status['Code'] === '3' && $setup['ShipInTrans']) {
                                        return true;
                                    } else if ($status['Code'] === '4' && $setup['ShipFinish']) {
                                        return true;
                                    } else if ($status['Code'] === '5' && $setup['OrderComplete']) {
                                        return true;
                                    }
                                    return false;
                                })->toArray();

                            @endphp
                            @foreach ($situationList as $i => $chunk)
                                @if ($i === 0)
                                    <label class="m-0 font-weight-bold">주문진행 상태 처리</label>
                                @else
                                    <label class="m-0 font-weight-bold">클레임 상태 처리</label>
                                @endif

                                <div class="title-br"></div>

                                <div class="d-flex align-items-center mb-2">
                                    @forelse ($chunk as $key => $situation)
                                        @if ($situation['Code'] !== '')
                                            @if (in_array($situation['Code'], [0, 1, 3]))
                                                <div class="d-flex align-items-center mr-3">
                                                    <input type="radio" name="sorder_status" value="{{ $situation['Code'] }}" class="text-center mr-1" id="list-sorder-status-{{ $situation['Code'] }}"
                                                    >
                                                    <label class="mb-0" for="list-sorder-status-{{ $situation['Code'] }}">
                                                        {{ $situation['Title'] }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
{{--                        <div class="d-flex flex-column mb-2">--}}
{{--                            <label class="m-0 font-weight-bold">배송타입</label>--}}
{{--                            <div class="title-br"></div>--}}
{{--                            <div class="row d-flex align-items-center justify-content-around">--}}
{{--                                @foreach ($codeTitle['ship-type']['sorder'] as $key => $delivery_type)--}}
{{--                                    @if ($delivery_type['Code'] !== '')--}}
{{--                                        <div class="mr-1">--}}
{{--                                            <input type="radio" name="delivery_type" value="{{ $delivery_type['Code'] }}" tabindex="-1" class="text-center" id="delivery-type-{{ $delivery_type['Code'] }}"> <label class="mb-0" for="delivery-type-{{ $delivery_type['Code'] }}">{{ $delivery_type['Title'] }}</label>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">주문관련일시</label>
                            <div class="title-br"></div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">주문시각</div>
                                <div class="created_on"></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">결제시각</div>
                                <div class="paid_on"></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">주문접수</div>
                                <div class="taken_on"></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">배송타입</div>
                                <div class="delivery_type"></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">발송기한</div>
                                <div class="deadlined_on"></div>
                            </div>
                        </div>
{{--                        <div class="d-flex flex-column mb-2">--}}
{{--                            <label class="m-0 font-weight-bold">주문속성</label>--}}
{{--                            <div class="title-br"></div>--}}
{{--                        </div>--}}
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">주문정보</label>
                            <div class="title-br"></div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">주문자</div>
                                    <div class="company_name"></div>
                                </div>
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">주문자 전화번호</div>
                                    <div class="tel_no"></div>
                                </div>
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">주문자 휴대폰</div>
                                    <div class="mobile_no"></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">수령자</div>
                                    <div class="receiver_contact"></div>
                                </div>
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">수령자 휴대폰</div>
                                    <div class="receiver_mobile"></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex col-12 flex-column">
                                    <div class="mr-2 font-size-xs">수령자 주소</div>
                                    <div class="receiver_addr"></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">우편번호</div>
                                    <div class="receiver_zip_code"></div>
                                </div>
                                <div class="d-flex col-4 flex-column">
                                    <div class="mr-2 font-size-xs">배송기재사항</div>
                                    <div class="receiver_notes"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 px-1 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">배송정보</label>
                            <div class="title-br"></div>
                            <div class="d-flex">
                                <select type="text" id="courier_code" class="rounded w-100 mr-1">
                                    <option value="">=배송정보 선택=</option>
                                </select>
                                <input type="text" id="invoice_no" class="w-100 rounded" placeholder="국내운송장">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="tab-pane fade" id="claim">
    <div class="card-header p-0 mr-1">
        <div class="row">
            <div class="col-7 pr-0 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">클레임 처리</label>
                            <div class="title-br"></div>
                            @php
                                $situationList = collect($codeTitle['situation']['sorder'])
                                ->merge($codeTitle['body-situation']['sorder-bd'])
                                ->filter(function ($situation) {
                                    return $situation['Code'] !== '' && $situation['Code'] !== 'ETC';
                                })->filter(function ($situation) use ($setup) {
                                    if ($situation['Code'] === 'CS' && $setup['CancelSoldOut']) {
                                        return true;
                                    } else if ($situation['Code'] === 'CA' && $setup['CancelAdmin']) {
                                        return true;
                                    } else if ($situation['Code'] === 'CM' && $setup['CancelMemberReq']) {
                                        return true;
                                    } else if ($situation['Code'] === 'CC' && $setup['CancelConfirm']) {
                                        return true;
                                    } else if ($situation['Code'] === 'CO' && $setup['CancelComplete']) {
                                        return true;
                                    } else if ($situation['Code'] === 'RM' && $setup['ReturnRequest']) {
                                        return true;
                                    } else if ($situation['Code'] === 'RE' && $setup['ReturnReceive']) {
                                        return true;
                                    } else if ($situation['Code'] === 'RP' && $setup['ReturnPickup']) {
                                        return true;
                                    } else if ($situation['Code'] === 'RC' && $setup['ReturnComfirm']) {
                                        return true;
                                    } else if ($situation['Code'] === 'RO' && $setup['ReturnComplete']) {
                                        return true;
                                    } else if ($situation['Code'] === 'EM' && $setup['ExchangeRequest']) {
                                        return true;
                                    } else if ($situation['Code'] === 'EE' && $setup['ExchangeReceive']) {
                                        return true;
                                    } else if ($situation['Code'] === 'EP' && $setup['ExchangePickup']) {
                                        return true;
                                    } else if ($situation['Code'] === 'ES' && $setup['ExchangeShip']) {
                                        return true;
                                    } else if ($situation['Code'] === 'EO' && $setup['ExchangeComplete']) {
                                        return true;
                                    }

                                    return false;
                                })->map(function ($situation) {
                                    return array_merge($situation, ['Unique' => $situation['Code'][0]]);
                                })->groupBy('Unique')->toArray();
                            @endphp
                            @foreach ($situationList as $chunk)
                                <div class="d-flex align-items-center mb-2">
                                    @forelse ($chunk as $key => $situation)
                                        @if ($situation['Code'] !== '' && $situation['Code'] !== 'ETC' && $situation['Code'] !== '')
                                            <div class="d-flex align-items-center mr-3">
                                                <input type="radio" name="sorder_situation" value="{{ $situation['Code'] }}" class="text-center mr-1" id="list-situation-radio-{{ $situation['Code'] }}">
                                                <label class="mb-0" for="list-situation-radio-{{ $situation['Code'] }}">
                                                    {{ $situation['Title'] }}
                                                </label>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 px-1 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">클레임 사유</label>
                            <div class="title-br"></div>
                            <textarea id="situation_notes" style="height: 91px;"></textarea>
{{--                            <input type="text" class="rounded w-100" id="situation_notes">--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(async function() {
        $('#delivery input:radio[name=sorder_status]').on('change', function () {
            ListTypeList1FromTab.toggleNavLink($(this).val())
        });

        const response = await get_api_data('etc-page', {
            PageVars: {
                Query: "etc_type = 'smart-courier' and select_name = 'korean'",
                Asc: 'sort_no',
                Limit: 9999
            }
        })

        $('#delivery').find('#courier_code').append(create_options(response.data.Page))
    });

    (function( ListTypeList1FromTab, $, undefined ) {
        ListTypeList1FromTab.sorder

        ListTypeList1FromTab.save = async function () {
            const response = await get_api_data('sorder-act', {
                Page : [
                    ListTypeList1FromTab.getParameter()
                ]
            })

            show_iziToast_msg(response.data, async function () {
                const curr_status = $('#delivery').find(`input:radio[name=sorder_status]:checked`).val();
                const prev_status = ListTypeList1FromTab.sorder['Status'];

                const response = await get_api_data('sorder-pick', {
                    Page : [
                        { Id: ListTypeList1FromTab.sorder['Id'] }
                    ]
                })
                ListTypeList1FromTab.sorder = response.data.Page[0]
                console.log(ListTypeList1FromTab.sorder)
                if ($('#delivery').find('#paymethod').val() === 'Remit' &&
                        prev_status !== '1' &&
                        curr_status === '1') {
                    console.log('RemitCompleted (입금완료확인 알림톡 전송)')
                    // 입금완료확인 알림톡 전송
                    call_local_api('/dispatch-event', {
                        event_name: 'RemitCompleted',
                        event_data: ListTypeList1FromTab.sorder
                    });
                }

                if (prev_status !== '3' &&
                    curr_status === '3') {
                    console.log('ShippedAll (전체배송 알림톡 전송)')
                    call_local_api('/dispatch-event', {
                        event_name: 'ShippedAll',
                        event_data: ListTypeList1FromTab.sorder
                    });
                }

//                 if (prev_status !== '4' &&
//                     curr_status === '4') {
//                     console.log('Delivered (배송완료 알림톡 전송)')
//                     call_local_api('/dispatch-event', {
//                         event_name: 'Delivered',
//                         event_data: ListTypeList1FromTab.sorder
//                     });
//                 }
                $('#modal-select-popup.show').trigger('list.requery');
                // ListTypeList1FromTab.ui($('#delivery').find(`input[name="Id"]`).val())
            })
        }

        ListTypeList1FromTab.getParameter = function () {
            let id = parseInt($('#delivery').find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                Status: $('#delivery').find(`input:radio[name=sorder_status]:checked`).val(),
                CourierCode: $('#delivery').find('#courier_code').val(),
                InvoiceNo: $('#delivery').find('#invoice_no').val(),
                Situation: $('#claim').find(`input:radio[name=sorder_situation]:checked`).val(),
                SituationNotes: $('#claim').find('#situation_notes').val(),
            }

            if(parameter['CourierCode'] && parameter['InvoiceNo']){
                parameter['Status'] = '3'
            }
            if (parameter['Status'] === '2') {
                if ($('#delivery').find('#taken_on_unixtime').val() == 0) {
                    parameter['TakenOn'] = get_now_time_stamp()
                }
            }
            else if(parameter['Status'] === '1'){
                if ($('#delivery').find('#paid_on_unixtime').val() == 0) {
                    parameter['PaidOn'] = get_now_time_stamp()
                }
            }
            console.log(parameter)
            return parameter;
        }

        ListTypeList1FromTab.toggleNavLink = function (status) {
            if (status === 'C') {
                $('#claim-nav-item').find('.nav-link').show()
            } else {
                $('#claim-nav-item').find('.nav-link').hide()
            }
        }

        ListTypeList1FromTab.ui = async function (id) {
            let response = await get_api_data('sorder-pick', {
                Page : [ { Id: Number(id) } ]
            })
            const sorder = response.data.Page[0]
            ListTypeList1FromTab.sorder = sorder
            console.log(ListTypeList1FromTab.sorder)
            $('#delivery').find(`input[name="Id"]`).val(sorder['Id'])
            $('#delivery').find('#taken_on_unixtime').val(sorder['TakenOn'])
            $('#delivery').find('#paid_on_unixtime').val(sorder['PaidOn'])
            $('#delivery').find('#paymethod').val(sorder['Paymethod'])

            ListTypeList1FromTab.toggleNavLink(sorder['Status'])

            $('#delivery').find(`input:radio[name=sorder_status]:input[value='${sorder['Status']}']`).prop('checked', true)
            $('#delivery').find('.created_on').text(unixtimeFormatDate(sorder['CreatedOn']))

            if(sorder['PaidOn'] != 0){
                $('#delivery').find('.paid_on').text(unixtimeFormatDate(sorder['PaidOn']))
            }
            if(sorder['TakenOn'] != 0){
                $('#delivery').find('.taken_on').text(unixtimeFormatDate(sorder['TakenOn']))
            }
            if(sorder['DeadlinedOn'] != 0){
                $('#delivery').find('.deadlined_on').text(unixtimeFormatDate(sorder['DeadlinedOn']))
            }

            $('#delivery').find('.delivery_type').text(format_conver_for(sorder['DeliveryType'], "ship_type('sorder')"))

            response = await get_api_data('company-pick', {
                Page : [ { Id: sorder['BuyerId'] } ]
            })
            const company = response.data.Page[0]

            $('#delivery').find('.company_name').text(company['CompanyName'])
            $('#delivery').find('.tel_no').text(company['TelNo'])
            $('#delivery').find('.mobile_no').text(company['MobileNo'])
            $('#delivery').find('.receiver_contact').text(sorder['ReceiverContact'])
            $('#delivery').find('.receiver_mobile').text(sorder['ReceiverMobile'])
            $('#delivery').find('.receiver_addr').text(sorder['ReceiverAddr1'] + ' ' + sorder['ReceiverAddr2'])
            $('#delivery').find('.receiver_zip_code').text(sorder['ReceiverZipCode'])
            $('#delivery').find('.receiver_notes').text(sorder['ReceiverNotes'])

            $('#delivery').find('#invoice_no').val(sorder['InvoiceNo'])

            $('#claim').find(`input:radio[name=sorder_situation]:input[value='${sorder['Situation']}']`).prop('checked', true)
            $('#claim').find('#situation_notes').val(sorder['SituationNotes'])

            $('#delivery').find('#courier_code').val(sorder['CourierCode'])
        }

    }( window.ListTypeList1FromTab = window.ListTypeList1FromTab || {}, jQuery ));

</script>
