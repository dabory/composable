(function($) {
    $.fn.dataLinker = function(options) {
    }

    $.fn.dataLinker.appBase64 = null;

    $.fn.dataLinker.daboryApp = function (url, request, callback, async = true) {
        getParameter()

        $.ajax({
            url: `${$.fn.dataLinker.serverUrl}/dabory-app/${url}`,
            data: JSON.stringify(request),
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Api23Key', $.fn.dataLinker.api23Key);
            },
            method: 'POST',
            dataType: 'json',
            async: async,
        })
        .done(function (json) {
            callback(json)
        })
        .fail(function(json, textStatus, errorThrown) {
            callback(json);
            iziToast.error({ title: 'Error', message: 'Dabory App API Error' });
        });
    }

    $.fn.dataLinker.api23Js = function (url, request, callback, async = true) {
        getParameter()

        $.ajax({
            url: `${$.fn.dataLinker.serverUrl}/dabory-app/api23-js`,
            data: JSON.stringify(request),
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Url', url);
                xhr.setRequestHeader('Api23Key', $.fn.dataLinker.api23Key);
            },
            method: 'POST',
            dataType: 'json',
            async: async,
        })
        .done(function (json) {
            callback(json)
        })
        .fail(function(json, textStatus, errorThrown) {
            callback(json);
            iziToast.error({ title: 'Error', message: 'Dabory App api23-js API Error' });
        });
    }

    $.fn.dataLinker.localApi = function (url, request, callback, async = true) {
        getParameter()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/ajax/get-data',
            data: {
                url: url,
                data: JSON.stringify(request),
                encode_status: true,
            },
            method: 'POST',
            dataType: 'json',
            async: async,
        })
            .done(function (json) {
                callback(json)
            })
            .fail(function(json, textStatus, errorThrown) {
                callback(json);
                iziToast.error({ title: 'Error', message: 'Dabory App api23-js API Error' });
            });
    }

    function getParameter() {
        if ($.fn.dataLinker.api23Key && $.fn.dataLinker.serverUrl) {
            return
        }

        let libFileName = '/dabory/js/widget.js',
            scripts = document.getElementsByTagName('script'),
            i, j, src, parts, basePath, options = {};

        for (i = 0; i < scripts.length; i++) {
            src = scripts[i].src;
            if (src.indexOf(libFileName) !== -1) {
                parts = src.split('?');
                basePath = parts[0].replace(libFileName, '');
                if (parts[1]) {
                    const opt = parts[1].split('&');
                    for (j = opt.length-1; j >= 0; --j) {
                        const pair = opt[j].split(/=(.*)/s);
                        options[pair[0]] = pair[1];
                    }
                }
                break;
            }
        }

        $.fn.dataLinker.api23Key = options['api23Key']
        $.fn.dataLinker.serverUrl = options['serverUrl']
    }
}(jQuery));


