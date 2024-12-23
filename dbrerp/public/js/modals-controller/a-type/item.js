async function get_item_info(item_id) {
    let response = await get_api_data('item-search-detail', {
        Id: item_id
    })

    let item = response.data;
    $('.count-unit').text(item.CountUnit)
    $('.curr-stock-qty').val(format_conver_for(item.CurrStockQty, moealSetFile.FormVars['Format'].CurrStockQty))
    $('.purch-prc').val(format_conver_for(item.PurchPrc, moealSetFile.FormVars['Format'].PurchPrc))
    $('.sales-prc').val(format_conver_for(item.SalesPrc, moealSetFile.FormVars['Format'].SalesPrc))
    $('.item-desc').val(item.ItemDesc)
}

function item_search_multi_select() {
    let id_list = []

    $('#modal-item table').find(`input[name='master/item-check']`).each(function () {
        if ($(this).is(':checked')) {
            id_list.push($(this).data('id'))
        }
    })

    $('#modal-item').trigger('item.multi.select', [id_list]);
}

function reset_item_detail_input_txt() {
    $('.count-unit').text('')
    $('.curr-stock-qty').val('')
    $('.purch-prc').val('')
    $('.sales-prc').val('')
    $('.item-desc').val('')
}

function chagne_item_modal_filter_name_select($this) {
    $('#modal-item.show').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
}

function override_enter_pressed_item_modal_auto_search(event) {
    window.enter_pressed_auto_search(event, function () {
        $('#modal-item.show').find('#filter-value-txt').data('value', $(event.target).val())
        // $('#modal-item.show').find('.modal-search').trigger('click')
    })
}

// $(document).on('hide.bs.modal','#modal-item', function () {
//     search_text_box_reset('#modal-item');

//     $('.modal-order-by-select').data('page', 1)
//     $('.modal-order-by-select').data('offset', 1)
// });

const item = (function ($, window, document, undefined) {
    item_open = (limit, offset, page = 1) => {
        reset_item_detail_input_txt()
        let html = ``, data = '';

        data = {
            QueryVars: {
                QueryName: moealSetFile.QueryVars.QueryName,
                FilterName: $(id).find('#filter-name-select').val(),
                FilterValue: '%' + $(id).find('#filter-value-txt').val() + '%',
                SimpleFilter: $(id).find('#simple-filter-select').val(),
            },
            ItemSearchVars: {
                ItemCode: '%' + $(id).find('.item-code').val() + '%',
                ItemName: '%' + $(id).find('.item-name').val() + '%',
                SubName: '%' + $(id).find('.sub-name').val() + '%',
                OrderBy: '%' + $(id).find('.modal-order-by-select').val() + '%',
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        }

        $.when(get_api_data(moealSetFile.General.PageApi, data)).done(function(response) {
            let d = response.data
            let onclick;
            // console.log(response.data)
            if( d.Page ) {
                make_pagination('item', d.PageVars.QueryCnt, page, $(id).data('class') );
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for(let i in d.Page){
                    if (! isEmpty($(id).data('filter'))) {
                        onclick = `${$this.data('clicked')}('${d.Page[i][capitalize(camelCase($(id).data('filter')))]}')`;
                    } else {
                        onclick = `${$this.data('clicked')}(${d.Page[i].Id})`;
                    }
                    html +=
                    `<tr>
                        <td class="text-${moealSetFile.ListVars['Align'].$Radio} px-import-0" ${moealSetFile.ListVars['Hidden'].$Radio}>
                            <input name="bd-item-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${moealSetFile.ListVars['Align'].$Radio}"
                            onclick="get_item_info(${d.Page[i].Id})">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].$Check} px-import-0" ${moealSetFile.ListVars['Hidden'].$Check}>
                            <input name="master/item-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${moealSetFile.ListVars['Align'].$Check}" data-id="${d.Page[i].Id}">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemCode}" ${moealSetFile.ListVars['Hidden'].ItemCode}><a onclick="${onclick}" href="#.">${d.Page[i].ItemCode}</a></td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemName}" ${moealSetFile.ListVars['Hidden'].ItemName}>${d.Page[i].ItemName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SubName}" ${moealSetFile.ListVars['Hidden'].SubName}>${d.Page[i].SubName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].IgroupName}" ${moealSetFile.ListVars['Hidden'].IgroupName}>${d.Page[i].IgroupName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SalesPrc}" ${moealSetFile.ListVars['Hidden'].SalesPrc}>${format_conver_for(d.Page[i].SalesPrc, moealSetFile.FormVars['Format'].SalesPrc)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].PurchPrc}" ${moealSetFile.ListVars['Hidden'].PurchPrc}>${format_conver_for(d.Page[i].PurchPrc, moealSetFile.FormVars['Format'].PurchPrc)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].MoreInfo}" ${moealSetFile.ListVars['Hidden'].MoreInfo}>${d.Page[i].MoreInfo || ''}</td>
                    </tr>`;
                }
            } else {
                if (! isEmpty(d.apiStatus)) {
                    switch (d.apiStatus) {
                        case 607:
                            html = `<tr><td class="text-center" colspan="${moealSetFile.ListVars['Count']}">Query Error</td></tr>`;
                            break;
                        default:
                            break;
                    }
                } else {
                    html = `<tr><td class="text-center" colspan="${moealSetFile.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                }

                make_pagination('item', 1, 1, $(id).data('class') );
            }
            $(id).find(`#table-body`).html(html);
        })
    };

})(jQuery, window, document);
