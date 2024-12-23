const company = (function ($, window, document, undefined) {

    company_model_show_cell_enter_key = async function (event,
                                                        company_class,
                                                        namespace = 'window',
                                                        callback = undefined,
                                                        modal_btn_name = 'company-modal-btn',
                                                        field_name = 'company_name',
                                                        input_class = '.company-name') {
        if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
            document.activeElement.blur();
            const query = `${field_name}='${$(event.target).val()}' and company_class='${company_class}'`;

            let response = await get_api_data('company-cgroup-page', {
                PageVars: {
                    Query: query,
                }
            })

            if (response.data.PageVars['QueryCnt'] != 1) {
                window.input_box_reset_for('#modal-company .modal-body')
                $('#modal-company').find(input_class).val($(event.target).val())
                $(`.${namespace}.${modal_btn_name}`).trigger('click');
            } else {
                let company = response.data.Page[0];

                if (isEmpty(callback)) {
                    let next_input = eval(namespace).set_company_data_to_textbox(company);
                    $(next_input).focus();
                } else {
                    callback(company)
                }
            }
        }
    }

    init_company_id = function (dom_val) {
        $(dom_val).val('')
        $(dom_val).data('id', 0)
    }

    unlink_company = function () {
        $('#modal-company').trigger('unlink.company')
        $('#modal-company.show').modal('hide')
    }

    get_supplier_id = async (supplier_id, dom_val = '#supplier-txt') => {
        let response = await get_api_data('company-pick', {
            Page : [
                {Id: Number(supplier_id) }
            ]
        })

        // console.log(response)
        if (response.data.Page) {
            const company = response.data.Page[0];
            const modal_btn = $(dom_val).siblings('button');
            $(dom_val).data('id', company.Id);
            $(dom_val).val(company.CompanyName);
            $(dom_val).data('contact', company.MainContact);
            $('#modal-company.show').modal('hide');
            // $(modal_btn).prop('disabled', $(dom_val).val().trim() !== "");

            return company
        }

    }

    company_open = (limit, offset, page = 1) => {
        let html = ``;

        $.when(get_api_data(moealSetFile.General.PageApi, {
            QueryVars: {
                QueryName: moealSetFile.QueryVars.QueryName,
                FilterName: moealSetFile.QueryVars.FilterName,
                FilterValue: moealSetFile.QueryVars.FilterValue
            },
            CompanySearchVars: {
                CompanyName: $(id).find('.company-name').val(),
                MainContact: $(id).find('.main-contact').val(),
                MobileNo: $(id).find('.mobile-no').val(),
                TelNo: $(id).find('.tel-no').val(),
                OrderBy: $(id).find('.modal-order-by-select').val(),
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        })).done(function(response) {
            let d = response.data;
            // console.log(d)
            let onclick;
            if( d.Page ) {
                make_pagination('company', d.PageVars.QueryCnt, page, $(id).data('class') );
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for(let i in d.Page) {
                    if (moealSetFile.QueryVars.QueryName == 'customer') {
                        onclick = `${$this.data('clicked')}('${d.Page[i].CompanyName}', '${d.Page[i].Id}')`;
                    } else if (! isEmpty($(id).data('filter'))) {
                        onclick = `${$this.data('clicked')}('${d.Page[i][capitalize(camelCase($(id).data('filter')))]}')`;
                    } else {
                        onclick = `${$this.data('clicked')}(${d.Page[i].Id})`;
                    }
                    html +=
                    `<tr>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].CompanyName}" ${moealSetFile.ListVars['Hidden'].CompanyName}><a onclick="${onclick}" href="#.">${d.Page[i].CompanyName}</a></td>
                    `;

                    for (const key in moealSetFile.ListVars['Title']) {
                        if (key === 'No' || key === 'CompanyName') { continue }

                        html += `
                            <td
                                class="text-${moealSetFile.ListVars['Align'][key]}" ${moealSetFile.ListVars['Hidden'][key]}>${d.Page[i][key]}
                            </td>`
                    }
                    html += '</tr>'
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
                make_pagination('company', 1, 1, $(id).data('class') );
            }
            $(id).find(`#table-body`).html(html);
        })
    };

})(jQuery, window, document);
