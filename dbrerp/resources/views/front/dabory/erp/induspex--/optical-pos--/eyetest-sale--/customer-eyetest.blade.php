<div class="card card_l1 h-100">
    <div class="card_inner" id="customer-eyetest">
        <!--왼쪽박스/버튼 시작-->
        <div class="text-right">
            <button type="button"
                class="btn btn-success btn-open-modal window customer-modal-btn"
                data-target="company"
                data-clicked="fetch_customer"
                data-variable="customerModal">
                <i class="icon-folder-open"></i>
            </button>

            <button type="button" class="btn btn-sm btn-primary" id="customer-eyetest-save-spinner-btn">
                <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                    Loading...
            </button>
            <div class="btn-group" id="customer-eyetest-btn-group" hidden>
                <button type="button" class="btn btn-sm btn-primary customer-eyetest-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                    {{ $formA['FormVars']['Title']['SaveButton'] }}
                </button>
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'customer-eyetest-act',
                ])
            </div>
        </div>
        <div class="frm">
            <input type="hidden" class="Id" name="Id" value="0">
            <!--왼쪽박스/버튼 끝 -->
            <div class="form-group w-100 d-flex flex-column" style="width: 143px">
                <label class="m-0 overflow-hidden text-nowrap">{{ $formA['FormVars']['Title']['CompanyName'] }}</label>
                <div class="col-12 d-flex p-0">
                    <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                            onclick="customer_get_last_slip_no(this)">
                        <span class="icon-cogs"></span>
                    </button>
                    <input type="text" class="auto-slip-no-txt rounded w-100 radius-l0" autocomplete="off" disabled
                           maxlength="{{ $formA['FormVars']['MaxLength']['CompanyName'] }}"
                        {{ $formA['FormVars']['Required']['CompanyName'] }}>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['MainContact'] }}</label>
                <div class="row">
                    <div class="col-8 pr-0">
                        <input class="rounded w-100" type="text" id="main-contact-txt" data-copy="true"
                                onkeydown="company_model_show_cell_enter_key(event, 'AA', 'window', undefined, 'customer-modal-btn', 'main_contact', '.main-contact')"
                                maxlength="{{ $formA['FormVars']['MaxLength']['MainContact'] }}"
                            {{ $formA['FormVars']['Required']['MainContact'] }}>
                    </div>
                    <div class="col-4 pl-1">
                        <select class="rounded w-100" id="sex-select">
                            <option value="">성별</option>
                            <option value="m">남자</option>
                            <option value="w">여자</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                <div class="d-flex">
                    <input class="rounded w-100 radius-r0" type="text" id="mobile-no-txt"
                           maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
                        {{ $formA['FormVars']['Required']['MobileNo'] }}>
                    <button type="button" tabindex="-1"
                        class="btn-dark rounded border-0 radius-l0 col-4">
                        <i class="fas fa-file-signature fa-lg" style="line-height: 24px;"></i>
                    </button>
                </div>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['TelNo'] }}</label>
                <input class="rounded w-100" type="text" id="tel-no-txt"
                       maxlength="{{ $formA['FormVars']['MaxLength']['TelNo'] }}"
                    {{ $formA['FormVars']['Required']['TelNo'] }}>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['BirthDate'] }}</label>
                <div class="row">
                    <div class="col-8 pr-0">
                        <input class="rounded w-100" type="date" id="birth-date"
                               maxlength="{{ $formA['FormVars']['MaxLength']['BirthDate'] }}"
                            {{ $formA['FormVars']['Required']['BirthDate'] }}>
                    </div>
                    <div class="col-4 pl-1">
                        <select class="rounded w-100" id="is-lunar-select"
                                maxlength="{{ $formA['FormVars']['MaxLength']['BirthDate'] }}"
                            {{ $formA['FormVars']['Required']['BirthDate'] }}>
                            <option value="0">양력</option>
                            <option value="1">음력</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                <input class="rounded w-100" type="text" id="email-txt"
                       maxlength="{{ $formA['FormVars']['MaxLength']['Email'] }}"
                    {{ $formA['FormVars']['Required']['Email'] }}>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['CgroupId'] }}</label>
                <select class="rounded w-100" id="cgroup-id-select"
                        maxlength="{{ $formA['FormVars']['MaxLength']['CgroupId'] }}"
                    {{ $formA['FormVars']['Required']['CgroupId'] }}>
                </select>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['ZipCode'] }}</label>
                <div class="d-flex">
                    <input class="rounded w-100 radius-r0" type="text" id="zip-code-txt" disabled
                           maxlength="{{ $formA['FormVars']['MaxLength']['ZipCode'] }}"
                        {{ $formA['FormVars']['Required']['ZipCode'] }}>
                    <button type="button" onclick="get_zip_code()" tabindex="-1"
                        class="btn-dark rounded border-0 radius-l0 col-4">
                        <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
                    </button>
                </div>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['Addr1'] }}</label>
                <input class="rounded w-100 bg-white" type="text" id="addr1-txt" disabled
                       maxlength="{{ $formA['FormVars']['MaxLength']['Addr1'] }}"
                    {{ $formA['FormVars']['Required']['Addr1'] }}>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['Addr2'] }}</label>
                <textarea style="height: 48px" class="rounded w-100" id="addr2-txt-area"
                          maxlength="{{ $formA['FormVars']['MaxLength']['Addr2'] }}"
                        {{ $formA['FormVars']['Required']['Addr2'] }}></textarea>
            </div>
            <div class="d-flex flex-row align-items-center div_checkbox">
                <input type="checkbox" value="1" class="text-center" id="is-ok-text-check"> <label for="is-ok-text-check" class="pt-0 m-0 mr-2">{{ $formA['FormVars']['Title']['IsOkText'] }}</label>
                <input type="checkbox" value="1" class="text-center" id="is-ok-email-check"> <label for="is-ok-email-check" class="pt-0 m-0 mr-2">{{ $formA['FormVars']['Title']['IsOkEmail'] }}</label>
                <input type="checkbox" value="1" class="text-center" id="is-ok-dm-check"> <label for="is-ok-dm-check" class="pt-0 m-0 mr-2">{{ $formA['FormVars']['Title']['IsOkDm'] }}</label>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['Remarks'] }}</label>
                <textarea style="height: 48px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                <div class="fr-view" id="remarks-preview" hidden></div>
            </div>
            <strong class="pt-2">{{ $formA['FormVars']['Title']['UserCredit'] }}</strong>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['CurrUserCredit'] }}</label>
                <div class="d-flex">
                    <input class="rounded w-100 radius-r0" type="text" id="curr-credit-txt" disabled
                           maxlength="{{ $formA['FormVars']['MaxLength']['UserCredit'] }}"
                        {{ $formA['FormVars']['Required']['UserCredit'] }}>
                    <button type="button" tabindex="-1"
                            class="rounded border-0 radius-l0 col-4 btn-success btn-open-modal"
                            data-target="slip"
                            data-clicked="fetch_customer"
                            data-variable="customerTieModal">
                        <i class="icon-folder-open fa-lg" style="line-height: 24px;"></i>
                    </button>
                </div>
            </div>
            <div class="form-group d-flex flex-column">
                <label class="m-0">{{ $formA['FormVars']['Title']['AvailUserCredit'] }}</label>
                <div class="d-flex">
                    <input class="rounded w-100 radius-r0" type="text" id="avail-credit-txt" disabled
                           maxlength="{{ $formA['FormVars']['MaxLength']['AvailUserCredit'] }}"
                        {{ $formA['FormVars']['Required']['AvailUserCredit'] }}>
                    <button type="button" onclick="use_of_user_credit()" tabindex="-1"
                        class="btn-dark rounded border-0 radius-l0 col-4">
                        <i class="fas fa-coins fa-lg" style="line-height: 24px;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $customerTieModal])
    @include('front.outline.static.company', [
        'moealSetFile' => $customerModal,
        'modalClassName' => 'customer-eyetest'
    ])
    @include('front.outline.static.memo')
