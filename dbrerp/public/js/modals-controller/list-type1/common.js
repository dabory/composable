(function( Type1, $, undefined ) {
    Type1.set_excel_column = function (parameter, target_id, table_id) {
        let list_vars = undefined;
        if ($(target_id).prop('checked')) {
            list_vars = Type1.set_excel_column_data(parameter)
        } else {
            list_vars = parameter['ListVars']
        }
        set_thead_with_dom_value(table_id, makeThead(list_vars, 'bd-cud'));
    }

    Type1.set_excel_column_data = function (parameter) {
        const shirf = {...parameter['ListVars']};
        shirf['Title'] = {...parameter['ListVars']['Title']};

        for (const key in shirf['Title']) {
            if (shirf['Title'][key] == '$Radio' || shirf['Title'][key] == '$Check') continue;
            shirf['Title'][key] = `${key}:${shirf['Title'][key]}`
        }

        return  shirf
    }

    Type1.convert_data_to_report_head = function (title_list) {
        let report_head = [];

        for (const key in title_list) {
            if (isEmpty(title_list[key]) || key === '$Radio' || key === '$Check' || key === 'No') continue;
            report_head.push(title_list[key])
        }

        return report_head;
    }

    Type1.convert_data_to_report_body = function (page, query_cnt, list_vars, is_raw_download = false) {
        let report_data = [];

        if (query_cnt == 0) {
            iziToast.error({
                title: 'Error',
                message: $('#api-request-failed-please-check').text(),
            });
            return;
        }
        page.forEach(data => {
            let temp = [];
            for (const key in list_vars['Title']) {
                if (isEmpty(list_vars['Title'][key]) || key == '$Radio' || key === '$Check' || key === 'No') continue;
                // if (key == 'No') { data[key] = query_cnt--; }
                // temp.push(data[key])
                if (is_raw_download) {
                    temp.push(data[key])
                } else {
                    temp.push(format_conver_for(data[key], list_vars['Format'][key]))
                }

            }
            report_data.push(temp)
        });

        return report_data;
    }

    Type1.download_report = function (dom_val, report) {
        let form = $('<form>', {'method': 'POST', 'action': '/download/report'}).hide();
        let csrfVar = $('meta[name="csrf-token"]').attr('content');
        form.append($('<input>', {'type': 'hidden', 'name': '_token', 'value': csrfVar}));
        form.append($('<input>', {'type': 'hidden', 'name': 'report', 'value': JSON.stringify(report)}));
        $(dom_val).append(form);
        form.submit();
        form.remove();
    }

}( window.Type1 = window.Type1 || {}, jQuery ));
