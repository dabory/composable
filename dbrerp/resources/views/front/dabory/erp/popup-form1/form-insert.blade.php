<div class="mb-1 pt-2 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary itech21-customer-insert-act save-button" data-value="save" {{ $formInsert['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formInsert['FormVars']['Title']['SaveButton'] }}
        </button>
    </div>
</div>

<div class="card mb-2" id="form-insert">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="mb-2 text-danger">
                            {!! $formInsert['NoticeVars']['Notice'] !!}
                        </div>
                        <div class="mb-2">
                            {!! $formInsert['NoticeVars']['Warning'] !!}
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="truncate-table-check"> <label class="mb-0" for="truncate-table-check">{{ $formInsert['FormVars']['Title']['TruncateTable'] }}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="backup-table-check"> <label class="mb-0" for="backup-table-check">{{ $formInsert['FormVars']['Title']['BackupTable'] }}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="1" class="text-center mr-1" id="is-backup-db-check"> <label class="mb-0" for="is-backup-db-check">{{ $formInsert['FormVars']['Title']['BackupDb'] }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.itech21-customer-insert-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormInsert.btn_act_save(); break;
                }
            });
        });

        (function( PopupForm1FormInsert, $, undefined ) {
            PopupForm1FormInsert.formInsert = {!! json_encode($formInsert) !!};
            PopupForm1FormInsert.parentParameter = {};
            PopupForm1FormInsert.tdCount = 0

            PopupForm1FormInsert.btn_act_save = async function () {
                if (PopupForm1FormInsert.tdCount === 0  || isEmpty(PopupForm1FormInsert.parentParameter['ListType1Vars']['ListToken'])) {
                    iziToast.error({
                        title: 'Error',
                        message: '엑셀화일을 먼저 업로드 해주세요',
                    });
                    return
                }

                const form_insert = $('#form-insert')

                const response = await get_api_data(PopupForm1FormInsert.formInsert['General']['ActApi'], {
                    InsertVars: {
                        QueryName: PopupForm1FormInsert.formInsert['InsertVars']['QueryName'],
                        InsertType: PopupForm1FormInsert.formInsert['InsertVars']['InsertType'],
                        ListToken: PopupForm1FormInsert.parentParameter['ListType1Vars']['ListToken'],
                        IsTruncateTable: $(form_insert).find('#truncate-table-check:checked').val() == '1',
                        IsBackupTable: $(form_insert).find('#backup-table-check:checked').val() == '1',
                        IsBackupDb: $(form_insert).find('#is-backup-db-check:checked').val() == '1',

                        PreProcess: PopupForm1FormInsert.formInsert['InsertVars']['PreProcess'] ?? '',
                        PostProcess: PopupForm1FormInsert.formInsert['InsertVars']['PostProcess'] ?? '',
                    }
                })

                const d = response.data
                if (d.apiStatus) {
                    return iziToast.error({
                        title: 'Error', message: d.body ?? $('#api-request-failed-please-check').text(),
                    })
                }

                $('#modal-multi-popup.show').trigger('list.token.init')
                $('#modal-multi-popup.show').modal('hide')

                iziToast.success({
                    title: 'Success', message: $('#action-completed').text(),
                });

                // show_iziToast_msg(response.data.InsertVars, function () {
                //     $('#modal-multi-popup.show').trigger('list.token.init')
                //     $('#modal-multi-popup.show').modal('hide')
                // })
            }

            PopupForm1FormInsert.btn_act_new = function () {
                $('#modal-multi-popup .modal-dialog').css('maxWidth', '800px');

                $('#modal-multi-popup .modal-header').removeClass('bg-dark-alpha px-0')
                $('#modal-multi-popup .modal-body button').removeClass('bg-dark-alpha border-dark-alpha bg-dark-alpha-hover')

                $('#modal-multi-popup .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
                $('#modal-multi-popup .modal-header').addClass('bg-danger-10')

                if (! PopupForm1FormInsert.formInsert['ConditionVars']['IsVisible']) {
                    $('#modal-multi-popup').on('show.bs.modal', function (e) { e.preventDefault(); })
                    PopupForm1FormInsert.btn_act_save()
                }

                Atype.btn_act_new('#form-insert #frm')

                const form_insert = $('#form-insert')

                $(form_insert).find('#truncate-table-check').prop('checked', PopupForm1FormInsert.formInsert['InsertVars']['IsTruncateTable'])
                $(form_insert).find('#backup-table-check').prop('checked', PopupForm1FormInsert.formInsert['InsertVars']['IsBackupTable'])
                $(form_insert).find('#is-backup-db-check').prop('checked', PopupForm1FormInsert.formInsert['InsertVars']['IsBackupDb'])
            }

            PopupForm1FormInsert.show_popup_callback = async function (parent_parameter, parameter, td_count) {
                PopupForm1FormInsert.tdCount = td_count
                PopupForm1FormInsert.btn_act_new()
                PopupForm1FormInsert.formInsert = parameter
                PopupForm1FormInsert.parentParameter = parent_parameter
            }
        }( window.PopupForm1FormInsert = window.PopupForm1FormInsert || {}, jQuery ));
    </script>
@endpush
@endonce