@endpush

@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        $(document).ready(async function() {
            await create_cgroup_select_box_options();

            $('.customer-eyetest-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': customer_eyetest_btn_act_save(); break;
                    case 'new': atype_custom_btn_act_new(); break;
                    case 'copy': customer_eyetest_btn_act_copy(); break;
                    case 'del': customer_eyetest_btn_act_del(); break;
                }
            });

            $('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo').find('.fr-view').html($('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            const slip_commmon_setup = await get_slip_common_setup_for('company')
            formA['SlipCommonSetup'] = slip_commmon_setup.data
            Atype.set_parameter_callback(customer_eyetest_parameter);
        });

        async function customer_get_last_slip_no() {
            Btype.set_slip_no_btn_disabled('#customer-eyetest #auto-slip-no-btn')

            $('#customer-eyetest').find('.auto-slip-no-txt').val(await make_slip_no('company', 'customer'))
        }

        function customer_eyetest_btn_act_del() {
            Atype.set_parameter_callback(customer_eyetest_parameter);

            Atype.btn_act_del('#customer-eyetest .frm');
        }

        function customer_eyetest_btn_act_copy() {
            Atype.set_parameter_callback(customer_eyetest_parameter);

            Atype.btn_act_copy('#customer-eyetest .frm');
        }

        function customer_eyetest_btn_act_save() {
            Atype.set_parameter_callback(customer_eyetest_parameter);

            Atype.btn_act_save('#customer-eyetest .frm');
        }

        function atype_custom_btn_act_new() {
            $('#modal-company.customer-eyetest').trigger('new.customer');
            $('#modal-eyetest').find('.company-name').val('')
            Atype.btn_act_new('#customer-eyetest .frm');

            if (formA['SlipCommonSetup']['IsNewRecAutoSlipNo']) {
                customer_get_last_slip_no()
            }
        }

        function use_of_user_credit() {
            $('#bill-type-uc-txt').val( format_conver_for(remove_comma_and_arithmetic($('#bill-type-uc-txt').val(), $('#avail-credit-txt').val(), 'plus'), formB.ListVars['Format'].SorderPrc) )
            $('#avail-credit-txt').val(0)
            $('#user-credit-select').val( '사용' )
        }

        function get_zip_code(){
            new daum.Postcode({
                oncomplete: function(data) {
                    $("#zip-code-txt").val(data.zonecode)
                    $("#addr1-txt").val(data.roadAddress)
                }
            }).open();
        }

        function set_company_data_to_textbox(customer) {
            set_customer_ui(customer)
            // console.log(customer)
            $('#modal-company.customer-eyetest').trigger('fetch.customer', customer['Id']);

            return $('.customer-eyetest-act.save-button');
        }

        function customer_eyetest_parameter() {
            let id = Number($('#customer-eyetest .frm').find('input[name="Id"]').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                CompanyName: $('#customer-eyetest').find('.auto-slip-no-txt').val(),
                MainContact: $('#main-contact-txt').val(),
                Sex: $('#sex-select').val(),
                MobileNo: $('#mobile-no-txt').val(),
                TelNo: $('#tel-no-txt').val(),
                BirthDate: moment(new Date($('#birth-date').val())).format('YYYYMMDD'),
                IsLunar: $('#is-lunar-select').val(),
                Email: $('#email-txt').val(),
                CgroupId: Number($('#cgroup-id-select').val()),
                ZipCode: $('#zip-code-txt').val(),
                Addr1: $('#addr1-txt').val(),
                Addr2: $('#addr2-txt-area').val(),
                IsOkText: $('#is-ok-text-check:checked').val() ?? '0',
                IsOkEmail: $('#is-ok-email-check:checked').val() ?? '0',
                IsOkDm: $('#is-ok-dm-check:checked').val() ?? '0',
                Remarks: $('#remarks-preview').html(),
                CompanyClass: 'AA',
                CurrCreditBal: '0',
                Ip: window.User['Ip']
            }
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }

            return parameter;
        }

        async function create_cgroup_select_box_options() {
            let response = await get_api_data('setting-search-page', {
                QueryVars: {
                    QueryName: 'cgroup',
                    FilterName: 'dbr_cgroup.id',
                },
                PageVars: {
                    Limit: 9999,
                    Offset: 0,
                }
            })
            let cgroup_id_select = custom_create_options('Id', 'Name', response.data.Page)
            $('#cgroup-id-select').append(cgroup_id_select);
        }

        function set_customer_ui(customer) {
            Btype.set_slip_no_btn_disabled('#customer-eyetest #auto-slip-no-btn')

            $('#customer-eyetest .frm').find('input[name="Id"]').val(customer.Id)
            $('#customer-eyetest').find('.auto-slip-no-txt').val(customer.CompanyName)
            $('#main-contact-txt').val(customer.MainContact)
            $('#sex-select').val(customer.Sex)
            $('#mobile-no-txt').val(customer.MobileNo)
            $('#tel-no-txt').val(customer.TelNo)
            $('#email-txt').val(customer.Email)
            $('#birth-date').val(moment(to_date(customer.BirthDate)).format('YYYY-MM-DD'))
            $('#is-lunar-select').val(customer.IsLunar)
            $('#cgroup-id-select').val(customer.CgroupId)
            $('#zip-code-txt').val(customer.ZipCode)
            $('#addr1-txt').val(customer.Addr1)
            $('#addr2-txt-area').val(customer.Addr2)
            $('#is-ok-text-check').prop('checked', customer.IsOkText == '1')
            $('#is-ok-email-check').prop('checked', customer.IsOkEmail == '1')
            $('#is-ok-dm-check').prop('checked', customer.IsOkDm == '1')
            $('#remarks-txt-area').val(remove_tag(customer.Remarks))
            $('#remarks-preview').html(customer.Remarks)

            $('#modal-eyetest').find('.company-name').val(customer.CompanyName)
        }

        async function fetch_customer(customer_name, id, type = 'u') {
            let response = await call_slip_form_book(formA['General']['PickApi'], formA['QueryVars']['QueryName'],
                customer_name, {!! json_encode($menuCode) !!});

            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-company').modal('hide');
                return;
            }

            $('#curr-credit-txt').val(format_conver_for(response.data.CurrReward, "decimal('sales_prc')" )),
            $('#avail-credit-txt').val(format_conver_for(response.data.AvailReward, "decimal('sales_prc')" ))

            if (type == 'u') { $('#modal-company.customer-eyetest').trigger('fetch.customer', id); }
            set_customer_ui(response.data.HdPage[0])
            $('#modal-company').modal('hide');
        }

        var formA = {!! json_encode($formA) !!};
        const customerTieModal = {!! json_encode($customerTieModal) !!};
        const customerModal = {!! json_encode($customerModal) !!};
    </script>
@endpush

