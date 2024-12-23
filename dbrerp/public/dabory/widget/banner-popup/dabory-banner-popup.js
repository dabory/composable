(function($) {
    $.fn.bannerPopup = async function(options) {
        const opts = $.extend({}, $.fn.bannerPopup.defaults, options)
        const langJson = await loadLangJson.call(this, opts['basePath'], opts['langType'])
        callBannerApi.call(this, opts, langJson)
    };

    function appendSlide(bannerList, opts) {
        return bannerList.reduce((html, banner) => {
            return html + `<li class="dabory-slide swiper-slide" style="width: ${opts['width']}px;">
                    <a href="${banner['C5']}" target="${banner['C4'] === '0' ? '_self' : '_blank'}">
                        <img src="${$.fn.dataLinker.serverUrl ?? window.env['MEDIA_URL']}${banner['C11']}" style="width: ${opts['width']}px;">
                    </a>
                </li>`
        }, '')
    }

    function callBannerApi(opts, langJson) {
        const self = this
        const connectionDevice = opts['connectionDevice'];
        $.fn.dataLinker.localApi('list-type1-book', {
            "Book": [
                {
                    "QueryVars": {
                        "QueryName": "post/banner-input",
                        "SimpleFilter": "(mx.post_type_id = 8 and mx.status = '0') and (DATE_FORMAT(now(), '%Y-%m-%d') BETWEEN mx.pc6 AND mx.pc7)",
                        "IsntPagination": true,
                    },
                    "ListType1Vars" : {
                        'OrderBy': 'mx.pc3 asc'
                    },
                    "PageVars": {
                        "Limit": 100000
                    }
                },
                {
                    "QueryVars": {
                        "QueryName": "pro/setup",
                        "SimpleFilter": "setup_code='popup-slider'",
                        "IsntPagination": true,
                    },
                    "PageVars": {
                        "Limit": 100000
                    }
                }
            ]

        }, function (response) {
            const bannerList = response['Book'][0]['Page']
            if (bannerList) {
                // if(connectionDevice == 'desktop'){
                //
                //     bannerList['Setup'] = JSON.parse(response['Book'][1]['Page'][0]['C1'])
                // }else{
                //     bannerList['Setup'] = JSON.parse(response['Book'][1]['Page'][1]['C1'])
                // }
                bannerList['Setup'] = JSON.parse(response['Book'][1]['Page'][0]['C1'])

                opts['width'] = bannerList['Setup']['Width']
                opts['left'] = bannerList[0]['C7']
                opts['top'] = bannerList[0]['C8']

                self.append(html.call(self, bannerList, opts, langJson))
                loadModule.call(self, bannerList.map(banner => banner['C1']), bannerList['Setup'])
            }
        })
    }

    async function loadLangJson(basePath, langType) {
        let langJson = null

        if (langType === 'ko') { return langJson }
        const filePath = `${basePath}/lang/${langType}.json`
        await $.getJSON(filePath, function (data) {
            langJson = data
        });

        return langJson
    }

    // function loadScript(basePath) {
    //     if (typeof Swiper === 'undefined') {
    //         $('head').append(`<script src="${basePath}/swiper/swiper-bundle.js"></script>`)
    //     }
    //     if (jQuery().draggable === undefined) {
    //         $('head').append(`<script src="${basePath}/jquery-ui.js"></script>`)
    //     }
    //     if ($.cookie === undefined) {
    //         $('head').append(`<script src="${basePath}/jquery.cookie.js"></script>`)
    //     }
    // }

    function loadSwiper(popupTitleList, setup) {
        const swiper = new Swiper($(this).find('.dabory-container')[0], {
            allowTouchMove: false,
            pagination: {
                el: $(this).find('.dabory-pagination')[0],
                clickable: true,
                renderBullet: function (index, className) {
                    const titleList = popupTitleList[index].split(' ')
                    let caption = ''
                    titleList.forEach((title, index) => {
                        if (index === 0) {
                            caption += title
                        } else if (index === 1) {
                            caption += (`<br>${title}`)
                        } else {
                            caption += ' ' + title
                        }
                    });

                    return `<div class="dabory-pagination-item ${className}">
                                <div class="dabory-pagination-item-link"
                                style="height: ${setup['FooterHeight']}px !important;">
                                    <span class="dabory-pagination-item-text">${caption}</span>
                                </div>
                            </div>`
                }
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        $(this).find('.dabory-slide').on('mouseover', function() {
            swiper.autoplay.stop();
        });
        $(this).find('.dabory-slide').on('mouseout', function() {
            swiper.autoplay.start();
        });
    }

    function todayCloseBanner(today = false) {
        if (today) {
            $.cookie($(this).getSelector(), 'ok', { expires: 1, path: '/' });
        }

        $(this).find('.dabory-bannermanager').hide()
        $(this).closest('#dabory-widget-list').trigger('hide.widget', 'banner')
    }

    function loadModule(titleList, setup) {
        const self = this
        $(document).ready(function () {
            $(self).find('.dabory-multipopup').draggable()

            // TODO: 배너 처음에 뜨는 부분 우선 주석처리함
            // if ($.cookie($(self).getSelector()) === 'ok') {
            //     $(self).find('.dabory-bannermanager').css('display', 'none')
            // }
            // else {
            //     $(self).find('.dabory-bannermanager').css('display', 'block')
            // }

            $(self).find('.dabory-multipopup-btn-item_close').on('click', function() {
                todayCloseBanner.call(self)

            });

            $(self).find('.dabory-multipopup-btn-item_todayclose').on('click', function() {
                todayCloseBanner.call(self, true)
            });

            loadSwiper.call(self, titleList, setup)
        });
    }

    function html(bannerList, opts, langJson) {
        return `<div class="dabory-multipopup dabory-bannermanager dabory-bannermanager-pc-multi-popup banner"
                style="top: ${bannerList['Setup']['PosY']}px; left: ${bannerList['Setup']['PosX']}px; width: ${bannerList['Setup']['Width']}px; display: ${opts['hide'] ? 'none' : 'block'}; z-index: 9999;">
            <div class="dabory-multipopup-box">
                <div class="dabory-slider">
                    <div
                        class="dabory-container swiper-container swiper-container-slide swiper-container-initialized swiper-container-horizontal swiper-container-autoheight">
                        <ul class="swiper-wrapper">
                            ${appendSlide.call(this, bannerList, opts)}
                        </ul>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>

                    <div
                        class="dabory-pagination swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-text">
                    </div>
                </div>
            </div>

            <div class="dabory-multipopup-btn-items">
                <div class="dabory-multipopup-btn-item dabory-multipopup-btn-item_todayclose"
                style="background-color: ${bannerList['Setup']['FooterBackColor']} !important; color: ${bannerList['Setup']['FooterFontColor']} !important; height: ${bannerList['Setup']['FooterHeight']}px !important;">
                    ${getLangText(langJson, '오늘하루 열지 않음')}
                </div>
                <div class="dabory-multipopup-btn-item dabory-multipopup-btn-item_close"
                style="background-color: ${bannerList['Setup']['FooterBackColor']} !important; color: ${bannerList['Setup']['FooterFontColor']} !important; height: ${bannerList['Setup']['FooterHeight']}px !important;">
                     ${getLangText(langJson, '닫기')}
                </div>
            </div>
        </div>`
    }

    function getLangText(langJson, key) {
        if (! langJson) { return key }

        return langJson[key]
    }

    $.fn.bannerPopup.defaults = {
        top: 0,
        left: 0,
        width: 650,
        langType: 'ko',
        basePath: '/dabory/widget/banner-popup',
        hide: true
    };

}(jQuery));
