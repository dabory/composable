{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary coupon-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'coupon-act',
        ])
    </div>
</div>

<div class="card mb-2" id="coupon-form">
    <div class="card-header" id="frm">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CouponType'] }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;">
                                @foreach ($formA['SelectCouponTypeOptions'] as $key => $option)
                                    <input  autocomplete="off" name="coupon-type" type="radio" value="{{ $option['Value'] }}" id="{{ 'coupon-type-'.($key+1) }}"
                                    {{ $option['Value'] == '0' ? 'checked' : ''}}>
                                    <label for="{{ 'coupon-type-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IssueType'] }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;">
                                @foreach ($formA['SelectIssueTypeOptions'] as $key => $option)
                                    <input  autocomplete="off" name="issue-type" type="radio" value="{{ $option['Value'] }}" id="{{ 'issue-type-'.($key+1) }}"
                                    {{ $option['Value'] == '0' ? 'checked' : ''}}>
                                    <label for="{{ 'issue-type-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['IssueDate'] }}</label>
                            <input class="rounded w-100" type="date" id="issue-date" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CouponName'] }}</label>
                            <input type="text" id="coupon-name-txt" class="rounded w-100" autocomplete="off">
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 overflow-hidden text-nowrap">{{ $formA['FormVars']['Title']['CouponCode'] }}</label>
                            <div class="d-flex align-items-center position-relative">
                                <input type="text" id="coupon-code-txt" class="rounded w-100" tabindex="-1" disabled>
                                <label class="btn-copy" /></button>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CouponDesc'] }}</label>
                            <div class="d-flex">
                                <div class="fr-view" id="remarks-preview" hidden></div>
                                <textarea style="height: 75px;" tabindex="-1" class="rounded w-100 bg-white mr-1" id="remarks-txt-area" role="button" readonly></textarea>
                                <div id="qr-code-frame"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="1" tabindex="-1" class="text-center mr-1" id="is-rate-check" onclick="CouponCreditCouponForm.discount_rate_txt_toggle(this)"><label class="mb-0" for="is-rate-check">{{ $formA['FormVars']['Title']['IsRate'] }}</label>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['CouponNum'] }}</label>
                            <input type="text" id="coupon-num-txt" class="rounded w-100 decimal" autocomplete="off" required
                                data-point="{{ $formA['FormVars']['Format']['CouponNum'] }}">
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0">{{ $formA['FormVars']['Title']['ExpireDate'] }}</label>
                            <input class="rounded w-100" type="date" id="expire-date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch p-2 border rounded">
        <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formA['FormVars']['Hidden']['UserName'] }}
                    rowspan="1" colspan="1">
                    {{ $formA['FormVars']['Title']['UserName'] }}
                </label>
                <input type="text" class="w-100 w-md-80 rounded text-left" id="UserName" disabled>
            </div>
            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formA['FormVars']['Hidden']['BranchName'] }}
                    rowspan="1" colspan="1">
                    {{ $formA['FormVars']['Title']['BranchName'] }}
                </label>
                <input type="text" class="w-100 w-md-80 rounded text-left" id="BranchName" disabled>
            </div>
        </div>
    </div>
</div>

{{-- @endsection --}}

@once
@push('modal')
    @include('front.outline.static.memo')
@endpush

