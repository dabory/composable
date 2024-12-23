(function($) {
    $.fn.widget = function(options) {

    }

    $.fn.widget.spinnerLoading = function (dom, loading) {
        if (loading) {
            $(dom).addClass('button--loading')
        } else {
            $(dom).removeClass('button--loading')
        }
    }

    $.fn.widget.loadModule = async function(callback) {
        loadVendor()

        await $.getJSON($.fn.widget.defaults['modFilePath'], function (data) {
            data['require']['css'].forEach(path => {
                $('head').append(`<link rel="stylesheet" href="${path}">`)
            })

            data['require']['js'].forEach(path => {
                $('head').append(`<script src="${path}"></script>`)
            })
        });

        callback()
    }

    function loadVendor() {
        const vendorPath = $.fn.widget.defaults['vendorPath']
        if (typeof iziToast == 'undefined') {
            $('head').append(`<script src="${vendorPath}/iziToast/iziToast.js"></script>`)
        }
        if (typeof Swiper === 'undefined') {
            $('head').append(`<script src="${vendorPath}/swiper/swiper-bundle.js"></script>`)
        }
        if (typeof moment == 'undefined') {
            $('head').append(`<script src="${vendorPath}/moment/moment.min.js"></script>`)
        }
        if (jQuery().draggable === undefined) {
            $('head').append(`<script src="${vendorPath}/jquery-ui.js"></script>`)
        }
        if ($.cookie === undefined) {
            $('head').append(`<script src="${vendorPath}/jquery.cookie.js"></script>`)
        }
    }

    $.fn.widget.defaults = {
        widgetPath: '/dabory/widget',
        vendorPath: '/dabory/vendor',
        modFilePath: '/dabory/mod.json',
    };

}(jQuery));
