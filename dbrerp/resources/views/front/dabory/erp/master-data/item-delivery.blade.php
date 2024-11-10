<div class="tab-pane fade" id="delivery">
    <div class="card-header">
		<div class="stit">
			<h3>배송</h3>
		</div>
        <div class="row">
            <!-- 왼쪽 컬럼 -->
            <div class="col-md-6 col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2 mt_space">
                            <label class="m-0">배송비 구분 (입점사관리반영후 개별 품목별 수정가능)</label>
                            <select class="rounded w-100" id="ship-fee-brand-select">
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">고정 배송비 (배송비 구분 지정시 자동계산)</label>
                            <input type="text" id="turbo-ship-fee-txt" class="rounded w-100" autocomplete="off" maxlength="">
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">반품 배송비 (입점사관리반영후 개별 품목별 수정가능)</label>
                            <input type="text" id="return-fee-txt" class="rounded w-100 decimal" autocomplete="off"
                                   data-point="decimal('sales_prc')">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">교환 배송비 (입점사관리반영후 개별 품목별 수정가능)</label>
                            <input type="text" id="exchange-fee-txt" class="rounded w-100 decimal" autocomplete="off"
                                   data-point="decimal('sales_prc')">
                        </div>
                    </div>
                </div>
            </div>
            <!--//왼쪽 컬럼 끝 -->
            <!-- 오른쪽 컬럼 -->
            <div class="col-md-6 col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">배송방법</label>
                            <div class="d-flex align-items-center justify-content-around">
                                @foreach ($codeTitle['cargo-type']['item'] as $key => $cargo_type)
                                    @if ($cargo_type['Code'] !== '')
                                        <div class="mr-1">
                                            <input type="radio" name="cargo_type" value="{{ $cargo_type['Code'] }}" tabindex="-1" class="text-center" id="cargo-type-{{ $cargo_type['Code'] }}"> <label class="mb-0" for="cargo-type-{{ $cargo_type['Code'] }}">{{ $cargo_type['Title'] }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">주문유형</label>
                            <div class="d-flex align-items-center justify-content-around">
                                @foreach ($codeTitle['ship-type']['item'] as $key => $ship_type)
                                    @if ($ship_type['Code'] !== '')
                                        <div class="mr-1">
                                            <input type="radio" name="ship_type" value="{{ $ship_type['Code'] }}" tabindex="-1" class="text-center" id="ship_-type-{{ $ship_type['Code'] }}"> <label class="mb-0" for="ship_-type-{{ $ship_type['Code'] }}">{{ $ship_type['Title'] }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// 오른쪽 컬럼 끝 -->
        </div>
        <!--// row 끝 -->
    </div>
    <!-- card-header 끝 -->
</div>

@once
@push('js')
    <script>
        $(document).ready(async function() {
            const setup_response = await get_api_data('setup-page', {
                PageVars: {
                    Query: "setup_code = 'ship-fee'",
                    Limit: 9999
                }
            })

            const ship_fee = setup_response.data.Page
            $('#item-form').find('#ship-fee-brand-select').append(window.custom_create_options('BrandCode', 'SetupName', ship_fee))

            $('#item-form').find('#ship-fee-brand-select').on('change', function () {
                switch ($(this).val()) {
                    case 'free':
                        $('#item-form').find('#turbo-ship-fee-txt').val(0)
                        break;
                    case 'fixed':
                        let setup = ship_fee.filter(d => d['BrandCode'] === $(this).val())[0]
                        setup = JSON.parse(setup['SetupJson'])
                        $('#item-form').find('#turbo-ship-fee-txt').val(format_conver_for(setup['FixedChargeAmt'], "decimal('sales_prc')"))
                        break;
                    default:
                        $('#item-form').find('#turbo-ship-fee-txt').val('')
                        break;
                }
            });
        });

        (function( PopupForm1FormAItemDeliveryForm, $, undefined ) {
            PopupForm1FormAItemDeliveryForm.btn_act_new = function () {
                const item_form = $('#item-form')

                $(item_form).find('input:radio[name=cargo_type]:input[value=' + '0' + ']').prop('checked', true)
                $(item_form).find('input:radio[name=ship_type]:input[value=' + 'normal' + ']').prop('checked', true)
            }

            PopupForm1FormAItemDeliveryForm.parameter = function () {
                const item_form = $('#item-form')

                return {
                    ShipFeeBrand: $(item_form).find('#ship-fee-brand-select').val(),
                    TurboShipFee: $(item_form).find('#turbo-ship-fee-txt').val(),
                    ReturnFee: minusComma($(item_form).find('#return-fee-txt').val()) || '0',
                    ExchangeFee: minusComma($(item_form).find('#exchange-fee-txt').val()) || '0',
                    CargoType: $(item_form).find('input:radio[name=cargo_type]:checked').val(),
                    ShipType: $(item_form).find('input:radio[name=ship_type]:checked').val(),
                }
            }

            PopupForm1FormAItemDeliveryForm.set_ui = function (item) {
                console.log(item)
                const item_form = $('#item-form')

                $(item_form).find('#ship-fee-brand-select').val(item.ShipFeeBrand)
                $(item_form).find('#turbo-ship-fee-txt').val(item.TurboShipFee)
                $(item_form).find('#return-fee-txt').val(format_conver_for(item.ReturnFee, "decimal('sales_prc')"))
                $(item_form).find('#exchange-fee-txt').val(format_conver_for(item.ExchangeFee, "decimal('sales_prc')"))
                $(item_form).find('input:radio[name=cargo_type]:input[value=' + item.CargoType + ']').prop('checked', true)
                $(item_form).find('input:radio[name=ship_type]:input[value=' + item.ShipType + ']').prop('checked', true)
            }

        }( window.PopupForm1FormAItemDeliveryForm = window.PopupForm1FormAItemDeliveryForm || {}, jQuery ));
    </script>
@endpush
@endonce
