(function( Atype, $, undefined ) {
    let parameter_callback;

    // Private Method
    function call_act_api(data, argObj, callback, namespace = 'window') {
        $('.save-button').prop('disabled', true);

        $.when(window.get_api_data(eval(namespace).formA['General']['ActApi'], {
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

    Atype.input_auto_slip_no_txt = function(slip_no, select_dom_val, dom_val, argObj = '#frm', slip_no_options) {
        const slip_no_type = slip_no_options.filter(val => val === slip_no)

        if (isEmpty(slip_no_type)) {
            $(argObj).find(select_dom_val).val('input')
            Atype.change_auto_slip_no_select($(argObj).find(select_dom_val), dom_val, argObj)

            $(argObj).find('#direct-input-txt').val(slip_no)
            Atype.change_direct_input_txt($(argObj).find('#direct-input-txt'), dom_val, argObj)
        } else {
            Atype.exist_slip_no_type(slip_no, select_dom_val, dom_val, argObj)
        }
    }

    Atype.exist_slip_no_type = function(slip_no, select_dom_val, dom_val, argObj = '#frm') {
        $(argObj).find(select_dom_val).val(slip_no)
        Atype.change_auto_slip_no_select($(argObj).find(select_dom_val), dom_val, argObj)
    };

    Atype.change_direct_input_txt = function($this, dom_val, argObj = '#frm') {
        $(argObj).find(dom_val).val($($this).val())
    };

    Atype.change_auto_slip_no_select = function($this, dom_val, argObj = '#frm') {
        const val = $($this).val()
        const div = $(argObj).find('#direct-input-txt').closest('div')

        if (val === 'input') {
            $(div).removeClass('d-none')
            $(div).addClass('d-flex')
            $(argObj).find(dom_val).val('')
        } else {
            $(div).addClass('d-none')
            $(div).removeClass('d-flex')
            $(argObj).find(dom_val).val(val)
        }
    };

    // Public Method
    Atype.btn_act_copy = function (argObj, callback = undefined, namespace = 'window') {
        if (window.befo_del_copy_id(argObj) || $(argObj).find('input[name="Id"]').val() == 0) {
            iziToast.error({ title: 'Error', message: $('#can-not-copy-in-the-status').text() });
            return;
        }

        const value = $(argObj).find('input[data-copy="true"]').val();
        $(argObj).find('input[name="Id"]').val(0)
        $(argObj).find('input[data-copy="true"]').val(`${value}-copy`);
        Atype.btn_act_save(argObj, callback, namespace)
    };

    Atype.btn_act_new = function (argObj) {
        window.input_box_reset_for(argObj)
    };

    Atype.btn_act_save = function (argObj, callback = undefined, namespace = 'window') {
        if (window.dom_required_check(`${argObj} input`) || window.dom_required_check(`${argObj} select`)) {
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return;
        }

        if ( window.verify_email(argObj)) {
            iziToast.warning({
                title: 'Warning',
                message: '이메일 형식을 입력하세요',
            });
            return;
        }

        call_act_api(parameter_callback(), argObj, function() {
            if (! isEmpty(callback)) { callback(); }
        }, namespace);
    };

    Atype.btn_act_del = function (argObj, callback = undefined, namespace = 'window') {
        if (window.befo_del_copy_id(argObj) || $(argObj).find('input[name="Id"]').val() == 0) {
            iziToast.error({
                title: 'Error',
                message: $('#can-not-delete-in-the-status').text(),
            });
            return;
        }

        window.confirm_message_shw_and_delete(function() {
            const id = $(argObj).find('input[name="Id"]').val();
            $(argObj).find('input[name="Id"]').val( `-${id}` );
            call_act_api(parameter_callback(), argObj, function() {
                if (! isEmpty(callback)) { callback(); }
                Atype.btn_act_new(argObj);
            }, namespace);
        })
    };

    Atype.copy_to_clipboard = function (dom_val) {
        const copyText = $(dom_val)[0];
        if (navigator.clipboard) {
            navigator.clipboard.writeText(copyText.value).catch(err => {
                iziToast.success({
                    title: 'Error',
                    message: 'Could not copy text',
                });
            });
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });
        } else {
            const dummyElement = document.createElement('span');
            dummyElement.style.whiteSpace = 'pre'
            dummyElement.textContent = copyText.value;
            document.body.appendChild(dummyElement)

            const selection = window.getSelection();
            selection.removeAllRanges()
            const range = document.createRange()
            range.selectNode(dummyElement)
            selection.addRange(range)

            document.execCommand('copy');

            selection.removeAllRanges()
            document.body.removeChild(dummyElement)
        }
    }

    Atype.set_parameter_callback = function (callback) {
        parameter_callback = callback;
    }

    Atype.get_name_pick_api = async function (url, id) {
        let response = await get_api_data(url, { Page: [ { Id:  parseInt(id) } ] });

        return response.data.Page[0];
    };

    Atype.btn_act_for = async function (format, argObj = '#frm', namespace = 'window') {
        const table = format_conver_for(null, format);
        const update_data = {
            Id: Number($(argObj).find('#Id').val()),
            UpdatedOn: get_now_time_stamp(),
        }
        update_data[table['Field']] = table['Value'];

        let response = await get_api_data(eval(namespace).formA['General']['ActApi'], {
            Page: [ update_data ]
        });

        show_iziToast_msg(response.data.Page, function () {
            $('#modal-select-popup.show').trigger('list.requery')
            $('#modal-select-popup.show').modal('hide');
        })
    };

}( window.Atype = window.Atype || {}, jQuery ));
