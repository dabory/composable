(function($) {
    $.fn.signup = async function(options) {
        const opts = $.extend({}, $.fn.signup.defaults, options)

        this.append(html.call(this, '', opts, ''))
        loadModule.call(this)

        callApi.call(this)
    };

    function callApi(limit = 10, offset = 0, page = 1) {
        const self = this

        $.fn.dataLinker.api23Js('setup-get', {
            'SetupCode': 'passwd-policy',
            'BrandCode': 'member'
        }, function (response) {
            console.log(response)
            $(self).find('.policy-desc-em').text(response['PolicyDesc'])
        })
    }

    function html(signupList, opts, langJson) {
        return `<div class="dabory-signup-popup signup" style="top: ${opts['top']}px; left: ${opts['left']}px; width: ${opts['width']}px; display: none;">
            <button type="button" class="tab-close" data-widget="signup">
                <img src="/dabory/common/image/close-button.svg" alt="close-butto">
            </button>
            <div class="dabory-signup-box">

                <div class="dabory-signup-row">
                    <div class="dabory-signup-col">
                       <div class="dabory-signup-form">
                            <h3>Dabory Signup</h3>

                            <div class="form-div">
                               <label>이름*</label>
                               <input type="text" class="first-name-txt" aria-label="이메일">
                            </div>

                            <div class="form-div">
                               <label>휴대전화*</label>
                               <input type="text" class="mobile-no-txt" placeholder="">
                            </div>

                            <div class="form-div">
                               <label>이메일*</label>
                               <input type="text" class="email-txt" aria-label="이메일">
                            </div>

                            <div class="form-div">
                               <label>비밀번호*</label>
                               <input type="password" class="password-txt" aria-label="이메일">
                            </div>

                            <div class="form-div">
                               <label>비밀번호 확인*</label>
                               <input type="password" class="password-confirmation-txt" aria-label="이메일">
                            </div>

                            <div class="form-div">
                                <em class="policy-desc-em"></em>
                            </div>

                            <div class="form-div">
                                <input type="checkbox" id="policy-txt" class="policy-txt"  aria-label="선택">
                                <label for="policy-txt">
                                    <a href="https://daborysso.com/policy-list" target="_blank">회원가입 이용 약관</a>
                                </label>
                            </div>
                            <button type="button" class="send-btn" disabled>
                                <span class="button__text">회원가입</span>
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

    function actSignupApi($btn) {
        const self = this
        $($btn).prop('disabled', true)
        $.fn.widget.spinnerLoading($(this).find('.send-btn'), true)

        $.fn.dataLinker.daboryApp('member-signup', {
            "first_name": $(this).find('.first-name-txt').val(),
            "mobile_no": $(this).find('.mobile-no-txt').val(),
            "email": $(this).find('.email-txt').val(),
            "password": $(this).find('.password-txt').val(),
        }, function (response) {
            $.fn.widget.spinnerLoading($(self).find('.send-btn'), false)
            $($btn).prop('disabled', false)
            hidePopup.call(self)

            if (response.apiStatus) {
                return iziToast.error({ title: 'Error', message: response.apiStatus.body });
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
        $(this).find('.dabory-signup-popup').hide()
        $(this).closest('#dabory-widget-list').trigger('hide.widget', 'signup')
    }

    function loadModule() {

        const self = this
        $(document).ready(function () {
            $(self).find('.dabory-signup-popup').draggable()

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
                    actSignupApi.call(self, this)
                }
            });

            $(self).find('.current-url-txt').on('click', function() {
                $(this).val('')
                validateInputs.call(self)
            });

            $(document).on('show.widget', '.dabory-signup-popup', function (event, widgetName) {
                const currentURL = window.location.protocol + "//" + window.location.host + window.location.pathname
                $(self).find('.current-url-txt').val(currentURL)
            });

            $(self).find('.first-name-txt').on('input', function () {
                validateInputs.call(self)
            });

            $(self).find('.mobile-no-txt').on('input', function () {
                validateInputs.call(self)
            });

            $(self).find('.email-txt').on('change', function () {
                validateInputs.call(self)
            });

            $(self).find('.password-txt').on('change', function () {
                validateInputs.call(self)
            });

            $(self).find('.password-confirmation-txt').on('change', function () {
                validateInputs.call(self)
            });

            $(self).find('.policy-txt').on('change', function () {
                validateInputs.call(self)
            });

            $(self).find('.dabory-signup-popup').css('z-index', '10000')
            $(self).find('.dabory-signup-popup').css('display', 'block')
        });
    }

    function validateInputs() {
        // Get the input values
        const value1 = $(this).find('.first-name-txt').val()
        const value2 = $(this).find('.mobile-no-txt').val()
        const value3 = $(this).find('.email-txt').val()
        const value4 = $(this).find('.password-txt').val()
        const value5 = $(this).find('.password-confirmation-txt').val()

        // Perform your validation checks
        if (value1.length >= 1 && value2.length >= 1 && value3.length >= 1
            && value4.length >= 1 && value5.length >= 1 && $(this).find('.policy-txt').prop('checked')) {
            // Enable the submit button
            $(this).find('.send-btn').prop('disabled', false)
        } else {
            // Disable the submit button
            $(this).find('.send-btn').prop('disabled', true)
        }
    }

    $.fn.signup.defaults = {
        top: 0,
        left: 0,
        width: 500,
        langType: 'ko',
        basePath: '/dabory/widget/signup',
    };

}(jQuery));
