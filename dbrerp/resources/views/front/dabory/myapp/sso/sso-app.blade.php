@extends('front.dabory.myapp.layouts.master')
@section('title', $formB['General']['Title'])
@section('content')
    <div class="sso">
        <div class="mb-1 pt-2 px-3 text-right d-flex justify-content-end">
            <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
            </button>

            <button type="button"
                    class="btn btn-success btn-open-modal mr-1"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="ssoAppModal">
                <i class="icon-folder-open"></i>
            </button>
        </div>

        <div class="card mx-3 mt-2" id="sso-app-form">
            <div class="card-header" id="frm">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg card-header-item">
                        <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                            <div class="card-header p-0 mb-2">
                                {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="Id" name="Id" value="0">
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                    <input type="text" id="auto-slip-no-txt" class="rounded w-100" autocomplete="off" disabled
                                           maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                        {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                </div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                    <input class="rounded w-100" type="date" id="sso-app-date"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                        {{ $formB['FormVars']['Required']['Date'] }}>
                                </div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['RedirectURI'] }}</label>
                                    <input class="rounded w-100" type="text" id="redirect-uri-txt"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['RedirectURI'] }}"
                                        {{ $formB['FormVars']['Required']['RedirectURI'] }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg card-header-item">
                        <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                            <div class="card-header p-0 mb-2">
                                {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['AppType'] }}</label>
                                    <select class="rounded w-100" id="app-type-select"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['AppType'] }}"
                                        {{ $formB['FormVars']['Required']['AppType'] }}>
                                        @foreach($formB['AppTypeOptions'] as $appType)
                                            <option value="{{ $appType['Value'] }}"> {{ $appType['Caption'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['AppName'] }}</label>
                                    <input class="rounded w-100" type="text" id="app-name-txt"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['AppName'] }}"
                                        {{ $formB['FormVars']['Required']['AppName'] }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg card-header-item">
                        <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                            <div class="card-header p-0 mb-2">
                                {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['ClientId'] }}</label>
                                    <input class="rounded w-100" type="text" id="client-id-txt"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['ClientId'] }}"
                                        {{ $formB['FormVars']['Required']['ClientId'] }}>
                                </div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['ClientSecret'] }}</label>
                                    <input class="rounded w-100" type="text" id="client-secret"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['ClientSecret'] }}"
                                        {{ $formB['FormVars']['Required']['ClientSecret'] }}>
                                </div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">{{ $formB['FormVars']['Title']['PublicKey'] }}</label>
                                    <input class="rounded w-100" type="text" id="public-key-txt"
                                           maxlength="{{ $formB['FormVars']['MaxLength']['PublicKey'] }}"
                                        {{ $formB['FormVars']['Required']['PublicKey'] }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0 mt-2 mx-2">
                <div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary mr-1" id="down-btn" onclick="override_seq_no_up_down('down')"
                                data-clicked="">▼
                        </button>
                        <button class="btn btn-primary mr-1" id="up-btn" onclick="override_seq_no_up_down('up')"
                                data-clicked="">▲
                        </button>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary sso-app-bd-act" data-value="add">
                                {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                            </button>

                            @include('front.dabory.erp.partial.select-btn-options', [
                                'selectBtns' => $formB['BodySelectOptions'],
                                'eventClassName' => 'sso-app-bd-act'
                            ])
                        </div>
                    </div>

                    <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                        <table class="table-row sso-app-table">
                            <thead id="sso-app-table-head">
                            @include('front.dabory.erp.partial.make-thead', [
                                'listVars' => $formB['ListVars'],
                                'checkboxName' => 'bd-cud-check'
                            ])
                            </thead>
                            <tbody id="sso-app-table-body">
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SumTotal'] }}>
                                    {{ $formB['FooterVars']['Title']['SumTotal'] }}
                                </label>
                                <input type="text" class="w-100 w-md-80 rounded" id="SumTotal" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $ssoAppModal])
@endsection

