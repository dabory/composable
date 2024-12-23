<div class="content" id="form-filter-shop-order-sorder-pro-total-popfil">
    <div class="mb-1 pt-1 text-right d-flex justify-content-end" style="margin-top: -18px">

        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary form-filter-shop-order-sorder-pro-total-popfil-act" data-value="list">
                조회
            </button>

            @include('front.dabory.erp.partial.select-btn-options', [
                                'selectBtns' => array_slice($type1['HeadSelectOptions'], 1),
                                'eventClassName' => 'form-filter-shop-order-sorder-pro-total-popfil-act',
                            ])
            {{-- @include('front.dabory.erp.partial.select-btn-options', [                              --}}
            {{--    'selectBtns' => [                                                                   --}}
            {{--        [ 'Value' => 'clear-all-filter', 'Caption' => '초기화' ],                        --}}
            {{--    'eventClassName' => 'form-filter-shop-order-sorder-pro-total-popfil-act',            --}}
            {{--])                                                                                       --}}
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-solid rounded">
            <li class="nav-item"><a href="#TabA" class="nav-link active" data-toggle="tab">기본 필터</a></li>
{{--            <li class="nav-item"><a href="#TabB" class="nav-link" data-toggle="tab">추가 필터</a></li>--}}
        </ul>

        <div class="tab-content" id="frm">
            <div class="tab-pane fade active show" id="TabA">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <select type="text" id="date-sort" class="rounded w-100">
                                            <option value="sorder_date">주문일</option>
                                            <option value="turbo_porder_date">발주확인일</option>
                                            <option value="turbo_ship_date">배송처리일</option>
                                        </select>
                                    </div>
                                    @include('front.dabory.erp.popup-form1.form-filter.data-navi', [
                                        'navieName' => 'form-filter-shop-order-sorder-pro-total-popfil-date-navi'
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="{{ $default['FormVars']['Display']['Company'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['Company'] }}</label>
                                        <select id="company-select" name="company" class="company-selection-multiple" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['OrderSearch'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['OrderSearch'] }}</label>
                                        <div class="d-flex">
                                            <select type="text" id="order-search-field" class="rounded w-100 mr-1 col-4">
                                                <option value="buy.company_name">주문자명</option>
                                                <option value="mx.ship_contact">수취인명</option>
                                                <option value="buy.mobile_no">주문자연락처</option>
                                                <option value="buy.email">주문자이메일</option>
                                                <option value="mx.sorder_no">주문번호</option>
                                                <option value="itm.item_code">상품코드</option>
                                                <option value="mx.invoice_no">송장번호</option>
                                            </select>
                                            <input type="text" class="rounded w-100 col" id="order-search-value" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="{{ $default['FormVars']['Display']['SorderStatus'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['SorderStatus'] }}</label>
                                        <div class="row d-flex align-items-center justify-content-start">
                                            <div class="col-3">
                                                <input type="checkbox" value="" name="sorder_status" tabindex="-1"
                                                       {{ $default['General']['CustomVar'] === 'C' || $default['General']['CustomVar'] === 'R' || $default['General']['CustomVar'] === 'E' ? '' : 'checked' }}
                                                       class="text-center all" id="sorder-status-all">
                                                <label class="mb-0" for="sorder-status-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['status']['sorder'] as $key => $status)
                                                @if ($status['Code'] !== '')
                                                    <div class="col-3">
                                                        <input type="checkbox" value="{{ $status['Code'] }}" name="sorder_status" tabindex="-1" class="text-center"
                                                               onclick="PopupForm1FormFilterShopOrderSorderProTotalPopfil.click_sorder_status(this)"
                                                               {{ ($default['General']['CustomVar'] === 'C' || $default['General']['CustomVar'] === 'R' || $default['General']['CustomVar'] === 'E') && $status['Code'] === 'C' ? 'checked' : '' }}
                                                               id="sorder-status-{{ $status['Code'] }}"> <label class="mb-0" for="sorder-status-{{ $status['Code'] }}">{{ $status['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex-column mb-2" style="display: none;" id="sorder-situation-div">
                                        <label class="m-0">{{ $default['FormVars']['Title']['SorderSituation'] }}</label>
                                        <div class="row d-flex align-items-center justify-content-start">
                                            <div class="col-3">
                                                <input type="checkbox" value="" name="sorder_situation" tabindex="-1"
                                                       {{ $default['General']['CustomVar'] === 'C' || $default['General']['CustomVar'] === 'R' || $default['General']['CustomVar'] === 'E' ? '' : 'checked' }}
                                                       class="text-center all" id="sorder-situation-all">
                                                <label class="mb-0" for="sorder-situation-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['situation']['sorder'] as $key => $situation)
                                                @if ($situation['Code'] !== '')
                                                    <div class="col-3">
                                                        <input type="checkbox" value="{{ $situation['Code'] }}" name="sorder_situation" tabindex="-1" class="text-center"
                                                               {{ ($default['General']['CustomVar'] === 'C' || $default['General']['CustomVar'] === 'R' || $default['General']['CustomVar'] === 'E') && $situation['Code'] === 'C' ? 'checked' : '' }}
                                                               id="sorder-situation-{{ $situation['Code'] }}"> <label class="mb-0" for="sorder-situation-{{ $situation['Code'] }}">{{ $situation['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="{{ $default['FormVars']['Display']['CargoType'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['CargoType'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="cargo_type" value="" tabindex="-1" class="text-center all" id="cargo-type-all" checked> <label class="mb-0" for="cargo-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['cargo-type']['sorder'] as $key => $cargo_type)
                                                @if ($cargo_type['Code'] !== '')
                                                    <div class="mr-1">
                                                        <input type="radio" name="cargo_type" value="{{ $cargo_type['Code'] }}" tabindex="-1" class="text-center" id="cargo-type-{{ $cargo_type['Code'] }}"> <label class="mb-0" for="cargo-type-{{ $cargo_type['Code'] }}">{{ $cargo_type['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['ShipType'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['ShipType'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around row">
                                            <div class="col-3">
                                                <input type="radio" name="ship_type" value="" tabindex="-1" class="text-center all" id="ship-type-all" checked> <label class="mb-0" for="ship-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['ship-type']['sorder'] as $key => $ship_type)
                                                @if ($ship_type['Code'] !== '')
                                                    <div class="col-3">
                                                        <input type="radio" name="ship_type" value="{{ $ship_type['Code'] }}" tabindex="-1" class="text-center" id="ship-type-{{ $ship_type['Code'] }}"> <label class="mb-0" for="ship-type-{{ $ship_type['Code'] }}">{{ $ship_type['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['DelayType'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['DelayType'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="delay_type" value="" tabindex="-1" class="text-center all" id="delay-type-all" checked> <label class="mb-0" for="delay-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['delay-type']['sorder'] as $key => $delivery_type)
                                                @if ($delivery_type['Code'] !== '')
                                                    <div class="mr-1">
                                                        <input type="radio" name="delay_type" value="{{ $delivery_type['Code'] }}" tabindex="-1" class="text-center" id="delay-type-{{ $delivery_type['Code'] }}"> <label class="mb-0" for="delay-type-{{ $delivery_type['Code'] }}">{{ $delivery_type['Title'] }}</label>
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
            <div class="tab-pane fade" id="TabB">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
    <script>
        $(document).ready(function() {
            $('#form-filter-shop-order-sorder-pro-total-popfil .form-filter-shop-order-sorder-pro-total-popfil-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': PopupForm1FormFilterShopOrderSorderProTotalPopfil.list(); break;
                    case 'clear-all-filter': PopupForm1FormFilterShopOrderSorderProTotalPopfil.clear_all_filter(); break;
                    case 'custom-xls-report': PopupForm1FormFilterShopOrderSorderProTotalPopfil.custom_xls_report(this); break;
                }
            });

            $('#form-filter-shop-order-sorder-pro-total-popfil input[name=sorder_status]').on('change', function () {
                if ($(this).prop('checked')) {
                    if ($(this).val()) {
                        $('input[name=sorder_status].all').prop('checked', false)
                    } else {
                        $('input[name=sorder_status]').each(function () {
                            if (! $(this).hasClass('all')) {
                                $(this).prop('checked', false)
                            }
                        })
                        $('#sorder-situation-all').prop('checked', true)
                        $('input[name=sorder_situation]').each(function () {
                            if (! $(this).hasClass('all')) {
                                $(this).prop('checked', false)
                            }
                        })
                    }
                }
            });

            $('#form-filter-shop-order-sorder-pro-total-popfil input[name=sorder_situation]').on('change', function () {
                if ($(this).prop('checked')) {
                    if ($(this).val()) {
                        $('input[name=sorder_situation].all').prop('checked', false)
                    } else {
                        $('input[name=sorder_situation]').each(function () {
                            if (! $(this).hasClass('all')) {
                                $(this).prop('checked', false)
                            }
                        })
                    }
                }
            });

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.init_company_list()

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.default['DisplayVars']?.['SorderStatus'].forEach(function ($status) {
                $('#sorder-status-all').prop('checked', false)
                $('#sorder-status-' + $status).prop('checked', true)
                $('#sorder-situation-div').show()
            });

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.default['DisplayVars']?.['SorderSituation'].forEach(function ($situation) {
                $('#sorder-situation-all').prop('checked', false)
                $('#sorder-situation-' + $situation).prop('checked', true)
            });

        });

        (function( PopupForm1FormFilterShopOrderSorderProTotalPopfil, $, undefined ) {
            PopupForm1FormFilterShopOrderSorderProTotalPopfil.default = {!! json_encode($default) !!};

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.click_sorder_status = function($this) {
                if ($($this).val() === 'C') {
                    if ($($this).prop('checked')) {
                        $('#sorder-situation-div').show()
                    } else {
                        $('#sorder-situation-div').hide()
                    }
                }
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.show_popup_callback = function () {
                PopupForm1FormFilterShopOrderSorderProTotalPopfil.init_display_vars()
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.init_company_list = async function () {
                const response = await get_api_data('company-page', {
                    PageVars: {
                        Query: "company_class = 'BB'",
                        Asc: 'id',
                        Limit: 9999
                    }
                })

                const page = response.data.Page ?? []
                const data = page.map(company => {
                    return { id: company['Id'], text: company['CompanyName'] }
                })

                $('#company-select').select2({
                    placeholder: 'Search or Select a Company',
                    multiple: true,
                    allowClear: true,
                    data : data
                });
            }


            PopupForm1FormFilterShopOrderSorderProTotalPopfil.clear_all_filter = function () {
                input_box_reset_for('#form-filter-shop-order-sorder-pro-total-popfil #frm')
                $("input:radio[name=form-filter-shop-order-sorder-pro-total-popfil-date-navi]:input[value='day']").prop('checked', true);
                $('#form-filter-shop-order-sorder-pro-total-popfil').find('input.all').prop('checked', true)
                $('#form-filter-shop-order-sorder-pro-total-popfil-date-navi-btn').trigger('click')
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.get_query = function ($this) {
                const $form_filter_shop_order_sorder_pro_total_popfil = '#form-filter-shop-order-sorder-pro-total-popfil'
                const start_date = $($form_filter_shop_order_sorder_pro_total_popfil).find('#form-filter-shop-order-sorder-pro-total-popfil-date-navi-start-date').val()
                const end_date = $($form_filter_shop_order_sorder_pro_total_popfil).find('#form-filter-shop-order-sorder-pro-total-popfil-date-navi-end-date').val()
                const date_sort = $($form_filter_shop_order_sorder_pro_total_popfil).find('#date-sort').val()
                const start_timestamp = moment(new Date(start_date)).format('YYYYMMDD')
                const end_timestamp = moment(new Date(end_date)).format('YYYYMMDD')
                let query = `(${date_sort} >= ${start_timestamp} and ${date_sort} <= ${end_timestamp})`

                let company_query = $($form_filter_shop_order_sorder_pro_total_popfil).find('select[name=company]').val().reduce((result, company) => {
                    return result += `itm.supplier_id = ${company} or `
                }, '').replace(/\s+or $/, '')

                if (company_query) {
                    query = query + ` and (${company_query})`
                }

                const order_search_value = $($form_filter_shop_order_sorder_pro_total_popfil).find('#order-search-value').val()
                if (order_search_value) {
                    const order_search_field = $($form_filter_shop_order_sorder_pro_total_popfil).find('#order-search-field').val()
                    query += ` and ${order_search_field} like '%${order_search_value}%'`
                }

                let sorder_status_query = ''
                $($form_filter_shop_order_sorder_pro_total_popfil).find('input[name=sorder_status]:checked').each(function () {
                    if ($(this).val()) {
                        const status = $(this).val()
                        sorder_status_query += `mx.status = '${status}' or `
                    }
                })
                sorder_status_query = sorder_status_query.replace(/\s+or $/, '')

                if (sorder_status_query) {
                    query = query + ` and (${sorder_status_query})`
                }

                let sorder_situation_query = ''
                $($form_filter_shop_order_sorder_pro_total_popfil).find('input[name=sorder_situation]:checked').each(function () {
                    if ($(this).val()) {
                        const situation = $(this).val()
                        sorder_situation_query += `mx.situation = '${situation}' or `
                    }
                })
                sorder_situation_query = sorder_situation_query.replace(/\s+or $/, '')

                if (sorder_situation_query) {
                    query = query + ` and (${sorder_situation_query})`
                }

                const cargo_type = $($form_filter_shop_order_sorder_pro_total_popfil).find('input[name=cargo_type]:checked').val()
                const ship_type = $($form_filter_shop_order_sorder_pro_total_popfil).find('input[name=ship_type]:checked').val()
                const delay_type = $($form_filter_shop_order_sorder_pro_total_popfil).find('input[name=delay_type]:checked').val()
                if (cargo_type) {
                    query += ` and mx.cargo_type = '${cargo_type}'`
                }
                if (ship_type) {
                    query += ` and mx.ship_type = '${ship_type}'`
                }
                if (delay_type) {
                    query += ` and mx.delay_type = '${delay_type}'`
                }

                switch (PopupForm1FormFilterShopOrderSorderProTotalPopfil.default['General']['CustomVar']) {
                    case 'C':
                        query = query + ` and (situation = 'CM')`
                        break;
                    case 'R':
                        query = query + ` and (situation = 'RM')`
                        break;
                    case 'E':
                        query = query + ` and (situation = 'EM')`
                        break;
                }

                return query;
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.custom_xls_report = function ($this) {
                const query = PopupForm1FormFilterShopOrderSorderProTotalPopfil.get_query();
                console.log(query);
                // console.log($this);
                type1_custom_xls_report($this, query);
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.init_display_vars = function () {
                $('#modal-multi-popup.popup-form1-form-filter-shop-order-sorder-pro-total-popfil .modal-header').addClass('bg-blue-600')
                // $('#modal-multi-popup.popup-form1-form-filter-shop-order-sorder-pro-total-popfil .modal-body button').addClass('bg-blue-600 border-blue-600 bg-blue-600-hover')

                $('#modal-multi-popup.popup-form1-form-filter-shop-order-sorder-pro-total-popfil .modal-header').removeClass('bg-dark-alpha')
                $('#modal-multi-popup.popup-form1-form-filter-shop-order-sorder-pro-total-popfil .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')
                $('#modal-multi-popup.popup-form1-form-filter-shop-order-sorder-pro-total-popfil .modal-dialog').css('maxWidth', `1550px`);
            }

            PopupForm1FormFilterShopOrderSorderProTotalPopfil.list = function () {
                const query = PopupForm1FormFilterShopOrderSorderProTotalPopfil.get_query();
                console.log(query)
                $('#modal-multi-popup').trigger('list.filter', [ query ]);
                $('#modal-multi-popup.show').modal('hide');

            }
        }( window.PopupForm1FormFilterShopOrderSorderProTotalPopfil = window.PopupForm1FormFilterShopOrderSorderProTotalPopfil || {}, jQuery ));
    </script>
@endpush
@endonce
