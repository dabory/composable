function select_box_first_selected(dom_val) {
    $(`${dom_val} option:eq(0)`).prop('selected', true);
}

function first_dom_focus(dom_val) {
    $(dom_val).each(function() {
        let this_val = $(this).val() || '';
        if ($(this).prop('required') && !this_val.co_trim()) {
            $(this).focus();
            return false;
        }
    })

    return;
}

function dom_required_check(dom_val) {
    let msg = false;

    $(dom_val).each(function() {
        let this_val = $(this).val() || ''
        if($(this).prop('required') && !this_val.co_trim()) {
            const label_txt = $(this).closest('.form-group').find('label').text()
            if (label_txt) {
                iziToast.warning({ title: 'Warning', message: label_txt.split('*')[0] + ' ' + $('#no-data-found').text()});
            }
            msg = true;
        }
    })

    first_dom_focus(dom_val);

    return msg
}

function befo_del_copy_id(argObj = '#frm') {
    let bool = false;
    const $thisinput = $(argObj).find('input[name="Id"]');
    if ($thisinput.prop( 'disabled' ) || $thisinput.val() == '0') {
        bool = true;
    }

    return bool;
}

function set_as_response_id(value, argObj = '#frm') {
    if ($(argObj).find('input[name="Id"]').val() >= 0) {
        $(argObj).find('input[name="Id"]').val(value)
    } else {
        $(argObj).find('input[name="Id"]').val(0)
    }
}

function get_current_table_tr_index(dom_val) {
    let tr = $(dom_val).closest('tr')
    // tbody에서 현재tr index 가져옴,
    return $(tr).prevAll().length;
}

function confirm_message_shw_and_delete(callback) {
    swalInit.fire({
        title: $('#comfirm-delete').text(),
        text: $('#can-not-recover-after-delete').text(),
        type: 'question',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-primary',
        confirmButtonText: $('#delete').text(),
        cancelButtonText: $('#cancel').text(),
    }).then((result) => {
        if (result.value) {
            callback()
        }
    });
}

function handleEnterPressedinNormalCell(event, callback) {
    if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
        document.activeElement.blur();
        callback(event.target);
    }
}

function enter_pressed_auto_search(event, callback = undefined) {
    if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
        if (isEmpty(callback)) {
            let dom_val = '#modal-' + $(event.target).data('target');
            $(`${dom_val}.show`).find('.modal-search').trigger('click');
        } else {
            callback();
        }
        document.activeElement.blur();
    }
}

function checkbox_all_checked($this, name) {
    $($this).closest('table').find(`input[name='${name}']`).each(function(index) {
        if ($($this).is(':checked') == $(this).is(':checked')) {
            $(this).trigger('click');
        }
        $(this).prop('checked', ! $($this).is(':checked'));
        $(this).trigger('click');
    })
}

function table_head_check_box_reset(dom_val) {
    $(dom_val).find('thead .all-check').prop('checked', false);
    $(dom_val).find('thead .all-check').trigger('change');
}

function deactivate_button_group(argObj = null) {
    if (! isEmpty(argObj)) {
        $(argObj['save_spinner_btn']).prop('hidden', false)
        $(argObj['btn_group']).prop('hidden', true)
    } else {
        $('.save-spinner-btn').prop('hidden', false)
        $('.btn-group').prop('hidden', true)
    }
}

function activate_button_group(argObj = null) {
    if (! isEmpty(argObj)) {
        $(argObj['save_spinner_btn']).prop('hidden', true)
        $(argObj['btn_group']).prop('hidden', false)
    } else {
        $('.save-spinner-btn').prop('hidden', true)
        $('.btn-group').prop('hidden', false)
    }
}

function input_box_reset_for(argObj, exception_name = [], attr_name = 'id') {
    // id 초기화
    $(argObj).find('input[name="Id"]').val(0)
    $(argObj).find('#remarks-preview').html('')

    // select 초기화
    $(argObj).find('select').each(function () {
        $(this).find(`option:eq(0)`).prop('selected', true)
    });

    // text 초기화
    $(argObj).find('input[type=text]').each(function () {
    if (exception_name.includes($(this).attr(attr_name))) return;
        this.value = '';
    });

    // email 초기화
    $(argObj).find('input[type=email]').each(function () {
    if (exception_name.includes($(this).attr(attr_name))) return;
        this.value = '';
    });

    // textarea 초기화
    $(argObj).find('textarea').each(function () {
        this.value = '';
    });

    // checkbox 초기화
    $(argObj).find('input[type=checkbox]').each(function () {
        $(this).prop('checked', false)
    });

    // radio 초기화
    $(argObj).find('input[type=radio]').each(function () {
        $(this).prop('checked', false)
    });

    // file 초기화
    $(argObj).find('input[type=file]').each(function () {
    if (exception_name.includes($(this).attr(attr_name))) return;
        this.value = '';
    });
}

function verify_email(dom_val) { // 이메일 검증 스크립트 작성
    const pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    let result = false;

    $(dom_val).find('input[type=email]').each(function () {
        // 검증에 사용할 정규식 변수 regExp에 저장
        result = ! ($(this).val().match(pattern) != null);
        if (result) {
            $(this).focus();
            return false;
        }
    });

    return result;
}

function get_radio_value_for(dom_val, name) {
    return $(dom_val).find(`:input:radio[name=${name}]:checked`).val()
}

function set_radio_value_for(dom_val, name, value) {
    return $(dom_val).find(`:input:radio[name=${name}]:input[value=${value}]`).attr('checked', true);
}
