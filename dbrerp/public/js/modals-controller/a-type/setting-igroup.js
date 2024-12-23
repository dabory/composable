const settiong_igroup = (function ($, window, document, undefined) {
    setting_igroup_open = (limit, offset, page = 1) => {
        let simpleFilter = $(id).find('#simple-filter-select').val()
        const simpleFilter_txt = $(id).find('#simple-filter-txt').val()
        if (simpleFilter_txt) {
            if (isEmpty(simpleFilter)) {
                simpleFilter = simpleFilter_txt
            } else {
                simpleFilter = simpleFilter + ' and ' + simpleFilter_txt
            }
        }
        let html = ``;
        $.when( get_api_data(moealSetFile['General']['PageApi'], {
            QueryVars: {
                QueryName: moealSetFile['QueryVars']['QueryName'],
                FilterName: $(id).find('#filter-name-select').val(),
                FilterValue: $(id).find('#filter-value-txt').val(),
                SimpleFilter: simpleFilter,
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        }) ).done(function(response) {
            let d = response.data;
            console.log(d)
            let onclick;
            if( d.Page ){
                make_pagination('settiong-igroup', d.PageVars.QueryCnt, page, $(id).data('class') );
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for(let i in d.Page){
                    if (! isEmpty($(id).data('filter')) && $(id).data('filter').includes('code') ) {
                        onclick = `${$this.data('clicked')}('${d.Page[i].Code}')`;
                    } else if (! isEmpty($(id).data('filter'))) {
                        onclick = `${$this.data('clicked')}('${d.Page[i][capitalize(camelCase($(id).data('filter')))]}')`;
                    } else {
                        onclick = `${$this.data('clicked')}(${d.Page[i].Id})`;
                    }

                    const checkbox = `<input type="checkbox" onClick="return false;" ${d.Page[i].IsCheck == 1 ? 'checked' : ''}>`
                    html += `<tr>
                    <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                    <td class="text-${moealSetFile.ListVars['Align'].Code}" ${moealSetFile.ListVars['Hidden'].Code}><a onclick="${onclick}" href="#.">${format_conver_for(d.Page[i].Code, moealSetFile.ListVars['Format'].Code)}</a></td>
                    <td class="text-${moealSetFile.ListVars['Align'].Name}" ${moealSetFile.ListVars['Hidden'].Name}>${format_conver_for(d.Page[i].Name, moealSetFile.ListVars['Format'].Name)}</td>
                    <td class="text-${moealSetFile.ListVars['Align'].ThirdField}" ${moealSetFile.ListVars['Hidden'].ThirdField}>${format_conver_for(d.Page[i].ThirdField, moealSetFile.ListVars['Format'].ThirdField)}</td>
                    <td class="text-${moealSetFile.ListVars['Align'].IsCheck}" ${moealSetFile.ListVars['Hidden'].IsCheck}>${checkbox}</td>
                    </tr>`;
                }
            }else{
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
                make_pagination('settiong-igroup', 1, 1, $(id).data('class') );
            }
            $(id).find('#table-body').html(html);
        });
        $(id).modal('show');
    }


})(jQuery, window, document);
