$(document).on('dblclick', '#modal-bodycopy input[type="text"]:enabled.filter', function (event) {
    $(this).val('')
    let dom_val = '#modal-' + $(event.target).data('target');
    $(`${dom_val}.show`).find('.modal-search').trigger('click');
})

function get_slip_no(slip_no) {
    $('#modal-slip.show').modal('hide');
    $('#modal-eyetest.show').modal('hide');

    mainModalGetsFocus(`#modal-bodycopy.show`, bodyCopy[$('#modal-bodycopy.show').data('class')]);
    $('#modal-bodycopy.show').find('.slip_no-txt').val(slip_no);
    $('#modal-bodycopy.show').find('.slip_no-txt').focus();
    $('#modal-bodycopy.show').find('.slip_no-txt').trigger(jQuery.Event( "keydown", { keyCode: 13 } ));
}

async function get_item_code(item_code) {
    $('#modal-item.show').modal('hide');

    mainModalGetsFocus(`#modal-bodycopy.show`, bodyCopy[$('#modal-bodycopy.show').data('class')]);
    $('#modal-bodycopy.show').find('.item_code-txt').val(item_code);
    $('#modal-bodycopy.show').find('.item_code-txt').focus();
    $('#modal-bodycopy.show').find('.item_code-txt').trigger(jQuery.Event( "keydown", { keyCode: 13 } ));
}

async function get_company_name(company_name) {
    $('#modal-company.show').modal('hide');

    mainModalGetsFocus(`#modal-bodycopy.show`, bodyCopy[$('#modal-bodycopy.show').data('class')]);
    $('#modal-bodycopy.show').find('.company_name-txt').val(company_name);
    $('#modal-bodycopy.show').find('.company_name-txt').focus();
    $('#modal-bodycopy.show').find('.company_name-txt').trigger(jQuery.Event( "keydown", { keyCode: 13 } ));
}

function set_selected_items_and_qty($this) {
    let selected_items = parseInt(minusComma($('#modal-bodycopy.show').find('.selected-items').val()));
    let selected_qty = parseFloat(minusComma($('#modal-bodycopy.show').find('.selected-qty').val()));

    let bal_qty = $($this).closest('tr').find('.BalQty');
    let order_qty = $($this).closest('tr').find('.OrderQty');
    let bal_qty_val = parseFloat(minusComma($(bal_qty).val()));

    if ($($this).is(':checked')) {
        $(bal_qty).removeClass('border-0 bg-white');
        $(bal_qty).prop('disabled', false)
        $('#modal-bodycopy.show').find('.selected-items').val(format_conver_for(selected_items + 1, "decimal('purch_prc')" ));
        $('#modal-bodycopy.show').find('.selected-qty').val(format_conver_for(selected_qty + bal_qty_val, "decimal('purch_qty')" ));
    } else {
        $(bal_qty).addClass('border-0 bg-white');
        $(bal_qty).prop('disabled', true)
        $(bal_qty).val($(order_qty).text())
        $('#modal-bodycopy.show').find('.selected-items').val(format_conver_for(selected_items - 1, "decimal('purch_prc')" ));
        $('#modal-bodycopy.show').find('.selected-qty').val(format_conver_for(selected_qty - bal_qty_val, "decimal('purch_qty')" ));
    }
}

function bal_qty_change() {
    let sum = 0;
    $(`input[name='${moealSetFile['QueryVars']['QueryName']}-check']:checked`).each(function() {
        let bal_qty = $(this).closest('tr').find('.BalQty');
        let bal_qty_val = parseFloat(minusComma($(bal_qty).val()));
        sum += bal_qty_val;
    })
    $('#modal-bodycopy.show').find('.selected-qty').val(format_conver_for(sum, "decimal('purch_qty')" ));
}

function checked_data($this) {
    $($this).closest('tr').find('td:eq(0) input').trigger('click');
}

function get_source_and_target_table_name() {
    return moealSetFile['QueryVars']['QueryName'].split('-')
}

async function get_target_last_slip_no_for(target_table) {
    const response = await Btype.get_last_slip_no(target_table);
    return moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo
}

function is_auto_create_slip_checked() {
    return $('#modal-bodycopy.show').find('.auto-create-slip-checked').prop('checked')
}

