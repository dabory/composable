(function( Btype, $, undefined ) {
    //Public Method
    Btype.get_last_slip_no = async function (table_name) {
        let response = await get_api_data('last-slip-no-get', {
            TableName: table_name,
            YYMMDD: moment(new Date()).format('YYMMDD'),
        })

        return response;
    };

    Btype.set_slip_no_btn_disabled = function (dom_val = '#auto-slip-no-btn') {
        $(dom_val).attr('disabled', true);
        $(dom_val).removeClass('text-white')
        $(dom_val).addClass('bg-white text-black')
    };

    Btype.set_slip_no_btn_abled = function (dom_val = '#auto-slip-no-btn') {
        $(dom_val).addClass('text-white')
        $(dom_val).removeClass('bg-white text-black')
        $(dom_val).attr('disabled', false)
    };

    Btype.get_select_box_options_data = async function (url, query, Asc = 'sort_no') {
        let response = await get_api_data(url, {
            PageVars: {
                Query: query,
                Asc: Asc,
            }
        })

        return response.data.Page;
    };

    Btype.get_slip_form_init = async function (query_name = undefined) {
        if (isEmpty(query_name)) {
            query_name = formB['QueryVars']['QueryName']
        }
        const response = await get_api_data('slip-form-init', {
            QueryVars: {
                QueryName: query_name
            }
        })

        return response.data;
    };
    // 배열의 각 요소들을 순환하면서 option태그를 생성해줌
    Btype.create_deal_type_select_box_options = async function (page, dom_val = '#deal-type-select') {
        // let page = await get_select_box_options_data('deal-type-page', 'deal_category="purch"')
        let html =  page.reduce(function (accumulator, item) {
            return accumulator + `<option value="${item.Id}">${item.DealName}</option>`;
        }, '');
        $(dom_val).append(html);
    };

    Btype.create_vat_type_select_box_options = async function (page, dom_val = '#vat-type-select') {
        // let page = await get_select_box_options_data('vat-rate-page', '')
        // console.log('page : ', page)
        let html =  page.reduce(function (accumulator, item) {
            return accumulator + `
                <option value="${item.Id}" data-vatrate="${item.VatRate}" data-viewvatrate="${item.VatRate * 100}"
                data-included="${item.IsIncluded}">
                    ${item.VatName}
                </option>`;
        }, '');

        $(dom_val).append(html);
        $(dom_val).trigger('change');
    };

    Btype.calc_vat_included = function (sum_amt, vatrate) {
        const supply = sum_amt / (1 + vatrate)
        const vat = sum_amt - supply

        return [supply, vat]
    }

    Btype.set_is_closed_val = function ($this) {
        switch ($($this).val()) {
            case '확정':
                $($this).data('closed', "1");
                break;
            default:
                $($this).data('closed', "0");
                break;
        }
    };

    // Btype.date_range_vending_machine = function (date_range) {
    //     let firDay = '1990-01-01', lasDay = '3000-12-31';
    //     switch (date_range) {
    //         case 'month':
    //             firDay = new Date();
    //             firDay.setDate(1);
    //             lasDay = last_date(new Date());
    //             break;
    //         case 'quarterly':
    //             [firDay, lasDay] = date_range_calculator(3)
    //             break;
    //         case 'semiannual':
    //             [firDay, lasDay] = date_range_calculator(6)
    //             break;
    //         case 'year':
    //             [firDay, lasDay] = date_range_calculator(12)
    //             break;
    //         default:
    //             break;
    //     }

    //     return [firDay, lasDay];
    // };

    Btype.able_or_disable_txt_box = function (dom_val, type = 1) {
        switch (type) {
            case 1:
                $(dom_val).removeClass('border-0 bg-white')
                // $(dom_val).prop('disabled', false)
                $(dom_val).prop('readonly', false)
                break;
            case 2:
                $(dom_val).addClass('border-0 bg-white')
                // $(dom_val).prop('disabled', true)
                $(dom_val).prop('readonly', true)
                break;
            default:
                break;
        }
    };

    Btype.call_act_api = function (data, callback, act_api = undefined, argObj = '#frm', namespace = 'window') {
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

    // input 요소를 통해 상위 요소 제어
    Btype.bd_cursor_click = function ($this) {
        let table = $($this).closest('table');
        let th = $(table).find('thead th');
        let tr = $($this).closest('tr');

        // th 순회하며 #이 붙지 않은 요소들 활성화
        $(th).each(function (index) {
            if (! trim($(this).text()).includes('#')) {
                Btype.able_or_disable_txt_box($(tr).children(`td:eq(${index})`).find('input'));
                Btype.able_or_disable_txt_box($(tr).children(`td:eq(${index})`).find('select'));
            }
        })

        let cursor = $(tr).find('td:eq(0) input').attr('name')
        $(table).find(`input[name='${cursor}']`).each(function (i) {
            if (!$(this).is(':checked')) {
                let tr = $(this).closest('tr');
                // th 순회하며 #이 붙지 않은 요소들 비활성화
                $(th).each(function (index) {
                    if (index == 0 || index == 1) return;
                    if (! trim($(this).text()).includes('#')) {
                        Btype.able_or_disable_txt_box($(tr).children(`td:eq(${index})`).find('input'), 2);
                        Btype.able_or_disable_txt_box($(tr).children(`td:eq(${index})`).find('select'), 2);
                    }
                })
            }
        })

        let currentInput = $this;
        currentInput.focus();
        currentInput.select();
        // $($($this).closest('tr')).children(`td:eq(${Btype.get_first_required_th_index(table)})`).find('input').focus();
    };

    Btype.table_td_focus = function ($this) {
        var txt = $($this).children('input').val();
        // 포커스 = 전체 txt 전체선택

        // 현재 수정 중 td 라디오 버튼으로 표시
        current_radio = $($this).closest('tr').children('td:eq(0)').find('input');
        $(current_radio).prop('checked', true)
        Btype.bd_cursor_click(current_radio);
    };

    Btype.enterPressedinCell = async function (event, type = 1, namespace = 'window') {
        if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
            document.activeElement.blur();
            let query, input_class;
            switch (type) {
                case 1:
                    query = `item_code='${$(event.target).val()}'`
                    input_class = '.item-code';
                    break;
                case 2:
                    query = `item_name='${$(event.target).val()}'`
                    input_class = '.item-name';
                    break;
            }
            let response = await get_api_data('item-igroup-page', {
                PageVars: {
                    Query: query,
                }
            })

            if (response.data.PageVars['QueryCnt'] != 1) {
                window.input_box_reset_for('#modal-item .modal-body')
                $('#modal-item').find(input_class).val($(event.target).val())
                $(`.${namespace}.item-modal-btn`).trigger('click');
            } else {
                let item = response.data.Page[0];
                let next_input = eval(namespace).set_item_data_to_textbox(item);
                next_input.focus();
            }
        }
    };

    Btype.get_company_id = async function (company_name, id, namespace = 'window') {
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

    Btype.get_item_id = async function (item_id, namespace = 'window') {
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

    // 첫번째 필수항목(th) 찾기
    Btype.get_first_required_th_index = function (table, start_index) {
        let th = $(table).find('thead th')
        let first_index = start_index

        $(th).each(function (index) {
            if (trim($(this).text()).includes('*')) {
                first_index = index
                return false
            }
        })
        return first_index;
    };

    Btype.get_last_input_th_index = function (table) {
        let th = $(table).find('thead th')
        let last_index = -1;

        $(th).each(function (index) {
            if (! isEmpty(trim($(this).text())) && ! trim($(this).text()).includes('#') && ! trim($(this).text()).includes('(M)')) {
                last_index = index
            }
        })

        return last_index;
    };

    Btype.get_next_tab_index = function (index, table) {
        let required_index_list = [];
        let th = $(table).find('thead th')

        $(th).each(function (i) {
            if (! trim($(this).text()).includes('#')) {
                required_index_list.push(i)
            }
        })

        return required_index_list[required_index_list.indexOf(index) + 1];
    };

    Btype.handleEnterPressedinTabCell = function (event) {
        if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
            let table = $(event.target).closest('table');
            let cursor = $($(event.target).closest('tr')).find('td:eq(0) input').attr('name')
            let tr = $(table).find(`input[name='${cursor}']:checked`).closest('tr')
            let index = $(event.target).closest('td').prevAll().length;

            if (index == Btype.get_last_input_th_index(table)) {
                $(tr).children(`td:eq(${index})`).find('input').blur();
            }
            $(tr).children(`td:eq(${Btype.get_next_tab_index(index, table)})`).find('input').focus();
            $(tr).children(`td:eq(${Btype.get_next_tab_index(index, table)})`).find('input').select();
        }
    };

    Btype.amt_calc = function (bd, vat_rate) {
        let supply_amt = bd.pquote_qty * bd.pquote_prc;
        let vat_amt = supply_amt * vat_rate;
        let sum_amt = supply_amt + vat_amt;

        return [supply_amt, vat_amt, sum_amt]
    };

    Btype.amt_calc_txt_is_changed = function (tr, callback) {
        // tbody에서 현재tr index 가져옴,
        let bd = { pquote_prc: 0, pquote_qty: 0 };
        bd.pquote_qty = parseFloat(minusComma($(tr).children('td:eq(6)').find('input').val()));
        // if (isNaN(bd.pquote_qty) || bd.pquote_qty == '0') {
        if (isNaN(bd.pquote_qty) || bd.pquote_qty == '0') {
            $(tr).children('td:eq(6)').find('input').val(1)
            bd.pquote_qty = 1
        }

        bd.pquote_prc = parseFloat(minusComma($(tr).children('td:eq(7)').find('input').val()));

        callback(bd)
    };

    Btype.custom_supply_amt_or_vat_amt = function (callback) {
        let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
        let index = $(tr).prevAll().length

        let supply_amt = parseFloat(minusComma($(tr).children('td:eq(8)').find('input').val()));
        let vat_amt = parseFloat(minusComma($(tr).children('td:eq(9)').find('input').val()));
        let sum_amt = parseFloat(supply_amt) + parseFloat(vat_amt);

        if (isNaN(supply_amt) || isNaN(vat_amt)) return;

        $(tr).children('td:eq(8)').find('input').val(supply_amt.toFixed(window.User['PurchAmtPoint']))
        $(tr).children('td:eq(9)').find('input').val(vat_amt.toFixed(window.User['PurchAmtPoint']))
        $(tr).children('td:eq(10)').find('input').val(sum_amt.toFixed(window.User['PurchAmtPoint']))

        callback(supply_amt, vat_amt, sum_amt, index)
    };

    Btype.custom_sum_amt = function (callback) {
        let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
        let index = $(tr).prevAll().length
        let sum_amt = parseFloat(minusComma($(tr).children('td:eq(10)').find('input').val()));
        if (isNaN(sum_amt)) return;

        $(tr).children('td:eq(10)').find('input').val(sum_amt.toFixed(window.User['PurchAmtPoint']))
        callback(sum_amt, index)
    };

    Btype.last_item_added_check = function (table_id, namespace = 'window', start_index = -1) {
        let tr = $(`${table_id} tr:last`);
        let index = $(`${table_id} tr`).length;
        let table = $(table_id).closest('table');

        if (index > 0 && eval(namespace).bd_page[index - 1].Id == 0) {
            $(tr).children(`td:eq(0)`).find('input').prop('checked', true);
            $(tr).children(`td:eq(0)`).find('input').trigger('click');
            $(tr).children(`td:eq(${Btype.get_first_required_th_index(table, start_index)})`).find('input').focus();
            iziToast.error({
                title: 'Error',
                message: $('#finish-editting-in-the-last-item-line').text(),
            });
            return true;
        }
        return false;
    };

    Btype.call_bd_act_api = function (data, callback, namespace = 'window') {
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

    Btype.discount_rate_calc = function (cost, purchase) {
        result = ((cost - purchase) / cost * 100).toFixed(window.User['PurchAmtPoint']);
        if (isNaN(result) || result >= 100 || result <= 0) {
            result = 99.9999
        }

        return result;
    };

    Btype.get_last_seq_no = async function (table_name, slip_no) {
        let response = await get_api_data('last-seq-no-get', {
            TableName: table_name,
            SlipNo: slip_no,
        })
        return response.data.LastSeqNo;
    };

    Btype.body_act_success_callback = function ($this, tr) {
        // 합계 계산
        amt_total_calc();

        let qty = $(tr).children('td:eq(6)').find('input')
        let prc = $(tr).children('td:eq(7)').find('input')
        let supply_amt = $(tr).children('td:eq(8)').find('input')
        let vat_amt = $(tr).children('td:eq(9)').find('input')
        let sum_amt = $(tr).children('td:eq(10)').find('input')
        let std_purch_price = $(tr).children('td:eq(11)')

        $(qty).val( format_conver_for(minusComma($(qty).val()), "decimal('purch_qty')") )
        $(prc).val( format_conver_for(minusComma($(prc).val()), "decimal('purch_prc')") )
        $(supply_amt).val( format_conver_for(minusComma($(supply_amt).val()), "decimal('purch_amt')") )
        $(vat_amt).val( format_conver_for(minusComma($(vat_amt).val()), "decimal('purch_amt')") )
        $(sum_amt).val( format_conver_for(minusComma($(sum_amt).val()), "decimal('purch_amt')") )
        $(std_purch_price).text( format_conver_for(minusComma($(std_purch_price).text()), "decimal('purch_prc')") )

        if ($($this).data('last')) {
            add_tr();
            $($this).data('last', false)
        }
        iziToast.success({
            title: 'Success',
            message: $('#action-completed').text(),
        });
    };

    Btype.change_array_order = function (list, targetIdx, moveValue) {
        // 배열값이 없는 경우 나가기
        if (list.length < 0) return false;

        // 이동할 index 값을 변수에 선언
        const newPosition = targetIdx + moveValue;

        // 이동할 값이 0보다 작거나 최대값을 벗어나는 경우 종료
        if (newPosition < 0 || newPosition >= list.length) return false;

        // 임의의 변수를 하나 만들고 배열 값 저장
        const tempList = JSON.parse(JSON.stringify(list));

        // 옮길 대상을 target 변수에 저장하기
        const target = tempList.splice(targetIdx, 1)[0];

        // 새로운 위치에 옮길 대상을 추가하기
        tempList.splice(newPosition, 0, target);

        if (tempList[targetIdx].SeqNo == tempList[newPosition].SeqNo) return false;

        let teme_seq_no = tempList[targetIdx].SeqNo;
        tempList[targetIdx].SeqNo = tempList[newPosition].SeqNo
        tempList[newPosition].SeqNo = teme_seq_no

        return tempList;
    };

    Btype.seq_no_up_down = async function (move, data, table_id, index, namespace = 'window') {
        let last_index = $(`${table_id} tr`).length;
        if (last_index > 0 && eval(namespace).bd_page[last_index - 1].Id == 0) {
            eval(namespace).bd_page = eval(namespace).bd_page.filter((page) => page.Id != 0)
            eval(namespace).create_bd_page()
            iziToast.info({
                title: 'Info',
                message: $('#last-item-line-is-removed').text(),
            });
            return;
        }

        let response = await get_api_data('seq-no-up-down', data)
        if (! isEmpty(response.data['apiStatus']) && response.data['apiStatus'] == 603) {
            iziToast.error({
                title: 'Error',
                message: $('#action-failed').text(),
            });
            return;
        }

        let up_or_down_val = (move == 'up' ? -1 : 1);
        let temp_bd_page = Btype.change_array_order(eval(namespace).bd_page, index, up_or_down_val);
        if (! temp_bd_page) {
            iziToast.error({
                title: 'Error',
                // message: $('#action-failed').text(),
                message: 'SeqNo 같은 번호입니다. 동작실패',
            });
            return;
        }

        eval(namespace).bd_page = temp_bd_page;
        eval(namespace).create_bd_page();

        let after_index = index + up_or_down_val;
        if (after_index > -1 && after_index < eval(namespace).bd_page.length) {
            $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').prop('checked', true);
            $(`${table_id} tr:eq(${after_index})`).children(`td:eq(0)`).find('input').trigger('click');
        } else {
            $(`${table_id} tr:eq(${index})`).children(`td:eq(0)`).find('input').prop('checked', true);
            $(`${table_id} tr:eq(${index})`).children(`td:eq(0)`).find('input').trigger('click');
        }
    };

    Btype.btn_bd_act_multi_delete = function (table_id, namespace = 'window') {
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
            Btype.call_bd_act_api(data, function () {
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

    Btype.btn_bd_act_multi_update = function (table_id, namespace = 'window') {
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

        Btype.call_bd_act_api(data, function () {
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

    Btype.check_the_checkbox_when_changing = function ($this, checked = true, namespace = 'window') {
        let tr = $($this).closest('tr');
        let index = $(tr).prevAll().length

        if (eval(namespace).bd_page[index].Id == 0) return;
        $(tr).find(`input[name='bd-cud-check']`).prop('checked', checked);
    };

    Btype.create_sgroup_select_box_options = async function (page) {
        // let page = await get_select_box_options_data('sgroup-page', `agroup_id=${window.User['AgroupId']}`, 'sgroup_name')

        let sgroup_id_select = custom_create_options('Id', 'SgroupName', page)
        $('#sgroup-id-select').append(sgroup_id_select);
    };

    Btype.get_name_pick_api = async function (url, id) {
        const response = await get_api_data(url, { Page: [ { Id:  parseInt(id) } ] })
        return response.data.Page[0]
    };

    Btype.get_storage_name_and_branch_name = async function () {
        let storage = await Btype.get_name_pick_api('storage-pick', window.User['StorageId'])
        let branch = await Btype.get_name_pick_api('branch-pick', window.User['BranchId'])

        $('#StorageName').val(storage['StorageName'])
        $('#BranchName').val(branch['BranchName'])
    };

    Btype.fetch_slip_form_book = async function (slip_no, strong_type, namespace = 'window', callback = undefined) {
        let response = await call_slip_form_book(eval(namespace).formB['General']['PickApi'],
            eval(namespace).formB['QueryVars']['QueryName'], slip_no, menuCode, strong_type);

        if (isEmpty(callback)) {
            eval(namespace).update_hd_ui(response);
        } else {
            if(callback.name == 'update_modal_hd'){
                response = await call_slip_form_book(eval(namespace).formB['General']['PickApi'],
                modalQuery, slip_no, menuCode);
            }
            callback(response);
        }
        // Btype.set_disable_modal_btn(namespace);
    };

    // head act btn
    Btype.btn_act_del = function (argObj = '#frm', callback = undefined, namespace = 'window') {
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
            Btype.call_act_api(eval(namespace).get_parameter(), function() {
                if (! isEmpty(callback)) { callback(); }
                eval(namespace).btn_act_new();
            }, undefined, argObj, namespace);
        })
    };

    Btype.btn_act_save_and_new = function (argObj = '#frm', namespace = 'window') {
        if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return;
        }
        Btype.set_disable_modal_btn(namespace);
        Btype.call_act_api(eval(namespace).get_parameter(), function() {
            eval(namespace).btn_act_new();
        }, undefined, argObj, namespace);
    };

    Btype.btn_act_save = function (argObj = '#frm', callback = undefined, namespace = 'window') {
        // argObj 입력창 필수요소 체크
        if (dom_required_check(`${argObj} input`) || dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return false;
        }
        isSaveHead = true;
        Btype.set_disable_modal_btn(namespace);
        Btype.call_act_api(eval(namespace).get_parameter(), function() {
            if (! isEmpty(callback)) { callback(); }
        }, undefined, argObj, namespace);
        return true;
    };
    // end head act btn

    Btype.btn_act_add_chain = async function (argObj = '#frm', namespace = 'window') {
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


    Btype.get_current_date_range_value = function (start_date, end_date) {
        let result;
        ['day', 'week', 'month', 'quarterly', 'semiannual', 'year', 'all'].forEach(date_range => {
            let firDay, lasDay;
            [firDay, lasDay] = date_range_vending_machine(date_range)
            if (date_to_sting(firDay) == start_date && date_to_sting(lasDay) == end_date) {
                result = date_range;
                return true;
            }
        });
        return result;
    };

    Btype.set_slip_cache_data = function (argObj = '#modal-slip') {
        if (! isEmpty(slipCacheData['query'])) {
            let query = JSON.parse(slipCacheData['query'])
            // let start_date = moment(query['SlipSearchVars']['StartDate']).format('YYYY-MM-DD');
            // let end_date = moment(query['SlipSearchVars']['EndDate']).format('YYYY-MM-DD');
            //
            // $(`input:radio[name='date-range']:radio[value='${Btype.get_current_date_range_value(start_date, end_date)}']`).prop('checked', true);
            //
            // $(argObj).find('.start-date').val(start_date)
            // $(argObj).find('.end-date').val(end_date)

            // $(`input:radio[name='query-speed']:radio[value='${query['SlipSearchVars']['QuerySpeed']}']`).prop('checked', true);
            // 캐시데이터가 있으면 캐시데이터에 저장된 값을 가져온다
            $(argObj).find('.slip-no').val(query['SlipSearchVars']['SlipNo'])

            $(argObj).find('.company-name').val(query['SlipSearchVars']['CompanyName'])
            $(argObj).find('.item-code').val(query['SlipSearchVars']['ItemCode'])
            $(argObj).find(`.modal-line-select`).val(query['PageVars']['Limit'])
        }
    };

    Btype.btn_act_for = async function (format, argObj = '#frm', namespace = 'window') {
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

    Btype.dblclick_memo_textarea = function($this, last_bd_id = 0, namespace = 'window') {
        const bd = eval(namespace).bd_page.filter(bd => bd['cursorId'] === last_bd_id)[0]
        if (bd && bd['Id'] === 0) {
            iziToast.error({
                title: 'Error', message: '메모는 레코드를 생성 후 수정 가능합니다',
            })
            return
        }
        $('#modal-memo2').find('#memo-textarea').val('')
        $('#modal-memo2').data('txtarea_id', '#' + $($this).attr('id'))

        if (bd) {
            $('#modal-memo2').data('id', bd['Id'])
        } else {
            $('#modal-memo2').data('id', last_bd_id)
        }

        $('#modal-memo2').find('#memo-textarea').val($($this).val())
        $('#modal-memo2').modal('show');
    };

    Btype.change_direct_input_txt = function($this, argObj = '#frm') {
        $(argObj).find('#auto-slip-no-txt').val($($this).val())
    };

    Btype.change_auto_slip_no_select = function($this, argObj = '#frm') {
        const val = $($this).val()
        const div = $(argObj).find('#direct-input-txt').closest('div')
        if (val === 'input') {
            $(div).removeClass('d-none')
            $(div).addClass('d-flex')
            $(argObj).find('#auto-slip-no-txt').val('')
        } else {
            $(div).addClass('d-none')
            $(div).removeClass('d-flex')
            $(argObj).find('#auto-slip-no-txt').val(val)
        }
    };

    Btype.exist_slip_no_type = function(slip_no, argObj = '#frm') {
        $(argObj).find('#auto-slip-no-select').val(slip_no)
        Btype.change_auto_slip_no_select($(argObj).find('#auto-slip-no-select'))
    };

    Btype.input_auto_slip_no_txt = function(slip_no, argObj = '#frm', namespace = 'window') {
        const slip_no_type = eval(namespace).formB['SlipNoOptions'].filter(option => option['Value'] === slip_no)

        if (isEmpty(slip_no_type)) {
            $(argObj).find('#auto-slip-no-select').val('input')
            Btype.change_auto_slip_no_select($(argObj).find('#auto-slip-no-select'))

            $(argObj).find('#direct-input-txt').val(slip_no)
            Btype.change_direct_input_txt($(argObj).find('#direct-input-txt'))
        } else {
            Btype.exist_slip_no_type(slip_no, argObj)
        }
    }

    Btype.empty_id = function() {
        const id = parseInt($('#frm').find('#Id').val())
        if (id === 0) {
            iziToast.error({
                title: 'Error', message: $('#action-failed').text(),
            })
            return true
        }

        return false
    }

    Btype.rpt_custom = function () {
        if (Btype.empty_id()) { return }

        const id = parseInt($('#frm').find('#Id').val())
        ModalRptCustom.show_popup_callback(formB['PrintVars']['CustomCode'], 'formB', `mx.id = ${id}`)
        $('#modal-rpt-custom').modal('show')
    }

    Btype.rpt_print = function() {
        if (Btype.empty_id()) { return }

        const id = parseInt($('#frm').find('#Id').val())
        show_recrystallize_server(formB['PrintVars'], 'formB', `mx.id = ${id}`)
    }

    Btype.checkModalOpen = function(element) {
        const $this = $(element);
        const auto_slip_no = $('#auto-slip-no-txt').val();

        // 전표번호가 비어 있을 경우
        if (!auto_slip_no) {
            iziToast.warning({
                title: "warning",
                message: "저장>추가 버튼을 클릭하여 새 전표번호로 시작하세요."
            });
            return false;
        }
        // disabled인 경우
        if ($this.hasClass('disabled')) {
            let msg = "저장된 해당정보는 변경할 수 없으며 전표 삭제만 가능합니다.";
            if ($this.hasClass('disabled-if-saved')) { // 항목추가인 경우
                msg = "연관 전표번호가 있을경우 연관복사로만 추가가 가능합니다.";
            }
            iziToast.warning({
                title: "warning",
                message: msg
            });
            return false;
        }
        return true;
    }


    Btype.set_disable_modal_btn = function(namespace) {
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
}( window.Btype = window.Btype || {}, jQuery ));
