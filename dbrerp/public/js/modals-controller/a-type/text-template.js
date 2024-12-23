const text_template = (function ($, window, document, undefined) {
    text_template_open = (limit, offset, page = 1) => {
        let html = ``, data = '';

        $.when(get_api_data(moealSetFile.General.PageApi, data)).done(function(response) {
            let = d = response.data
            let onclick;
            // console.log(response.data)
            if ( d.Page ) {
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
                        <td class="text-${moealSetFile.ListVars['Align'].$Radio} px-import-0">
                            <input name="bd-item-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${moealSetFile.ListVars['Align'].$Radio}"
                            onclick="get_item_info(${d.Page[i].Id})">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemCode}" ${moealSetFile.ListVars['Hidden'].ItemCode}><a onclick="${onclick}" href="#.">${d.Page[i].ItemCode}</a></td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemName}" ${moealSetFile.ListVars['Hidden'].ItemName}>${d.Page[i].ItemName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SubName}" ${moealSetFile.ListVars['Hidden'].SubName}>${d.Page[i].SubName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].IgroupName}" ${moealSetFile.ListVars['Hidden'].IgroupName}>${d.Page[i].IgroupName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SalesPrc}" ${moealSetFile.ListVars['Hidden'].SalesPrc}>${format_conver_for(d.Page[i].SalesPrc, moealSetFile.FormVars['Format'].SalesPrc)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].PurchPrc}" ${moealSetFile.ListVars['Hidden'].PurchPrc}>${format_conver_for(d.Page[i].PurchPrc, moealSetFile.FormVars['Format'].PurchPrc)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].MoreInfo}" ${moealSetFile.ListVars['Hidden'].MoreInfo}>${d.Page[i].MoreInfo}</td>
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