@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            $('#coupon-form').find('#issue-date').val(date_to_sting(new Date()))
            $('#coupon-form').find('#expire-date').val(date_to_sting(new Date()))

            CouponCreditCouponForm.get_branch_name()
            $('#coupon-form').find('#UserName').val(window.User['NickName'])

            $('.coupon-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': CouponCreditCouponForm.btn_act_save(); break;
                    case 'del': CouponCreditCouponForm.btn_act_del(); break;
                }
            });

            $('#coupon-form').find('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo').find('.fr-view').html($('#coupon-form').find('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            $('#coupon-form').find('.btn-copy').click(function (e) {
                Atype.copy_to_clipboard('#coupon-form #coupon-code-txt')
                e.preventDefault()
            });

            Atype.set_parameter_callback(CouponCreditCouponForm.parameter);

            activate_button_group()
        });

        (function( CouponCreditCouponForm, $, undefined ) {
            CouponCreditCouponForm.formA = {!! json_encode($formA) !!};

            CouponCreditCouponForm.get_branch_name = async function () {
                let branch = await Atype.get_name_pick_api('branch-pick', window.User['BranchId'])

                $('#coupon-form').find('#BranchName').val(branch['BranchName'])
            }

            CouponCreditCouponForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#coupon-form #frm');
                CouponCreditCouponForm.get_coupon_code(cryptoRandomString({length: 21, type: 'base64'}));
            }

            CouponCreditCouponForm.discount_rate_txt_toggle = function ($this) {
                $('#coupon-form').find('#coupon-num-txt').val('')
                if ($($this).prop('checked')) {
                    $('#coupon-form').find('#coupon-num-txt').removeClass('decimal');
                } else {
                    $('#coupon-form').find('#coupon-num-txt').addClass('decimal');
                }
            }

            CouponCreditCouponForm.get_coupon_code = function (coupon_code) {
                $('#coupon-form').find('#coupon-code-txt').val(coupon_code)

                $('#coupon-form').find('#qr-code-frame').html('')
                var qrcode = new QRCode($('#coupon-form').find('#qr-code-frame')[0], {
                    text: coupon_code,
                    width: 75,
                    height: 75,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }

            CouponCreditCouponForm.parameter = function () {
                let id = Number($('#coupon-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    UserId: window.User['UserId'],
                    BranchId: window.User['BranchId'],
                    CouponType: $('input:radio[name=coupon-type]:checked').val(),
                    IssueType: $('input:radio[name=issue-type]:checked').val(),
                    IssueDate: moment(new Date($('#coupon-form').find('#issue-date').val())).format('YYYYMMDD'),
                    CouponName: $('#coupon-name-txt').val(),
                    CouponCode: $('#coupon-code-txt').val(),
                    IsRate: $('#coupon-form').find('#is-rate-check:checked').val() ?? '0',
                    CouponNum: minusComma($('#coupon-form').find('#coupon-num-txt').val()),
                    ExpireDate: moment(new Date($('#coupon-form').find('#expire-date').val())).format('YYYYMMDD'),
                    CouponDesc: $('#coupon-form').find('#remarks-preview').html(),
                    Ip: window.User['Ip']
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

            CouponCreditCouponForm.btn_act_save = function () {
                Atype.btn_act_save('#coupon-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'CouponCreditCouponForm');
            }

            CouponCreditCouponForm.btn_act_del = function () {
                Atype.btn_act_del('#coupon-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'CouponCreditCouponForm');
            }

            CouponCreditCouponForm.show_popup_callback = async function (id, c1) {
                await CouponCreditCouponForm.fetch_coupon(Number(id));
            }

            CouponCreditCouponForm.fetch_coupon = async function (id) {
                let response = await get_api_data(CouponCreditCouponForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                CouponCreditCouponForm.set_coupon_ui(response)
            }

            CouponCreditCouponForm.set_coupon_ui = function (response) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                let coupon = response.data.Page[0];

                $('#coupon-form').find('#Id').val(coupon.Id)
                $(`input:radio[name='coupon-type']:radio[value='${coupon.CouponType}']`).prop('checked', true);
                $(`input:radio[name='issue-type']:radio[value='${coupon.IssueType}']`).prop('checked', true);

                $('#coupon-form').find('#deal-category-txt').val(coupon.DealCategory)
                $('#coupon-form').find('#sort-no-txt').val(coupon.SortNo)
                $('#coupon-form').find('#issue-date').val(moment(to_date(coupon.IssueDate)).format('YYYY-MM-DD'))

                $('#coupon-form').find('#coupon-name-txt').val(coupon.CouponName)
                CouponCreditCouponForm.get_coupon_code(coupon.CouponCode)
                $('#coupon-form').find('#remarks-txt-area').val(remove_tag(coupon.CouponDesc))
                $('#coupon-form').find('#remarks-preview').html(coupon.CouponDesc)

                $('#coupon-form').find('#is-rate-check').prop('checked', coupon.IsRate == '1')
                CouponCreditCouponForm.discount_rate_txt_toggle($('#coupon-form').find('#is-rate-check'))

                $('#coupon-form').find('#coupon-num-txt').val(format_conver_for(coupon.CouponNum, CouponCreditCouponForm.formA.FormVars['Format'].CouponNum))
                $('#coupon-form').find('#expire-date').val(moment(to_date(coupon.ExpireDate)).format('YYYY-MM-DD'))
            }

        }( window.CouponCreditCouponForm = window.CouponCreditCouponForm || {}, jQuery ));
    </script>
@endpush
@endonce
