const modala_controller = (function ($, window, document, undefined) {
    // btn-top-act (전체)
    $(`.btn-top-act`).on('click', function () {
        switch( $(this).data('value') ){
            case 'save' : btn_act_save();   break;
            case 'new'  : btn_act_new();    break;
            case 'del'  : btn_act_del();    break;
            case 'copy' : btn_act_copy();   break;
            // case 'clear' : btn_act_clear(); break;
            case 'save-modify'  : btn_act_modify(); break;
        }
    });

    // btn-top-act 처리 (전체)
    befo_save_id = () => {
        let bool = false;
        if( $(`#frm`).find(`input[name="Id"]`).prop( 'disabled' ) ){
            bool = true;
        }
        return bool;
    }

    btn_act_save = () => {
        checkbox_converting_values();

        if( befo_save_id() ){
            iziToast.error({
                title: 'Error',
                message: $('#action-failed').text(),
            });
            return;
        }
        let msg = false;

        $(`#frm :input`).each(function() {
            if( $(this).prop('required') && !$(this).val().co_trim() )
                msg = true;
        })
        if( msg ){
            iziToast.warning({
                title: 'Warning',
                message: $('#required-item-omitted').text(),
            });
            return;
        }
        $(`#frm`).submit();
        form_data_reset();
    }

    btn_act_new = () => {
        $(`#frm :input[type="text"]`).each(function(){
            $(this).val('');
        })
        $(`#frm`).find(`input[name="Id"]`).val('0');
        $('.act-disabl').prop( 'disabled', false );
        form_data_reset();
    }

    btn_act_del = () => {
        if( befo_del_copy_id() ){
            iziToast.error({
                title: 'Error',
                message: $('#can-not-delete-in-the-status').text(),
            });
            return;
        }
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
                const id = $(`#frm`).find(`input[name="Id"]`).val();
                $(`#frm`).find(`input[name="Id"]`).val( `-${id}` );
                $(`#frm`).submit();
                form_data_reset();
            }
        });
    }

    btn_act_copy = () => {
        if( befo_del_copy_id() ){
            iziToast.error({
                title: 'Error',
                message: $('#can-not-copy-in-the-status').text(),
            });
            return;
        }
        checkbox_converting_values();
        const value = $(`#frm`).find(`input[data-copy="true"]`).val();
        $(`#frm`).find(`input[name="Id"]`).val( 0 );
        $(`#frm`).find(`input[data-copy="true"]`).val( `${value}-copy` );
        $(`#frm`).submit();
        form_data_reset();
    }

    function form_data_reset() {
        $(`#frm :input[type="text"]`).each(function(){
            $(this).val('');
        })
        $(`#frm`).find(`input[name="Id"]`).val('0');
        $('.act-disabl').prop( 'disabled', false );
        $(`#frm :input[type="checkbox"]`).each(function () {
            $(this).prop('checked',false);
            $('#'+$(this).attr('name')+'_hidden').attr("disabled", false)
        });
    }

    function checkbox_converting_values() {
        $(`#frm :input[type="checkbox"]:checked`).each(function () {
            $('#'+$(this).attr('name')+'_hidden').attr("disabled", true)
        });
    }

})(jQuery, window, document);













































// let $this;
// // called when user clicked the folder button
// $(document).on('click', '.btn-open-modal', function () {
//     $this = $(this);
//     let option = th = '';
//     $.each( moealSetFile.SelectOptions , function(k, v){
//         option += `<option value="${v.Value}">${v.Caption}</option>`;
//     });
//     // $.each( moealSetFile.ListVars[0] , function(k, v){ th += `<th>${v}</th>`; });
//     $.each( moealSetFile.ListVars['Title'] , function(k, v){ th += `<th ${moealSetFile.ListVars['Hidden'][k]} style="width:${moealSetFile.ListVars['Size'][k]}px">${v}</th>`; });


//     // 모달의 title, 검색부분, table 부분 처리
//     $(`#modal-${$this.data('target')}`).find(`#myModalLabel`).text( moealSetFile.General.Title );
//     $(`#modal-${$this.data('target')}`).find(`.modal-filter-select`).html(option);
//     $(`#modal-${$this.data('target')}`).find(`#table-head`).html(th);

//     eval ( `${$this.data('target')}_open()` );
// });
