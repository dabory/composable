{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary company-tier-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'company-tier-act',
        ])
    </div>
</div>

<div class="card mb-2" id="company-tier-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group {{ $formA['FormVars']['Display']['TierName'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TierName'] }}</label>
                            <input type="text" id="tier-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TierName'] }}"
                                {{ $formA['FormVars']['Required']['TierName'] }}>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['SeqNo'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['SeqNo'] }}</label>
                            <select type="text" id="seq-no-txt" class="rounded w-100">
                                @foreach(range(1, 20) as $number)
                                    <option value="{{ $number }}">{{ $number }}위</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['TotpayAmt'] }} flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TotpayAmt'] }}</label>
                                <div class="ml-1" data-toggle="tooltip" data-html="true" title="- 총주문금액 : 총 상품구매금액에 총 배송비를 더한 값을 의미합니다.<br>
                                    - 총실결제금액 : 총주문금액에서 각종 할인/쿠폰/적립금/마일리지/예치금 등이 제외된 실결제금액을 의미합니다.">
                                    <i class="fas fa-exclamation-circle"></i>
                            </div>
                            </div>
                            <div>
                                <span class="gWidth" style="display:none">총 주문금액 기준</span>
                                <span class="gWidth" style="">총 실결제금액 기준</span>
                                <span class="gWidth" style="display:none">총 실결제금액 + 예치금 기준</span>
                                <input type="text" class="fText right" style="width:80px;" id="totpay-amt-start-txt" maxlength="9" required> 원 이상 ~
                                <input type="text" class="fText right" style="width:80px;" id="totpay-amt-end-txt" maxlength="9"> 원 미만인 경우 등급 적용
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" class="text-center mr-1" id="is-free-delivery-check"> <label class="mb-0" for="is-free-delivery-check">{{ $formA['FormVars']['Title']['IsFreeDelivery'] }}</label>
                        </div>
                        <div class="form-group {{ $formA['FormVars']['Display']['BenefitType'] }} flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['BenefitType'] }}</label>
                            <div>
                                <label class="gLabel text-center mr-1 eSelected">
                                    <input type="radio" class="fChk" name="use_dc" id="use_dc_F" value="F" onclick="PopupForm1FormAProCompanyTierForm.set_use_dc();" checked="checked"> 혜택없음</label>
                                <label class="gLabel text-center mr-1">
                                    <input type="radio" class="fChk" name="use_dc" id="use_dc_D" value="D" onclick="PopupForm1FormAProCompanyTierForm.set_use_dc();"> 구매금액 할인</label>
                                <label class="gLabel text-center mr-1">
                                    <input type="radio" class="fChk" name="use_dc" id="use_dc_M" value="M" onclick="PopupForm1FormAProCompanyTierForm.set_use_dc();"> 적립금 지급</label>
                                <label class="gLabel text-center mr-1">
                                    <input type="radio" class="fChk" name="use_dc" id="use_dc_P" value="P" onclick="PopupForm1FormAProCompanyTierForm.set_use_dc();"> 할인/적립 동시 적용</label>
                            </div>
                        </div>
                        <div class="form-group flex-column mb-2" id="order-dc-type-div" style="display: none;">
                            <div class="d-flex align-items-center">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OrderDcType'] }}</label>
                                <div class="ml-1" data-toggle="tooltip" data-html="true" title="- [상품별 할인] 적용된 상품을 구매할 때 [회원등급별 할인]이 중복되는 경우의 설정입니다.<br>
                                - '상품별+회원등급별 가격할인 적용' 선택하면, [상품별 할인]과 [회원등급별 할인]이 모두 적용됩니다.<br>
                                - '회원등급별 가격할인만 적용' 선택하면, [상품별 할인]은 적용되지 않고 [회원등급별 할인]만 적용됩니다.<br>
                                - '상품별 가격할인만 적용' 선택하면, [상품별 할인]만 적용되고 [회원등급별 할인]은 적용되지 않습니다.<br>
                                - 단, [상품별 할인] 적용되지 않은 상품을 같이 구매할 경우 해당 상품의 [회원등급별 할인]은 적용됩니다.">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                            </div>
                            <select id="order-dc-type-select" class="rounded w-100">
                                <option value="P">상품별 가격할인만 적용</option>
                                <option value="M">회원등급별 가격할인만 적용</option>
                                <option value="A" selected="selected">상품별+회원등급별 가격할인 적용</option>
                            </select>
                        </div>
                        <div class="form-group flex-column mb-2" style="display: none;" id="dc-setup-div">
                            <div class="d-flex align-items-center">
                                <label class="m-0">{{ $formA['FormVars']['Title']['DcSetup'] }}</label>
                                <div class="ml-1" data-toggle="tooltip" data-html="true" title="" id="dc-setup-tooltip">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div id="tooltip-content" style="display:none;">
                                    <div class="content">
                                        <strong class="title text-danger">절사방법</strong>
                                        <ul class="mList">
                                            <li>절사안함 : 1,234 → 1,234</li>
                                        </ul>
                                        <ul class="mList">
                                            <li>일단위절사 : 1,234 → 1,230</li>
                                        </ul>
                                        <ul class="mList">
                                            <li>십단위절사 : 1,234 → 1,200</li>
                                        </ul>
                                        <ul class="mList mb-2">
                                            <li>백단위절사 : 1,234 → 1,000</li>
                                        </ul>
                                        <strong class="title text-danger">회원등급 구매 할인을 "정율"로 사용할 경우</strong>
                                        <ul class="mList">
                                            <li>"상품별+회원등급별 가격할인 적용" 선택 시 [회원등급별 할인] 적용 기준 금액은 총 상품구매금액에서 [상품별 할인]을 제외한 금액 이상 구매할 경우입니다.</li>
                                        </ul>
                                        <ul class="mList">
                                            <li>"회원등급별 가격할인만 적용" 선택 시 [회원등급별 할인] 적용 기준 금액은 총 상품구매금액 이상 구매할 경우입니다.</li>
                                        </ul>
                                        <ul class="mList">
                                            <li>"상품별 가격할인만 적용" 선택 시 [회원등급별 할인] 적용 기준 금액은 [상품별 할인]없는 상품의 총 상품구매금액 이상 구매할 경우입니다.</li>
                                        </ul>
                                        <ul class="mList mb-2">
                                            <li>"최대할인 금액을 0원 또는 미입력 후 저장 시", 최대할인금액 제한이 없으며 설정한 %만큼 금액할인이 적용됩니다.</li>
                                        </ul>
                                        <strong class="title text-danger">회원등급 구매 할인을 "정액"으로 사용할 경우</strong>
                                        <ul class="mList">
                                            <li>"상품별 가격할인만 적용" 선택하면, [상품별 할인]만 적용되고 [회원등급별 할인]은 적용되지 않습니다.</li>
                                        </ul>
                                        <ul class="mList">
                                            <li>[상품별 할인] 적용되지 않은 상품만 구매할 경우에는 [회원등급별 할인]이 적용됩니다.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="text" class="fText right" style="width:80px;" id="dc-from-ordamt-txt" maxlength="9">
                                원 이상 구매시
                                <span id="use_dc_frm_D_2" style="display:none">
                                <select class="fSelect" name="D_dc_target_type">
                                    <option value="A">총 상품구매금액</option>
                                    <option value="B">총 상품구매금액(적립금 사용금액 제외)</option>
                                </select> 에서
                                </span>
                                        <input type="text" class="fText right" style="width:80px;" id="dc-amt-txt" maxlength="9">
                                        <select class="fSelect" id="dc-rate-type-select" onchange="PopupForm1FormAProCompanyTierForm.set_dc_type(this, 'D');">
                                            <option value="W" selected="selected">원</option>
                                            <option value="P">%</option>
                                        </select>
                                        <select class="fSelect" name="D_dc_type_unit" disabled="">
                                            <option value="0.1">절사안함</option><option value="1">일 단위절사</option><option value="10">십 단위절사</option><option value="100">백 단위절사</option>
                                        </select>
                                        을 할인<span id="use_dc_frm_D_1" style="display: none;">(최대&nbsp;&nbsp;<input type="text" class="fText right" style="width:80px;" id="max-dc-amt-txt" maxlength="9">원)
                                </span>
                            </div>
                        </div>
                        <div class="form-group flex-column mb-2" style="display: none;" id="reward-setup-div">
                            <div class="d-flex align-items-center">
                                <label class="m-0">{{ $formA['FormVars']['Title']['RewardSetup'] }}</label>
                                <div class="ml-1" data-toggle="tooltip" data-html="true" title="- 절사안함 : 1,234 → 1,234<br>
                                    - 일단위절사 : 1,234 → 1,230<br>
                                    - 십단위절사 : 1,234 → 1,200<br>
                                    - 백단위절사 : 1,234 → 1,000<br>">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                            </div>
                            <div>
                                <input type="text" class="fText right" style="width:80px;" id="reward-from-ordamt-txt" name="P_dc_mi_min_price" maxlength="9">  원 이상 구매시
                                <input type="text" class="fText right" style="width:80px;" id="reward-amt-txt" name="P_dc_mi_price" maxlength="9">
                                <select class="fSelect" id="reward-type-rate-select" onchange="PopupForm1FormAProCompanyTierForm.set_dc_type(this, 'P2');">
                                    <option value="W" selected="selected">원</option>
                                    <option value="P">%</option>
                                </select>
                                <select class="fSelect" name="P_dc_mi_type_unit" disabled="">
                                    <option value="0.1">절사안함</option><option value="1">일 단위절사</option><option value="10">십 단위절사</option><option value="100">백 단위절사</option>
                                </select>
                                    을 적립<span id="use_dc_mi_frm_P_1" style="display: none;">(최대&nbsp;&nbsp; <input type="text" class="fText right" style="width:80px;" id="max-reward-amt-txt" maxlength="9">원)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endsection--}}

 <style>
     .mList { list-style-type: none; text-align: center; padding: 0 !important; margin: 0 !important; }
 </style>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#dc-setup-tooltip').on('mouseenter', function () {
                $(this).tooltip({
                    html: true,
                    title: function () {
                        return $('#tooltip-content').html();
                    }
                });
                $(this).tooltip('show');
            }).on('mouseleave', '.tooltip-show-img', function() {
                $('.tooltip').hide();
                $('.tooltip').tooltip('dispose');
            });

            $('.company-tier-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAProCompanyTierForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAProCompanyTierForm.btn_act_del(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupForm1FormAProCompanyTierForm, $, undefined ) {
            PopupForm1FormAProCompanyTierForm.formA = {!! json_encode($formA) !!};

            PopupForm1FormAProCompanyTierForm.set_dc_type = function ($this, type) {
                const company_tier_form = $('#company-tier-form')
                switch (type) {
                    case 'D':
                        if ($($this).val() === 'P') {
                            $(company_tier_form).find('#use_dc_frm_D_1').show()
                        } else {
                            $(company_tier_form).find('#use_dc_frm_D_1').hide()
                        }
                        break;
                    case 'P2':
                        if ($($this).val() === 'P') {
                            $(company_tier_form).find('#use_dc_mi_frm_P_1').show()
                        } else {
                            $(company_tier_form).find('#use_dc_mi_frm_P_1').hide()
                        }
                        break;
                }
            }

            PopupForm1FormAProCompanyTierForm.set_use_dc = function () {
                const company_tier_form = $('#company-tier-form')
                const val = $(company_tier_form).find('input[name="use_dc"]:checked').val()
                if (val === 'D') {
                    $(company_tier_form).find('#dc-setup-div').show()
                    $(company_tier_form).find('#order-dc-type-div').show()
                } else {
                    $(company_tier_form).find('#dc-setup-div').hide()
                    $(company_tier_form).find('#order-dc-type-div').hide()
                }

                if (val === 'M') {
                    $(company_tier_form).find('#reward-setup-div').show()
                } else {
                    $(company_tier_form).find('#reward-setup-div').hide()
                }

                if (val === 'P') {
                    $(company_tier_form).find('#order-dc-type-div').show()
                    $(company_tier_form).find('#dc-setup-div').show()
                    $(company_tier_form).find('#reward-setup-div').show()
                }
            }


            PopupForm1FormAProCompanyTierForm.btn_act_new = function () {
                Atype.set_parameter_callback(PopupForm1FormAProCompanyTierForm.parameter);
                Atype.btn_act_new('#company-tier-form #frm');
                $('#company-tier-form').find('input[name="use_dc"][value="F"]').prop('checked', true)
                $('#company-tier-form').find('#order-dc-type-select').val('A')
                $('#company-tier-form').find('#order-dc-type-div').hide()
                $('#company-tier-form').find('#dc-setup-div').hide()
                $('#company-tier-form').find('#reward-setup-div').hide()
            }

            PopupForm1FormAProCompanyTierForm.btn_act_new_callback = function () {
                PopupForm1FormAProCompanyTierForm.btn_act_new()
            }

            PopupForm1FormAProCompanyTierForm.parameter = function () {
                const company_tier_form = $('#company-tier-form')

                let id = Number($(company_tier_form).find('#Id').val());
                let parameter = {
                    Id: id,
                    TierName: $(company_tier_form).find('#tier-name-txt').val(),
                    SeqNo: Number($(company_tier_form).find('#seq-no-txt').val()),
                    TotpayAmtStart: $(company_tier_form).find('#totpay-amt-start-txt').val(),
                    TotpayAmtEnd: $(company_tier_form).find('#totpay-amt-end-txt').val(),
                    BenefitType: $(company_tier_form).find('input[name="use_dc"]:checked').val(),
                    OrderDcType: $(company_tier_form).find('#order-dc-type-select').val(),
                    DcFromOrdamt: $(company_tier_form).find('#dc-from-ordamt-txt').val(),
                    DcAmt: $(company_tier_form).find('#dc-rate-type-select').val() === 'W' ? $(company_tier_form).find('#dc-amt-txt').val() : '0',
                    DcRate: $(company_tier_form).find('#dc-rate-type-select').val() === 'P' ? $(company_tier_form).find('#dc-amt-txt').val() : '0',
                    MaxDcAmt: $(company_tier_form).find('#max-dc-amt-txt').val(),
                    RewardFromOrdamt: $(company_tier_form).find('#reward-from-ordamt-txt').val(),
                    RewardAmt: $(company_tier_form).find('#reward-type-rate-select').val() === 'W' ? $(company_tier_form).find('#reward-amt-txt').val() : '0',
                    RewardRate: $(company_tier_form).find('#reward-type-rate-select').val() === 'P' ? $(company_tier_form).find('#reward-amt-txt').val() : '0',
                    MaxRewardAmt: $(company_tier_form).find('#max-reward-amt-txt').val(),

                    IsFreeDelivery: $(company_tier_form).find('#is-free-delivery-check:checked').val() ?? '0',
                }
                if (id < 0) {
                    parameter = { Id: id }
                }

                console.log(parameter)
                return parameter;
            }

            PopupForm1FormAProCompanyTierForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAProCompanyTierForm.parameter);
                Atype.btn_act_save('#company-tier-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAProCompanyTierForm');
            }

            PopupForm1FormAProCompanyTierForm.btn_act_del = function () {
                Atype.set_parameter_callback(PopupForm1FormAProCompanyTierForm.parameter);
                Atype.btn_act_del('#company-tier-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAProCompanyTierForm');
            }

            PopupForm1FormAProCompanyTierForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAProCompanyTierForm.btn_act_new()
                await PopupForm1FormAProCompanyTierForm.fetch_company_tier(Number(id));
            }

            PopupForm1FormAProCompanyTierForm.fetch_company_tier = async function (id) {
                const response = await get_api_data(PopupForm1FormAProCompanyTierForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                console.log(response)
                PopupForm1FormAProCompanyTierForm.set_company_tier_ui(response)
            }

            PopupForm1FormAProCompanyTierForm.set_company_tier_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const company_tier = response.data.Page[0];
                console.log(company_tier)
                const company_tier_form = $('#company-tier-form')

                $(company_tier_form).find('#Id').val(company_tier.Id)

                $(company_tier_form).find('#tier-name-txt').val(company_tier.TierName)
                $(company_tier_form).find('#seq-no-txt').val(company_tier.SeqNo)
                $(company_tier_form).find('#totpay-amt-start-txt').val(Number(company_tier.TotpayAmtStart))
                $(company_tier_form).find('#totpay-amt-end-txt').val(Number(company_tier.TotpayAmtEnd))
                $(company_tier_form).find(`input[name="use_dc"][value="${company_tier.BenefitType}"]`).prop('checked', true)
                $(company_tier_form).find('#order-dc-type-select').val(company_tier.OrderDcType)
                $(company_tier_form).find('#dc-from-ordamt-txt').val(Number(company_tier.DcFromOrdamt))
                $(company_tier_form).find('#dc-amt-txt').val(Number(company_tier.DcAmt))
                $(company_tier_form).find('#dc-rate-select').val(Number(company_tier.DcRate))
                $(company_tier_form).find('#max-dc-amt-txt').val(Number(company_tier.MaxDcAmt))
                $(company_tier_form).find('#reward-from-ordamt-txt').val(Number(company_tier.RewardFromOrdamt))
                $(company_tier_form).find('#reward-amt-txt').val(Number(company_tier.RewardAmt))
                $(company_tier_form).find('#reward-rate-txt').val(Number(company_tier.RewardRate))
                $(company_tier_form).find('#max-reward-amt-txt').val(Number(company_tier.MaxRewardAmt))

                $(company_tier_form).find('#is-free-delivery-check').prop('checked', company_tier.IsFreeDelivery == '1')

                PopupForm1FormAProCompanyTierForm.set_use_dc($(company_tier_form).find('input[name="use_dc"]:checked'))

                const dc_rate_type = Number($(company_tier_form).find('#dc-amt-txt').val()) === 0 ? 'P' : 'W'
                const dc_reward_type = Number($(company_tier_form).find('#reward-amt-txt').val()) === 0 ? 'P' : 'W'
                $(company_tier_form).find('#dc-rate-type-select').val(dc_rate_type)
                $(company_tier_form).find('#reward-type-rate-select').val(dc_reward_type)
                PopupForm1FormAProCompanyTierForm.set_dc_type($(company_tier_form).find('#dc-rate-type-select'), 'D')
                PopupForm1FormAProCompanyTierForm.set_dc_type($(company_tier_form).find('#reward-type-rate-select'), 'P2')
            }

        }( window.PopupForm1FormAProCompanyTierForm = window.PopupForm1FormAProCompanyTierForm || {}, jQuery ));
    </script>
@endpush
@endonce
