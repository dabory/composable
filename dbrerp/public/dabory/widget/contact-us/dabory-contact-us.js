(function($) {
    $.fn.contactUs = async function(options) {
        const opts = $.extend({}, $.fn.contactUs.defaults, options)

        this.append(html.call(this, '', opts, ''))
        loadModule.call(this)
    };

    function html(contactUsList, opts, langJson) {
        return `<div class="dabory-contact-us-popup contact-us" style="top: ${opts['top']}px; left: ${opts['left']}px; width: ${opts['width']}px; display: none;">
            <button type="button" class="tab-close" data-widget="contact-us">
                <img src="/dabory/common/image/close-button.svg" alt="close-butto">
            </button>
            <div class="dabory-contact-us-box">

                <div class="dabory-contact-us-row">
                    <div class="dabory-contact-us-col">
                       <div class="dabory-contact-message">
                            <ul>
                                <li> <div>Adress : 경기도 광명시 하안로 60 광명SK테크노파크 B동 401호</div></li>
                                <li> <div>Phone : 070-7781-0300</div></li>
                                <li> <div>Fax : 02-2083-2880</div></li>
                                <li> <div>E-mail : <a href="mailto:seco@secointerface.com">seco@secointerface.com</a></div></li>
                            </ul>
                        </div>
                    </div>

                    <div class="dabory-contact-us-col">
                       <div class="dabory-contact-form">
                            <h3>CONTACT US</h3>

                            <p>
                               <label>이메일 주소 *</label>
                               <input type="email" class="pc5-txt" placeholder="이메일 주소 *" required aria-label="이메일">
                            </p>

                            <p>
                               <label>모바일 번호</label>
                               <input type="tel" class="pc4-txt" placeholder="모바일 번호" aria-label="모바일">
                            </p>

                            <p>
                               <label>제목 *</label>
                               <input type="text" class="post-title-txt" placeholder="제목 *" required aria-label="제목">
                            </p>

                            <div class="contact_textarea">
                                <label>요청 내용 *</label>
                                <textarea placeholder="요청 내용 *" class="post-contents-textarea" required aria-label="요청 내용"></textarea>
                            </div>

                            <button type="button" class="send-btn">
                                Send
                            </button>
                            <button type="button" class="close-btn">
                                Close
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

    function actContactUsApi($btn) {
        $($btn).prop('disabled', true)

        const toMail = $(this).find('.dabory-contact-form .pc5-txt').val()

        $.fn.dataLinker.api23Js('post-act', {
            "Page": [
                {
                    "Id": 0,
                    "PostTitle": $(this).find('.dabory-contact-form .post-title-txt').val(),
                    "PostContents": $(this).find('.dabory-contact-form .post-contents-textarea').val(),
                    "Pc4": $(this).find('.dabory-contact-form .pc4-txt').val(),
                    "Pc5": toMail,
                    "PostTypeId": 7,
                    "Status": "2",
                }
            ]
        }, function (response) {
            $($btn).prop('disabled', false)
            if (response.apiStatus) {
                return iziToast.error({ title: 'Error', message: 'API Error' });
            }

            $.fn.dataLinker.daboryApp('send-mail', {
                "Component": "views.emails.contact-us",
                "Data": "TEST",
                "ToMail": toMail,
                "Subject": "CONTACT TEST"
            }, function () { })
            return iziToast.success({ title: 'Success', message: 'Success' });
        })
    }

    function loadModule() {
        const self = this
        $(document).ready(function () {
            $(self).find('.dabory-contact-us-popup').draggable()

            $(self).find('.send-btn').on('click', async function() {
                actContactUsApi.call(self, this)
            });

            $(self).find('.close-btn').on('click', function() {
                $(self).find('.dabory-contact-us-popup').hide()
                $(self).closest('#dabory-widget-list').trigger('hide.widget', 'contact-us')
            });
        });
    }

    $.fn.contactUs.defaults = {
        top: 0,
        left: 0,
        width: 850,
        langType: 'ko',
        basePath: '/dabory/widget/contact-us',
    };

}(jQuery));
