{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary member-company-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'member-company-act',
        ])
    </div>
</div>
<div class="card p-2 mb-2" id="member-company-form">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>

    <input type="hidden" id="Id" name="Id" value="0">
    <input type="hidden" id="BuyerId" name="BuyerId" value="0">

    <div class="card-header">
        <div class="row">
            <!-- 왼쪽 컬럼 -->
            <div class="col-md-6 col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
                            <input type="text" id="company-name-txt" class="rounded w-100" autocomplete="off" maxlength="" readonly>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                            <input type="text" id="email-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Email'] }}"
                                {{ $formA['FormVars']['Required']['Email'] }} readonly>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                            <div class="d-flex align-items-center">
                                <input type="text" id="mobile-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
                                {{ $formA['FormVars']['Required']['MobileNo'] }} placeholder="인증번호를 입력해주세요.">
                                <span class="btn_wrap js_btn_wrapper mt-0">
                                    <button type="button" id="cert-send-btn" class="btn btn-sm btn-dark text-white certi-btn" onclick="PopupPopupForm1FormAMemberSellerEditForm.send_verify_code(this)">인증번호발송</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CertCode'] }}</label>
                            <div class="d-flex align-items-center">
                                <input type="text" id="cert-number-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['CertCode'] }}"
                                {{ $formA['FormVars']['Required']['CertCode'] }} placeholder="인증번호를 입력해주세요.">
                                <span class="btn_wrap js_btn_wrapper mt-0">
                                    <button type="button" id="cert-verify-btn" class="btn btn-sm btn-dark text-white certi-btn" onclick="PopupPopupForm1FormAMemberSellerEditForm.check_verify_code()">확인</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--//왼쪽 컬럼 끝 -->

            <!-- 오른쪽 컬럼 -->
            <div class="col-md-6 col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">주민등록번호</label>
                            <div class="d-flex align-items-center">
                                <input type="text" id="ssn1-txt" class="rounded w-100" autocomplete="off">
                                <labe class="mx-1">-</labe>
                                <input type="text" id="ssn2-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">임금은행</label>
                            <input type="text" id="bank-name-txt" class="rounded w-100" autocomplete="off">
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">임금계좌</label>
                            <input type="text" id="account-no-txt" class="rounded w-100" autocomplete="off">
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">예금주</label>
                            <input type="text" id="holder-name-txt" class="rounded w-100" autocomplete="off">
                        </div>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">신분증사본</label>
                            <input type="file" id="upload-file1" name="ssn_card_img" value="{{ old('ssn_card_img') }}" class="cursor-pointer rounded w-100 form-control-uniform-custom" required style="text-indent: 0;">
                            <input type="text" id="ssn-card-img-txt"
                                   onclick="PopupPopupForm1FormAMemberSellerEditForm.show_image(this)"
                                   class="w-100 rounded mb-1 tooltip-show-img" readonly>
                        </div>
                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">통장사본</label>
                            <input type="file" id="upload-file2" name="bank_account_img" value="{{ old('bank_account_img') }}" class="cursor-pointer rounded w-100 form-control-uniform-custom" required style="text-indent: 0;">
                            <input type="text" id="bank-account-img-txt"
                                   onclick="PopupPopupForm1FormAMemberSellerEditForm.show_image(this)"
                                   class="w-100 rounded mb-1 tooltip-show-img" readonly>
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!--// 오른쪽 컬럼 끝 -->
        </div>
        <!--// row 끝 -->
    </div>


</div>

