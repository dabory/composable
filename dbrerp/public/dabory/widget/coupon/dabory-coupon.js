(function($) {
    $.fn.coupon = async function(options) {
        const opts = $.extend({}, $.fn.coupon.defaults, options)

        this.append(html.call(this, '', opts, ''))

        loadModule.call(this)
    };

    function html(couponList, opts, langJson) {
        return `<div class="dabory-coupon-popup coupon" style="top: ${opts['top']}px; left: ${opts['left']}px; width: ${opts['width']}px; display: none;">
            <button type="button" class="tab-close" data-widget="coupon">
                <img src="/dabory/common/image/close-button.svg" alt="close-butto">
            </button>
            <div class="dabory-coupon-box">

                <div class="dabory-coupon-row">
                    <div class="dabory-coupon-col">
                       <div class="dabory-coupon-form">
                            <h3>Dabory Coupon</h3>

                            <div class="form-div">
                                <p>[사용방법]</p>
                                <p>(1) 타 사이트의 품목상세 페이지 주소를 복사해서 붙여넣기</p>
                                <p>(2) 타 사이트 품목상세 페이지에서 "다보리 쿠폰" 퀵런처가 보이면</p>
                                <p class="in">해당 버튼을 클릭하기</p>
                            </div>

                            <div class="form-div">
                               <label>상품상세페이지 인터넷 주소*</label>
                               <input type="text" class="current-url-txt" placeholder="목표상품의 인터넷 주소를 복사/붙여넣기" aria-label="인터넷주소">
                            </div>

                            <div class="form-div">
                               <label>쿠폰을 받을 이메일주소*</label>
                               <input type="text" class="buyer-email-txt" aria-label="이메일">
                            </div>

                            <div class="form-div">
                                <label>할인 요청 %</label>
                                <select class="init-dcrate-select">
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                </select>
                            </div>

                            <div class="form-div">
                                <label>할인 조건(이유)</label>
                                <select class="sort-select">
                                    <option value="">해당 사항 없음</option>
                                    <option value="0">상품설명 블로그 작성(2000자 이상)</option>
                                    <option value="1">사용후기 작성(500자 이상)</option>
                                    <option value="2">대량구매(도매)</option>
                                    <option value="3">기타(직접입력)</option>
                                </select>
                            </div>

                            <div class="form-div">
                               <label>할인 조건 직접입력</label>
                               <input type="text" class="sort-desc-txt" disabled  aria-label="할인조건 입력">
                            </div>

                            <div class="form-div">
                                <input type="checkbox" id="policy-txt" class="policy-txt"  aria-label="선택">
                                <label for="policy-txt">
                                    <a href="https://dabory-v1.daboryhost.com/policy-list" target="_blank">쿠폰 신청 이용 약관</a>
                                </label>
                            </div>

                            <div class="form-div text-xs-center">
<!--                            비밀키: 6Lc-nT8mAAAAAMfPpbrZtZWDd5kfmMDFHTE-LzjG-->
                                <div id="captcha" class="g-recaptcha" data-sitekey="6Lc-nT8mAAAAAPFpx7YAB4LyOCjHel6_zrD0j1yy">
                                </div>
                            </div>

                            <button type="button" class="send-btn" disabled>
                                <span class="button__text">쿠폰 신청</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>`
    }

    function getLangText(langJson, key) {
        if (! langJson) { return key }

        return langJson[key]
    }

    function actCouponApi($btn) {
        const self = this
        $($btn).prop('disabled', true)
        $.fn.widget.spinnerLoading($(this).find('.send-btn'), true)

        $.fn.dataLinker.daboryApp('item-url-scrap', {
            "ItemUrl": $(this).find('.current-url-txt').val(),
            "InitDcrate": $(this).find('.init-dcrate-select').val(),
            "BuyerEmail": $(this).find('.buyer-email-txt').val(),
            "Sort": $(this).find('.sort-select').val(),
            "SortDesc": $(this).find('.sort-desc-txt').val(),
        }, function (response) {
            $.fn.widget.spinnerLoading($(self).find('.send-btn'), false)
            $($btn).prop('disabled', false)
            hidePopup.call(self)
            window.location.href = '/item-gallery/05'

            if (response.apiStatus) {
                if (response.apiStatus === 604) {
                    return iziToast.error({ title: 'Error', message: '쿠폰지원예정-웹사이트(보류중)' });
                }
                return iziToast.error({ title: 'Error', message: 'API Error' });
            }

            return iziToast.success({ title: 'Success', message: 'Success' });

        })
    }

    function isRequiredInput() {
        if (! $(this).find('.current-url-txt').val()) {
            iziToast.error({ title: 'Error', message: '상품상세페이지 인터넷 주소를 입력하세요' });
            return false;
        }

        if (! $(this).find('.buyer-email-txt').val()) {
            iziToast.error({ title: 'Error', message: '쿠폰을 받을 이메일주소를 입력하세요' });
            return false;
        }

        if (! $(this).find('.policy-txt').prop('checked')) {
            return iziToast.error({ title: 'Error', message: '쿠폰 신청 이용 약관 에 동의하셔야 합니다' })
        }

        return true;
    }

    function hidePopup() {
        $(this).find('.dabory-coupon-popup').hide()
        $(this).closest('#dabory-widget-list').trigger('hide.widget', 'coupon')
    }

    function loadModule() {

        const self = this
        $(document).ready(function () {
            $(self).find('.dabory-coupon-popup').draggable()

            $(self).find('.sort-select').on('change', function() {
                $(self).find('.sort-desc-txt').val('')
                $(self).find('.sort-desc-txt').prop('disabled', $(this).val() !== '3')
            });

            $(self).find('.send-btn').on('click', function() {
                const v = grecaptcha.getResponse();
                if (v.length === 0) {
                    return  iziToast.error({ title: 'Error', message: "자동입력방지 기능 - '로봇이 아닙니다.'를 체크해주세요" });
                }

                if (isRequiredInput.call(self)) {
                    actCouponApi.call(self, this)
                }
            });

            $(self).find('.current-url-txt').on('click', function() {
                $(this).val('')
                validateInputs.call(self)
            });

            $(document).on('show.widget', '.dabory-coupon-popup', function (event, widgetName) {
                const currentURL = window.location.protocol + "//" + window.location.host + window.location.pathname
                $(self).find('.current-url-txt').val(currentURL)
            });

            $(self).find('.current-url-txt').on('input', function () {
                validateInputs.call(self)
            });

            $(self).find('.buyer-email-txt').on('input', function () {
                validateInputs.call(self)
            });

            $(self).find('.policy-txt').on('change', function () {
                validateInputs.call(self)
            });
        });
    }

    function validateInputs() {
        // Get the input values
        const value1 = $(this).find('.current-url-txt').val()
        const value2 = $(this).find('.buyer-email-txt').val()
        // Perform your validation checks
        if (value1.length >= 1 && value2.length >= 1 && $(this).find('.policy-txt').prop('checked')) {
            // Enable the submit button
            $(this).find('.send-btn').prop('disabled', false)
        } else {
            // Disable the submit button
            $(this).find('.send-btn').prop('disabled', true)
        }
    }

    $.fn.coupon.defaults = {
        top: 0,
        left: 0,
        width: 500,
        langType: 'ko',
        basePath: '/dabory/widget/coupon',
    };

}(jQuery));
