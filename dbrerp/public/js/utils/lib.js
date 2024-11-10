const CheckDecimal = x => {
    const realStringObj = obj && obj.toString();
    if (!jQuery.isArray(obj) && (realStringObj - parseFloat(realStringObj) + 1) >= 0) return false;

    const parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

const CheckMail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const result = re.test(String(email).toLowerCase());
    // !result && alert('Email is invalid !!!', 'error');
    return result;
}

const CheckNum = input => !isNaN(input);

const LenCheck = (input, length) => {
    return input.length <= length;
}

const CheckMinMax = (elm, min, max) => {
    const length = $(elm).val().length;
    if (length < min || length > max) {
        $(elm).empty();
        $(elm).focus();
    }
}

function setCookie(cookieName, value, expirationDate) {
    var cookieValue = escape(value) + ((expirationDate == null) ? '' : '; expires=' + expirationDate.toUTCString()) + ';path=/';
    document.cookie = cookieName + '=' + cookieValue;
}

function getCookie(cookieName) {
    var name = cookieName + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');

    for (var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i];
        while (cookie.charAt(0) == ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) == 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return '';
}

function makeTwoDigit(number) {
    return number < 10 ? '0' + number : number.toString();
}

function isEmptyArr(arr)  {
    if(Array.isArray(arr) && arr.length === 0)  {
        return true;
    }

    return false;
}

const CheckSSN = ssn => {
    const ssnPattern = /^[0-9]{3}\-?[0-9]{2}\-?[0-9]{4}$/;
    return ssnPattern.test(ssn);
}

const CheckRequired = inputList => {
    inputList.forEach(item => {
        const value = item.val();
        if (value == null || value == '' || value == undefined) {
            alert(`${item.data('name')} is required !!!`, 'error');

            return false;
        }
    })
};

const ComfirmPasswd = (pass, confirmPass) => pass === confirmPass;

const DisableInput = elm => $(elm).prop('disabled', function (i, v) {
    return !v;
});

const BlinkObject = elm => {
    $(elm).fadeOut('slow', function () {
        $(this).fadeIn('slow', function () {
            BlinkObject(this);
        });
    });
}

const InitCheckBox = (data, name) => {
    let html = '';
    data.forEach(item => {
        html += `<input type="checkbox" name="${name}" value="${item}"> ${item}`;
    });

    return html;
}
const InitRadio = (data, name) => {
    let html = '';
    data.forEach(item => {
        html += `<input type="radio" name="${name}" value="${item}"> ${item}`;
    });

    return html;
}

const InitSelect = (data, name) => `<select name="${name}">${ArrayToOption(data)}</select>`;

const ArrayToOption = array => {
    let html = '';
    array.forEach(item => {
        html += `<option value="${item}">${item}</option>`
    });

    return html;
}

function commaCheck($this) {
    $($this).val(function (index, value) {
        value = value.replace(/,/g, '');
        return numberWithCommas(value);
    });
}

