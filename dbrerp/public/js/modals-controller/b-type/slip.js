const slip = (function ($, window, document, undefined) {
    $(document).on('click', '.slip-date-range, .slip-date-navi', function () {
        calc_slip_date_rang('#' + $(this).closest('div').attr('id'), $(this).val(), 0)
    });

    $(document).ready(function() {
        $('#query-speed-0').prop('checked', true);
        first_slip_date_rang('#slip-date-navi-div')
    });

    first_slip_date_rang = (div_dom, first_date_search = true) => {
        let date_input = $(div_dom).find('input:checked')
        $(div_dom).data('current_date', moment(new Date()).format('YYYY-MM-DD'))

        if (first_date_search) {
            // date_input = $(div_dom).find('input').first()
            date_input = $(div_dom).find("input[value='week']").first()
            date_input.prop('checked', true)
        }

        calc_slip_date_rang(div_dom, date_input.val(), 0, true)
    }

    calc_slip_date_rang = (div_dom, date_val, mode, first = false) => {
        const modal = $(div_dom).closest('#modal-slip')
        if (mode === 0) {
            if (! first) {
                $(div_dom).data('current_date', $(modal).find('.start-date').val())
            }
        }

        let firDay, lasDay, currDay;
        [firDay, lasDay, currDay] = date_range_vending_machine(date_val, $(div_dom).data('current_date'), mode);

        $(modal).find('.start-date').val(date_to_sting(firDay))
        $(modal).find('.end-date').val(date_to_sting(lasDay))
        $(div_dom).data('current_date', date_to_sting(currDay))

        change_slip_query_speed()
    }

    change_slip_query_speed = () => {
        $('#modal-slip.show').find('.modal-search').trigger('click')
    }

    click_slip_equal_btn = () => {
        $('#modal-slip.show').find('.end-date').val($('#modal-slip.show').find('.start-date').val())
    }

    chagne_slip_modal_filter_name_select = ($this) => {
        $('#modal-slip.show').find('#filter-value-txt').prop('hidden', isEmpty($($this).val()))
    }

    override_enter_pressed_slip_modal_auto_search = (event) => {
        window.enter_pressed_auto_search(event, function () {
            $('#modal-slip.show').find('#filter-value-txt').data('value', $(event.target).val())
            // $('#modal-item.show').find('.modal-search').trigger('click')
        })
    }


    slip_open = (limit, offset, page = 1) => {
        let html = ''
        let menu_code = (typeof menuCode === 'undefined') ? false : menuCode
        let modal_class_name = $(id).data('class') || ''
        let start_date = '19900101', end_date = '30001231'

        if (isEmpty(moealSetFile['FormVars']['Hidden']['DateRange']) || isEmpty(moealSetFile['FormVars']['Hidden']['DateNavi'])) {
            start_date = date_to_sting(new Date($(id).find('.start-date').val()), 2)
            end_date = date_to_sting(new Date($(id).find('.end-date').val()), 2)
        }

        $(id).find(`#table-body`).html(`<tr><td className="text-center" colSpan="${moealSetFile.ListVars['Count']}">검색 중...</td></tr>`)

        $(id).find('.slip-save-spinner-btn').show()
        $(id).find('.slip-search-btn').hide()

        $.when(get_api_data(moealSetFile['General']['PageApi'], {
            QueryVars: {
                QueryName: moealSetFile['QueryVars']['QueryName'],
                FilterName: $(id).find('#filter-name-select').val(),
                FilterValue: $(id).find('#filter-value-txt').val(),
                SimpleFilter: $(id).find('#simple-filter-select').val(),
            },
            SlipSearchVars: {
                StartDate: start_date,
                EndDate: end_date,
                QuerySpeed: $(id).find(`input:radio[name=${modal_class_name}query-speed]:checked`).val(),
                SlipNo: $(id).find('.slip-no').val(),
                CompanyName: $(id).find('.company-name').val(),
                ItemCode: $(id).find('.item-code').val(),
                OrderBy: $(id).find('.modal-order-by-select').val(),
            },
            SlipSearchFields: {
                SlipDateField: moealSetFile['SlipSearchFields']['SlipDateField'],
                SlipNoField: moealSetFile['SlipSearchFields']['SlipNoField']
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        }, null, menu_code)).done(function(response) {
            let d = response.data
            console.log(d)
            if( d.Page ) {
                make_pagination('slip', d.PageVars.QueryCnt, page, modal_class_name);
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for (let i in d.Page) {
                    const onclick = `${$this.data('clicked')}('${d.Page[i].SlipNo}')`;
                    html +=
                    `<tr>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SlipNo}" ${moealSetFile.ListVars['Hidden'].SlipNo}><a onclick="${onclick}" href="#.">${d.Page[i].SlipNo}</a></td>
                        <td class="text-${moealSetFile.ListVars['Align'].DealCode}" ${moealSetFile.ListVars['Hidden'].DealCode}>${format_conver_for(d.Page[i].DealCode, moealSetFile.ListVars['Format'].DealCode )}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Company}" ${moealSetFile.ListVars['Hidden'].Company}>${format_conver_for(d.Page[i].Company, moealSetFile.ListVars['Format'].Company)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SetGroup}" ${moealSetFile.ListVars['Hidden'].SetGroup}>${format_conver_for(d.Page[i].SetGroup, moealSetFile.ListVars['Format'].SetGroup)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Item}" ${moealSetFile.ListVars['Hidden'].Item}>${format_conver_for(d.Page[i].Item, moealSetFile.ListVars['Format'].Item)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Amt}" ${moealSetFile.ListVars['Hidden'].Amt}>${format_conver_for(d.Page[i].Amt, moealSetFile.ListVars['Format'].Amt )}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Status}" ${moealSetFile.ListVars['Hidden'].Status}>${format_conver_for(d.Page[i].Status, moealSetFile.ListVars['Format'].Status)}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Ref}" ${moealSetFile.ListVars['Hidden'].Ref}>${format_conver_for(d.Page[i].Ref, moealSetFile.ListVars['Format'].Ref)}</td>
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
                make_pagination('slip', 1, 1, modal_class_name );
            }
            $(id).find(`#table-body`).html(html);

            $(id).find('.slip-save-spinner-btn').hide()
            $(id).find('.slip-search-btn').show()
        })
        $(id).modal('show');
    };

})(jQuery, window, document);
