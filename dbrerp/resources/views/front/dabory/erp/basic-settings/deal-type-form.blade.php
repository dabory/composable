<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" {{ count($formA['SelectButtonOptions']) <= 3 ? 'hidden' : ''; }}
        class="btn btn-success btn-open-modal"
        data-target=""
        data-clicked=""
        data-variable="">
        <i class="icon-folder-open"></i>
    </button>
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary deal-type-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'deal-type-act',
        ])
    </div>
</div>

<div class="card" id="deal-type-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 275px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DealCategory'] }}</label>
                            <input class="rounded w-100" type="text" id="deal-category-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DealCategory'] }}"
                                {{ $formA['FormVars']['Required']['DealCategory'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SortNo'] }}</label>
                            <input class="rounded w-100" type="text" id="sort-no-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SortNo'] }}"
                                {{ $formA['FormVars']['Required']['SortNo'] }}>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DealCode'] }}</label>
                            <input class="rounded w-100" type="text" id="deal-code-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DealCode'] }}"
                                {{ $formA['FormVars']['Required']['DealCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['DealName'] }}</label>
                            <input class="rounded w-100" type="text" id="deal-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['DealName'] }}"
                                {{ $formA['FormVars']['Required']['DealName'] }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 275px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SalesStatus'] }}</label>
                            <select class="rounded w-100" id="sale-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['SalesStatus'] }}"
                                {{ $formA['FormVars']['Required']['SalesStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['PurchStatus'] }}</label>
                            <select class="rounded w-100" id="purch-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['PurchStatus'] }}"
                                {{ $formA['FormVars']['Required']['PurchStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CollectStatus'] }}</label>
                            <select class="rounded w-100" id="collect-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['CollectStatus'] }}"
                                {{ $formA['FormVars']['Required']['CollectStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['StockStatus'] }}</label>
                            <select class="rounded w-100" id="stock-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['StockStatus'] }}"
                                {{ $formA['FormVars']['Required']['StockStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 275px"><!--260-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['BadStkStatus'] }}</label>
                            <select class="rounded w-100" id="bad-stk-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['BadStkStatus'] }}"
                                {{ $formA['FormVars']['Required']['BadStkStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CostStkStatus'] }}</label>
                            <select class="rounded w-100" id="cost-stk-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['CostStkStatus'] }}"
                                {{ $formA['FormVars']['Required']['CostStkStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CreditStatus'] }}</label>
                            <select class="rounded w-100" id="credit-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['CreditStatus'] }}"
                                {{ $formA['FormVars']['Required']['CreditStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ExDateStatus'] }}</label>
                            <select class="rounded w-100" id="ex-date-status-select"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['ExDateStatus'] }}"
                                {{ $formA['FormVars']['Required']['ExDateStatus'] }}>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="align-items-center {{ $formA['FormVars']['Hidden']['IsGenIo'] == 'hidden' ? 'd-none' : 'd-flex'; }}">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-gen-io-check"> <label class="mb-0" for="is-gen-io-check">{{ $formA['FormVars']['Title']['IsGenIo'] }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('.deal-type-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': BasicSettingsDealTypeForm.btn_act_save(); break;
                    case 'new': Atype.btn_act_new('#deal-type-form #frm'); break;
                    case 'del': BasicSettingsDealTypeForm.btn_act_del(); break;
                }
            });

            Atype.set_parameter_callback(deal_type_parameter);

            activate_button_group()
        });

        (function( BasicSettingsDealTypeForm, $, undefined ) {

            BasicSettingsDealTypeForm.btn_act_save = function () {
                Atype.btn_act_save('#deal-type-form #frm', function () {
                    $('#modal-select-popup').modal('hide');
                });
            }

            BasicSettingsDealTypeForm.btn_act_del = function () {
                Atype.btn_act_del('#deal-type-form #frm', function () {
                    $('#modal-select-popup').modal('hide');
                });
            }

            BasicSettingsDealTypeForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#deal-type-form #frm');
            }

            BasicSettingsDealTypeForm.show_popup_callback = async function (id, c1) {
                await fetch_deal_type(Number(id));
            }
        }( window.BasicSettingsDealTypeForm = window.BasicSettingsDealTypeForm || {}, jQuery ));

        function deal_type_parameter() {
            let id = Number($('#deal-type-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                DealCategory: $('#deal-type-form').find('#deal-category-txt').val(),
                SortNo: Number($('#deal-type-form').find('#sort-no-txt').val()),
                DealCode: $('#deal-type-form').find('#deal-code-txt').val(),
                DealName: $('#deal-type-form').find('#deal-name-txt').val(),
                SalesStatus: Number($('#deal-type-form').find('#sale-status-select').val()),
                PurchStatus: Number($('#deal-type-form').find('#purch-status-select').val()),
                CollectStatus: Number($('#deal-type-form').find('#collect-status-select').val()),
                StockStatus: Number($('#deal-type-form').find('#stock-status-select').val()),
                BadStkStatus: Number($('#deal-type-form').find('#bad-stk-status-select').val()),
                CostStkStatus: Number($('#deal-type-form').find('#cost-stk-status-select').val()),
                CreditStatus: Number($('#deal-type-form').find('#credit-status-select').val()),
                ExDateStatus: Number($('#deal-type-form').find('#ex-date-status-select').val()),
                IsGenIo: Number($('#deal-type-form').find('#is-gen-io-check:checked').val()) ?? 0,
            }
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }

            // console.log(parameter)
            return parameter;
        }

        async function fetch_deal_type(id) {
            let response = await get_api_data(formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })
            set_deal_type_ui(response)
        }

        function set_deal_type_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) return;
            let deal_type = response.data.Page[0];

            $('#deal-type-form').find("#Id").val(deal_type.Id)
            $('#deal-type-form').find('#deal-category-txt').val(deal_type.DealCategory)
            $('#deal-type-form').find('#sort-no-txt').val(deal_type.SortNo)
            $('#deal-type-form').find('#deal-code-txt').val(deal_type.DealCode)
            $('#deal-type-form').find('#deal-name-txt').val(deal_type.DealName)

            $('#deal-type-form').find('#sale-status-select').val(deal_type.SalesStatus)
            $('#deal-type-form').find('#purch-status-select').val(deal_type.PurchStatus)
            $('#deal-type-form').find('#collect-status-select').val(deal_type.CollectStatus)
            $('#deal-type-form').find('#stock-status-select').val(deal_type.StockStatus)
            $('#deal-type-form').find('#bad-stk-status-select').val(deal_type.BadstkStatus)

            $('#deal-type-form').find('#cost-stk-status-select').val(deal_type.CoststkStatus)
            $('#deal-type-form').find('#credit-status-select').val(deal_type.CreditStatus)
            $('#deal-type-form').find('#ex-date-status-select').val(deal_type.ExDateStatus)
            $('#deal-type-form').find('#is-gen-io-check').prop('checked', deal_type.IsGenIo == '1')
        }

        var formA = {!! json_encode($formA) !!};
    </script>
@endpush
@endonce
