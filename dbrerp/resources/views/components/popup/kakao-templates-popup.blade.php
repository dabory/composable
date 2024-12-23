<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="next-head-count" content="2">
    <link rel="preload" href="/css/kakao-templates-popup.css" as="style">
    <link rel="stylesheet" href="/css/kakao-templates-popup.css" data-n-g="">
    <title>카카오알림톡 메시지 수정</title>
    @include('partial.site.scripts')
</head>
<body id="popup" class="kakao">
<div id="__next" data-reactroot="">
    <div id="wrap">
        <form enctype="multipart/form-data">
            <div class="Kakao-headingArea">
                <div class="Kakao-mTitle"><h1>카카오알림톡 메시지 수정</h1><a
                        href="https://support.cafe24.com/hc/ko/articles/10938221875737" class="btnManual"
                        target="_blank" title="새창 열림" rel="noreferrer">가이드</a></div>
            </div>
            <div class="Kakao-mBox typeBorder">
                <div class="Kakao-mInfo"><em class="Kakao-icoNotice"></em>
                    <div class="content">문구, 버튼, URL 링크 등 메시지를 수정하면 검수가 완료되어야 고객에게 발송할 수 있어요. 수정 후 ‘검수 요청’ 버튼을 눌러주세요.
                    </div>
                    <div class="control">
                        <button type="button" class="Kakao-btnClose eClose"
                                onclick="$('.Kakao-mBox.typeBorder').hide()">삭제
                        </button>
                    </div>
                </div>
            </div>
            <div class="kakaoAlarmArea">
                <div class="contentArea">
                    <div class="Kakao-section">
                        <div class="Kakao-mTitle"><h2>기본 정보</h2></div>
                        <div class="Kakao-mSectionCtrl"><a
                                href="https://kakaobusiness.gitbook.io/main/ad/bizmessage/notice-friend/content-guide"
                                class="Kakao-btnTxtLink" target="_blank" rel="noreferrer">제작 가이드 보기<i
                                    class="Kakao-icoTarget"></i></a></div>
                        <div class="Kakao-mBoard">
                            <table summary="">
                                <caption>기본 정보</caption>
                                <colgroup>
                                    <col style="width: 160px;">
                                    <col style="width: auto;">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th scope="row">템플릿 이름</th>
                                    <td id="template-name"></td>
                                </tr>
                                <tr>
                                    <th scope="row">템플릿 상태</th>
                                    <td>
                                        <div class="MuiStack-root css-2gj8fh" id="template-status"
                                             data-testid="KakaoTemplateTable_Stack">
{{--                                            <div class="mr-1"><i class="Kakao-icoColorDot"></i> 검수 전</div>--}}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="Kakao-section">
                        <div class="Kakao-mTitle"><h2>강조 유형</h2></div>
                        <div class="Kakao-mForm eAddForm"><label class="Kakao-fLabel"><input name="emphasizeType"
                                                                                             class="Kakao-fCheck"
                                                                                             type="radio"
                                                                                             checked
                                                                                             value="N"><span
                                    class="text">선택 안 함</span><span class="checkMark"></span></label><label
                                class="Kakao-fLabel"><input name="emphasizeType" class="Kakao-fCheck" type="radio"
                                                            value="T"><span class="text">강조 표기형</span><span
                                    class="checkMark"></span></label><label class="Kakao-fLabel"><input
                                    name="emphasizeType" class="Kakao-fCheck" type="radio" value="L"><span class="text">이미지형</span><span
                                    class="checkMark"></span></label>
{{--                            <label class="Kakao-fLabel"><input--}}
{{--                                    name="emphasizeType" class="Kakao-fCheck" type="radio" value="I" disabled><span--}}
{{--                                    class="text">아이템 리스트</span><span--}}
{{--                                    class="checkMark"></span></label>--}}

                            <div class="Kakao-addForm titleArea">
                                <div class="Kakao-mField">
                                    <div class="fieldForm">
                                        <div class="field">
                                            <div class="fieldTitle"><strong class="subTitle">부제목</strong></div>
                                            <div class="fieldForm"><input name="textSubtitle" class="Kakao-fText"
                                                                          data-max-length="18"
                                                                          placeholder="제목에 대한 부연 설명을 작성해 주세요" value=""
                                                                          style="width: 100%;"><span
                                                    class="Kakao-txtByte"
                                                    title="현재글자수/최대글자수">[ <strong>0</strong> / 18 ]</span>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="fieldTitle"><strong class="subTitle">제목 </strong>
                                                <button type="button" class="Kakao-btnLabel" onclick="showPopup()">사용 가능
                                                    변수
                                                </button>
                                            </div>
                                            <div class="fieldForm"><input name="textTitle" class="Kakao-fText"
                                                                          data-max-length="23"
                                                                          placeholder="본문 중 고객에게 강조할 내용을 작성해 주세요"
                                                                          value="" style="width: 100%;"><span
                                                    class="Kakao-txtByte"
                                                    title="현재글자수/최대글자수">[ <strong>0</strong> / 23 ]</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="Kakao-addForm thumb">
                                <div class="Kakao-mField">
                                    <div class="field">
                                        <div class="fieldTitle"><strong class="subTitle">상단 이미지</strong></div>
                                        <div class="fieldForm">
                                            <div class="Kakao-mFileUploader">
                                                <div class="uploadBox"><label>
                                                        <div class="upload"><span
                                                                class="Kakao-btnNormal small">이미지선택</span><span
                                                                class="desc">또는 이미지 끌어 놓기</span></div>
                                                        <input name="topUrl" type="file" accept="image/*"></label></div>
                                                <p class="Kakao-txtInfo"><i class="Kakao-icoInfo"></i> 이미지는 최대 1개만 등록
                                                    가능합니다. / 가로 800 px * 세로 400px / 용량 500KB 이하 / png, jpg</p><a
                                                    href="https://kakaobusiness.gitbook.io/main/ad/bizmessage/notice-friend/content-guide/image"
                                                    class="Kakao-btnTxtLink" target="_blank" rel="noreferrer">이미지 가이드 보기<i
                                                        class="Kakao-icoTarget"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Kakao-section">
                        <div class="Kakao-mTitle"><h2>메시지 유형</h2></div>
                        <div class="Kakao-mForm">
                            <label class="Kakao-fLabel">
                                <input name="templateType" class="Kakao-fCheck" type="radio"
                                    checked
                                    value="B">
                                <span class="text">기본형</span>
                                <span class="checkMark"></span>
                            </label>
                        <label
                                class="Kakao-fLabel"><input name="templateType" class="Kakao-fCheck" type="radio"
                                                            value="E"><span class="text">부가 정보형</span><span
                                    class="checkMark"></span></label><label class="Kakao-fLabel"><input
                                    name="templateType" class="Kakao-fCheck" type="radio" value="A"><span class="text">채널 추가형</span><span
                                    class="checkMark"></span></label><label class="Kakao-fLabel"><input
                                    name="templateType" class="Kakao-fCheck" type="radio" value="M"><span class="text">복합형</span><span
                                    class="checkMark"></span></label>
                            <div class="Kakao-addForm show">
                                <div class="Kakao-mField">
                                    <div class="fieldTitle"><h3 class="title">메시지 내용</h3><span class="Kakao-txtByte"
                                                                                               title="현재글자수/최대글자수">(0/1000)</span>
                                    </div>
                                    <div class="fieldForm">
                                        <div class="field">
                                            <div class="fieldTitle"><strong class="subTitle">본문 </strong>
                                                <button type="button" class="Kakao-btnLabel" onclick="showPopup()">사용 가능
                                                    변수
                                                </button>
                                            </div>
                                            <div class="fieldForm"><textarea class="Kakao-fTextarea"
                                                                             placeholder="변수, URL 포함 1,000자 이내로 작성해 주세요"
                                                                             cols="30" rows="6"
                                                                             data-max-length="1000"
                                                                             name="contents"></textarea><span
                                                    class="Kakao-txtByte" title="현재글자수/최대글자수">[ <strong>0</strong> / 1,000 ]</span>
                                            </div>
                                        </div>

                                        <div class="field add" style="display: none;">
                                            <div class="fieldTitle"><strong class="subTitle">부가 정보</strong></div>
                                            <div class="fieldForm"><textarea class="Kakao-fTextarea"
                                                                             placeholder="URL 포함 500자 이내로 작성해 주세요"
                                                                             cols="30" rows="3"
                                                                             data-max-length="500"
                                                                             name="contentsExtra"></textarea><span
                                                    class="Kakao-txtByte" title="현재글자수/최대글자수">[ <strong>0</strong> / 500 ]</span>
                                            </div>
                                        </div>

                                        <div class="field channel" style="display: none;">
                                            <div class="fieldTitle"><strong class="subTitle">채널 추가 문구(고정)</strong></div>
                                            <div class="fieldForm"><input class="Kakao-fText"
                                                                          data-max-length="36"
                                                                          placeholder="채널 추가하고 이 채널의 광고와 마케팅 메시지를 카카오톡으로 받기"
                                                                          disabled="" style="width: 100%;"><span
                                                    class="Kakao-txtByte" title="현재글자수/최대글자수">[ <strong>36</strong> / 36 ]</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Kakao-section">
                        <div class="Kakao-mTitle"><h2>버튼</h2></div>
                        <div class="Kakao-mForm">
                            <div role="group"><label class="Kakao-fLabel"><input name="btnUsedType" class="Kakao-fCheck"
                                                                                 type="radio" value="T"><span
                                        class="text">사용함</span><span class="checkMark"></span></label><label
                                    class="Kakao-fLabel"><input name="btnUsedType" class="Kakao-fCheck" type="radio"
                                                                value="F" checked=""><span
                                        class="text">사용 안 함</span><span class="checkMark"></span></label></div>

                            <div class="Kakao-addForm">
                                <div class="Kakao-mFieldList">
                                    <ul class="fieldList">

                                    </ul>
                                    <div class="fieldButton">
                                        <button type="button" class="Kakao-txtLink">항목 추가<i class="Kakao-icoAdd"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Kakao-mButton">
                        <button type="button" class="Kakao-btnEm medium" disabled>임시저장</button>
                        <button type="button" class="Kakao-btnSubmit medium" disabled>검수 요청</button>
                    </div>
                </div>
                <div class="asideArea">
                    <div class="sticky">
                        <div class="preview">
                            <div class="headArea">
                                <div class="title"><h2>미리보기</h2></div>
                                {{--                                <div class="ctrl"><a class="Kakao-btnNormal small eBtnToggle" style="cursor: pointer;">변수--}}
                                {{--                                        보기</a></div>--}}
                            </div>
                            <div class="Kakao-mKakaoPreview">
                                <div class="profile">
                                    <div class="thumb"><img width="80"
                                                            src="/images/logo2.png"
                                                            alt="dabory profile"></div>
                                </div>
                                <div class="profile right"><img width="30"
                                                                src="/images/logo_kakao.svg"
                                                                alt="kakao profile"></div>
                                <div class="box">
                                    <div class="title"><strong>알림톡 도착</strong></div>
                                    <div class="info">
                                        <div style="display: none;">
                                            <div class="thumb"><img src="/images/defaultTop.3811d8b6.svg"
                                                                    class="mCS_img_loaded"></div>
                                            <div class="payment"><strong class="payTitle placeholder">헤더(변수 사용
                                                    가능)</strong>
                                                <div class="prdInfo">
                                                    <div class="text"><span
                                                            class="prdName placeholder">아이템 하이라이트 제목</span><span
                                                            class="category placeholder">아이템 하이라이트 부가 정보</span></div>
                                                    <div class="prdThumb"><img
                                                            src="/images/defaultThumbnail.87f2b192.svg"
                                                            class="mCS_img_loaded"></div>
                                                </div>
                                                <ul class="amountList">
                                                    <li><p></p><span class="item placeholder">아이템제목1</span><span
                                                            class="count placeholder">아이템내용1</span></li>
                                                    <li><p></p><span class="item placeholder">아이템제목2</span><span
                                                            class="count placeholder">아이템내용2</span></li>
                                                    <li><span class="item placeholder">아이템 요약 제목</span><span
                                                            class="total placeholder">아이템 요약 내용</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="thumb" style="display: none;"><img
                                                src="/images/defaultTop.3811d8b6.svg"
                                                class="mCS_img_loaded"></div>
                                        <div class="titleArea" style="display: none;"><span
                                                class="summary">부제목</span><strong class="infoTitle placeholder">제목(변수 사용
                                                가능)</strong></div>
                                        <div class="descArea">
                                            <span class="basic placeholder">본문은 변수, URL 포함 한/영 구분 없이 1000자 이내로 적어주세요. 변수는 [변수] 형태로 띄어쓰기 없이 입력해주세요.</span>
                                            <div class="txtKakaoInfo add placeholder" style="display: none;">부가정보는 URL 포함하여 한/영 구분 없이 500자 이내로
                                                적어주세요.
                                            </div>
                                            <p class="txtKakaoInfo channel" style="display: none;">채널 추가하고 이 채널의 광고와 마케팅 메시지를 카카오톡으로 받기</p>
                                        </div>
                                        <div class="button">
{{--                                            <a class="btnAddChannel"><em class="icoChannel"></em>채널 추가</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Kakao-mTipBox">
                            <div class="info"><i class="Kakao-icoNotice"></i>
                                <div class="content">미리 보기는 실제와 다를 수 있어요.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<script>
    let Setup;
    const IsEdit = getParameterByName('edit') === 'true';
    const Index = getParameterByName('index');

    // 채널 추가 버튼 추가 함수
    function addChannelButton() {
        const $fieldList = $('.fieldList');
        // 이미 '채널 추가' 유형의 버튼이 있는지 체크
        if ($fieldList.find('select[name="btnInfo[].btnType"]').val() === 'AC') {
            return; // 이미 있으므로 추가하지 않음
        }
        const $newNode = $(`
    <li>
        <div class="titleArea">
            <div class="gLeft"><strong class="itemTitle">버튼 유형</strong></div>
        </div>
        <div class="selectArea">
            <select name="btnInfo[].btnType" class="Kakao-fSelect">
                <option value="AC">채널 추가</option>
            </select>
        </div>
        <p class="Kakao-txtInfo">채널 추가형, 복합형을 메시지를 사용하는 경우 첫번째 버튼은 채널 추가 버튼이 사용되어요.</p>
        <ul class="addField">
            <li>
                <div class="fieldTitle"><strong class="title">버튼 이름</strong></div>
                <div class="fieldForm"><input name="btnInfo[].btnName" class="Kakao-fText placeholder" placeholder="채널 추가" disabled value="채널 추가" style="width: 100%;"></div>
            </li>
        </ul>
    </li>
    `);
        $fieldList.prepend($newNode);

        // 버튼 영역에 채널 추가 버튼 삽입
        const channelAddButton = $('<a class="btnAddChannel"><em class="icoChannel"></em>채널 추가</a>');
        const $buttonArea = $('.Kakao-mKakaoPreview .button');
        $buttonArea.prepend(channelAddButton);

        // 이미 존재하는 li 요소들 처리
        $fieldList.children('li').each(function(index) {
            // 첫 번째 li는 처리하지 않음
            if (index !== 0) {
                // 삭제 버튼이 없으면 추가
                if (!$(this).find('.Kakao-btnNormal').length) {
                    const deleteButton = $('<button type="button" class="Kakao-btnNormal small" style="cursor: pointer;">삭제</button>');

                    // 삭제 버튼 클릭 이벤트 핸들러
                    deleteButton.click(function() {
                        const liIndex = $(this).closest('li').index();
                        $(this).closest('li').remove();
                        $('.Kakao-mKakaoPreview .button a').eq(liIndex).remove();
                    });

                    // 삭제 버튼을 해당 li의 맨 오른쪽에 추가
                    $(this).find('.titleArea .gRight').append(deleteButton);
                }
            }
        });
    }


    async function fetchTemplate() {
        const response = await get_api_data('setup-pick', {
            Page: [{Id: Number(getParameterByName('id'))}]
        })

        const setup = response.data.Page[0]
        let setupName = setup['SetupName']

        if (setupName.startsWith('문자템플릿-')) {
            setupName = setupName.substring('문자템플릿-'.length); // '문자템플릿-' 제거
        }

        $('#template-name').text(setupName)

        if(setup['SetupJson']){
            return JSON.parse(setup['SetupJson']);
        }

        return { AlertTalkTemplateList: [] };
    }

    $(document).ready(function () {
        $(".Kakao-btnEm, .Kakao-btnSubmit").click(async function(event) {
            $('.Kakao-btnEm, .Kakao-btnSubmit').prop('disabled', true);
            event.preventDefault(); // 기본 폼 제출 방지

            // 체크해야 할 강조 유형과 메시지 유형
            const emphasizeType = $('input[name="emphasizeType"]:checked').val();
            const templateType = $('input[name="templateType"]:checked').val();

            let isFormValid = true;

            // 본문은 항상 체크
            const contents = $('textarea[name="contents"]').val().trim();
            if (contents === "") {
                iziToast.info({ title: 'Info', message: '메세지 내용 본문을 입력해주세요.' });
                isFormValid = false;
            }

            // 강조표기형이고 메시지 유형이 기본형이면 제목, 부제목, 본문 모두 체크
            if (emphasizeType === "T") {
                const subtitle = $('input[name="textSubtitle"]').val().trim();
                const title = $('input[name="textTitle"]').val().trim();

                if (subtitle === "") {
                    iziToast.info({ title: 'Info', message: '부제목을 입력해주세요.' });
                    isFormValid = false;
                }

                if (title === "") {
                    iziToast.info({ title: 'Info', message: '제목을 입력해주세요.' });
                    isFormValid = false;
                }
            } else if (emphasizeType === "L") {
                const checkImageValidity = () => {
                    return new Promise((resolve, reject) => {
                        const fileInput = $('input[name="topUrl"]')[0];
                        const file = fileInput.files[0];

                        if (IsEdit)  {
                            // 수정 모드에서 이미지를 새로 선택하지 않았고 기존 이미지가 있다면 유효한 것으로 처리
                            const selectedTemplate = Setup.AlertTalkTemplateList[Index];
                            if (selectedTemplate.ImageMessage && !file) {
                                resolve(true);
                                return;
                            }
                        }

                        if (!file) {
                            iziToast.info({title: 'Info', message: '상단 이미지를 업로드해 주세요.'});
                            isFormValid = false;
                            resolve(isFormValid);
                            return;
                        }

                        const allowedTypes = ['image/png', 'image/jpeg'];
                        const isValidType = allowedTypes.includes(file.type);
                        const isValidSize = file.size <= 500 * 1024; // 500KB
                        const img = new Image();
                        img.src = URL.createObjectURL(file);

                        img.onload = function () {
                            const isValidDimensions = img.width === 800 && img.height === 400;
                            if (!isValidType || !isValidSize || !isValidDimensions) {
                                let errorMessage = '상단 이미지 오류: ';
                                if (!isValidType) {
                                    errorMessage += '지원되는 포맷이 아닙니다. (PNG, JPG만 가능) ';
                                }
                                if (!isValidSize) {
                                    errorMessage += '이미지 용량이 500KB를 초과합니다. ';
                                }
                                if (!isValidDimensions) {
                                    errorMessage += '이미지 크기가 800x400 픽셀이 아닙니다. ';
                                }
                                iziToast.info({title: 'Info', message: errorMessage});
                                isFormValid = false;
                            }
                            resolve(isFormValid);
                        };

                        img.onerror = function () {
                            iziToast.info({title: 'Info', message: '이미지를 로드하는 중 오류가 발생했습니다.'});
                            isFormValid = false;
                            resolve(isFormValid);
                        };
                    });
                };

                isFormValid = await checkImageValidity();
            }

            if (templateType === 'E' || templateType === 'M') {
                const contentsExtra = $('textarea[name="contentsExtra"]').val().trim();

                if (contentsExtra === "") {
                    iziToast.info({ title: 'Info', message: '부가정보를 입력해주세요. 부가정보를 사용하지 않을 경우, 메시지 유형을 `기본형`으로 선택해주세요.' });
                    isFormValid = false;
                }
            }

            // 버튼 유효성 검사
            $(".fieldList > li").each(function() {
                const btnType = $(this).find('.Kakao-fSelect').val();
                const btnInput = $(this).find('input[name^="btnInfo"][name$="btnName"]');
                const btnName = btnInput.length ? btnInput.val().trim() : ""; // 요소가 존재하는 경우만 trim()

                if (btnName === "") {
                    iziToast.info({ title: 'Info', message: '버튼 이름을 입력해주세요.' });
                    isFormValid = false;
                }

                const urlPattern = /^(http:\/\/|https:\/\/)/;

                if (btnType === 'WL') {
                    const mobileUrl = $(this).find('input[name="btnInfo[].btnUrlMo"]').val().trim();
                    const pcUrl = $(this).find('input[name="btnInfo[].btnUrlPc"]').val().trim();

                    if (mobileUrl === "" || pcUrl === "" || !urlPattern.test(mobileUrl) || !urlPattern.test(pcUrl)) {
                        iziToast.info({ title: 'Info', message: '웹 링크 버튼을 사용하면 Mobile과 PC URL을 필수로 입력하고, http:// 또는 https://로 시작해야 해요.' });
                        isFormValid = false;
                    }
                } else if (btnType === 'AL') {
                    const androidUrl = $(this).find('input[name="btnInfo[].btnUrlAndroid"]').val().trim();
                    const iOSUrl = $(this).find('input[name="btnInfo[].btnUrlIos"]').val().trim();

                    if (androidUrl === "" || iOSUrl === "" || !urlPattern.test(androidUrl) || !urlPattern.test(iOSUrl)) {
                        iziToast.info({ title: 'Info', message: '앱 링크 버튼을 사용하면 Android와 iOS URL을 필수로 입력하고, http:// 또는 https://로 시작해야 해요.' });
                        isFormValid = false;
                    }
                }
            });

            if (isFormValid) {
                const alertTalkTemplate = {
                    TemplateCode: '', // 템플릿 코드
                    TemplateName: $('table tbody tr:nth-child(1) td').text().trim(), // 템플릿 이름
                    Status: '', // 상태
                    InspStatus: '',
                    UpdatedDate: get_now_time_stamp(), // 업데이트일
                    EmphasizeType: $('input[name="emphasizeType"]:checked').val(), // 강조 유형
                    TemplateType: $('input[name="templateType"]:checked').val(), // 메시지 유형
                    EmphasizeSubtitle: $('input[name="textSubtitle"]').val().trim(), // 강조표기형 부제목
                    EmphasizeTitle: $('input[name="textTitle"]').val().trim(), // 강조표기형 제목
                    ImageMessage: '', // 이미지형 이미지 (이미지 관련 처리 필요)
                    MessageType: $('input[name="templateType"]:checked').val(), // 메세지 유형
                    MainContent: $('textarea[name="contents"]').val().trim(), // 본문
                    AdditionalInfo: $('textarea[name="contentsExtra"]').val().trim(), // 부가 정보
                    ChannelAddedText: '채널 추가하고 이 채널의 광고와 마케팅 메시지를 카카오톡으로 받기', // 채널 추가 문구
                    BtnUsedType: $('input[name="btnUsedType"]:checked').val(),
                    ButtonList: [] // 버튼 리스트
                };

                // 버튼 리스트 채우기
                $('.fieldList > li').each(function() {
                    const buttonName = $(this).find('input[name="btnInfo[].btnName"]').val() || '';
                    const linkType = $(this).find('select[name="btnInfo[].btnType"]').val() || '';
                    const linkMobile = $(this).find('input[name="btnInfo[].btnUrlMo"]').val() || '';
                    const linkPC = $(this).find('input[name="btnInfo[].btnUrlPc"]').val() || '';
                    const linkIOS = $(this).find('input[name="btnInfo[].btnUrlIos"]').val() || '';
                    const linkAndroid = $(this).find('input[name="btnInfo[].btnUrlAndroid"]').val() || '';

                    alertTalkTemplate.ButtonList.push({
                        ButtonName: buttonName,
                        LinkType: linkType,
                        LinkMobile: linkMobile,
                        LinkPC: linkPC,
                        LinkIOS: linkIOS,
                        LinkAndroid: linkAndroid,
                    });
                });

                if (emphasizeType === "L") {
                    const inputElement = document.querySelector('input[name="topUrl"]');
                    const file = inputElement.files[0];

                    if (IsEdit) {
                        const selectedTemplate = Setup.AlertTalkTemplateList[Index];
                        if (selectedTemplate.ImageMessage && !file) {
                            // 수정 모드에서 이미지를 새로 선택하지 않았고 기존 이미지가 있다면 기존 이미지 사용
                            alertTalkTemplate['ImageMessage'] = selectedTemplate.ImageMessage;
                        }
                    }

                    if (file) {
                        const formData = new FormData();
                        formData.append('file', file);

                        const response = await call_local_api('/upload-image', formData);
                        const data = response.data;
                        console.log(data)
                        if (data['error']) {
                            $('.Kakao-btnEm, .Kakao-btnSubmit').prop('disabled', false);
                            return iziToast.info({ title: 'Info', message: '상단 이미지 업로드에 실패했어요.' });
                        }
                        alertTalkTemplate['ImageMessage'] = data['data'];
                    }
                }

                async function handleApiResponse(apiUrl, successCallback) {
                    const response = await call_local_api(apiUrl, alertTalkTemplate);
                    const { data, error, message } = response.data;
                    console.log(error);
                    console.log(data);

                    if (error) {
                        $('.Kakao-btnEm, .Kakao-btnSubmit').prop('disabled', false);
                        iziToast.error({ title: 'Error', message: message });
                        return false;  // 에러 시 false 반환
                    }

                    if (apiUrl === '/notification/template/add' || apiUrl === '/notification/template/modify') {
                        alertTalkTemplate['TemplateCode'] = data['templtCode'];
                        alertTalkTemplate['Status'] = data['status'];
                        alertTalkTemplate['InspStatus'] = data['inspStatus'];
                    } else {
                        alertTalkTemplate['InspStatus'] = 'REQ';
                    }

                    successCallback(alertTalkTemplate);
                    return true; // 성공 시 true 반환
                }

                if (IsEdit) {
                    // 수정 모드라면 기존의 데이터를 대체
                    alertTalkTemplate['TemplateCode'] = Setup['AlertTalkTemplateList'][Index]['TemplateCode']
                    const success = await handleApiResponse('/notification/template/modify', (updatedTemplate) => {
                        Setup['AlertTalkTemplateList'][Index] = updatedTemplate;
                        console.log(Setup['AlertTalkTemplateList'][Index]);
                    });
                    if (!success) return; // 에러 시 종료
                } else {
                    // 새 데이터 추가
                    const success = await handleApiResponse('/notification/template/add', (newTemplate) => {
                        Setup['AlertTalkTemplateList'].push(newTemplate);
                    });
                    if (!success) return; // 에러 시 종료
                }

                if ($(this).hasClass('Kakao-btnSubmit')) {
                    const success = await handleApiResponse('/notification/template/request', (newTemplate) => {
                        console.log(newTemplate)
                    });
                    if (!success) return; // 에러 시 종료
                }

                // API setup-act json 저장 코드
                const response = await get_api_data('setup-act', {
                    Page: [
                        parameter(),
                    ]
                });
                // 부모 창의 함수 호출
                if (window.opener && !window.opener.closed) {
                    window.opener.PopupSetupFormATextTemplateForm.on_popup_close(getParameterByName('id'));
                }

                setTimeout(() => {
                    window.close();
                }, 3000);
                return iziToast.success({ title: 'Success', message: '임시저장 되었어요. 수정한 메시지는 카카오 검수요청이 완료되어야만 사용할 수 있어요.' });
            }

            $('.Kakao-btnEm, .Kakao-btnSubmit').prop('disabled', false);
        });

        $('input[name="btnUsedType"]').on('change', function() {
            const addForm = $(this).closest('.Kakao-section').find('.Kakao-addForm');
            const templateType = $('input[name="templateType"]:checked').val();

            if ($(this).val() === 'T') {
                // '.Kakao-txtLink'의 클릭 이벤트를 강제로 실행하여 처음 항목 추가
                if (templateType === 'A' || templateType === 'M') {
                    addChannelButton()
                } else {
                    $('.Kakao-txtLink').trigger('click');
                }
                addForm.show();

            } else {
                $('.fieldList li').remove();
                $('.Kakao-mKakaoPreview .button a').remove();
                addForm.hide();
            }
        });

        $(document).on('change', '.Kakao-fSelect', function () {
            let selectedValue = $(this).val();
            let listItem = $(this).closest('li');
            let txtInfo = listItem.find('.Kakao-txtInfo');
            let androidLi = listItem.find('li:has(.title:contains("Android"))');
            let iosLi = listItem.find('li:has(.title:contains("iOS"))');
            let btnNameLi = listItem.find('li:has(.title:contains("버튼 이름"))');
            let mobileLi = listItem.find('li:has(.title:contains("Mobile"))');
            let pcLi = listItem.find('li:has(.title:contains("PC"))');

            let otherItems = listItem.find('li').not(btnNameLi);

            otherItems.hide();
            txtInfo.hide();
            if (selectedValue === 'WL') {
                mobileLi.show();
                pcLi.show();
                btnNameLi.show(); // 모든 버튼 이름 li를 보여줌
            } else if (selectedValue === 'AL') {
                txtInfo.html('디바이스 종류에 맞는 링크가 열리고, 비워둘 경우 Mobile 또는 PC 링크로 대체되어요.').show();
                androidLi.show();
                iosLi.show();
                mobileLi.show();
                pcLi.show();
                btnNameLi.show(); // 모든 버튼 이름 li를 보여줌
            } else if (selectedValue === 'DS') {
                txtInfo.html('본문에 송장 번호([DELINUM])와 택배사 이름([DELICOM])이 반드시 들어가야 해요.<a href="https://st.sweettracker.co.kr/#/company" class="Kakao-btnTxtLink" target="_blank" rel="noreferrer"> 지원하는 택배사 확인<i class="Kakao-icoTarget"></i></a>').show();
                btnNameLi.show(); // 모든 버튼 이름 li를 보여줌
            }
        });

        $('.Kakao-txtLink').click(function () {
            const $fieldList = $('.fieldList');

            // 새로운 li 요소와 그 내부의 HTML을 생성
            const $newNode = $(`
        <li>
            <div class="titleArea">
                <div class="gLeft"><strong class="itemTitle">버튼 유형</strong></div>
                <div class="gRight">
                    <button type="button" class="Kakao-btnNormal small" style="cursor: pointer;">삭제</button>
                </div>
            </div>
            <div class="selectArea">
                <select name="btnInfo[].btnType" class="Kakao-fSelect">
                    <option value="WL">웹 링크</option>
                    <option value="AL">앱 링크</option>
                    <option value="DS">배송조회</option>
                </select>
            </div>
            <p class="Kakao-txtInfo" style="display: none;"></p>
            <ul class="addField">
                <li>
                    <div class="fieldTitle"><strong class="title">버튼 이름</strong></div>
                    <div class="fieldForm"><input name="btnInfo[].btnName" class="Kakao-fText" placeholder="버튼 이름을 입력해 주세요" value="" style="width: 100%;"></div>
                </li>
                <li style="display: none;">
                    <div class="fieldTitle"><strong class="title">Android</strong></div>
                    <div class="fieldForm"><input name="btnInfo[].btnUrlAndroid" class="Kakao-fText" placeholder="Custom Scheme://url 링크를 입력해 주세요" value="" style="width: 100%;"></div>
                </li>
                <li style="display: none;">
                    <div class="fieldTitle"><strong class="title">iOS</strong></div>
                    <div class="fieldForm"><input name="btnInfo[].btnUrlIos" class="Kakao-fText" placeholder="Custom Scheme://url 링크를 입력해 주세요" value="" style="width: 100%;"></div>
                </li>
                <li>
                    <div class="fieldTitle"><strong class="title">Mobile</strong></div>
                    <div class="fieldForm"><input name="btnInfo[].btnUrlMo" class="Kakao-fText" placeholder="http(s)://url 링크를 입력해 주세요" value="" style="width: 100%;"></div>
                </li>
                <li>
                    <div class="fieldTitle"><strong class="title">PC</strong></div>
                    <div class="fieldForm"><input name="btnInfo[].btnUrlPc" class="Kakao-fText" placeholder="http(s)://url 링크를 입력해 주세요" value="" style="width: 100%;"></div>
                </li>
            </ul>
        </li>
    `);

            // 첫 번째 항목에서 삭제 버튼 제거
            if ($fieldList.children('li').length === 0) {
                $newNode.find('.Kakao-btnNormal').remove();
            } else {
                // 삭제 버튼 클릭 이벤트 추가
                $newNode.find('.Kakao-btnNormal').click(function () {
                    // 현재 li의 인덱스를 동적으로 가져옵니다.
                    const liIndex = $(this).closest('li').index();
                    $(this).closest('li').remove();
                    // 해당 인덱스의 btnSendNormal 요소 삭제
                    $('.Kakao-mKakaoPreview .button a').eq(liIndex).remove();
                });
            }

            // 새로운 li 요소 추가
            $fieldList.append($newNode);

            const newLink = $('<a class="btnSendNormal"><span class="placeholder">웹 링크</span></a>');

            const updateButtonText = function() {
                const btnNameInput = $newNode.find('input[name="btnInfo[].btnName"]');
                const btnName = btnNameInput.val().trim();
                if (btnName) {
                    newLink.find('span.placeholder').text(btnName);
                } else {
                    const caption = $newNode.find('.Kakao-fSelect option:selected').text();
                    newLink.find('span.placeholder').text(caption);
                }
            };

            // 입력 필드에 이벤트 핸들러 추가
            $newNode.find('input[name="btnInfo[].btnName"]').on('input', updateButtonText).trigger('input');

            // 셀렉트 박스에 이벤트 핸들러 추가
            $newNode.find('.Kakao-fSelect').on('change', updateButtonText).trigger('change');

            $('.Kakao-mKakaoPreview .button').append(newLink);
        });

        let $uploadBox = $('.uploadBox');
        $('.Kakao-fTextarea, .Kakao-fText').on('input', function () {
            let maxLength = $(this).data('max-length');  // 최대 글자 수 가져오기
            let currentLength = $(this).val().length;
            $(this).siblings('.Kakao-txtByte').find('strong').text(currentLength);

            // 최대 글자 수 검사
            if (currentLength > maxLength) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });


        $('.Kakao-fTextarea').on('input', function () {
            let name = $(this).attr('name');
            let textAreaValue = $(this).val();
            let targetElement;
            let text;

            if (name === 'contents') {
                targetElement = $('.descArea .basic');
                text = "본문은 변수, URL 포함 한/영 구분 없이 1000자 이내로 적어주세요. 변수는 [변수] 형태로 띄어쓰기 없이 입력해주세요.";
            } else if (name === 'contentsExtra') {
                targetElement = $('.descArea .add');
                text = "부가정보는 URL 포함하여 한/영 구분 없이 500자 이내로 적어주세요.";
            }

            if (targetElement) {
                // \n을 <br>로 대체
                let formattedText = textAreaValue.replace(/\n/g, '<br>');

                // targetElement에 HTML로 설정
                targetElement.html(formattedText);

                // targetElement.text(textAreaValue);
                if (textAreaValue.length === 0) {
                    targetElement.text(text);
                    targetElement.addClass('placeholder');
                } else {
                    targetElement.removeClass('placeholder');
                }
            }
        });

        // 파일 선택 변경 이벤트
        $('input[name="topUrl"]').on('change', function (event) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('.thumb img.mCS_img_loaded').attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        // 드래그 앤 드롭 이벤트
        $uploadBox.on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragging');
        });

        $uploadBox.on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragging');
        });

        $uploadBox.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragging');

            let files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $('.thumb img.mCS_img_loaded').attr('src', event.target.result);
                }
                reader.readAsDataURL(files[0]);
            }
        });

        $('input[name="textSubtitle"]').on('input', function () {
            const subtitle = $(this).val();
            $('.titleArea .summary').text(subtitle);
            if (subtitle.length === 0) {
                $('.titleArea .summary').text('부제목');
            }
        });

        $('input[name="textTitle"]').on('input', function () {
            const title = $(this).val();
            $('.titleArea .infoTitle').text(title);
            if (title.length === 0) {
                $('.titleArea .infoTitle').text("제목(변수 사용 가능)");
                $('.titleArea strong').addClass('placeholder');
            } else {
                $('.titleArea .infoTitle').removeClass('placeholder');
            }
        });

        $('input[name="emphasizeType"]').on('click', function () {
            const selectedValue = $(this).val();
            switch (selectedValue) {
                case 'N':
                    $('.Kakao-mKakaoPreview .info .thumb').hide();
                    $('.Kakao-mKakaoPreview .info .titleArea').hide();

                    $('.Kakao-addForm.thumb').hide();
                    $('.Kakao-addForm.titleArea').hide();
                    break;
                case 'T':
                    $('.Kakao-mKakaoPreview .info .titleArea').show();
                    $('.Kakao-mKakaoPreview .info .thumb').hide();

                    $('.Kakao-addForm.titleArea').show();
                    $('.Kakao-addForm.thumb').hide();
                    break;
                case 'L':
                    $('.Kakao-mKakaoPreview .info .thumb').show();
                    $('.Kakao-mKakaoPreview .info .titleArea').hide();

                    $('.Kakao-addForm.thumb').show();
                    $('.Kakao-addForm.titleArea').hide();
            }
        });

        // 모든 종류의 설명 영역들을 숨기는 함수
        function hideAll() {
            $('.descArea .add').hide();
            $('.descArea .channel').hide();
            // $('.button .btnAddChannel').hide();

            $('.field.add').hide();
            $('.field.channel').hide();
        }

        // templateType이 변경될 때마다 실행될 함수
        $('input[name="templateType"]').change(function () {
            const templateType = $('input[name="templateType"]:checked').val();
            const $btnUsedTypeF = $('input[name="btnUsedType"][value="F"]');
            const $btnUsedTypeT = $('input[name="btnUsedType"][value="T"]');
            const $fieldList = $('.fieldList');

            if (templateType === 'A' || templateType === 'M') {
                $btnUsedTypeT.prop('checked', true).trigger('change');
                $btnUsedTypeF.prop('disabled', true); // '사용 안함' 라디오 버튼 비활성화
            } else {
                // 기본형 또는 부가 정보형일 경우
                $btnUsedTypeF.prop('checked', true).prop('disabled', false).trigger('change');
                $btnUsedTypeT.prop('disabled', false); // '사용함' 버튼 활성화

                // 모든 li 요소 삭제
                $fieldList.empty();
            }

            // 설명 영역 및 기타 요소들 업데이트
            hideAll();

            if (templateType === 'E') {
                // 부가 정보형일 때
                $('.descArea > .txtKakaoInfo.add').show();
                $('.field.add').show();
            } else if (templateType === 'A') {
                // 채널 추가형일 때
                $('.descArea > p.txtKakaoInfo.channel').show();
                $('.field.channel').show();
            } else if (templateType === 'M') {
                // 복합형일 때
                $('.descArea > .txtKakaoInfo.add').show();
                $('.descArea > p.txtKakaoInfo.channel').show();
                $('.field.add').show();
                $('.field.channel').show();
            }
        });

        $('input[name="templateType"]').change(function () {
            hideAll(); // 모든 설명 숨김

            let templateType = $('input[name="templateType"]:checked').val();

            if (templateType === 'E') {
                // 부가 정보형일 때
                $('.descArea > .txtKakaoInfo.add').show();
                $('.field.add').show();
            } else if (templateType === 'A') {
                // 채널 추가형일 때
                $('.descArea > p.txtKakaoInfo.channel').show();
                $('.field.channel').show();
            } else if (templateType === 'M') {
                // 복합형일 때
                $('.descArea > .txtKakaoInfo.add').show();
                $('.descArea > p.txtKakaoInfo.channel').show();

                $('.field.add').show();
                $('.field.channel').show();
            }
        });
    });

    function getStatusText(statusCode) {
        switch (statusCode) {
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

    function getInspStatusText(inspStatusCode) {
        switch (inspStatusCode) {
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

    function getCSSClassBasedOnStatus(inspStatusCode) {
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

    function updateTemplateStatus(template) {
        // let statusText = getStatusText(template.Status);
        let inspStatusText = getInspStatusText(template.InspStatus);
        let cssClass = getCSSClassBasedOnStatus(template.InspStatus);

        $('#template-status').html($('<div>', {
            class: `KakaoTemplateTable_Status mr-1`,
            html: `<i class="Kakao-icoColorDot ${cssClass}"></i> ${inspStatusText}`
        }));
    }

    $(document).ready(async function () {
        Setup = await fetchTemplate()

        if (IsEdit) {
            console.log(`수정 모드. 인덱스: ${Index}`);

            // 수정 모드에 맞게 AlertTalkTemplateList에서 데이터 가져오기
            const selectedTemplate = Setup.AlertTalkTemplateList[Index];
            updateTemplateStatus(selectedTemplate)

            if (selectedTemplate) {
                // 데이터 바인딩 예시 (적절한 요소 선택자 사용 필요)
                $('input[name="emphasizeType"][value="' + selectedTemplate.EmphasizeType + '"]').prop('checked', true);
                $('input[name="templateType"][value="' + selectedTemplate.TemplateType + '"]').prop('checked', true);
                $('input[name="templateType"]:checked').trigger('change');
                $('input[name="btnUsedType"][value="' + selectedTemplate.BtnUsedType + '"]').prop('checked', true);
                $('input[name="textSubtitle"]').val(selectedTemplate.EmphasizeSubtitle).trigger('input');
                $('input[name="textTitle"]').val(selectedTemplate.EmphasizeTitle).trigger('input');
                $('textarea[name="contents"]').val(selectedTemplate.MainContent).trigger('input');
                $('textarea[name="contentsExtra"]').val(selectedTemplate.AdditionalInfo).trigger('input');
                if (selectedTemplate.ImageMessage) {
                    $('img.mCS_img_loaded').attr('src', selectedTemplate.ImageMessage);
                }


                if (selectedTemplate.BtnUsedType === 'T') {
                    $('input[name="btnUsedType"]').closest('.Kakao-section').find('.Kakao-addForm').show()
                }
                selectedTemplate.ButtonList.forEach((button, idx) => {
                    // 새로운 버튼을 추가하는 클릭 이벤트
                    if (idx === 0 && (selectedTemplate.TemplateType === 'A' || selectedTemplate.TemplateType === 'M')) {
                        addChannelButton()
                    } else {
                        console.log('sas')
                        $('.Kakao-txtLink').trigger('click');
                    }

                    const $buttonContainer = $(".fieldList > li").eq(idx);
                    $buttonContainer.find('input[name="btnInfo[].btnName"]').val(button.ButtonName);
                    $buttonContainer.find('select[name="btnInfo[].btnType"]').val(button.LinkType);
                    $buttonContainer.find('input[name="btnInfo[].btnUrlMo"]').val(button.LinkMobile);
                    $buttonContainer.find('input[name="btnInfo[].btnUrlPc"]').val(button.LinkPC);
                    $buttonContainer.find('input[name="btnInfo[].btnUrlIos"]').val(button.LinkIOS);
                    $buttonContainer.find('input[name="btnInfo[].btnUrlAndroid"]').val(button.LinkAndroid);
                });

                $('.Kakao-fSelect').trigger('change');
            }
        } else {
            $('#template-status').html($('<div>', {
                class: `KakaoTemplateTable_Status mr-1`,
                html: `<i class="Kakao-icoColorDot"></i> 대기(작성)`
            }));
            $('input[name="templateType"]:checked').trigger('change');
        }

        // 페이지 로딩 시 초기 상태를 설정합니다.
        $('input[name="emphasizeType"]:checked').trigger('click');

        $('input, textarea').on('input change', function() {
            $('.Kakao-btnEm, .Kakao-btnSubmit').prop('disabled', false);
        });
    });

    function parameter() {
        console.log(Setup)
        let id = Number(getParameterByName('id'));
        let parameter = {
            Id: id,
            CreatedOn: get_now_time_stamp(),
            UpdatedOn: get_now_time_stamp(),
            SetupJson: JSON.stringify(Setup),
        }
        if (id < 0) {
            parameter = {Id: id}
        } else if (id > 0) {
            delete parameter.CreatedOn;
        } else {
            delete parameter.UpdatedOn;
        }

        // console.log(parameter)
        return parameter;
    }

    function showPopup() {
        // 각 모니터의 넓이와 높이 가져오기
        const screenWidth = window.screen.availWidth;
        const screenHeight = window.screen.availHeight;

        // 팝업 창 크기 설정 (예: 모니터의 80%로 설정)
        const popupWidth = screenWidth * 0.8;
        const popupHeight = screenHeight * 0.8;

        window.open('sms-popup', '사용 가능한 변수 보기', `width=${popupWidth}, height=${popupHeight}, left=10, top=10`);

    }
</script>

