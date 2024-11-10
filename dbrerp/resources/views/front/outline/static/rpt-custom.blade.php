<!--- uploaders --->
<div class="modal fade" id="modal-rpt-custom" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 400px !important;">
        <div class="modal-content">
            <div class="modal-header bg-danger-10">
                <h4 class="modal-title text-white" id="myModalLabel">커스텀 보고서</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body pb-2 px-2 pt-0" style="background-color: #f5f5f5;">
                <div class="text-right">
                    <div class="btn-group my-1">
                        <button type="button" class="btn btn-sm btn-primary rpt-custom-act save-button" data-value="">
                            미리보기
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => [
                                [ 'Value' => 'PDF', 'Caption' => '아크로벳(pdf) 보기' ],
                                [ 'Value' => 'EXCELWORKBOOK', 'Caption' => '엑셀(xlsx) 다운로드' ],
                                [ 'Value' => 'EXCEL', 'Caption' => '엑셀(xls) 다운로드' ],
                                [ 'Value' => 'WORD', 'Caption' => '워드(docx) 다운로드' ],
                                [ 'Value' => 'EDITABLERTF', 'Caption' => '서식있는텍스트 (rtf)  다운로드' ],
                                [ 'Value' => 'CSV', 'Caption' => '쉼표로구분(csv) 다운로드' ],
                                [ 'Value' => 'RPT', 'Caption' => '크리스탈레포트(rpt)  다운로드' ],
                            ],
                            'eventClassName' => 'rpt-custom-act',
                        ])
                    </div>
                </div>
                <div class="card p-2">
                    <div class="d-flex flex-column mb-2">
                        <label class="m-0">변형 서식 종류</label>
                        <div class="d-flex align-items-center">
                            <input  autocomplete="off" name="is-custom" id="standard-radio" type="radio" value="0" checked>
                            <label for="standard-radio" class="w-100 rounded overflow-hidden mr-0 text-nowrap">
                                표준
                            </label>

                            <input  autocomplete="off" name="is-custom" id="custom-radio" type="radio" value="1">
                            <label for="custom-radio" class="w-100 rounded overflow-hidden mr-0 text-nowrap">
                                커스텀
                            </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <label class="m-0">서식선택</label>
                        <select class="w-100 rounded" id="format-select"></select>
                    </div>
                </div>
{{--                <div class="position-absolute" style="top: 2px; right: 10px;">--}}
{{--                    <button type="button" class="font-weight-bold btn btn-danger btn-sm">--}}
{{--                        인쇄--}}
{{--                    </button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>

@once
<script>
    $('#modal-rpt-custom').find('.rpt-custom-act').on('click', function () {
        // console.log($(this).data('value'))
        ModalRptCustom.rpt_print($(this).data('value'))
    })

    $('input[name=is-custom]').change(function () {
        ModalRptCustom.create_format_select_box_options()
    });

    (function( ModalRptCustom, $, undefined ) {
        ModalRptCustom.data = []
        ModalRptCustom.info = []

        ModalRptCustom.rpt_print = function (export_fmt) {
            let print_vars = ModalRptCustom.data.filter(rpt_custom => rpt_custom['Id'] === Number($('#modal-rpt-custom').find('#format-select').val()))[0]
            print_vars['ExportFmt'] = export_fmt

            show_recrystallize_server(print_vars, ModalRptCustom.info['type'], ModalRptCustom.info['vars'])
        }

        ModalRptCustom.show_popup_callback = async function (custom_code, type, vars) {
            ModalRptCustom.info['type'] = type
            ModalRptCustom.info['vars'] = vars

            ModalRptCustom.btn_act_new()

            const response = await get_api_data('rpt-custom-page', {
                PageVars: {
                    Query: `custom_code = '${custom_code}'`,
                    Asc: 'seq_no',
                    Limit: 9999999
                }
            })
            ModalRptCustom.data = response.data['Page']

            ModalRptCustom.create_format_select_box_options()
        }

        ModalRptCustom.btn_act_new = function () {
            $('#modal-rpt-custom .modal-body button').addClass('bg-danger-10 border-danger-10 bg-danger-10-hover')
        }

        ModalRptCustom.create_format_select_box_options = function() {
            const is_custom = $('input[name=is-custom]:checked').val()
            const data = ModalRptCustom.data.filter(rpt_custom => rpt_custom['IsCustom'] === is_custom)

            const options = custom_create_options('Id', 'RptName', data)
            $('#modal-rpt-custom').find('#format-select').html(options);
        }
    }( window.ModalRptCustom = window.ModalRptCustom || {}, jQuery ));
</script>
@endonce