@section('js')
    <script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            make_dynamic_table_css('.sso-app-table', make_dynamic_table_px(formB['ListVars']['Size']))

            $('#sso-app-date').val(date_to_sting(new Date()))

            $('.sso-app-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': Btype.btn_act_save('#sso-app-form #frm'); break;
                    case 'new': btn_act_new(); break;
                    case 'delete': Btype.btn_act_del('#sso-app-form #frm'); break;
                }
            });

            $('.sso-app-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': btn_bd_act_add(); break;
                    case 'multi-delete': override_btn_bd_act_multi_delete(); break;
                    case 'multi-update': override_btn_bd_act_multi_update(); break;
                }
            });

            new Clipboard('.copy-btn').on('success', function(e) {
                iziToast.success({ title: 'Success', message: $('#action-completed').text() });
            }).on('error', function(e) {
                iziToast.error({ title: 'Error', message: $('#action-failed').text()  });
            });

            activate_button_group()
        }

        async function override_seq_no_up_down(move) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length
            let bd = bd_page[index]

            if (isEmpty(bd) || parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT move UP or DOWN in the status')),
                });
                return;
            }

            let data = {
                BdTableName: 'main_sso_app_bd',
                HdIdName: 'sso_app_id',
                HdId: parseInt(bd.SsoAppId),
                CurrId: parseInt(bd.Id),
                Move: move,
            }

            $('#down-btn').prop('disabled', true);
            $('#up-btn').prop('disabled', true);
            await Btype.seq_no_up_down(move, data, '#sso-app-table-body', index)
            $('#down-btn').prop('disabled', false);
            $('#up-btn').prop('disabled', false);
        }

        async function btn_bd_act_add() {
            if (parseInt($(`#frm`).find(`input[name="Id"]`).val()) == 0) {
                iziToast.warning({ title: 'Warning', message: $('#no-data-found').text() });
                return
            }

            if (! Btype.last_item_added_check('#sso-app-table-body', 'window', 4)) {
                add_tr();
            }
        }

        function btn_act_new() {
            Btype.set_slip_no_btn_abled()
            window.input_box_reset_for('#sso-app-form #frm')
            $('#sso-app-date').val(date_to_sting(new Date()))

            // table body 초기화
            table_head_check_box_reset('#sso-app-table-head')
            $('#sso-app-table-body').html('');

            // footer 합계 초기화
            $('#SumTotal').val('')
        }

        function override_btn_bd_act_multi_update() {
            Btype.btn_bd_act_multi_update('.sso-app-table')
        }

        function override_btn_bd_act_multi_delete() {
            Btype.btn_bd_act_multi_delete('.sso-app-table')
        }

        function get_bd_parameter(bd) {
            let id = parseInt(bd.Id);

            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                SsoAppId: Number(bd.SsoAppId),
                MemberId: Number(bd.MemberId),
                SeqNo: bd.SeqNo,
                IsDiscarded: bd.IsDiscarded,
                AppBase64: bd.AppBase64,
                Ab64Desc: bd.Ab64Desc,
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

        function get_parameter() {
            const sso_app_form = $('#sso-app-form')

            let id = parseInt($(`#frm`).find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                SsoAppNo: $(sso_app_form).find('#auto-slip-no-txt').val(),
                SsoAppDate: moment(new Date($(sso_app_form).find('#sso-app-date').val())).format('YYYYMMDD'),
                RedirectUri: $(sso_app_form).find('#redirect-uri-txt').val(),
                AppType: $(sso_app_form).find('#app-type-select').val(),
                AppName: $(sso_app_form).find('#app-name-txt').val(),
                ClientId: $(sso_app_form).find('#client-id-txt').val(),
                ClientSecret: $(sso_app_form).find('#client-secret').val(),
            }
            if (id < 0) {
                parameter = { Id: id }
            }

            // console.log(parameter)
            return parameter;
        }

        async function get_last_slip_no($this) {
            Btype.set_slip_no_btn_disabled()
            let response = await Btype.get_last_slip_no(formB['QueryVars']['QueryName']);
            $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
        }

        function extract_public_key(key_pair) {
            $.ajax({
                url: "/extract-keys",
                type: 'GET',
                data: {
                    key_pair: key_pair
                },
                success: function(public_key) {
                    $('#sso-app-form').find('#public-key-txt').val(public_key);
                },
                error:function(request,status,error){
                    $('#sso-app-form').find('#public-key-txt').val('');
                }
            });
        }

        async function generate_app_base64_key($this) {
            const sso_app_form = $('#sso-app-form')
            const tr = $($this).closest('tr')
            let decrypted

            if (isEmpty($(sso_app_form).find('#public-key-txt').val())) {
                iziToast.error({
                    title: 'Error',
                    message: 'keys were not generated',
                })
                return
            }

            const client_id = $(sso_app_form).find('#client-id-txt').val()
            const sso_sub_id = $(tr).find('.member-id-txt').val()
            if (isEmpty(sso_sub_id)) {
                decrypted = client_id
            } else {
                const response = await pick_member_for(sso_sub_id)
                if (response.data.apiStatus || isNaN(sso_sub_id)) {
                    iziToast.error({ title: 'Error', message: '존재하지 않는 SSO Sub Id' });
                    $(tr).find('.app-base64-span').text('')
                    return
                }
                decrypted = client_id + ':' + sso_sub_id
            }

            post_crypto_sodium(decrypted,
                $(sso_app_form).find('#public-key-txt').val(), false, function (before_base64) {
                    $(tr).find('.app-base64-span').text(before_base64)
                    // $('#sso-app-form').find('#app-base64-txt').val(before_base64)
                })
        }

        async function pick_member_for(sso_sub_id) {
            return await get_api_data('member-pick', {
                Page: [ { Id: Number(sso_sub_id) } ]
            })
        }

        function post_crypto_sodium(decrypted, public_key, json_encode, callback) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/crypto/sodium',
                type: 'POST',
                data: JSON.stringify({
                    decrypted: decrypted,
                    public_key: public_key,
                    json_encode: json_encode,
                }),
                success: function(before_base64) {
                    callback(before_base64)
                }
            });
        }

        function save_data_when_entering_text() {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            bd_page[index].IsDiscarded = $(tr).find('.is-discarded-check').prop('checked')  ? '1' : '0'
            bd_page[index].MemberId = $(tr).find('.member-id-txt').val()
            bd_page[index].AppBase64 = $(tr).find('.app-base64-span').text()
            bd_page[index].Ab64Desc = $(tr).find('.ab64-desc-txt').val()

        }

        async function add_td_last_tap_out($this, id) {
            let tr = $(`input[name='bd-cursor-state']:checked`).closest('tr')
            let index = $(tr).prevAll().length

            // 필수텍스트가 안비어있으고 fouces out == 다음 tr 추가
            if (! isEmpty(bd_page[index].AppBase64)) {
                if ($($this).data('last')) {
                    let seq_no = await Btype.get_last_seq_no('sso-app', $('#auto-slip-no-txt').val())
                    bd_page[index].SeqNo = seq_no;
                }

                Btype.call_bd_act_api([ get_bd_parameter(bd_page[index]) ], function (page) {
                    bd_page[index].Id = page[0].Id;

                    override_body_act_success_callback($this, tr);
                    Btype.check_the_checkbox_when_changing($this, false)
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'AppBase64 생성하세요',
                });
            }
        }

        async function override_body_act_success_callback($this, tr) {
            $('#SumTotal').val(bd_page.length);

            if ($($this).data('last')) {
                add_tr()
                $($this).data('last', false)
            }
            iziToast.success({
                title: 'Success',
                message: $('#action-completed').text(),
            })
        }

        function change_sso_sub_id($this) {
            Btype.check_the_checkbox_when_changing($this)
            $($this).closest('tr').find('.app-base64-span').text('')
        }

        async function add_tr() {
            let last_bd_id_inc = 0
            if (bd_page.length > 0) {
                last_bd_id_inc = bd_page[bd_page.length - 1].cursorId + 1 || 0
            }

            let html =
            `<tr>
                <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                    <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Radio}"
                    id="bd-cursor-state-${last_bd_id_inc}"
                    onclick="Btype.bd_cursor_click(this)">
                </td>
                <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                    <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                    class="text-${formB.ListVars['Align'].$Check}">
                </td>
                <td class="text-${formB.ListVars['Align'].IsDiscarded}" ${formB.ListVars['Hidden'].IsDiscarded}>
                    <input type="checkbox" onfocusout="save_data_when_entering_text()"
                    class="text-${formB.ListVars['Align'].IsUse} border-0 bg-white is-discarded-check">
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    class="text-${formB.ListVars['Align'].MemberId}" ${formB.ListVars['Hidden'].MemberId}>
                    <div class="d-flex">
                        <input type="text" class="text-${formB.ListVars['Align'].MemberId} border-0 bg-white member-id-txt"
                        id="sso-sub-id-${last_bd_id_inc}"
                        onchange="change_sso_sub_id(this)" onfocusout="save_data_when_entering_text()">
                        <button type="button" class="btn-primary col-6 overflow-hidden text-nowrap" onclick="generate_app_base64_key(this)">
                            Generate AB64
                        </button>
                    </div>
                </td>
                <td
                    class="text-${formB.ListVars['Align'].AppBase64} position-relative" ${formB.ListVars['Hidden'].AppBase64}>
                    <span class="app-base64-span" id="app-base64-${last_bd_id_inc}"></span>
                    <i class="copy-btn input-icon icon-copy3 text-primary position-absolute" data-clipboard-target="#app-base64-${last_bd_id_inc}"></i>
                </td>
                <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                    data-last=true onfocusout="add_td_last_tap_out(this, ${last_bd_id_inc})"
                    class="text-${formB.ListVars['Align'].Ab64Desc}" ${formB.ListVars['Hidden'].Ab64Desc}>
                    <input type="text" class="text-${formB.ListVars['Align'].Ab64Desc} border-0 bg-white ab64-desc-txt"
                    onchange="Btype.check_the_checkbox_when_changing(this)"
                    onfocusout="save_data_when_entering_text()">
                </td>
            </tr>`;

            $('#sso-app-table-body').append(html)

            await setTimeout( function() {
                $(`#bd-cursor-state-${last_bd_id_inc}`).trigger('click')
                $(`#sso-sub-id-${last_bd_id_inc}`).focus()
            }, 100);

            bd_page.push({
                cursorId: last_bd_id_inc,
                Id: 0,
                SsoAppId: parseInt($(`#frm`).find(`input[name="Id"]`).val()),
                IsDiscarded: '0',
                MemberId: 0,
                AppBase64: '',
                Ab64Desc: '',
            })
        }

        function create_bd_page() {
            let html = []
            let sum_total = 0;
            // console.log(bd_page)

            bd_page.forEach(bd => {
                sum_total++;

                const sso_sub_id = bd.MemberId == 0 ? '' : bd.MemberId

                html.push (
                    `<tr>
                        <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                            <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                            class="text-${formB.ListVars['Align'].$Radio}"
                            onclick="Btype.bd_cursor_click(this)">
                        </td>
                        <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                            <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${formB.ListVars['Align'].$Check}">
                        </td>
                        <td class="text-${formB.ListVars['Align'].IsDiscarded}" ${formB.ListVars['Hidden'].IsDiscarded}>
                            <input type="checkbox" onfocusout="save_data_when_entering_text()" disabled
                            class="text-${formB.ListVars['Align'].IsDiscarded} border-0 bg-white is-discarded-check" ${bd.IsDiscarded === '1' ? 'checked' : ''}>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            class="text-${formB.ListVars['Align'].MemberId}" ${formB.ListVars['Hidden'].MemberId}>
                            <div class="d-flex">
                                <input type="text" class="text-${formB.ListVars['Align'].MemberId} border-0 bg-white member-id-txt" disabled
                                onchange="change_sso_sub_id(this)" onfocusout="save_data_when_entering_text()" value="${sso_sub_id}">
                                <button type="button" class="btn-primary col-6 overflow-hidden text-nowrap" onclick="generate_app_base64_key(this)">
                                    Generate AB64
                                </button>
                            </div>
                        </td>
                        <td
                            class="text-${formB.ListVars['Align'].AppBase64} position-relative" ${formB.ListVars['Hidden'].AppBase64}>
                            <span class="app-base64-span" id="app-base64-${bd.Id}">${bd.AppBase64}</span>
                            <i class="copy-btn input-icon icon-copy3 text-primary position-absolute" data-clipboard-target="#app-base64-${bd.Id}"></i>
                        </td>
                        <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                            onfocusout="add_td_last_tap_out(this, ${bd.Id})"
                            class="text-${formB.ListVars['Align'].Ab64Desc}" ${formB.ListVars['Hidden'].Ab64Desc}>
                            <input type="text" class="text-${formB.ListVars['Align'].Ab64Desc} border-0 bg-white ab64-desc-txt" disabled
                            onchange="Btype.check_the_checkbox_when_changing(this)"
                            value="${bd.Ab64Desc}"
                            onfocusout="save_data_when_entering_text()">
                        </td>
                    </tr>` )
            });

            $('#SumTotal').val(sum_total);

            document.getElementById('sso-app-table-body').innerHTML = html.join('');
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            extract_public_key(hd_page.DbrKeyPair)

            const sso_app_form = $('#sso-app-form')
            $(sso_app_form).find('#Id').val(hd_page.Id)
            $(sso_app_form).find('#auto-slip-no-txt').val(hd_page.SsoAppNo)
            $(sso_app_form).find('#sso-app-date').val(moment(to_date(hd_page.SsoAppDate)).format('YYYY-MM-DD'))
            $(sso_app_form).find('#redirect-uri-txt').val(hd_page.RedirectUri)

            $(sso_app_form).find('#app-type-select').val(hd_page.AppType)
            $(sso_app_form).find('#app-name-txt').val(hd_page.AppName)

            $(sso_app_form).find('#client-id-txt').val(hd_page.ClientId)
            $(sso_app_form).find('#client-secret').val(hd_page.ClientSecret)
            // table body에 데이터 추가
            create_bd_page()

            if (bd_page.length > 0) {
                let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
                bd_page[bd_page.length - 1].cursorId = unique
            }

            $('#modal-slip').modal('hide')
        }

        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
        const ssoAppModal = {!! json_encode($ssoAppModal) !!};
    </script>
@endsection
