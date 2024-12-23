<div id="popup-setup-form-a-pro-skin-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary pro-skin-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="pro-skin-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 100px">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">스킨선택</label>
                                <select class="rounded w-100" id="pro-skin-select" required>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script>
        $(document).ready(async function() {
            $('.pro-skin-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAProSkinForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupSetupFormAProSkinForm, $, undefined ) {
            PopupSetupFormAProSkinForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAProSkinForm.btn_act_save =  function () {
                Atype.set_parameter_callback(PopupSetupFormAProSkinForm.parameter);
                Atype.btn_act_save('#pro-skin-form  #frm', async function () {
                    axios.post('/set-pro-skin', {
                        skin_name: $('#pro-skin-form').find('#pro-skin-select').val()
                    });
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAProSkinForm');
            }

            PopupSetupFormAProSkinForm.parameter = function () {
                let setup = {
                    ProSkin: $('#pro-skin-form').find('#pro-skin-select').val(),
                }
                let id = Number($('#pro-skin-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(setup),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                // console.log(parameter)
                return parameter;
            }

            PopupSetupFormAProSkinForm.show_popup_callback = async function (id, setup) {
                $('#modal-select-popup.popup-setup-form-a-pro-skin-form .modal-dialog').css('maxWidth', '600px');
                Atype.btn_act_new('#pro-skin-form #frm');
                $('#pro-skin-form').find('#Id').val(id)
                const response = await axios.post('/pro-skin-directories', {});
                const html = response.data.reduce(function (accumulator, item) {
                    return accumulator + `<option value="${item}">${item}</option>`;
                }, '');
                $('#pro-skin-form').find('#pro-skin-select').html(html)
                PopupSetupFormAProSkinForm.set_pro_skin_ui(setup)
            }

            PopupSetupFormAProSkinForm.set_pro_skin_ui = function (pro_skin) {
                if (_.isEmpty(pro_skin)) return;

                $('#pro-skin-form').find('#pro-skin-select').val(pro_skin.ProSkin)
            }

        }( window.PopupSetupFormAProSkinForm = window.PopupSetupFormAProSkinForm || {}, jQuery ));

    </script>
@endonce
