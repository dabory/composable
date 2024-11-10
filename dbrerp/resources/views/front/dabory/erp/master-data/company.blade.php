@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                {{-- act button include --}}
                <div class="mb-1 pt-2 text-right">
                    <button type="button"
                        class="btn btn-success btn-open-modal"
                        data-target="company"
                        data-clicked="CompanyForm.fetch_company"
                        data-variable="companyModal"
                    ><i class="icon-folder-open"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary company-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>{{ $formA['FormVars']['Title']['SaveButton'] }}</button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formA['SelectButtonOptions'],
                            'eventClassName' => 'company-act',
                        ])
                    </div>
                </div>
                <div class="card p-2" id="company-form">
                    <div class="card-header" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card card-primary mb-3 mb-md-0 border-light">
                                {{-- <div class="card-header p-1 mb-2"> 핵심정보 </div> --}}
                                    <div class="card-body">
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CompanyNo'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['CompanyNo'] }}</label>
                                        <br>
                                        <input type="text" id="company-no-txt" data-copy="true" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['CompanyNo'] }}"
                                            {{ $formA['FormVars']['Required']['CompanyNo'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['TaxNo'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['TaxNo'] }}</label>
                                        <br>
                                        <input type="text" id="tax-no-txt" data-copy="true" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['TaxNo'] }}"
                                            {{ $formA['FormVars']['Required']['TaxNo'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CompanyName'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['CompanyName'] }}</label>
                                        <br>
                                        <input type="text" id="company-name-txt" data-copy="true" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['CompanyName'] }}"
                                            {{ $formA['FormVars']['Required']['CompanyName'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CompanyClass'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['CompanyClass'] }}</label>
                                        <br>
                                        <select class="rounded w-100" id="company-class-select"
                                                maxlength="{{ $formA['FormVars']['MaxLength']['CompanyClass'] }}"
                                            {{ $formA['FormVars']['Required']['CompanyClass'] }}>
                                            @foreach ($formA['CompanyClassOptions'] as $option)
                                                <option value="{{ $option['Value'] }}" data-vatrate="0.10">{{ $option['Caption'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Sort'] }}>
                                        <label class="m-0">종류</label>
                                        <select class="rounded w-100" id="sort-select"
                                                maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                                            {{ $formA['FormVars']['Required']['Sort'] }}>
                                            @forelse ($codeTitle['sort']['company'] ?? [] as $key => $status)
                                                @if ($status['Code'] !== '')
                                                    <option value="{{ $status['Code'] }}" {{ request('filter') === $status['Code'] ? 'selected' : '' }}>
                                                        {{ $status['Title'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CgroupId'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['CgroupId'] }}</label>
                                        <br>
                                        <select class="rounded w-100" id="cgroup-id-select"
                                                maxlength="{{ $formA['FormVars']['MaxLength']['CgroupId'] }}"
                                            {{ $formA['FormVars']['Required']['CgroupId'] }}>
                                        </select>
                                    </div>
                                    <div class="form-group flex-column mb-3" id="seller-id-div" style="display: block;">
                                        <label class="m-0" {{ $formA['FormVars']['Required']['SellerId'] }}>
                                            {{ $formA['FormVars']['Title']['SellerId'] }}
                                        </label>
                                        <div class="d-flex">
                                            <input type="text" id="seller-txt" data-id="1" class="rounded w-100 radius-r0" autocomplete="off"
                                                   onkeydown="company_model_show_cell_enter_key(event, '', 'CompanyForm')"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['SellerId'] }}"
                                                {{ $formA['FormVars']['Required']['SellerId'] }}>
                                            <button type="button" {{ $formA['FormVars']['Required']['SellerId'] === 'hidden' ? 'hidden' : '' }}
                                            class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 CompanyForm company-modal-btn"
                                                    data-target="company"
                                                    data-clicked="CompanyForm.fetch_seller"
                                                    data-variable="companyModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['MainContact'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['MainContact'] }}</label>
                                        <br>
                                        <input type="text" id="main-contact-txt" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MainContact'] }}"
                                            {{ $formA['FormVars']['Required']['MainContact'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['MobileNo'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
                                        <br>
                                        <input type="text" id="mobile-no-txt" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
                                            {{ $formA['FormVars']['Required']['MobileNo'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Email'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
                                        <br>
                                        <input type="text" id="email-txt" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['Email'] }}"
                                            {{ $formA['FormVars']['Required']['Email'] }}>
                                    </div>
                                    {{--<div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CardChar4'] }}>       --}}
                                    {{--      <label class = "m-0">{{ $formA['FormVars']['Title']['CardChar4'] }}</label>   --}}
                                    {{--      <br>                                                                          --}}
                                    {{--      <input type="text" id="card-char4-txt" class="rounded w-100"                  --}}
                                    {{--             maxlength="{{ $formA['FormVars']['MaxLength']['CardChar4'] }}"         --}}
                                    {{--          {{ $formA['FormVars']['Required']['CardChar4'] }}>                        --}}
                                    {{--  </div>                                                                            --}}
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['TelNo'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['TelNo'] }}</label>
                                        <br>
                                        <input type="text" id="tel-no-txt" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['TelNo'] }}"
                                            {{ $formA['FormVars']['Required']['TelNo'] }}>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['FaxNo'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['FaxNo'] }}</label>
                                        <br>
                                        <input type="text" id="fax-no-txt" class="rounded w-100"
                                               maxlength="{{ $formA['FormVars']['MaxLength']['FaxNo'] }}"
                                            {{ $formA['FormVars']['Required']['FaxNo'] }}>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card card card-info mb-3 mb-md-0 border-light">
                                {{-- <div class="card-header p-1 mb-2"> 사업자 등록정보 </div> --}}
                                    <div class="card-body">
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['FullName'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['FullName'] }}</label>
                                            <br>
                                            <input type="text" id="full-name-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['FullName'] }}"
                                                {{ $formA['FormVars']['Required']['FullName'] }}>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['President'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['President'] }}</label>
                                            <br>
                                            <input type="text" id="president-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['President'] }}"
                                                {{ $formA['FormVars']['Required']['President'] }}>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['ZipCode'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['ZipCode'] }}</label>
                                            <br>
                                            <div class="d-flex">
                                                <input type="text" id="zip-code-txt" class="form-control form-control-sm radius-r0 col-8" data-pattern="num_only" data-type="post" data-targetadd="Addr1" data-targetfocus="Addr2" autocomplete="off" maxlength="5" disabled
                                                       maxlength="{{ $formA['FormVars']['MaxLength']['ZipCode'] }}"
                                                    {{ $formA['FormVars']['Required']['ZipCode'] }}>
                                                <button type="button" onclick="CompanyForm.get_zip_code()"
                                                    class="btn-dark rounded border-0 radius-l0 col-4">
                                                    <i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Addr1'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['Addr1'] }}</label>
                                            <br>
                                            <input type="text" id="addr1-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['Addr1'] }}"
                                                {{ $formA['FormVars']['Required']['Addr1'] }}>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Addr2'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['Addr2'] }}</label>
                                            <br>
                                            <input type="text" id="addr2-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['Addr2'] }}"
                                                {{ $formA['FormVars']['Required']['Addr2'] }}>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['BizType'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['BizType'] }}</label>
                                            <br>
                                            <input type="text" id="biz-type-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['BizType'] }}"
                                                {{ $formA['FormVars']['Required']['BizType'] }}>
                                        </div>
                                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['DealItem'] }}>
                                            <label class = "m-0">{{ $formA['FormVars']['Title']['DealItem'] }}</label>
                                            <br>
                                            <input type="text" id="deal-item-txt" class="rounded w-100"
                                                   maxlength="{{ $formA['FormVars']['MaxLength']['DealItem'] }}"
                                                {{ $formA['FormVars']['Required']['DealItem'] }}>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card card card-success mb-3 mb-md-0 border-light">
                                    <div class="card-body">
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Remarks'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['Remarks'] }}</label>
                                        <br>
                                        <div class="fr-view" id="remarks-preview" hidden></div>
                                        <textarea style="height: 75px;" tabindex="-1" class="rounded w-100 bg-white mr-1" id="remarks-txt-area" role="button" readonly></textarea>
                                    </div>
                                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsDealEnd'] }}>
                                        <label class = "m-0">{{ $formA['FormVars']['Title']['IsDealEnd'] }}</label>
                                        <br>
                                        <input type="checkbox" value="1" id="is-deal-end-check"><label for="is-deal-end-check"></label>
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
@endsection

@section('modal')
    @include('front.outline.static.company', ['moealSetFile' => $moealSetFile])
    @include('front.outline.static.memo')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    $(document).ready(async function() {
        await CompanyForm.create_cgroup_select_box_options();

        $('.company-act').on('click', function () {
            // console.log($(this).data('value'))
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#company-form #frm', undefined, 'CompanyForm'); break;
                case 'new': Atype.btn_act_new('#company-form #frm'); break;
                case 'copy': Atype.btn_act_copy('#company-form #frm', undefined, 'CompanyForm'); break;
                case 'del': Atype.btn_act_del('#company-form #frm', undefined, 'CompanyForm'); break;
            }
        });

        $('#cgroup-id-select').on('change', function(){
            const val = $(this).val()
            switch (val) {
                case '1':
                case '2':
                    $('#seller-id-div').show()
                    break;
                default:
                    $('#seller-id-div').hide()
                    break;
            }
        })

        $('#full-name-txt').on('click', function(){
            var companyName = $('#company-name-txt').val();
            if(companyName){
                $('#full-name-txt').val(companyName);
            }
        })

        $('#president-txt').on('click', function(){
            var mainContact = $('#main-contact-txt').val();
            if(mainContact){
                $('#president-txt').val(mainContact);
            }
        })


        $('#company-form').find('#remarks-txt-area').on('dblclick', function () {
            $('#froala-editor').data('preview_id', '#remarks-preview')
            $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

            $('#modal-memo').find('.fr-view').html($('#company-form').find('#remarks-preview').html())
            $('#modal-memo').modal('show');
        });

        Atype.set_parameter_callback(CompanyForm.parameter);
    });

    (function( CompanyForm, $, undefined ) {
        CompanyForm.formA = {!! json_encode($formA) !!};

        CompanyForm.create_cgroup_select_box_options = async function () {
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
            $('#company-form').find('#cgroup-id-select').append(cgroup_id_select);
        }

        CompanyForm.pick = async function (id) {
            return await get_api_data(CompanyForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })
        }

        CompanyForm.fetch_company = async function  (id) {
            const response = await CompanyForm.pick(id)

            CompanyForm.set_company_ui(response)
        }

        CompanyForm.fetch_seller = async function  (id) {
            const response = await CompanyForm.pick(id)

            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-company').modal('hide')
                return
            }

            const seller = response.data.Page[0]
            $('#company-form').find('#seller-txt').val(seller['CompanyName'])
            $('#company-form').find('#seller-txt').data('id', seller['Id'])
            $('#modal-company').modal('hide')
        }

        CompanyForm.parameter = function () {
            let sellerId = $('#company-form').find('#seller-txt').data('id')
            switch ($('#cgroup-id-select').val()) {
                case '3':
                case '4':
                case '5':
                    sellerId = $('#company-form').find('#Id').val()
                    break;
            }

            let id = Number( $('#company-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                CompanyNo: $('#company-form').find('#company-no-txt').val(),
                TaxNo: $('#company-form').find('#tax-no-txt').val(),
                CompanyName: $('#company-form').find('#company-name-txt').val(),
                CompanyClass: $('#company-form').find('#company-class-select').val(),
                CgroupId: Number($('#company-form').find('#cgroup-id-select').val()),
                MainContact: $('#company-form').find('#main-contact-txt').val(),
                MobileNo: $('#company-form').find('#mobile-no-txt').val(),
                Email: $('#company-form').find('#email-txt').val(),
                // CardChar4: $('#company-form').find('#card-char4-txt').val(),
                TelNo: $('#company-form').find('#tel-no-txt').val(),
                FaxNo: $('#company-form').find('#fax-no-txt').val(),

                FullName: $('#company-form').find('#full-name-txt').val(),
                President: $('#company-form').find('#president-txt').val(),
                ZipCode: $('#company-form').find('#zip-code-txt').val(),
                Addr1: $('#company-form').find('#addr1-txt').val(),
                Addr2: $('#company-form').find('#addr2-txt').val(),
                BizType: $('#company-form').find('#biz-type-txt').val(),
                DealItem: $('#company-form').find('#deal-item-txt').val(),
                SellerId: Number(sellerId),

                Remarks: $('#remarks-preview').html(),
                IsDealEnd: $('#is-deal-end-check:checked').val() ?? '0',
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
            console.log(parameter)

            return parameter;
        }

        CompanyForm.set_company_ui = async function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-company').modal('hide');
                return;
            }

            let company = response.data.Page[0];

            $('#company-form').find('#Id').val(company.Id)

            $('#company-form').find('#company-no-txt').val(company.CompanyNo)
            $('#company-form').find('#tax-no-txt').val(company.TaxNo)
            $('#company-form').find('#company-name-txt').val(company.CompanyName)
            $('#company-form').find('#cgroup-id-select').val(company.CgroupId)
            $('#company-form').find('#company-class-select').val(company.CompanyClass)
            $('#company-form').find('#main-contact-txt').val(company.MainContact)
            $('#company-form').find('#mobile-no-txt').val(company.MobileNo)
            $('#company-form').find('#email-txt').val(company.Email)
            // $('#company-form').find('#card-char4-txt').val(company.CardChar4)
            $('#company-form').find('#tel-no-txt').val(company.TelNo)
            $('#company-form').find('#fax-no-txt').val(company.FaxNo)

            $('#company-form').find('#full-name-txt').val(company.FullName)
            $('#company-form').find('#president-txt').val(company.President)
            $('#company-form').find('#zip-code-txt').val(company.ZipCode)
            $('#company-form').find('#addr1-txt').val(company.Addr1)
            $('#company-form').find('#addr2-txt').val(company.Addr2)
            $('#company-form').find('#biz-type-txt').val(company.BizType)
            $('#company-form').find('#deal-item-txt').val(company.DealItem)

            $('#company-form').find('#remarks-txt-area').val(remove_tag(company.Remarks))
            $('#company-form').find('#remarks-preview').html(company.Remarks)
            $('#company-form').find('#is-deal-end-check').prop('checked', company.IsDealEnd == '1')

            await CompanyForm.fetch_seller(company.SellerId)

            $('#company-form').find('#cgroup-id-select').trigger('change')
            $('#modal-company').modal('hide');
        }

        CompanyForm.get_zip_code = function () {
            new daum.Postcode({
                oncomplete: function(data) {
                    $('#company-form').find('#zip-code-txt').val(data.zonecode)
                    $('#company-form').find('#addr1-txt').val(data.roadAddress)
                }
            }).open();
        }

    }( window.CompanyForm = window.CompanyForm || {}, jQuery ));


    const companyModal = {!! json_encode($moealSetFile) !!};
</script>
@endsection