{{-- @endsection --}}

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
        <script>
            $(document).ready(async function() {

                $('#upload-file1').fileselect();
                $('#upload-file2').fileselect();

                $('#upload-file1').on('change', function() {
                    const input = $(this);
                    const media_input = input.closest('.form-group').find('input[type="text"]');
                    PopupPopupForm1FormAMemberSellerEditForm.file_upload(this.files[0], media_input);
                });

                $('#upload-file2').on('change', function() {
                    const input = $(this);
                    const media_input = input.closest('.form-group').find('input[type="text"]');
                    PopupPopupForm1FormAMemberSellerEditForm.file_upload(this.files[0], media_input);
                });

                $('.member-company-act').on('click', function () {
                    switch( $(this).data('value') ) {
                        case 'save': PopupPopupForm1FormAMemberSellerEditForm.btn_act_save(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupPopupForm1FormAMemberSellerEditForm, $, undefined ) {
                PopupPopupForm1FormAMemberSellerEditForm.formA = {!! json_encode($formA) !!};
                PopupPopupForm1FormAMemberSellerEditForm.setup;
                PopupPopupForm1FormAMemberSellerEditForm.show_image = function ($this) {
                    window.open(window.env['MEDIA_URL']  + $($this).val())
                }

                PopupPopupForm1FormAMemberSellerEditForm.get_setup = async function () {
                    const response = await get_api_data('setup-page', {
                        PageVars: {
                            Query: "setup_code = 'media-body' and is_on_use = '1' and brand_code='post'",
                            Limit: 9999999, Offset: 0
                        }
                    })
                    const setupJson = JSON.parse(response.data['Page'][0]['SetupJson']);
                    setupJson['BrandCode']= 'post';
                    return setupJson;
                }

                PopupPopupForm1FormAMemberSellerEditForm.btn_act_new = function () {
                    $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                    $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup.popup-popup-form1-form-a-member-seller-edit-form .modal-dialog').css('maxWidth', '1200px');

                    $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                    $('#modal-select-popup .modal-body button').addClass('btn-primary')

                    Atype.btn_act_new('#member-company-form #frm');
                }

                PopupPopupForm1FormAMemberSellerEditForm.parameter = function () {
                    const member_company_form = $('#member-company-form')
                    let id = Number($(member_company_form).find('#Id').val());
                    let parameter = {
                        Id: id,
                        MobileNo: $(member_company_form).find('#mobile-no-txt').val(),
                        BankName: $(member_company_form).find('#bank-name-txt').val(),
                        BankAccountNo: $(member_company_form).find('#account-no-txt').val(),
                        AccountHolder: $(member_company_form).find('#holder-name-txt').val(),
                        Ssn1: $(member_company_form).find('#ssn1-txt').val(),
                        Ssn2: $(member_company_form).find('#ssn2-txt').val(),
                        SsnCardImg: $(member_company_form).find('#ssn-card-img-txt').val()
                    }
                    if (id < 0) {
                        parameter = { Id: id }
                    }

                    console.log(parameter)

                    return parameter;
                }

                PopupPopupForm1FormAMemberSellerEditForm.btn_act_save = function (is_seller) {
                    $('#is-seller-check').prop('checked', is_seller === '1')
                    Atype.set_parameter_callback(PopupPopupForm1FormAMemberSellerEditForm.parameter);

                    Atype.btn_act_save('#member-company-form #frm', async function () {
                        const response = await get_api_data('company-act', {
                            Page: [ PopupPopupForm1FormAMemberSellerEditForm.companyParameter() ]
                        })

                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupPopupForm1FormAMemberSellerEditForm');
                }

                PopupPopupForm1FormAMemberSellerEditForm.get_file_path_list = function (file_url, page) {
                    let file_path_list = [];

                    if (file_url) {
                        file_path_list.push(PopupPopupForm1FormAMemberSellerEditForm.get_media_data(file_url))
                    }

                    return file_path_list;
                }

                PopupPopupForm1FormAMemberSellerEditForm.get_media_data = async function (file_url) {
                    const path_list = file_url.split('/')
                    const file_name = path_list[path_list.length - 1]
                    const file_path = file_url.split(file_name)[0]

                    return {
                        name: file_name,
                        path: file_path,
                        setup: await PopupPopupForm1FormAMemberSellerEditForm.get_setup(),
                        type: "post",
                    }
                }

                PopupPopupForm1FormAMemberSellerEditForm.get_current_setup = function () {
                    return PopupPopupForm1FormAMemberSellerEditForm.setup['post'];
                }

                PopupPopupForm1FormAMemberSellerEditForm.check_file = function (file){
                    const allowed_extensions = ['jpg', 'jpeg', 'png', 'bmp', 'webp'];
                    const file_extension = file.name.split('.').pop().toLowerCase();

                    if (!allowed_extensions.includes(file_extension)) {
                        iziToast.error({
                            title: 'Error',
                            message: '이미지파일만 가능합니다.',
                        });
                        input_box_reset_for('#member-company-form');
                        return;
                    }
                }

                PopupPopupForm1FormAMemberSellerEditForm.change_file_url = async function (file_name, input) {
                    const setup = await PopupPopupForm1FormAMemberSellerEditForm.get_setup()
                    input.val(get_curr_setup_file_path(setup, file_name))
                }

                PopupPopupForm1FormAMemberSellerEditForm.file_upload = async function (file, input){
                    PopupPopupForm1FormAMemberSellerEditForm.check_file(file);
                    if (isEmpty(file)) {
                        input_box_reset_for('#member-company-form')
                        return;
                    }
                    var original_file_path = input.val();

                    await PopupPopupForm1FormAMemberSellerEditForm.change_file_url(PopupPopupForm1FormAMemberSellerEditForm.encrypt_file_name(file.name), input);
                    const id = Number($('#member-company-form').find('#Id').val())
                    const mediaValue = input.val();
                    const media = await PopupPopupForm1FormAMemberSellerEditForm.get_media_data(mediaValue);

                    // 화열 선택을 했을 때 파일존재 여부 체크
                    if (! isEmpty(file)) {
                        // $('.media-btn-group button').prop('disabled', true);
                        const response = await axios.post('/file-exists', {file_path: media['path'] + media['name']});
                        // $('.media-btn-group button').prop('disabled', false);
                        if (response.data) {
                            const split_media_name = media['name'].split('.')
                            const change_file_name = media['path'] + split_media_name[0] + '-change.' + split_media_name[1]

                            $('#media-form').find('#file-url-txt').focus()

                            iziToast.error({
                                title: 'Error',
                                message: `화일주소에 화일이 존재합니다. 저장을 원하시면 화일주소 입력창에서 ${media['name']} 이름을 직접 변경해주세요. Ex: ${change_file_name}`,
                            });
                            return;
                        }
                    }

                    let formData = new FormData();
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
                    formData.append('file', file);
                    formData.append('media', JSON.stringify(media));
                    // formData.append('type', 'member');

                    $.ajax({
                        url: "/file-upload",
                        type:'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            PopupPopupForm1FormAMemberSellerEditForm.callback_success()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // console.error(jqXHR.responseText);
                            iziToast.error({
                                title: 'Error',
                                message: '파일 업로드 중 오류가 발생했습니다: ' + errorThrown,
                            });
                        }
                    });
                }

                PopupPopupForm1FormAMemberSellerEditForm.send_verify_code = async function ($this) {
                    const response = await call_local_api('/dabory/myapp/member-edit-verify-send',
                                                             {mobile_no: $('#mobile-no-txt').val()}
                                                        )
                    console.log(response);
                    const data = response.data

                    if (data) {
                        // $($this).prop('disabled', true)
                        iziToast.success({ title: 'Success', message: '인증번호 발송되었습니다' })
                        $('#cert-send-btn').prop('disabled', true)
                    } else {
                        iziToast.error({ title: 'Error', message: data['Message'] })
                    }
                    return

                    // iziToast.info({ title: 'Info', message: '이용약관에 동의하셔야 합니다' });
                }

                PopupPopupForm1FormAMemberSellerEditForm.check_verify_code = async function () {
                    const cert_number = $('#cert-number-txt').val()
                    if(cert_number === ''){
                        iziToast.warning({ title: 'Warning', message: "인증번호를 입력해주세요."});
                        return false;
                    }
                    try {
                        const response = await call_local_api(
                            '/dabory/myapp/member-edit-verify',
                            { cert_number: $('#cert-number-txt').val() }
                        );

                        if (response.data.success) {
                            iziToast.success({ title: 'Success', message: response.data.message })
                            $('#company-name-txt').prop('readonly', false)
                            $('#email-txt').prop('readonly', false)
                            $('#mobile-no-txt').prop('readonly', false)
                            $('#cert-verify-btn').prop('disabled', true)
                        } else {
                            iziToast.error({ title: 'Fail', message: response.data.message })
                        }
                    } catch (error) {
                        // console.error(error);
                        iziToast.error({ title: 'Fail', message: '인증 요청 중 문제가 발생했습니다.' })
                    }
                }

                PopupPopupForm1FormAMemberSellerEditForm.callback_success = function (filePath) {
                    PopupPopupForm1FormAMemberSellerEditForm.btn_act_save()
                    // PopupPopupForm1FormAMemberSellerEditForm.delete_file(filePath)
                    // iziToast.success({
                    //     title: 'Success', message: '업로드 성공',
                    // });
                }

                PopupPopupForm1FormAMemberSellerEditForm.delete_file = function (filePath) {
                    $.ajax({
                        url: "/file-delete",
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            file_path_list: JSON.stringify([filePath])
                        }
                    });
                }

                PopupPopupForm1FormAMemberSellerEditForm.companyParameter = function () {
                    const member_company_form = $('#member-company-form')
                    let id = Number($(member_company_form).find('#BuyerId').val());
                    let parameter = {
                        Id: id,
                        CompanyName: $(member_company_form).find('#company-name-txt').val(),
                        BankName: $(member_company_form).find('#bank-name-txt').val(),
                        AccountNo: $(member_company_form).find('#account-no-txt').val(),
                        HolderName: $(member_company_form).find('#holder-name-txt').val(),
                        AccountImg: $(member_company_form).find('#bank-account-img-txt').val(),
                    }

                    console.log(parameter)
                    return parameter;
                }

                PopupPopupForm1FormAMemberSellerEditForm.encrypt_file_name = function (file_name) {
                    const last_dot_index = file_name.lastIndexOf('.');
                    let name_without_ext = file_name;
                    let extension = '';
                    if (last_dot_index !== -1) {
                        name_without_ext = file_name.substring(0, last_dot_index);
                        extension = file_name.substring(last_dot_index);
                    }
                    const encryptedName = CryptoJS.SHA256(name_without_ext).toString();
                    return `${encryptedName}${extension}`;
                };

                PopupPopupForm1FormAMemberSellerEditForm.show_popup_callback = async function (id, c1) {
                    PopupPopupForm1FormAMemberSellerEditForm.btn_act_new()

                    await PopupPopupForm1FormAMemberSellerEditForm.fetch_member(Number(id));
                }

                PopupPopupForm1FormAMemberSellerEditForm.fetch_member = async function (id) {
                    const response = await get_api_data(PopupPopupForm1FormAMemberSellerEditForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    const member_ext = await get_api_data('member-ext-pick', {
                        Page: [ { Id: id } ]
                    })

                    const company = await get_api_data('company-pick', {
                        Page: [ { Id:  response.data.Page[0].BuyerId } ]
                    })

                    PopupPopupForm1FormAMemberSellerEditForm.set_member_ui(response, member_ext, company)
                }

                PopupPopupForm1FormAMemberSellerEditForm.set_member_ui = async function (response, member_ext_page, company_page) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    const member_company_form = $('#member-company-form')
                    const member = response.data.Page[0]
                    const member_ext = member_ext_page.data.Page[0]
                    const company = company_page.data.Page[0]

                    $(member_company_form).find('#company-name-txt').prop('readonly', true)
                    $(member_company_form).find('#email-txt').prop('readonly', true)
                    $(member_company_form).find('#mobile-no-txt').prop('readonly', true)
                    $(member_company_form).find('#cert-send-btn').prop('disabled', false)
                    $(member_company_form).find('#cert-verify-btn').prop('disabled', false)

                    $(member_company_form).find('#cert-number-txt').val("")
                    $(member_company_form).find('#Id').val(member.Id)
                    $(member_company_form).find('#BuyerId').val(member.BuyerId)
                    $(member_company_form).find('#company-name-txt').val(company.CompanyName)
                    $(member_company_form).find('#email-txt').val(member.Email)
                    $(member_company_form).find('#mobile-no-txt').val(member_ext.MobileNo)
                    $(member_company_form).find('#bank-name-txt').val(company.BankName)
                    $(member_company_form).find('#account-no-txt').val(company.AccountNo)
                    $(member_company_form).find('#holder-name-txt').val(company.HolderName)
                    $(member_company_form).find('#ssn1-txt').val(member_ext.Ssn1)
                    $(member_company_form).find('#ssn2-txt').val(member_ext.Ssn2)
                    $(member_company_form).find('#ssn-card-img-txt').val(member_ext.SsnCardImg)
                    $(member_company_form).find('#bank-account-img-txt').val(company.AccountImg)
                }


            }( window.PopupPopupForm1FormAMemberSellerEditForm = window.PopupPopupForm1FormAMemberSellerEditForm || {}, jQuery ));
        </script>

        <script src="{{ csset('/js/core.js') }}"></script>
    @endpush
@endonce
