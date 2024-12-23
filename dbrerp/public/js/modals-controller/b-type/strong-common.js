(function( Stype, $, undefined ) {
    //Public Method
    Stype.get_last_slip_no = async function (table_name) {
        let response = await get_api_data('last-slip-no-get', {
            TableName: table_name,
            YYMMDD: moment(new Date()).format('YYMMDD'),
        })

        return response;
    };

    Stype.get_select_box_options_data = async function (url, query, Asc = 'sort_no') {
        let response = await get_api_data(url, {
            PageVars: {
                Query: query,
                Asc: Asc,
            }
        })

        return response.data.Page;
    };

    Stype.get_slip_form_init = async function (query_name = undefined) {
        if (isEmpty(query_name)) {
            query_name = formB['QueryVars']['QueryName']
        }
        console.log('query_name2 : ', query_name);
        const response = await Stype.call_strong_api_data('slip-form-init', query_name);
        return response.data;
    };


    Stype.call_act_api = function (data, callback, act_api = undefined, argObj = '#frm', namespace = 'window') {
        console.log('stype_call_act_api');
        let url = eval(namespace).formB.General.ActApi;

        if (! isEmpty(act_api)) { url = act_api; }
        $('.save-button').prop('disabled', true);
        $.when(get_api_data(url, {
            Page: [
                data
            ]
        })).done(function(response) {
            const d = response.data

            if (d.Page) {
                if (d.Page[0].Id !== 0) {
                    window.set_as_response_id(d.Page[0].Id, argObj)
                }
                callback()
                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
            } else {
                let message = response.data.body ?? $('#api-request-failed-please-check').text();
                iziToast.error({
                    title: 'Error',
                    message: message,
                });
            }
            $('.save-button').prop('disabled', false);
        });
    };

    Stype.get_company_id = async function (company_name, id, namespace = 'window') {
        let response = await get_api_data('company-pick', {
            Page : [
                {CompanyName: company_name }
            ]
        })
        let company = response.data.Page[0];
        let next_input = eval(namespace).set_company_data_to_textbox(company)

        $('#modal-company').modal('hide');
        next_input.focus();
    };

    Stype.get_item_id = async function (item_id, namespace = 'window') {
        let response = await get_api_data('item-pick', {
            Page : [
                {Id: item_id }
            ]
        })

        let item = response.data.Page[0];
        let next_input = eval(namespace).set_item_data_to_textbox(item)

        $('#modal-item').modal('hide');
        next_input.focus();
    };

    Stype.call_bd_act_api = function (data, callback, namespace = 'window') {
        let url = eval(namespace).formB['General']['ActApi'].replace('act', 'bd-act');
        if (eval(namespace).formB['General']['ActApi'].includes('bact')) {
            url = eval(namespace).formB['General']['ActApi'].replace('bact', 'bd-act');
        }

        $.when(get_api_data(url, {
            Page: data
        })).done(function(response) {
            console.log(response)
            let d = response.data
            if (d.Page) {
                callback(d.Page);
            } else {
                iziToast.error({
                    title: 'Error',
                    message: response.data.body ?? $('#api-request-failed-please-check').text(),
                });
            }
        });
    };

    Stype.btn_bd_act_multi_delete = function (table_id, namespace = 'window') {
        let data = [];
        let delete_ids = [];

        $(table_id).find(`input[name='bd-cud-check']`).each(function(index){
            if ($(this).is(':checked')) {
                if (eval(namespace).bd_page[index].Id == 0) return true;
                data.push({ Id: parseInt(`-${eval(namespace).bd_page[index].Id}`) });
                delete_ids.push(eval(namespace).bd_page[index].Id)
            }
        })

        if (data.length == 0) {
            iziToast.error({
                title: 'Error',
                message: $('#click-the-checkbox-es-of-line-for-action').text(),
            });
            return;
        }

        confirm_message_shw_and_delete(function() {
            Stype.call_bd_act_api(data, function () {
                // FIXME response 이부분 때문에 에러 떠서 주석처리 했어요
                // console.log('response : ', response);
                table_head_check_box_reset(table_id)
                // 기존배열에서 삭제 할 ID로 필터함.
                eval(namespace).bd_page = eval(namespace).bd_page
                    .filter((page) => !delete_ids.includes(page.Id) && !page.Id == 0);

                eval(namespace).create_bd_page();


                iziToast.success({
                    title: 'Success',
                    message: $('#action-completed').text(),
                });
            }, namespace);
        })
    };

    Stype.btn_bd_act_multi_update = function (table_id, namespace = 'window') {
        let data = [];

        $(table_id).find(`input[name='bd-cud-check']`).each(function(index){
            if ($(this).is(':checked')) {
                if (eval(namespace).bd_page[index].Id == 0) return true;
                data.push(eval(namespace).get_bd_parameter(eval(namespace).bd_page[index]))
            }
        })

        if (data.length == 0) {
            iziToast.error({
                title: 'Error',
                message: $('#click-the-checkbox-es-of-line-for-action').text(),
            });
            return;
        }

        Stype.call_bd_act_api(data, function () {
            table_head_check_box_reset(table_id)
            eval(namespace).bd_page = eval(namespace).bd_page
                .filter((page) =>  !page.Id == 0);
            eval(namespace).create_bd_page();
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });
        }, namespace);
    };

    Stype.get_name_pick_api = async function (url, id) {
        const response = await get_api_data(url, { Page: [ { Id:  parseInt(id) } ] })
        return response.data.Page[0]
    };

    Stype.call_strong_api_data = async function(url, query_name, filter_value, menuCode){
        const strong_type = 'go';
        let response = await get_strong_api_data(strong_type, url,
        {
            QueryVars: {
                QueryName: query_name,
                FilterValue: filter_value
            }
        }, null, menuCode);

        return response
    }

    // strong+
    Stype.fetch_slip_form_book = async function (slip_no, namespace = 'window', callback = undefined) {
        console.log('Stype.fetch_slip_form_book');
        console.log('pickApi : ', formB['General']['PickApi']);
        // let response = await call_slip_form_book(eval(namespace).formB['General']['PickApi'],
        //     eval(namespace).formB['QueryVars']['QueryName'], slip_no, menuCode);
        let response = await Stype.call_strong_api_data(eval(namespace).formB['General']['PickApi'],
            eval(namespace).formB['QueryVars']['QueryName'], slip_no, menuCode);

        if (isEmpty(callback)) {
            eval(namespace).update_hd_ui(response);
        } else {
            if(callback.name == 'update_modal_hd'){
                // response = await call_slip_form_book(eval(namespace).formB['General']['PickApi'],
                // modalQuery, slip_no, menuCode);
                response = await Stype.call_strong_api_data(eval(namespace).formB['General']['PickApi'],
                    modalQuery, slip_no, menuCode);
            }

            callback(response);
        }
        // Stype.set_disable_modal_btn(namespace);
    };

    // head act btn
    Stype.btn_act_del = function (argObj = '#frm', callback = undefined, namespace = 'window') {
        if (befo_del_copy_id() || $(argObj).find(`input[name="Id"]`).val() == 0) {
            iziToast.error({
                title: 'Error',
                message: $('#can-not-delete-in-the-status').text(),
            });
            return;
        }

        confirm_message_shw_and_delete(function() {
            const id = $(argObj).find(`input[name="Id"]`).val();
            $(argObj).find(`input[name="Id"]`).val( `-${id}` );
            Stype.call_act_api(eval(namespace).get_parameter(), function() {
                if (! isEmpty(callback)) { callback(); }
                eval(namespace).btn_act_new();
            }, undefined, argObj, namespace);
        })
    };

    Stype.btn_act_save_and_new = function (argObj = '#frm', namespace = 'window') {
        if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return;
        }
        Stype.set_disable_modal_btn(namespace);
        Stype.call_act_api(eval(namespace).get_parameter(), function() {
            eval(namespace).btn_act_new();
        }, undefined, argObj, namespace);
    };

    Stype.btn_act_save = function (argObj = '#frm', callback = undefined, namespace = 'window') {
        // argObj 입력창 필수요소 체크
        if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return false;
        }
        isSaveHead = true;
        Stype.set_disable_modal_btn(namespace);
        Stype.call_act_api(eval(namespace).get_parameter(), function() {
            if (! isEmpty(callback)) { callback(); }
        }, undefined, argObj, namespace);
        return true;
    };
    // end head act btn

    Stype.btn_act_add_chain = async function (argObj = '#frm', namespace = 'window') {
        if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return false
        }

        const response = await get_api_data(eval(namespace).formB['General']['ActApi'], {
            Page: [ eval(namespace).get_parameter() ]
        });
        const page = response.data.Page
        if (page) {
            // console.log(page);
            set_as_response_id(page[0].Id, argObj)
            return true
        } else {
            let message = response.data.body ?? $('#api-request-failed-please-check').text();
            iziToast.error({ title: 'Error', message: message });
            return false
        }
    };


    Stype.btn_act_for = async function (format, argObj = '#frm', namespace = 'window') {
        const table = format_conver_for(null, format);
        const update_data = {
            Id: Number($(argObj).find('#Id').val()),
            UpdatedOn: get_now_time_stamp(),
        }
        update_data[table['Field']] = table['Value'];

        let response = await get_api_data(eval(namespace).formB['General']['ActApi'], {
            Page: [ update_data ]
        });

        show_iziToast_msg(response.data.Page, function () {
            $('#modal-select-popup.show').trigger('list.requery')
            $('#modal-select-popup.show').modal('hide');
        })
    };



    Stype.rpt_custom = function () {
        if (Stype.empty_id()) { return }

        const id = parseInt($('#frm').find('#Id').val())
        ModalRptCustom.show_popup_callback(formB['PrintVars']['CustomCode'], 'formB', `mx.id = ${id}`)
        $('#modal-rpt-custom').modal('show')
    }

    Stype.rpt_print = function() {
        if (Stype.empty_id()) { return }

        const id = parseInt($('#frm').find('#Id').val())
        show_recrystallize_server(formB['PrintVars'], 'formB', `mx.id = ${id}`)
    }

    Stype.set_disable_modal_btn = function(namespace) {
        $("[class*='-modal-btn']:not(.item-modal-btn)").each(function() {
            const input = $(this).siblings('input');
            if (!input) return;
            const inputVal = $(input).val();
            const addNewBtn = $('.disabled-if-saved');

            if (inputVal) {
                $(this).addClass('disabled');
                $(input).prop('readonly', true);

                if (input.attr('id').includes('-no-txt')) { // 연관 전표번호일 경우
                    addNewBtn.addClass('disabled');
                    eval(namespace).disabled_class(1);   // 연관복사 abled
                }
            } else {
                eval(namespace).disabled_class(0);   // 연관복사 disabled
            }
        });
    }
}( window.Stype = window.Stype || {}, jQuery ));