function minusComma(value) {
    let formNumber = "" + trim(value);
    // 문자제거
    // value = formNumber.toString().replace(/[^\d]+/g, "");

    // 콤마제거
    value = formNumber.toString().replace(/,/g, "");
    return value;
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function format_decimal(val, number) {
    let format = decimal_convert(number);
    // 소수점 버린다.
    return numeral(Math.floor(val).toFixed(number)).format(format);
    // 소수점 반올림.
    return numeral(parseFloat(val).toFixed(number)).format(format);
}

function fill_zero(width, str) {
    return (str.length && width > 0) ? str + '.' + new Array(width + 1).join('0') : str;
}

function decimal_convert(point_name) {
    return fill_zero(parseInt(point_name), '0,0')
}

function remove_tag( html ) {
    return html.replace(/(<([^>]+)>)/gi, "");
}

function formatDateString(inputString) {
    // Split the input string into an array of substrings with two characters each
    const chunks = inputString.match(/.{1,2}/g) || [];

    // Initialize an empty result string
    let result = '';

    // Iterate through the chunks and process accordingly
    for (const chunk of chunks) {
        // Check if the chunk is "00"
        if (chunk === "00") {
            // If it is, break out of the loop
            break;
        }

        // Otherwise, add the chunk to the result string
        result += chunk;
    }

    return result;
}

function is_localhost() {
    if (location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
        return true
    }
    return false
}

function get_clusterize_rows_in_block() {
    return 10
    // return is_localhost() ? 10 : 10
}

function remove_comma_and_arithmetic(a, b, type) {
    switch (type) {
        case 'plus':
            return Number(minusComma(a)) + Number(minusComma(b))
        case 'minus':
            return Number(minusComma(a)) - Number(minusComma(b))
    }
}

function unixtimeFormatDate(data) {
    moment.locale('ko')
    return moment(new Date(data * 1000)).format('YYYY-MM-DD HH:mm:ss (dd)')
}

function format_result(data, format, display_vars = undefined) {
    let result = data
    if(isHtmlEncoded(result)){
        result = htmlDecode(result);
    }
    switch (format) {
        case 'YYYY-MM-DD': case 'YYYY.MM.DD': case 'YYYYMMDD':
        case 'YY-MM-DD': case 'YY.MM.DD': case 'YYMMDD':
        case 'yy-mm-dd': case 'yy.mm.dd': case 'yymmdd':
            result = isEmpty(data) ? '' : moment(data).format(format.toUpperCase());
            break;
        case 'unixtime':
            result = isEmpty(data) ? '' : moment(new Date(data * 1000)).format('YY-MM-DD HH:mm:ss');
            break;
        case 'unix-yy.mm.dd':
            result = isEmpty(data) ? '' : moment(new Date(data * 1000)).format('YY-MM-DD');
            break;
        case '$_ThumbNail':
            const w = display_vars['ListWidth'] === 0 ? '100%' : display_vars['ListWidth'] + 'px';
            const h = display_vars['ListHeight'] === 0 ? '100%' : display_vars['ListHeight'] + 'px';

            result = `
                <div class="thumb-nail-title" style="height: ${h};">
                  <div class="thumb-nail-img-div">
                    <img src="${window.env['MEDIA_URL'] + data}" style="max-width:${w}; max-height:${h};"
                    class="thumb-nail-img" onerror="this.src='/images/folder.jpg'">
                  </div>
                </div>
            `;
            // <div class="m-auto" style="width: 100px; height: 100px; overflow: hidden; margin:0 auto;">
            //     <img src="${window.env['MEDIA_URL'] + data}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='/images/folder.jpg'"
            // </div>
            break;
        case '$_FileName':
            let path_list = data.split('/')
            result = path_list[path_list.length - 1];
            break;
        case 'check':
            if (data == 1 || data == true) {
                result = '✓';
            } else {
                result = '';
            }
            break;
        case 'unique':
            result = data.split("'").join('');
            break;
        case 'date_month':
            result = isEmpty(data) ? '' : moment(data).format('YY.MM');
            break;
        case 'date_week':
            result = isEmpty(data) ? '' : `${moment(data).format('YY.MM')}-${moment(data).isoWeek()}`;
            break;
        case 'remove_tag':
            result = remove_tag(data);
            break;
        default:
            if (! isEmpty(format) && format.match(/[A-Za-z]+\s*\(\s*'(.*?)\'\s*\)\s*/)) {
                const func_name = format.replace(')', `, '${data}')`);
                try {
                    result = eval(`format_func_${func_name}`);
                } catch (err) {
                    result = 'Invalid';
                }
            }
            break;
    }

    return result;
}

function htmlDecode(str) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(str, 'text/html');
    return doc.documentElement.textContent;
}

function isHtmlEncoded(str) {
    const htmlEntitiesPattern = /&[a-zA-Z0-9#]{2,6};/;
    return htmlEntitiesPattern.test(str);
}

function format_conver_for(data, format, display_vars = undefined, is_split_column = false) {
    if (is_split_column) {
        if (format.includes('|')) {
            let data_list = data.split('|||');
            let format_list = format.split('|');
            let result_list = [];

            format_list.forEach(function (format, index) {
                if (format.startsWith("^")) {
                    format = format.substring(1);
                }

                result_list.push(format_result(data_list[index], format, display_vars))
            });
            let r = '';
            result_list.forEach(function (result, index) {
                if (index >= result_list.length -1) {
                    r += result
                } else {
                    if (format_list[index + 1].includes('^')) {
                        r += result + '<br/>'
                    } else {
                        r += result + ' | '
                    }
                }
            })
            return r
        }
    }
    return format_result(data, format, display_vars)
}

function format_func_decimal(...argv) {
    const format = capitalize(camelCase(argv[0])) + 'Point';
    let data;

    if (window.User[format] == undefined) {
        return 'Invalid';
    }

    switch (argv.length) {
        case 2:
            data = format_decimal(argv[1], window.User[format]);
            break;
        case 3:
            data = format_decimal(argv[2], window.User[format])
            if (argv[1] === 'nz' && (isEmpty(data) || data == 0)) { data = 0; }
            else if (argv[1] === 'zn' && (isEmpty(data) || data == 0)) { data = ''; }
            break;
    }

    if (argv[1] === '') {
        return ''
    }
    return data;
}

function format_func_status_update(value, data) {
    return { Field: 'Status', Value: format_func_status_rev(value, data),  };
}

function format_func_status_code_update(value, data) {
    return { Field: 'Status', Value: data,  };
}

function format_func_status_rev(value, data) {
    const status = Object.values(window.CodeTitle['status'][value]).filter(status => status.Title == data)
    if (isEmptyArr(status)) { return data;  }

    return _.first(status)['Code'];
}

function format_func_status(value, data) {
    if (window.CodeTitle['status'] && window.CodeTitle['status'][value][data]) {
        return window.CodeTitle['status'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_sort_update(value, data) {
    return { Field: 'Sort', Value: format_func_sort_rev(value, data),  };
}

function format_func_sort_code_update(value, data) {
    return { Field: 'Sort', Value: data,  };
}

function format_func_sort_rev(value, data) {
    const sort = Object.values(window.CodeTitle['sort'][value]).filter(sort => sort.Title == data)
    if (isEmptyArr(sort)) { return data;  }

    return _.first(sort)['Code'];
}

function format_func_sort(value, data) {
    if (window.CodeTitle['sort'] && window.CodeTitle['sort'][value][data]) {
        return window.CodeTitle['sort'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_deal_type_update(value, data) {
    return { Field: 'DealType', Value: format_func_deal_type_rev(value, data),  };
}

function format_func_deal_type_rev(value, data) {
    const deal_type = Object.values(window.CodeTitle['deal-type'][value]).filter(deal_type => deal_type.Title == data)
    if (isEmptyArr(deal_type)) { return data;  }

    return _.first(deal_type)['Code'];
}

function format_func_deal_type(value, data) {
    if (window.CodeTitle['deal-type'] && window.CodeTitle['deal-type'][value][data]) {
        return window.CodeTitle['deal-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_paymethod_rev(value, data) {
    const paymethod = Object.values(window.CodeTitle['paymethod'][value]).filter(paymethod => paymethod.Title == data)
    if (isEmptyArr(paymethod)) { return data;  }

    return _.first(paymethod)['Code'];
}

function format_func_paymethod(value, data) {
    if (window.CodeTitle['paymethod'] && window.CodeTitle['paymethod'][value][data]) {
        return window.CodeTitle['paymethod'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_situation_rev(value, data) {
    const situation = Object.values(window.CodeTitle['situation'][value]).filter(situation => situation.Title == data)
    if (isEmptyArr(situation)) { return data;  }

    return _.first(situation)['Code'];
}

function format_func_situation(value, data) {
    if (window.CodeTitle['situation'] && window.CodeTitle['situation'][value][data]) {
        return window.CodeTitle['situation'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_bill_type_update(value, data) {
    return { Field: 'BillType', Value: format_func_deal_type_rev(value, data),  };
}

function format_func_bill_type_rev(value, data) {
    const bill_type = Object.values(window.CodeTitle['bill-type'][value]).filter(bill_type => bill_type.Title == data)
    if (isEmptyArr(bill_type)) { return data;  }

    return _.first(bill_type)['Code'];
}

function format_func_bill_type(value, data) {
    if (window.CodeTitle['bill-type'] && window.CodeTitle['bill-type'][value][data]) {
        return window.CodeTitle['bill-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_setup_code_update(value, data) {
    return { Field: 'SetupCode', Value: format_func_setup_code_rev(value, data),  };
}

function format_func_setup_code_rev(value, data) {
    const setup_code = Object.values(window.CodeTitle['setup-code'][value]).filter(setup_code => setup_code.Title == data)
    if (isEmptyArr(setup_code)) { return data;  }

    return _.first(setup_code)['Code'];
}

function format_func_setup_code(value, data) {
    if (window.CodeTitle['setup-code'] && window.CodeTitle['setup-code'][value][data]) {
        return window.CodeTitle['setup-code'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_expose_type_update(value, data) {
    return { Field: 'ExposeType', Value: format_func_expose_type_rev(value, data),  };
}

function format_func_expose_type_rev(value, data) {
    const expose_type = Object.values(window.CodeTitle['expose-type'][value]).filter(expose_type => expose_type.Title == data)
    if (isEmptyArr(expose_type)) { return data;  }

    return _.first(expose_type)['Code'];
}

function format_func_expose_type(value, data) {
    if (window.CodeTitle['expose-type'] && window.CodeTitle['expose-type'][value][data]) {
        return window.CodeTitle['expose-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_ship_type_update(value, data) {
    return { Field: 'ShipType', Value: format_func_ship_type_rev(value, data),  };
}

function format_func_ship_type_rev(value, data) {
    const ship_type = Object.values(window.CodeTitle['ship-type'][value]).filter(ship_type => ship_type.Title == data)
    if (isEmptyArr(ship_type)) { return data;  }

    return _.first(ship_type)['Code'];
}

function format_func_ship_type(value, data) {
    if (window.CodeTitle['ship-type'] && window.CodeTitle['ship-type'][value][data]) {
        return window.CodeTitle['ship-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_delay_type_update(value, data) {
    return { Field: 'DelayType', Value: format_func_delay_type_rev(value, data),  };
}

function format_func_delay_type_rev(value, data) {
    const delay_type = Object.values(window.CodeTitle['delay-type'][value]).filter(delay_type => delay_type.Title == data)
    if (isEmptyArr(delay_type)) { return data;  }

    return _.first(delay_type)['Code'];
}

function format_func_delay_type(value, data) {
    if (window.CodeTitle['delay-type'] && window.CodeTitle['delay-type'][value][data]) {
        return window.CodeTitle['delay-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_cargo_type_update(value, data) {
    return { Field: 'CargoType', Value: format_func_cargo_type_rev(value, data),  };
}

function format_func_cargo_type_rev(value, data) {
    const cargo_type = Object.values(window.CodeTitle['cargo-type'][value]).filter(cargo_type => cargo_type.Title == data)
    if (isEmptyArr(cargo_type)) { return data;  }

    return _.first(cargo_type)['Code'];
}

function format_func_cargo_type(value, data) {
    if (window.CodeTitle['cargo-type'] && window.CodeTitle['cargo-type'][value][data]) {
        return window.CodeTitle['cargo-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_condition_type_update(value, data) {
    return { Field: 'ConditionType', Value: format_func_condition_type_rev(value, data),  };
}

function format_func_condition_type_rev(value, data) {
    const condition_type = Object.values(window.CodeTitle['condition-type'][value]).filter(condition_type => condition_type.Title == data)
    if (isEmptyArr(condition_type)) { return data;  }

    return _.first(condition_type)['Code'];
}

function format_func_condition_type(value, data) {
    if (window.CodeTitle['condition-type'] && window.CodeTitle['condition-type'][value][data]) {
        return window.CodeTitle['condition-type'][value][data]['Title'];
    }

    return 'Invalid';
}

function format_func_body_situation_update(value, data) {
    return { Field: 'BodySituation', Value: format_func_body_situation_rev(value, data),  };
}

function format_func_body_situation_rev(value, data) {
    const body_situation = Object.values(window.CodeTitle['body-situation'][value]).filter(body_situation => body_situation.Title == data)
    if (isEmptyArr(body_situation)) { return data;  }

    return _.first(body_situation)['Code'];
}

function format_func_body_situation(value, data) {
    if (window.CodeTitle['body-situation'] && window.CodeTitle['body-situation'][value][data]) {
        return window.CodeTitle['body-situation'][value][data]['Title'];
    }

    return 'Invalid';
}

function formatPhoneNumber(phoneNumber) {
    // Remove any non-numeric characters
    let cleaned = phoneNumber.replace(/\D/g, '');

    // Check if the number starts with 010 and is 11 digits long
    if (cleaned.length === 11 && cleaned.startsWith('010')) {
        return cleaned.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
    } else {
        // Return the input if it doesn't match the expected format
        return 'Invalid phone number format';
    }
}

function check_dom_input_number(dom_array) {
    let arr = dom_array.filter(el => isNaN($(el).val()))

    arr.forEach(el => $(el).val('') );

    if (! isEmptyArr(arr)) {
        iziToast.error({
            title: 'Error',
            message: $('#please-enter-a-number').text(),
        });
        return true;
    }

    return false;
}


function show_iziToast_msg(data, callback = undefined) {
    if (isEmpty(data['apiStatus'])) {
        iziToast.success({
            title: 'Success',
            message: $('#action-completed').text(),
        });
        if (callback) {
            callback()
        }
    } else {
        iziToast.error({
            title: 'Error',
            message: data.body ?? $('#api-request-failed-please-check').text(),
        });
    }
}


// function show_iziToast_msg(page, callback = undefined) {
//     if (page) {
//         iziToast.success({
//             title: 'Success',
//             message: $('#action-completed').text(),
//         });
//         if (callback) {
//             callback()
//         }
//     } else {
//         console.log(page)
//         iziToast.error({
//             title: 'Error',
//             message: page.data.body ?? $('#api-request-failed-please-check').text(),
//         });
//     }
// }

const generate_random_string = (num) => {
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let result = '';
    const charactersLength = characters.length;
    for (let i = 0; i < num; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}

function find_menu_info(data, find_code) {
    return data.filter(menu => menu['MenuCode'] === find_code)[0]
}

async function show_recrystallize_server(print_vars, type, vars) {
    let simple_filter = '', list_type1_vars = ''

    switch (type) {
        case 'formB':
            simple_filter = vars
            break
        case 'type1':
            list_type1_vars = vars
            break
    }

    if (isEmpty(window.env['REPORT_SERVER_URL'])) {
        return iziToast.error({ title: 'Error', message: 'REPORT_SERVER_URL 의 지정 내용이 없어 PDF를 생성할 수 없습니다.' })
    }

    const response = await get_api_data('list-type1-page', {
        QueryVars: {
            QueryName: print_vars['QueryName'],
            SimpleFilter: simple_filter
        },
        ListType1Vars: {
            ...list_type1_vars,
            IsntPageReturn: true,
            IsCrystalReport: true,
            IsDownloadList: true,
            IsAddTotalLine: false,
        }
    })

    // console.log(response)
    if (response.data['apiStatus']) {
        return iziToast.error({ title: 'Error', message: response.data['body'] ?? $('#api-request-failed-please-check').text() })
    }

    const reportName = print_vars['ReportPath']

    let url = window.env['REPORT_SERVER_URL'] + '?reportName=' + reportName + '&listToken='
        + response.data['ListType1Vars']['ListToken'] + '&ofcCode=' + window.User['OfcCode']

    if (print_vars['ExportFmt']) {
        url = url + '&exportfmt=' + print_vars['ExportFmt']
    }

    switch (print_vars['ExportFmt']) {
        case '':
        case 'PDF':
            window.open(url)
            break
        default:
            location.href = url
            break
    }

    // window.open(url)
}

async function show_popup(component, width, variable = '', namespace = 'window') {
    const popupOption = eval(namespace).popupOptions.filter(option => option.Component.includes(component))
    if (isEmpty(popupOption)) { return }

    const modal_class_name = popupOption[0]['ModalClassName'];
    $(`#modal-select-popup.${modal_class_name} .modal-dialog`).css('max-width', `${width}px`)
    eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback(variable)
    $(`#modal-select-popup.${modal_class_name}`).modal('show')
}

function groupBy (data, key) {
    return data.reduce(function (carry, el) {
        var group = el[key];

        if (carry[group] === undefined) {
            carry[group] = []
        }

        carry[group].push(el)
        return carry
    }, {})
}

function isEmptyObject(obj){
    if (obj.constructor === Object && Object.keys(obj).length === 0) return true;
    return false;
}

function check_login() {
    if (isEmpty(window.Member)) {
        // location.href = '/member-login-broker'

        return false
    }

    return true
}


function chunk(data = [], size = 1) {
    const arr = [];

    for (let i = 0; i < data.length; i += size) {
        arr.push(data.slice(i, i + size));
    }

    return arr;
}

function addIdParameter(url, idValue) {
    const urlObj = new URL(url, window.location.origin); // Assuming a relative URL, we need a base URL for URL parsing
    const params = urlObj.searchParams;

    if (!params.has('id')) {
        params.append('id', idValue);
    }

    return urlObj.toString();
}