async function body_copy($this) {
    mainModalGetsFocus(`#modal-bodycopy.show`, bodyCopy[$('#modal-bodycopy.show').data('class')]);

    let slip_no = $($this).data('slip_no');

    // 매출전표 자동생성 체크일 때
    if (is_auto_create_slip_checked()) {
        const [source_table, target_table] = get_source_and_target_table_name()
        const target_slip = await get_target_last_slip_no_for(target_table);
        const response = await get_api_data('copy-to-another', {
            SourceTable: source_table,
            TargetTable: target_table,
            SourceSlip: slip_no,
            TargetSlip: target_slip,
            IsCopyBody: false
        })

        if (response.data['apiStatus']) {
            iziToast.error({ title: 'Error', message: response.data['body'] ?? $('#api-request-failed-please-check').text() });
            return
        }

        // slip_no를 방금 생성한 target_slip로 변경
        slip_no = target_slip
    }

    let data = [];
    $(`input[name='${moealSetFile['QueryVars']['QueryName']}-check']:checked`).each(function() {
        let bal_qty = $(this).closest('tr').find('.BalQty');
        data.push({
            BdId: parseInt($(this).data('id')),
            Qty: minusComma($(bal_qty).val())
        });
    })

    if (isEmptyArr(data)) {
        return iziToast.error({ title: 'Error', message: '복사할 항목을 체크하세요' });
    }

    $.when(get_api_data(moealSetFile.General.ActApi, {
        //추가
        TargetHdTableFullName : moealSetFile.TargetHdTableFullName,
        QueryVars: {
            QueryName: moealSetFile.QueryVars.QueryName
        },
        LastSeqNoVars: {
            TableName: moealSetFile.LastSeqNoVars.TableName,
            SlipNo: slip_no
        },
        Page: data
    })).done(function (response) {
        let d = response.data
        console.log(d)
        if (d.Page) {
            iziToast.success({ title: 'Success', message: $('#action-completed').text() });
            if (is_auto_create_slip_checked()) {
                $('#modal-bodycopy.show').trigger('success.body-copy', $($this).data('slip_no'));
            } else {
                Btype.fetch_slip_form_book(slip_no);
            }
            $('#modal-bodycopy.show').modal('hide');
        } else {
            iziToast.error({ title: 'Error', message: $('#api-request-failed-please-check').text() });
        }
    });
}

const bodycopy = (function ($, window, document, undefined) {
    bodycopy_open = (limit, offset, page = 1) => {
        if ($('#modal-bodycopy.show').attr('class')) {
            mainModalGetsFocus(`#modal-bodycopy.show`, bodyCopy[$('#modal-bodycopy.show').data('class')]);
        }

        let html = ``;
        let menu_code = (typeof menuCode === 'undefined') ? false : menuCode;
        $.when(get_api_data(moealSetFile['General']['PageApi'], {
            //추가
            TargetHdTableFullName : moealSetFile['TargetHdTableFullName'],
            QueryVars: {
                QueryName: moealSetFile['QueryVars']['QueryName'],
            },
            BodyCopyPageVars: {
                SlipNo: $(id).find('.slip_no-txt').val(),
                ItemCode: $(id).find('.item_code-txt').val(),
                CompanyName: $(id).find('.company_name-txt').val(),
                ShowOnlyClosed: $(id).find(`input[name=ShowOnlyClosedChecked]:checked`).val() ? '1' : '0',
                Balance: $(id).find('.balance-select').val(),
                DaysFromToday: $(id).find('.day-from-today-select').val(),
                OrderBy: $(id).find('.modal-order-by-select').val(),
                GroupBy: moealSetFile['BodyCopyPageVars']['GroupBy'],
                SlipNoField: moealSetFile['BodyCopyPageVars']['SlipNoField'],
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        }, null, menu_code)).done(function(response) {
            let d = response.data
            console.log(d)

            if( d.Page ) {
                make_pagination('bodycopy', d.PageVars.QueryCnt, page, $(id).data('class'));
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for (let i in d.Page) {
                    html +=
                    `<tr>
                        <td class="text-${moealSetFile.ListVars['Align'].$Check} px-import-0">
                            <input name="${moealSetFile['QueryVars']['QueryName']}-check" type="checkbox" value="1" tabindex="-1"
                            data-id="${d.Page[i].Id}"
                            class="text-${moealSetFile.ListVars['Align'].$Check}"
                            onchange="set_selected_items_and_qty(this);">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SlipNo}" ${moealSetFile.ListVars['Hidden'].SlipNo}><a onclick="checked_data(this)" href="#.">${d.Page[i].SlipNo}</a></td>
                        <td class="text-${moealSetFile.ListVars['Align'].CompanyName}" ${moealSetFile.ListVars['Hidden'].CompanyName}>${d.Page[i].CompanyName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemCode}" ${moealSetFile.ListVars['Hidden'].ItemCode}>${d.Page[i].ItemCode}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].ItemName}" ${moealSetFile.ListVars['Hidden'].ItemName}>${d.Page[i].ItemName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SubName}" ${moealSetFile.ListVars['Hidden'].SubName}>${d.Page[i].SubName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].OrderQty} OrderQty" ${moealSetFile.ListVars['Hidden'].OrderQty}>${format_conver_for(d.Page[i].OrderQty,  "decimal('purch_qty')")}</td>
                        <td class="p-1" ${moealSetFile.ListVars['Hidden'].BalQty}>
                            <input type="text" class="BalQty decimal text-${moealSetFile.ListVars['Align'].BalQty} border-0 bg-white" value="${format_conver_for(d.Page[i].BalQty,  "decimal('purch_qty')")}" disabled
                            onchange="bal_qty_change();" data-point="decimal('purch_qty')">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].Ref}" ${moealSetFile.ListVars['Hidden'].Ref}>${d.Page[i].Ref}</td>
                    </tr>`;
                }
            } else {
                html = `<tr><td class="text-center" colspan="${moealSetFile.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                make_pagination('bodycopy', 1, 1, $(id).data('class') );
            }
            $(id).find('.selected-items').val(0);
            $(id).find('.selected-qty').val(0);
            table_head_check_box_reset(id)

            $(id).find(`#table-body`).html(html);
        })

        $(id).modal('show');
    };

})(jQuery, window, document);
