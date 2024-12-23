<div id="popup-setup-form-a-media-library-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary media-library-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="media-library-form">
        <div class="card-header" id="frm">
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="hidden" id="brand-code">

            <ul class="nav nav-tabs nav-tabs-solid rounded my-2">
                <li class="nav-item"><a href="#basic-tab" class="nav-link active" data-toggle="tab">{{ $formA['FormVars']['Title']['TabButton1'] }}</a></li>
                <li class="nav-item"><a href="#custom1-tab" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['TabButton2'] }}</a></li>
                <li class="nav-item"><a href="#custom2-tab" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['TabButton3'] }}</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="basic-tab">
                    <div class="row">
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['ThumbSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="thumb-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="thumb-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="align-items-center {{ $formA['FormVars']['Display']['IsCutThumbImage'] }}">
                                        <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-cut-thumb-image-check"> <label class="mb-0" for="is-cut-thumb-image-check">{{ $formA['FormVars']['Title']['IsCutThumbImage'] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['MiddleSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="middle-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="middle-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['BigSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="big-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="big-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 bg-purple-300 text-white text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['FileUpload'] }}</p>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-1">
                                        <div>FTP Upload 폴더: <span class="text-danger" id="upload-folder"></span></div>
                                    </div>
                                    <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsYearMonthFolder'] }}">
                                        <input type="radio" name="date_folder_type" tabindex="-1" value="0" class="text-center mr-1" id="is-year-month-folder-check"> <label class="mb-0" for="is-year-month-folder-check">{{ $formA['FormVars']['Title']['IsYearMonthFolder'] }}</label>
                                    </div>

                                    <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['IsYearMonthDayFolder'] }}">
                                        <input type="radio" name="date_folder_type" tabindex="-1" value="1" class="text-center mr-1" id="is-year-month-day-folder-check"> <label class="mb-0" for="is-year-month-day-folder-check">{{ $formA['FormVars']['Title']['IsYearMonthDayFolder'] }}</label>
                                    </div>

                                    <div class="align-items-center {{ $formA['FormVars']['Display']['SubDir'] }}" onchange="PopupSetupFormAMediaLibraryForm.get_curr_setup_file_path()">
                                        <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="sub-dir-check"> <label class="mb-0" for="sub-dir-check">{{ $formA['FormVars']['Title']['SubDir'] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">모바일 {{ $formA['FormVars']['Title']['ThumbSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="thumb-mob-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="thumb-mob-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="align-items-center {{ $formA['FormVars']['Display']['IsCutThumbImage'] }}">
                                        <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-cut-thumb-mob-image-check"> <label class="mb-0" for="is-cut-thumb-mob-image-check">{{ $formA['FormVars']['Title']['IsCutThumbImage'] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">모바일 {{ $formA['FormVars']['Title']['MiddleSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="middle-mob-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="middle-mob-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">모바일 {{ $formA['FormVars']['Title']['BigSize'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="big-mob-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="big-mob-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom1-tab">
                    <div class="row">
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud1Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud1-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud1-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud2Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud2-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud2-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud3Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud3-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud3-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 bg-purple-300 text-white text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud4Size'] }}</p>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud4-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud4-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom2-tab">
                    <div class="row">
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud5Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud5-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud5-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud6Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud6-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud6-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud7Size'] }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud7-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud7-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg card-header-item">
                            <div class="card card mb-3 mb-md-2 mb-lg-0 border-light" style="height: 240px">
                                <div class="card-header p-0 mb-2 bg-purple-300 text-white text-center">
                                    <p class="card-title p-1 ml-2">{{ $formA['FormVars']['Title']['Ud8Size'] }}</p>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Width'] }}</label>
                                        <input type="text" id="ud8-size-width-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">{{ $formA['FormVars']['Title']['Height'] }}</label>
                                        <input type="text" id="ud8-size-height-txt" class="rounded w-100" autocomplete="off">
                                    </div>
                                </div>
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
            $('.media-library-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAMediaLibraryForm.btn_act_save(); break;
                }
            });

            $(`#media-library-form input[name='date_folder_type']:radio`).on('change', function () {
                PopupSetupFormAMediaLibraryForm.get_curr_setup_file_path()
            });

            activate_button_group()
        });

        (function( PopupSetupFormAMediaLibraryForm, $, undefined ) {
            PopupSetupFormAMediaLibraryForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAMediaLibraryForm.get_curr_setup_file_path = function () {
                const setup = PopupSetupFormAMediaLibraryForm.parameter()
                const setup_json = JSON.parse(setup['SetupJson'])
                setup_json['BrandCode'] = $('#media-library-form').find('#brand-code').val()

                $('#media-library-form').find('#upload-folder').text(get_curr_setup_file_path(setup_json, ''))
            }

            PopupSetupFormAMediaLibraryForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#media-library-form #frm');
            }

            PopupSetupFormAMediaLibraryForm.btn_act_save = function () {
                if ( check_dom_input_number(['#thumb-width-txt', '#thumb-height-txt',
                    '#middle-width-txt', '#middle-height-txt',
                    '#big-width-txt', '#big-height-txt']) ) return;

                Atype.set_parameter_callback(PopupSetupFormAMediaLibraryForm.parameter);

                Atype.btn_act_save('#media-library-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupSetupFormAMediaLibraryForm');
            }

            PopupSetupFormAMediaLibraryForm.make_ud_parameter = function () {
                const result = {}
                for (let i = 1; i <= 8; i++) {
                    const ud = '#ud' + i + '-size'
                    const width = ud + '-width-txt'
                    const height = ud + '-height-txt'

                    result['Ud' + i + 'Size'] = {
                        Width: Number($(width).val()),
                        Height: Number($(height).val()),
                    }
                }

                return result
            }

            PopupSetupFormAMediaLibraryForm.parameter = function () {
                const media_library_form = $('#media-library-form')

                let setup = {
                    ThumbSize: {
                        Width: Number($(media_library_form).find('#thumb-width-txt').val()),
                        Height: Number($(media_library_form).find('#thumb-height-txt').val()),
                    },
                    IsCutThumbImage: $(media_library_form).find('#is-cut-thumb-image-check').is(':checked'),
                    MiddleSize: {
                        Width: Number($(media_library_form).find('#middle-width-txt').val()),
                        Height: Number($(media_library_form).find('#middle-height-txt').val()),
                    },
                    BigSize: {
                        Width: Number($(media_library_form).find('#big-width-txt').val()),
                        Height: Number($(media_library_form).find('#big-height-txt').val()),
                    },
                    ThumbMobSize: {
                        Width: Number($(media_library_form).find('#thumb-mob-width-txt').val()),
                        Height: Number($(media_library_form).find('#thumb-mob-height-txt').val()),
                    },
                    IsCutThumbMobImage: $(media_library_form).find('#is-cut-thumb-mob-image-check').is(':checked'),
                    MiddleMobSize: {
                        Width: Number($(media_library_form).find('#middle-mob-width-txt').val()),
                        Height: Number($(media_library_form).find('#middle-mob-height-txt').val()),
                    },
                    BigMobSize: {
                        Width: Number($(media_library_form).find('#big-mob-width-txt').val()),
                        Height: Number($(media_library_form).find('#big-mob-height-txt').val()),
                    },
                    ...PopupSetupFormAMediaLibraryForm.make_ud_parameter(),
                    DateFolderType: $(media_library_form).find('input[name="date_folder_type"]:checked').val(),
                    SubDir: $(media_library_form).find('#sub-dir-check').is(':checked'),
                }
                let id = Number($(media_library_form).find('#Id').val());
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

                // console.log(setup)
                return parameter;
            }

            PopupSetupFormAMediaLibraryForm.show_popup_callback = async function (id, setup, brand_code) {
                Atype.btn_act_new('#media-library-form #frm');
                $('#media-library-form').find('#Id').val(id)
                $('#media-library-form').find('#brand-code').val(brand_code)
                PopupSetupFormAMediaLibraryForm.set_media_library_ui(setup)
            }

            PopupSetupFormAMediaLibraryForm.set_media_library_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const media_library_form = $('#media-library-form')

                if (! isEmpty(setup['ThumbSize'])) {
                    $(media_library_form).find('#thumb-width-txt').val(setup['ThumbSize'].Width)
                    $(media_library_form).find('#thumb-height-txt').val(setup['ThumbSize'].Height)
                    $(media_library_form).find('#is-cut-thumb-image-check').prop('checked', setup['IsCutThumbImage'])

                    $(media_library_form).find('#middle-width-txt').val(setup['MiddleSize'].Width)
                    $(media_library_form).find('#middle-height-txt').val(setup['MiddleSize'].Height)

                    $(media_library_form).find('#big-width-txt').val(setup['BigSize'].Width)
                    $(media_library_form).find('#big-height-txt').val(setup['BigSize'].Height)
                }

                if (! isEmpty(setup['ThumbMobSize'])) {
                    $(media_library_form).find('#thumb-mob-width-txt').val(setup['ThumbMobSize'].Width)
                    $(media_library_form).find('#thumb-mob-height-txt').val(setup['ThumbMobSize'].Height)
                    $(media_library_form).find('#is-cut-thumb-mob-image-check').prop('checked', setup['IsCutThumbMobImage'])

                    $(media_library_form).find('#middle-mob-width-txt').val(setup['MiddleMobSize'].Width)
                    $(media_library_form).find('#middle-mob-height-txt').val(setup['MiddleMobSize'].Height)

                    $(media_library_form).find('#big-mob-width-txt').val(setup['BigMobSize'].Width)
                    $(media_library_form).find('#big-mob-height-txt').val(setup['BigMobSize'].Height)
                }

                for (let i = 1; i <= 8; i++) {
                    const ud = '#ud' + i + '-size'
                    const width = ud + '-width-txt'
                    const height = ud + '-height-txt'

                    if (isEmpty(setup['Ud' + i + 'Size'])) {
                        continue
                    }
                    $(width).val(setup['Ud' + i + 'Size'].Width)
                    $(height).val(setup['Ud' + i + 'Size'].Height)
                }

                $(media_library_form).find(`input[name="date_folder_type"][value="${setup['DateFolderType']}"]`).prop('checked', true);
                $(media_library_form).find('#sub-dir-check').prop('checked', setup['SubDir']);

                PopupSetupFormAMediaLibraryForm.get_curr_setup_file_path()
            }

        }( window.PopupSetupFormAMediaLibraryForm = window.PopupSetupFormAMediaLibraryForm || {}, jQuery ));
    </script>

@endonce
