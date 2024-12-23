{{--@extends('layouts.master')--}}
{{--@section('content')--}}

    <div id="popup-setup-form-a-text-template-form">
        <div class="mb-1 pt-2 text-right btn-groups">
            <div class="btn-group mr-2" id="text-template-btn-group">
                <button type="button" class="btn btn-sm btn-primary text-template-act"
                        data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                    {{ $formA['FormVars']['Title']['SaveButton'] }}
                </button>
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'text-template-act',
                ])
            </div>
        </div>

        <div class="mms_wrap" id="text-template-form">
            <div class="mms" id="frm" style="width: 860px;">
                <!-- 상단 버튼 시작 -->
                <ul class="top_btn">
                    {{-- <button type="button">sms</button>
                    <button type="button">lms</button>
                    <button type="button">mms</button> --}}
                </ul>
                <!--// 상단 버튼 끝 -->

                <!-- 핸드폰 영역 시작 -->
                <div class="input_field" style="width: 810px;">
                    <input type="hidden" id="Id" name="Id" value="0">
                    <div class="txt_byte">
                        <div class="byte-info">
                            <span class="cur-byte">0</span>/999 byte
                        </div>
                    </div>

                    <div class="input_box">
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TextCode'] }}</label>
                            <input type="text" id="text-code-txt" class="rounded w-100" readonly autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TextCode'] }}"
                                {{ $formA['FormVars']['Required']['TextCode'] }}>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TextName'] }}</label>
                            <input type="text" id="text-name-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TextName'] }}"
                                {{ $formA['FormVars']['Required']['TextName'] }}>
                        </div>

                        <div class="form-group d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['TextDesc'] }}</label>
                            <input type="text" id="text-desc-txt" class="rounded w-100" autocomplete="off"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['TextDesc'] }}"
                                {{ $formA['FormVars']['Required']['TextDesc'] }}>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item customer-tab">
                                <a href="#customer-tab" class="nav-link active" data-toggle="tab">고객</a>
                            </li>
                            <li class="nav-item"><a href="#admin-tab" class="nav-link" data-toggle="tab">관리자</a></li>
                            <li class="nav-item"><a href="#supplier-tab" class="nav-link" data-toggle="tab">공급자</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="customer-tab">
                                <div class="align-items-center mt-2 d-flex">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1"
                                           id="customer-send-check">
                                    <label class="mb-0" for="customer-send-check">고객에게 송신</label>
                                </div>
                                <hr class="mt-2">

                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-solid">
                                            <li class="nav-item">
                                                <a href="#customer-kakao-tab" class="nav-link active" data-toggle="tab">카카오알림톡</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#customer-sms-tab" class="nav-link" data-toggle="tab">SMS/LMS</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="customer-kakao-tab">
                                                <div class="pt-1 text-right">
                                                    <div class="btn-group" id="text-template-btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                                onclick="PopupSetupFormATextTemplateForm.show_popup('/kakao-templates-popup')"
                                                                style="background-color: #5c6bc0 !important;">
                                                            신규 템플릿 생성
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9.5 css-18u3619 mb-2 mt-1"
                                                     data-testid="EditorGridItem_Grid_2">
                                                    <div class="MuiStack-root css-j7qwjs" data-testid="EditorSectionKakao_Stack_1">
                                                        <table class="MuiTable-root table-low css-sypgmg"
                                                               data-testid="KakaoTemplateTable_Table">
                                                            <thead class="MuiTableHead-root css-1wbz3t9"
                                                                   data-testid="KakaoTemplateTable_TableHead">
                                                            <tr class="MuiTableRow-root MuiTableRow-head css-1u6a08m"
                                                                data-testid="KakaoTemplateTable_TableRow">
                                                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-q6opgp"
                                                                    scope="col" width="250" data-testid="KakaoTemplateTable_TableCell">
                                                    <span
                                                        class="MuiTypography-root MuiTypography-base.subTitle2M css-ydh8sj"
                                                        data-testid="KakaoTemplateTable_Typography">템플릿 구분</span></th>
                                                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1i31wif"
                                                                    scope="col" width="104" data-testid="KakaoTemplateTable_TableCell">
                                                    <span
                                                        class="MuiTypography-root MuiTypography-base.subTitle2M css-ydh8sj"
                                                        data-testid="KakaoTemplateTable_Typography">상태 / 승인상태</span></th>
                                                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1i31wif"
                                                                    scope="col" width="140" data-testid="KakaoTemplateTable_TableCell">
                                                    <span
                                                        class="MuiTypography-root MuiTypography-base.subTitle2M css-ydh8sj"
                                                        data-testid="KakaoTemplateTable_Typography">업데이트일</span></th>
                                                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1i31wif"
                                                                    scope="col" width="140" data-testid="KakaoTemplateTable_TableCell">
                                                    <span
                                                        class="MuiTypography-root MuiTypography-base.subTitle2M css-ydh8sj"
                                                        data-testid="KakaoTemplateTable_Typography">템플릿 수정 / 삭제</span></th>

                                                            </tr>
                                                            </thead>
                                                            <tbody class="MuiTableBody-root css-1xnox0e"
                                                                   data-testid="KakaoTemplateTable_TableBody">

                                                            </tbody>
                                                        </table>
                                                        <div class="MuiStack-root css-1y30grd" data-testid="EditorSectionKakao_Stack_2">
                                            <span class="MuiTypography-root MuiTypography-base.body3 css-1o1jcq0"
                                                  data-testid="KakaoTemplateInfoText_Typography"><svg
                                                    class="MuiSvgIcon-root MuiSvgIcon-fontSizeX4Small css-19ef0js"
                                                    focusable="false" color="#616161" aria-hidden="true"
                                                    viewBox="0 0 24 24" width="24" height="24"
                                                    xmlns="http://www.w3.org/2000/svg" cx="12" cy="12" r="6.6"
                                                    data-testid="KakaoTemplateInfoText_BulletFilledCDSIcon"><circle
                                                        cx="12" cy="12"
                                                        r="6.6"></circle></svg>업데이트일 최신 사용중 템플릿이 실제 고객에게 발송되어요.</span><span
                                                                class="MuiTypography-root MuiTypography-base.body3 css-1o1jcq0"
                                                                data-testid="KakaoTemplateInfoText_Typography"><svg
                                                                    class="MuiSvgIcon-root MuiSvgIcon-fontSizeX4Small css-19ef0js"
                                                                    focusable="false" color="#616161" aria-hidden="true"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    xmlns="http://www.w3.org/2000/svg" cx="12" cy="12" r="6.6"
                                                                    data-testid="KakaoTemplateInfoText_BulletFilledCDSIcon"><circle
                                                                        cx="12" cy="12" r="6.6"></circle></svg>검수 요청 중인 템플릿은 수정할 수 없습니다.</span>
                                                            <span
                                                                class="MuiTypography-root MuiTypography-base.body3 css-1o1jcq0"
                                                                data-testid="KakaoTemplateInfoText_Typography"><svg
                                                                    class="MuiSvgIcon-root MuiSvgIcon-fontSizeX4Small css-19ef0js"
                                                                    focusable="false" color="#616161" aria-hidden="true"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    xmlns="http://www.w3.org/2000/svg" cx="12" cy="12" r="6.6"
                                                                    data-testid="KakaoTemplateInfoText_BulletFilledCDSIcon"><circle
                                                                        cx="12" cy="12" r="6.6"></circle></svg>검수 후 승인이 완료되는 즉시 사용중으로 변경됩니다.</span>
                                                            <span
                                                                class="MuiTypography-root MuiTypography-base.body3 css-1o1jcq0"
                                                                data-testid="KakaoTemplateInfoText_Typography"><svg
                                                                    class="MuiSvgIcon-root MuiSvgIcon-fontSizeX4Small css-19ef0js"
                                                                    focusable="false" color="#616161" aria-hidden="true"
                                                                    viewBox="0 0 24 24" width="24" height="24"
                                                                    xmlns="http://www.w3.org/2000/svg" cx="12" cy="12" r="6.6"
                                                                    data-testid="KakaoTemplateInfoText_BulletFilledCDSIcon"><circle
                                                                        cx="12" cy="12" r="6.6"></circle></svg>모든 입력창에서 이모티콘 사용 불가능합니다.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="customer-sms-tab">
                                                <textarea class="main-text-txt-area" id="customer-sms-textarea"
                                                          style="height:250px;"
                                                          onkeyup="PopupSetupFormATextTemplateForm.main_text_keyup(this)"></textarea>
                                                <div class="keyboard-btn">
                                                    <ul class="mid_btn">
                                                        @foreach ($formA['ReplaceStringVars'] as $option)
                                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'ReplaceString')">{{ $option['Caption'] }}</button>
                                                        @endforeach
                                                    </ul>

                                                    <div class="charater">
                                                        @foreach ($formA['SpecialCharVars'] as $option)
                                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'SpecialChar')">{{ $option['Caption'] }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="tab-pane fade" id="admin-tab">
                                <div class="align-items-center mt-2 d-flex">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1"
                                           id="admin-send-check"> <label class="mb-0" for="admin-send-check">관리자에게
                                        송신</label>
                                </div>
                                <hr class="mt-2">
                                <textarea class="main-text-txt-area" id="admin-sms-textarea" style="height:250px;"
                                          onkeyup="PopupSetupFormATextTemplateForm.main_text_keyup(this)"></textarea>
                                <div class="keyboard-btn">
                                    <ul class="mid_btn">
                                        @foreach ($formA['ReplaceStringVars'] as $option)
                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'ReplaceString')">{{ $option['Caption'] }}</button>
                                        @endforeach
                                    </ul>

                                    <div class="charater">
                                        @foreach ($formA['SpecialCharVars'] as $option)
                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'SpecialChar')">{{ $option['Caption'] }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="supplier-tab">
                                <div class="align-items-center mt-2 d-flex">
                                    <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1"
                                           id="supplier-send-check"> <label class="mb-0" for="supplier-send-check">공급자에게
                                        송신</label>
                                </div>
                                <hr class="mt-2">
                                <textarea class="main-text-txt-area" id="supplier-sms-textarea" style="height:250px;"
                                          onkeyup="PopupSetupFormATextTemplateForm.main_text_keyup(this)"></textarea>
                                <div class="keyboard-btn">
                                    <ul class="mid_btn">
                                        @foreach ($formA['ReplaceStringVars'] as $option)
                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'ReplaceString')">{{ $option['Caption'] }}</button>
                                        @endforeach
                                    </ul>

                                    <div class="charater">
                                        @foreach ($formA['SpecialCharVars'] as $option)
                                            <button type="button" data-value="{{ $option['Value'] }}"
                                                    onclick="PopupSetupFormATextTemplateForm.keyboard_click(this, 'SpecialChar')">{{ $option['Caption'] }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--// 핸드폰 영역 끝 -->

            </div>
        </div>
    </div>
{{--@endsection--}}

@once
{{--    @push('js')--}}
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(async function () {
                $('#modal-select-popup').on('hidden.bs.modal', function () {
                    PopupSetupFormATextTemplateForm.close_popup();
                });

                // 탭 클릭 시 이벤트 처리
                $('.nav-tabs a').on('shown.bs.tab', function() {
                    // 현재 탭의 활성화된 textarea에서 keyup 이벤트 트리거
                    $(this.hash).find('.main-text-txt-area').each(function() {
                        PopupSetupFormATextTemplateForm.main_text_keyup(this);
                    });
                });

                $('#text-template-btn-group').find('.text-template-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch ($(this).data('value')) {
                        case 'save':
                            PopupSetupFormATextTemplateForm.btn_act_save(true);
                            break;
                        case 'del':
                            PopupSetupFormATextTemplateForm.btn_act_del();
                            break;
                        case 'show-popup':
                            PopupSetupFormATextTemplateForm.show_popup('/sms-popup');
                            break;
                    }
                });
                // 테스트 후 지워야함
                // await PopupSetupFormATextTemplateForm.fetch_text_template(832);
            });

            (function (PopupSetupFormATextTemplateForm, $, undefined) {
                PopupSetupFormATextTemplateForm.formA = {!! json_encode($formA) !!};
                PopupSetupFormATextTemplateForm.parentParameters = [];
                PopupSetupFormATextTemplateForm.setup = null;
                PopupSetupFormATextTemplateForm.popupWindow = null;

                PopupSetupFormATextTemplateForm.close_popup = function () {
                    // popupWindow가 열려 있는지 확인하고 닫기
                    if (PopupSetupFormATextTemplateForm.popupWindow && !PopupSetupFormATextTemplateForm.popupWindow.closed) {
                        PopupSetupFormATextTemplateForm.popupWindow.close();
                    }
                }

                PopupSetupFormATextTemplateForm.show_popup = function (url, isEdit = false, index = null) {
                    const id = $('#text-template-form').find('#Id').val();
                    // 테스트 후 지워야함
                    // const id = 832;

                    // 각 모니터의 넓이와 높이 가져오기
                    const screenWidth = window.screen.availWidth;
                    const screenHeight = window.screen.availHeight;

                    // 팝업 창 크기 설정 (예: 모니터의 80%로 설정)
                    const popupWidth = screenWidth * 0.8;
                    const popupHeight = screenHeight * 0.8;

                    let popupUrl = url;
                    if (url !== '/sms-popup') {
                        popupUrl = url + `?id=${id}`;
                        if (isEdit && index !== null) {
                            popupUrl += `&edit=true&index=${index}`;
                        }
                    }

                    PopupSetupFormATextTemplateForm.popupWindow = window.open(popupUrl, '카카오알림톡 메시지 수정',
                        `width=${popupWidth}, height=${popupHeight}, left=10, top=10`);
                }


                PopupSetupFormATextTemplateForm.btn_act_new_callback = function () {
                    PopupSetupFormATextTemplateForm.btn_act_new()
                }

                PopupSetupFormATextTemplateForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-setup-form-a-text-template-form .modal-dialog').css('maxWidth', '900px');
                    $('#modal-select-popup.popup-setup-form-a-text-template-form .MuiTableCell-root button').removeClass('bg-original-purple')
                    $('#modal-select-popup.popup-setup-form-a-text-template-form .MuiTableCell-root button').removeClass('border-original-purple')
                    $('#modal-select-popup.popup-setup-form-a-text-template-form .MuiTableCell-root button').removeClass('bg-original-purple-hover')
                    Atype.btn_act_new('#text-template-form #frm');
                    PopupSetupFormATextTemplateForm.setup = null;
                    PopupSetupFormATextTemplateForm.popupWindow = null;
                    PopupSetupFormATextTemplateForm.close_popup();
                    $('tbody[data-testid="KakaoTemplateTable_TableBody"]').empty();
                }

                PopupSetupFormATextTemplateForm.btn_act_save = function (message = false) {
                    Atype.set_parameter_callback(PopupSetupFormATextTemplateForm.parameter);

                    Atype.btn_act_save('#text-template-form #frm', function () {
                        PopupSetupFormATextTemplateForm.close_popup();
                        if (message) {
                            iziToast.success({
                                title: 'Success',
                                message: $('#action-completed').text(),
                            });
                        }
                        $('#modal-select-popup.show').trigger('list.requery')
                        // $('#modal-select-popup.show').modal('hide');
                    }, 'PopupSetupFormATextTemplateForm', false);
                }

                PopupSetupFormATextTemplateForm.btn_act_del = function () {
                    Atype.btn_act_del('#text-template-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery')
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupSetupFormATextTemplateForm');
                }

                PopupSetupFormATextTemplateForm.main_text_keyup = function ($this) {
                    $('#text-template-form').find('.cur-byte').text(Number(getByte($($this).val())))
                }

                PopupSetupFormATextTemplateForm.keyboard_click = function ($this, type) {
                    const txt = $($this).closest('.tab-pane').find('.main-text-txt-area').val();
                    let value = $($this).data('value');

                    if (type == 'ReplaceString') {
                        value = `[${value}]`
                    }
                    $($this).closest('.tab-pane').find('.main-text-txt-area').val(txt + value)
                    PopupSetupFormATextTemplateForm.main_text_keyup($($this).closest('.tab-pane').find('.main-text-txt-area'))
                }

                PopupSetupFormATextTemplateForm.setup_json_data = function () {
                    const textTemplateForm = $('#text-template-form');
                    return {
                        TextCode: $(textTemplateForm).find('#text-code-txt').val(), // 텍스트 코드
                        TextName: $(textTemplateForm).find('#text-name-txt').val(), // 텍스트 이름
                        TextDesc: $(textTemplateForm).find('#text-desc-txt').val(), // 텍스트 설명
                        SendToCustomer: $(textTemplateForm).find('#customer-send-check').is(':checked'), // 고객에게 송신
                        CustomerMessage: $(textTemplateForm).find('#customer-sms-textarea').val(), // 고객 SMS/LMS
                        SendToAdmin: $(textTemplateForm).find('#admin-send-check').is(':checked'), // 관리자에게 송신
                        AdminMessage: $(textTemplateForm).find('#admin-sms-textarea').val(), // 관리자 SMS/LMS
                        SendToSupplier: $(textTemplateForm).find('#supplier-send-check').is(':checked'), // 공급자에게 송신
                        SupplierMessage: $(textTemplateForm).find('#supplier-sms-textarea').val(), // 공급자 SMS/LMS
                        AlertTalkTemplateList: (PopupSetupFormATextTemplateForm.setup && PopupSetupFormATextTemplateForm.setup['AlertTalkTemplateList']) || [] // 기본값 배열 설정
                    }
                }

                PopupSetupFormATextTemplateForm.parameter = function () {
                    let id = Number($('#text-template-form').find('#Id').val());
                    console.log('save_id : ', id);
                    let parameter = {
                        Id: id,
                        CreatedOn: get_now_time_stamp(),
                        UpdatedOn: get_now_time_stamp(),
                        SetupJson: JSON.stringify(PopupSetupFormATextTemplateForm.setup_json_data()),
                    }
                    if (id < 0) {
                        parameter = {Id: id}
                    } else if (id > 0) {
                        delete parameter.CreatedOn;
                    } else {
                        delete parameter.UpdatedOn;
                    }

                    console.log(PopupSetupFormATextTemplateForm.setup_json_data())
                    return parameter;
                }

                PopupSetupFormATextTemplateForm.on_popup_close = function(id) {
                    $('tbody[data-testid="KakaoTemplateTable_TableBody"]').empty();
                    PopupSetupFormATextTemplateForm.fetch_text_template(id);
                }

                PopupSetupFormATextTemplateForm.render_template_to_table = function(templates) {
                  var $tbody = $('tbody[data-testid="KakaoTemplateTable_TableBody"]');

                  templates.forEach(function(template, index) {
                      var $tr = $('<tr>', {
                          class: 'MuiTableRow-root css-1u6a08m',
                          'data-testid': 'KakaoTemplateTable_TableRow_1'
                      });

                      // TemplateName
                      var $tdTemplateName = $('<td>', {
                          class: 'MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1gf9air'
                      }).append(
                          $('<span>', {
                              class: 'MuiTypography-root MuiTypography-base.body3 css-1o1jcq0',
                              'data-testid': 'KakaoTemplateTable_Typography_1',
                              text: template.TemplateName + (template.TemplateCode ? `(${template.TemplateCode})` : '(임시저장)')
                          })
                      );
                      $tr.append($tdTemplateName);

                      // Status
                      var $tdStatus = $('<td>', {
                          class: 'MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1gf9air'
                      }).append(
                          $('<div>', {
                              class: 'MuiStack-root css-2gj8fh',
                              'data-testid': 'KakaoTemplateTable_Stack'
                          }).append(
                              $('<div>', {
                                  class: 'mr-1 KakaoTemplateTable_Status',
                                  html: '<i class="Kakao-icoColorDot ' + PopupSetupFormATextTemplateForm.getCSSClassBasedOnStatus(template.InspStatus) + '"></i> ' +
                                      PopupSetupFormATextTemplateForm.get_insp_status_text(template.InspStatus)
                              })
                          )
                      );
                      $tr.append($tdStatus);

                      // UpdatedDate
                      var $tdUpdatedDate = $('<td>', {
                          class: 'MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1gf9air'
                      }).append(
                          $('<span>', {
                              class: 'MuiTypography-root MuiTypography-base.body3 css-1o1jcq0',
                              'data-testid': 'KakaoTemplateTable_Typography_2',
                              text: format_result(template.UpdatedDate, 'unixtime')
                          })
                      );
                      $tr.append($tdUpdatedDate);

                      // Actions
                      var $tdActions = $('<td>', {
                          class: 'MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1gf9air'
                      }).append(
                          $('<button>', {
                              class: 'py-1 mr-1',
                              type: 'button',
                              tabindex: 0,
                              text: '수정하기',
                              click: function() {
                                  PopupSetupFormATextTemplateForm.show_popup('/kakao-templates-popup', true, index);
                              }
                          }),
                          $('<button>', {
                              class: 'py-1',
                              type: 'button',
                              tabindex: 0,
                              text: '삭제하기',
                              click: function() {
                                  iziToast.question({
                                      timeout: 20000,
                                      close: false,
                                      overlay: true,
                                      displayMode: 'once',
                                      id: 'question',
                                      title: '정말로 삭제하시겠습니까?',
                                      message: '삭제 후 데이터는 복구할 수 없습니다.',
                                      position: 'center',
                                      buttons: [
                                          [`<button><b>삭제</b></button>`, async function (instance, toast) {
                                              instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                                              const textTemplateForm = $('#text-template-form');
                                              const templateCode = $(textTemplateForm).find('#text-code-txt').val();
                                              const templateName = $(textTemplateForm).find('#text-name-txt').val();

                                              if (templateCode && templateName) {
                                                  const response = await call_local_api('/notification/template/del', { TemplateCode: PopupSetupFormATextTemplateForm.setup['AlertTalkTemplateList'][index]['TemplateCode'] });
                                                  const { data, error, message } = response.data;
                                                  console.log(error);
                                                  console.log(data);

                                                  if (error) {
                                                      return iziToast.error({ title: 'Error', message: message });
                                                  }

                                                  $('tbody[data-testid="KakaoTemplateTable_TableBody"]').empty();
                                                  // 배열에서 현재 인덱스의 데이터 삭제
                                                  PopupSetupFormATextTemplateForm.setup['AlertTalkTemplateList'].splice(index, 1);

                                                  PopupSetupFormATextTemplateForm.btn_act_save();

                                                  // 테이블을 다시 렌더링
                                                  PopupSetupFormATextTemplateForm.render_template_to_table(PopupSetupFormATextTemplateForm.setup['AlertTalkTemplateList']);
                                              } else {
                                                  iziToast.info({ title: 'Info', message: '템플릿코드, 템플릿명을 입력하세요' });
                                              }
                                          }, true],
                                          [`<button>취소</button>`, function (instance, toast) {
                                              instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                                          }],
                                      ],
                                  });

                              }
                          })
                      );
                      $tr.append($tdActions);

                      $tbody.append($tr);
                  });
              }

                // TODO: 처음 셋업 열었을 때, json 데이터에서 템플릿 코드값들 가져온 후 알리고 템플릿 리스트에서 api 호출해서 상태값 업데이트 해야함
                // TODO: 상태값에 맞춰수정 필요
                PopupSetupFormATextTemplateForm.get_status_text = function(statusCode) {
                    console.log(statusCode)
                    switch(statusCode) {
                        case 'S':
                            return '중단';
                        case 'A':
                            return '정상';
                        case 'R':
                            return '대기';
                        default:
                            return '알 수 없음';
                    }
                }

                PopupSetupFormATextTemplateForm.get_insp_status_text = function(inspStatusCode) {
                    switch(inspStatusCode) {
                        case 'REG':
                            return '검수 전';
                        case 'REQ':
                            return '검수 중';
                        case 'APR':
                            return '사용중';
                        case 'REJ':
                            return '승인 거부';
                        default:
                            return '알 수 없음';
                    }
                }

                // Status에 따른 CSS 클래스를 반환하는 함수
                PopupSetupFormATextTemplateForm.getCSSClassBasedOnStatus = function(inspStatusCode) {
                    switch(inspStatusCode) {
                        case 'REQ':
                            return 'yellow';
                        case 'APR':
                            return 'green';
                        case 'REJ':
                            return 'red';
                        case 'REG':
                        default:
                            return ''; // 기본 상태
                    }
                }

                PopupSetupFormATextTemplateForm.show_popup_callback = async function (id, setup_json, brand_code, parameters) {
                    PopupSetupFormATextTemplateForm.parentParameters = parameters
                    PopupSetupFormATextTemplateForm.btn_act_new()
                    $('#text-template-form').find('#Id').val(id)
                    $('#text-template-form').find('#text-code-txt').val(brand_code)
                    let text_name = $('#modal-select-popup.popup-setup-form-a-text-template-form #myModalLabel').text();
                    if (text_name.startsWith('문자템플릿-')) {
                        text_name = text_name.substring('문자템플릿-'.length); // '문자템플릿-' 제거
                    }
                    $('#text-template-form').find('#text-name-txt').val(text_name)
                    PopupSetupFormATextTemplateForm.set_text_template_ui(id, setup_json);
                }

                PopupSetupFormATextTemplateForm.fetch_text_template = async function (id) {
                    const response = await get_api_data(PopupSetupFormATextTemplateForm.formA['General']['PickApi'], {
                        Page: [{Id: Number(id)}]
                    })

                    const json = response.data.Page[0]['SetupJson']
                    const setup = json ? JSON.parse(json) : null;
                    PopupSetupFormATextTemplateForm.set_text_template_ui(id, setup)
                }

                PopupSetupFormATextTemplateForm.set_text_template_ui = async function (id, setup) {
                    if (_.isEmpty(setup)) return;
                    console.log(id, setup)

                    PopupSetupFormATextTemplateForm.setup = setup
                    $('#text-template-form').find('#Id').val(id)
                    if (setup.TextName != null && setup.TextName != '') {
                        $('#text-template-form').find('#text-name-txt').val(setup.TextName)
                    }

                    $('#text-template-form').find('#customer-send-check').prop('checked', setup.SendToCustomer)
                    $('#text-template-form').find('#customer-sms-textarea').val(setup.CustomerMessage)
                    $('#text-template-form').find('#admin-send-check').prop('checked', setup.SendToAdmin)
                    $('#text-template-form').find('#admin-sms-textarea').val(setup.AdminMessage)
                    $('#text-template-form').find('#supplier-send-check').prop('checked', setup.SendToSupplier)
                    $('#text-template-form').find('#supplier-sms-textarea').val(setup.SupplierMessage)
                    $('#text-template-form').find('#text-desc-txt').val(setup.TextDesc)


                    $('#text-template-form').find('.nav-tabs-solid .main-text-tab a').trigger('click')
                    PopupSetupFormATextTemplateForm.main_text_keyup($('#text-template-form').find('.main-text-txt-area'))

                    if (setup['AlertTalkTemplateList']) {
                        const response = await call_local_api('/notification/template/list', { });
                        const { list, error, message } = response.data;
                        console.log(list);
                        if (error) {
                            return iziToast.error({ title: 'Error', message: message });
                        }

                        let isUpdated = false;

                        // Status와 inspStatus 업데이트
                        const alertTalkTemplateList = [];
                        setup['AlertTalkTemplateList'].forEach(template => {
                            const matchingTemplate = list.find(item => item.templtCode === template.TemplateCode);
                            if (matchingTemplate) {
                                // 기존 객체의 속성 업데이트
                                template.Status = matchingTemplate.status;
                                template.InspStatus = matchingTemplate.inspStatus;
                                alertTalkTemplateList.push(template)
                                isUpdated = true; // Update 발생
                            }
                        });

                        setup['AlertTalkTemplateList'] = alertTalkTemplateList
                        // 업데이트가 발생한 경우에만 버튼 동작 호출
                        if (isUpdated) {
                            console.log('isUpdated')
                            PopupSetupFormATextTemplateForm.btn_act_save();
                        }
                        console.log(setup['AlertTalkTemplateList'])

                        PopupSetupFormATextTemplateForm.render_template_to_table(setup['AlertTalkTemplateList'])

                    }
                }

            }(window.PopupSetupFormATextTemplateForm = window.PopupSetupFormATextTemplateForm || {}, jQuery));
        </script>
{{--    @endpush--}}
@endonce
