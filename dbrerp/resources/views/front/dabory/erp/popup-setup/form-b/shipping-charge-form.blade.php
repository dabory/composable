{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div id="popup-setup-form-b-shipping-charge-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary shipping-charge-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formB['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formB['HeadSelectOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formB['HeadSelectOptions'],
                    'eventClassName' => 'shipping-charge-act',
                ])
            @endisset
        </div>
    </div>

    <div class="card" id="shipping-charge-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <div class="row">
                <div class="col-12 col-md-4 card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['ChargeName'] }}</label>
                                <input type="text" id="charge-name-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formB['FormVars']['MaxLength']['ChargeName'] }}"
                                    {{ $formB['FormVars']['Required']['ChargeName'] }}>
                            </div>
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['ChargeDesc'] }}</label>
                                <input type="text" id="charge-desc-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formB['FormVars']['MaxLength']['ChargeDesc'] }}"
                                    {{ $formB['FormVars']['Required']['ChargeDesc'] }}>
                            </div>
                            <div class="form-group d-flex flex-column mb-4">
                                <div class="d-flex">
                                    <label class="m-0 ">{{ $formB['FormVars']['Title']['ShippingMethod'] }}</label>
                                    <div class="ml-1" data-toggle="tooltip" data-html="true" title="{{ $formB['FormVars']['Title']['ShippingMethodCom'] }}">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliCourier'] }} align-items-center mb-2 mr-2">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-courier-check">
                                        <label class="mb-0" for="is-deli-courier-check">
                                            {{ $formB['FormVars']['Title']['IsDeliCourier'] }}
                                        </label>
                                    </div>
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliParcel'] }} align-items-center mb-2 mr-2">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-parcel-check">
                                        <label class="mb-0" for="is-deli-parcel-check">
                                            {{ $formB['FormVars']['Title']['IsDeliParcel'] }}
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliFreight'] }} align-items-center mb-2 mr-1">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-freight-check"
                                        onclick="PopupSetupFormBShippingChargeForm.disabled_txt_toggle(this, '#deli-freight-string-txt')">
                                        <label class="mb-0" for="is-deli-freight-check">
                                            {{ $formB['FormVars']['Title']['IsDeliFreight'] }}
                                        </label>
                                    </div>
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliVisit'] }} align-items-center mb-2 mr-2">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-visit-check"
                                        onclick="PopupSetupFormBShippingChargeForm.click_deli_visit(this)">
                                        <label class="mb-0" for="is-deli-visit-check">
                                            {{ $formB['FormVars']['Title']['IsDeliVisit'] }}
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliQuick'] }} align-items-center mb-2 mr-2">
                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-quick-check">
                                        <label class="mb-0" for="is-deli-quick-check">
                                            {{ $formB['FormVars']['Title']['IsDeliQuick'] }}
                                        </label>
                                    </div>
                                    <div class="{{ $formB['FormVars']['Display']['IsDeliEtc'] }} align-items-center">
                                        <div class="d-flex align-items-center mb-2 mr-1">
                                            <input type="checkbox" value="1" class="text-center mr-1" id="is-deli-etc-check"
                                            onclick="PopupSetupFormBShippingChargeForm.disabled_txt_toggle(this, '#deli-etc-string-txt')">
                                            <label class="mb-0" for="is-deli-etc-check">
                                                {{ $formB['FormVars']['Title']['IsDeliEtc'] }}
                                            </label>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text" class="rounded w-100" id="deli-etc-string-txt" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group {{ $formB['FormVars']['Display']['VatRate'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['VatRate'] }}</label>
                                <select id="vat-rate-select" class="rounded w-100" autocomplete="off">
                                    <option value="10">10%</option>
                                    <option value="0">0%</option>
                                </select>
                            </div>
                            <div class="form-group flex-column mb-2 amt-div qty-div">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['IsRangeRepeat'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="checkbox" class="text-center mr-1" id="is-range-repeat-check"
                                            onclick="PopupSetupFormBShippingChargeForm.use_range_repeat_settings(this)">
                                        <label class="mb-0" for="is-range-repeat-check">
                                            {{ $formB['FormVars']['Title']['UseRangeRepeat'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group flex-column mb-2 amt-div">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['ShippingBased'] }}</label>
                                <div class="ml-1">- {{ $formB['FormVars']['Title']['SalesPrice'] }} -</div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        + (
                                        <input type="checkbox" class="text-center mx-1" id="is-std-option-check">
                                        <label class="mb-0" for="is-std-option-check">
                                            {{ $formB['FormVars']['Title']['IsStdOption'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="checkbox" class="text-center mr-1" id="is-std-addition-check">
                                        <label class="mb-0" for="is-std-addition-check">
                                            {{ $formB['FormVars']['Title']['IsStdAddition'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="checkbox" class="text-center mr-1" id="is-std-text-opt-check">
                                        <label class="mb-0" for="is-std-text-opt-check">
                                            {{ $formB['FormVars']['Title']['IsStdTextOpt'] }} )
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        - (
                                        <input type="checkbox" class="text-center mx-1" id="is-std-discount-check">
                                        <label class="mb-0" for="is-std-discount-check">
                                            {{ $formB['FormVars']['Title']['IsStdDiscount'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="checkbox" class="text-center mr-1" id="is-std-coupon-dc-check">
                                        <label class="mb-0" for="is-std-coupon-dc-check">
                                            {{ $formB['FormVars']['Title']['IsStdCouponDc'] }} )
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group flex-column mb-2 fixed-div">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['SetShippingCost'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="col-6 px-0">{{ $formB['FormVars']['Title']['FixedChargeAmt'] }}</div>
                                    <input type="text" id="fixed-charge-amt-txt" class="rounded col-5" autocomplete="off"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['SetShippingCost'] }}"
                                        {{ $formB['FormVars']['Required']['SetShippingCost'] }}>
                                    <div class="col pl-1 pr-0">원</div>
                                </div>
                            </div>

                            <div class="form-group flex-column mb-2 free-div">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['SetShippingCost'] }}</label>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="text-center mr-1" id="is-all-free-check">
                                    <label class="mb-0" for="is-all-free-check">
                                        {{ $formB['FormVars']['Title']['IsAllFree'] }}
                                    </label>
                                    <div class="ml-1" data-toggle="tooltip" data-html="true" title="{{ $formB['FormVars']['Title']['IsAllFreeCom'] }}">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ $formB['FormVars']['Display']['ChargeMethod'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['ChargeMethod'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <input type="radio" name="charge_method" value="0" class="text-center mr-1" id="charge-method-opt0-radio">
                                        <label class="mb-0" for="charge-method-opt0-radio">
                                            {{ $formB['FormVars']['Title']['ChargeMethodOpt0'] }}
                                        </label>
                                        <div class="ml-1" data-toggle="tooltip" data-html="true" title="{{ $formB['FormVars']['Title']['ChargeMethodOpt1Com'] }}">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="radio" name="charge_method" value="1" class="text-center mr-1" id="charge-method-opt1-radio">
                                        <label class="mb-0" for="charge-method-opt1-radio">
                                            {{ $formB['FormVars']['Title']['ChargeMethodOpt1'] }}
                                        </label>
                                        <div class="ml-1" data-toggle="tooltip" data-html="true" title="{{ $formB['FormVars']['Title']['ChargeMethodOpt2Com'] }}">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <div class="d-flex align-items-center mb-2">--}}
{{--                                        <input type="checkbox" value="1" class="text-center mr-1" id="is-expired-check3" disabled>--}}
{{--                                        <label class="mb-0" for="is-expired-check3">--}}
{{--                                            동일 상품일 경우 1회만 부과--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group {{ $formB['FormVars']['Display']['PayMethod'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['PayMethod'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <input type="radio" name="pay_method" class="text-center mr-1" value="0" id="pay-method-opt0-radio">
                                        <label class="mb-0" for="pay-method-opt0-radio">
                                            {{ $formB['FormVars']['Title']['PayMethodOpt0'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="radio" name="pay_method" class="text-center mr-1" value="1" id="pay-method-opt1-radio">
                                        <label class="mb-0" for="pay-method-opt1-radio">
                                            {{ $formB['FormVars']['Title']['PayMethodOpt1'] }}
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="radio" name="pay_method" class="text-center mr-1" value="2" id="pay-method-opt2-radio">
                                        <label class="mb-0" for="pay-method-opt2-radio">
                                            {{ $formB['FormVars']['Title']['PayMethodOpt2'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $formB['FormVars']['Display']['IsLocationAdd'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['IsLocationAdd'] }}</label>
                                <div class="d-flex align-items-center mb-2 mr-2">
                                    <input type="radio" name="location_add" class="text-center mr-1" value="0" id="is-location-add-opt0-radio">
                                    <label class="mb-0" for="is-location-add-opt0-radio">
                                        {{ $formB['FormVars']['Title']['IsLocationAddOpt0'] }}
                                    </label>
                                </div>
                                <div class="d-flex align-items-center mb-2 mr-1">
                                    <input type="radio" name="location_add" class="text-center mr-1" value="1" id="is-location-add-opt1-radio">
                                    <label class="mb-0" for="is-location-add-opt1-radio">
                                        {{ $formB['FormVars']['Title']['IsLocationAddOpt1'] }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group {{ $formB['FormVars']['Display']['StorageAddr'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['StorageAddr'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <input type="radio" name="storage_addr" class="text-center mr-1" value="0" id="storage-addr-opt0-radio">
                                        <label class="mb-0" for="storage-addr-opt0-radio">
                                            {{ $formB['FormVars']['Title']['StorageAddrOpt0'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="radio" name="storage_addr" class="text-center mr-1" value="1" id="storage-addr-opt1-radio">
                                        <label class="mb-0" for="storage-addr-opt1-radio">
                                            {{ $formB['FormVars']['Title']['StorageAddrOpt1'] }}
                                        </label>
                                    </div>
                                </div>
{{--                                <div style="display: none;" id="storage-addr-div">--}}
{{--                                    <div class="d-flex align-items-center mb-2">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <input class="rounded w-100 radius-r0" type="text" id="storage-addr-zip-code-txt" disabled>--}}
{{--                                            <button type="button" onclick="PopupSetupFormBShippingChargeForm.get_zip_code('#storage-addr-zip-code-txt', '#storage-addr1-txt')" tabindex="-1"--}}
{{--                                                    class="btn-dark rounded border-0 radius-l0 col-4">--}}
{{--                                                <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <input class="rounded w-100 mr-1" type="text" id="storage-addr1-txt">--}}
{{--                                        <input class="rounded w-100" type="text" id="storage-addr2-txt">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <div class="form-group {{ $formB['FormVars']['Display']['ReturnAdd'] }} flex-column mb-2">
                                <label class="m-0 ">{{ $formB['FormVars']['Title']['ReturnAdd'] }}</label>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <input type="radio" name="return_add" class="text-center mr-1" value="0" id="return-add-opt0-radio">
                                        <label class="mb-0" for="return-add-opt0-radio">
                                            {{ $formB['FormVars']['Title']['ReturnAddOpt0'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 mr-1">
                                        <input type="radio" name="return_add" class="text-center mr-1" value="1" id="return-add-opt1-radio">
                                        <label class="mb-0" for="return-add-opt1-radio">
                                            {{ $formB['FormVars']['Title']['ReturnAddOpt1'] }}
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mb-2 mr-2">
                                        <input type="radio" name="return_add" class="text-center mr-1" value="2" id="return-add-opt2-radio">
                                        <label class="mb-0" for="return-add-opt2-radio">
                                            {{ $formB['FormVars']['Title']['ReturnAddOpt2'] }}
                                        </label>
                                    </div>
                                </div>
{{--                                <div style="display: none;" id="return-addr-div">--}}
{{--                                    <div class="d-flex align-items-center mb-2">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <input class="rounded w-100 radius-r0" type="text" id="return-addr-zip-code-txt" disabled>--}}
{{--                                            <button type="button" onclick="PopupSetupFormBShippingChargeForm.get_zip_code('#return-addr-zip-code-txt', '#return-addr1-txt')" tabindex="-1"--}}
{{--                                                    class="btn-dark rounded border-0 radius-l0 col-4">--}}
{{--                                                <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <input class="rounded w-100 mr-1" type="text" id="return-addr1-txt">--}}
{{--                                        <input class="rounded w-100" type="text" id="return-addr2-txt">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                                <div class="form-group flex-column mb-2" style="display: none;" id="visit-reciept-div">
                                    <label class="m-0 ">{{ $formB['FormVars']['Title']['VisitReciept'] }}</label>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mb-2 mr-2">
                                            <input type="radio" name="visit_reciept" class="text-center mr-1" value="0" id="visit-reciept-opt0-radio">
                                            <label class="mb-0" for="visit-reciept-opt0-radio">
                                                {{ $formB['FormVars']['Title']['VisitRecieptOpt0'] }}
                                            </label>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 mr-1">
                                            <input type="radio" name="visit_reciept" class="text-center mr-1" value="1" id="visit-reciept-opt1-radio">
                                            <label class="mb-0" for="visit-reciept-opt1-radio">
                                                {{ $formB['FormVars']['Title']['VisitRecieptOpt1'] }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mb-2 mr-2">
                                            <input type="radio" name="visit_reciept" class="text-center mr-1" value="2" id="visit-reciept-opt2-radio">
                                            <label class="mb-0" for="visit-reciept-opt2-radio">
                                                {{ $formB['FormVars']['Title']['VisitRecieptOpt2'] }}
                                            </label>
                                        </div>
                                    </div>

                        </div>
                    </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-body p-0 mt-2 mx-2 amt-div qty-div">
            <div id="">
                <div class="d-flex justify-content-end">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary shipping-charge-bd-act" data-value="add">
                            {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                        </button>
                        @isset($formB['BodySelectOptions'])
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['BodySelectOptions'],
                            'eventClassName' => 'shipping-charge-bd-act'
                        ])
                        @endisset
                    </div>
                </div>

                <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                    <table class="table-row shipping-charge-table">
                        <thead id="shipping-charge-table-head">
                        @include('front.dabory.erp.partial.make-thead', [
                            'listVars' => $formB['ListVars'],
                            'checkboxName' => 'bd-cud-check'
                        ])
                        </thead>
                        <tbody id="shipping-charge-table-body">
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
{{--<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>--}}
{{--<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>--}}
<script>
    $(document).ready(async function() {
        make_dynamic_table_css('.shipping-charge-table', make_dynamic_table_px(PopupSetupFormBShippingChargeForm.formB['ListVars']['Size']))

        $('#shipping-charge-form').find('[data-toggle="tooltip"]').tooltip()

        $('.shipping-charge-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': PopupSetupFormBShippingChargeForm.btn_act_save(); break;
            }
        });

        $('.shipping-charge-bd-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'add': PopupSetupFormBShippingChargeForm.btn_bd_act_add(); break;
                case 'multi-delete': PopupSetupFormBShippingChargeForm.btn_bd_act_multi_delete('.shipping-charge-table'); break;
            }
        });

        // PopupSetupFormBShippingChargeForm.basic_init()

    });

    (function( PopupSetupFormBShippingChargeForm, $, undefined ) {
        PopupSetupFormBShippingChargeForm.formB = {!! json_encode($formB) !!}
            PopupSetupFormBShippingChargeForm.unit = ''

        PopupSetupFormBShippingChargeForm.address_registration = function (addr_div, hidden) {
            if (hidden) {
                $(addr_div).hide()
            } else {
                $(addr_div).show()
            }
        }

        PopupSetupFormBShippingChargeForm.get_zip_code = function(zip_code, addr1) {
            new daum.Postcode({
                oncomplete: function(data) {
                    $(zip_code).val(data.zonecode)
                    $(addr1).val(data.roadAddress)
                }
            }).open();
        }

        PopupSetupFormBShippingChargeForm.use_range_repeat_settings = async function ($this) {
            if ($($this).prop('checked')) {
                PopupSetupFormBShippingChargeForm.range_repeat_init()
            } else {
                PopupSetupFormBShippingChargeForm.basic_init()
            }

            $('#shipping-charge-form').find('.shipping-charge-bd-act').attr('disabled', $($this).prop('checked'))
        }

        PopupSetupFormBShippingChargeForm.change_shipping_charge_base_to = function ($this) {
            const value = $($this).val()
            $($this).closest('tr').next().find('.charge-from-txt').val(value)
        }

        PopupSetupFormBShippingChargeForm.range_repeat_init = function () {
            const html = `
                <tr>
                    <td class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check} px-import-0">
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" value="0" class="mr-1 charge-from-txt" disabled>${PopupSetupFormBShippingChargeForm.unit} 이상 ~
                            <input type="text" class="mx-1 charge-to-txt"
                                onchange="PopupSetupFormBShippingChargeForm.change_shipping_charge_base_to(this)">
                                ${PopupSetupFormBShippingChargeForm.unit} 미만일 때
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-amt-txt">원
                        </div>
                    </td>
                </tr>
                <tr id="last-tr">
                    <td class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check} px-import-0">
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" value="0" class="mr-1 charge-from-txt" disabled>${PopupSetupFormBShippingChargeForm.unit} 부터 ~
                            <input type="text" class="mx-1 charge-to-txt">${PopupSetupFormBShippingChargeForm.unit} 마다 반복 부과
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-amt-txt">원
                        </div>
                    </td>
                </tr>
            `
            $('#shipping-charge-form').find('#shipping-charge-table-body').html(html)
        }

        PopupSetupFormBShippingChargeForm.basic_create_bd_page = function (shipping_charge_base) {
            for (let i = 0; i < shipping_charge_base.length - 2; i++) {
                PopupSetupFormBShippingChargeForm.add_tr()
            }
        }

        PopupSetupFormBShippingChargeForm.basic_init = function () {
            const html = `
                <tr>
                    <td class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check} px-import-0">
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" value="0" class="mr-1 charge-from-txt" disabled>${PopupSetupFormBShippingChargeForm.unit} 이상 ~
                            <input type="text" class="mx-1 charge-to-txt"
                                onchange="PopupSetupFormBShippingChargeForm.change_shipping_charge_base_to(this)">
                                ${PopupSetupFormBShippingChargeForm.unit} 미만일 때
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-amt-txt">원
                        </div>
                    </td>
                </tr>
                <tr id="last-tr">
                    <td class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check} px-import-0">
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-from-txt" disabled>${PopupSetupFormBShippingChargeForm.unit} 이상
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-amt-txt">원
                        </div>
                    </td>
                </tr>
            `

            $('#shipping-charge-form').find('#shipping-charge-table-body').html(html)
        }

        PopupSetupFormBShippingChargeForm.add_tr = async function () {
            const last_from_value = $('#last-tr').find('.charge-from-txt').val()
            const html =
                `<tr>
                    <td class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${PopupSetupFormBShippingChargeForm.formB.ListVars['Align'].$Check}">
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" value="${last_from_value}" class="mr-1 charge-from-txt" disabled>${PopupSetupFormBShippingChargeForm.unit} 이상 ~
                            <input type="text" class="mx-1 charge-to-txt"
                                onchange="PopupSetupFormBShippingChargeForm.change_shipping_charge_base_to(this)">
                                ${PopupSetupFormBShippingChargeForm.unit} 미만일 때
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex align-items-center">
                            <input type="text" class="mr-1 charge-amt-txt">원
                        </div>
                    </td>
                </tr>`

            $('#shipping-charge-form').find('#last-tr').before(html)

        }

        PopupSetupFormBShippingChargeForm.click_deli_visit = function ($this) {
            if ($($this).prop('checked')) {
                $('#shipping-charge-form').find('#visit-reciept-div').show()
            } else {
                $('#shipping-charge-form').find('#visit-reciept-div').hide()
            }
        }

        PopupSetupFormBShippingChargeForm.disabled_txt_toggle = function ($this, txt_id) {
            if ($($this).prop('checked')) {
                $('#shipping-charge-form').find(txt_id).attr('disabled', false)
            } else {
                $('#shipping-charge-form').find(txt_id).val('')
                $('#shipping-charge-form').find(txt_id).attr('disabled', true)
            }
        }

        PopupSetupFormBShippingChargeForm.btn_act_save = function () {
            Btype.btn_act_save('#shipping-charge-form #frm', function () {
                $('#modal-select-popup.show').trigger('list.requery')
                // $('#modal-select-popup.show').modal('hide');
            }, 'PopupSetupFormBShippingChargeForm');
        }

        PopupSetupFormBShippingChargeForm.btn_bd_act_multi_delete = function (table_id) {
            $(table_id).find(`input[name='bd-cud-check']`).each(function () {
                if ($(this).is(':checked')) {
                    $(this).closest('tr').remove()
                }
            })

            $('#last-tr').find('.charge-from-txt').val($('#last-tr').prev().find('.charge-to-txt').val())
        }

        PopupSetupFormBShippingChargeForm.base_struct = function (from = '', to = '', charge_amt = '') {
            return {
                From: from ?? '',
                To: to ?? '',
                ChargeAmt: charge_amt ?? '',
            }
        }

        PopupSetupFormBShippingChargeForm.btn_bd_act_add = function () {
            PopupSetupFormBShippingChargeForm.add_tr()
        }

        PopupSetupFormBShippingChargeForm.get_parameter = function () {
            let shipping_charge_base = []
            $('.shipping-charge-table #shipping-charge-table-body').find('tr').each(function () {
                shipping_charge_base.push(PopupSetupFormBShippingChargeForm.base_struct(
                    $(this).find('.charge-from-txt').val(),
                    $(this).find('.charge-to-txt').val(),
                    $(this).find('.charge-amt-txt').val()
                ))
            })

            const shipping_charge_form = $('#shipping-charge-form')
            const setup = {
                ChargeName: $(shipping_charge_form).find('#charge-name-txt').val(),
                ChargeDesc: $(shipping_charge_form).find('#charge-desc-txt').val(),
                IsDeliCourier: $(shipping_charge_form).find('#is-deli-courier-check').is(':checked'),
                IsDeliParcel: $(shipping_charge_form).find('#is-deli-parcel-check').is(':checked'),
                IsDeliFreight: $(shipping_charge_form).find('#is-deli-freight-check').is(':checked'),
                IsDeliVisit: $(shipping_charge_form).find('#is-deli-visit-check').is(':checked'),
                IsDeliQuick: $(shipping_charge_form).find('#is-deli-quick-check').is(':checked'),
                IsDeliEtc: $(shipping_charge_form).find('#is-deli-etc-check').is(':checked'),
                DeliEtcString: $(shipping_charge_form).find('#deli-etc-string-txt').val(),

                VatRate: $(shipping_charge_form).find('#vat-rate-select').val(),
                FixedChargeAmt: $(shipping_charge_form).find('#fixed-charge-amt-txt').val(),
                IsRangeRepeat: $(shipping_charge_form).find('#is-range-repeat-check').is(':checked'),

                IsStdOption: $(shipping_charge_form).find('#is-std-option-check').is(':checked'),
                IsStdAddition: $(shipping_charge_form).find('#is-std-addition-check').is(':checked'),
                IsStdTextOpt: $(shipping_charge_form).find('#is-std-text-opt-check').is(':checked'),
                IsStdDiscount: $(shipping_charge_form).find('#is-std-discount-check').is(':checked'),
                IsStdCouponDc: $(shipping_charge_form).find('#is-std-coupon-dc-check').is(':checked'),
                IsAllFree: $(shipping_charge_form).find('#is-all-free-check').is(':checked'),

                ChargeMethod: $(shipping_charge_form).find('input[name=charge_method]:checked').val(),
                PayMethod: $(shipping_charge_form).find('input[name=pay_method]:checked').val(),
                IsLocationAdd: $(shipping_charge_form).find('input[name=location_add]:checked').val(),

                StorageAddr: $(shipping_charge_form).find('input[name=storage_addr]:checked').val(),
                ReturnAdd: $(shipping_charge_form).find('input[name=return_add]:checked').val(),
                VisitReciept: $(shipping_charge_form).find('input[name=visit_reciept]:checked').val(),

                ShippingChargeBase: shipping_charge_base
            }
            const id = Number($(shipping_charge_form).find('#Id').val());
            let parameter = {
                Id: id,
                SetupJson: JSON.stringify(setup),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(setup)
            return parameter;
        }

        PopupSetupFormBShippingChargeForm.btn_act_new = function () {
            const shipping_charge_form = $('#shipping-charge-form')

            window.input_box_reset_for('#shipping-charge-form #frm')

            $(shipping_charge_form).find('#is-deli-courier-check').prop('checked', true)
            $(shipping_charge_form).find('#charge-method-opt0-radio').prop('checked', true)
            $(shipping_charge_form).find('#is-std-option-check').prop('checked', true)
            $(shipping_charge_form).find('#is-std-addition-check').prop('checked', true)
            $(shipping_charge_form).find('#is-std-text-opt-check').prop('checked', true)
            $(shipping_charge_form).find('#pay-method-opt0-radio').prop('checked', true)
            $(shipping_charge_form).find('#is-location-add-opt1-radio').prop('checked', true)
            $(shipping_charge_form).find('#storage-addr-opt0-radio').prop('checked', true)
            $(shipping_charge_form).find('#return-add-opt0-radio').prop('checked', true)
            $(shipping_charge_form).find('#visit-reciept-opt0-radio').prop('checked', true)

            $(shipping_charge_form).find('#deli-etc-string-txt').attr('disabled', true)

            $(shipping_charge_form).find('#visit-reciept-div').hide()
            $(shipping_charge_form).find('.amt-div').hide()
            $(shipping_charge_form).find('.free-div').hide()
            $(shipping_charge_form).find('.qty-div').hide()
            $(shipping_charge_form).find('.fixed-div').hide()

            // table body 초기화
            $('#modal-select-popup.popup-setup-form-b-shipping-charge-form .modal-dialog').css('maxWidth', '1200px');

            $(shipping_charge_form).find('#shipping-charge-table-head .all-check').prop('checked', false)
            table_head_check_box_reset('#shipping-charge-form #shipping-charge-table-head')
            $(shipping_charge_form).find('#shipping-charge-table-body').html('');
        }

        PopupSetupFormBShippingChargeForm.show_popup_callback = async function (id, setup, brand_code) {
            const shipping_charge_form = $('#shipping-charge-form')

            PopupSetupFormBShippingChargeForm.btn_act_new()

            if (brand_code === 'amt') {
                PopupSetupFormBShippingChargeForm.unit = '원'
                $(shipping_charge_form).find('.amt-div').show()
            } else if (brand_code === 'free') {
                $(shipping_charge_form).find('.free-div').show()
            } else if (brand_code === 'qty') {
                PopupSetupFormBShippingChargeForm.unit = '개'
                $(shipping_charge_form).find('.qty-div').show()
            } else if (brand_code === 'fixed') {
                $(shipping_charge_form).find('.fixed-div').show()
            }

            $('#shipping-charge-form').find('#Id').val(id)
            PopupSetupFormBShippingChargeForm.set_item_input_shortcut_ui(setup)
        }

        PopupSetupFormBShippingChargeForm.create_bd_page = async function (shipping_charge_base, range_repeat) {
            await PopupSetupFormBShippingChargeForm.use_range_repeat_settings('#is-range-repeat-check')
            PopupSetupFormBShippingChargeForm.basic_create_bd_page(shipping_charge_base)

            $('.shipping-charge-table #shipping-charge-table-body').find('tr').each(function (index) {
                $(this).find('.charge-from-txt').val(shipping_charge_base[index]['From'])
                $(this).find('.charge-to-txt').val(shipping_charge_base[index]['To'])
                $(this).find('.charge-amt-txt').val(shipping_charge_base[index]['ChargeAmt'])
            })
        }

        PopupSetupFormBShippingChargeForm.set_item_input_shortcut_ui = function (setup) {
            if (_.isEmpty(setup)) {
                PopupSetupFormBShippingChargeForm.use_range_repeat_settings('#is-range-repeat-check')
                return
            }
            const shipping_charge_form = $('#shipping-charge-form')

            // console.log(setup)

            $(shipping_charge_form).find('#charge-name-txt').val(setup['ChargeName'])
            $(shipping_charge_form).find('#charge-desc-txt').val(setup['ChargeDesc'])
            $(shipping_charge_form).find('#is-deli-courier-check').prop('checked', setup['IsDeliCourier'])
            $(shipping_charge_form).find('#is-deli-parcel-check').prop('checked', setup['IsDeliParcel'])
            $(shipping_charge_form).find('#is-deli-freight-check').prop('checked', setup['IsDeliFreight'])
            $(shipping_charge_form).find('#is-deli-visit-check').prop('checked', setup['IsDeliVisit'])
            $(shipping_charge_form).find('#is-deli-quick-check').prop('checked', setup['IsDeliQuick'])
            $(shipping_charge_form).find('#is-deli-etc-check').prop('checked', setup['IsDeliEtc'])
            $(shipping_charge_form).find('#deli-etc-string-txt').val(setup['DeliEtcString'])

            PopupSetupFormBShippingChargeForm.click_deli_visit('#is-deli-visit-check')
            PopupSetupFormBShippingChargeForm.disabled_txt_toggle($('#is-deli-etc-check'), '#deli-etc-string-txt')

            $(shipping_charge_form).find('#vat-rate-select').val(setup['VatRate'])
            $(shipping_charge_form).find('#fixed-charge-amt-txt').val(setup['FixedChargeAmt'])
            $(shipping_charge_form).find('#is-range-repeat-check').prop('checked', setup['IsRangeRepeat'])

            $(shipping_charge_form).find('#is-std-option-check').prop('checked', setup['IsStdOption'])
            $(shipping_charge_form).find('#is-std-addition-check').prop('checked', setup['IsStdAddition'])
            $(shipping_charge_form).find('#is-std-text-opt-check').prop('checked', setup['IsStdTextOpt'])
            $(shipping_charge_form).find('#is-std-discount-check').prop('checked', setup['IsStdDiscount'])
            $(shipping_charge_form).find('#is-std-coupon-dc-check').prop('checked', setup['IsStdCouponDc'])
            $(shipping_charge_form).find('#is-all-free-check').prop('checked', setup['IsAllFree'])

            $(shipping_charge_form).find(`input:radio[name="charge_method"]:radio[value='${setup['ChargeMethod']}']`).prop('checked', true)
            $(shipping_charge_form).find(`input:radio[name="pay_method"]:radio[value='${setup['PayMethod']}']`).prop('checked', true)
            $(shipping_charge_form).find(`input:radio[name="location_add"]:radio[value='${setup['IsLocationAdd']}']`).prop('checked', true)

            $(shipping_charge_form).find(`input:radio[name="storage_addr"]:radio[value='${setup['StorageAddr']}']`).prop('checked', true)
            $(shipping_charge_form).find(`input:radio[name="return_add"]:radio[value='${setup['ReturnAdd']}']`).prop('checked', true)
            $(shipping_charge_form).find(`input:radio[name="visit_reciept"]:radio[value='${setup['VisitReciept']}']`).prop('checked', true)


            // console.log(setup['ShippingChargeBase'])
            PopupSetupFormBShippingChargeForm.create_bd_page(setup['ShippingChargeBase'], setup['IsRangeRepeat'])
            // console.log(PopupSetupFormBShippingChargeForm.ShippingChargeBase)
        }
    }( window.PopupSetupFormBShippingChargeForm = window.PopupSetupFormBShippingChargeForm || {}, jQuery ));
</script>
{{--@endpush--}}
@endonce
