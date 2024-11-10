function create_options(page) {
    if (page == null) return;

    return page.reduce(function (accumulator, item) {
        return accumulator + `<option value="${item.Value}">${item.Caption}</option>`;
    }, '');
}

function custom_create_options(value_name, caption_name, page) {
    if (page == null) return;

    return page.reduce(function (accumulator, item) {
        return accumulator + `<option value="${item[value_name]}">${item[caption_name]}</option>`;
    }, '');
}

makeSelectBtnOptions = (parentId, filterOptions, domId) => {
    if (isEmpty(filterOptions)) return false;

    let options = create_options(filterOptions)
    $(parentId).find(domId).html(options);
    $(`${domId} option:eq(0)`).prop("selected", true);
    return true;
}

// function change_self_to_format_decimal(dom_val, number, type = 1) {
//     if (type == 1) {
//         $(dom_val).val( format_decimal(minusComma($(dom_val).val()), number) )
//     } else if (type == 2) {
//         $(dom_val).text( format_decimal(minusComma($(dom_val).text()), number) )
//     }
// }

function make_dynamic_table_px(data) {
    let sum = 0;
    for (const key in data) {
        if (isEmpty(data[`${key}`])) continue;
        sum += parseInt(data[`${key}`])
    }

    return sum;
}

function make_dynamic_table_css(dom_val, count) {
    if (count < 100) {
        $(dom_val).css('min-width', '1024px')
    } else {
        $(dom_val).css('min-width', `${count * 10}px`)
    }
    $(dom_val).css('table-layout', 'fixed')
}

function set_min_width_table(dom_val, px) {
    $(dom_val).css('min-width', px + 'px')
    $(dom_val).css('table-layout', 'fixed')
}

async function  include_media_library(setup_code, brand_code, media_search_para = '/search/media-search/image', theme_dir = undefined) {
    // let response = await get_api_data('setup-pick', { Page: [ { SetupCode: setup_code } ] })
    // const setup = JSON.parse(response.data.Page[0]['SetupJson'])

    let response = await get_para_data('formB', '/popup/popup-form1/form-b/media', getParameterByName('bpa'));
    const media_parameter = response['data']['data']
    response = await get_para_data('modal', media_search_para, undefined, theme_dir)
    // response = await get_para_data('modal', media_search_para, undefined, '/erp/genesis_wallet')

    let media_modal = response['data']

    // media_modal['Setup'] = setup;
    media_modal['MediaParameter'] = media_parameter;

    get_blades_html('front.outline.static.media', media_modal, function (html) {
        if (! $('#element_in_which_to_insert').find('#modal-media').length) {
            $('#element_in_which_to_insert').append(html);
        }
    });

    return media_modal;
}
