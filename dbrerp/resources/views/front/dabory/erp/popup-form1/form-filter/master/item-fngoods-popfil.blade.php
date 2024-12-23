<div class="content" id="form-filter-master-item-fngoods-popfil">
    <div class="mb-1 pt-1 text-right d-flex justify-content-end" style="margin-top: -18px">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary form-filter-master-item-fngoods-popfil-act" data-value="list">
                조회
            </button>
            @include('front.dabory.erp.partial.select-btn-options', [
                'selectBtns' => [
                    [ 'Value' => 'clear-all-filter', 'Caption' => '초기화' ],
                ],
                'eventClassName' => 'form-filter-master-item-fngoods-popfil-act',
            ])
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-solid rounded">
            <li class="nav-item"><a href="#TabA" class="nav-link active" data-toggle="tab">기본 필터</a></li>
            <li class="nav-item"><a href="#TabB" class="nav-link" data-toggle="tab">추가 필터</a></li>
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
                                            <option value="mx.created_on">상품 등록일</option>
                                            <option value="mx.updated_on">최종 수정일</option>
                                        </select>
                                    </div>
                                    @include('front.dabory.erp.popup-form1.form-filter.data-navi', [
                                        'navieName' => 'form-filter-master-item-fngoods-popfil-date-navi'
                                    ])

                                    <div class="{{ $default['FormVars']['Display']['ItemCode'] }} flex-column mb-2 mt-1">
                                        <label class="m-0">{{ $default['FormVars']['Title']['ItemCode'] }}</label>
                                        <input type="text" class="rounded w-100" id="item-code" autocomplete="off">
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['ItemName'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['ItemName'] }}</label>
                                        <input type="text" class="rounded w-100" id="item-name" autocomplete="off">
                                    </div>
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
                                    <div class="{{ $default['FormVars']['Display']['Brand'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['Brand'] }}</label>
                                        <select id="brand-select" name="brand" class="brand-selection-multiple" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['Igroup'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['Igroup'] }}</label>
                                        <select id="igroup-select" name="igroup" class="igroup-selection-multiple" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['ModelNo'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['ModelNo'] }}</label>
                                        <input type="text" class="rounded w-100" id="model-no" autocomplete="off">
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['Tags'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['Tags'] }}</label>
                                        <input type="text" class="rounded w-100" id="tags" autocomplete="off">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p-1 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="{{ $default['FormVars']['Display']['CargoType'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['CargoType'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="cargo_type" value="" tabindex="-1" class="text-center all" id="cargo-type-all" checked> <label class="mb-0" for="cargo-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['cargo-type']['item'] as $key => $cargo_type)
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
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="ship_type" value="" tabindex="-1" class="text-center all" id="ship-type-all" checked> <label class="mb-0" for="ship-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['ship-type']['item'] as $key => $ship_type)
                                                @if ($ship_type['Code'] !== '')
                                                    <div class="mr-1">
                                                        <input type="radio" name="ship_type" value="{{ $ship_type['Code'] }}" tabindex="-1" class="text-center" id="ship-type-{{ $ship_type['Code'] }}"> <label class="mb-0" for="ship-type-{{ $ship_type['Code'] }}">{{ $ship_type['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['ItemStatus'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['ItemStatus'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="item_status" value="" tabindex="-1" class="text-center all" id="item-status-all" checked> <label class="mb-0" for="item-status-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['status']['item'] as $key => $status)
                                                @if ($status['Code'] !== '')
                                                    <div class="mr-1">
                                                        <input type="radio" name="item_status" value="{{ $status['Code'] }}" tabindex="-1" class="text-center" id="item-status-{{ $status['Code'] }}"> <label class="mb-0" for="item-status-{{ $status['Code'] }}">{{ $status['Title'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="{{ $default['FormVars']['Display']['IsntPro'] }} flex-column mb-2">
                                        <label class="m-0">{{ $default['FormVars']['Title']['IsntPro'] }}</label>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="mr-1">
                                                <input type="radio" name="expose_type" value="" tabindex="-1" class="text-center all" id="expose-type-all" checked> <label class="mb-0" for="expose-type-all">전체</label>
                                            </div>
                                            @foreach ($codeTitle['expose-type']['item'] as $key => $expose_type)
                                                @if ($expose_type['Code'] !== '')
                                                    <div class="mr-1">
                                                        <input type="radio" name="expose_type" value="{{ $expose_type['Code'] }}" tabindex="-1" class="text-center" id="expose-type-{{ $expose_type['Code'] }}"> <label class="mb-0" for="expose-type-{{ $expose_type['Code'] }}">{{ $expose_type['Title'] }}</label>
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
            $('#form-filter-master-item-fngoods-popfil .form-filter-master-item-fngoods-popfil-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'list': PopupForm1FormFilterMasterItemFngoodsPopfil.list(); break;
                    case 'clear-all-filter': PopupForm1FormFilterMasterItemFngoodsPopfil.clear_all_filter(); break;
                }
            });

            PopupForm1FormFilterMasterItemFngoodsPopfil.init_company_list();
            PopupForm1FormFilterMasterItemFngoodsPopfil.init_brand_list();
            PopupForm1FormFilterMasterItemFngoodsPopfil.init_igroup_list();
        });

        (function( PopupForm1FormFilterMasterItemFngoodsPopfil, $, undefined ) {
            PopupForm1FormFilterMasterItemFngoodsPopfil.init_company_list = async function () {
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

            PopupForm1FormFilterMasterItemFngoodsPopfil.init_brand_list = async function () {
                const response = await get_api_data('etc-page', {
                    PageVars: {
                        Query: "select_name = 'brand'",
                        Asc: 'id',
                        Limit: 9999
                    }
                })

                const page = response.data.Page ?? []
                const data = page.map(brand => {
                    return { id: brand['Value'], text: brand['Caption'] }
                })

                $('#brand-select').select2({
                    placeholder: 'Search or Select a Brand',
                    multiple: true,
                    allowClear: true,
                    data : data
                });
            }

            PopupForm1FormFilterMasterItemFngoodsPopfil.init_igroup_list = async function () {
                const response = await get_api_data('igroup-page', {
                    PageVars: {
                        Query: "is_end_level = '1'",
                        Asc: 'id',
                        Limit: 9999
                    }
                })

                const page = response.data.Page ?? []
                const data = page.map(igroup => {
                    return { id: igroup['IgroupCode'], text: igroup['BreadCrumb'] }
                })

                $('#igroup-select').select2({
                    placeholder: 'Search or Select a Igroup',
                    multiple: true,
                    allowClear: true,
                    data : data
                });
            }

            PopupForm1FormFilterMasterItemFngoodsPopfil.show_popup_callback = function () {
                PopupForm1FormFilterMasterItemFngoodsPopfil.init_display_vars()
            }

            PopupForm1FormFilterMasterItemFngoodsPopfil.clear_all_filter = function () {
                input_box_reset_for('#form-filter-master-item-fngoods-popfil #frm')
                $("input:radio[name=form-filter-master-item-fngoods-popfil-date-navi]:input[value='day']").prop('checked', true);
                $('#form-filter-master-item-fngoods-popfil').find('input.all').prop('checked', true)
                $('#form-filter-master-item-fngoods-popfil-date-navi-btn').trigger('click')
            }

            PopupForm1FormFilterMasterItemFngoodsPopfil.init_display_vars = function () {
                $('#modal-multi-popup.popup-form1-form-filter-master-item-fngoods-popfil .modal-header').addClass('bg-blue-600')
                // $('#modal-multi-popup.popup-form1-form-filter-master-item-fngoods-popfil .modal-body button').addClass('bg-blue-600 border-blue-600 bg-blue-600-hover')

                $('#modal-multi-popup.popup-form1-form-filter-master-item-fngoods-popfil .modal-header').removeClass('bg-dark-alpha')
                $('#modal-multi-popup.popup-form1-form-filter-master-item-fngoods-popfil .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')
                $('#modal-multi-popup.popup-form1-form-filter-master-item-fngoods-popfil .modal-dialog').css('maxWidth', `1500px`);
            }

            PopupForm1FormFilterMasterItemFngoodsPopfil.list = function () {
                const $form_filter_master_item_shop = '#form-filter-master-item-fngoods-popfil'

                const start_date = $($form_filter_master_item_shop).find('#form-filter-master-item-fngoods-popfil-date-navi-start-date').val()
                const end_date = $($form_filter_master_item_shop).find('#form-filter-master-item-fngoods-popfil-date-navi-end-date').val()

                const start_timestamp = get_time_stamp_for(new Date(start_date))
                const end_timestamp = get_time_stamp_for(new Date(end_date))
                const date_sort = $($form_filter_master_item_shop).find('#date-sort').val()
                let query = `(${date_sort} >= ${start_timestamp} and ${date_sort} <= ${end_timestamp})`

                let company_query = $($form_filter_master_item_shop).find('select[name=company]').val().reduce((result, company) => {
                    return result += `mx.supplier_id = ${company} or `
                }, '').replace(/\s+or $/, '')

                if (company_query) {
                    query = query + ` and (${company_query})`
                }

                let brand_query = $($form_filter_master_item_shop).find('select[name=brand]').val().reduce((result, brand) => {
                    return result += `mx.brand = '${brand}' or `
                }, '').replace(/\s+or $/, '')

                if (brand_query) {
                    query = query + ` and (${brand_query})`
                }

                let igroup_query = $($form_filter_master_item_shop).find('select[name=igroup]').val().reduce((result, igroup) => {
                    return result += `igroup_code = '${igroup}' or `
                }, '').replace(/\s+or $/, '')

                if (igroup_query) {
                    query = query + ` and (${igroup_query})`
                }

                const item_code = $($form_filter_master_item_shop).find('#item-code').val()
                const item_name = $($form_filter_master_item_shop).find('#item-name').val()
                const model_no = $($form_filter_master_item_shop).find('#model-no').val()
                const tags = $($form_filter_master_item_shop).find('#tags').val()

                if (item_code) {
                    query += ` and mx.item_code like '%${item_code}%'`
                }
                if (item_name) {
                    query += ` and mx.item_name like '%${item_name}%'`
                }
                if (model_no) {
                    query += ` and mx.model_no like '%${model_no}%'`
                }
                if (tags) {
                    query += ` and mx.tags like '%${tags}%'`
                }

                const cargo_type = $($form_filter_master_item_shop).find('input[name=cargo_type]:checked').val()
                const ship_type = $($form_filter_master_item_shop).find('input[name=ship_type]:checked').val()
                const item_status = $($form_filter_master_item_shop).find('input[name=item_status]:checked').val()
                const expose_type = $($form_filter_master_item_shop).find('input[name=expose_type]:checked').val()
                if (cargo_type) {
                    query += ` and mx.cargo_type = '${cargo_type}'`
                }
                if (ship_type) {
                    query += ` and mx.ship_type = '${ship_type}'`
                }
                if (item_status) {
                    query += ` and mx.status = '${item_status}'`
                }
                if (expose_type) {
                    // query += ` and mx.expose_type = '${expose_type}'`
                    query += ` and mx.expose_type = '${expose_type}'`
                }

                console.log(query)
                //
                $('#modal-multi-popup').trigger('list.filter', [ query ]);
                $('#modal-multi-popup.show').modal('hide');
            }
        }( window.PopupForm1FormFilterMasterItemFngoodsPopfil = window.PopupForm1FormFilterMasterItemFngoodsPopfil || {}, jQuery ));
    </script>
@endpush
@endonce
