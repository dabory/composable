async function get_api_data(url, data, type = null, para_cache = false) {
    if (isEmpty(type)) {
        return await get_main_api_data(url, data, para_cache)
    } else {
        return await get_app_api_data(url, data, type, para_cache)
    }
}

async function get_strong_api_data(strong_type, url, data) {
    return await get_main_api_data(url, data, false, false, strong_type)
}

async function get_main_api_data(url, data, para_cache, encode_status = false, strong_type = false) {
    const is_user_page = window.location.href.includes('/dabory/erp')
    if (is_user_page) {
        $('#spinner-processing').show()
    }
    const response = await axios.post('/ajax/get-data', {
        url: url,
        data: data,
        is_user_page: is_user_page,
        para_cache: para_cache,
        encode_status: encode_status,
        strong_type: strong_type,
    });
    if (is_user_page) {
        $('#spinner-processing').hide()
    }

    // console.log(response)
    // return response
    // console.log(window.User)
    // console.log(window.Member)

    if (! isEmpty(response.data['apiStatus'])) {
        // console.log(url)
        // console.log(data)
        // console.log(response)
        error_response(response.data['apiStatus'], response.data['body'])
    }

    return response
}

async function get_app_api_data(url, data, type, para_cache) {
    const AppToken = await call_local_api('/find-gate-token', { app_name: type } )

    if (! AppToken.data) {
        return
    }

    const is_user_page = window.location.href.includes('/dabory/erp')

    if (is_user_page) {
        $('#spinner-processing').show()
    }
    const response = await axios.post('/ajax/get-data', {
        url: AppToken.data['ApiUrl'] + '/' + url,
        type: 'custom',
        data: data,
        is_user_page: is_user_page,
        headers: {
            GateToken: AppToken.data['GateToken']
        },
        para_cache: para_cache,
        encode_status: false
    });
    if (is_user_page) {
        $('#spinner-processing').hide()
    }

    const status_code = response.data['apiStatus']
    if (! isEmpty(status_code)) {
        if (status_code === '555') {
            return window.location.href = '/505'
        }

        iziToast.error({
            title: type + 'DB -> status code: ' + status_code,
            message: response.data['body'] ?? $('#api-request-failed-please-check').text(),
        });
    }

    // console.log(response)

    return response
}

async function call_local_api(url, data, headers = {}) {
    const response = await axios.post(url, data, {
        headers: headers
    })

    if (! isEmpty(response.data['apiStatus'])) {
        // console.log(url)
        // console.log(data)
        // console.log(response)
        error_response(response.data['apiStatus'], response.data['body'])
    }

    return response
}


function error_response(status_code, message) {
    switch ( status_code ) {
        // default:
        case 503:
            window.location.href = '/503'
            break
        case 505:
        case 555:
            window.location.href = '/505'
            break
        case 506:
            window.location.href = '/506'
            break
        case 600:
            window.location.href = '/600'
            break
    }

    // iziToast.error({
    //     title: 'status code: ' + status_code,
    //     message: message,
    // });
    return true
}

function get_cache_api_data(api_name, callback, menu_code, query_name = false) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/cache-api",
        type:'POST',
        data: {
            menu_code: menu_code,
            api_name: api_name,
            query_name: query_name,
        },
        cache: false,
        success: function(cacheData) {
            callback(cacheData)
        }
    });
}

function get_blades_html(path_to_blade, data, callback,
                         key = 'moealSetFile', class_name = []) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/blades",
        type:'POST',
        data: {
            path_to_blade: path_to_blade,
            data: data,
            key: key,
            class_name: class_name,
        },
        cache: false,
        success: function(html) {
            // let array = path_to_blade.split('.');
            // let id = '#modal-' + array[array.length - 1];
            // if ( ! isEmpty( $(id).html() ) ) return;
            // console.log(html)
            callback(html)
        },
        error: function(error) {
            console.log(error.responseJSON)
            iziToast.error({
                title: 'Error', message: '실패했습니다.',
            });
        }
    });
}

async function get_para_data(para_type, path_to_para,
                             bpa = undefined, theme_dir = undefined) {
    return await axios.post('/paras', {
        para_type: para_type,
        path_to_para: path_to_para,
        bpa: bpa,
        theme_dir: theme_dir
    });
}

async function call_slip_form_book(url, query_name, filter_value, menuCode, strong_type = false) {
    let response = await get_api_data(url,
    {
        QueryVars: {
            QueryName: query_name,
            FilterValue: filter_value
        }
    }, null, menuCode);
    return response
}

async function get_slip_common_setup_for(brand_code) {
    return await get_api_data('setup-get', {
        'SetupCode': 'slip-common',
        'BrandCode': brand_code,
    })
}

async function make_slip_no(brand_code, table_name) {
    const slip_common = await get_slip_common_setup_for(brand_code)

    if (slip_common.data['IsNewRecAutoSlipNo']) {
        const last_slip_no_get = await get_api_data('last-slip-no-get', {
            'TableName': 'item-yw',
            'YYMMDD': moment(new Date()).format('YYMMDD'),
        })

        return slip_common.data['SlipPrefix'] +
            moment(new Date()).format(slip_common.data['YymmddFormat']) + '-'
            + last_slip_no_get.data.LastSlipNo.padStart(slip_common.data['SerialDigit'], '0')
    }

    return false;
}

function route(url) {
    if (self !== top) {
        window.top.location.href = url
    } else {
        window.location.href = url
    }
}
