$(document).on('shown.bs.modal','#modal-copy-to-another.show', function (e) {
    init_copy_to_another_modal()
})

function change_target_text() {
    set_target_slip_no_btn_abled();
    if (! isEmpty($('#modal-copy-to-another.show').find('input[name=EqualLabel]:checked').val())) {
        source_slip_no_txt = $('#modal-copy-to-another.show').find('.source-slip-no-txt').val();
        $('#modal-copy-to-another.show').find('.target-slip-no-txt').val(source_slip_no_txt);
        return;
    } else {
        let target_slip_no_txt = $('#modal-copy-to-another.show').find('.target-slip-no-txt')
        $(target_slip_no_txt).val($(target_slip_no_txt).data('slip-no'))
    }
}

function init_copy_to_another_modal() {
    set_target_slip_no_btn_abled();

    $('#modal-copy-to-another.show').find('.target-slip-no-txt').val('')
    // let target_slip_no_txt = $('#modal-copy-to-another.show').find('.target-slip-no-txt')
    // $(target_slip_no_txt).val($(target_slip_no_txt).data('slip-no'))

    // $('#modal-copy-to-another.show').find('.source-slip-no-txt').val('');

    let class_name = $('#modal-copy-to-another.show').data('class')
    $('#modal-copy-to-another.show').find(`#${class_name}-CopyItemRadio`).prop('checked', true)
}

function set_target_slip_no_btn_abled() {
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').attr('disabled', false);
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').addClass('btn-secondary')
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').removeClass('btn-light')
}

function set_target_slip_no_btn_disabled() {
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').attr('disabled', true);
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').removeClass('btn-secondary')
    $('#modal-copy-to-another.show').find('.target-slip-no-btn').addClass('btn-light')
}

async function get_target_last_slip_no() {
    if (! isEmpty($('#modal-copy-to-another.show').find('input[name=EqualLabel]:checked').val())) {
        source_slip_no_txt = $('#modal-copy-to-another.show').find('.source-slip-no-txt').val();
        $('#modal-copy-to-another.show').find('.target-slip-no-txt').val(source_slip_no_txt);
        return;
    }

    mainModalGetsFocus(`#modal-copy-to-another.show`, copyToAnother[$('#modal-copy-to-another.show').data('class')]);

    let response = await Btype.get_last_slip_no(moealSetFile.General.TargetTable);
    $('#modal-copy-to-another.show').find('.target-slip-no-txt')
        .val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo);
    set_target_slip_no_btn_disabled();
}

function get_source_slip_no(slip_no) {
    $('#modal-slip.show').modal('hide');
    $('#modal-eyetest.show').modal('hide');

    mainModalGetsFocus(`#modal-copy-to-another.show`, copyToAnother[$('#modal-copy-to-another.show').data('class')]);

    $('#modal-copy-to-another.show').find('.source-slip-no-txt').val(slip_no);
}

function CopyToAnother(target_hd_table_full_name, source_table, target_table,
    source_slip, target_slip, is_copy_body) {
    this.target_hd_table_full_name = target_hd_table_full_name
    this.source_table = source_table;
    this.target_table = target_table;
    this.source_slip = source_slip;
    this.target_slip = target_slip;
    this.is_copy_body = is_copy_body;
}

function fetch_copy_to_another(url, data, callback) {
    $.when(get_api_data(url, {
        TargetHdTableFullName : data.target_hd_table_full_name,
        SourceTable: data.source_table,
        TargetTable: data.target_table,
        SourceSlip: data.source_slip,
        TargetSlip: data.target_slip,
        IsCopyBody: data.is_copy_body
    })).done(function(response) {
        callback(response)
    });
}

async function copy_to_another() {
    if (dom_required_check('#modal-copy-to-another.show input')) {
        iziToast.warning({
            title: 'Warning',
            message: $('#required-item-omitted').text(),
        });
        return;
    }
    mainModalGetsFocus(`#modal-copy-to-another.show`, copyToAnother[$('#modal-copy-to-another.show').data('class')]);

    let target_slip_no_txt = $('#modal-copy-to-another.show').find('.target-slip-no-txt').val();
    let slip_no = `${capitalize(moealSetFile.General.TargetTable)}No`;

    if (! $('#modal-copy-to-another.show').find('.target-slip-no-btn').attr('disabled')) {
        let data = {};
        data[slip_no] = target_slip_no_txt
        let response = await get_api_data(moealSetFile.General.PickApi, {
            Page: [
                data
            ]
        });

        if (response.data.Page) {
            let bd_id = response.data.Page[0].Id;
            response = await get_api_data(formB.General.ActApi, {
            Page: [
                    { Id: parseInt(`-${bd_id}`) }
                ]
            });
        }
    }

    let class_name = $('#modal-copy-to-another.show').data('class')
    const copy_data = new CopyToAnother(moealSetFile.TargetHdTableFullName, moealSetFile.General.SourceTable, moealSetFile.General.TargetTable,
        $('#modal-copy-to-another.show').find('.source-slip-no-txt').val(), target_slip_no_txt,
        $('#modal-copy-to-another.show').find(`input[name=${class_name}-CopyItemCheckRadio]:checked`).val() ==='true')

    fetch_copy_to_another(moealSetFile.General.ActApi, copy_data, function (response) {
        let d = response.data
        if (d.Hd) {
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            });

            Btype.fetch_slip_form_book(target_slip_no_txt, false);
            $('#modal-copy-to-another.show').modal('hide')
        } else {
            let message = d.body ?? $('#api-request-failed-please-check').text();
            iziToast.error({
                title: 'Error',
                message: message,
            });
        }
    })
}
