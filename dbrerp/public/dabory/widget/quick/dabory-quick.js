(function($) {
    $.fn.quick = async function(options) {
        const opts = $.extend({}, $.fn.quick.defaults, options)
        $.fn.quick.zIndex = 5000

        callApi.call(this)
    };

    function callApi() {
        const self = this

        $.fn.dataLinker.api23Js('setup-get', {
            "SetupCode": "quick-launcher"
        }, function (response) {
            if (response['apiStatus']) {
                return iziToast.error({ title: 'Error', message: response['body'] });
            }
            self.append(html.call(self, response))

            loadModule.call(self)
            loadWidget.call(self)
        })
    }

    function loadWidget() {
        this.append(
            `<div id="dabory-widget-list">
                <div id="dabory-banner"></div>
                <div id="dabory-contact-us"></div>
                <div id="dabory-coupon"></div>
                <div id="dabory-signup"></div>
                <div id="dabory-review"></div>
            </div>`
        )

        $(this).find('#dabory-banner').bannerPopup({
            hide: true,
        })
        $(this).find('#dabory-contact-us').contactUs({
            top: 170,
            left: 170,
        })
        $(this).find('#dabory-coupon').coupon({
            top: 40,
            left: 375,
        })
        $(this).find('#dabory-signup').signup({
            top: 40,
            left: 375,
        })
        $(this).find('#dabory-review').review({
            top: 100,
            left: 100,
        })

        loadScript()
    }

    function loadScript() {
        $('head').append(`<script src="https://www.google.com/recaptcha/api.js" async defer></script>`)
    }

    function showWidget(widgetName, active) {
        const $widget = $(this).find(`.${widgetName}`)
        if (active) {
            $($widget).css('z-index', $.fn.quick.zIndex++)
            $($widget).trigger('show.widget')
        }
        $($widget).toggle()
    }

    function attachedType(buttons) {
        return `<div class="dabory-quick-A quick-launcher">
            <ul>
                <li>
                    <button type="button" class="return-to-bottom">
                        <span class="ico ico-bottom"></span>
                    </button>
                </li>
                ${appendButtons.call(this, buttons)}
                <li>
                    <button type="button" class="return-to-top">
                        <span class="ico ico-top"></span>
                    </button>
                </li>
            </ul>
        </div>`
    }

    function floatingType(buttons) {
        return `<div class="dabory-quick-B quick-launcher">
            <ul>
                <li>
                    <button type="button" class="return-to-bottom">
                        <span class="ico ico-bottom"></span>
                    </button>
                </li>
                ${appendButtons.call(this, buttons)}
                <li>
                    <button type="button" class="return-to-top">
                        <span class="ico ico-top"></span>
                    </button>
                </li>
            </ul>
        </div>`
    }

    function appendButtons(buttons) {
        return buttons.reduce((html, button) => {
            return html + `<li>
                <button type="button" class="show-widget-btn" data-widget="${button['Class']}">
                    <img src="${button['ImageUrl']}" alt="${button['Name']}">
                    <p class="txt">${button['Name']}</p>
                </button>
            </li>`
        }, '')
    }

    function html(quickLauncher) {
        switch (quickLauncher['Type']) {
            case 'right-floating':
                return floatingType(quickLauncher['Buttons'])
            case 'right-attached':
                return attachedType(quickLauncher['Buttons'])
        }
    }

    function loadModule() {
        const self = this
        $(document).ready(function () {
            $(document).on('hide.widget', '#dabory-widget-list', function (event, widgetName) {
                $(self).find('.quick-launcher')
                    .find(`[data-widget="${widgetName}"]`)
                    .closest('li').toggleClass('active')
            });

            $(self).find('.show-widget-btn').on('click', function() {
                $(this).closest('li').toggleClass('active')
                showWidget.call(self, $(this).data('widget'), $(this).closest('li').hasClass('active'))
            });

            $(self).find('.return-to-top').on('click', function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 500);
            });

            $(self).find('.return-to-bottom').on('click', function() {
                $('body,html').animate({
                    scrollTop: $('body,html')[0].scrollHeight
                }, 500);
            });

            $(document).on('click', '.tab-close', function () {
                const widget = $(this).data('widget')
                $(this).closest(`.${widget}`).hide()
                $(this).closest('#dabory-widget-list').trigger('hide.widget', widget)
            });

            // $('.show-widget-btn[data-widget="coupon"]').trigger('click')
        });
    }

    $.fn.quick.defaults = {
        langType: 'ko',
        basePath: '/dabory/widget/quick',
    };

}(jQuery));
